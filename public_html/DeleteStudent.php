<?php
//include auth.php file on all secure pages
include("auth.php");
include('db.php');
session_start();

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
<div class='students'>
  <?php 
  $query = "SELECT * FROM students";
  $result = mysqli_query($con,$query);

  $count = 1;
  while($row = mysqli_fetch_array($result) ){
    $id = $row['id'];
    $name = $row['name'];
    $surname = $row['surname'];

  ?>
    <div class="student">
        <p class="student-text"><?php echo $name ." " . $surname; ?></p>
        <button class='btn btn__delete' id='del_<?php echo $id; ?>'>Delete</span>
    </div>
  <?php
   $count++;
  }
?>
</div>

<script>
  
  $(document).ready(function(){

    // Delete 
    $('.btn__delete').click(function(){
      var el = this;
      var id = this.id;
      var splitid = id.split('_');
   
      // Delete id
      var deleteid = splitid[1];
    
      // AJAX Request
      $.ajax({
        url: 'remove.php',
        type: 'POST',
        data: { id:deleteid },
        success: function(response){
   
          if(response == 1){
        // Remove row from HTML Table
        $(el).closest('.student').css('background','tomato');
        $(el).closest('.student').fadeOut(800,function(){
           $(this).remove();
        });
         }else{
        alert('Invalid ID.');
         }
   
       }
      });
   
    });
   
   });
</script>;
</body>
</html>