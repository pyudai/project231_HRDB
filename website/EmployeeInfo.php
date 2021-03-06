<?php
session_start();
?>
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
                    $StaffID = "100001"; 
                    $_SESSION["StaffID"] = $StaffID;
                    $sql0 = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), dob)), '%Y')+0 AS age  FROM EmployeeInfo WHERE StaffID='$StaffID' LIMIT 1";
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
                        $Age=$row["age"];
                    }
                    $con->close();
    ?>

    <form class="container-fluid " method="post">
        <div class="row pt-4 pr-5">
    	<div class="col text-right">
    		<button type ="submit" class="btn btn-success" name="edit" >Edit</button>
        </div>
    </div>
    
      <div class="mt-4 mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-4">
          <span class=" block input-group-text" >StaffID</span>
              <input type ="text" class="form-control" value='<?php echo $StaffID; ?>' >
        </div>
        <div class="input-group-prepend col-sm-4">
          <span class="block input-group-text">Start Date</span>
              <input type="text" class="form-control" value='<?php echo $StartDate; ?>' >
        </div>
    	<div class="col-sm-4 ">
        </div>
      </div>
    
     <div class=" mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-4">
          <span class="block input-group-text">First Name</span>
              <input type="text" class="form-control"  name="F_Name" value='<?php echo $F_Name; ?>' >
        </div>
        <div class="input-group-prepend col-sm-4">
          <span class="block input-group-text">Last Name</span>
              <input type="text" class="form-control"  name="L_Name" value='<?php echo $L_Name; ?>' >
        </div>
    	<div class="input-group-prepend col-sm-4">
         	<span class="block input-group-text">Gender</span>
       		<input type="text" class="form-control" value='<?php echo $Gender; ?>' >
        </div>
      </div>
    
    
      <div class=" mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-4">
          <span class="block input-group-text">CitizenID</span>
              <input type="text" class="form-control" value='<?php echo $CitizenID; ?>' >
        </div>
        <div class="input-group-prepend col-sm-4">
          <span class="block input-group-text">Birth Date</span>
              <input type="text" class="form-control" value='<?php echo $DOB; ?>' >
        </div>
    	<div class="input-group-prepend col-sm-4 ">
         	<span class="block input-group-text">Age</span>
       		<input type="text" class="form-control" value='<?php echo $Age; ?>' >
        </div>
      </div>
      
      <div class=" mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-4">
          <span class="block input-group-text">Marital Status</span>
              <input type="text" class="form-control"  name="MaritalStatus" value='<?php echo $MaritalStatus; ?>' >
        </div>
        <div class="input-group-prepend col-sm-4">
          <span class="block input-group-text">Telephone</span>
              <input type="text" class="form-control"  name="TelephoneNo" value='<?php echo $TelephoneNo; ?>' >
        </div>
      	<div class="input-group-prepend col-sm-4 ">
         	<span class="block input-group-text">Email</span>
       		<input type="text" class="form-control"  name="Email" value='<?php echo $Email; ?>' >
        </div>
      </div>
      
      <div class=" mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-5">
          <span class="block input-group-text">Address</span>
              <input type="text" class="form-control"  name="Address" value='<?php echo $Address; ?>' >
        </div>
        <div class="col-sm-5">
        </div>
      </div>
      
      <div class=" mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-4">
          <span class="block input-group-text">Account No.</span>
              <input type="text" class="form-control"  name="AccountNo" value='<?php echo $AccountNo; ?>' >
        </div>
        <div class="input-group-prepend col-sm-4">
          <span class="block input-group-text">TaxID</span>
              <input type="text" class="form-control" value='<?php echo $TaxID; ?>' >
        </div>
      	<div class="input-group-prepend col-sm-4 ">
         	<span class="block input-group-text">InsuranceID</span>
       		<input type="text" class="form-control" value='<?php echo $InsuranceID; ?>' >
        </div>
      </div>


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
                        <?php include('connectDB.php'); 
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
    	<div class="col text-center">
    		<button type ="submit" class="btn btn-success" name="home" >Back</button>
        </div>
    </div>
</form>
<?php 
    if(isset($_POST['edit']) ){
        echo "<script> window.location.href='EmInEdit.php';</script>";
    }
             if(isset($_POST['home']))
                {
                     echo "
                      <script>
                        window.location.href='HOME.php'; 
                    </script>";
                }
?>
</body>
</html>