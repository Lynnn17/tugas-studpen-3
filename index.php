<?php
require_once 'database.php'; 
require_once 'Gudang.php';    

$gudang = new Gudang($conn); 
$allGudang = $gudang->readGudang(); 

$search = isset($_GET['search']) ? $_GET['search'] : '';
$limit = 5; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;


$allGudang = $gudang->searchGudang($search, $limit, $offset);
$totalGudang = $gudang->countGudang($search); 
$totalPages = ceil($totalGudang / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-6">Daftar Gudang</h1>

        <form action="" method="GET" class="mb-4">
            <input type="text" name="search" placeholder="Cari gudang..." value="<?php echo htmlspecialchars($search); ?>" class="px-4 py-2 border border-gray-300 rounded" />
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Cari</button>
        </form>

      
        <a href="create.php" class="inline-block mb-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Input Gudang Baru</a>

        <table class="min-w-full border-collapse block md:table">
            <thead>
                <tr class="border border-gray-300 md:table-row">
                    <th class="p-2 md:border md:border-gray-300">ID</th>
                    <th class="p-2 md:border md:border-gray-300">Nama</th>
                    <th class="p-2 md:border md:border-gray-300">Lokasi</th>
                    <th class="p-2 md:border md:border-gray-300">Kapasitas</th>
                    <th class="p-2 md:border md:border-gray-300">Status</th>
                    <th class="p-2 md:border md:border-gray-300">Buka</th>
                    <th class="p-2 md:border md:border-gray-300">Tutup</th>
                    <th class="p-2 md:border md:border-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php if ($allGudang->num_rows > 0): ?>
                    <?php while ($row = $allGudang->fetch_assoc()): ?>
                        <tr class="border border-gray-300 md:table-row">
                            <td class="p-2 md:border md:border-gray-300"><?php echo $row['id']; ?></td>
                            <td class="p-2 md:border md:border-gray-300"><?php echo htmlspecialchars($row['name']); ?></td>
                            <td class="p-2 md:border md:border-gray-300"><?php echo htmlspecialchars($row['location']); ?></td>
                            <td class="p-2 md:border md:border-gray-300"><?php echo htmlspecialchars($row['capacity']); ?></td>
                            <td class="p-2 md:border md:border-gray-300"><?php echo htmlspecialchars($row['status']); ?></td>
                            <td class="p-2 md:border md:border-gray-300"><?php echo htmlspecialchars($row['opening_hour']); ?></td>
                            <td class="p-2 md:border md:border-gray-300"><?php echo htmlspecialchars($row['closing_hour']); ?></td>
                            <td class="p-2 md:border md:border-gray-300">
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="text-blue-500">Edit</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="text-red-500">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="p-2 md:border md:border-gray-300">Tidak ada data ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>


        <div class="mt-4">
    <ul class="flex justify-center space-x-2">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li>
                <a href="?search=<?php echo htmlspecialchars($search); ?>&page=<?php echo $i; ?>" class="px-4 py-2 border border-gray-300 <?php echo ($page == $i) ? 'bg-blue-500 text-white' : 'bg-white text-black'; ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</div>

    </div>
</body>
</html>
