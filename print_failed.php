
<!doctype html>
<html class="bg-secondary" lang="en">
<head>
    <meta charset="utf-8">
    <title>Print Failed</title>
    <?php include 'style.php';?>
    <?php require_once 'controllers/auth_controller.php';?>
    <script type="text-javascript">
        function openForm(url) {
            window.open(url,'form','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1076,height=768,directories=no,location=no')
        }

    </script>
</head>

<body class="bg-secondary">
<div class="bg-secondary pt-3 p-2">
    <?php include_once 'nav_bar.php';?>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card shadow-lg my-5">
                <div class="card-body">
                    <h1 class="card-title text-center">Send Print Failure Email</h1>
                    <hr/>
                    <div class="container">
                        <form method="post" action="controllers/email_controller.php">
                            <div class="form-group">
                              <select class="custom-select" name="machine">
                                  <option selected disabled>Select The Failed Machine</option>
                                  <?php generateMachineDropDown(1); ?>
                              </select>
                            </div>

                            <div class="form-group text-center">
                              <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                            </div>

                        </form>
                        </div>



                    </div>

                </div>

            </div>
            </div>
        </div>

</body>

<script src="js/jquery-3.3.1.min.js"></script>

</html>
