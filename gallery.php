<!DOCTYPE html>
<html class="bg-light">

<head>
  <?php include 'style.php';?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forge Gallery</title>

<body class="bg-light">
  <div class="bg-light pt-3 p-2">
      <?php include 'nav_bar.php';?>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center pt-3 display-4 text-primary">Forge Gallery</h1>
        <p class="text-center">Showcasing the very best of student projects.</p>
      </div>
    </div>
  </div>
  <script src="https://assets.juicer.io/embed.js" type="text/javascript"></script>
  <link href="https://assets.juicer.io/embed.css" media="all" rel="stylesheet" type="text/css" />
  <div class="container" id="juicer">
    <ul class="juicer-feed" data-feed-id="rpimakerspace" data-style="polaroid" data-per="20" data-style="hip" data-filter="Instagram"><h1 class="referral"></h1></ul>
  </div>
  <?php include 'footer.php';?>
</body>

</html>
