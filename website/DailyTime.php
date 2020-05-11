<!DOCTYPE html>
<html>
    <head>
        <title>Daily Time</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <style type="text/css">
        body {
            font-family: Sarabun;
            -webkit-font-smoothing: antialiased;
            background:#F5F4F0;
        }
        
        .block {
            background: #D3C0B6; 
        	color:black;       
        }
        
        tr.title {
        	background: #CBB3A7;
        }
        
        tr.tb {
        	background: #FAFAFA;
        }
        
        .topnav {
          overflow: hidden;
          background-color:#E8D8C9;
        }
        
        .topnav a {
          float: right;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
          font-size: 54px;
        }
        .topnav a.text {
          color:#b20e10;
        }
        .topnav a.picture{
            float:left;
        }

        
        </style>
    </head>
    <body>

        <div class="topnav">
            <a class="text">DailyTime</a>
            <a class="picture"><img src="centar.png"></a>
        </div>
        <?php
            $con = mysqli_connect("localhost", "root", "", "hr_database");
            if (mysqli_connect_error()) {
                echo "Failed to Connect to MySQL : " . mysqli_connect_error();
            }
        ?>

        <form class="container-fluid ">
            <div>
            <div class="row mt-4 pt-4 mx-auto">
                    <div class="input-group-prepend col-sm-3">
                        <span class="block input-group-text">Department</span>
                        <select id="depart" name="depart" class="selectpicker" data-live-search="true">
                            <option> ALL </option>
                            <?php
                                $sql0 = "SELECT * FROM department";
                                $result0 = mysqli_query($con, $sql0);
                                while($row0 = $result0->fetch_assoc()):
                            ?>
                            <option><?php echo $row0["Department_Name"];?></option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    <div class="input-group-prepend col-sm-3">
                        <span class="block input-group-text">Date</span>
                        <select id="tcdate" name="tcdate"  class="selectpicker" data-live-search="true">
                            <option> ALL </option>
                            <?php
                                $sql1 = "SELECT * FROM dailytimecard GROUP BY TCDate";
                                $result1 = mysqli_query($con, $sql1);
                                while($row1 = $result1->fetch_assoc()):
                            ?>
                            <option><?php echo $row1["TCDate"];?></option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    <input value="submit" type ="submit" name="submit" class="btn btn-lg btn-success" style="transform:translateX(105%);">
                </div>
            </div>
            
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr class="title text-center">
                            <th>StaffID</th>
                            <th>Date</th>
                            <th>Time IN</th>
                            <th>Time OUT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (isset($_GET['submit'])) {
                                $depart = $_GET['depart'];
                                $tcdate = $_GET['tcdate'];
                                //echo $depart;
                                //echo $tcdate;
                                if ($tcdate == 'ALL' AND $depart == 'ALL') {
                                    $sql = "SELECT StaffID, TCDate, TimeIn, TimeOut FROM dailytimecard ORDER BY TCDate DESC, TimeIn, TimeOut"; 
                                } elseif ($tcdate != 'ALL' AND $depart == 'ALL') {
                                    $sql = "SELECT StaffID, TCDate, TimeIn, TimeOut FROM dailytimecard WHERE TCDate = '$tcdate' ORDER BY TCDate DESC, TimeIn, TimeOut";
                                } elseif ($depart != 'ALL' AND $tcdate == 'ALL') {
                                    $sql = "SELECT StaffID, TCDate, TimeIn, TimeOut FROM dailytimecard WHERE StaffID IN
                                    (SELECT StaffID FROM promotionalhistory p, department d WHERE p.DepartmentID = d.DepartmentID AND d.Department_Name = '$depart') ORDER BY TCDate DESC, TimeIn, TimeOut"; //Not finish
                                } else {
                                    $sql = "SELECT StaffID, TCDate, TimeIn, TimeOut FROM dailytimecard WHERE TCDate = '$tcdate' AND StaffID IN
                                    (SELECT StaffID FROM promotionalhistory p, department d WHERE p.DepartmentID = d.DepartmentID AND d.Department_Name = '$depart') ORDER BY TCDate DESC"; //Not finish
                                }
                                
                            } else {
                                $sql = "SELECT StaffID, TCDate, TimeIn, TimeOut FROM dailytimecard ORDER BY TCDate DESC, TimeIn, TimeOut";
                            }
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                                while($row2 = $result->fetch_assoc()) {
                                    
                                    echo "<tr><td>" . $row2["StaffID"]. "</td><td>" . $row2["TCDate"]. "</td><td>" 
                                    . $row2["TimeIn"]. "</td><td>" . $row2["TimeOut"]. 
                                    
                                    "</td></tr>";
                                }
                                echo "</table>";
                            } else { echo "0 results"; }
                            $con->close();
                        ?>
                    </tbody>    
                </table>
            </div>
            <a class="nav-link" href="HOME.php">back</a>
        </form>
    </body>
</html>
