<?php
include 'database.php';
include 'Gudang.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $gudang = new Gudang($conn);
    $gudang->deleteGudang($id);
}

header("Location: index.php");
