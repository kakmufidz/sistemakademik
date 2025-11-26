function formatRupiah(value) {
    // Konversi input ke float (jika memungkinkan)
    const number = parseFloat(value);
    if (isNaN(number)) {
        return "Input tidak valid";
    }

    // Pisahkan bilangan menjadi bagian utuh dan desimal
    const [whole, decimal] = number.toString().split(".");

    // Format bagian utuh dengan pemisah ribuan
    const formattedWhole = whole.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Jika ada bagian desimal, ambil maksimal 2 angka, dan hapus jika 0
    const formattedDecimal = decimal && decimal.slice(0, 2) !== "00" ? `,${decimal.slice(0, 2)}` : "";

    // Gabungkan bagian utuh dan desimal jika ada
    return `Rp. ${formattedWhole}${formattedDecimal}`;
}


function tglIndo(tanggal) {
    // Array bulan dalam bahasa Indonesia
    var bulan = [
        "", // Placeholder untuk indeks ke-0
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    // Pecahkan tanggal menjadi array [tahun, bulan, tanggal]
    var pecahkan = tanggal.split('-');

    // Ambil bagian tanggal, bulan, dan tahun
    var tahun = pecahkan[0];
    var bulanIndex = parseInt(pecahkan[1], 10); // Bulan di array mulai dari 1
    var tanggalHari = pecahkan[2];

    // Formatkan menjadi "tanggal bulan tahun"
    return tanggalHari + ' ' + bulan[bulanIndex] + ' ' + tahun;
}

// Fungsi untuk mendapatkan nilai parameter dari URL
function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    const regex = new RegExp(`[?&]${name}(=([^&#]*)|&|#|$)`),
          results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function hitungProsentase(target, omset) {
    target = parseFloat(target);
    omset = parseFloat(omset);
    if (isNaN(target) || isNaN(omset)) {
        console.error("Invalid target or omset:", { target, omset });
        return null;
    }
    if (target<omset) {
        return 100;
    } else {
        return ((omset / target) * 100).toFixed(2);
    }
}