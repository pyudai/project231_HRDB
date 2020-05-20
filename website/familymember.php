<!DOCTYPE html>
<html>
    <head>
      <title>Family Member</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <style type="text/css">
        .topnav {
          overflow: hidden;
          background-color:#E8D8C9;
        }
        
        .topnav a {
          float: right;
          color: #b20e10;
          text-align: center;
          padding: 14px 16px;
          font-size: 54px;
        }
        .topnav a.text{
         color: #b20e10;
         font-family:Sarabun;
        }
        .topnav a.picture{
        float:left;
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
    
         body{
                font-family: Sarabun;
                -webkit-font-smoothing: antialiased;
                background:#F5F4F0;
            }
            
            tr.title {
              background: #CBB3A7;
            }
            
            tbody.tb {
              background: #FAFAFA;
            }

            .table {
                margin: auto;
                width: 80% !important; 
            }
     
        </style>
        
    </head>
    <body>
        <?php
            $con = mysqli_connect("localhost", "root", "", "hr_database");

            if (mysqli_connect_error()) {
                echo "Failed to Connect to MySQL : " . mysqli_connect_error();
            }
            $fam = NULL;
            $parent_name = NULL;
            $childID = NULL;
            $dob = NULL;
            $child = NULL;
        ?>
        <div class="topnav">
            <a class="text">Family member</a>
            <a class="picture"><img src="centar.png"></a>
        </div>
        <form class="container-fluid pt-3">
            <div>
                <select id="fam" name="fam" class="selectpicker" data-live-search="true"> 
                    <option> ALL </option>
                    <?php
                        $sql0 = "SELECT e.* FROM employeeinfo e, familymember f WHERE e.StaffID = f.StaffID GROUP BY StaffID ORDER BY StaffID;";
                        $result0 = mysqli_query($con, $sql0);
                        while($row0 = $result0->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row0["StaffID"];?>"> <?php echo $row0["StaffID"].' '.$row0["F_Name"].' '.$row0["L_Name"];?> </option>
                    <?php endwhile;?>
                </select>
                <input value="submit" type ="submit" name="submit" class="btn btn-lg btn-success">
                
                <?php 
                    if (isset($_GET['submit'])) {
                        $fam = $_GET['fam'];
                        if ($fam == 'ALL') {
                            $sql = "SELECT * FROM familymember WHERE StaffID = '$fam' ORDER BY ChildDOB"; 
                        } else {
                            $check = 1;
                            $sql = "SELECT * FROM familymember WHERE StaffID = '$fam' ORDER BY ChildDOB"; 
                        }  
                    } else {
                        $sql = "SELECT * FROM familymember WHERE StaffID = '$fam' ORDER BY ChildDOB"; 
                    }
                ?>

                <div class="mt-1 mx-auto pt-2 row input-group col-7">
                    <div class="input-group col-9 pt-2">
                        <span class="block input-group-text" style="background: #E8D8C9; padding: 4px 20px;">
                            Parent ID
                        </span>
                        <input id="parent" name="parent" type="text" class="form-control" value="<?php echo $fam;?>" style="width: 1000px;" readonly>

                        <span class="block input-group-text" style="background: #E8D8C9; padding: 4px 20px;">
                            Parent
                        </span>
                        <?php $sql3 = "SELECT * FROM employeeinfo WHERE StaffID = '$fam' GROUP BY StaffID"; 
                            $result3 = mysqli_query($con, $sql3);
                            while($row3 = $result3->fetch_assoc()):
                        ?>
                        <input id="p_name" name="p_name" type="text" class="form-control" value="<?php echo $row3["F_Name"].' '.$row3["L_Name"];?>" style="width: 1000px;" readonly>
                        <?php endwhile;?>
                    </div>
                    <div class="input-group col-9 pt-2">
                        <span class="block input-group-text" style="background: #E8D8C9; padding: 4px 20px;">
                            Child Name    
                        </span>
                        <input id="childname" name="childname" type="text" placeholder="Your Child Name" class="form-control" style="width: 1000px;">
                    </div>
                    <div class="input-group col-9 pt-2">
                        <span class="block input-group-text" style="background: #E8D8C9; padding: 4px 20px;">
                            Date of Birth    
                        </span>
                        <input id="DOB" name="DOB" type="date" class="form-control" style="width: 1000px;">
                    </div>
                    <input name = "add" type = "submit" id = "add" value = "Add" class="btn btn-lg btn-success">
                </div>
            </div>
            <br>
        
            <div class="row pt-2 pl-5 pr-5">
                <div class="col">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="title text-center">
                                <th style="width : 40%;">ChildName</th>
                                <th style="width : 40%;">Date of Birth</th>
                                <th style="width : 20%;">Delete</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row2 = $result->fetch_assoc()) {
                                        
                                        echo "<tr class='text-center'><td>". $row2["ChildName"]. "</td><td>". $row2["ChildDOB"]. "</td><td>" ?>
                                        <input class="form-check-input" type="radio" name="child" id="child" value="<?php echo $row2["childID"];?> ">
                                        <?php "</td></tr>";
                                    }
                                    
                                    echo "</table>";
                                } else { echo '<h4 style="margin: auto; width: 10%;"><span class="badge badge-info"> No Data </span></h4> <br>'; }
                                $con->close();
                            ?>

                        </tbody>
                    </table>
                    <div class="col text-right pt-5">
                        <input name = "delete" type = "submit" id = "delete" value = "Confirm Delete" class="btn btn-lg btn-success">
                    </div>
                    
                    <?php 
                        $show1 = NULL;
                        $show2 = NULL;
                        if(isset($_GET['delete'])) {
                            $con = mysqli_connect("localhost", "root", "", "hr_database");
                            if (isset($_GET['child'])) {
                                $childID = $_GET['child'];
                                $show1 = "Delete success";
                                $sql = "DELETE FROM familymember WHERE childID = $childID" ;
                                $retval = $con->query($sql);
                                
                                if(! $retval ) {
                                die('Could not delete data: ' . mysqli_connect_error());
                                } else {
                                    echo "<script> alert('Deleted data successfully'); </script>";
                                    $con->close();
                                }  
                            } else {
                                $show1 = "Delete failed";
                            }
                        } elseif(isset($_GET['add'])) {
                            $con = mysqli_connect("localhost", "root", "", "hr_database");
                            $childname = $_GET['childname'];
                            $dob = $_GET['DOB'];
                            $staffid = $_GET['parent'];
                            if ($childname != NULL AND $dob != NULL) {
                                $show2 = "Add success";
                                $sql = "INSERT INTO familymember (childID, StaffID, ChildName, ChildDOB) 
                                VALUES (NULL, '$staffid', '$childname', '$dob')";
                                if ($con->query($sql) === TRUE) {
                                    echo "<script> alert('New record in familymember is created.'); </script>";
                                } else {
                                    echo "Error: " . $sql . "<br>" . $con->error;
                                    $con->close();
                                } 
                            } else {
                                $show2 = "Add failed";
                            }
                        }
                        if ($show1 != NULL OR $show2) {
                            echo "<script> alert('$show1 $show2'); </script>";
                        }
                        
                    ?>
                </div>
            </div>
            <br>
            <a class="btn btn-success" href="HOME.php" role="button">BACK</a>
        </form>
        
    </body>
</html>