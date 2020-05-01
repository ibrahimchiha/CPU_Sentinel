


<?php
session_start();




$username = $_SESSION['username'];
$FirstName = $_GET['firstName'];
$LastName = $_GET['lastName'];
$DateAndTime = $_GET['dateAndTime'];


    



$conn = mysqli_connect("localhost", "u123926142_ZiadHamwi", "sentinel123", "u123926142_CPU_Sentinel");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$sql = "SELECT CpuUsage, RamOccupied, DiskFree, DiskCapacityMB, BatteryPercentage
FROM `$username`
WHERE FirstName = '$FirstName' AND LastName = '$LastName' AND DateAndTime = '$DateAndTime'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

    $CPU = array(
        array("label"=> "CPU", "y"=> $row["CpuUsage"]),
        array("label"=> "Free", "y"=> 100-$row["CpuUsage"])
    );
    

  

    $RAM = array(
        array("label"=> "RAM", "y"=> $row["RamOccupied"]),
        array("label"=> "Free", "y"=> 100-$row["RamOccupied"])
    );
    
    $Disk = array(
        array("label"=> "Disk", "y"=> round(($row["DiskFree"]/$row["DiskCapacityMB"])*100, 0)),
        array("label"=> "Free", "y"=> 100-round(($row["DiskFree"]/$row["DiskCapacityMB"])*100, 0))
    );
    
    $Battery = array(
        array("label"=> "Battery", "y"=> $row["BatteryPercentage"]),
        array("label"=> "Used", "y"=> 100-$row["BatteryPercentage"])
    );







?>



<!doctype html>


<head>
<title> CPU Sentinel Graphs </title>
<link rel="stylesheet" type="text/css" href="CPUSentinelGraphsStyle.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


</head>

<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<br> <br> <br>
<div id="chartContainer1" style="width: 50%; height: 450px;display: inline-block;"></div>
<div id="chartContainer2" style="width: 45%; height: 450px;display: inline-block;"></div><br/>
<br> <br>
<div id="chartContainer3" style="width: 50%; height: 450px;display: inline-block;"></div>
<div id="chartContainer4" style="width: 45%; height: 450px;display: inline-block;"></div>

<script>



var chart = new CanvasJS.Chart("chartContainer1",
                               {
    animationEnabled: true,
        backgroundColor: "white",
        title: {
            text: "CPU",
            fontColor: "black",
        },

        data: [{
            type: "pie",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{label} ({y})",
            indexLabelFontColor: "black",
            dataPoints: <?php echo json_encode($CPU, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

var chart = new CanvasJS.Chart("chartContainer2",
    {
        animationEnabled: true,
            backgroundColor: "white",
            title: {
                text: "RAM",
                fontColor: "black",
            },

            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                indexLabelFontColor: "black",
                dataPoints: <?php echo json_encode($RAM, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

var chart = new CanvasJS.Chart("chartContainer3",
    {
        animationEnabled: true,
            backgroundColor: "white",
            title: {
                text: "Disk",
                fontColor: "black",
            },

            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                indexLabelFontColor: "black",
                dataPoints: <?php echo json_encode($Disk, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

var chart = new CanvasJS.Chart("chartContainer4", {
    animationEnabled: true,
        backgroundColor: "white",
        title: {
            text: "Battery",
            fontColor: "black",
        },

        data: [{
            type: "pie",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{label} ({y})",
            indexLabelFontColor: "black",
            dataPoints: <?php echo json_encode($Battery, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
</script>







<body text="black">
        
<head>
    
<title> CPU Sentinel </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>





<body>
<body style="height:1500px">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

<!--  Use flexbox utility classes to change how the child elements are justified  -->
  <div class="collapse navbar-collapse justify-content-between" id="navbarToggle">

    <ul class="navbar-nav">

    <li class="nav-item">
      <a class="nav-link" href="CPUSentinelHome.php">Home</a>
    </li>


      <li class="nav-item">
        <a class="nav-link active">Graph<span class="sr-only">(current)</span></a>
      </li>


      


      <li class="nav-item">
        <a class="nav-link">History</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="contactUs.html">Contact Us</a>
      </li>

      <li class="nav-item">
        <a class="nav-link">Search</a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
    </ul>
    
    
<!--   Show this only lg screens and up   -->
<div class="home">
    <a href="CPUSentinelHome.php">CPU Sentinel</a>
    </div>

    <div class="navbar_right">
        <form method="post" action='CPUSentinelSearch.php'>
            <input type="button" class="button" value='Logout' onclick="location.href='logout.php';" />
            <input id="searchBox" name="name" type="text" placeholder="Search by name">
            <input type="submit" name="searchname" value="Search">
        </form>
    </div>
    </ul>
</div>
</nav>

</body>
<div class="background">
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
</div>


</html>
