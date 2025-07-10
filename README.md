# Tugas Kuliah - Semester 2 - Struktur Data dan Algoritma

## 📚 Deskripsi Proyek
Proyek ini merupakan tugas akhir mata kuliah **Struktur Data dan Algoritma** yang bertujuan untuk membangun sistem **Marketplace CLI Sederhana** menggunakan bahasa pemrograman **PHP Native**, tanpa framework dan tanpa database eksternal. Seluruh data produk disimpan dalam file JSON (`sample_products.json`) dan dimuat ke dalam berbagai struktur data untuk mendemonstrasikan implementasi dan manfaat Abstract Data Types (ADT) dalam sistem pencarian dan rekomendasi produk.

## 🎯 Tujuan
- Menerapkan berbagai struktur data seperti Trie, Stack, Graph, Hash Table, AVL Tree, Priority Queue, Heap, dan Divide & Conquer secara nyata dalam sistem pencarian produk.
- Membuat sistem pencarian, rekomendasi, penyimpanan, serta analisis produk yang efisien.
- Mengintegrasikan logika algoritmik dan efisiensi pencarian ke dalam sistem berbasis teks (CLI).

## 🛠️ Fitur Utama
Berikut adalah fitur-fitur yang telah diimplementasikan:

### 1. 🔍 **Pencarian Produk dengan Autocomplete**
- Menggunakan struktur data **Trie**.
- Pencarian berbasis prefix nama produk.
- Menampilkan hasil pencarian dan menambahkan ke **stack riwayat**.

### 2. ➕ **Tambah Produk**
- Menambahkan produk baru ke file JSON dan seluruh struktur data (AVL Tree, HashTable, Trie, dsb).

### 3. ❌ **Hapus Produk**
- Menghapus produk berdasarkan ID.

### 4. 🔥 **Top-5 Produk Terpopuler**
- Menggunakan **Priority Queue / Heap** berdasarkan kombinasi **jumlah pencarian (popularCount)** dan **rating**.

### 5. 🕘 **Riwayat Pencarian**
- Menampilkan produk-produk yang paling sering dicari menggunakan **Stack** dan dicatat ke dalam struktur **HashMap dengan Counter**.

### 6. 🔎 **Pencarian Produk Berdasarkan ID**
- Menggunakan struktur **AVL Tree** untuk pencarian cepat dan efisien berdasarkan ID produk.

### 7. 📊 **Lihat Semua Produk dengan Sorting Dinamis**
- Menggunakan algoritma **Merge Sort** berbasis Divide & Conquer.
- Dapat mengurutkan produk berdasarkan **rating** atau **harga**.

### 8. 💡 **Rekomendasi Produk**
- Menggunakan struktur **Graph (BFS)** untuk menampilkan produk lain dari kategori yang sama tapi berbeda nama.

### 9. 💾 **Penyimpanan Data**
- Seluruh data produk disimpan di `data/sample_products.json` dalam format JSON agar mudah dibaca dan diubah.

## 🧠 Struktur Data yang Digunakan
| Struktur Data      | Kegunaan                                                                 |
|--------------------|--------------------------------------------------------------------------|
| `Trie`             | Autocomplete dan pencarian cepat berdasarkan prefix nama produk         |
| `AVL Tree`         | Pencarian produk cepat berdasarkan ID                                   |
| `Hash Table`       | Penyimpanan produk berdasarkan ID unik                                  |
| `Priority Queue`   | Menentukan produk terpopuler berdasarkan pencarian dan rating           |
| `Max Heap`         | Mendukung fitur top-5 produk terpopuler                                 |
| `Stack`            | Menyimpan riwayat pencarian terakhir                                    |
| `Graph (BFS)`      | Rekomendasi produk dari kategori yang sama                              |
| `Merge Sort`       | Sorting dinamis berdasarkan harga atau rating                           |

## 💼 Kegunaan
Sistem ini dapat digunakan sebagai:
- Simulasi sistem rekomendasi dan pencarian produk pada e-commerce sederhana.
- Latihan implementasi ADT dan algoritma sorting/searching di dunia nyata.
- Alat bantu pembelajaran untuk memahami cara kerja internal dari struktur data yang umum.

## 👨‍💻 Dibuat oleh
Rizwan Fairuz Mamduh  
Program Studi: Teknik Informatika

## 📁 Struktur Folder
```
📦 root
┣ 📜 index.php
┣ 📂 data
┃ ┗ 📜 sample_products.json
┣ 📂 models
┃ ┣ 📜 Product.php
┃ ┣ 📜 AVLTree.php
┃ ┣ 📜 Stack.php
┃ ┣ 📜 HashTable.php
┃ ┣ 📜 Trie.php
┃ ┣ 📜 Heap.php
┃ ┣ 📜 PriorityQueue.php
┃ ┣ 📜 Graph.php
┣ 📂 utils
┃ ┣ 📜 sorting.php
┃ ┗ 📜 divide_conquer.php
┗ 📂 docs
  ┗ dokumentasi.pdf
```
