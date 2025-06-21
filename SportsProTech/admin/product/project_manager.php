<?php
require_once __DIR__ . '/../../data/db.php';
include_once __DIR__ . '/../../views/header.php';

// Fetch products
$query = $db->query('SELECT * FROM products ORDER BY name');
$products = $query->fetchAll();
?>

<h2>Product Management</h2>
<p><a href="addProducts.php">➕ Add New Product</a></p>

<table cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
    <tr style="background-color:#f2f2f2;">
        <th>Code</th>
        <th>Name</th>
        <th>Version</th>
        <th>Release Date</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($products as $product): ?>
    <tr>
        <td><?= htmlspecialchars($product['productCode']) ?></td>
        <td><?= htmlspecialchars($product['name']) ?></td>
        <td><?= htmlspecialchars($product['version']) ?></td>
        <td><?= htmlspecialchars($product['releaseDate']) ?></td>
        <td>
            <a href="edit.php?productCode=<?= urlencode($product['productCode']) ?>">✏️ Edit</a> |
            <a href="delete.php?productCode=<?= urlencode($product['productCode']) ?>" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include_once __DIR__ . '/../../views/footer.php'; ?>



