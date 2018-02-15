<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "admin/functions.php"; ?>
<?php

// If there is any POST request then...
if($_SERVER['REQUEST_METHOD'] == "POST") {  

    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Prevent MYSQL injection
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $error = [

        'email'=> '',
        'password'=> ''
    ];

    // Error handling for email & password
    if(!preg_match("/^[_\.0-9a-zA-Z-]+@([a-zA-Z][a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {

        $error['email'] = "Invalid email format";
    }     

    if($email == '') {

        $error['email'] = 'email field cannot be empty';
    }

    if(email_exist($email)) {

        $error['email'] = 'email already exists, <a href="index.php">Please login</a>';
    }

    if($password == '') {

        $error['password'] = 'password field cannot be empty';
    }


    if (strlen($_POST["password"]) < '6') {

        $error['password'] = "Your Password Must Contain At Least 6 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$password)) {

        $error['password'] = "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {

        $error['password'] = "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {

        $error['password'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
    }

    foreach ($error as $key => $value) {

        if(empty($value)) {

            unset($error[$key]);  
        }
    }

    // If there isn't errors -> register the user & log him to the site
    if(empty($error)) {

        register_user($email, $password);

        login_user($email, $password);
    }
} 

?>

<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>
<!-- Form to handle data inputs -->
<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                    <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                             <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com"
                                autocomplete="on"
                                value="<?php echo isset($email) ? $email : '' ?>">
                                <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                            </div>

                             <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                            </div>

                            <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <hr>

    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h1>Login</h1>
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <input name="email" type="email" class="form-control" placeholder="Enter Email:">
                        </div>

                        <div class="input-group">
                            <input name="password" type="password" class="form-control" placeholder="Enter Password:">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" name="login" type="submit">Submit</button>
                            </span>
                        </div>
                        <br/><br/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php include "includes/footer.php";?>
