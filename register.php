<?php
// Include config file
require_once "./functions/database_functions.php";
$conn = db_connect();
$title = "Registration Panel";
require_once "./template/header.php";

// Define variables and initialize with empty values
$email = $fullname = $dob = $gender = $password = $confirm_password = "";
$email_err = $fullname_err = $dob_err = $gender_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
// Processing form data when form is submitted
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate Email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an Email Id.";
    }
    else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This Email Id already exists.";
                }
                elseif(!filter_var($param_email, FILTER_VALIDATE_EMAIL)){
                    $email_err = "Please enter a valid Email Id.";
                }
                else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate Full Name
    if(empty(trim($_POST["fullname"]))){
        $fullname_err = "Please enter your Full Name.";
    } else{
        $fullname = trim($_POST["fullname"]);
    }

    // Validate dob
    if(empty(trim($_POST["dob"]))){
        $dob_err = "Please enter your DOB.";
    } 
    elseif (!preg_match('/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/', trim($_POST["dob"]))){
         $dob_err = "Please enter DOB in DD/MM/YYYY format.";
    }
    // elseif (!ereg("^([0-9]{2})/([0-9]{2})/([0-9]{4})$",$_POST["dob"]), $parts)){
    //   // Check the format
    //   $dob_err = "The date of birth is not a valid date in the " . "format DD/MM/YYYY";

    // } 
    else{
        $dob = trim($_POST["dob"]);
    }

    // Validate Gender
    if(empty($_POST["gender"])){
        $gender_err = "Please enter your Gender.";
    } else{
        $gender = $_POST["gender"];
    }

    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    


    // Check input errors before inserting in database
    if(empty($email_err) && empty($fullname_err) && empty($dob_err) && empty($gender_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (email,fullname,dob,gender,password) VALUES (?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_email, $param_fullname, $param_dob, $param_gender, $param_password);

            // Set parameters
            $param_email = $email;
            $param_fullname = $fullname;
            $param_dob = $dob;
            $param_gender = $gender;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login_user.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($conn);
}
?>

    <style type="text/css">
        .wrapper { 
            width:350px;
            padding:20px; 
        }
    </style>

    <div class="wrapper mx-auto shadow mt-5 mb-3 bg-light rounded">
        <h2 class="text-center">Sign Up</h2>
        <p class="text-center">Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <label class="font-weight-bold"><span class="fa fa-envelope"></span>&nbsp;Email</label>
                    <input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
                    <span class="help-block"><?php echo $email_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($fullname_err)) ? 'has-error' : ''; ?>">
                <label class="font-weight-bold"><span class="fa fa-user"></span>&nbsp;Full Name</label>
                <input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>">
                <span class="help-block"><?php echo $fullname_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($dob_err)) ? 'has-error' : ''; ?>">
                <label class="font-weight-bold"><span class="fa fa-calendar"></span>&nbsp;DOB</label>
                <input type="text" name="dob" class="form-control" placeholder="DD/MM/YYYY" value="<?php echo $dob; ?>">
                <span class="help-block"><?php echo $dob_err; ?></span>
            </div>

<!--            <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                <label class="font-weight-bold"><span class="fa fa-venus"></span>&nbsp;Gender</label>
                <input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>">
                <span class="help-block"><?php echo $gender_err; ?></span>
            </div>

   -->
            <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                <label class="font-weight-bold"><span class="fa fa-venus"></span>&nbsp;Gender</label>
                <select name="gender" >
                    <option selected>Choose...</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Prefer not to say">Prefer not to say</option>
                </select>
                <span class="help-block"><?php echo $gender_err; ?></span>
            </div>
        


            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label class="font-weight-bold"><span class="fa fa-key"></span>&nbsp;Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label class="font-weight-bold"><span class="fa fa-key"></span>&nbsp;Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>


            <div class="form-group text-center">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-light" value="Reset">
            </div><hr>
            <p class="text-center">Already have an account? <a href="login_user.php">Login here</a>.</p>
        </form>
    </div>

<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>
