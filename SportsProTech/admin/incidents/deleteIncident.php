<?php
require_once __DIR__ . '/../data/db.php';
include_once __DIR__ . '/../../views/header.php';

if (isset($_GET['delete'])) {
    $stmt = $db->prepare("DELETE FROM incidents WHERE incidentID = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: incidentsManager.php");
    exit;
}
?>
