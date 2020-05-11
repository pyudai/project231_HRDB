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
			
		<!-- <div class="row pt-5">
			<div class="col text-right pr-5">
				<button type ="button" class="btn btn-success">Add</button>
				<button type ="button" class="btn btn-success">Edit</button>
				<button onclick="exportTableToCSV('allAbsent.csv')" type ="button" class="btn btn-success">Export to CSV</button>
			</div>
		</div> -->

		<form class="container-fluid ">
			<div class="row mt-4 pt-4 mx-auto">
				<div class="col input-group">
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
				
				<!-- <div class="col input-group">
					<span class="block input-group-text">Timesheet</span>
					<select name="timesheet" class="form-control selectpicker" id="timesheet"  data-live-search="true" >
						<option>SELECT</option>
						
						<?php
                        $sql0 = "SELECT * FROM absent GROUP BY AbsentDAte";
                        $result0 = mysqli_query($con, $sql0);
                        while($row0 = $result0->fetch_assoc()):
						?>
						<option value="<?php echo $row0["AbsentDate"];?>"><?php echo $row0["AbsentDate"];?></option>
						<?php endwhile;?>

					</select>
				</div> -->
				<div class="col-0">
					<button name="submit" type="submit" class="button btn oi oi-magnifying-glass" id="search" >
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
							<th>Staff ID</th>
							<th>Total (Day)</th>
						</tr>
					</thead>
					<tbody class="tb">
						<?php
                            if (isset($_GET['submit'])) {
                                $depart = $_GET['depart'];
                                //$timesheet = $_GET['timesheet']; // ไม่ใช้ ถ้าว่างค่อยทำ
								//echo $tcdate;
								//$timesheet == 'SELECT' AND $depart == 'SELECT'
                                if ($depart == 'ALL') { 
                                    $sql = "SELECT *, COUNT(*) AS sumAbsent FROM absent GROUP BY StaffID ORDER BY sumAbsent DESC;"; 
                                //} elseif ($timesheet != 'SELECT') {
                                    //$sql = "SELECT * , COUNT(*) AS sumAbsent FROM absent WHERE StaffID IN
                                    //(SELECT StaffID FROM promotionalhistory p, department d WHERE p.DepartmentID = d.DepartmentID AND d.Department_Name = '$depart')
									//GROUP BY StaffID ORDER BY sumAbsent DESC;"; //Not finish
                                } elseif ($depart != 'ALL') {
                                    $sql = "SELECT * , COUNT(*) AS sumAbsent FROM absent WHERE StaffID IN
                                    (SELECT StaffID FROM promotionalhistory p, department d WHERE p.DepartmentID = d.DepartmentID AND d.Department_Name = '$depart')
									GROUP BY StaffID ORDER BY sumAbsent DESC;"; //Not finish
                                } else {
                                    $sql = "SELECT *, COUNT(*) AS sumAbsent FROM absent GROUP BY sumAbsent DESC";  //Not finish
                                }
                                
                            } else {
                                $sql = "SELECT *, COUNT(*) AS sumAbsent FROM absent GROUP BY StaffID ORDER BY sumAbsent DESC;"; 
                            }
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                                while($row2 = $result->fetch_assoc()) {
                                    echo "<tr><td>" . $row2["StaffID"]. "</td><td>" . $row2["sumAbsent"].
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
		<a class="nav-link" href="HOME.php">back</a>
	</body>
</html>