<?php
include 'Gudang.php';
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $opening_hour = $_POST['opening_hour'];
    $closing_hour = $_POST['closing_hour'];

    $gudang = new Gudang($conn);
    $gudang->createGudang($name, $location, $capacity, $opening_hour, $closing_hour);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto my-10">
        <h1 class="text-3xl font-bold text-center mb-5">Tambah Gudang Baru</h1>

        <div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
            <form action="" method="POST"> 
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nama Gudang</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                </div>

                <div class="mb-4">
                    <label for="location" class="block text-gray-700">Lokasi</label>
                    <input type="text" id="location" name="location" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                </div>

                <div class="mb-4">
                    <label for="capacity" class="block text-gray-700">Kapasitas</label>
                    <input type="number" id="capacity" name="capacity" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                </div>

                <div class="mb-4">
                    <label for="opening_hour" class="block text-gray-700">Jam Buka</label>
                    <input type="time" id="opening_hour" name="opening_hour" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                </div>

                <div class="mb-4">
                    <label for="closing_hour" class="block text-gray-700">Jam Tutup</label>
                    <input type="time" id="closing_hour" name="closing_hour" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                </div>

                <div class="flex justify-between">
                    <a href="index.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
