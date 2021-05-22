<?php
include('include/db.php');


    $sql="INSERT INTO user(name, email, age,designation) VALUES 
    ('$_POST[name]','$_POST[email]','$_POST[age]','$_POST[designation]')";
        $run=mysqli_query($conn,$sql);
    if($run) {
        echo'Success';
    }


?>
