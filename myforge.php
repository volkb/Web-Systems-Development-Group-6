<!doctype html>
<html class="no-js bg-light" lang="">

<head>
    <?php include_once 'controllers/functions.php';?>
    <?php include_once 'controllers/auth_controller.php';?>
    <?php include_once "controllers/db_connector.php";?>
    <?php include_once 'scripts/table_generation.php';?>
    <?php include_once 'style.php';?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->
    <title>The Forge @ RPI</title>
</head>

<body class="bg-light">
  <div class="bg-light pt-3 p-2">
      <?php include 'nav_bar.php'?>
  </div>
<div class="container">
  <?php
    $user_type = getPerms();
    $first_name = getName();
    $last_name = getlastName();
    echo "<div class='container'>
      <div class='row'>
        <div class='col-md-12'>
          <h1 class='text-center pt-3 display-4 text-primary'>$first_name $last_name's Forge</h1>";

          if ($user_type == "user"){
            echo"<p class='text-center'>Access information regarding your projects and/or start a new print.</p>";
          } else if($user_type == "volunteer"){
            echo"<p class='text-center'>Access information regarding your own projects and statistics of all projects. Start a new print, free up a machine, or send a failed print e-mail.</p>";
          } else if($user_type == "admin"){
            echo"<p class='text-center'>Access the admin panel and/or information regarding your own projects and statistics of all projects.</p>";
          } else if($user_type == "TA"){
            echo"<p class='text-center'>Access the super admin panel and/or information regarding your own projects and statistics of all projects.</p>";
          }

        echo "</div>
      </div>
    </div>";

    if($user_type == "user"){
      echo "<div class='row'>
        <div class='col-xs-12 col-sm-8 col-md-6 mx-auto'>
          <div class='card shadow-lg my-3'>
            <div class='card-body'>
            <h1 class='card-title text-center'>Innovation Station</h1>
            <p class='text-center'>What will you create today?</p>";
            echo "<div class='row py-2'><div class='col-md-12 text-center'><a role=\"button\" class=\"btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size\" href='print_form.php'>Use a Machine</a></div></div>";
            echo "<div class='row py-2'><div class='col-md-12 text-center'><a role=\"button\" class=\"btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size\" href='status_bars.php'>Status Bars</a></div></div>";
            echo "</div>
              </div>
            </div>
          </div>";
    }else if ($user_type == 'volunteer'){
      echo "<div class='row'>
        <div class='col-sm-12 mx-auto'>
          <div class='card shadow-lg my-3'>
            <div class='card-body'>
            <h1 class='card-title text-center'>Innovation Station</h1>
            <p class='text-center'>What will you create today?</p>";
            echo "<div class='row py-2'>";
            echo "<div class='col-md-3 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size\" href='print_form.php'>Use a Machine</a></div>";
            echo "<div class='col-md-3 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size\" href='free_machine.php'>Free a Machine</a></div>";
            echo "<div class='col-md-3 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size\" href='status_bars.php'>Status Bars</a></div>";
            //display a pop-up asking for failed machine, then pull user info and get email to send
            echo "<div class='col-md-3 py-1 text-center'><button type=\"button\" class=\"btn btn-lg btn-danger btn-clock text-uppercase fixed-btn-size\" href='print_failed.php'>Failed Print Email</button></div>";
            echo "</div>
            </div>
          </div>
        </div>
      </div>";
    }else if ($user_type == "admin"){
      echo "<div class='row'>
        <div class='col-sm-12 mx-auto'>
          <div class='card shadow-lg my-3'>
            <div class='card-body'>
            <h1 class='card-title text-center'>Admin Panel</h1>";
              echo "<div class='row py-2'>";
              echo "<div class='col-md-3 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size\" href='print_form.php'>Use a Machine</a></div>";
              echo "<div class='col-md-3 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size\" href='free_machine.php'>Free a Machine</a></div>";
              echo "<div class='col-md-3 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size\" href='status_bars.php'>Status Bars</a></div>";
              // Heuristic Report as .xls
              echo "<div class='col-md-3 py-1 text-center dropdown show'><a class='btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size dropdown-toggle' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Reports</a>";
              echo "<div class='dropdown-menu' aira-labelledby='dropdownMenuLink'>";
              echo "<a class='dropdown-item' href='acct_rec_report.php'>Accounts Recievable</a>";
              echo "<a class='dropdown-item' href='usage_report.php'>Usage Report</a>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
              echo "<div class ='row py-2'>";
              echo "<div class='col-md-4 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-warning btn-clock text-uppercase fixed-btn-size\" href='create_account.php'>Create Account</a></div>";
              echo "<div class='col-md-4 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-warning btn-clock text-uppercase fixed-btn-size\" href='edit_user.php'>Edit Account</a></div>";
              //display a pop-up asking for failed machine, then pull user info and get email to send
              echo "<div class='col-md-4 py-1 text-center'><button type=\"button\" class=\"btn btn-lg btn-danger btn-clock text-uppercase fixed-btn-size\" href='print_failed.php'>Failed Print Email</button></div>";
              echo "</div>
        </div>
      </div>
    </div>
  </div>";
    }else if ($user_type == "TA"){
      echo "<div class='row'>
        <div class='col-sm-12 mx-auto'>
          <div class='card shadow-lg my-3'>
            <div class='card-body'>
            <h1 class='card-title text-center'>Super Admin Panel</h1>";

            echo "<div class='row py-2'>";
            echo "<div class='col-md-3 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size\" href='print_form.php'>Use a Machine</a></div>";
            echo "<div class='col-md-3 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size\" href='free_machine.php'>Free a Machine</a></div>";
            // Heuristic Report as .xls
            echo "<div class='col-md-3 py-1 text-center dropdown'><a class='btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size dropdown-toggle' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Reports</a>";
            echo "<div class='dropdown-menu' aira-labelledby='dropdownMenuLink'>";
            echo "<a class='dropdown-item' href='acct_rec_report.php'>Accounts Recievable</a>";
            echo "<a class='dropdown-item' href='usage_report.php'>Usage Report</a>";
            echo "</div>";
            echo "</div>";
            echo "<div class='col-md-3 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size\" href='status_bars.php'>Status Bars</a></div>";
            echo "</div>";

            echo "<div class='row py-2'>";
            echo "<div class='col-md-3 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-warning btn-clock text-uppercase fixed-btn-size\" href='create_account.php'>Create Account</a></div>";

            echo "<div class='col-md-3 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-warning btn-clock text-uppercase fixed-btn-size\" href='edit_user.php'>Edit Account</a></div>";
            //display a pop-up asking for failed machine, then pull user info and get email to send
            echo "<div class='col-md-3 py-1 text-center'><a role=\"button\" class=\"btn btn-lg btn-danger btn-clock text-uppercase fixed-btn-size\" href='print_failed.php'>Failed Print Email</a></div>";
            //Needs a confirm box as this dumps the user Table (Excluding Super Admin Users) and Projects also runs report generation
            echo "<div class='col-md-3 py-1 text-center'><button type=\"button\" class=\"btn btn-lg btn-danger btn-clock text-uppercase fixed-btn-size\" id='endSemester'>End Semester</button></div>";
            echo "</div>
            </div>
          </div>
        </div>
      </div>";
    }else if ($user_type == "lab"){
        echo "<div class='row'>
        <div class='col-xs-12 col-sm-8 col-md-6 mx-auto'>
          <div class='card shadow-lg my-3'>
            <div class='card-body'>
            <h1 class='card-title text-center'>Welcome to the Forge</h1>
            <p class='text-center'>What will you create today?</p>";
        echo "<div class='row py-2'><div class='col-md-12 text-center'><a role=\"button\" class=\"btn btn-lg btn-warning btn-clock text-uppercase fixed-btn-size\" href='create_account.php'>Create Account</a></div></div>";
        echo "<div class='row py-2'><div class='col-md-12 text-center'><a role=\"button\" class=\"btn btn-lg btn-success btn-clock text-uppercase fixed-btn-size\" href='status_bars.php'>Status Bars</a></div></div>";
        echo "</div>
              </div>
            </div>
          </div>";
    }
  ?>

<?php
  if($user_type != "lab") {
      echo "  <div class=\"row\">";
      echo "    <div class=\"col-sm-12 mx-auto\">";
      echo "      <div class=\"card shadow-lg my-3\">";
      echo "        <div class=\"card-body pb-0\">";
      echo "        <h1 class=\"card-title text-center\">Projects</h1>";
      generateSpecificTable("", "");
      echo "        </div>";
      echo "      </div>";
      echo "    </div>";
      echo "  </div>";
  }
?>

<?php
    //generate content based on permission tiers
    if ($user_type == "volunteer" || $user_type == "admin" || $user_type == "TA"){
      echo "<div class='row'>
        <div class='col-sm-12 mx-auto'>
          <div class='card shadow-lg my-3'>
            <div class='card-body pb-0'>
            <h1 class='card-title text-center'>Statistics</h1>";
            generateTotalTable("","");
            echo "</div>
          </div>
        </div>
      </div>";
    }
?>
</div>

<script>
    $( document ).ready(function() {
        $('#endSemester').click(function(){
            if(confirm("Are you Sure you want to end the semester? This will drop all users except Upper Admins and Clear the Projects Table.")){
                alert("For Data Loss Prevention, Reports will be generated now");
                window.open('reports.php', '_blank');
                window.location.assign("end_semester.php");
            }
        });
    });
</script>
</body>
</html>
