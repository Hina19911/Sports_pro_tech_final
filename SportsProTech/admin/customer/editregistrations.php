<<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../data/db.php';
include_once __DIR__ . '/../../views/header.php';

$code = $_GET['customerID'] ?? null;

if (!$code) {
    echo "No customer ID provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerID = $_POST['customerID'];
    $productCode = $_POST['productCode'];
    $registrationDate = $_POST['registrationDate'];

    $sql = 'UPDATE registrations SET productCode = ?, registrationDate = ? WHERE customerID = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$productCode, $registrationDate, $customerID]);

    header('Location: customertable.php');
    exit();
}

$stmt = $db->prepare('SELECT * FROM registrations WHERE customerID = ?');
$stmt->execute([$code]);
$registration = $stmt->fetch();

if (!$registration) {
    echo "Client not found.";
    exit();
}
?>

<h1>Edit Registration</h1>
<form method="post">
    <input type="hidden" name="customerID" value="<?= htmlspecialchars($registration['customerID']) ?>">
    Customer ID: <?= htmlspecialchars($registration['customerID']) ?><br>
    Product Code: <input type="text" name="productCode" value="<?= htmlspecialchars($registration['productCode']) ?>" required><br>
    Registration Date: <input type="date" name="registrationDate" value="<?= htmlspecialchars($registration['registrationDate']) ?>" required><br>
    <button type="submit">Update</button>
</form>
<a href="customertable.php">Back to Products</a>

<?php include_once __DIR__ . '/../../views/footer.php'; ?>
