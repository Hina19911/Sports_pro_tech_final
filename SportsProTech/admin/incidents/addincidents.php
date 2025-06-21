<?php
require_once __DIR__ . '/../../data/db.php';
include_once __DIR__ . '/../../views/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {

    // Safely handle techID (must be an integer or null)
    $techID = isset($_POST['techID']) && is_numeric($_POST['techID']) ? (int) $_POST['techID'] : null;

    try {
        $stmt = $db->prepare("INSERT INTO incidents 
            (customerID, productCode, techID, dateOpened, dateClosed, title, description)
            VALUES (:customerID, :productCode, :techID, :dateOpened, :dateClosed, :title, :description)");

        $stmt->execute([
            ':customerID' => $_POST['customerID'],
            ':productCode' => $_POST['productCode'],
            ':techID' => $techID,
            ':dateOpened' => $_POST['dateOpened'],
            ':dateClosed' => $_POST['dateClosed'] ?: null,
            ':title' => $_POST['title'],
            ':description' => $_POST['description'],
        ]);

        // Redirect on success
        header("Location: incidentsManager.php");
        exit;

    } catch (PDOException $e) {
        echo "<p style='color:red;'>Error adding incident: " . $e->getMessage() . "</p>";
    }
}
?>
