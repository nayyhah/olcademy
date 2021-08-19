<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="./css/header.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">

  </head>

  <body>

    <?php if(isset($title) && $title == "Index") { ?>
      <style type="text/css">
        .navbar {
          background:rgba(0,0,0,0.7);
        }
      </style>
    <?php } ?>

    <nav class="navbar navbar-expand-md navbar-dark sticky-top">
      <div class="mx-auto order-0">
        <a class="navbar-brand mr-auto font-weight-bold" href="index.php"><span class="iiit">olcademy</span> <span class="bkstr">Task</span></a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-collapse">
          <span class="fa fa-bars"></span>
      </button>
      <div class="navbar-collapse collapse w-100 order-1 order-md-0" id="menu-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><span class="fa fa-sign-out"></span>&nbsp;Signout</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid p-0" id="main" style="overflow-x:hidden;">
