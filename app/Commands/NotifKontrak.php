<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use App\Libraries\Fonnte;
use App\Models\Department;
use App\Models\Karyawan;
use App\Models\Notifikasi;
use App\Models\Settings as Msetting;

class NotifKontrak extends BaseCommand
{
    protected $group       = 'notif';
    protected $name        = 'notif:kontrak';
    protected $description = 'Mengirim notifikasi WhatsApp kontrak karyawan yang akan habis';

    protected $db;
    protected $mkaryawan;
    protected $msettings;
    protected $mdepartment;
    protected $fonnte;

    public function __construct()
    {
        $this->db          = \Config\Database::connect();
        $this->mdepartment = new Department();
        $this->fonnte      = new Fonnte();
        $this->msettings   = new Msetting();
        $this->mnotifikasi   = new Notifikasi();
        $this->mkaryawan   = new Karyawan();

        helper(['fonnte_api_helper', 'date_helper']);
    }

    public function run(array $params)
    {
        helper(['date']);
        log_message('info', 'Cek kontrak karyawan dimulai...');

        try {
            // Ambil data setting
            $setting = $this->msettings->getNotif("notif_kontrak");

            if ($setting && ($setting["status"] === "on")) {
                // Range hari untuk notifikasi
                $rangeHari = [3, 7, 14, 30];

                // Ambil penerima notifikasi
                $penerima = $this->msettings->getPenerimaNotif("notif_kontrak", "on");

                if ($penerima) {
                    // Ambil semua basenotif unik
                    $basenotif = array_values(array_unique(array_column($penerima, 'basenotif')));

                    foreach ($basenotif as $base) {
                        // Grouping nomor per base
                        $groupedPhones = [];
                        foreach ($penerima as $row) {
                            if ($row['basenotif'] == $base) {
                                $groupedPhones[$base][] = $row['phone'];
                            }
                        }

                        $nomorkirim = $groupedPhones[$base] ?? [];
                        if (empty($nomorkirim)) {
                            continue; // skip kalau tidak ada nomor
                        }

                        $dataKontrak = [];
                        $adaKontrak  = false;

                        // Ambil data kontrak habis per range
                        foreach ($rangeHari as $hari) {
                            $data = $this->mkaryawan->getKontrakHabis(date('Y-m-d', strtotime("+$hari days")), $base);
                            if ($data) {
                                $adaKontrak = true;
                                $dataKontrak[$hari] = $data;
                            }
                        }

                        // Buat pesan notifikasi
                        $message = "_*Berikut daftar karyawan yang masa kontraknya akan segera habis*_:";
                        if ($base !== "Semua") {
                            $department = $this->db->table("department")
                                ->select("*")
                                ->where('id', $base)
                                ->get()
                                ->getRowArray();

                            if ($department) {
                                $message = "_*Berikut daftar karyawan {$department['nama']} yang masa kontraknya akan segera habis*_:";
                            }
                        }

                        if ($adaKontrak) {
                            foreach ($dataKontrak as $hari => $items) {
                                $message .= "\n\n*Tanggal " . tgl_indo(date('Y-m-d', strtotime("+$hari days"))) . "*:";
                                foreach ($items as $item) {
                                    $message .= "\n- {$item['user_nama_depan']} {$item['user_nama_belakang']} ({$item['jabatan']})";
                                }
                            }

                            $message .= "\n\n_*Ini adalah pesan notifikasi otomatis HRIS, tidak perlu membalas pesan ini._";
                            log_message('info', "Kirim notifikasi {$base}.");

                            // Kirim notifikasi WhatsApp
                            // $this->fonnte->bulkMessage(
                            //     $nomorkirim,
                            //     $message,
                            //     5 // delay antar pesan (detik)
                            // );
                        } else {
                            log_message('info', "Tidak ada karyawan dengan kontrak habis untuk base {$base}.");
                        }
                    }
                } else {
                    log_message('info', 'Notifikasi tidak dikirim karena tidak ada penerima notifikasi.');
                }
            } else {
                log_message('info', 'Notifikasi tidak dikirim karena pengaturan notifikasi tidak aktif.');
            }

            // Push data to notifikas

            $dataKontrak = [];
            $adaKontrak  = false;

            // Ambil data kontrak habis per range
            foreach ($rangeHari as $hari) {
                $data = $this->mkaryawan->getKontrakHabis(date('Y-m-d', strtotime("+$hari days")));
                if ($data) {
                    $adaKontrak = true;
                    $dataKontrak[$hari] = $data;
                }
            }

            if ($adaKontrak) {
                // Buat pesan notifikasi
                $message  = '<div class="mb-7">';
                $message .= '<div class="fs-2 fw-bolder text-dark mb-3">Berikut daftar karyawan yang masa kontraknya akan segera habis:</div>';

                foreach ($dataKontrak as $hari => $items) {
                    $message .= '<div class="fs-2 fw-bolder text-gray-700 mb-3">Tanggal '
                        . tgl_indo(date('Y-m-d', strtotime("+$hari days"))) . ':</div>';
                    $message .= '<div class="text-gray-600 fw-bold fs-4"><ol>';
                    foreach ($items as $item) {
                        $message .= '<li>' . $item['user_nama_depan'] . ' ' . $item['user_nama_belakang'] . ' (' . $item['jabatan'] . ')</li>';
                    }
                    $message .= '</ol></div>';
                }
                $message .= '</div>';

                // log_message('debug', $message);
                log_message('info', "Input notifikasi.");

                $datanotif = json_encode(["message" => $message]);
                $input_notif = [
                    "kategori" => "notif_kontrak",
                    "target"   => "all",
                    "data"     => $datanotif,
                    "notif_by" => "system",
                ];
                $this->mnotifikasi->save($input_notif);
            }


            log_message('info', 'Cek kontrak karyawan selesai.');
        } catch (\Throwable $e) {
            log_message('error', 'ERROR: ' . $e->getMessage());
            log_message('error', $e->getTraceAsString());
        }
    }
}
