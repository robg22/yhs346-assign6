<?php

echo "<html lang='en-US'>
<head>
";
require_once ".env.php";
echo "
    <title>
        Login
    </title>
    
    <link rel='stylesheet' type='text/css' href='css/register.css' > 
 </head>
 <body class = 'main'>";

$error = "";
//functions
function checkPost($check){

    if (isset($_POST[$check])) {
        $checked = $_POST[$check];
        if (strlen($checked) <= 0) { $GLOBALS["error"] = "Invalid Username or Password"; }
        else
            return $checked;
    }
    else
        $GLOBALS["error"] = "Invalid Username or Password";
    return "";
}

// open the connection
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
if (!$con)
    exit( " <p class='error'> Connection Error </p> ");

if (is_array($_POST) && !empty($_POST)) {
    $userN = checkPost("userName");
    $pass =  checkPost("password");
}
else $error = "No Post";
if(0 == strlen($error)) {
    //Init the statement
    $stmt = mysqli_stmt_init($con);
    if (!$stmt)
        exit("<p class='error'>Failed to initialize statement</p>");

    // Chek username exists
    $query = "SELECT user_name,passw FROM users WHERE user_name = ? AND passw = ?";
    if (!mysqli_stmt_prepare($stmt, $query))
        exit("<p class='error'> 1. Failed to prepare statement</p>");
   // $params = array($userN,$pass);
    mysqli_stmt_bind_param($stmt, "ss", $userN,$pass);

    if (mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt, $gotName,$gotPass);
        if (mysqli_stmt_fetch($stmt)) {
            session_start();
            $_SESSION["log"]=1;
            echo "Successfully Logged In";
            header("Location: index.php");
            exit;
        }
        else {
            echo "<h2>Invalid Username or Password</h2>";
        }
    }
    else
        exit("<p class='error'>Failed to execute statement </p>");

        mysqli_stmt_close($stmt);
        // insert data
        //$query = "INSERT INTO courses (course_name, course_number, description) VALUES ('$courseName', '$courseNum', '$description')";
        //$result = mysqli_query($con, $query);

}


echo
"
<h1>LOGIN</h1>
<hr>
<div class='forms'>
        <form method='post' action='login.php'>
            <div>
                <label for='userName'>User Name </label>
                <input type='text' id='userName' name='userName'>
            </div>
            <div>
                <label for='password'>Password </label>
                <input type='text' id='password' name='password'>
            </div>
            <div>
                <input type='submit' value='LOGIN'>
            </div>
        </form>
        <br>
        <form action = register.php>
            <div>
                <input type='submit' value='CLICK TO GO TO REGISTER PAGE'>
            </div>
        </form>
</div>

";


echo "
</body>
</html>
";

