<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Welfare</title>
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
    </style>
</head>

<body>
    <div class="topnav">
        <a class="text">Employee Welfare</a>
        <a class="picture"><img src="centar.png"></a>
    </div>

                 <?php include('connectDB.php'); //ยังไม่ได้แก้กัน input เป็น input ได้บางอันด้วย
                    //$StaffID =  $_SESSION['StaffID'];
                    $StaffID =  '100001';
                    $sql0 = "SELECT F_Name,L_Name FROM EmployeeInfo WHERE StaffID='$StaffID' LIMIT 1";
                    $result = mysqli_query($con, $sql0);
                  while ($row = $result->fetch_assoc()) {
                        $F_Name = $row["F_Name"];
                        $L_Name = $row["L_Name"];
                    }
                    $con->close();
                    $fileName= $StaffID."_EmployeeWelfare.csv";
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
 
    <div class="text-right pt-3 pr-4">
            <button type="submit"  class="btn btn-success" name="edit">Edit</button>
            <button onclick="exportTableToCSV('<?php echo $fileName;?>')" type="button" class="btn btn-success">Export to CSV</button>
    </div>

    <div class="row pt-5 pl-5 pr-5">
        <div class="col-3"></div>
        <div class="col-6">
        <table class="table table-bordered" style="font-size: 16px;">
            <thead>
                <tr class="title text-center">
                    <th>No.</th>
                    <th>Benefit</th>
                </tr>
            </thead>
            <tbody class="tb text-center">
                 <?php include('connectDB.php'); 
                            $sql = "SELECT * FROM Welfare w JOIN EmployeeBenefits b ON w.BenefitCode=b.BenefitCode WHERE StaffID='$StaffID' ORDER BY b.BenefitCode ";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                                while($row2 = $result->fetch_assoc()) {
                                    echo "<tr><td class='text-center'></td><td>" . $row2["BeniefitsDescription"]. "</td></tr>";
                                }
                            } else { echo "0 results"; }
                            $con->close();
                            ?>
            </tbody>
        </table>
        </div>
    </div>

    <div class="row pt-5">
        <div class="col text-right pr-5">
            <button type="submit" class="btn btn-success" name="home">Back</button>
        </div>
    </div>
    </form>
    
    <?php 
         if(isset($_POST['home']))
                {
                     echo "
                      <script>
                        window.location.href='HOME.php'; 
                    </script>";
                }
        if(isset($_POST['edit']))
            {
                 echo "
                  <script>
                    window.location.href='welfare_Edit.php';
                </script>";
            }
    ?>
    
</body>

</html>
