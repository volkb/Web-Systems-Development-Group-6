<!doctype html>
<html class="no-js bg-light" lang="">

<head>
    <?php include_once 'controllers/functions.php';?>
    <?php include_once 'controllers/auth_controller.php';?>
    <?php include_once "controllers/db_connector.php";?>
    <?php include_once 'style.php';?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->
    <title>Machine Maintenance</title>
</head>

<body class="bg-secondary">

<div class="bg-secondary pt-3 p-2">
    <?php include 'nav_bar.php';?>
</div>
<!-- Machine Lookup -->
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card shadow-lg mt-5">
                <div class="card-body">
                    <h1 class="card-title text-center">Machine Lookup</h1>
                    <form id="get_info">
                        <div class="form-group">
                            <select class="custom-select" name="machine" id="machine" required>
                                <option disabled selected class="text-secondary">Select A Machine to Edit</option>
                                <?php generateTotalMachineDropDown()?>
                            </select>
                        </div>
                        <span class="text-center">
                            <button class="btn btn-success btn-clock text-uppercase" type="submit" name="Submit">Lookup</button>
                            <a class="btn  btn-clock text-uppercase float-right text-white" role="button" style="background-color: #6f42c1" id="addMachineBtn">Add a Machine</a>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Machine Lookup -->

<!-- Add Machine -->
<div class="container d-none" id="addMachineFrm">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card shadow-lg my-3">
                <div class="card-body">
                    <h1 class="card-title text-center">Add A Machine</h1>
                    <form action="controllers/add_hardware_controller.php" method="post">
                        <div class="form-group">
                            <input type="text" id="addMachineName" class="form-control" name="addMachineName" placeholder="Machine Name" required/>
                        </div>

                        <div class="form-group">
                            <label>Filament Status: </label>
                            <select class="custom-select" name="usesPlastic" id="usesPlastic" required>
                                <option disabled selected class="text-secondary" id="defaultStatus">Does This Machine Use Filament?</option>
                                <option value='1'>Yes</option>
                                <option value = '0'>No</option>
                            </select>
                        </div>

                        <div id="AddMachineMaterialsWrapper" class="d-none">
                            <div class="form-group">
                                <label>Multiple Extrusion Status (Does This Machine Use More Than One Filament/Extruder):</label>
                                <select class="custom-select" name="addMaterials" id="addMaterials">
                                    <option disabled selected class="text-secondary" id="add_mult_ext" value="null">Multiple Extrusion Status</option>
                                    <option value="1" id="mult_ext_true">Yes</option>
                                    <option value="0" id="mult_ext_false">No</option>
                                </select>
                            </div>

                            <div class="form-group d-none" id="add_num_ext">
                                <label>Max Number of Extrusions Supported:</label>
                                <input type="number" id="add_num_ext_val" value="1" min="1" max="99" class="form-control" name="add_num_ext" placeholder="Max Number of Extrusions Supported"/>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-success btn-clock text-uppercase" type="submit" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Add Machine -->

<!-- Edit Machine -->
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card shadow-lg my-3">
                <div class="card-body">
                    <h1 class="card-title text-center">Update Settings</h1>
                    <form action="controllers/edit_hardware_controller.php" method="post">

                        <div class="form-group">
                            <label>Set Machine Status:</label>
                            <select class="custom-select" name="service" id="service" required>
                                <option disabled selected class="text-secondary" id="defaultStatus">Set Machine Status</option>
                                <option value='1' id="inService">In Service</option>
                                <option value = '0' id="OOS">Out Of Service</option>
                            </select>
                        </div>

                        <div class="form-group d-none">
                            <input type="hidden" id="machineName" name="machineName" value="404">
                        </div>

                        <div id="materialsWrapper" class="d-none">
                            <div class="form-group">
                                <label>Multiple Extrusion Status:</label>
                                <select class="custom-select" name="Materials" id="Materials">
                                    <option disabled selected class="text-secondary" id="mult_ext">Multiple Extrusion Status</option>
                                    <option value="1" id="mult_ext_true">Yes</option>
                                    <option value="0" id="mult_ext_false">No</option>
                                </select>
                            </div>

                            <div class="form-group d-none" id="num_ext">
                                <label>Max Number of Extrusions Supported:</label>
                                <input type="number" id="num_ext_val" min="1" max="99" class="form-control" name="num_ext" placeholder="Max Number of Extrusions Supported"/>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-clock text-uppercase" type="submit" name="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Machine -->

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/edit_machine.js"></script>
</body>
</html>
