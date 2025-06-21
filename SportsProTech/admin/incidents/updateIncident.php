<?php
require_once __DIR__ . '/../../data/db.php';

include_once __DIR__ . '/../../views/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $stmt = $db->prepare("UPDATE incidents SET 
        customerID = :customerID,
        productCode = :productCode,
        techID = :techID,
        dateOpened = :dateOpened,
        dateClosed = :dateClosed,
        title = :title,
        description = :description
        WHERE incidentID = :incidentID");
    $stmt->execute([
        ':customerID' => $_POST['customerID'],
        ':productCode' => $_POST['productCode'],
        ':techID' => $_POST['techID'],
        ':dateOpened' => $_POST['dateOpened'],
        ':dateClosed' => $_POST['dateClosed'] ?: null,
        ':title' => $_POST['title'],
        ':description' => $_POST['description'],
        ':incidentID' => $_POST['incidentID'],
    ]);
    header("Location: incidentsManager.php");
    exit;
}
?>
