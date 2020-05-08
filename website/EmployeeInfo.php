<!DOCTYPE html>
<html lang="en">
<head>
 		<title>Employee Information</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
    <style>
    
        body{
            font-family: Sarabun;
            -webkit-font-smoothing: antialiased;
            background:#F5F4F0;
            counter-reset: Serial;           /* Set the Serial counter to 0 */
        }
        
        b.title {
        	font-size:20px;
        }
        
        .block {
        	background: #D3C0B6; 
        	color:black;
        }
        
        .checkbox {
        	color:black;
        	font-size:20px;
        }
        
        tr.title {
        	background: #CBB3A7;
        }
        
        tbody.tb {
        	background: #FAFAFA;
        }
        
         tr td:first-child:before
            {
              counter-increment: Serial;      /* Increment the Serial counter */
              content: " " counter(Serial); /* Display the counter */
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
        input{
            pointer-events:none;
        }
        
    </style>
</head>
<body>
    <div class="topnav">
        <a class="text">Employee Information</a>
        <a class="picture"><img src="centar.png"></a>
    </div>
    
    <?php include('connectDB.php'); 
                    $StaffID = "100001"; //staffIDค่อยใส่
                    $sql0 = "SELECT * FROM EmployeeInfo WHERE StaffID='$StaffID' LIMIT 1";
                    $result = mysqli_query($con, $sql0);
                  while ($row = $result->fetch_assoc()) {
                        $F_Name = $row["F_Name"];
                        $L_Name = $row["L_Name"];
                        $DOB = $row["DOB"];
                        $Email = $row["Email"];
                        $MaritalStatus = $row["MaritalStatus"];
                        $CitizenID = $row["CitizenID"];
                        $TelephoneNo = $row["TelephoneNo"];
                        $TaxID = $row["TaxID"];
                        $StartDate = $row["StartDate"];
                        $AccountNo = $row["AccountNo"];
                        $InsuranceID = $row["InsuranceID"];
                        $Gender = $row["Gender"];
                        $Address = $row["Address"];
                    }
    ?>

    <form class="container-fluid ">
      <div class="mt-4 mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-4">
          <span class=" block input-group-text" >StaffID</span>
              <input type ="text" class="form-control" value='<?php echo htmlspecialchars($StaffID); ?>' >
        </div>
        <div class="input-group-prepend col-sm-4">
          <span class="block input-group-text">Start Date</span>
              <input type="text" class="form-control" value='<?php echo htmlspecialchars($StartDate); ?>' >
        </div>
    	<div class="col-sm-4 ">
        </div>
      </div>
    
     <div class=" mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-4">
          <span class="block input-group-text">First Name</span>
              <input type="text" class="form-control"  id="input" value='<?php echo htmlspecialchars($F_Name); ?>' >
        </div>
        <div class="input-group-prepend col-sm-4">
          <span class="block input-group-text">Last Name</span>
              <input type="text" class="form-control"  id="input" value='<?php echo htmlspecialchars($L_Name); ?>' >
        </div>
    	<div class="input-group-prepend col-sm-4">
         	<span class="block input-group-text">Gender</span>
       		<input type="text" class="form-control" value='<?php echo htmlspecialchars($Gender); ?>' >
        </div>
      </div>
    
    
      <div class=" mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-4">
          <span class="block input-group-text">CitizenID</span>
              <input type="text" class="form-control" value='<?php echo htmlspecialchars($CitizenID); ?>' >
        </div>
        <div class="input-group-prepend col-sm-4">
          <span class="block input-group-text">Birth Date</span>
              <input type="text" class="form-control" value='<?php echo htmlspecialchars($DOB); ?>' >
        </div>
    	<div class="input-group-prepend col-sm-4 ">
         	<span class="block input-group-text">Age</span> <!-- แก้เป็นคำนวณ -->
       		<input type="text" class="form-control" value='<?php echo htmlspecialchars($Age); ?>' >
        </div>
      </div>
      
      <div class=" mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-4">
          <span class="block input-group-text">Marital Status</span>
              <input type="text" class="form-control"  id="input" value='<?php echo htmlspecialchars($MaritalStatus); ?>' >
        </div>
        <div class="input-group-prepend col-sm-4">
          <span class="block input-group-text">Telephone</span>
              <input type="text" class="form-control"  id="input" value='<?php echo htmlspecialchars($TelephoneNo); ?>' >
        </div>
      	<div class="input-group-prepend col-sm-4 ">
         	<span class="block input-group-text">Email</span>
       		<input type="text" class="form-control"  id="input" value='<?php echo htmlspecialchars($Email); ?>' >
        </div>
      </div>
      
      <div class=" mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-5">
          <span class="block input-group-text">Address</span>
              <input type="text" class="form-control"  id="input" value='<?php echo htmlspecialchars($Address); ?>' >
        </div>
        <div class="col-sm-5">
        </div>
      </div>
      
      <div class=" mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-4">
          <span class="block input-group-text">Account No.</span>
              <input type="text" class="form-control"  id="input" value='<?php echo htmlspecialchars($AccountNo); ?>' >
        </div>
        <div class="input-group-prepend col-sm-4">
          <span class="block input-group-text">TaxID</span>
              <input type="text" class="form-control" value='<?php echo htmlspecialchars($TaxID); ?>' >
        </div>
      	<div class="input-group-prepend col-sm-4 ">
         	<span class="block input-group-text">InsuranceID</span>
       		<input type="text" class="form-control"  id="input" value='<?php echo htmlspecialchars($InsuranceID); ?>' >
        </div>
      </div>
    </form>
    
    <!-- educational His เพิ่ม -->
    <div class="row">
        <div class ="col pt-4 pl-5">
            <b style="font-size:20px;">Educational History</b>
        </div>        
    </div>
    
    <div class="row justify-content-center">
            <div class="col-8">
                <table class="table table-bordered">
                    <thead>
                        <tr class="title">
                            <th>No.</th>
                            <th>Levels</th>
                            <th>Degree</th>
                            <th>Graduation Date</th>
                        </tr>
                    </thead>
                    <tbody class="tb">
                        <?php
                                $sql = "SELECT Levels, DegreeID, GraduationDate FROM EducationalHistory WHERE StaffID='$StaffID' ORDER BY GraduationDate";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                                while($row2 = $result->fetch_assoc()) {
                                    
                                    echo "<tr><td></td><td>" . $row2["Levels"]. "</td><td>" 
                                    . $row2["DegreeID"]. "</td><td>" . $row2["GraduationDate"]. 
                                    
                                    "</td></tr>";
                                }
                                echo "</table>";
                            } else { echo "0 results"; }
                            $con->close();
                            ?>
                    </tbody>
                </table>
            </div>
        </div>

    <div class="row pt-5">
    <script>
    function editdone(){
        for(var i= 0;i<document.getElementsByTagName('input').length ;i++){
            if(i==2 || i==3 || (i>=8 && i<=11) || i==12)
            document.getElementsByTagName('input')[i].style.cssText = 'pointer-events:auto;' ;
        }
        //แก้เพิ่มเป็นเปลี่ยน innerHTML : edit -> done แล้ว alter กลับลง DB
    }
    </script>
    	<div class="col text-center">
            <button type ="button" class="btn btn-success">Previous</button>
    		<button type ="button" class="btn btn-success" onclick="editdone();">Edit</button>
            <!--  location.href='EmInEdit.html'; -->
            <button type ="button" class="btn btn-success">Next</button>
        </div>
    </div>
</body>
</html>