<!DOCTYPE html>
<html>
    <title>Department Member</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<body>
<style>
.topnav {
  overflow: hidden;
  background-color:#E8D8C9;
}

.topnav a {
  float: right;
  color: #b20e10;
  text-align: center;
  padding: 14px 16px;
  font-size: 56px;
}
.topnav a.text{
 color: #b20e10;
 font-family:Sarabun;
}
.topnav a.picture{
float:left;
}
body{
    font-family: Helvetica;
    -webkit-font-smoothing: antialiased;
    background:#F5F4F0;
}
.chart{
margin: 70px auto;
width:1000px;
height:500px;
}
</style>
<?php
            $con = mysqli_connect("localhost", "root", "", "hr_database");

            if (mysqli_connect_error()) {
                echo "Failed to Connect to MySQL : " . mysqli_connect_error();
            }
?>
<div class="topnav">
  <a class="text">Department Member</a>
  <a class="picture"><img src="centar.png"></a>
</div>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                   ['Department','N'],
                  <?php
                  $sql="SELECT DepartmentID,COUNT(StaffID) AS N FROM Promotionalhistory GROUP BY DepartmentID;";
                  $fire=mysqli_query($con,$sql);
                  while($result=mysqli_fetch_assoc($fire)){
                    echo"['".$result['DepartmentID']."',".$result['N']."],";
                  }
                  ?>
        ]);

                var options = {
                    chart: {
                        title: 'Departmentmember',
                        subtitle: 'N',
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
<div id="columnchart_material" class="chart"></div>
<div class="row pt-5">
  <div class="col text-right pr-5">
         <a href="HOME.php" class="btn btn-success">BACK</a>
    </div>
</div>
</body>
</html>
