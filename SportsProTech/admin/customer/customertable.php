<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../data/db.php';
include_once __DIR__ . '/../../views/header.php';

// ✅ Initialize variables BEFORE using them
$where = [];
$params = [];

$sql = "SELECT * FROM registrations";
if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY registrationDate DESC"; // Make sure this column exists in your DB

$stmt = $db->prepare($sql);
$stmt->execute($params);

// ✅ Use consistent variable name
$registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Product Management</h2>

<h2>Customer Registration</h2>
<p><a href="registrations.php">➕ Add New Registration</a></p>
<table cellpadding="6" cellspacing="0">
    <tr>
        <th>Customer ID</th><th>Product Code</th><th>Date</th><th>Actions</th>
    </tr>
    <?php foreach ($registrations as $i): ?>
        <tr>
            <td><?= htmlspecialchars($i['customerID']) ?></td>
            <td><?= htmlspecialchars($i['productCode']) ?></td>
            <td><?= htmlspecialchars($i['registrationDate']) ?></td>
            <td>
                <a href="editregistrations.php?customerID=<?= urlencode($i['customerID']) ?>">Edit</a>

                <a href="deleteregistrations.php?delete=<?= urlencode($i['customerID']) ?>" onclick="return confirm('Delete this incident?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>




