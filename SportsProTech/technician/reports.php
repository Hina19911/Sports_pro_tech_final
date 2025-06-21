<?php
session_start();
require_once __DIR__ . '/../data/db.php';

$error = '';
$success = '';

// Optional: Simulate logged-in technician (replace with real login later)
$loggedInTechID = $_SESSION['techID'] ?? 1;  // Replace with real session ID

// Fetch dropdown data
$customers = $db->query("SELECT customerID, firstname, lastname FROM customers")->fetchAll(PDO::FETCH_ASSOC);
$products = $db->query("SELECT productCode, name FROM products")->fetchAll(PDO::FETCH_ASSOC);

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerID = $_POST['customerID'] ?? '';
    $productCode = $_POST['productCode'] ?? '';
    $dateOpened = $_POST['dateOpened'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';

    if ($customerID && $productCode && $dateOpened && $title && $description) {
        try {
            $stmt = $db->prepare("INSERT INTO incidents (customerID, productCode, techID, dateOpened, title, description)
                                  VALUES (:customerID, :productCode, :techID, :dateOpened, :title, :description)");
            $stmt->execute([
                ':customerID' => $customerID,
                ':productCode' => $productCode,
                ':techID' => $loggedInTechID,
                ':dateOpened' => $dateOpened,
                ':title' => $title,
                ':description' => $description
            ]);
            $success = "Incident report submitted.";
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
    <title>Technician Incident Report</title>
</head>
<body>
    <h1>Submit Incident Report</h1>

    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p style="color:green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Customer:
            <select name="customerID" required>
                <option value="">-- Select Customer --</option>
                <?php foreach ($customers as $c): ?>
                    <option value="<?= $c['customerID'] ?>">
                        <?= $c['customerID'] ?> - <?= $c['firstname'] ?> <?= $c['lastname'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br><br>

        <label>Product:
            <select name="productCode" required>
                <option value="">-- Select Product --</option>
                <?php foreach ($products as $p): ?>
                    <option value="<?= $p['productCode'] ?>">
                        <?= $p['productCode'] ?> - <?= $p['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br><br>

        <label>Date Opened:
            <input type="datetime-local" name="dateOpened" required>
        </label><br><br>

        <label>Title:
            <input type="text" name="title" required>
        </label><br><br>

        <label>Description:<br>
            <textarea name="description" rows="4" cols="60" required></textarea>
        </label><br><br>

        <input type="submit" value="Submit Report">
    </form>
</body>
</html>
