<!DOCTYPE html>
<html>
    <head>
        <title>Training History</title>
        <script src="table2csv.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <style type="text/css">
            .block1{
                    margin-left:50;
                    color:black;
                    border-radius:10px; 
                    padding: 5px 15px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    text-align: center;
                }
                
                .block {
                    background: #D3C0B6; 
                    color:black;
                }
            body {
                font-family: Sarabun;
                -webkit-font-smoothing: antialiased;
                background: #F5F4F0;
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
            
            body {
                font-family: Sarabun;
                font-size: 20px;
                background: #F5F4F0;
            }
            
            tr.title {
                background: #CBB3A7;
            }
            
            tr.tb {
                background: #FAFAFA;
            }
            
            body {
                font-family: Sarabun;
                -webkit-font-smoothing: antialiased;
                background: #F5F4F0;
                counter-reset: Serial;
            }

            .table {
                margin: auto;
                width: 70% !important; 
            }
        </style>
    </head>

    <body>
        <div class="topnav">
            <a class="text">Training History</a>
            <a class="picture"><img src="centar.png"></a>
        </div>

        <?php
                $con = mysqli_connect("localhost", "root", "", "hr_database");
                if (mysqli_connect_error()) {
                echo "Failed to Connect to MySQL : " . mysqli_connect_error();
                }
                $course = NULL;
                date_default_timezone_set("Asia/Bangkok");
                $current_date = date("Y-m-d");
                $stage = 0;
        ?>
        
        <form class="container-fluid ">
            <div class="mx-auto pt-4 row input-group">
                <div class="col input-group">
                    <span class="block input-group-text col-sm-auto">Course Name</span>
                    <select id="course" name="course" class="selectpicker" data-live-search="true"> 
                        <option> SELECT </option>
                        <?php
                            $sql0 = "SELECT * FROM course WHERE EvaluateDate = '0000-00-00';";
                            $result0 = mysqli_query($con, $sql0);
                            while($row0 = $result0->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row0["CourseID"];?>"> <?php echo $row0["CourseID"].' '.$row0["CourseName"];?> </option>
                        <?php endwhile;?>
                    </select>
                    <input value="submit" name="submit1" type ="submit" class="btn btn btn-success">
                
                <?php if(isset($_GET['submit1'])) {
                    $course = $_GET['course'];
                    if($course == 'SELECT') {
                        $start_date = NULL;
                        $end_date = NULL;
                    } else {
                        $sql1 = "SELECT * FROM course WHERE CourseID = '$course'";
                        $result1 = mysqli_query($con, $sql1);
                        while($row1 = $result1->fetch_assoc()) {
                            $start_date = $row1["StartCourse"];
                            $end_date = $row1["EndCourse"];
                            //echo $row1["StartCourse"]. " ". $row1["EndCourse"]; 
                        }
                    }
                } else {
                    $start_date = NULL;
                    $end_date = NULL;
                }
                ?>
                    <input name="course2" type="text" class="form-control" value="<?php echo $course;?>" readonly>
                </div>
                <div class="input-group-prepend col-sm-2">
                    <span class="block input-group-text">Start Date</span>
                    <input name="start_date" type="text" class="form-control" value="<?php echo $start_date;?>" readonly>
                </div>
                <div class="input-group-prepend col-sm-2">
                    <span class="block input-group-text">End Date</span>
                    <input name="end_date" type="text" class="form-control" value="<?php echo $end_date;?>" readonly>
                </div>
                <div class="input-group-prepend col-sm-3">
                    <span class="block input-group-text">Evaluation Date</span>
                    <input name="evaluate" type="text" class="form-control" value="<?php echo $current_date;?>" readonly>
                </div>
            </div>
            
            <div class="row pt-5 pl-5 pr-5">
                <table class="table table-bordered" style="font-size: 16px; width : 60%;">
                    <thead>
                        <tr class="title text-center">
                            <th style="width: 25%">StaffID</th>
                            <th style="width: 55%">Name</th>
                            <th style="width: 20%">Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($_GET['submit1'])) {
                        $course = $_GET['course'];
                        }
                        //array
                        $result = array();
                        $s_id = array();
                        $sql2 = "SELECT * FROM employeeinfo i, traininghistory t WHERE i.StaffID = t.StaffID AND t.CourseID = '$course' ORDER BY i.StaffID"; 
                        
                        $result2 = $con->query($sql2);
                        if ($result2->num_rows > 0) {
                            $stage = 1;
                            while($row2 = $result2->fetch_assoc()) {
                                
                                echo "<tr class='text-center'><td>". $row2["StaffID"]. "</td><td>". $row2["F_Name"]. " ". $row2["L_Name"]. "</td><td>" ?>
                                <div class="col-xs-2">
                                    <input name = "result[]" type = "text" id = "result[]" placeholder="1 - 10" class="form-control text-center" >
                                </div>
                                    <input name = "s_id[]" type = "text" id = "s_id[]" class="d-none" value="<?php echo $row2["StaffID"];?>">
                                <?php "</td></tr>";
                            }
                            echo "</table>";
                        } else { echo '<h4 style="margin: auto; width: 70%;"><span class="badge badge-info"> No Data </span></h4> <br>'; }
                        $con->close();
                        ?>
                    </tbody>
                </table>
            </div>
            <br>
            <?php if($stage == 1) {
            echo
                '<div class="col text-center pr-5">
                    <input value="submit" name="submit2" type ="submit" class="btn btn-lg btn-success">
                </div>';    
            }
           
            ?>
                <?php
                    $show1 = NULL;
                    $show2 = NULL;
                    $show3 = NULL;
                    $show4 = NULL;
                    $display1 = NULL;
                    $display2 = NULL;
                    if(isset($_GET['submit2'])) {
                        $result = $_GET['result'];
                        $s_id = $_GET['s_id'];
                        $course = $_GET['course2'];
                        $start_date = $_GET['start_date'];
                        $end_date = $_GET['end_date'];
                        $count = count($result);
                        //echo "$course, $start_date, $end_date, $count <br>";
                        $i = 0;
                        $j = 0;
                        while ($i < $count) {
                            $score = $result[$i];
                            $idstaff = $s_id[$i];
                            if (!ctype_digit($score) OR $score < 1 OR $score  > 10) {
                                $j = $j + 1;
                            }
                            $i = $i + 1;
                        }
                        $i = 0;
                        //echo $j;
                        while ($i < $count) {
                            $score = $result[$i];
                            $idstaff = $s_id[$i];
                            $con = mysqli_connect("localhost", "root", "", "hr_database");
                            //echo "$i  $score  $idstaff <br>";
                            if ($j==0) {
                                $score = intval($score);
                                //echo gettype($score). gettype($idstaff). '<br>';
                                $sql = "UPDATE traininghistory SET Result = '$score' WHERE StaffID = '$idstaff' AND CourseID = '$course'";
                                if ($con->query($sql) === TRUE) {   
                                    $show4 = "$idstaff update success. <br>";
                                } else {
                                    echo "Error: " . $sql . "<br>" . $con->error;
                                } 
                            
                                $sql3 = "SELECT * FROM course WHERE CourseID = '$course'";
                                $result3 = mysqli_query($con, $sql3);
                                while($row3 = $result3->fetch_assoc()) {
                                $skill = $row3["SkillID"];
                                //echo $skill. "<br>"; 
                                }
                                $check_skill = NULL;
                                $sql4 = "SELECT * FROM employeeskill WHERE StaffID = '$idstaff' AND SkillID = '$skill'";
                                $result4 = mysqli_query($con, $sql4);
                                // while($row4 = $result4->fetch_assoc()) {
                                // $check_skill = $row4["SkillID"];
                                //     echo "$skill = $check_skill <br>"; 
                                // }
                                if ($score > 4 AND $score < 11 AND $check_skill != $skill) {
                                    //insert
                                    $sql = "INSERT INTO employeeskill (StaffID, SkillID) VALUES ('$idstaff', '$skill')";
                                        if ($con->query($sql) === TRUE) {   
                                            $show1 = "$idstaff get new skill $skill.";
                                        } else {
                                            echo "Error: " . $sql . "<br>" . $con->error;
                                        }
                                } else {
                                    $show2 = "$idstaff not get skill $skill.";
                                }
                            } else {
                                $display1 = "$idstaff update error because result is not true.";
                            }
                            $i = $i + 1; 
                        }
                        if ($j==0) {
                            $show3 = "Evaluate Date Updated.";
                            //echo "<script> alert('Update success'); </script>";
                            $sql = "UPDATE course SET EvaluateDate = '$current_date' WHERE CourseID = '$course'";
                                if ($con->query($sql) === TRUE) {   
                                    echo "<script> alert('$show1  $show2  $show3'); </script>";
                                } else {
                                    echo "Error: " . $sql . "<br>" . $con->error;
                                }
                        } else {
                            $display2 = "Cannot update evaluate date.";
                            echo "<script> alert('$display1 $display2'); </script>";
                        }
                    }

                ?>
            <a type="button" class="btn btn-success" href="HOME.php">BACK</a>
        </form>
    </body>
</html>