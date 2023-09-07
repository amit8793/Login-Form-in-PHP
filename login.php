<!DOCTYPE html>
<html>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/style.css" />
<style>
    body {
        font-family: Arial, Sans-Serif;
    }

    .clearfix:before,
    .clearfix:after {
        content: "";
        display: table;
    }

    .clearfix:after {
        clear: both;
    }

    a {
        color: #0067ab;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .form {
        width: 300px;
        margin: 0 auto;
    }

    input[type='text'],
    input[type='email'],
    input[type='password'] {
        width: 200px;
        border-radius: 2px;
        border: 1px solid #CCC;
        padding: 10px;
        color: #333;
        font-size: 14px;
        margin-top: 10px;
    }

    input[type='submit'] {
        padding: 10px 25px 8px;
        color: #fff;
        background-color: #e7d03a;
        text-shadow: rgba(231, 208, 58, 0.24) 0 1px 0;
        font-size: 16px;
        box-shadow: rgba(231, 208, 58, 0.24) 0 2px 0 0 inset, #fff 0 1px 0 0;
        border: 1px solid #e7d03a;
        border-radius: 2px;
        margin-top: 10px;
        cursor: pointer;
    }

    input[type='submit']:hover {
        background-color: f0df74;
    }
</style>
</head>

<body>
    <?php
    require('connection.php');
    session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        //Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='" . ($password) . "'";
        $result = mysqli_query($conn, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect user to index.php
            header("Location: welcome.php");
        } else {
            echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='register.php'>Register</a></div>";
        }
    } else {
        ?>
        <div class="form">
            <h1>Log In</h1>
            <form action="" method="post" name="login">
                <input type="text" name="username" placeholder="Username" required />
                <input type="password" name="password" placeholder="Password" required />
                <br>
                <input name="submit" type="submit" value="Login" />
            </form>
            <p>Not registered yet? <a href='register.php'>Register Here</a></p>
        </div>
    <?php } ?>
</body>

</html>