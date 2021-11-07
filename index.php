<html lang="en-US">
<head>
    <title>
        Web Technologies CS4413
    </title>
    <link rel="stylesheet" type="text/css" href="css/assign3.css" >
    <?php
	if (!is_array($_POST) || !empty($_POST)) {
    		if(isset($_POST['utsa'])){
        		if (isset($_COOKIE['theme'])){
                                $current = $_COOKIE['theme'];
                                setcookie("theme", "utsa", time()-3600);
				$leftB = "leftBox";
				$right = "rightBox";

                        }
                        else{
                                setcookie("theme", "white", time() +(10 * 365 * 24 * 60 * 60));
				$leftB = "whiteLeftBox";
				$right = "white";
                        }
                }
    
    		if(isset($_POST['dark'])){
        		if (isset($_COOKIE['dark'])){
				$current = $_COOKIE['dark'];
				setcookie("dark", "white", time()-3600);
				$backColor = "white";
				
			}
			else{
				setcookie("dark", "grey", time() +(10 * 365 * 24 * 60 * 60));
				$backColor = "grey";
			}
    		}
    
	}
	if(!isset($backColor)){
		if(!isset($_COOKIE['dark']))
			$backColor = "white";
		else
			$backColor = $_COOKIE['dark'];
	}
	if(!isset($leftB) || !isset($right) ){
		if(!isset($_COOKIE['theme'])){
			$right = "rightBox";
			$leftB = "leftBox";
		}else{
			$right = "white";
			$leftB = "whiteLeftBox";
		}
	}
?>
</head>
<body id = <?php echo "$backColor"; ?> >


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
	    <td id = <?php echo "$leftB"; ?> >
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
                <td id = <?php echo "$right"; ?> >
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

                    <form action = "index.php" method="post">
			<input type="submit" name= "utsa" value="utsa"/>
                        <input type="submit" name = "dark" value="dark"/>
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
