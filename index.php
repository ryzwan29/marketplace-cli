<?php
require_once 'models/Product.php';
require_once 'models/LinkedList.php';
require_once 'models/Stack.php';
require_once 'models/PriorityQueue.php';
require_once 'models/AVLTree.php';
require_once 'models/Trie.php';
require_once 'models/HashTable.php';
require_once 'models/Heap.php';
require_once 'models/Graph.php';
require_once 'utils/sorting.php';
require_once 'utils/divide_conquer.php';

use Models\Product;

// Load & Save Produk
function loadProducts() {
    return json_decode(file_get_contents('data/sample_products.json'), true);
}
function saveProducts($products) {
    file_put_contents('data/sample_products.json', json_encode($products, JSON_PRETTY_PRINT));
}

// Inisialisasi
$productsData = loadProducts();
$hashTable = new Models\HashTable();
$avlTree = new Models\AVLTree();
$stack = new Models\Stack();
$trie = new Models\Trie();
$priorityQueue = new Models\PriorityQueue();
$heap = new Models\MaxHeap();
$graph = new Models\Graph();
$popularCount = [];
$searchHistoryCount = [];


// Isi struktur data
foreach ($productsData as $p) {
    $prod = new Product($p['id'], $p['name'], $p['category'], $p['rating'], $p['price']);
    $hashTable->insert($prod);
    $avlTree->root = $avlTree->insert($prod);
    $trie->insert(strtolower(str_replace(' ', '', $prod->name)));
    $priorityQueue->enqueue($prod);
    $heap->insert($prod);
    $graph->addProduct($prod);
    $popularCount[$prod->id] = 0;
}

// Menu Interaktif
while (true) {
    echo "\n";
    echo "############################################################\n";
    echo "#  _____                     _____ _                       #\n";
    echo "# |_   _|                   /  ___| |                      #\n";
    echo "#   | |_      ____ _ _ __   \\ `--.| |_ ___  _ __ ___       #\n";
    echo "#   | \\ \\ /\\ / / _` | '_ \\   `--. \\ __/ _ \\| '__/ _ \\      #\n";
    echo "#  _| |\\ V  V / (_| | | | | /\\__/ / || (_) | | |  __/      #\n";
    echo "#  \\___/\\_/\\_/ \\__,_|_| |_| \\____/ \\__\\___/|_|  \\___|      #\n";
    echo "#                                                          #\n";
    echo "# Selamat Datang di @IwanStore                             #\n";
    echo "# Created By: Rizwan Fairuz Mamduh                         #\n";
    echo "############################################################\n";
    echo "# 1. Cari Produk                                           #\n";
    echo "# 2. Tambah Produk                                         #\n";
    echo "# 3. Hapus Produk                                          #\n";
    echo "# 4. Lihat Top-5 Produk                                    #\n";
    echo "# 5. Riwayat Pencarian                                     #\n";
    echo "# 6. Cari Produk by ID                                     #\n";
    echo "# 7. Lihat Semua Produk                                    #\n";
    echo "# 8. Keluar                                                #\n";
    echo "# Pilih menu:                                              #\n";
    echo "############################################################\n";
    echo "> ";
    $pilihan = trim(fgets(STDIN));


    switch ($pilihan) {
        case '1':
            echo "🔍 Prefix produk: ";
            $prefix = trim(fgets(STDIN));
            $key = strtolower(str_replace(' ', '', $prefix));

            $kategori = null;
            $results = [];

            foreach ($productsData as $p) {
                $match = strtolower(str_replace(' ', '', $p['name']));
                if (str_contains($match, $key)) {
                    $results[] = $p;
                    $popularCount[$p['id']]++;
                    $stack->push(new Product($p['id'], $p['name'], $p['category'], $p['rating'], $p['price']));

            // ✅ Tambah counter history permanen
                    if (!isset($searchHistoryCount[$p['id']])) {
                        $searchHistoryCount[$p['id']] = ['product' => $p, 'count' => 0];
                    }
                    $searchHistoryCount[$p['id']]['count']++;

                    $kategori = $p['category'];
                }
            }

            if (count($results) > 0) {
                echo "\n📦 Hasil pencarian:\n";
                echo "----------------------------------------------------------------------------\n";
                echo "| No. | ID  | Nama Produk                    | Rating | Harga        | Dicari |\n";
                echo "----------------------------------------------------------------------------\n";
                $i = 1;
                foreach ($results as $p) {
                    printf(
                        "| %-3s | %-3s | %-30s | %-6.2f | %-12s | %-6s |\n",
                        $i++,
                        $p['id'],
                        substr($p['name'], 0, 30),
                        $p['rating'],
                        'Rp' . number_format($p['price'], 0, ',', '.'),
                        $popularCount[$p['id']] . 'x'
                    );
                }
                echo "----------------------------------------------------------------------------\n";
            } else {
                echo "\n❌ Tidak ditemukan produk yang cocok dengan \"$prefix\"\n";
            }

            // Rekomendasi tabel
            if ($kategori) {
                $rekomendasi = array_filter($productsData, function($p) use ($kategori, $key) {
                    return $p['category'] === $kategori && !str_contains(strtolower(str_replace(' ', '', $p['name'])), $key);
                });

                if (count($rekomendasi) > 0) {
                    echo "\n💡 Rekomendasi dari kategori $kategori:\n";
                    echo "----------------------------------------------------------------------------\n";
                    echo "| No. | ID  | Nama Produk                    | Rating | Harga        |\n";
                    echo "----------------------------------------------------------------------------\n";
                    $j = 1;
                    foreach ($rekomendasi as $p) {
                        printf(
                            "| %-3s | %-3s | %-30s | %-6.2f | %-12s |\n",
                            $j++,
                            $p['id'],
                            substr($p['name'], 0, 30),
                            $p['rating'],
                            'Rp' . number_format($p['price'], 0, ',', '.')
                        );
                 }
                    echo "----------------------------------------------------------------------------\n";
                }
            }
            break;

        case '2':
            echo "➕ Tambah Produk Baru\n";
            echo "ID: "; $id = intval(trim(fgets(STDIN)));
            echo "Nama: "; $name = trim(fgets(STDIN));
            echo "Kategori: "; $cat = trim(fgets(STDIN));
            echo "Rating: "; $rate = floatval(trim(fgets(STDIN)));
            echo "Harga: "; $price = intval(trim(fgets(STDIN)));

            $new = new Product($id, $name, $cat, $rate, $price);
            $productsData[] = ['id' => $id, 'name' => $name, 'category' => $cat, 'rating' => $rate, 'price' => $price];
            saveProducts($productsData);

            $hashTable->insert($new);
            $avlTree->insert($new);
            $trie->insert(strtolower(str_replace(' ', '', $name)));
            $priorityQueue->enqueue($new);
            $heap->insert($new);
            $graph->addProduct($new);
            $popularCount[$id] = 0;

            echo "✅ Produk ditambahkan!\n";
            break;

        case '3':
            echo "❌ Hapus Produk (ID): ";
            $did = intval(trim(fgets(STDIN)));
            $productsData = array_values(array_filter($productsData, fn($p) => $p['id'] !== $did));
            saveProducts($productsData);
            echo "✅ Produk ID $did dihapus (perlu reload manual struktur data).\n";
            break;

        case '4':
            echo "🔥 Top-5 Produk Terpopuler:\n";
            usort($productsData, fn($a, $b) => ($popularCount[$b['id']] ?? 0) <=> ($popularCount[$a['id']] ?? 0) ?: $b['rating'] <=> $a['rating']);

            echo str_repeat('-', 80) . "\n";
            printf("| %-3s | %-3s | %-30s | %-6s | %-12s | %-6s |\n", 'No.', 'ID', 'Nama Produk', 'Rating', 'Harga', 'Dicari');
            echo str_repeat('-', 80) . "\n";

            for ($i = 0; $i < min(5, count($productsData)); $i++) {
                $p = $productsData[$i];
                printf(
                    "| %-3d | %-3d | %-30s | %-6.2f | Rp%-10s | %-6s |\n",
                    $i + 1,
                    $p['id'],
                    mb_strimwidth($p['name'], 0, 30, "..."),
                    $p['rating'],
                    number_format($p['price']),
                    ($popularCount[$p['id']] ?? 0) . "x"
                );
            }
            echo str_repeat('-', 80) . "\n";
            break;

        case '5':
            echo "🕘 Riwayat Pencarian Terakhir:\n";
            if (count($searchHistoryCount) === 0) {
                echo "❌ Belum ada pencarian.\n";
                break;
            }

            // Urutkan berdasarkan count
            $sortedHistory = $searchHistoryCount;
            usort($sortedHistory, fn($a, $b) => $b['count'] <=> $a['count']);
            echo "----------------------------------------------------------------------------------------\n";
            echo "| No. | ID  | Nama Produk                    | Rating | Harga        | Dicari         |\n";
            echo "----------------------------------------------------------------------------------------\n";
            $i = 1;
            foreach ($sortedHistory as $entry) {
                $p = $entry['product'];
                $count = $entry['count'];
                printf(
                    "| %-3s | %-3s | %-30s | %-6.2f | %-12s | %-13s |\n",
                    $i++,
                    $p['id'],
                    substr($p['name'], 0, 30),
                    $p['rating'],
                    'Rp' . number_format($p['price'], 0, ',', '.'),
                    $count . 'x'
                );
            }
            echo "----------------------------------------------------------------------------------------\n";
            break;

        case '6':
            echo "🔎 Cari Produk by ID: ";
            $id = intval(trim(fgets(STDIN)));
            $result = $avlTree->search($id);
            if ($result) {
                echo "✅ {$result->name} | Rating: {$result->rating}\n";
                $stack->push($result); // ✅ masukin ke riwayat
            } else {
                echo "❌ Produk dengan ID $id tidak ditemukan.\n";
            }
            break;

        case '7':
            echo "📊 Urutkan Berdasarkan: 1. Rating | 2. Harga\n";
            $opt = trim(fgets(STDIN));
            $key = $opt === '2' ? 'price' : 'rating';
            $sorted = mergeSortBy($productsData, $key, false);

            echo str_repeat('-', 80) . "\n";
            printf("| %-3s | %-3s | %-30s | %-6s | %-12s | %-6s |\n", 'No.', 'ID', 'Nama Produk', 'Rating', 'Harga', 'Dicari');
            echo str_repeat('-', 80) . "\n";

            foreach ($sorted as $i => $p) {
                printf(
                    "| %-3d | %-3d | %-30s | %-6.2f | Rp%-10s | %-6s |\n",
                    $i + 1,
                    $p['id'],
                    mb_strimwidth($p['name'], 0, 30, "..."),
                    $p['rating'],
                    number_format($p['price']),
                    ($popularCount[$p['id']] ?? 0) . "x"
                );
            }
            echo str_repeat('-', 80) . "\n";
            break;

        case '8':
            echo "👋 Keluar...\n";
            exit;

        default:
            echo "❌ Pilihan tidak valid\n";
    }
}
