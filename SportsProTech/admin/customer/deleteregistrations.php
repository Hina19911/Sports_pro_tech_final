<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../data/db.php';
include_once __DIR__ . '/../../views/header.php';

if (isset($_GET['delete'])) {
    $stmt = $db->prepare("DELETE FROM registrations WHERE customerID = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: customertable.php");
    exit;
}
?>
