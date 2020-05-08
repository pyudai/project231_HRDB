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
     
        </style>
        
    </head>
    <body>
        <?php
            $con = mysqli_connect("localhost", "root", "", "hr_database");

            if (mysqli_connect_error()) {
                echo "Failed to Connect to MySQL : " . mysqli_connect_error();
            }
        ?>

        <div class="topnav">
            <a class="text">Family member</a>
            <a class="picture"><img src="centar.png"></a>
        </div>
        <form class="container-fluid ">
            <div>
                <select id="fam" name="fam" class="selectpicker" data-live-search="true"> 
                    <option> ALL </option>
                    <?php
                        $sql0 = "SELECT * FROM employeeinfo ORDER BY StaffID;";
                        $result0 = mysqli_query($con, $sql0);
                        while($row0 = $result0->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row0["StaffID"];?>"> <?php echo $row0["StaffID"].' '.$row0["F_Name"].' '.$row0["L_Name"];?> </option>
                    <?php endwhile;?>
                </select>
                <input value="submit" type ="submit" name="submit" class="btn btn-lg btn-success" style="transform:translateX(105%);">
            </div>
            
                <div class="mx-auto pt-4 row input-group">
                    <div class=" input-group-prepend col-sm-4">
                        <span class="block input-group-text">StaffID</span>
                        <input type="text" class="form-control">
                    </div>
                    <div class="input-group-prepend col-sm-4">
                        <span class="block input-group-text">First Name</span>
                        <input type="text" class="form-control">
                    </div>
                    <div class="input-group-prepend col-sm-4">
                        <span class="block input-group-text">Last Name</span>
                        <input type="text" class="form-control">
                    </div>
                </div>

            <div class="text-right pt-3 pr-5">
                <button type="button"  class="btn btn-success">Edit</button>
                <button  type="button"  class="btn btn-success">Add</button>
            </div>
        
            <div class="row pt-5 pl-5 pr-5">
                <div class="col">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="title text-center">
                                <th>ChildName 1</th>
                                <th>Date of Birth</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            
                                if (isset($_GET['submit'])) {
                                    $fam = $_GET['fam'];
                                    echo "   ".$fam."  ";
                                    if ($fam == 'ALL') {
                                        echo 1;
                                        $sql = "SELECT * FROM familymember ORDER BY ChildDOB"; 
                                    } else {
                                        echo 4;
                                        $sql = "SELECT * FROM familymember WHERE StaffID = '$fam' ORDER BY ChildDOB";  //Not finish
                                    }  
                                } else {
                                    $sql = "SELECT * FROM familymember ORDER BY ChildDOB"; 
                                }
                        
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    echo $result->num_rows;
                                    while($row2 = $result->fetch_assoc()) {
                                    
                                        echo "<tr><td>" . $row2["ChildName"]. "</td><td>" . $row2["ChildDOB"]. "</td></tr>";
                                    }
                                    
                                    echo "</table>";
                                } else { echo "0 results"; }
                                $con->close();
                            ?>

                        </tbody>
                    </table>
                    <a class="nav-link" href="HOME.php">back</a>
                </div>
            </div>
        
            <form class="container-fluid ">
                <div class="mx-auto pt-4 row input-group">
                    <div class = "col-sm-4"></div> 
                    <div class = "input-group-prepend col-sm-4">
                        <span class="block input-group-text">Total</span>
                        <input type= "integer" class="form-control">
                    </div>
                </div>
            </form>

            <div class="text-right pr-5">
                <button type ="button" class="btn btn-success">Next</button>
                <button type ="button" class="btn btn-success">Previous</button> 
            </div>
        </form>
    </body>
</html>