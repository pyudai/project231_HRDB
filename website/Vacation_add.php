<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
      <title>Vacation (ADD)</title>
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
            
            input.Nedit{
                pointer-events:none;
                color:gray;
            }
     
        </style>
        
    </head>
    <body>
        <div class="topnav">
            <a class="text">Vacation (ADD)</a>
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

                    //เหลือดึง depart position

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

    
        <form class="container-fluid " method="post">
            <div class="mx-auto pt-4 row input-group">
                 <div class=" input-group-prepend col-sm-4">
                      <span class="block input-group-text">StaffID</span>
                      <input type="text" class="form-control Nedit" value="<?php echo $StaffID; ?>">
                </div>
                <div class="input-group-prepend col-sm-4">
                      <span class="block input-group-text">First Name</span>
                      <input type="text" class="form-control Nedit" value="<?php echo $F_Name; ?>">
                </div>
                <div class="input-group-prepend col-sm-4">
                      <span class="block input-group-text">Last Name</span>
                      <input type="text" class="form-control Nedit" value="<?php echo $L_Name; ?>">
                </div>
            </div>
            <div class="mt-4 mx-auto pt-2 row input-group">
                <div class=" input-group-prepend col-sm-4">
                    <span class=" block input-group-text" >Department</span>
                    <input type="text" class="form-control Nedit">
                </div>
                <div class=" input-group-prepend col-sm-4">
                    <span class=" block input-group-text" >Position</span>
                    <input type="text" class="form-control Nedit">
                </div>
            </div>
            <div class="mt-4 pt-3 row">  
                <div class="col input-group">
                    <div class="input-group-prepend mx-auto">
                        <span class="block input-group-text">Start Date</span>
                        <input type="date" class="form-control" name="VStart">
                        <span class="block input-group-text" >End Date</span>
                        <input type="date" class="form-control" name="VEnd">
                    </div>
                </div>
            </div> 
        
        
            <div class="mx-auto pt-5 row input-group">
                <div class = "col-sm-4"></div> 
                <div class = "input-group-prepend col-sm-4">
                    <span class="block input-group-text"> Vacation left (day)</span><!-- if update ต้องคำนวณทันที -->
                    <input type= "integer" class="form-control Nedit">
                </div>
            </div>
        
            <div class="row pb-6">
                <div class="col-10"></div>
                <div class="col">
                    <button type ="submit" class="btn btn-success" name="submit">Submit</button>
                </div>
            </div>
        </form>


<?php 
    if(isset($_POST['submit']))
    {
        $VStart=$_POST['VStart'];
        $VEnd=$_POST['VEnd'];
        if(strtotime($VStart)>strtotime($VEnd))
        {
            echo "
                              <script>
                                alert('incorrect date!!!');
                            </script>";
        }
        else if ((strtotime($VDateStart)<strtotime("now")) || (strtotime($VDateEnd)<strtotime("now")) )
        {
            echo "
                  <script>
                    alert('It was pass!!!');
                </script>";
        }
        else{
                   $sql0 = "INSERT INTO Vacation VALUES ('$maxVNo','$StaffID','$maxNo',STR_TO_DATE('$VStart','%Y-%m-%d'),STR_TO_DATE('$VEnd','%Y-%m-%d'))";
            $con->query($sql0);  

            echo $VStart."+".$VEnd."+++".($maxNo+1)."--".($maxVNo+1);
            echo "
              <script>
                alert('add vacation!!!');
                window.location.href='Vacation.php';
            </script>";
        }
    }
 ?>
    </body>
</html>
