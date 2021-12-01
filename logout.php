<?php
session_start();
if(isset($_SESSION["log"])){
    if(!$_SESSION["log"] == 1){
        header("Location: login.php");
        exit;
    }
}else{
    header("Location: login.php");
    exit;
}
if (isset($_POST['logout'])) {
    echo "<h1> MADE IT TO LOGOUT </h1>";
    unset($_SESSION["log"]);
    header("Location: login.php");
    exit;
}

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
 <body>";

echo
"
<h2>LOGOUT</h2>
<div id='logout'>
        <form method = 'post'>
            <input type='submit' name='logout' value='Press To LOGOUT' />
        </form>
</div>

";



