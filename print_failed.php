<!doctype html>
<html class="bg-secondary" lang="en">
<head>
    <meta charset="utf-8">
    <title>Print Failed</title>
    <?php include 'style.php';?>

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
        <div class="col-sm-9 col-md-9 col-lg-9 mx-auto">
            <div class="card shadow-lg my-5">
                <div class="card-body">
                    <h1 class="card-title text-center">Send Print Failure Email</h1>
                    <div class="container">
                        </div>

                        <html class="row">

                        <?php
                        if(isset($_POST['submit'])){

                            $to = $_POST['email'];
                            $subject = "FAILED PRINT NOTIFICATION";
                            $message = 'Your print has failed <b>your machine will be held for one hour, you must come in and restart it during that time</b> after that, the printer will be freed for use';
                            $headers .= 'From: NO_REPLY@RPI_FORGE <rpi.forge@gmail.com>' . "\r\n";
                            $right = "Mail successfully sent";
                            $wrong = "There was an error sending your email";


                            if (mail($to,$subject,$message,$headers))
                                echo "<script type='text/javascript'>alert('$right');</script>";
//                              echo "Mail successfully sent";
                            else
                                echo "<script type='text/javascript'>alert('$wrong');</script>";
                            // You can also use header('Location: thank_you.php'); to redirect to another page.
                        }
                        ?>


                        <form class="form-horizontal" role="form" method="post" action="">

                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="example@domain.com">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-5 col-sm-offset-2">
                                    <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                                </div>
                            </div>

                        </form>



                    </div>

                </div>

            </div>
            </div>
        </div>

</body>

<script src="js/jquery-3.3.1.min.js"></script>

</html>
