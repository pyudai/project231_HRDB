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
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/> <!-- auto complete box -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> <!-- auto complete box -->
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> <!-- auto complete box -->
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
        /*input{
            pointer-events:none;
        }
        */
    </style>
</head>

<body>
    <div class="topnav">
        <a class="text">Employee Information (Edit)</a>
        <a class="picture"><img src="centar.png"></a>
    </div>
    
    <?php include('connectDB.php'); //ยังไม่ได้แก้กัน input
                    $StaffID = "236377"; //staffIDค่อยใส่//ต้องแก้เป็นดึงมาจากอีกหน้า
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

    <form class="container-fluid " method="get" >
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
         	<span class="block input-group-text">Age</span> <!-- แก้เป็นคำนวณ -->
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
        <div class ="col-8 pt-4 pl-5">
            <b style="font-size:20px;">Educational History</b>
        </div>        
        <!-- <div class ="col-3 pt-4 pl-5">
            <button type ="submit" class="btn btn-success btn-sm" name="add">Add Educational History</button>
        </div>    อาจจะทำ ขอแก้แบบโง่ๆไปก่อน-->
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
                    <tbody class="tb">
                        <?php include('connectDB.php'); 
                                $sql = "SELECT Levels, DegreeID, GraduationDate FROM EducationalHistory WHERE StaffID='$StaffID' ORDER BY GraduationDate";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                                while($row2 = $result->fetch_assoc()) {
                                    
                                    echo "<tr><td class='text-center'></td><td>" . $row2["Levels"]. "</td><td>" 
                                    . $row2["DegreeID"]. "</td><td>" . $row2["GraduationDate"].
                                    "</td><td class='text-center'> <button type ='submit' class='btn btn-danger  btn-sm' name='delete' id='delete'  value=".$row2['GraduationDate']."|".$row2['Levels']." >delete</button>
                                    </td></tr>";
                                }
                                echo "</table>";
                                echo $result->fetch_assoc();
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
                                <td class="text-center"><input type="text" name="Degree" id="Degree"></td>
                                    <?php
                                        include('connectDB.php'); 
                                        $sql = "SELECT * FROM Degree";
                                        $query = $con->query($sql);
                                    ?>
                                     <script type="text/javascript"> <!-- auto complete box -->
                                         var DegreeID = [
                                            <?php
                                                $province = "";
                                                while ($result = $query->fetch_assoc()) {
                                                     $DegreeID .= "'" . $result['DegreeID'] . "',";
                                                }
                                                echo rtrim($DegreeID, ",");
                                            ?>
                                         ];
                                         $(function () {
                                             $("input#Degree").autocomplete({
                                                 source: DegreeID
                                             });
                                         });
                                     </script> <!-- auto complete box -->
                                <td id="Graduation_Date" class="text-center"><input type="date" name="Graduation_Date" value="<?php echo date('Y-m-d'); ?>"></td>
                                <td class="text-center"> <button type ="submit" class="btn btn-success btn-sm" name="add" id="add">Add</button> </td>
                            </tr>
                            
                    </tbody>
                </table>
            </div>
        </div>

    
    <div class="row pt-5">
    	<div class="col text-center">
            <button type ="button" class="btn btn-success">Previous</button>
    		<button type ="submit" class="btn btn-success" name="done" id="done" >Done</button>
            <button type ="button" class="btn btn-success">Next</button>
        </div>
    </div>
</form>
                  <?php
                        if( isset($_GET['delete']) )
            			{
                                include('connectDB.php'); 
                                list($gradDate, $Levels) = explode("|", $_GET['delete']);
                        $sql = "DELETE FROM EducationalHistory WHERE StaffID='$StaffID' AND GraduationDate='$gradDate' AND Levels='$Levels' ";//อาจจะแก้เป็นกด done แล้วค่อยลบ จะแก้ถ้าเวลาเหลือ
                        $con->query($sql);                        
                        $con->close();
                       echo "
                              <script>
                                alert('delete education history!!!');
                                window.location.href='EmInEdit.php';
                            </script>";
                        }
                  		if( isset($_GET['done']) )
            			{
                                include('connectDB.php'); 
                                $F_Name = $_GET["F_Name"];
                                $L_Name = $_GET["L_Name"];
                                $MaritalStatus = $_GET["MaritalStatus"];
                                $TelephoneNo = $_GET["TelephoneNo"];
                                $AccountNo = $_GET["AccountNo"];
                                $Email = $_GET["Email"];
                                $Address = $_GET["Address"];
                                
                               $sql = "UPDATE EmployeeInfo SET F_Name='$F_Name' ,L_Name='$L_Name' ,MaritalStatus='$MaritalStatus',TelephoneNo='$TelephoneNo',Email='$Email',Address='$Address',AccountNo='$AccountNo' WHERE StaffID='$StaffID' ";
                               $con->query($sql);                        
                               $con->close();
                              echo "
                              <script>
                                  alert('updated information!!!');
                                window.location.href='EmployeeInfo.php';
                            </script>";
                        }
                        if(isset($_GET['add']) )
                        {
                            $Levels = $_GET['Levels'];
                            $Degree = $_GET['Degree'];
                            $Graduation_Date = $_GET['Graduation_Date'];
                            include('connectDB.php'); 
                                
                            $sql = "INSERT INTO educationalhistory VALUES ('$StaffID',STR_TO_DATE('$Graduation_Date','%Y-%m-%d'),'$Degree','$Levels')";//อาจจะแก้เป็นกด done แล้วค่อยเพิ่ม จะแก้ถ้าเวลาเหลือ
                            $con->query($sql);                        
                           $con->close();

                            echo "
                              <script>
                                alert('add education history!!!');
                                window.location.href='EmInEdit.php';
                            </script>";
                        }
                    ?>

</body>
</html>