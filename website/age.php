<!DOCTYPE html>
<html>
    <head>
        <title>Age</title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

        <style>
            .block1{
                margin-left:50;
                color:black;
                border-radius:10px; 
                padding: 5px 15px;
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
            
            .block {
	            background: #D3C0B6; 
	            color:black;
            }
    
            body {
                font-family: Sarabun;
                -webkit-font-smoothing: antialiased;
                background:#F5F4F0;
            }
            
            .chart{
                margin: 50px auto;
                width:660px;
                height:330px;
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
            <a class="text">Age</a>
            <a class="picture"><img src="centar.png"></a>
        </div>
         <?php
            $con = mysqli_connect("localhost", "root", "", "hr");

            if (mysqli_connect_error()) {
                echo "Failed to Connect to MySQL : " . mysqli_connect_error();
            }
        ?>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Name','AGE'],
                  <?php
                  $sql="SELECT F_Name,TIMESTAMPDIFF(YEAR,DOB,CURDATE()) AS AGE FROM employeeinfo;";
                  $fire=mysqli_query($con,$sql);
                  while($result=mysqli_fetch_assoc($fire)){
                    echo"['".$result['F_Name']."',".$result['AGE']."],";
                  }
                  ?>
                ]);

                var options = {
                    chart: {
                        title: 'Employee Age',
                        subtitle: 'Ages',
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
        
        <body>
            <div id="columnchart_material" class="chart"></div>
        </body>
        
        <div class="container row pb-4">
        	<div class="col text-right">
                <button type ="button" class="btn btn-success">Other Department</button>
            </div>
        </div>
        
    </body>
</html>
