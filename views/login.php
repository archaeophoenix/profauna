<!DOCTYPE html>
<html>
<head>
  <title>Profauna</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="<?php echo url; ?>assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="<?php echo url; ?>assets/css/flat-admin.css">

  <!-- Theme -->
  <link rel="stylesheet" type="text/css" href="<?php echo url; ?>assets/css/theme/blue-sky.css">
  <link rel="stylesheet" type="text/css" href="<?php echo url; ?>assets/css/theme/blue.css">
  <link rel="stylesheet" type="text/css" href="<?php echo url; ?>assets/css/theme/red.css">
  <link rel="stylesheet" type="text/css" href="<?php echo url; ?>assets/css/theme/yellow.css">

</head>
<body>
  <div class="app app-default">

<div class="app-container apps-login">
  <div class="flex-center">
    <div class="app-header"></div>
    <div class="app-body">
      <div class="loader-container text-center">
          <div class="icon">
            <div class="sk-folding-cube">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
              </div>
            </div>
          <div class="title">Logging in...</div>
      </div>
      <div class="app-block">
      <div class="app-form">
        <div class="form-header">
          <div class="app-brand"><img style="max-height: 200px; max-width: 200px; height: auto; width: auto;" class="media-object" src="<?php echo url.'/assets/images' ?>/profauna.jpg" alt="Profauna"></div>
        </div>
        <form class="form" method="post" action="<?php echo url; ?>login">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">
                <i class="fa fa-user" aria-hidden="true"></i></span>
              <input type="text" class="form-control" name="username" placeholder="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon2">
                <i class="fa fa-key" aria-hidden="true"></i></span>
              <input type="password" class="form-control" name="password" placeholder="Password" aria-describedby="basic-addon2">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success btn-submit" title="Login">Login</button>
            </div>
        </form>

        <!-- <div class="form-line">
          <div class="title">OR</div>
        </div>
        <div class="form-footer">
          <button type="button" class="btn btn-default btn-sm btn-social __facebook">
            <div class="info">
              <i class="icon fa fa-facebook-official" aria-hidden="true"></i>
              <span class="title">Login with Facebook</span>
            </div>
          </button>
        </div> -->
      </div>
      </div>
    </div>
    <div class="app-footer">
    </div>
  </div>
</div>

  </div>
  
  <script type="text/javascript" src="<?php echo url; ?>assets/js/vendor.js"></script>
  <script type="text/javascript" src="<?php echo url; ?>assets/js/app.js"></script>

</body>
</html>