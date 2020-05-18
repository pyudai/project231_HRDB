<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Welfare (EDIT)</title>
    <script src="table2csv.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
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
        }
        
        tr.title {
            background: #CBB3A7;
        }
        
        tbody.tb {
            background: #FAFAFA;
        }
        
        body {
            font-family: Sarabun;
            -webkit-font-smoothing: antialiased;
            background: #F5F4F0;
            counter-reset: Serial;
        }
        
        tr td:first-child:before {
            counter-increment: Serial;
            content: " " counter(Serial);
        }
         td.a{
            position: center;
             background: #F5F4F0;
        }
    </style>
</head>

<body>
    <div class="topnav">
        <a class="text">Employee Welfare (EDIT)</a>
        <a class="picture"><img src="centar.png"></a>
    </div>
    
            <?php include('connectDB.php'); //ยังไม่ได้แก้กัน input เป็น input ได้บางอันด้วย
                    $StaffID =  $_SESSION['StaffID'];
                    $sql0 = "SELECT F_Name,L_Name FROM EmployeeInfo WHERE StaffID='$StaffID' LIMIT 1";
                    $result = mysqli_query($con, $sql0);
                  while ($row = $result->fetch_assoc()) {
                        $F_Name = $row["F_Name"];
                        $L_Name = $row["L_Name"];
                    }
                    $con->close();
        ?>
        
        <form class="container-fluid " method="post" >
            <div class="mx-auto pt-4 row input-group">
                   <div class=" input-group-prepend col-sm-4">
                      <span class="block input-group-text">StaffID</span>
                      <input type="text" class="form-control Nedit" name="StaffID" value="<?php echo $StaffID; ?>" readonly>
                  </div>
                  <div class="input-group-prepend col-sm-4">
                      <span class="block input-group-text" >First Name</span>
                      <input type="text" class="form-control Nedit" value="<?php echo $F_Name; ?>" readonly>
                  </div>
                  <div class="input-group-prepend col-sm-4">
                      <span class="block input-group-text">Last Name</span>
                      <input type="text" class="form-control Nedit" value="<?php echo $L_Name; ?>" readonly>
                </div>
            </div>

        <div class="row pt-5 pl-5 pr-5">
        <div class="col-3"></div>
        <div class="col-6">
            <table class="table table-bordered" style="font-size: 16px;">
                <thead>
                    <tr class="title text-center" >
                        <th>No.</th>
                        <th>Benefit</th>
                    </tr>
                </thead>
                <tbody class="tb text-center">
                    <?php include('connectDB.php'); 
                                    $sql = "SELECT * FROM Welfare w JOIN EmployeeBenefits b ON w.BenefitCode=b.BenefitCode WHERE StaffID='$StaffID' ORDER BY b.BenefitCode ";
                                $result = $con->query($sql);
                                $have=array();
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while($row2 = $result->fetch_assoc()) {
                                        array_push($have,$row2["BenefitCode"]);
                                        echo "<tr><td class='text-center'></td><td>" . $row2["BeniefitsDescription"]. "</td><td><button class='btn btn-danger' type='submit' name='delete' value=".$row2["BenefitCode"].">Delete</button></td></tr>";
                                    }
                                } else { echo "0 results"; }
                                $con->close();
                                $condition = implode(', ', $have);
                        ?>
                        <tr><td class='text-center'></td><td>
                                    <select name="benefit" class="selectpicker">
                                        <?php
                                            include('connectDB.php'); 
                                            $sql0 = "SELECT * FROM EmployeeBenefits WHERE BenefitCode NOT IN (".$condition.") ORDER BY BenefitCode ";
                                            $result0 = mysqli_query($con, $sql0);
                                            while($row0 = $result0->fetch_assoc()):
                                        ?>
                                        <option value="<?php echo $row0['BenefitCode'];?>"><?php echo $row0["BeniefitsDescription"];?></option>
                                        <?php endwhile; 
                                        $con->close();
                                        ?>
                                    </select>
                                </td>
                                <td><button class='btn btn-success' type='submit' name='add' >Add</button></td></tr>
                </tbody>
            </table>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col text-right pr-5">
                <button type="submit" class="btn btn-success" name='done' >Done</button>
            </div>
        </div>
    </form>
    
    <?php 
            if(isset($_POST['done']) )
                        {
                            echo "
                              <script>
                                window.location.href='welfare.php';
                            </script>";
                        }
                        
            if(isset($_POST['delete']) )
                        {
                            include('connectDB.php');
                            $delete=$_POST['delete'];
                              $sql0 = "DELETE FROM Welfare WHERE BenefitCode='$delete' AND StaffID='$StaffID' ";
                                $con->query($sql0);  
                                $con->close();
                                echo "
                                  <script>
                                    alert('Delete Benefit !!!');
                                    window.location.href='welfare_Edit.php';
                                </script>";

                        }
                        
            if(isset($_POST['add']) )
                        {
                            include('connectDB.php');
                            $benefit=$_POST['benefit'];
                              $sql0 = "INSERT INTO Welfare VALUES ('$StaffID','$benefit' )";
                                $con->query($sql0);  
                                $con->close();
                                echo "
                                  <script>
                                    alert('Add Benefit !!!');
                                    window.location.href='welfare_Edit.php';
                                </script>";

                        }

    ?>

</body>

</html>
