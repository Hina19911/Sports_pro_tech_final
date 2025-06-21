<?php
require_once __DIR__ . '/../../data/db.php';

include_once __DIR__ . '/../../views/header.php';

$editIncident = null;
if (isset($_GET['edit'])) {
    $stmt = $db->prepare("SELECT * FROM incidents WHERE incidentID = ?");
    $stmt->execute([$_GET['edit']]);
    $editIncident = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
