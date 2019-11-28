<?php 
include('db.php');
include("auth.php");
session_start();

$id = $_POST['id'];

if($id > 0){

  // Check record exists
  $checkRecord = mysqli_query($con,"SELECT * FROM students WHERE id=".$id);
  $totalrows = mysqli_num_rows($checkRecord);

  if($totalrows > 0){

    
    // Update record
    $query = "UPDATE students
        SET name   ='". $_POST['name'] . "',
            surname ='". $_POST['surname'] . "',
            fathername    ='". $_POST['fathername'] . "',
            grade  ='" .$_POST['grade'] . "',
            mobilenumber    ='". $_POST['mobilenumber'] . "',
            birthday    ='". $_POST['birthday'] . "'
        WHERE
            id = '". $_POST['id'] . "'";
    mysqli_query($con,$query);
    echo 1;
    exit;
  }
}

echo 0;
exit;