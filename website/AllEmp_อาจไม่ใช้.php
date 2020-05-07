<!DOCTYPE html>
<html lang="en">
<head>
 		<title>All Employee</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="table2csv.js"></script>
    
    <style>
        body{
            font-family: Sarabun;
            -webkit-font-smoothing: antialiased;
            background:#F5F4F0;
        }

        .block {
        	background: #D3C0B6; 
        	color:black;
        }
        .button {
            background: #B79584; 
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
        <a class="text">All Employee</a>
        <a class="picture"><img src="centar.png"></a>
    </div>
 
    <?php include('connectDB.php'); ?>

<div class="row pt-5">
	<div class="col text-right pr-5">
        <button type ="button" class="btn btn-success">Add</button>
		<button type ="button" class="btn btn-success">Edit</button>
        <button onclick="exportTableToCSV('allAbsent.csv')" type ="button" class="btn btn-success">Export to CSV</button>
    </div>
</div>

<form class="container-fluid ">

	<div class="row mt-4 pt-4 mx-auto">
		<div class="col-4 input-group">
			<span class="block input-group-text">Department</span>
    		<select class="form-control selectpicker" name="department" id="department"  data-live-search="true">
     			<option value="ALL">All</option>
                <?php
                        $sql0 = "SELECT * FROM department";
                        $result0 = mysqli_query($con, $sql0);
                        while($row0 = $result0->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row0["Department_Name"];?>"><?php echo $row0["Department_Name"];?></option>
                    <?php endwhile;?>
    		</select>
		</div>
		<div class="col-3 input-group">
			<span class="block input-group-text">FirstName</span><!-- อาจจะแก้เป็นแบบอื่น -->
    		<select class="form-control selectpicker" id="F_Name" name="F_Name"  data-live-search="true">
     			<option value="ALL">All</option>
                    <?php 
                        if($_GET['L_Name']=="ALL")
                            $sql0 = "SELECT DISTINCT F_Name FROM EmployeeInfo";
                        else
                            {
                                $L_Name=$_GET['L_Name'];
                                $sql0 = "SELECT DISTINCT F_Name FROM EmployeeInfo WHERE L_Name='$L_Name'";
                            }
                        $result0 = mysqli_query($con, $sql0);
                        while($row0 = $result0->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row0["F_Name"];?>">
                        <?php echo $row0["F_Name"];?>
                    </option>
                    <?php endwhile;?>
    		</select>
		</div>
		<div class="col-3 input-group">
			<span class="block input-group-text">LastName</span>
    		<select class="form-control selectpicker" id="L_Name" name="L_Name"  data-live-search="true">
     			<option value="ALL">All</option>
                <?php
                    if($_GET['F_Name']=="ALL")
                            $sql0 = "SELECT DISTINCT L_Name FROM EmployeeInfo";
                        else
                            {
                                $F_Name=$_GET['F_Name'];
                                $sql0 = "SELECT DISTINCT L_Name FROM EmployeeInfo WHERE F_Name='$F_Name'";
                            }
                        $result0 = mysqli_query($con, $sql0);
                        while($row0 = $result0->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row0["L_Name"];?>"><?php echo $row0["L_Name"];?></option>
                    <?php endwhile;?>
    		</select>
		</div>
		<div class="col-0">
		<button class="button btn oi oi-magnifying-glass" value="submit" type ="submit" name="submit">
		    <img src="svg/magnifying-glass.svg" alt="search" style="width: 16px; height: 16px; ">
		</button>
		</div>
	</div>
</form>

<div class="row pt-5 pl-5 pr-5">
	<div class="col">
		<table class="table table-bordered">
		  	<thead>
		   		<tr class="title text-center">
		    	  	<th>StaffID</th>
		    	  	<th>FirstName</th>
		    	  	<th>LastName</th>
		    	  	<th>Edit</th>
		    	</tr>
		  	</thead>
	  		<tbody class="tb">
	    		 <?php
                            if (isset($_GET['submit'])) {
                                $depart = $_GET['department'];
                                $F_Name = $_GET['F_Name'];
                                $L_Name = $_GET['L_Name'];
                                //echo $tcdate;
                                if ($depart == 'ALL' ) {
                                    if($F_Name =='ALL' || $L_Name =='ALL'){
                                        if($F_Name =='ALL' && $L_Name =='ALL')
                                            $sql = "SELECT StaffID, F_Name, L_Name FROM EmployeeInfo ORDER BY StaffID"; 
                                        else if($L_Name =='ALL')
                                            $sql = "SELECT StaffID, F_Name, L_Name FROM EmployeeInfo WHERE F_Name='$F_Name' ORDER BY StaffID"; 
                                        else if($F_Name =='ALL' )
                                            $sql = "SELECT StaffID, F_Name, L_Name FROM EmployeeInfo WHERE L_Name='$L_Name'  ORDER BY StaffID"; 
                                        else
                                            $sql = "SELECT StaffID, F_Name, L_Name FROM EmployeeInfo WHERE F_Name='$F_Name' AND L_Name='$L_Name'  ORDER BY StaffID"; //error if ไม่มีข้อมูล ต้องกันค่าจากinput
                                        }
                                    else
                                       {} 
                                }
                                else {
                                    $sql = "SELECT StaffID, F_Name, L_Name FROM EmployeeInfo WHERE F_Name='$F_Name' AND L_Name='$L_Name'  ORDER BY StaffID"; //Not finish รอ promotional history เพราะถ้าไม่มีก็ยังไม่รู้ department คนนั้น
                                }
                                
                            } else {
                                $sql = "SELECT StaffID, F_Name, L_Name FROM EmployeeInfo ORDER BY StaffID";
                            }
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                                while($row2 = $result->fetch_assoc()) {
                                    
                                    echo "<tr><td>" . $row2["StaffID"]. "</td><td>" . $row2["F_Name"]. "</td><td>" 
                                    . $row2["L_Name"]. "</td><td>" . $row2["TimeOut"]. 
                                    
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
</body>
</html>
