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
        .table {
                margin: auto;
                width: 80% !important; 
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
            $check_stage = 0;
            $late = 0;
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
                        <!-- <select id="tcdate" name="tcdate"  class="selectpicker" data-live-search="true">
                            <option> ALL </option>
                            <?php
                                $sql1 = "SELECT * FROM dailytimecard GROUP BY TCDate";
                                $result1 = mysqli_query($con, $sql1);
                                while($row1 = $result1->fetch_assoc()):
                            ?>
                            <option><?php echo $row1["TCDate"];?></option>
                            <?php endwhile;?>
                        </select> -->
                        <input id="tcdate" name="tcdate" type="date" class="form-control">
                    </div>

                    <div class="input-group-prepend col-sm-2">
                        <span class="block input-group-text">To</span>
                        <!-- <select id="enddate" name="enddate"  class="selectpicker" data-live-search="true">
                            <option value="0"> - </option>
                            <?php
                                $sql2 = "SELECT * FROM dailytimecard GROUP BY TCDate";
                                $result2 = mysqli_query($con, $sql2);
                                while($row2 = $result2->fetch_assoc()):
                            ?>
                            <option><?php echo $row2["TCDate"];?></option>
                            <?php endwhile;?>
                        </select> -->
                        <input id="enddate" name="enddate" type="date" class="form-control">
                    </div>
                    <input value="submit" type ="submit" name="submit" class="btn btn-md btn-success" >
                </div>
            </div>
            <br>
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr class="title text-center">
                            <th style="width : 15%;">StaffID</th>
                            <th style="width : 20%;">Date</th>
                            <th style="width : 15%;">Time IN</th>
                            <th style="width : 15%;">Time OUT</th>
                            <th style="width : 15%;">On time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (isset($_GET['submit'])) {
                                $depart = $_GET['depart'];
                                $tcdate = $_GET['tcdate'];
                                $enddate = $_GET['enddate'];
                                echo $tcdate. " ". $enddate;
                                if ($tcdate == NULL AND $depart == 'ALL' AND $enddate == NULL) {
                                    $sql = "SELECT StaffID, TCDate, TimeIn, TimeOut FROM dailytimecard ORDER BY TCDate DESC, TimeIn, TimeOut"; 
                                } elseif ($tcdate != NULL AND $depart == 'ALL' AND $enddate == NULL) {
                                    $check_stage = 1;
                                    $sql = "SELECT StaffID, TCDate, TimeIn, TimeOut FROM dailytimecard WHERE TCDate = '$tcdate' ORDER BY TCDate DESC, TimeIn, TimeOut";
                                } elseif ($tcdate != NULL AND $depart == 'ALL' AND $enddate != NULL) {
                                    $check_stage = 2;
                                    $sql = "SELECT StaffID, TCDate, TimeIn, TimeOut FROM dailytimecard WHERE TCDate BETWEEN '$tcdate' AND '$enddate' ORDER BY TCDate DESC, TimeIn, TimeOut";
                                } elseif ($depart != 'ALL' AND $tcdate == NULL AND $enddate == NULL) {
                                    $sql = "SELECT StaffID, TCDate, TimeIn, TimeOut FROM dailytimecard WHERE StaffID IN
                                    (SELECT StaffID FROM promotionalhistory p, department d WHERE p.DepartmentID = d.DepartmentID AND d.Department_Name = '$depart') 
                                    ORDER BY TCDate DESC, TimeIn, TimeOut"; 
                                } else {
                                    $check_stage = 3;
                                    $sql = "SELECT StaffID, TCDate, TimeIn, TimeOut FROM dailytimecard WHERE TCDate = '$tcdate' AND StaffID IN
                                    (SELECT StaffID FROM promotionalhistory p, department d WHERE p.DepartmentID = d.DepartmentID AND d.Department_Name = '$depart') 
                                    ORDER BY TCDate DESC"; 
                                }
                                
                            } else {
                                $sql = "SELECT StaffID, TCDate, TimeIn, TimeOut FROM dailytimecard ORDER BY TCDate DESC, TimeIn, TimeOut";
                            }
                            $result = $con->query($sql);
                            $check_time = date("09:00:00");
                            
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $time = $row['TimeIn'];
                                    //echo $time. " ". gettype($time). " ". $check_time;
                                    if ($time > $check_time) {
                                        $late = $late + 1;
                                        echo "<tr class='text-center'><td>". $row["StaffID"]. "</td><td>". $row["TCDate"]. "</td><td>". 
                                        $row["TimeIn"]. "</td><td>". $row["TimeOut"]. "</td><td>" ?>
                                        <img src="fault.png" class="rounded mx-auto d-block" style="width: 12%; height: 4.8%;" >
                                     <?php "</td></tr>";
                                    } else {
                                        echo "<tr class='text-center'><td>". $row["StaffID"]. "</td><td>". $row["TCDate"]. "</td><td>". 
                                        $row["TimeIn"]. "</td><td>". $row["TimeOut"]. "</td><td>" ?> 
                                        <img src="correct_logo.png" class="rounded mx-auto d-block" style="width: 15.2; height: 6.8%;" >
                                    <?php "</td></tr>";
                                    }
                                }
                                echo "</table>";
                            } else { echo '<h4 style="margin: auto; width: 10%;"><span class="badge badge-info"> No Data </span></h4> <br>'; }
                            $con->close();
                        ?>
                    </tbody>    
                </table>
                <br>
                <?php if ($late > 0 AND $check_stage > 0) { ?>
                    <h3 class="float-right"><a class="h1 badge badge-info">
                        LATE : <span class="badge badge-light"><?PHP echo $late;?></span>
                    </a></h3>
                <?php }
                ?>
                
            </div>
            <a class="btn btn-success" href="HOME.php" role="button">BACK</a>
        </form>
    </body>
</html>
