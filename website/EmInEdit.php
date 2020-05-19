<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
 		<title>Employee Information (Edit)</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
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

    </style>
</head>

<body>
    <div class="topnav">
        <a class="text">Employee Information (Edit)</a>
        <a class="picture"><img src="centar.png"></a>
    </div>
    
    <?php include('connectDB.php'); //ยังไม่ได้แก้กัน input เป็น input ได้บางอันด้วย
                    $StaffID =  $_SESSION['StaffID'];
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

    <form class="container-fluid " method="post" >
      <div class="mt-4 mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-4">
          <span class=" block input-group-text" >StaffID</span>
              <input type ="text" class="form-control" value='<?php echo $StaffID; ?>' readonly>
        </div>
        <div class="input-group-prepend col-sm-4">
          <span class="block input-group-text">Start Date</span>
              <input type="text" class="form-control" value='<?php echo $StartDate; ?>' readonly>
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
       		<input type="text" class="form-control" value='<?php echo $Gender; ?>' readonly>
        </div>
      </div>
    
    
      <div class=" mx-auto pt-4 row input-group">
         <div class=" input-group-prepend col-sm-4">
          <span class="block input-group-text">CitizenID</span>
              <input type="text" class="form-control" value='<?php echo $CitizenID; ?>' readonly>
        </div>
        <div class="input-group-prepend col-sm-4">
          <span class="block input-group-text">Birth Date</span>
              <input type="text" class="form-control" value='<?php echo $DOB; ?>' readonly>
        </div>
    	<div class="input-group-prepend col-sm-4 ">
         	<span class="block input-group-text">Age</span>
       		<input type="text" class="form-control" value='<?php echo $Age; ?>' readonly>
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
              <input type="text" class="form-control" value='<?php echo $TaxID; ?>' readonly>
        </div>
      	<div class="input-group-prepend col-sm-4 ">
         	<span class="block input-group-text">InsuranceID</span>
       		<input type="text" class="form-control" value='<?php echo $InsuranceID; ?>' readonly>
        </div>
      </div>


    <div class="row">
        <div class ="col-8 pt-4 pl-5">
            <b style="font-size:20px;">Educational History</b>
        </div>        
    </div>
    
    <div class="row justify-content-center">
            <div class="col-8">
                <table class="table table-bordered">
                    <thead>
                        <tr class="title text-center">
                            <th>No.</th>
                            <th>Levels</th>
                            <th>Degree</th>
                            <th>Graduation Date</th>
                            
                        </tr>
                    </thead>
                    <tbody class="tb text-center" >
                        <?php include('connectDB.php'); 
                                $sql = "SELECT Levels, e.DegreeID, GraduationDate,DegreeName FROM EducationalHistory e LEFT JOIN Degree d ON e.DegreeID=d.DegreeID WHERE StaffID='$StaffID' ORDER BY GraduationDate";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                                while($row2 = $result->fetch_assoc()) {
                                    
                                    echo "<tr><td></td><td>" . $row2["Levels"]. "</td><td>";
                                    if($row2["Levels"] != "High School")
                                        echo $row2["DegreeName"]." (". $row2["DegreeID"]. ")</td>";
                                    else
                                        echo "-</td>";
                                    echo "<td>" . $row2["GraduationDate"].
                                    "</td><td class='text-center'> <button type ='submit' class='btn btn-danger  btn-sm' name='delete' id='delete'  value=".$row2['GraduationDate']."|".$row2['Levels']." >delete</button>
                                    </td></tr>";
                                }
                            } else { echo "0 results"; }
                            $con->close();
                            ?>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center">
                                    <select name="Levels" class="selectpicker">
                                        <option>High School</option>
                                        <option>Bachelor</option>
                                        <option>Master</option>
                                        <option>Doctor</option>
                                    </select>
                                </td>
                                <td class="text-center"><select class="form-control selectpicker" name="Degree" id="Degree" data-live-search="true">
                                    <option value=""> - </option>
                                    <?php
                                        include('connectDB.php'); 
                                        $sql = "SELECT * FROM Degree";
                                        $query = $con->query($sql);
                                        $result = mysqli_query($con, $sql);
                                            while($row = $result->fetch_assoc()):
                                        ?>
                                        <option value="<?php echo $row['DegreeID'];?>"><?php echo $row["DegreeName"]." (".$row["DegreeID"].")";?></option>
                                        <?php endwhile; 
                                        $con->close();
                                        ?>
                                        </select>
                                </td>
                                <td id="Graduation_Date" class="text-center"><input type="date" name="Graduation_Date" /></td>
                                <td class="text-center"> <button type ="submit" class="btn btn-success btn-sm" name="add" id="add">Add</button> </td>
                            </tr>
                            
                    </tbody>
                </table>
            </div>
        </div>

    
    <div class="row pt-5">
    	<div class="col text-center">
    		<button type ="submit" class="btn btn-success" name="done" id="done" >Done</button>
        </div>
    </div>
</form>
                  <?php
                        if( isset($_POST['delete']) )
            			{
                                include('connectDB.php'); 
                                list($gradDate, $Levels) = explode("|", $_POST['delete']);
                                  if($Levels=="High")
                                    $Levels='High School' ;
                                                          
                                $sql0 = "SELECT No FROM EducationalHistory WHERE StaffID='$StaffID' AND GraduationDate=STR_TO_DATE('$gradDate','%Y-%m-%d') AND Levels='$Levels' ";
                                $result =$con->query($sql0); 
                                while ($row = $result->fetch_assoc()) {
                                    $No = $row["No"];
                                }

                                    $sql = "DELETE FROM EducationalHistory WHERE StaffID='$StaffID' AND GraduationDate=STR_TO_DATE('$gradDate','%Y-%m-%d') AND Levels='$Levels' ";
                        $con->query($sql);    
                        $sql0 = "UPDATE EducationalHistory SET No=(No-1) WHERE StaffID='$StaffID' AND No>'$No' ";
                        $con->query($sql0);                      
                        $con->close();
                       echo "
                              <script>
                                alert('delete education history!!!');
                                window.location.href='EmInEdit.php';
                            </script>";
                        }
                  		if( isset($_POST['done']) )
            			{
                                include('connectDB.php'); 
                                $F_Name = $_POST["F_Name"];
                                $L_Name = $_POST["L_Name"];
                                $MaritalStatus = $_POST["MaritalStatus"];
                                $TelephoneNo = $_POST["TelephoneNo"];
                                $AccountNo = $_POST["AccountNo"];
                                $Email = $_POST["Email"];
                                $Address = $_POST["Address"];
                                
                               $sql = "UPDATE EmployeeInfo SET F_Name='$F_Name' ,L_Name='$L_Name' ,MaritalStatus='$MaritalStatus',TelephoneNo='$TelephoneNo',Email='$Email',Address='$Address',AccountNo='$AccountNo' WHERE StaffID='$StaffID' ";
                               $con->query($sql);                        
                               $con->close();
                              echo "
                              <script>
                                  alert('updated information!!!');
                                window.location.href='EmployeeInfo.php';
                            </script>";
                        }
                        if(isset($_POST['add']) )
                        {
                            $Levels = $_POST['Levels'];
                            $Degree = $_POST['Degree'];
                            $Graduation_Date = $_POST['Graduation_Date'] ; 
                            if($Graduation_Date==""){
                                echo "
                              <script>
                                alert('No Graduation Date was filled in !!!');
                            </script>";
                            }else if($Degree ==""&& $Levels!="High School"){
                                echo "
                              <script>
                                alert('No Degree was filled in !!!!!');
                            </script>";
                            }
                            else
                            {

                            include('connectDB.php'); 
                            
                            // ใช้เวลา insert ค่า
                        $sql = "SELECT MAX(No) AS maxNo FROM educationalhistory WHERE StaffID='$StaffID' LIMIT 1";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            while($row2 = $result->fetch_assoc()) {
                              $maxNo=$row2["maxNo"];
                            }
                        }
                             if($Degree ==""&& $Levels=="High School")   
                                 $sql = "INSERT INTO educationalhistory VALUES ('$StaffID','$maxNo'+1,STR_TO_DATE('$Graduation_Date','%Y-%m-%d'),NULL,'$Levels')";
                             else 
                                 $sql = "INSERT INTO educationalhistory VALUES ('$StaffID','$maxNo'+1,STR_TO_DATE('$Graduation_Date','%Y-%m-%d'),'$Degree','$Levels')";
                            $con->query($sql);                        
                           $con->close();

                            echo "
                              <script>
                                alert('add education history!!!');
                                window.location.href='EmInEdit.php';
                            </script>";
                            }
                        }
                    ?>

</body>
</html>