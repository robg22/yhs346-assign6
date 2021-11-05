<html lang="en-US">
<head>
    <title>
        Web Technologies CS4413
    </title>
    <link rel="stylesheet" type="text/css" href="css/assign3.css" >
</head>
<body>
<?php
if (!is_array($_POST) || empty($_POST)) {
    if(!isset($_POST['mode']) || !strlen($_POST['day'])){
        $error = "You did not enter a mode";
    }else{
        $error = $_POST['mode'];
    }
}
?>

<h1><?php echo "$error"; ?> </h1>

<div id="container">
    <div id="title">

        <div id="left">
            <h1 style="color: #090909">
                Robert Gonzalez <br>
                Software Engineer
            </h1>
        </div>
        <div class="right">
            <img id = "image1" src="images/catHat.png" alt="catHat" >
        </div>


    </div>

    <hr>
    <div class = "table">
        <table>
            <tr>
                <td id = "leftBox">
                    <h3 class = "center"> Menu </h3>
                    <hr>
                    <ul>
                        <li><a href="https://github.com/robg22">GitHub</a></li>
                        <li><a href="courses.html" >Courses</a></li>
                        <li><a href="https://www.utsa.edu/"> UTSA Website </a></li>
                    </ul>

                </td>

                <td id = "centerBox">
                    <h3> About me </h3>


                    <div class = "img2">
                        <img id = "image2" src="images/utsarLogo.jpg" alt="catHat" >
                    </div>
                    <div class = justify>
                        <p><!--Info about me -->
                            My name is Robert Gonzalez and I am currently a senior
                            at the University of Texas at San Antonio.<br>I am a Computer
                            Science Major with a concentration in Software Engineering.
                            I am a fun and energetic person. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a pulvinar eros, a volutpat mauris.
                            Ut ac ligula nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                            turpis egestas. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                            mus. Maecenas dapibus lorem sit amet enim molestie feugiat. Morbi metus erat, porta sit amet<br>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a pulvinar eros, a volutpat mauris.
                            Ut ac ligula nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                            turpis egestas. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                            mus. Maecenas dapibus lorem sit amet enim molestie feugiat. Morbi metus erat, porta sit amet
                            venenatis nec, fringilla non sapien. Phasellus dictum ligula vitae elit auctor, et ornare arcu viverra.
                        </p>
                    </div>

                </td>
                <td id = "rightBox">
                    <h3 class = "center">Enrolled Courses</h3>
                    <hr>
                    <ol type="1">
                        <li>CS-3853</li>
                        <li>CS-4413</li>
                        <li>CS-4613</li>
                        <li>CS-4743</li>
                        <li>CS-4773</li>
                    </ol>
                    <h3 class = "center">Theme Toggles</h3>
                    <hr>

                    <form action = "index.html" method="post">
                        <button name = "mode" value="utsa">UTSA THEME</button>
                        <button name = "mode" value="dark">DARK MODE</button>
                    </form>

                </td>

            </tr>
        </table>
    </div>
    <div id = "footer">
        <div id = "footerText">
            Robert Gonzalez Copyright 2021
        </div>
    </div>
</div>
</body>
</html>