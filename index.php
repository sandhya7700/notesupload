<?php
$insert = false;
$update = false;
$delete = false;
include "config.php";
//echo $_SERVER['REQUEST_METHOD'];
if(isset($_GET['delete']))
{
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
  $result = mysqli_query($conn , $sql);
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['snoEdit'])){
    //Update the record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];

    //Sql Query to be executed
    $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`sno` = $sno";
    $result = mysqli_query($conn , $sql);
    if($result)
    {
      $update =true;
    }
    else
    {
      echo "We could not updated the recored successfully";
    }
  }

  else
  {
$title = $_POST["title"];
$description = $_POST["description"];

//sql query to be execute
$sql = "INSERT INTO `notes` (`title`, `description`, `tstamp`) VALUES ('$title', '$description', '2023-10-14 18:56:50.000000');
";
$result = mysqli_query($conn ,$sql);
//Add a new notes to the notes table in the database
if($result)
{
  //echo "The recored has been instered successfully !<br>";
$insert = true;
}
else
{
echo "The record wa not instered sucessfully because of this error --->".mysqli_error($conn);
}
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<title>iNotes - Notes taking made easy</title>
  </head>
  <body>

  <!--Edit modal 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  Edit modal
</button> -->

<!--Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--model body-->
      <form action="/CRUD/index.php" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit">
  <div class="form-group">
    <label for="title">Notes Title</label>
    <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="description">Note Description</label>
    <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
  </div>
  
      </div>
      <div class="modal-footer d-block mr-auto">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img src="" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="#">Contact Us</a>
      </li>

    
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<?php
if($insert)
{
echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Success! </strong> Your  has been inserted successfully.
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
</div>";
}

if($delete)
{
echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Success! </strong> Your  has been deleted successfully.
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
</div>";
}

if($update)
{
echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Success! </strong> Your has been updated successfully.
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
</div>";
}
?>

<div class="container my-4">
    <h2>Add a Notes</h2>
<form action="/CRUD/index.php" method="post">
  <div class="form-group">
    <label for="title">Notes Title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="description">Note Description</label>
    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Add Notes</button>
</form>
</div>

<div class="container my-4">
<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
//Connection to the Databse
//include "config.php";
    $sql = "SELECT * FROM `notes`";
    $result =mysqli_query($conn,$sql);
    $sno=0;
 //featching the data
 while($row = mysqli_fetch_assoc($result))
 {
  $sno = $sno +1;
  echo "<tr>
  <th scope='row'>". $sno . "</th>
  <td>". $row['title'] . "</td>
  <td>". $row['description'] . "</td>
  <td><button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> 
  <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button></td>
</tr>";
 }
    ?>
  </tbody>
</table>
</div>
<hr>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
  $(document).ready(function () {
    $('#myTable').DataTable();
  });
</script>

<script>
  edits = document.getElementsByClassName('edit');
  Array.from(edits).forEach((element)=>{
    element.addEventListener("click", (e)=>{
    console.log("edit" , e);
    tr = e.target.parentNode.parentNode;
    title = tr.getElementsByTagName("td")[0].innerText;
    description = tr.getElementsByTagName("td")[1].innerText;
    console.log(title, description);
    titleEdit.value =title;
    descriptionEdit.value = description;
    snoEdit.value = e.target.id;
    console.log(e.target.id);
    $('#editModal').modal('toggle');
    })
  })

  //delete conformation

  deletes = document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element)=>{
    element.addEventListener("click", (e)=>{
    console.log("edit" , );
    sno = e.target.id.substr(1,);
    
    if(confirm("Are you sure you want to delete this note!"))
    {
      console.log("yes");
      window.location = `/CRUD/index.php?delete=${sno}`; 
      //TODO : create a form and use post request to submit a form
    }
    else
    {
      console.log("no");
    }
    })
  })
</script>
  </body>
</html>