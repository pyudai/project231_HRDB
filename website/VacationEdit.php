<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
      <title>Vacation(Edit)</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
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
        <div class="topnav">
            <a class="text">Vacation(Edit)</a>
            <a class="picture"><img src="centar.png"></a>
        </div>
    
            <?php include('connectDB.php');
                    $StaffID =  $_SESSION['StaffID'];
                    $sql0 = "SELECT F_Name,L_Name FROM EmployeeInfo WHERE StaffID='$StaffID' LIMIT 1";
                    $result = mysqli_query($con, $sql0);
                  while ($row = $result->fetch_assoc()) {
                        $F_Name = $row["F_Name"];
                        $L_Name = $row["L_Name"];
                    }
                    
                    // ใช้เวลา insert ค่า
                        $sql = "SELECT MAX(No) AS maxNo FROM Vacation WHERE StaffID='$StaffID' LIMIT 1";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            while($row2 = $result->fetch_assoc()) {
                              $maxNo=$row2["maxNo"];
                            }
                        }
                        
                        $sql = "SELECT MAX(VacationNo) AS maxVNo FROM Vacation LIMIT 1";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            while($row2 = $result->fetch_assoc()) {
                              $maxVNo=$row2["maxVNo"];
                            }
                        }
                    $con->close();
        ?>
        
        <form class="container-fluid " method="post" >
            <div class="mx-auto pt-4 row input-group">
                   <div class=" input-group-prepend col-sm-4">
                      <span class="block input-group-text">StaffID</span>
                      <input type="text" class="form-control" name="StaffID" value="<?php echo $StaffID; ?>" readonly>
                  </div>
                  <div class="input-group-prepend col-sm-4">
                      <span class="block input-group-text" >First Name</span>
                      <input type="text" class="form-control" value="<?php echo $F_Name; ?>" readonly>
                  </div>
                  <div class="input-group-prepend col-sm-4">
                      <span class="block input-group-text">Last Name</span>
                      <input type="text" class="form-control" value="<?php echo $L_Name; ?>" readonly>
                </div>
            </div>

            <div class="row pt-5 pl-5 pr-5 ">
                <div class="col-3"></div>
              <div class="col-6 text-center ">
                <table class="table table-bordered">
                        <thead>
                            <tr class="title text-center">
                              <th>No.</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody class="tb">
                        <?php include('connectDB.php'); 
                                $sql = "SELECT *  FROM Vacation WHERE StaffID='$StaffID' ORDER BY No";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                                while($row2 = $result->fetch_assoc()) {
                                    echo "<tr><td class='text-center'>". $row2["No"]."</td><td>" . $row2["VDateStart"]. "</td><td>" 
                                    . $row2["VDateEnd"]. "</td><td><button class='btn btn-danger' type='submit' name='delete' value=".$row2["VacationNo"].">Delete</button></td></tr>";
                                }
                            } else { echo "0 results"; }
                            $con->close();
                            ?>
                            <tr>
                                <td class='text-center'></td>
                                <td><input type="date" class="form-control" name="VStart"></td>
                                <td> <input type="date" class="form-control" name="VEnd"></td>
                                <td><button class='btn btn-success' type='submit' name='add' >Add</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
	
	
        	<?php include('connectDB.php');
                            $AmountDay=0;
                            $sql = "SELECT DATEDIFF(VDateEnd, VDateStart) AS days FROM Vacation WHERE StaffID='$StaffID' ";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                                while($row2 = $result->fetch_assoc()) {
                                   $AmountDay+=$row2["days"];
                                }
                            }
                            $sql = "SELECT DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), StartDate)), '%Y')*12 AS totalDay FROM EmployeeInfo  WHERE StaffID='$StaffID' LIMIT 1";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                                while($row2 = $result->fetch_assoc()) {
                                   $totalDay=$row2["totalDay"];
                                }
                            }
                                                        
                            $con->close();
            ?>
        
            <div class="mx-auto pt-4 row input-group">
                <div class = "col-sm-4"></div> 
                <div class = "input-group-prepend col-sm-4">
                    <span class="block input-group-text"> Vacation left (day)</span>
                    <input type= "integer" class="form-control" name="Vleft" value="<?php echo ($totalDay-$AmountDay); ?>">
                </div>
            </div>


            <div class="text-right pr-5">
                <button type ="submit" class="btn btn-success" name="done">Done</button> 
            </div>
        
        </form>

        <?php 
        
             if(isset($_POST['done']) )
                        {
                            echo "
                              <script>
                                window.location.href='Vacation.php';
                            </script>";
                        }
                        
            if(isset($_POST['delete']) )
                        {
                            include('connectDB.php');
                            $delete=$_POST['delete'];
                           $sql0 = "SELECT No, VDateStart,VDateEnd FROM Vacation WHERE VacationNo='$delete' ";
                            $result =$con->query($sql0); 
                            while ($row = $result->fetch_assoc()) {
                                $VDateStart = $row["VDateStart"];
                                $VDateEnd = $row["VDateEnd"];
                                $No = $row["No"];
                            }
                            
                            if( (strtotime($VDateStart)>strtotime("now")) && (strtotime($VDateEnd)>strtotime("now")) ){
                               $sql0 = "DELETE FROM Vacation WHERE VacationNo='$delete' ";
                                $con->query($sql0);  
                                $sql0 = "UPDATE Vacation SET No=(No-1) WHERE StaffID='$StaffID' AND No>'$No' ";
                                $con->query($sql0);  
                                $con->close();
                                echo "
                                  <script>
                                    alert('Delete vacation!!!');
                                    window.location.href='VacationEdit.php';
                                </script>";
                            }
                            else{
                                    echo "
                                  <script>
                                    alert('Can\'t delete vacation because it was pass');
                                    window.location.href='VacationEdit.php';
                                </script>";
                            }
                        }
                        
                    if(isset($_POST['add']))
                        {
                            $VStart=$_POST['VStart'];
                            $VEnd=$_POST['VEnd'];
                            $Vleft=$_POST['Vleft'];
                            
                            if(strtotime($VStart)>strtotime($VEnd))
                            {
                                echo "
                                                  <script>
                                                    alert('incorrect date range!!!');
                                                </script>";
                            }
                            else if ( (strtotime($VStart)<strtotime("now") ) || (strtotime($VEnd)<strtotime("now")) )
                            {
                                echo "
                                      <script>
                                        alert('Date is in the past!!!');
                                    </script>";
                            }
                            else if ($Vleft<=0){
                                echo "
                                      <script>
                                        alert('You are out of vacation day!!!');
                                    </script>";
                            }
                            else{
                                include('connectDB.php');
                                   $sql0 = "INSERT INTO Vacation VALUES ('$maxVNo'+1,'$StaffID','$maxNo'+1,STR_TO_DATE('$VStart','%Y-%m-%d'),STR_TO_DATE('$VEnd','%Y-%m-%d'))";
                                   $con->query($sql0);  
                                   $con->close();

                                echo "
                                  <script>
                                    alert('add vacation!!!');
                                    window.location.href='VacationEdit.php';
                                </script>";
                            }
                        }
        ?>
        

        
    </body>
</html>
