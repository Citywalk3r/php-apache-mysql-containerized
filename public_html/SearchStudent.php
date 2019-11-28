<?php
//include auth.php file on all secure pages
include("auth.php");
include('db.php');
session_start();


if (isset($_POST['searchfield'])){

    $searchq = $_POST['searchfield'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
    $query = mysqli_query( $con, "SELECT * FROM `students`
    WHERE CONCAT_WS(name, surname, fathername) LIKE '%".$searchq."%'") or die("could not search!");
    $count = mysqli_num_rows($query);
    if($count == 0){
        $output = 'There was no entry';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Student</title>
<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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

<div class="form">
<h1>Search for a student</h1>
<form action="SearchStudent.php" method="post" name="search">
<input type="text" name="searchfield" placeholder="Search..." required />
<input name="submit" type="submit" value="Search" />
</form>


<table class="blueTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Surame</th>
            <th>Father's Name</th>
            <th>Grade</th>
            <th>Mobile Number</th>
            <th>Birthday</th>
        </tr>
    </thead>
    <tbody>
    <?php if(isset($_POST['searchfield']))
          while($row = mysqli_fetch_array($query)):?>
            <tr>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['surname'];?></td>
                <td><?php echo $row['fathername'];?></td>
                <td><?php echo $row['grade'];?></td>
                <td><?php echo $row['mobilenumber'];?></td>
                <td><?php echo $row['birthday'];?></td>
            </tr>
        <?php endwhile;?>
    
    </tbody>
</table>


</body>
</html>