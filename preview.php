<?php
session_start();
include('include/db.php');    
    if(isset($_GET['id'])) {

        $sql="SELECT * FROM user WHERE id='$_GET[id]'";
        $run=mysqli_query($conn,$sql);
        while( $row= mysqli_fetch_assoc($run)) {
            echo '<form id="mypreviewData" action="javascript:void(0);">
              <table>
                <thead>
                  <b class="d-flex justify-content-center text-White  alert alert-info">Preview Your Single Record </b>
                </thead>
                  <div class="row">
                    <div class="col-lg-4">
                      <h6 class="alert alert-warning">ID</h6>
                      <h6 class="alert alert-warning">Name</h6>
                      <h6 class="alert alert-warning">Email</h6>
                      <h6 class="alert alert-warning">Age</h6>
                      <h6 class="alert alert-warning">Designation</h6>
                    </div>
                    <div class="col-lg-8">
                      <h6 class="alert alert-success">'.$_SESSION['id']=$row['id'].'</h6>
                      <h6 class="alert alert-success">'.$row['name'].'</h6>
                      <h6 class="alert alert-success">'.$row['email'].'</h6>
                      <h6 class="alert alert-success">'.$row['age'].'</h6>
                      <h6 class="alert alert-success">'.$row['designation'].'</h6>
                    </div>
                  </div>
              </table>
      
          </form>';
        }
      }
     