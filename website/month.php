<!DOCTYPE html>
<html lang="en">

<head>
    <title>Monthly Payslip (Edit)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Sarabun;
            -webkit-font-smoothing: antialiased;
            background: #F5F4F0;
        }
        
        b.title {
            font-size: 20px;
        }
        
        .block {
            background: #D3C0B6;
            color: black;
        }
        
        .checkbox {
            color: black;
            font-size: 20px;
        }
        
        tr.title {
            background: #CBB3A7;
        }
        
        tbody.tb {
            background: #FAFAFA;
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
    </style>

</head>

<body>

    <div class="topnav">
        <a class="text">Monthly Payslip (Edit)</a>
         <a class="picture"><img src="centar.png"></a>
    </div>

    <?php include('connectDB.php');
                    $StaffID =  '100001';
                    $query = "SELECT F_Name,L_Name, AccountNo  FROM EmployeeInfo WHERE StaffID='$StaffID' LIMIT 1";
                    $result = mysqli_query($con, $query);
                    if ($result == false) {
                        echo "query failed: ".$con->error;
                     }
                  while ($row = $result->fetch_assoc()) {
                        $F_Name = $row["F_Name"];
                        $L_Name = $row["L_Name"];
                        $accNo = $row["AccountNo"];
                    }
                 
                    $query1 = "SELECT PositionJobName,ph.PositionJobID FROM  PositionJob p  JOIN PromotionalHistory ph ON ph.positionjobID = p.positionjobID  WHERE ph.StaffID='$StaffID' ORDER BY promotiondate DESC LIMIT 1";
                    $result1 =  $con->query($query1);
                    if ($result1 == false) {
                        echo "query failed: ".$con->error;
                     }
                    while ($row = $result1->fetch_assoc()) {
                        $posN = $row["PositionJobName"];
                        $posID= $row["PositionJobID"];
                    }

                    $query2 = "SELECT department_Name,ph.DepartmentID FROM Department d JOIN PromotionalHistory ph ON ph.departmentID = d.departmentID  WHERE ph.StaffID='$StaffID' ORDER BY promotiondate DESC LIMIT 1";
                    $result2 =  $con->query($query2);
                    if ($result2 == false) {
                        echo "query failed: ".$con->error;
                     }
                    while ($row = $result2->fetch_assoc()) {
                        $deN = $row["department_Name"];
                        $dID = $row["DepartmentID"];
                    }
                    
                    $payD = '2019-12-31';
     
                    $query3 = "SELECT MAX(payrollNo) AS maxNo FROM Monthlypayslip ";
                    $result3 =  $con->query($query3);
                    while ($row = $result3->fetch_assoc()) {
                        $payrollNo = 1+$row["maxNo"];
                    }

                    $query4 = "SELECT COUNT(TCDate) AS Late FROM DailyTimeCard WHERE TimeIn > '8:30:00' AND StaffID='$StaffID'";
                    $result4 = mysqli_query($con, $query4);
                    if ($result4 == false) {
                        echo "query failed: ".$con->error;
                     }
                    while ($row = $result4->fetch_assoc()) {
                        $Late = $row["Late"];
                    }

                    $query5 = "SELECT COUNT(TCDate) AS WorkingDay FROM DailyTimeCard WHERE TCDate BETWEEN '2019-12-01' AND '2019-12-31' AND StaffID='$StaffID'";
                    $result5 = mysqli_query($con, $query5);
                    if ($result5 == false) {
                        echo "query failed: ".$con->error;
                     }
                    while ($row = $result5->fetch_assoc()) {
                        $wkday = $row["WorkingDay"];
                    }

                    
                    $query6 = "SELECT COUNT(AbsentDate) AS Absentday FROM absent WHERE AbsentDate BETWEEN '2019-12-01' AND '2019-12-31' AND StaffID='$StaffID'";
                    $result6 = mysqli_query($con, $query6);
                    if ($result6 == false) {
                        echo "query failed: ".$con->error;
                     }
                    while ($row = $result6->fetch_assoc()) {
                        $abday = $row["Absentday"];
                    }

                    $query7 = "SELECT DATEDIFF(VDateEnd,VDateStart) AS duration FROM vacation WHERE (VDateEnd BETWEEN '2019-12-01' AND '2019-12-31') 
                    AND (VDateStart BETWEEN '2019-12-01' AND '2019-12-31') AND StaffID='$StaffID'";
                    $result7 = mysqli_query($con, $query7);
                    if ($result7 == false) {
                        echo "query failed: ".$con->error;
                     }
                     $vday=0;
                    while ($row = $result7->fetch_assoc()) {
                        $vday += $row["duration"];
                    }
                    
                    $query8 = "SELECT amountIn FROM EmployeeIncome e JOIN IncomeCode i ON e.IncomeCode=i.IncomeCode WHERE DescriptionIn='Monthly Salary' AND StaffID='$StaffID' ";
                    $result8 = mysqli_query($con, $query8);

                    while ($row = $result8->fetch_assoc()) {
                       $salary = $row["amountIn"];
                    }
                    
                    $query = "SELECT amountIn FROM EmployeeIncome e JOIN IncomeCode i ON e.IncomeCode=i.IncomeCode WHERE DescriptionIn='Bonus' AND StaffID='$StaffID' ";
                    $result = mysqli_query($con, $query);

                    while ($row = $result->fetch_assoc()) {
                       $bonus = $row["amountIn"];
                    }
                    
                    $query="SELECT SUM(HOUR(timediff(TimeOut,'16:00:00')))*100 AS OT FROM hr_database.DailyTimeCard WHERE StaffID='100001'AND( TCDate BETWEEN '2019-12-01' AND '2019-12-31')";
                    $result = mysqli_query($con, $query);

                    while ($row = $result->fetch_assoc()) {
                       $OT = $row["OT"];
                    }
                    
                    $query = "SELECT amountDed FROM EmployeeDeduction e JOIN DeductionCode d ON e.DeductionCode=d.DeductionCode WHERE DescriptionDed='Employment Insurance' AND StaffID='$StaffID' ";
                    $result = mysqli_query($con, $query);

                    while ($row = $result->fetch_assoc()) {
                       $EmInsu = $row["amountDed"];
                    }
                    
                    $query = "SELECT amountDed FROM EmployeeDeduction e JOIN DeductionCode d ON e.DeductionCode=d.DeductionCode WHERE DescriptionDed='Long Term Equity Fund' AND StaffID='$StaffID' ";
                    $result = mysqli_query($con, $query);

                    while ($row = $result->fetch_assoc()) {
                       $LTF = $row["amountDed"];
                    }
                    
                    $query = "SELECT amountDed FROM EmployeeDeduction e JOIN DeductionCode d ON e.DeductionCode=d.DeductionCode WHERE DescriptionDed='Medicare' AND StaffID='$StaffID' ";
                    $result = mysqli_query($con, $query);

                    while ($row = $result->fetch_assoc()) {
                       $medCare = $row["amountDed"];
                    }
                    
                    $query = "SELECT amountDed FROM EmployeeDeduction e JOIN DeductionCode d ON e.DeductionCode=d.DeductionCode WHERE DescriptionDed='Retirement Mutual Fund' AND StaffID='$StaffID' ";
                    $result = mysqli_query($con, $query);

                    while ($row = $result->fetch_assoc()) {
                       $RMF = $row["amountDed"];
                    }
                    
                    $query = "SELECT amountDed FROM EmployeeDeduction e JOIN DeductionCode d ON e.DeductionCode=d.DeductionCode WHERE DescriptionDed='Social Security' AND StaffID='$StaffID' ";
                    $result = mysqli_query($con, $query);

                    while ($row = $result->fetch_assoc()) {
                       $SoIn = $row["amountDed"];
                    }
                    
                    $query = "SELECT amountDed FROM EmployeeDeduction e JOIN DeductionCode d ON e.DeductionCode=d.DeductionCode WHERE DescriptionDed='Withholding tax' AND StaffID='$StaffID' ";
                    $result = mysqli_query($con, $query);

                    while ($row = $result->fetch_assoc()) {
                       $HTAX = $row["amountDed"];
                    }
                    
                    $con->close();
                    ?>

       
        


    <form class="container-fluid " method="post">

        <div class="mt-4 mx-auto pt-3 row input-group">
            <div class=" input-group-prepend col-sm-3">
                <span class=" block input-group-text">StaffID</span>
                <input type="text" class="form-control" name="StaffID" value="<?php echo $StaffID; ?>" readonly>
            </div>
            <div class="input-group-prepend col-sm-3">
                <span class="block input-group-text">FirstName</span>
                <input type="text" class="form-control"value="<?php echo $F_Name; ?>" readonly>
            </div>
            <div class="input-group-prepend col-sm-3 ">
                <span class="block input-group-text">LastName</span>
                <input type="text" class="form-control"value="<?php echo $L_Name; ?>" readonly>
            </div>
            <div class="input-group-prepend col-sm-3">
                <span class="block input-group-text">Position</span>
                <input type="text" class="form-control"value="<?php echo $posN; ?>" readonly>
            </div>
        </div>

        <div class=" mx-auto pt-3 row input-group">
            <div class=" input-group-prepend col-sm-3">
                <span class="block input-group-text">Department</span>
                <input type="text" class="form-control"value="<?php echo $deN; ?>" readonly>
            </div>
            <div class="input-group-prepend col-sm-3">
                <span class="block input-group-text">Pay Date</span>
                <input type="text" class="form-control"value="<?php echo $payD; ?>" readonly>
            </div>
            <div class="input-group-prepend col-sm-3 ">
                <span class="block input-group-text">Payroll NO.</span>
                <input type="text" class="form-control"value="<?php echo $payrollNo; ?>" readonly>
            </div>
            <div class="input-group-prepend col-sm-3">
                <span class="block input-group-text">Account NO.</span>
                <input type="text" class="form-control"value="<?php echo $accNo; ?>" readonly>
            </div>
        </div>


        <div class=" mx-auto pt-3 row input-group">
            <div class=" input-group-prepend col-sm-3">
                <span class="block input-group-text">Late</span>
                <input type="text" class="form-control"value="<?php echo $Late; ?>" readonly>
            </div>
            <div class="input-group-prepend col-sm-3">
                <span class="block input-group-text">Absence</span>
                <input type="text" class="form-control"value="<?php echo $abday; ?>" readonly>
            </div>
            <div class="input-group-prepend col-sm-3 ">
                <span class="block input-group-text">Working Day</span>
                <input type="text" class="form-control"value="<?php echo $wkday; ?>" readonly>
            </div>
            <div class="input-group-prepend col-sm-3">
                <span class="block input-group-text">Vacation</span>
                <input type="text" class="form-control" value="<?php echo $vday; ?>" readonly>
            </div>
        </div>


    <div class="row pt-2">
        <div class="col-6 pl-5">
            <b class="title">Income</b>
        </div>
        <div class="col-6 pl-5">
            <b class="title">Deduction</b>
        </div>
    </div>


    <div class="row pt-3 pl-3 pr-3">

        <div class="col">
            <table class="table table-bordered">
                <thead>
                    <tr class="title text-center">
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody class="tb">
                    <tr>
                        <td class="text-center">Monthly Salary</td>
                        <td class="text-right"><input type="number" name="salary" id="salary" value="<?php echo $salary; ?>"  readonly></td>
                    </tr>
                    <tr>
                        <td class="text-center">Bonus</td>
                        <td class="text-right"><input type="number" name="bonus" id="bonus" value="<?php echo $bonus; ?>"></td>
                    </tr>
                    <tr>
                        <td class="text-center">Overtime</td>
                        <td class="text-right"><input type="number" name="overtime" id="overtime" value="<?php echo $OT; ?>" readonly></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col">
            <table class="table table-bordered">
                <thead>
                    <tr class="title text-center">
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody class="tb">
                    <tr>
                        <td class="text-center">Social Security</td>
                        <td class="text-right"><input type="number" name="SoIn" id="SoIn" value="<?php echo $SoIn; ?>"></td>
                    </tr>
                    <tr>
                        <td class="text-center">Medicare</td>
                        <td class="text-right"><input type="number" name="medCare" id="medCare"  value="<?php echo $medCare; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td class="text-center">Withholding Tax</td>
                        <td class="text-right"><input type="number" name="HTAX" id="HTAX" value="<?php echo $HTAX; ?>"  readonly></td>
                    </tr>
                    <tr>
                        <td class="text-center">Employment Insurance</td>
                        <td class="text-right"><input type="number" name="EmInsu" id="EmInsu"  value="<?php echo $EmInsu; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td class="text-center">LTF</td>
                        <td class="text-right"><input type="number" name="LTF" id="LTF"  value="<?php echo $LTF; ?>"></td>
                    </tr>
                    <tr>
                        <td class="text-center">RMF</td>
                        <td class="text-right"><input type="number" name="RMF" id="RMF"  value="<?php echo $RMF; ?>"></td>
                    </tr>
                    <tr>
                        <td class="text-center">Late</td>
                        <td class="text-right" ><input type="number" name="late" id="late" value="<?php echo $Late*50; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td class="text-center">Absent</td>
                        <td class="text-right" ><input type="number" name="absent" id="absent" value="<?php echo $abday*300; ?>" readonly></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div class="row pt-3 pl-3 pr-3">
        <div class="col-4 mx-auto">
            <div class=" input-group-prepend">
                <span class="block input-group-text" >Gross Income($)</span>
                <input type="number" class="form-control" id="totalin" name="totalin" value="<?php echo $salary+$bonus+$OT; ?>" readonly>
            </div>
        </div>

        <div class="col-4 mx-auto">
            <div class=" input-group-prepend">
                <span class="block input-group-text">Total Deduction($)</span>
                <input type="text" class="form-control" id="totalded" name="totalded" value="<?php echo $SoIn+$medCare+$HTAX+$EmInsu+$LTF+$RMF+($Late*50)+($abday*300); ?>" readonly>
            </div>
        </div>
    </div>

    <div class="row pt-3 pl-3 pr-3 margin-right">
        <div class="col-4"></div>
        <div class="col-4 ml-auto">
            <div class=" input-group-prepend">
                <span class="block input-group-text">Total ($)</span>
                <input type="text" class="form-control" id="total" value="<?php echo $salary+$bonus+$OT-($SoIn+$medCare+$HTAX+$EmInsu+$LTF+$RMF+($Late*50)+($abday*300)); ?>" readonly>
            </div>
        </div>
                
        <script>
        $(function(){
        $('input').keyup(function(){
                var firstValue = parseFloat($('#salary').val());
                var secondValue = parseFloat($('#bonus').val());
                var thirdValue = parseFloat($('#overtime').val());
                var SoIn = parseFloat($('#SoIn').val());
                var medCare = parseFloat($('#medCare').val());
                var HTAX = parseFloat($('#HTAX').val());
                var LTF = parseFloat($('#LTF').val());
                var RMF = parseFloat($('#RMF').val());
                var EmInsu = parseFloat($('#EmInsu').val());
                var late = parseFloat($('#late').val());
                var absent = parseFloat($('#absent').val());
                document.getElementById('totalin').value = firstValue + secondValue + thirdValue;
                document.getElementById('totalded').value = SoIn + medCare + HTAX+LTF+RMF+EmInsu+late+absent ;
                document.getElementById('total').value = firstValue + secondValue + thirdValue - (SoIn + medCare + HTAX+LTF+RMF+EmInsu+late+absent);
                });});
        </script>

        <div class="col-4 ml-auto"></div>
    </div>
    <div class="row pb-5">
        <div class="col-10">
        </div>
        <div class="col">
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </div>
    </div>
    <a class="btn btn-success" href="HOME.php" role="button">BACK</a>
</form>

<?php
    if(isset($_POST['submit'])){
        include('connectDB.php');
        $bonus=$_POST['bonus'];
        $SoIn=$_POST['SoIn'];
        $LTF=$_POST['LTF'];
        $RMF=$_POST['RMF'];
        $totalded=$_POST['totalded'];
        $totalin=$_POST['totalin'];
        
        $query = "UPDATE EmployeeIncome SET amountIn='$bonus' WHERE StaffID='$StaffID' AND IncomeCode='BONU' ";
        $con->query($query);  
        $query = "UPDATE EmployeeDeduction SET amountDed='$SoIn' WHERE StaffID='$StaffID' AND DeductionCode='SS-E' ";
        $con->query($query); 
        $query = "UPDATE EmployeeDeduction SET amountDed='$LTF' WHERE StaffID='$StaffID' AND DeductionCode='LTFE' ";
        $con->query($query); 
        $query = "UPDATE EmployeeDeduction SET amountDed='$RMF' WHERE StaffID='$StaffID' AND DeductionCode='RMFE' ";
        $con->query($query);  

      $query = "INSERT INTO MonthlyPaySlip VALUE( '$payrollNo','$StaffID','$posID','$dID','$payD','$totalin','$totalded')";          
      $con->query($query);  
        $con->close();
        
        echo "
                              <script>
                                alert('Add monthly payslip!');
                                window.location.href='month.php';
                            </script>";
    }
?>

</body>

</html>