<!doctype html>
<html class="bg-secondary" lang="en">
<head>
  <meta charset="utf-8">
  <title>Machines</title>
  <?php include 'style.php';?>
  <link rel="stylesheet" type="text/css" href="css/loading-bar.css"/>
</head>

<body class="bg-secondary">
  <div class="container-fluid" id="statuses">
  </div>
  <div class="row text-center bottom-bars-row-height fixed-bottom">
    <div class='col ldBar label-center no-label h-50' id='notinuse'>Machine Free To Use</div>
    <div class='col ldBar label-center no-label h-50' id='printinprogress'>Print In Progress</div>
    <div class='col ldBar label-center no-label h-50' id='failedprint'>Print Failed</div>
    <div class='col ldBar label-center no-label h-50' id='outofservice'>Machine Out of Service</div>
  </div>

</body>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/TV.js"></script>
<script type="text/javascript" src="js/loading-bar.js"></script>
<script type="text/javascript">
  var bar1 = new ldBar('#notinuse',{
    'preset': 'stripe',
    'fill': 'data:ldbar/res,stripe(#CCCCCC,#D4D4D4, 0)'
  });
  var bar2 = new ldBar('#printinprogress',{
    'preset': 'stripe',
    'fill': 'data:ldbar/res,stripe(#28A745,#48B461, 2)'
  });
  var bar3 = new ldBar('#failedprint',{
    'preset': 'stripe',
    'fill': 'data:ldbar/res,stripe(#FFC107,#FFD553, 2)'
  });
  var bar4 = new ldBar('#outofservice',{
    'preset': 'stripe',
    'fill': 'data:ldbar/res,stripe(#DC3545,#E15361, 0)'
  });
bar1.set(100, false);
bar2.set(100, false);
bar3.set(100, false);
bar4.set(100, false);
</script>
</html>
