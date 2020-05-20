<!DOCTYPE html>
<html>
    <head>
    <title>Performance Review</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
        body {
            font-family: Sarabun;
            font-size: 22px;
            background-color: #F5F4F0 
        }
        .block {
            background: #E8D8C9;
        }
        br {
            display: block;
            content: " ";
            margin: 15px;
        }
        .threeline {
            display: block;
            content: " ";
            margin: 60px;
        }

        </style>
    </head>
        <body>
        <div class="container-fluid pt-3 pb-3" style="background: #E8D8C9;">
            <a class="picture"><img src="centar.png"></a>
            <a class="text-right" style="color:#B20E10; float: right; font-size:56px;">
                Performance Review
            </a>
        </div>
        <?php
            $con = mysqli_connect("localhost", "root", "", "hr_database");
            if (mysqli_connect_error()) {
              echo "Failed to Connect to MySQL : " . mysqli_connect_error();
            }
            $staff = NULL;
            $supervisor = NULL;
            $supervisorName = NULL;
            $posit = NULL;
            $depart = NULL;
            $job = 0;
            $quality = 0;
            $quantity = 0;
            $comment = NULL;
        ?>
        
       
        <br>
        <form class="container-fluid ">
        <div class='form-check'>
            <div>
                <div class="row mt-3 pt-2 mx-auto">
                    <div class="input-group-prepend col-sm-3">
                        <span class="block input-group-text">Review date</span>
                            <?php 
                                date_default_timezone_set("Asia/Bangkok");
                                $current_date = date("Y-m-d");
                                $current_time = date("H:i:s");
                                echo $current_date. " ". $current_time;
                            ?>
                    </div>
                    <div class="col input-group">
                        <span class="block input-group-text">Staff</span>
                        <select id="staff" name="staff" class="selectpicker" data-live-search="true"> 
                            <option value="0"> SELECT </option>
                            <?php
                                $sql0 = "SELECT * FROM employeeinfo WHERE StaffID IN (SELECT StaffID FROM performancereview WHERE StaffID NOT IN 
                                (SELECT StaffID FROM promotionalhistory WHERE PositionJobID = 'GSM' Or PositionJobID = 'HEM' GROUP BY StaffID)) ORDER BY StaffID;";
                                $result0 = mysqli_query($con, $sql0);
                                while($row0 = $result0->fetch_assoc()):
                            ?>
                            <option value="<?php echo $row0["StaffID"];?>"> <?php echo $row0["StaffID"].' '.$row0["F_Name"].' '.$row0["L_Name"];?> </option>
                            <?php endwhile;?>
                        </select>
                    </div>

                    <div class="col input-group">
                        <span class="block input-group-text">Supervisor</span>
                        <select id="supervisor" name="supervisor" class="selectpicker" data-live-search="true"> 
                            <option value="0"> SELECT </option>
                            <?php
                                $sql1 = "SELECT * FROM employeeinfo WHERE StaffID IN (SELECT StaffID FROM performancereview r WHERE r.PerformanceReviewDate IN
                                (SELECT p.PerformanceReviewDate FROM promotionalhistory p, positionjob j WHERE p.PositionJobID = j.PositionJobID AND (j.PositionJobID = 'GSM' OR j.PositionJobID = 'HEM')));";                        
                                $result1 = mysqli_query($con, $sql1);
                                while($row1 = $result1->fetch_assoc()):
                            ?>
                            <option value="<?php echo $row1["StaffID"];?>"> <?php echo $row1["StaffID"].' '.$row1["F_Name"].' '.$row1["L_Name"];?> </option>
                            <?php endwhile;?>
                        </select>
                    </div>
                </div>
            </div>

            <?php
                if (isset($_GET['submit2'])) {
                        $staff = $_GET['staff'];
                        $supervisor = $_GET['supervisor'];
                        if ($staff != 'SELECT') {
                            $sql = "SELECT * FROM employeeinfo WHERE StaffID = '$staff'"; 
                        }  
                    } else {
                        $staff = 'All';
                        $supervisor = 'All';
                        $sql = "SELECT * FROM employeeinfo WHERE StaffID = '$staff'"; 
                    }
                    
                    $result = mysqli_query($con, $sql);
                
                    <?php $sql1 = "SELECT * FROM positionjob j, promotionalhistory h 
                    WHERE j.PositionJobID = h.PositionJobID AND h.StaffID = '$staff' ORDER BY h.PromotionDate DESC LIMIT  1;";
                        $result1 = mysqli_query($con, $sql1);
                        while($row1 = $result1->fetch_assoc()):
                    ?>              
                    <?php 
                          $posit = $row1['PositionJobID'];?>
                    <?php endwhile;?>  
                    <?php $sql1 = "SELECT * FROM department j, promotionalhistory h 
                    WHERE j.DepartmentID = h.DepartmentID AND h.StaffID = '$staff' ORDER BY h.PromotionDate DESC LIMIT  1;";
                        $result1 = mysqli_query($con, $sql1);
                        while($row1 = $result1->fetch_assoc()):
                    ?>       
                    <?php
                          $depart = $row1['DepartmentID'];?>
                    <?php endwhile;?>  
                <?php $sql1 = "SELECT * FROM employeeinfo WHERE StaffID = '$supervisor'";
                        $result1 = mysqli_query($con, $sql1);
                        while($row1 = $result1->fetch_assoc()):
                    ?>       
                    <?php 
                          $supervisorName = $row1['F_Name']. ' '. $row1['L_Name'];?>
                    <?php endwhile;?>   
                
        
            <br class="threeline">
            
                
                    <div  name="job" class="input-group-prepend col-4">
                        <div class="input-group-prepend col-12">
                            <span class="block input-group-text" 
                            style="background: #E8D8C9; padding: 5px 15px;font-family: Sarabun;font-size: 18px; transform:translateX(180%);">
                                Job Knowledge
                            </span>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="job" id="job" value="1">
                            <label class="form-check-label" for="job">1</label>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="job" id="job" value="2">
                            <label class="form-check-label" for="job">2</label>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="job" id="job" value="3">
                            <label class="form-check-label" for="job">3</label>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="job" id="job" value="4">
                            <label class="form-check-label" for="job">4</label>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="job" id="job" value="5">
                            <label class="form-check-label" for="job">5</label>
                        </div>
                    </div>
                    <br> 
                    <div name="quantity" class="input-group-prepend col-4">
                        <div class="input-group-prepend col-12">
                            <span class="block input-group-text" 
                            style="background: #E8D8C9; padding: 5px 15px;font-family: Sarabun;font-size: 18px;transform:translateX(165%);">
                                Quantity of Work
                            </span>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="quantity" id="quantity" value="1">
                            <label class="form-check-label" for="quantity">1</label>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="quantity" id="quantity" value="2">
                            <label class="form-check-label" for="quantity">2</label>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="quantity" id="quantity" value="3">
                            <label class="form-check-label" for="quantity">3</label>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="quantity" id="quantity" value="4">
                            <label class="form-check-label" for="quantity">4</label>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="quantity" id="quantity" value="5">
                            <label class="form-check-label" for="quantity">5</label>
                        </div>
                    </div>
                    <br> 
                
                    <div naem="quality" class="input-group-prepend col-4">
                        <div class="input-group-prepend col-12">
                            <span class="block input-group-text" 
                            style="background: #E8D8C9; padding: 5px 15px;font-family: Sarabun;font-size: 18px;transform:translateX(176%);">
                                Quality of Work
                            </span>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="quality" id="quality" value="1">
                            <label class="form-check-label" for="quality">1</label>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="quality" id="quality" value="2">
                            <label class="form-check-label" for="quality">2</label>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="quality" id="quality" value="3">
                            <label class="form-check-label" for="quality">3</label>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="quality" id="quality" value="4">
                            <label class="form-check-label" for="quality">4</label>
                        </div>
                        <div class="form-check form-check-inline col-3">
                            <input class="form-check-input" type="radio" name="quality" id="quality" value="5">
                            <label class="form-check-label" for="quality">5</label>
                        </div>
                    </div> <br class="threeline">
                    <div class="mt-1 mx-auto pt-3 row input-group col-7">
                        <div class="input-group-prepend col-12">
                            <span class="block input-group-text" style="background: #E8D8C9; padding: 4px 20px;font-family: Sarabun;font-size: 18px;">
                                Comment    
                            </span>
                            <input id="comment" name="comment" type="text" class="form-control" style="width: 1000px;">
                        </div>
                    </div> <br class="threeline">
                    <input value="submit" name="submit2" type ="submit" class="btn btn-lg btn-success" style="transform:translateX(805%);">
                </div>
            
                <br>
                <?php 
                    $check1 = 0; 
                    $check2 = 0;
                    $job = 0;
                    $quality = 0;
                    $quantity = 0;
                    $comment = NULL;
                    if(isset($_GET['submit2'])){
                        if($staff != 0 && $supervisor != 0 ) {
                            $job = $_GET['job'];
                            $quantity = $_GET['quantity'];
                            $quality = $_GET['quality'];
                            $comment = $_GET['comment'];
                            if($job != 0 AND $quality != 0 AND $quantity != 0 AND $comment != NULL) {
                                $sql = "INSERT INTO performancereview (StaffID, PerformanceReviewDate, JobKnowledge, QuantityofWork, QualityofWork, Comments)
                                        VALUES ('$staff', '$current_date', '$job', '$quantity', '$quality', '$comment')";
                                if ($con->query($sql) === TRUE) {
                                    $check1 = 1;
                                } else {
                                    $check1 = 0;
                                }

                                $sql = "INSERT INTO promotionalhistory (StaffID, PositionJobID, DepartmentID, PerformanceReviewDate, PromotionDate, SuperVisorName)
                                        VALUES ('$staff', '$posit', '$depart', '$current_date', NULL, '$supervisorName')";
                                if ($con->query($sql) === TRUE) {
                                    $check2 = 1;
                                } else {
                                    $check2 = 0;
                                }

                                if ($check1 == 1 AND $check2 == 1) {
                                    echo "<script> alert('Result recorded'); </script>";
                                } else {
                                    echo "<script> alert('Error $check1 $check2'); </script>";
                                }
                            } else {
                                echo "<script> alert('Please let us know about you thought for this staff.'); </script>";
                            }
                            
                        } else {
                            echo "<script> alert('Choose Staff and Superviser'); </script>";
                        }
                        

                    $con->close();
                    } else {
                        
                    }                   
                ?>
                <a class="btn btn-success" href="HOME.php" role="button">BACK</a>
        </form>
    </body>
</html>