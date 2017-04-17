<!DOCTYPE html>
<html>
<head>
  <title>ProFauna</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?php echo url; ?>assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="<?php echo url; ?>assets/css/flat-admin.css">

  <!-- Theme -->
  <link rel="stylesheet" type="text/css" href="<?php echo url; ?>assets/css/theme/blue-sky.css">
  <link rel="stylesheet" type="text/css" href="<?php echo url; ?>assets/css/theme/blue.css">
  <link rel="stylesheet" type="text/css" href="<?php echo url; ?>assets/css/theme/red.css">
  <link rel="stylesheet" type="text/css" href="<?php echo url; ?>assets/css/theme/yellow.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo url; ?>assets/css/datepicker3.css">
  <link rel="stylesheet" href="<?php echo url; ?>assets/css/daterangepicker-bs3.css">

  <link rel="stylesheet" href="<?php echo url; ?>assets/css/getorgchart.css">
  <link rel="stylesheet" href="<?php echo url; ?>assets/css/custom.css">
</head>
<?php $uri = explode('/', $_SERVER['REQUEST_URI']);?>
<body>
  <div class="app app-default">
    <aside class="app-sidebar" id="sidebar">
      <div class="sidebar-header">
        <a class="sidebar-brand" href="<?php echo url; ?>"><span class="highlight"><img style="max-height: 150px; max-width: 150px; height: auto; width: auto;" class="media-object" src="<?php echo url.'/assets/images' ?>/profauna.jpg" alt="Profauna"></span></a>
        <button type="button" class="sidebar-toggle"><i class="fa fa-times"></i></button>
      </div>
      <div class="sidebar-menu">
        <ul class="sidebar-nav">
          <li class="dropdown <?php echo ($uri[2] == 'bio') ? 'active' : '' ; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <div class="icon">
                <i class="fa fa-user" aria-hidden="true"></i>
              </div>
              <div class="title">Biodata</div>
            </a>
            <div class="dropdown-menu">
              <ul>
                <li class="section"><i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo url; ?>bio">Biodata</a></li>
                <li class="section"><i class="fa fa-user-plus" aria-hidden="true"></i> <a href="<?php echo url; ?>bio/user">Pengguna</a></li>
              </ul>
            </div>
          </li>
          <li class="dropdown <?php echo ($uri[2] == 'projek' || $uri[2] == 'event') ? 'active' : '' ; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <div class="icon">
                <i class="fa fa-calendar" aria-hidden="true"></i>
              </div>
              <div class="title">Projek &amp; Event</div>
            </a>
            <div class="dropdown-menu">
              <ul>
                <li class="section"><i class="fa fa-tasks" aria-hidden="true"></i> <a href="<?php echo url; ?>projek">Projek</a></li>
                <li class="section"><i class="fa fa-calendar" aria-hidden="true"></i> <a href="<?php echo url; ?>event">Event</a></li>
              </ul>
            </div>
          </li>
          <li class="dropdown <?php echo ($uri[2] == 'staff' || $uri[2] == 'jabatan') ? 'active' : '' ; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <div class="icon">
                <i class="fa fa-sitemap" aria-hidden="true"></i>
              </div>
              <div class="title">Organisasi</div>
            </a>
            <div class="dropdown-menu">
              <ul>
                <li class="section"><i class="fa fa-users" aria-hidden="true"></i><a href="<?php echo url; ?>staff">Staff</a></li>
                <li class="section"><i class="fa fa-star-o" aria-hidden="true"></i><a href="<?php echo url; ?>jabatan">Jabatan</a></li>
              </ul>
            </div>
          </li>
          <li class="dropdown <?php echo ($uri[2] == 'via' || $uri[2] == 'type' || $uri[2] == 'excel' || $uri[2] == 'log') ? 'active' : '' ; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <div class="icon">
                <i class="fa fa-server" aria-hidden="true"></i>
              </div>
              <div class="title">Data Basic</div>
            </a>
            <div class="dropdown-menu">
              <ul>
                <li class="section"><i class="fa fa-street-view" aria-hidden="true"></i><a href="<?php echo url; ?>via">Via Pendaftaran</a></li>
                <li class="section"><i class="fa fa-calendar-o" aria-hidden="true"></i><a href="<?php echo url; ?>type">Type Event / Projek</a></li>
                <li class="section"><i class="fa fa-calendar-o" aria-hidden="true"></i><a href="<?php echo url; ?>log">Log Aktivitas</a></li>
                <li class="section"><i class="fa fa-file-excel-o" aria-hidden="true"></i><a href="<?php echo url; ?>excel">Import Excel</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
      <div class="sidebar-footer">
        <!-- <ul class="menu">
          <li>
            <a href="/" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-cogs" aria-hidden="true"></i>
            </a>
          </li>
          <li><a href="#"><span class="flag-icon flag-icon-th flag-icon-squared"></span></a></li>
        </ul> -->
      </div>
    </aside>

    <script type="text/ng-template" id="sidebar-dropdown.tpl.html">
      <div class="dropdown-background">
        <div class="bg"></div>
      </div>
      <div class="dropdown-container">
        {{list}}
      </div>
    </script>
    <div class="app-container">

    <nav class="navbar navbar-default" id="navbar">
      <div class="container-fluid">
        <div class="navbar-collapse collapse in">
          <ul class="nav navbar-nav navbar-mobile">
            <li>
              <button type="button" class="sidebar-toggle">
                <i class="fa fa-bars"></i>
              </button>
            </li>
            <li class="logo">
              <a class="navbar-brand" href="#"><span class="highlight">ProFauna</span></a>
            </li>
            <li>
              <button type="button" class="navbar-toggle">
                <img class="profile-img" src="./assets/images/profile.png">
              </button>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-left">
            <li class="navbar-title"><?php echo $halaman; ?></li>
            <li class="navbar-search hidden-sm">
             <!--  <input id="search" type="text" placeholder="Search..">
              <button class="btn-search"><i class="fa fa-search"></i></button> -->
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <!-- <li class="dropdown notification danger">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
                <div class="title">System Notifications</div>
                <div class="count">10</div>
              </a>
              <div class="dropdown-menu">
                <ul>
                  <li class="dropdown-header">Notification</li>
                  <li>
                    <a href="#">
                      <span class="badge badge-danger pull-right">8</span>
                      <div class="message">
                        <div class="content">
                          <div class="title">New Order</div>
                          <div class="description">$400 total</div>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="badge badge-danger pull-right">14</span>Inbox
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="badge badge-danger pull-right">5</span>Issues Report
                    </a>
                  </li>
                  <li class="dropdown-footer">
                    <a href="#">View All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  </li>
                </ul>
              </div>
            </li> -->
            <li class="dropdown profile">
              <a href="/html/pages/profile.html" class="dropdown-toggle"  data-toggle="dropdown">
                <img class="profile-img" src="<?php echo url; ?>/assets/images/profile.png">
                <div class="title">Profile</div>
              </a>
              <div class="dropdown-menu">
                <div class="profile-info">
                  <h4 class="username text-capitalize"><?php echo $_SESSION['username']; ?></h4>
                </div>
                <ul class="action">
                  <li><a href="<?php echo url;?>logout">Logout</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="btn-floating" id="help-actions">
      <div class="btn-bg"></div>
      <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions"><i class="text-center icon fa fa-plus"></i><span class="help-text">Shortcut</span></button>
      <div class="toggle-content">
        <ul class="actions">
          <li><a onclick='window.location="<?php echo url.'bio/form/'?>"'><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Biodata</a></li>
          <li><a onclick='window.location="<?php echo url.'projek/form/'?>"'><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;Projek</a></li>
          <li><a onclick='window.location="<?php echo url.'event/form/'?>"'><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;Event</a></li>
          <li><a onclick='window.location="<?php echo url.'staff/form/'?>"'><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Staff</a></li>
          <li><a onclick='window.location="<?php echo url.'jabatan/form/'?>"'><i class="fa fa-star-o" aria-hidden="true"></i>&nbsp;Jabatan</a></li>
          <li><a onclick='window.location="<?php echo url.'via/form/'?>"'><i class="fa fa-street-view" aria-hidden="true"></i>&nbsp;via Pendaftaran</a></li>
          <li><a onclick='window.location="<?php echo url.'type/form/'?>"'><i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;Type Event / Projek</a></li>
        </ul>
      </div>
    </div>