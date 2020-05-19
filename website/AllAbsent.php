<!DOCTYPE html>
<html lang="en">
	<head>
			<title>All Absent</title>
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
			.table {
                margin: auto;
                width: 70% !important; 
        	}
			
		</style>
	</head>

	<body>
		<?php
			$con = mysqli_connect("localhost", "root", "", "hr_database");
			if (mysqli_connect_error()) {
				echo "Failed to Connect to MySQL : " . mysqli_connect_error();
			}
		?>
		
		<div class="topnav">
			<a class="text">All Absent</a>
			<a class="picture"><img src="centar.png"></a>
		</div>
			
		<form class="container-fluid ">
			<div class="row mt-4 pt-4 mx-auto">
				<div class="col input-group col-3">
					<span class="block input-group-text">Department</span>
					<select name="depart" class="form-control selectpicker" id="department"  data-live-search="true">
						<option>ALL</option>
						
						<?php
                        $sql0 = "SELECT * FROM department";
                        $result0 = mysqli_query($con, $sql0);
                        while($row0 = $result0->fetch_assoc()):
						?>
						<option value="<?php echo $row0["Department_Name"];?>"><?php echo $row0["Department_Name"];?></option>
						<?php endwhile;?>
						
					</select>
				</div>
				
				<div class="col input-group col-3">
					<span class="block input-group-text">Timesheet</span>
					<select name="timesheet" class="form-control selectpicker" id="timesheet"  data-live-search="true" >
						<option>ALL</option>
						
						<?php
                        $sql0 = "SELECT * FROM absent GROUP BY AbsentDAte";
                        $result0 = mysqli_query($con, $sql0);
                        while($row0 = $result0->fetch_assoc()):
						?>
						<option value="<?php echo $row0["AbsentDate"];?>"><?php echo $row0["AbsentDate"];?></option>
						<?php endwhile;?>

					</select>
				</div>

				<div class="col input-group col-2">
					<span class="block input-group-text">To</span>
					<select name="to_end" class="form-control selectpicker" id="to_end"  data-live-search="true" >
						<option value="0"> - </option>
						
						<?php
                        $sql1 = "SELECT * FROM absent GROUP BY AbsentDAte";
                        $result1 = mysqli_query($con, $sql1);
                        while($row1 = $result1->fetch_assoc()):
						?>
						<option value="<?php echo $row1["AbsentDate"];?>"><?php echo $row1["AbsentDate"];?></option>
						<?php endwhile;?>

					</select>
				</div>
				<input name="submit" type="submit" class="btn btn-md btn-success" id="submit" value="submit">
			</div>		
			
				
		

			<div class="row pt-5 pl-5 pr-5">
				<div class="col">
					<table class="table table-bordered">
						<thead>
							<tr class="title text-center">
								<th style="width : 30%;">Staff ID</th>
								<th style="width : 40%;">Name</th>
								<th style="width : 30%;">Total (Day)</th>
							</tr>
						</thead>
						<tbody class="tb">
							<?php
								if (isset($_GET['submit'])) {
									$depart = $_GET['depart'];
									$timesheet = $_GET['timesheet'];
									$endtime = $_GET['to_end'];
									//echo $timesheet. " ". $endtime;
									if ($depart == 'ALL' AND $timesheet == 'ALL' AND $endtime == 0) { 
										$sql = "SELECT *, COUNT(*) AS sumAbsent FROM absent GROUP BY StaffID ORDER BY sumAbsent DESC, StaffID;"; 
									} elseif ($depart != 'ALL' AND $timesheet == 'ALL' AND $endtime == 0) {
										$sql = "SELECT * , COUNT(*) AS sumAbsent FROM absent WHERE StaffID IN
										(SELECT StaffID FROM promotionalhistory p, department d WHERE p.DepartmentID = d.DepartmentID AND d.Department_Name = '$depart')
										GROUP BY StaffID ORDER BY sumAbsent DESC, StaffID;";
									} elseif ($depart == 'ALL' AND $timesheet != 'ALL' AND $endtime == 0) {
										$sql = "SELECT *, COUNT(*) AS sumAbsent FROM absent WHERE Absentdate = '$timesheet' GROUP BY StaffID 
										ORDER BY sumAbsent DESC, StaffID;";
									} elseif ($depart == 'ALL' AND $timesheet != 'ALL' AND $endtime != 0) {
										$sql = "SELECT *, COUNT(*) AS sumAbsent FROM absent WHERE Absentdate BETWEEN '$timesheet' AND '$endtime' 
										GROUP BY StaffID ORDER BY sumAbsent DESC, StaffID;";
									} else {
										$sql = "SELECT * , COUNT(*) AS sumAbsent FROM absent WHERE StaffID IN
										(SELECT StaffID FROM promotionalhistory p, department d WHERE p.DepartmentID = d.DepartmentID AND d.Department_Name = '$depart')
										GROUP BY StaffID HAVING Absentdate = '$timesheet' ORDER BY sumAbsent DESC, StaffID;";  
									}
								} else {
									$sql = "SELECT *, COUNT(*) AS sumAbsent FROM absent GROUP BY StaffID ORDER BY sumAbsent DESC, StaffID;"; 
								}
								$sql2 = "SELECT * FROM employeeinfo GROUP BY StaffID;";
								$result = $con->query($sql);
								$result2 = $con->query($sql2);
								if ($result->num_rows > 0) {
									while($row2 = $result->fetch_assoc() AND $row3 = $result2->fetch_assoc()) {
										
										echo "<tr class='text-center'><td>" . $row2["StaffID"]. "</td><td>". $row3["F_Name"]. " ". $row3["L_Name"]. 
										"</td><td>". $row2["sumAbsent"]. "</td></tr>";
									}
									echo "</table>";
								} else { echo '<h4 style="margin: auto; width: 10%;"><span class="badge badge-info"> No Data </span></h4> <br>'; }
								//else { echo "<script> alert('add education history!!!'); </script>"; }
								$con->close();
							?>
						</tbody>
					</table>
					
				</div>
			</div>
			<a class="btn btn-success" href="HOME.php" role="button">BACK</a>
		</form>
	</body>
</html>