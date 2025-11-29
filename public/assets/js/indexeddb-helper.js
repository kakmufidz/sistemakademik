// --- IndexedDB Helper ---
const DB_NAME = "smartcrm";
let DB_VERSION = 1;

const STORE_CONFIG = {
  sales_target: { keyPath: "id"},
  omset: { keyPath: "id"},
  chartomset: { keyPath: "id"},
  sales_retur: { keyPath: "id"},
  customers: { keyPath: "id" }, // ✅ customer disimpan berdasarkan customerNo
  sales_customers: { keyPath: "id" }, // ✅ customer disimpan berdasarkan customerNo
  kunjungan_customer: { keyPath: "id" },
  pending_kunjungan: { keyPath: "id", autoIncrement: true},
  user: { keyPath: "id"},
};

// cek perbedaan store di browser dengan STORE_CONFIG
async function detectDBVersion() {
  return new Promise((resolve) => {
    const req = indexedDB.open(DB_NAME);

    req.onsuccess = function (e) {
      const db = e.target.result;
      let needUpgrade = false;

      // cek ada store lama yg ga ada di config
      for (let i = 0; i < db.objectStoreNames.length; i++) {
        const name = db.objectStoreNames[i];
        if (!STORE_CONFIG[name]) {
          needUpgrade = true;
          break;
        }
      }

      // cek ada store baru di config tapi belum ada di DB
      for (const name of Object.keys(STORE_CONFIG)) {
        if (!db.objectStoreNames.contains(name)) {
          needUpgrade = true;
          break;
        }
      }

      const newVersion = needUpgrade ? db.version + 1 : db.version;
      db.close();
      resolve(newVersion);
    };

    req.onerror = function () {
      resolve(DB_VERSION); // fallback
    };

    req.onupgradeneeded = function (e) {
      // kalau DB belum ada sama sekali
      const db = e.target.result;
      for (const [name, options] of Object.entries(STORE_CONFIG)) {
        if (!db.objectStoreNames.contains(name)) {
          db.createObjectStore(name, options);
        }
      }
    };
  });
}

// buka database (versi otomatis)
async function openDB() {
  DB_VERSION = await detectDBVersion();

  return new Promise((resolve, reject) => {
    const request = indexedDB.open(DB_NAME, DB_VERSION);

    request.onupgradeneeded = function (e) {
      const db = e.target.result;

      // hapus store lama
      for (let i = 0; i < db.objectStoreNames.length; i++) {
        const name = db.objectStoreNames[i];
        if (!STORE_CONFIG[name]) {
          console.log(`Hapus store lama: ${name}`);
          db.deleteObjectStore(name);
        }
      }

      // buat store baru
      for (const [name, options] of Object.entries(STORE_CONFIG)) {
        if (!db.objectStoreNames.contains(name)) {
          console.log(`Buat store baru: ${name}`);
          db.createObjectStore(name, options);
        }
      }
    };

    request.onsuccess = (e) => resolve(e.target.result);
    request.onerror = (e) => reject("DB error: " + e.target.error);
  });
}

// --- CRUD Functions ---

// Tambah data baru (insert only)
async function addToDB(storeName, data) {
  const db = await openDB();
  return new Promise((resolve, reject) => {
    try {
      if (!db.objectStoreNames.contains(storeName)) {
        reject(`Store '${storeName}' tidak ada di DB`);
        return;
      }
      const tx = db.transaction(storeName, "readwrite");
      const store = tx.objectStore(storeName);
      const req = store.add(data);

      req.onsuccess = () => resolve(req.result); // return id baru
      req.onerror = e => reject(`Gagal tambah ke ${storeName}: ${e.target.error}`);
    } catch (err) {
      reject(err);
    }
  });
}

// Update / insert data (replace kalau ada id)
async function putDB(storeName, data) {
  const db = await openDB();
  return new Promise((resolve, reject) => {
    try {
      if (!db.objectStoreNames.contains(storeName)) {
        reject(`Store '${storeName}' tidak ada di DB`);
        return;
      }
      const tx = db.transaction(storeName, "readwrite");
      const store = tx.objectStore(storeName);
      const req = store.put(data);

      req.onsuccess = () => resolve(req.result);
      req.onerror = e => reject(`Gagal update ke ${storeName}: ${e.target.error}`);
    } catch (err) {
      reject(err);
    }
  });
}

// Ambil data by ID
async function getFromDB(storeName, id) {
  const db = await openDB();
  return new Promise((resolve, reject) => {
    try {
      if (!db.objectStoreNames.contains(storeName)) {
        reject(`Store '${storeName}' tidak ada di DB`);
        return;
      }
      const req = db.transaction(storeName, "readonly").objectStore(storeName).get(id);
      req.onsuccess = () => resolve(req.result || null);
      req.onerror = e => reject(`Gagal ambil dari ${storeName}: ${e.target.error}`);
    } catch (err) {
      reject(err);
    }
  });
}

// Ambil semua data
async function getAllFromDB(storeName) {
  const db = await openDB();
  return new Promise((resolve, reject) => {
    try {
      if (!db.objectStoreNames.contains(storeName)) {
        reject(`Store '${storeName}' tidak ada di DB`);
        return;
      }
      const req = db.transaction(storeName, "readonly").objectStore(storeName).getAll();
      req.onsuccess = () => resolve(req.result || []);
      req.onerror = e => reject(`Gagal ambil semua dari ${storeName}: ${e.target.error}`);
    } catch (err) {
      reject(err);
    }
  });
}

// Hapus data by ID
async function deleteFromDB(storeName, id) {
  const db = await openDB();
  return new Promise((resolve, reject) => {
    try {
      if (!db.objectStoreNames.contains(storeName)) {
        reject(`Store '${storeName}' tidak ada di DB`);
        return;
      }
      const tx = db.transaction(storeName, "readwrite");
      const store = tx.objectStore(storeName);
      const req = store.delete(id);
      req.onsuccess = () => resolve(true);
      req.onerror = e => reject(`Gagal hapus dari ${storeName}: ${e.target.error}`);
    } catch (err) {
      reject(err);
    }
  });
}

// Hapus data semua
async function clearDB(storeName) {
  const db = await openDB();
  return new Promise((resolve, reject) => {
    try {
      if (!db.objectStoreNames.contains(storeName)) {
        reject(`Store '${storeName}' tidak ada di DB`);
        return;
      }
      const tx = db.transaction(storeName, "readwrite");
      const store = tx.objectStore(storeName);
      const req = store.clear();
      req.onsuccess = () => resolve(true);
      req.onerror = e => reject(`Gagal clear ${storeName}: ${e.target.error}`);
    } catch (err) {
      reject(err);
    }
  });
}

