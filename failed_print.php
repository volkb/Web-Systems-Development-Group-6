<?php require_once 'controllers/auth_controller.php';?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once 'style.php'?>
    <?php include_once 'controllers/email_controller.php'?>
    <?php include_once 'controllers/db_connector.php'?>
    <?php include_once 'controllers/functions.php'?>
    <?php include_once 'scripts.php'?>
    <meta charset="utf-8">
    <title>Edit User</title>
</head>

<body class="bg-secondary">

<div class="bg-secondary pt-3 p-2">
    <?php include'nav_bar.php';?>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card shadow-lg mt-5">
                <div class="card-body">
                    <h1 class="card-title text-center">Machine Lookup</h1>
                    <form id="get_info" action="controllers/email_controller.php" method="post">
                        <div class="form-group">
                            <label for="machine" id="machinelabel">Machine Type:</label>
                            <select name="machine" id="machine" required>
                                <?php generateMachineDropDown(1) ?>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
</body>
</html>

