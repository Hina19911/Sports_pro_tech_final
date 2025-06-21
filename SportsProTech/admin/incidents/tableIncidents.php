<?php
require_once __DIR__ . '/../../data/db.php';

include_once __DIR__ . '/../../views/header.php';
require_once 'listIncidents.php';
?>

<h2>All Incidents</h2>
<table cellpadding="6" cellspacing="0">
    <tr>
        <th>ID</th><th>Customer</th><th>Product</th><th>Tech</th>
        <th>Opened</th><th>Closed</th><th>Title</th><th>Description</th><th>Actions</th>
    </tr>
    <?php foreach ($incidents as $i): ?>
        <tr>
            <td><?= $i['incidentID'] ?></td>
            <td><?= $i['customerID'] ?></td>
            <td><?= $i['productCode'] ?></td>
            <td><?= $i['techID'] ?></td>
            <td><?= $i['dateOpened'] ?></td>
            <td><?= $i['dateClosed'] ?></td>
            <td><?= htmlspecialchars($i['title']) ?></td>
            <td><?= htmlspecialchars($i['description']) ?></td>
            <td>
            <a href="assignincidentspart2.php?edit=<?= $i['incidentID'] ?>">Assign</a> 
                <a href="incidentsManager.php?edit=<?= $i['incidentID'] ?>">Edit</a> 
                <a href="deleteIncident.php?delete=<?= $i['incidentID'] ?>" onclick="return confirm('Delete this incident?')">Delete</a>
   
            </td>
        </tr>
    <?php endforeach; ?>
</table>
