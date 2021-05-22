<?php
session_start();
include('include/db.php');


    // if(isset($_GET['action'])) {
    //     $sql="SELECT * FROM user ORDER BY id DESC";
    //     $result = mysqli_query($conn,$sql);
    //     while( $row = mysqli_fetch_assoc($result)) {
    //         echo '<tr>
    //             <td>'.$row['id'].'</td>
    //             <td>'.$row['name'].'</td>
    //             <td>'.$row['email'].'</td>
    //             <td>'.$row['age'].'</td>
               
    //             <td>
    //                 <button class="btn btn-success btn-sm text-white" onclick=" preview('.$row['id'].');">Preview</button>
    //                 <button class="btn btn-warning btn-sm text-white" onclick=" edit('.$row['id'].');">Edit</button>
    //                 <button class="btn btn-danger btn-sm"  onclick=" deldata('.$row['id'].');">Delete</button>
    //             </td>
    //         </tr>';
    //     }
    // }

    ?>
    <?php
    if(isset($_GET['action'])) {
     
      $sql="SELECT * FROM user";
      $result = mysqli_query($conn,$sql);
        while( $row = mysqli_fetch_assoc($result)) {
              echo '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['age'].'</td>
                    <td>'.$row['designation'].'</td>
                  
                    <td>
                        <button class="btn btn-success btn-sm text-white" onclick=" preview('.$row['id'].');">Preview</button>
                        <button class="btn btn-warning btn-sm text-white" onclick=" edit('.$row['id'].');">Edit</button>
                        <button class="btn btn-danger btn-sm"  onclick=" deldata('.$row['id'].');">Delete</button>
                    </td>
                  </tr>';
          }
    }
      
          


    
    if(isset($_GET['id'])) {

        $sql="SELECT * FROM user WHERE id='$_GET[id]'";
        $run=mysqli_query($conn,$sql);
        while( $row= mysqli_fetch_assoc($run)) {
            echo '<form id="myeditform" action="javascript:void(0);">
            <div class="form-group">
            <label for="id" class="col-form-label"></label>
            <input type="hidden" id="id" class="form-control" value="'.$_SESSION['id']=$row['id'].'" >
          </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Name:</label>
              <input type="text" name="name" class="form-control" value="'.$row['name'].'" >
            </div>
            <div class="form-group">
              <label for="email" class="col-form-label">Email:</label>
              <input type="email" name="email" class="form-control" value="'.$row['email'].'">
            </div>
            <div class="form-group">
              <label for="age" class="col-form-label">Age:</label>
              <input type="text" name="age" class="form-control"  value="'.$row['age'].'">
            </div>
            <div class="form-group">
              <label for="designation" class="col-form-label">Designation:</label>
              <input type="text" name="designation" class="form-control" value="'.$row['designation'].'">
            </div>
            <button  name="submit" class="btn btn-success"  onclick="update();">update</button>
       
          </form>';
        }
      }



?>
