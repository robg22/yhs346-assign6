<?php

echo "<html lang='en-US'>
<head>
";
require_once ".env.php";
echo "
    <title>
        Register
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
    $query = "SELECT user_name FROM users WHERE user_name = ?";
    if (!mysqli_stmt_prepare($stmt, $query))
        exit("<p class='error'> 1. Failed to prepare statement</p>");

    mysqli_stmt_bind_param($stmt, "s", $userN);



    if (mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt, $gotName);
        if (mysqli_stmt_fetch($stmt)) {
            echo "<h2>User name already exists try another</h2>";
        } else {
            $query = "INSERT INTO users (user_name,passw) VALUES(?,?)";
            if (!mysqli_stmt_prepare($stmt, $query)){ exit("<p class='error'>2. Failed to prepare statement</p>"); }
            mysqli_stmt_bind_param($stmt, "ss", $userN,$pass);
            if(mysqli_stmt_execute($stmt)){
                session_start();
                $_SESSION["log"]=1;
                echo "Successfully Registered";
                header("Location: index.php");
                exit;
            }
        }
    }

    /*else {
        // prepare the statement

    */
    //}



        mysqli_stmt_close($stmt);
        // insert data
        //$query = "INSERT INTO courses (course_name, course_number, description) VALUES ('$courseName', '$courseNum', '$description')";
        //$result = mysqli_query($con, $query);

}


echo
"
<h1>REGISTER</h1>
<hr>

<div class='forms'>
        <form method='post' action='register.php'>
            <div>
                <label for='userName'>User Name </label>
                <input type='text' id='userName' name='userName'>
            </div>
            <div>
                <label for='password'>Password  </label>
                <input type='text' id='password' name='password'>
            </div>
            <div>
                <input type='submit' value='REGISTER'>
            </div>       
        </form>
        <br>
        <form action = login.php>
           <input type='submit' value='CLICK TO GO TO LOGIN PAGE'>
        </form>
    </div>
";


echo "
</body>
</html>
";

