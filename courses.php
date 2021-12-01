<html lang="en-US" xmlns="http://www.w3.org/1999/html">
<head>
    <title>
        Courses
    </title>
	<link rel="stylesheet" type="text/css" href="css/courses.css">
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
    ?>
<?php 
	require_once ".env.php";

	// open the connection
	$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
	if (!$con)
    		exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");

	if (is_array($_GET) && !empty($_GET)) {
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		
		// initialize the statement
		$stmt = mysqli_stmt_init($con);
		if (!$stmt)
    			exit("<p class='error'>Failed to initialize statement</p>");

		// prepare the statement
		$query = "DELETE FROM courses WHERE id = ?";
		if (!mysqli_stmt_prepare($stmt, $query))
                        exit("<p class='error'>Failed to prepare statement</p>");


		// bind the parameters (notice that $_POST['number'] already has a value
		mysqli_stmt_bind_param($stmt,"i", $id);

		// execute a SINGLE query
		if (!mysqli_stmt_execute($stmt))
    			exit("<p class='error'>Failed to execute statement</p>");

		}
	}
	if (is_array($_POST) && !empty($_POST)) {
		if(isset($_POST['courseName'])){
			$courseName = $_POST['courseName'];
			if(strlen($courseName) <= 0) {
                $error = "";
                $error = $error . "invalid course name!";
            }
		}

		if(isset($_POST['courseNumber'])){
			$courseNum = $_POST['courseNumber'];
			if(strlen($courseNum) != 4 )
                                $error = $error . "<br>invalid course number(must be 4 characters long)! ";
		}

		if(isset($_POST['description'])){
			$description = $_POST['description'];
			if(strlen($description) <= 0 )
                                $error = $error . "<br>invalid description!";
		}

		if(isset($_POST['finalGrade'])){
			$finalGrade = $_POST['finalGrade'];

			if(strlen($finalGrade) <= 0 || $finalGrade > 100 || $finalGrade < 0 )
                                $error = $error . "<br>invalid final grade(must be between 100.00 - 0.00";
		}

		if(isset($_POST['currently_enrolled'])){
			$enrolled = 1; 
		}else{
			$enrolled = 0;
		}

		if(strlen($error) == 0){
			// TODO: Insert new course into database!!

			//Init the statement
			$stmt = mysqli_stmt_init($con);
			if (!$stmt)
			    exit("<p class='error'>Failed to initialize statement</p>");
			
			// prepare the statement
			$query = "INSERT INTO courses (course_name, course_number, description,final_grade,currently_enrolled) VALUES (?,?,?,?,?)";
	
			if (!mysqli_stmt_prepare($stmt, $query))
    				exit("<p class='error'>Failed to prepare statement</p>");

			// bind parameters (this declares the variables)
			mysqli_stmt_bind_param($stmt, "sssdi", $courseName, $courseNum ,$description,$finalGrade,$enrolled);

			// execute the statement with the bound variables
    			if (mysqli_stmt_execute($stmt)) {
                    //echo("<p>Inserted course $courseNum</p>");
                }
    			else
        			echo("<p class='error'>Failed to insert course $courseNum</p>");


			
			mysqli_stmt_close($stmt);
			// insert data
			//$query = "INSERT INTO courses (course_name, course_number, description) VALUES ('$courseName', '$courseNum', '$description')";
			//$result = mysqli_query($con, $query);
		}


	}


?>	
</head>
<body>
    <h1>Courses</h1>
  
    <h3><a href="index.php">Back to home page</a></h3>
    <hr>
  <h4> <?php echo "$error" ; ?> </h4>  
  <div id="course-form">
        <form method="post" action="courses.php">
            <div>
                <label for="courseName">Course Name</label>
                <input type="text" id="courseName" name="courseName">
            </div>
            <div>
                <label for="courseNumber">Course Number</label>
                <input type="text" id="courseNumber" name="courseNumber">
            </div>
            <div>
                <label for="description">Description</label>
                <textarea id = "description" name="description" rows="5" cols="30"></textarea>
            </div>
            <div>
                <label for="finalGrade">Final Grade</label>
                <input type="text" id="finalGrade" name="finalGrade">
            </div>
            <div>
                <label for="currently_enrolled">Currently Enrolled</label>
                <input type="checkbox" id="currently_enrolled" name="currently_enrolled" value="1">
            </div>
            <div>
                <input type="submit" value="submit">
            </div>
        </form>
    </div>
	
    <h2>Courses Taken</h2>
    <table>
<?php 
	// initialize the statement
	$stmt = mysqli_stmt_init($con);
	if (!$stmt)
    		exit("<p class='error'>Failed to initialize statement</p>");

	// prepare the statement
	$query = "SELECT id,course_name,course_number,description,final_grade,currently_enrolled FROM courses";

	if (!mysqli_stmt_prepare($stmt, $query))
    		exit("<p class='error'>Failed to prepare statement</p>");
	// execute a SINGLE query
	if (!mysqli_stmt_execute($stmt))
    		exit("<p class='error'>Failed to execute statement</p>");
	
	// bind the result variables
	mysqli_stmt_bind_result($stmt, $id,$course_name,$course_number,$description,$final_grade,$currently_enrolled);
	
	echo "<form action = 'courses.php' method = 'post'>";

	echo "<table>";
	echo "<tr><th>Course Name</th><th>Course Number</th><th>Description</th><th>Final Grade</th></tr>";

	
	// fetch each result, one at a time
	while(mysqli_stmt_fetch($stmt) != NULL){
		if($currently_enrolled == 1)
			$eColor = "enrolledTrue";
		else
			$eColor = "na";
	
		echo "<tr class = $eColor ><td>$id</td><td>$course_name</td><td>$course_number</td><td>$description</td><td>$final_grade</td>
			<td><a href = 'courses.php?id=$id'>Delete Course </a></td></tr>";
	}

	echo "</table>";
	echo "</form>";
?>
    

<?php mysqli_close($con);?>

</body>
</html>
