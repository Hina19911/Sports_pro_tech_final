<?php
require_once __DIR__ . '/../../data/db.php';
include_once __DIR__ . '/../../views/header.php';

// Get incident ID from query string
$incidentID = $_GET['edit'] ?? null;
$message = '';
$incident = null;

if ($incidentID) {
    // Fetch incident details
    $stmt = $db->prepare("SELECT * FROM incidents WHERE incidentID = ?");
    $stmt->execute([$incidentID]);
    $incident = $stmt->fetch();
}

// On form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assign'])) {
    $techID = $_POST['techID'];

    $update = $db->prepare("UPDATE incidents SET techID = ? WHERE incidentID = ?");
    $update->execute([$techID, $incidentID]);

    $message = "This incident was assigned to a technician.";

    // Re-fetch updated incident
    $stmt = $db->prepare("SELECT * FROM incidents WHERE incidentID = ?");
    $stmt->execute([$incidentID]);
    $incident = $stmt->fetch();
}
?>

<h2>Assign Incident</h2>

<?php if ($message): ?>
    <!-- Success View -->
    <div class="alert alert-success" role="alert">
        <?= $message ?>
    </div>
    <a href="tableIncidents.php">Select Another Incident</a>

<?php elseif ($incident): ?>
    <!-- Assign Form View -->
    <p><strong>Customer:</strong> <?= $incident['customerID'] ?></p>
    <p><strong>Product:</strong> <?= $incident['productCode'] ?></p>
    <p><strong>Title:</strong> <?= htmlspecialchars($incident['title']) ?></p>
    <p><strong>Description:</strong> <?= htmlspecialchars($incident['description']) ?></p>

    <?php
    // Get technicians list
    $techs = $db->query("SELECT * FROM technicians")->fetchAll();
    ?>

    <form method="post">
        <label for="techID">Assign to Technician:</label>
        <select name="techID" id="techID" required>
            <option value="">-- Select Technician --</option>
            <?php foreach ($techs as $tech): ?>
                <option value="<?= $tech['techID'] ?>">
                    <?= $tech['firstName'] . ' ' . $tech['lastName'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <button type="submit" name="assign">Assign Incident</button>
    </form>

<?php else: ?>
    <!-- Invalid incident ID -->
    <div class="alert alert-danger" role="alert">
        Incident not found.
    </div>
<?php endif; ?>
