<?php
session_start();
?>


<!doctype html>

<html>
    
    
<body text="black">
        
<head>
    
<title> CPU Sentinel </title>
<link rel="stylesheet" type="text/css" href="CPUSentinelSearchStyle.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>



<body style="height:1500px">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

<!--  Use flexbox utility classes to change how the child elements are justified  -->
  <div class="collapse navbar-collapse justify-content-between" id="navbarToggle">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="CPUSentinelHome.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link">Graph</a>
      </li>
      <li class="nav-item">
        <a class="nav-link">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active">Search <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contactUs.html">Contact Us</a>
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


<a> <font color="white"> <center> CPU Sentinel </center> </font> </a>
</div>



<br>
<br>

<?php
$firstName = $_POST['name'];
echo "<h1 align='center' style='color:white'> Results for $firstName </h1>";
?>
<br>
<br>



<table  align = "center" class="content-table" width = "1000" height = "150">
<thead>
<tr>
    <th> Name </th>
    <th> CPU % </th>
    <th> RAM % </th>
    <th> Disk % </th>
    <th> Battery % </th>
    <th> Graph </th>
</tr>




<?php
$username = $_SESSION['username'];
$_SESSION['username'] = $username;
$conn = mysqli_connect("localhost", "u123926142_ZiadHamwi", "sentinel123", "u123926142_CPU_Sentinel");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}



$sql = "SELECT tt.* 
FROM sentinel tt 
INNER JOIN (SELECT FirstName, LastName, MAX(DateAndTime) AS MaxDateTime 
FROM sentinel GROUP BY FirstName, LastName) groupedtt ON tt.FirstName = groupedtt.FirstName AND tt.LastName = groupedtt.LastName AND tt.DateAndTime = groupedtt.MaxDateTime
WHERE tt.FirstName != '0';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
     $CpuUsage = $row["CpuUsage"];
    $RamUsage =  $row["RamOccupied"];
    $DiskUsage = round(($row["DiskFree"]/$row["DiskCapacityMB"])*100, 0);
    $BatteryPercentage = $row["BatteryPercentage"];
    
    $FirstName = $row["FirstName"];
    $LastName = $row["LastName"];
    
    $CpuClockSpeed = $row["CpuClockSpeed"];
    $CpuName = $row["CpuName"];
    $CpuNumberOfCores = $row["CpuNumberOfCores"];
    $CpuNumberOfThreads = $row["CpuNumberOfThreads"];
    $CpuL2Cache = $row["CpuL2Cache"];
    $CpuL3Cache = $row["CpuL3Cache"];
    $CpuArchitecture = $row["CpuArchitecture"];
    
    $RamCapacity = $row["RamCapacity"];
    $RamFree = $row["RamFree"];
    $RamOccupied = $row["RamOccupied"];
   
    $DiskName = $row["DiskName"];
    $DiskInterfaceType = $row["DiskInterfaceType"];
    $DiskManufacture = $row["DiskManufacture"];
    $DiskCapacityMB = $row["DiskCapacityMB"];
    $DiskFree = $row["DiskFree"];
    $DiskOccupied = $row["DiskOccupied"];
    
    $BatteryPercentage = $row["BatteryPercentage"];
    $BatteryVoltage = $row["BatteryVoltage"];
    $BatteryName = $row["BatteryName"];
    $BatteryRuntime = $row["BatteryRuntime"];
    
    
    
    if ($firstName == $FirstName) {
        if ($CpuUsage >= 90 || $RamUsage >= 90|| $DiskUsage >=90 || $BatteryPercentage <= 20)
            echo "<tr  class='clickable-row'><a class='showmore'></a><td>"."<a href='CPUSentinelHistory.php?firstName=$FirstName&lastName=$LastName' style='color:inherit'>" ."<font color='#FF6B6B'>"."<div class='buttons'> $FirstName $LastName </div> </a>";
        else
            echo "<tr class='clickable-row'><td>"."<a href='CPUSentinelHistory.php?firstName=$FirstName&lastName=$LastName' style='color:inherit'>"."<div class='buttons'> $FirstName $LastName </div> </a>";
        if ($CpuUsage >= 90 || $RamUsage >= 90|| $DiskUsage >=90 || $BatteryPercentage <= 20)
            echo "</td><td>"."<font color='#FF6B6B'> $CpuUsage" ;
        else
            echo "</td><td>". $CpuUsage ;
        if ($CpuUsage >= 90 || $RamUsage >= 90|| $DiskUsage >=90|| $BatteryPercentage <= 20)
            echo "%</td><td>"."<font color='#FF6B6B'> $RamUsage";
        else
            echo "%</td><td>". $RamUsage;
        if ($CpuUsage >= 90 || $RamUsage >= 90|| $DiskUsage >=90 || $BatteryPercentage <= 20)
            echo "%</td><td>". "<font color='#FF6B6B'> $DiskUsage";
        else
            echo "%</td><td>". $DiskUsage;
        
        if ($CpuUsage >= 90 || $RamUsage >= 90|| $DiskUsage >=90 || $BatteryPercentage <= 20)
            echo "%</td><td>". "<font color='#FF6B6B'> $BatteryPercentage";
        else
            echo "%</td><td>". $BatteryPercentage;
        echo "%<td><a href='CPUSentinelGraphs.php?firstName=$FirstName&lastName=$LastName&dateAndTime=$DateAndTime' style='color:inherit'>"."<div class='buttons'>View</div></a></td>";

        //echo "<td><a class='showmore'>Show More</a></td>";
            echo "<tr align='center' class='detail'><td colspan='10'><div><table></tr><th>Employee <br><br> First Name: $FirstName <br><br> Last Name: $LastName </th><th> Cpu <br><br> Model Number: $CpuName <br><br> Core Count: $CpuNumberOfCores <br><br> Thread Count: $CpuNumberOfThreads <br><br> Base Clock: $CpuClockSpeed Ghz <br><br> L2 Cache Size: $CpuL2Cache MB <br><br> L3 Cache Size: $CpuL3Cache MB <br><br> Architecture: $CpuArchitecture Gen </th><th> Memory <br><br> Capacity: $RamCapacity GB <br><br> </th> <th> Disk <br><br> Name: $DiskName <br><br> Interface: $DiskInterfaceType <br><br> Capacity: $DiskCapacityMB MB <br><br> Remaining Capacity: $DiskFree </th> <th> Battery <br><br> Name: $BatteryName <br><br> Voltage: $BatteryVoltage V <br><br> Time Remaining: $BatteryRuntime sec </th> </td></tr></table></td></tr>";
        
        }

}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>


</table>
<script src="http://code.jquery.com/jquery.js"></script>

<script>
$(function() {
  $('a.showmore').click(function(e) {
    e.preventDefault();
    var targetrow = $(this).closest('tr').next('.detail');
    targetrow.show().find('div').slideToggle('slow', function(){
      if (!$(this).is(':visible')) {
        targetrow.hide();
      }
    });
  });
});

jQuery(document).ready(function($) {
    $(".clickable-row").click(function(e) {
//        window.location = $(this).data("href");
          var targetrow = $(this).closest('tr').next('.detail');
          targetrow.show().find('div').slideToggle('slow', function(){
            if (!$(this).is(':visible')) {
              targetrow.hide();
            }
          });
    });
});

</script>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

</body>
<div class = "footer">
    &nbsp&nbsp&nbsp&nbspCPU Sentinel &copy; 2020
<br>
    &nbsp&nbsp&nbsp&nbspCMPS 253 Software Engineering
<br>
<br>
  </div>
 
</html>
