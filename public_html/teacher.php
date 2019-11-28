<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Teacher Panel</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>

<section class="background">
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


    <div class="teacher-hero">
        <h1>Teacher Control Panel</h1>
        <p>Please Select an action from the menu above.</p>
    </div>
</section>


</body>
</html>