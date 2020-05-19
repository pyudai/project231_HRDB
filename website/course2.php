<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    
    <style type="text/css">
      body{
            font-family: Sarabun;
            -webkit-font-smoothing: antialiased;
            background:#F5F4F0;
        }
        
        .topnav {
            overflow: hidden;
            background-color: #E8D8C9;
        }
        
        .topnav a {
            float: right;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 54px;
        }
        
        .topnav a.text {
            color: #b20e10;
        }
        
        .topnav a.picture {
            float: left;
        }

        .block1{
          color:black;
            border-radius:10px; 
            margin-top: 25;
            margin-left: 25;
            padding: 5px 15px;
        }
        
        .block {
              background: #D3C0B6; 
              color:black;
            }
            
        body {
            font-family: Sarabun;
            font-size: 20px;
            background: #F5F4F0;
            counter-reset: Serial;   
        }
        tbody.tb {
              background: #FAFAFA;
            }
        tr.title {
        	background: #CBB3A7;
        }
        tr td:first-child:before
            {
              counter-increment: Serial;      /* Increment the Serial counter */
              content: " " counter(Serial); /* Display the counter */
          }
        td.a{
            position: center;
             background: #F5F4F0;
        }
        
    </style>
</head>

<body>
       
    <div class="topnav">
        <a class="text">Courses</a>
        <a class="picture"><img src="centar.png"></a>
    </div>
<form method ="get" >
    <?php
            $con = mysqli_connect("localhost", "root", "", "hr_database");
            if (mysqli_connect_error()) {
                echo "Failed to Connect to MySQL : " . mysqli_connect_error();
            }
            $Date = NULL;
        ?>
     <select id="Date" name="Date" 
        class="selectpicker" data-live-search="true"style="background: a color: black; margin-left: 25; margin-top: 25; width:250;"> <option> ALL </option>
        <?php
                        $sql0 = "SELECT EvaluateDate FROM course GROUP BY EvaluateDate ORDER BY EvaluateDate ";
                        $result0 = mysqli_query($con, $sql0);
                        while($row0 = $result0->fetch_assoc()):
                    ?>
        <option value="<?php echo $row0["EvaluateDate"];?>"><?php echo $row0["EvaluateDate"];?></option>
        <?php endwhile;?>
        </select>
        <input value="submit" type ="submit" name="submit" class="btn btn-lg btn-success">
                
                <?php 
                    if (isset($_GET['submit'])) {
                        $Date = $_GET['Date'];
                        if ($Date == 'ALL') {
                            $sql2 = "SELECT * FROM course ORDER BY EvaluateDate"; 
                        } else {
                            $check = 1;
                            $sql2 = "SELECT * FROM course WHERE EvaluateDate = '$Date' ORDER BY EvaluateDate";  
                        }  
                    } else {
                        $sql2 = "SELECT * FROM course WHERE EvaluateDate = '$Date' ORDER BY EvaluateDate"; 
                    }
                ?>
        <?php 
        $mysqli = new mysqli('localhost','root','','hr_database') or die(mysqli_error($mysqli));
        $result = $con->query($sql2);
        ?>
       <div class="row pt-5 pl-5 pr-5">
        <table class="table table-bordered" style="font-size: 16px;">
                 <thead>
                <tr class="title text-center">
                    <th>No.</th>
                    <th>CourseID</th>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody class="tb">
        <?php
          $result = $con->query($sql2);
        while ($row2=$result->fetch_assoc()):?>
            <tr class="text-center">
                <td><?php echo '';?></td>
                <td><?php echo $row2['CourseID'];?></td>
                <td><?php echo $row2['CourseName'];?></td>
                <td><?php echo $row2['CourseDescription'];?></td>
                <td><?php echo $row2['StartCourse'];?></td>
                <td><?php echo $row2['EndCourse'];?></td>
                <td class="a" width="7%">
                    <button name="delete" value="<?php echo $row2['CourseID'];?>" class="btn btn-danger">Delete</button>    
                </td>
            </tr>
        <?php endwhile;?>
             </table>
	  		</tbody>
        </table>
    </div>
 <form class="container-fluid ">
            <div class="mx-auto pt-4 row input-group">
             <div class=" input-group-prepend col-sm-4">
              <span class="block input-group-text">CourseID</span>
                  <input id="CourseID" name="CourseID" type="text" placeholder="CourseID" class="form-control" style="width: 450px;">
            </div>
            <div class="input-group-prepend col-sm-4">
              <span class="block input-group-text">CourseName</span>
                  <input id="CourseName" name="CourseName" type="text" placeholder="Course Name" class="form-control" style="width: 500px;">
            </div>
          <div class="input-group-prepend col-sm-4">
              <span class="block input-group-text">Description</span>
              <input id="Description" name="Description" type="text" placeholder="Course Description" class="form-control" style="width: 1000px;">
            </div>
        <div class="mt-4 mx-auto pt-3 row input-group">  
        <div class="col input-group">
        <div class="input-group-prepend">
          <span class="block input-group-text" id="">StartDate</span>
        </div>
        <input id="StartDate" name="StartDate"type="date" class="form-control" style="width: 250px;">
        <span class="block input-group-text" id="">EndDate</span>
        <input id="EndDate" name="EndDate"type="date" class="form-control" style="width: 250px;">
        </div>
         <input name = "add" type = "submit" id = "add" value = "Add" class="btn btn-lg btn-success">
        </div> 
        </div>
        </form>



</form>
<div class="row pt-5">
	<div class="col text-right pr-5">
         <a href="HOME.php" class="btn btn-success">BACK</a>
    </div>
</div>

<?php
if(isset($_GET['delete'])){
    $mysqli = new mysqli('localhost','root','','hr_database') or die(mysqli_error($mysqli));
    $con = mysqli_connect("localhost", "root", "", "hr_database");
                if (mysqli_connect_error()) {
                    echo "Failed to Connect to MySQL : " . mysqli_connect_error();
                }
                $delete=$_GET['delete'];
                $sql0 = "SELECT CourseID FROM traininghistory WHERE CourseID='$delete'";
                $result =$con->query($sql0); 
                    while ($row2 = $result->fetch_assoc()) {
                                $CourseID = $row2["CourseID"];
                            }
                            if($CourseID==''){
                                $q="DELETE FROM course WHERE CourseID='$delete'";
                                mysqli_query($con,$q);
                                $con->close();
                                echo "
                                  <script>
                                    alert('Delete Course!');
                                    window.location.href='course2.php';
                                </script>";
                            }
                            else{
                                    echo "
                                  <script>
                                    alert('Can not delete ');
                                    window.location.href='course2.php';
                                </script>";
                            }
                        }
                                       
?>
<?php
if(isset($_GET['add'])) {
                            $con = mysqli_connect("localhost", "root", "", "hr_database");
                            $CourseID = $_GET['CourseID'];
                            $CourseName = $_GET['CourseName'];
                            $Description = $_GET['Description'];
                            $StartDate = $_GET['StartDate'];
                            $EndDate = $_GET['EndDate'];
                           // echo $CourseID. $CourseName. $Description. $StartDate. $EndDate;
                            $sql = "INSERT INTO course (CourseID, CourseName, CourseDescription,StartCourse,
                            EndCourse,EvaluateDate)
                                    VALUES ('$CourseID', '$CourseName', '$Description', '$StartDate',
                                    '$EndDate','NULL')";
                                echo "
                                  <script>
                                    alert('add course!');
                                    window.location.href='course2.php';
                                </script>";

                            if ($con->query($sql) === TRUE) {
                                //echo "New record in course created successfully";
                            } else {
                                echo "Error: " . $sql . "<br>" . $con->error;
                                $con->close();
                            }
                        }
?>

</body>

</html>