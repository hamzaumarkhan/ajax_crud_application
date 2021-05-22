<?php 

session_start();
include('include/db.php');
    $update_id=$_POST['id'];
	$name=$_POST['name'];
	$email=$_POST['email']; 
	$age=$_POST['age'];
	$designation=$_POST['designation'];


   
   $update = "UPDATE user SET name='$_POST[name]',email='$_POST[email]',age='$_POST[age]',designation='$_POST[designation]' WHERE id='$_SESSION[id]'";
   $result=mysqli_query($conn,$update);
 
    if($result){
         echo "<script>alert('Done')</script>";
    }else{
         echo "<script>alert('Error')</script>";
    }



?>