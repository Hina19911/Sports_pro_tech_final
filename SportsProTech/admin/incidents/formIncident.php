<?php
require_once __DIR__ . '/../../data/db.php';
include_once __DIR__ . '/../../views/header.php';
require_once 'getIncident.php';
?>

<h2><?= $editIncident ? "Edit Incident #{$editIncident['incidentID']}" : "Add New Incident" ?></h2>
<form method="post" action="<?= $editIncident ? 'updateIncident.php' : 'addincidents.php' ?>">
    <?php if ($editIncident): ?>
        <input type="hidden" name="incidentID" value="<?= $editIncident['incidentID'] ?>">
        <input type="hidden" name="update" value="1">
    <?php else: ?>
        <input type="hidden" name="add" value="1">
    <?php endif; ?>

    Customer ID: <input name="customerID" value="<?= $editIncident['customerID'] ?? '' ?>" required><br>
    Product Code: <input name="productCode" value="<?= $editIncident['productCode'] ?? '' ?>" required><br>
    Tech ID: <input name="techID" type="number" required value="<?= $editIncident['techID'] ?? '' ?>"><br>
    Date Opened: <input type="datetime-local" name="dateOpened" value="<?= isset($editIncident['dateOpened']) ? str_replace(' ', 'T', $editIncident['dateOpened']) : '' ?>" required><br>
    Date Closed: <input type="datetime-local" name="dateClosed" value="<?= isset($editIncident['dateClosed']) ? str_replace(' ', 'T', $editIncident['dateClosed']) : '' ?>"><br>
    Title: <input name="title" value="<?= $editIncident['title'] ?? '' ?>" required><br>
    Description:<br><textarea name="description" rows="4" cols="60"><?= $editIncident['description'] ?? '' ?></textarea><br>
    <button type="submit"><?= $editIncident ? "Update" : "Add" ?></button>
    <?php if ($editIncident): ?>
        <a href="incidentsManager.php">Cancel Edit</a>
    <?php endif; ?>
</form>
