<?php
require_once 'Gudang.php';
require_once 'database.php'; 

if (!isset($_GET['id'])) {
    echo "ID gudang tidak tersedia.";
    exit;
}

$id = $_GET['id'];
$gudang = new Gudang($conn);
$currentGudang = $gudang->getGudangById($id); 

if (!$currentGudang) {
    echo "Gudang tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $status = $_POST['status'];
    $opening_hour = $_POST['opening_hour'];
    $closing_hour = $_POST['closing_hour'];

    $gudang->updateGudang($id, $name, $location, $capacity, $status, $opening_hour, $closing_hour);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto my-10">
        <h1 class="text-3xl font-bold text-center mb-5">Edit Gudang</h1>

        <div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
            <form action="edit.php?id=<?php echo $id; ?>" method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nama Gudang</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($currentGudang['name']); ?>" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div class="mb-4">
                    <label for="location" class="block text-gray-700">Lokasi</label>
                    <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($currentGudang['location']); ?>" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div class="mb-4">
                    <label for="capacity" class="block text-gray-700">Kapasitas</label>
                    <input type="number" id="capacity" name="capacity" value="<?php echo htmlspecialchars($currentGudang['capacity']); ?>" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <select id="status" name="status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <option value="aktif" <?php echo ($currentGudang['status'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                        <option value="tidak_aktif" <?php echo ($currentGudang['status'] == 'tidak_aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="opening_hour" class="block text-gray-700">Jam Buka</label>
                    <input type="time" id="opening_hour" name="opening_hour" value="<?php echo htmlspecialchars($currentGudang['opening_hour']); ?>" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div class="mb-4">
                    <label for="closing_hour" class="block text-gray-700">Jam Tutup</label>
                    <input type="time" id="closing_hour" name="closing_hour" value="<?php echo htmlspecialchars($currentGudang['closing_hour']); ?>" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div class="flex justify-between">
                    <a href="index.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
