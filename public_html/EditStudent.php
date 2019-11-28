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
<title>Edit Student</title>
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
        $fathername = $row['fathername'];
        $grade = $row['grade'];
        $mobile = $row['mobilenumber'];
        $bday = $row['birthday'];

        $payload = array ("id" => $id, "name" => $name, "surname" => $surname, "fathername" => $fathername, "grade" => $grade, "mobile" => $mobile, "bday" => $bday);


    ?>
        <div class="student">
            <p class="student-text"><?php echo $name ." " . $surname; ?></p>
            <button class='btn btn__edit' id='edit_<?php echo $payload['id']; ?>'>Edit</span>
        </div>
    
    <div class="form form-edit hidden" id='editform_<?php echo $payload['id']; ?>'>
    <form action="" method="put" name="editStudent">
    <input type="text" name="name" value=<?php echo $payload['name']?> required />
    <input type="text" name="surname" value=<?php echo $payload['surname']?> required />
    <input type="text" name="fathername" value=<?php echo $payload['fathername']?> required />
    <input type="number" step="0.1" name="grade" value=<?php echo $payload['grade']?> required />
    <input type="text" name="mobilenumber" value=<?php echo $payload['mobile']?> required />
    <input type="date" name="bday" value=<?php echo $payload['bday']?> required>
    </form>
    <button name="submit" class="editbtn" id="editbtn_<?php echo $payload['id'];?>">Ok</button>
    </div>

    <?php
    $count++;
    }
    ?>
</div>
<script>
  
$(document).ready(function(){


    $('.btn__edit').click(function(){
      let el = this;
      let id = this.id;
      let splitid = id.split('_');
   
      let editid = splitid[1];
    
      $("#editform_"+editid).toggleClass("hidden");
   
    });
});

$(document).ready(function(){
    $('.editbtn').click(function(){
        var el = this;
        var id = this.id;
        var splitid = id.split('_');

        var editid = splitid[1];

        var fields = $(this).parent().children()

        var name = fields.find("input[name='name']").val()
        var surname = fields.find("input[name='surname']").val()
        var fathername = fields.find("input[name='fathername']").val()
        var grade = fields.find("input[name='grade']").val()
        var mobilenumber = fields.find("input[name='mobilenumber']").val()
        var birthday = fields.find("input[name='bday']").val()

        // AJAX Request
        $.ajax({
            url: 'edit.php',
            type: 'POST',
            data: { id:editid,name:name,surname:surname,fathername:fathername,grade:grade,mobilenumber:mobilenumber,birthday:birthday},
            success: function(response){
                if(response == 1){
                    location.reload();         
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