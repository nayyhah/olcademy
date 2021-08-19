<?php
// Initialize the session
session_start();
$title = "Welcome";
require_once "./template/loggedinheader.php";
require_once "./functions/database_functions.php";

// Check if the user is logged in, if not then redirect him to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: login_user.php");
//     exit;
// }
?>

<style type="text/css">
    .page-wrapper, .row, .welcome-wrapper {
        width:100%;
        height:100vh;
    }
    .welcome-wrapper {
        background:#000;
        overflow-x:hidden;
        overflow-y:hidden;
        padding:6% 2%;
    }
    .content {
        color:#fff;
    }
    .header h1 {
        font-family: "Lucida Console", "Courier New", monospace;
    }
    .header h4 {
        font-family: Arial, Helvetica, sans-serif;
    }
    .body, .conclude {
        font-family:calibri;
    }
</style>


<section class="welcome-wrapper">
    <div class="page-wrapper container">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="content left-bound">
                    <div class="d-flex flex-column">
                        <div class="d-flex header">
                            <h1 class="display-2">Hi, </h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <h4 class="align-self-center display-4 text-primary">User<!-- <?php echo htmlspecialchars($_SESSION["email"]); ?> --></h4>
                        </div><br>
                        <div class="body d-flex flex-column">
                            <h3>Welcome to Olcademy</h3><br>

                        </div><br><br>
                        <div class="conclude">
                            <a href="logout.php" class="text-muted"><span class="fa fa-sign-in"></span>&nbsp;Signout of my Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
  require_once "./template/footer.php";
?>
