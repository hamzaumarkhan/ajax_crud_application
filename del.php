<?php
      include('include/db.php');
   
        
        $sql="DELETE FROM user WHERE id ='$_GET[id]'";
        $run=mysqli_query($conn,$sql);
    
?>
