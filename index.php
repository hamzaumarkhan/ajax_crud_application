<?php
include('include/db.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Ajax Crud</title>
</head>

<body>

  <div class="container">
    <h1 class="text-info text-center p-2 m-2">Ajax Crud Application</h1>
    <div class="d-flex justify-content-end">
      <button class="btn btn-info" onclick="openModal();">ADD Record</button>

    </div>
    <div class="row">
      <div class="col-sm-12">
        <h3 class="text-info p-2">Display Record</h3>
        <table class="table table-hover table-borderd">
            <!-- Loader -->
            <div class="container" id="loaddata">
              <div class="d-flex justify-content-center text-info">
                <div class="spinner-border" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
              </div>
            </div>
              <!--End Loader -->
          <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Designation</th>
            <th>Action</th>
          </thead>
          <tbody id="tabledata">
            <!-- .................. -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="dataForm"  onsubmit="return validateForm()">
            <div class="form-group">
              <label for="name" class="col-form-label">Name:</label>
              <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
              <label for="email" class="col-form-label">Email:</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="age" class="col-form-label">Age:</label>
              <input type="number" name="age" class="form-control">
            </div>
            <div class="form-group">
                <select class="custom-select" name="desig_id" id="custom-select" required="required">
                  <option class="desig" value="Select Designation" selected>Select Designation</option>
                  <?php
                    $sql="SELECT * FROM designation ORDER BY id ASC";
                    $result = mysqli_query($conn,$sql);
                      while( $row = mysqli_fetch_assoc($result)) {
                        echo '
                        
                        <option value="'.$row['id'].'">'.$row['desig_title'].'</option>';
                      }
                  ?>
                </select>
          </div>
            <button type="button" class="btn btn-primary" onclick="insert();">Submit</button>

          </form>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="editmodaldata">

        </div>
      </div>
    </div>
  </div>


  <!-- Preview Modal -->

  <div class="modal fade" id="prevModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-center">
          <h5 class="modal-title " id="exampleModalLabel">Preview Record</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="previewModalData">

        </div>
      </div>
    </div>
  </div>
  <!-- End Preview Modal -->


  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
  var refresh =
      '<div class="spinner-border text-warning d-flex justifiy-content-center" role="status"><span class="sr-only">Loading...</span></div>'


      function validateForm() {
        // alert("Name must be filled out");
        var x = document.forms["dataForm"]["name"].value;
        if (x == "") {
          alert("Fill out  Name must be filled out");
          return false;
        }else{
          
        }
      }

    $(document).ready(function () {
   
      (function(){
        swal("Record Loaded Please Wait a few second!", {
          buttons: false,
          timer: 2000,
        });
          var loaddata = document.getElementById("loaddata"),
            
            show = function(){
          read_data();
              loaddata.style.display = "block";
              setTimeout(hide, 1000); 
          
            },

            hide = function(){
          
              loaddata.style.display = "none";
            };

          show();
        })();
		

      read_data();

    });


    // Display Record...
    function read_data(refresh) {

      $('#tabledata').load('backend.php?action=get');
    }

    //Function For Open Modal...

    function openModal() {
      $('#myModal').modal('show');
    }


    function close_modal() {
      $('#myModal').modal('hide');
    }

    // Delete Record... 

    function deldata(id) {
      // alert(id);
      if (confirm('Are you sure...?')) {
        $.ajax({
          type: 'GET',
          data: {
            id: id
          },
          url: 'del.php',
          success: function (data) {
            $('#tabledata').html();

            setTimeout(read_data, 1000);
             swal("Record Deleted", "You deleted the Record Successfully ", "error");

          }
        });
      }

    }

    /// insert record

    function insert() {
         // alert('Button Clicked');
        var name = document.forms["dataForm"]["name"].value;
        var email = document.forms["dataForm"]["email"].value;
        var age = document.forms["dataForm"]["age"].value;
        //  var designation = document.getElementById('select');
            
        if (name == "" || email == "" || age == "" ) {
          swal("All Fields Required", "Please Fill Out Must be All Fields", "warning");
          // alert(" Fill out  Name must be filled out");
          return false;
        }else{
          
            if (fetch('insert.php', {
                method: "POST",
                body: new FormData(document.getElementById('dataForm'))
              }))

            {
              $('#myModal').modal('hide');
          //    read_data();
              document.getElementById('dataForm').reset();
              $('#tabledata').html();
             setTimeout(read_data, 1000);
              swal("Record Inserted", "You inserted the Record Successfully ", "success");
            } else {

              //  alert('error');
            }
          }
      }
  


    //   Update Record

    function edit(id)  {

       $('#editModal').modal('show');
       $('#editmodaldata').html(id);
       $('#editmodaldata').load('backend.php?id=' + id);

    }

    // Update Button 

    function update() {
      // alert('Clicked');

      if (fetch('update.php', {
          method: "POST",
          body: new FormData(document.getElementById('myeditform')),
          
        }))

      {
         document.getElementById('myeditform');
        $('#editModal').modal('hide');
       
        swal("Record Updated", "You Updated the Record Successfully ", "success");
        setTimeout(read_data, 1000);

      } else {
        swal("Error", "there is some technical issue while processing your request", "warning");
      //  alert('error');
      }
    }

     //   Preview Record 

     function preview(id) {

$('#prevModal').modal('show');
$('#previewModalData').html(id);
$('#previewModalData').load('preview.php?id=' + id);

}

// Preview  Button 

function previewData() {
// alert('Clicked');

if (fetch('update.php', {
   method: "POST",
   body: new FormData(document.getElementById('mypreviewData')),
   
 }))

{
  document.getElementById('mypreviewData');
 $('#prevModal').modal('hide');

 swal("Record Updated", "You Updated the Record Successfully ", "success");
 setTimeout(read_data, 1000);

} else {
 swal("Error", "there is some technical issue while processing your request", "warning");
//  alert('error');
}
}
  </script>

</body>

</html>