<!DOCTYPE html>
<html>
<meta charset="utf-8">
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
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($conn, $username);
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date)
        VALUES ('$username', '" .($password) . "', '$email', '$trn_date')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    } else {
        ?>
        <div class="form">
            <h1>Registration</h1>
            <form name="registration" action="" method="post">
                <input type="text" name="username" placeholder="Username" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="submit" name="submit" value="Register" />
            </form>
        </div>
    <?php } ?>
</body>

</html>