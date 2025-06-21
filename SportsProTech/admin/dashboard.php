<?php
session_start();
include_once __DIR__ . '/../../data/db.php';
include_once __DIR__ . '/../views/header.php';

// Optionally check if user is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}
?>
<div class="d-flex justify-content-between mb-4">
    <a href="../../index.php" class="btn btn-secondary">Home</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<div class="container mt-5">
    <h2 class="text-center mb-4">Admin Dashboard</h2>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Product Manager</h5>
                    <a href="product/project_manager.php" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Technician Manager</h5>
                    <a href="tech/techManager.php" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Incident Manager</h5>
                    <a href="incidents/incidentsManager.php" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Customer Manager</h5>
                    <a href="customer/customerManager.php" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Customer Registration</h5>
                    <a href="customer/registrations.php" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>
    </div>
</div>
