<?php
    $insert = NULL;
     $servername = "localhost";
     $username = "root";
     $password = "";    
     $db = "mynotes";
     $table= "notes";
     
     // Create connection
     $conn = new mysqli($servername, $username, $password, $db);
     
     // Check connection
     if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
     }
    //  echo "Connected successfully";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['snoEdit'])){
            //updating the records
            $title = $_POST["titleEdit"];
            $description = $_POST["descriptionEdit"];
            
            $sql ="INSERT INTO `notes` (`sr`, `title`, `description`, `dt`) VALUES (NULL, '$title', '$description', current_timestamp()); ";
            $result = mysqli_query($conn,$sql);
            
            

        }
        else{
            $title = $_POST["title"];
            $description = $_POST["description"];
            
            $sql ="INSERT INTO `notes` (`sr`, `title`, `description`, `dt`) VALUES (NULL, '$title', '$description', current_timestamp()); ";
            $result = mysqli_query($conn,$sql);

            if($result){
                // echo "inserterd";
                $insert = true;
            }else{
                echo mysqli_error($conn);
            }
            }
    }
   
     ?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./datatable.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .material-symbols-outlined {
          font-variation-settings:
          'FILL' 0,
          'wght' 200,
          'GRAD' 0,
          'opsz' 24
        }
        </style>
</head>

<body>
    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
    Edit modal
  </button> -->
  
  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Updating Note</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <input type="hidden" name="snoEdit" id="snoEdit">
                <div class="mb-3">
                    <label for="titleEdit" class="form-label">Title</label>
                    <input type="text" name="titleEdit" class="form-control" id="titleEdit" aria-describedby="emailHelp">
    
                </div>
                <div class="mb-3">
                    <label for="descriptionEdit" class="form-label">Description</label>
                    <textarea type="text" name="descriptionEdit" class="form-control" id="descriptionEdit"></textarea>
                </div>
    
                <button  type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>





    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MyNotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>




    <div class="container">
        <?php
        if($insert){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note added.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
        }
    ?>
    </div>


    <div class="container my-5">
        <form action="" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" name="description" class="form-control" id="description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
        <hr>
    </div>

    <?php
        $sql = "SELECT * FROM `notes` ORDER BY `dt` DESC ";
        $result = mysqli_query($conn , $sql);
        
    ?>

    <div class="container">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
            $sr = 0;
            while($row = mysqli_fetch_assoc($result)) {
                $sr++;
                echo "
                <tr>
                    <th scope='row'>".$sr."</th>
                    <td>".$row['title']."</td>
                    <td>".$row['description']."</td>
                    <td class='d-flex p-2'>
                        <button class='edit btn btn-primary m-1' id='".$row['sr']."' data-bs-toggle='modal' data-bs-target='#editModal' ><span class='material-symbols-outlined'>edit</span></button>
                        <button class='del btn btn-primary m-1' ><span class='material-symbols-outlined'>delete</span></button>
                    </td>
                </tr>
                
                ";
            }
            ?>


            </tbody>
        </table>
    </div>
      


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous">
    </script>
    <script src="datatable.js"></script>


    <script>
       
        $(document).ready( function () {
        $('#myTable').DataTable();
        } );
    </script> 
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
            element.addEventListener("click",(e)=>{
                console.log("edit",e.target.parentNode.parentNode.parentNode);
                tr = e.target.parentNode.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;

                console.log(title,description);
                snoEdit.value = e.target.parentNode.id;
                titleEdit.value = title;
                descriptionEdit.value = description;
                
            })
            
        })
    </script>
        
</body>

</html>