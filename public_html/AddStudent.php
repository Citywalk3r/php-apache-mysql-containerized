<?php
//include auth.php file on all secure pages
include("auth.php");
include('db.php');
session_start();
if (isset($_POST['name'])){

    // removes backslashes
    $name = stripslashes($_POST['name']);
    //escapes special characters in a string
    $name = mysqli_real_escape_string($con,$name);

    $surname = stripslashes($_POST['surname']);
    $surname = mysqli_real_escape_string($con,$surname);

    $fathername = stripslashes($_POST['fathername']);
    $fathername = mysqli_real_escape_string($con,$fathername);

    $mobilenumber = stripslashes($_POST['mobilenumber']);
    $mobilenumber = mysqli_real_escape_string($con,$mobilenumber);

    date_default_timezone_set('Europe/Athens');
    $bday = strtotime($_POST["bday"]);
    $bday = date('Y-m-d', $bday);
    $bday = stripslashes($bday);
    $bday = mysqli_real_escape_string($con,$bday);


    //Checking is user existing in the database or not

    $query = "SELECT * FROM students WHERE name = '$name' 
    AND surname = '$surname'
    AND fathername = '$fathername'";
    $result = $con->query($query);

    if($result->num_rows > 0) {
        $message =  "<p class='error'>The student already exists.</p>"; 
    }else{
        
        $sql = "INSERT INTO students (name, surname, fathername, grade, mobilenumber, birthday)
        VALUES ('$name', '$surname', '$fathername', {$_REQUEST['grade']}, '$mobilenumber', '$bday')";
        
        if ($con->query($sql) === TRUE) {
            $message = "<p class='success'>New record created successfully.</p>";
        } else {
            $message = "<p class='error'>Error: " . $sql . "<br>" . $con->error . "</p>";
        } 
    }

    $con->close();
  
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Add Student</title>
<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>
<nav class="teacher-nav">
    <ul>
        <li><a href="AddStudent.php">Add a Student</a></li>
        <li><a href="EditStudent.php">Edit a Student</a></li>
        <li><a href="DeleteStudent.php">Delete a Student</a></li>
        <li><a href="SearchStudent.php">Search for a student</a></li>
        <li><a href="logout.php">Logout</a></li>
       
    </ul>
    <div class="user"> <span class="username"><?php echo $_SESSION['user']; ?></span></div>
  
</nav>
<?php if($message)echo $message ?>
<div class="form">
<h1>Add a student</h1>
<form action="" method="post" name="login">
<input type="text" name="name" placeholder="e.g. Manos" required />
<input type="text" name="surname" placeholder="e.g. Papadopoulos" required />
<input type="text" name="fathername" placeholder="e.g. Nikolaos" required />
<input type="number" step="0.1" name="grade" placeholder="e.g. 8.5" required />
<input type="text" name="mobilenumber" placeholder="e.g. 6989866011" required />
<input type="date" name="bday" required>
<input name="submit" type="submit" value="Add" />
</form>
</div>
</body>
</html>