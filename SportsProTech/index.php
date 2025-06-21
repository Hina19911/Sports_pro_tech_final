
<?php
session_start();
include 'views/header.php';
?>
<!--Added Bootstrap-->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card p-4 shadow-sm">
                <h2 class="mb-4 text-center">Login</h2>

                <form action="login_process.php" method="post" class="mb-3">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="admin/signup.php" class="btn btn-success">Sign Up</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="links-section">
    <div class="section">
        <h3>Administrator</h3>
        <a href="admin/login.php">Admin Login</a>
       <a href="admin/product/project_manager.php">Product Manager</a>
       <a href="admin/tech/techManager.php">Technician Manager</a>
        <a href="admin/incidents/incidentsManager.php">Incidents Manager</a>
        <a href="admin/customer/customerManager.php">Customer Manager</a>
         <a href="admin/customer/registrations.php">Customer Registration</a>
      
    </div>

    <div class="section">
        <h3>Technician</h3>
        <a href="technician/login.php">Technician Login</a>
        <a href="technician/reports.php">Technician Reports</a>
    </div>

    <div class="section">
        <h3>Customer</h3>
        <a href="customer/login.php">Customer Login</a>
     
    </div>
</div>

<?php include 'views/footer.php'; ?>
