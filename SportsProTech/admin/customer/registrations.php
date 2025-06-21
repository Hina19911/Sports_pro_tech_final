<?php
ini_set('display_errors', 1); // Show PHP errors
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../data/db.php';

$error = '';
$success = '';

// Fetch customers and products for dropdowns
$customers = $db->query("SELECT customerID FROM customers")->fetchAll(PDO::FETCH_ASSOC);
$products = $db->query("SELECT productCode FROM products")->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerID = $_POST['customerID'] ?? '';
    $productCode = $_POST['productCode'] ?? '';
    $registrationDate = $_POST['registrationDate'] ?? '';

    if ($customerID && $productCode && $registrationDate) {
        try {
            $query = "INSERT INTO registrations (customerID, productCode, registrationDate)
                      VALUES (:customerID, :productCode, :registrationDate)";
            $stmt = $db->prepare($query);
            $stmt->execute([
    ':customerID' => $customerID,
    ':productCode' => $productCode,
    ':registrationDate' => $registrationDate
]);

            $success = "Product registered successfully!";
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Product</title>
</head>
<body>
    <h1>Register Product</h1>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Customer ID:
            <select name="customerID" required>
                <option value="">-- Select Customer --</option>
                <?php foreach ($customers as $customer): ?>
                    <option value="<?= htmlspecialchars($customer['customerID']) ?>">
                        <?= htmlspecialchars($customer['customerID']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br><br>

        <label>Product Code:
            <select name="productCode" required>
                <option value="">-- Select Product --</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?= htmlspecialchars($product['productCode']) ?>">
                        <?= htmlspecialchars($product['productCode']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br><br>

        <label>Registration Date:
            <input type="date" name="registrationDate" required>
        </label><br><br>

        <input type="submit" value="Register Product">
    </form>
</body>
</html>
