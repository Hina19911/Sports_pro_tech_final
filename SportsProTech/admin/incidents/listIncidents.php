<?php
require_once __DIR__ . '/../../data/db.php';

include_once __DIR__ . '/../../views/header.php';

$where = [];
$params = [];

if (!empty($_GET['filter_customer'])) {
    $where[] = "customerID = :customerID";
    $params[':customerID'] = $_GET['filter_customer'];
}
if (!empty($_GET['filter_product'])) {
    $where[] = "productCode = :productCode";
    $params[':productCode'] = $_GET['filter_product'];
}

$sql = "SELECT * FROM incidents";
if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY dateOpened DESC";

$stmt = $db->prepare($sql);
$stmt->execute($params);
$incidents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
