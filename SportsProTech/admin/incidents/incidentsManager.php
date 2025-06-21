<?php
ini_set('display_errors', 1); // Show PHP errors
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../data/db.php';
include_once __DIR__ . '/../../views/header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Incident Manager (Admin)</title>
</head>
<body>
    <h1>Incident Manager (Admin)</h1>

    <!-- FILTER FORM -->
    <form method="get">
        <strong>Filter:</strong>
        Customer ID: <input name="filter_customer" value="<?= $_GET['filter_customer'] ?? '' ?>">
        Product Code: <input name="filter_product" value="<?= $_GET['filter_product'] ?? '' ?>">
        <button type="submit">Search</button>
        <a href="incidentsManager.php">Clear</a>
    </form>
    <hr>

    <!-- FORM -->
    <?php include 'formIncident.php'; ?>

    <hr>

    <!-- INCIDENT TABLE -->
    <?php include 'tableIncidents.php'; ?>
</body>
</html>

