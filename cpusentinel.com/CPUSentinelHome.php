
<?php
session_start();
?>
<!doctype html>

<html>

    
<body text="black">
        
<head>
<link rel="stylesheet" type="text/css" href="CPUSentinelHomeStyle.css">
  <meta http-equiv="refresh" content="60" > 
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
<body style="height:1700px">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

<!--  Use flexbox utility classes to change how the child elements are justified  -->
  <div class="collapse navbar-collapse justify-content-between" id="navbarToggle">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="CPUSentinelHome.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link">Graph</a>
      </li>
      <li class="nav-item">
        <a class="nav-link">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link">Search</a>
      </li>
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

<body style ="background: white">

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
    <th> Power </th>
    <th> Graph </th>
</tr>




<?php
$username = $_SESSION['username'];
$_SESSION['username'] = $username;
    
function isPoweredON($DateAndTime) {
    
    $date = date_create(date("yy-m-d H:i:s"));
    $dateCopy = $date;
    $dateNow = date_format(date_add($date,date_interval_create_from_date_string("3 hours")),"Y-m-d H:i:s");
    $datemin = date_format(date_sub($dateCopy,date_interval_create_from_date_string("20 minutes")),"Y-m-d H:i:s");

        
    if ((($DateAndTime >= $datemin) && ($DateAndTime <= $dateNow)) || ($DateAndTime >= $dateNow))
        return TRUE;
            
    else
        
        return FALSE;
        
}
        


    
$conn = mysqli_connect("localhost", "u123926142_ZiadHamwi", "sentinel123", "u123926142_CPU_Sentinel");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}


  
$sql = "SELECT tt.*
FROM `$username` tt
INNER JOIN (SELECT FirstName, LastName, MAX(DateAndTime) AS MaxDateTime FROM `$username` GROUP BY FirstName) groupedtt ON tt.FirstName = groupedtt.FirstName AND tt.LastName = groupedtt.LastName AND  tt.DateAndTime = groupedtt.MaxDateTime
WHERE tt.FirstName != '0'
ORDER BY CpuUsage DESC, RamOccupied DESC, (DiskFree/DiskCapacityMB)*100 DESC, BatteryPercentage ASC;";


$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    
    $CpuUsage = $row["CpuUsage"];
    $RamUsage =  $row["RamOccupied"];
    $DiskUsage = round(($row["DiskFree"]/$row["DiskCapacityMB"])*100, 0);
    $BatteryPercentage = $row["BatteryPercentage"];
    
    $FirstName = $row["FirstName"];
    $LastName = $row["LastName"];
    $DateAndTime = $row["DateAndTime"];
    
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
    $DiskCapacityMB = $row["DiskCapacityMB"];
    $DiskFree = $row["DiskFree"];

    $BatteryPercentage = $row["BatteryPercentage"];
    $BatteryVoltage = $row["BatteryVoltage"];
    $BatteryName = $row["BatteryName"];
    $BatteryRuntime = $row["BatteryRuntime"];

    if ($CpuUsage > 80)
        echo "<script type='text/javascript'> sendMail($FirstName, $LastName, $email, 'CPU') </script>";
    if ($RamOccupied > 80)
        echo "<script type='text/javascript'> sendMail($FirstName, $LastName, $email, 'RAM') </script>";
    if ($DiskOccupied > 80)
        echo "<script type='text/javascript'> sendMail($FirstName, $LastName, $email, 'Disk') </script>";
    if ($BatteryPercentage < 20)
        echo "<script type='text/javascript'> sendMail($FirstName, $LastName, $email, 'Battery') </script>";
    
    
    
    
if ($CpuUsage > 80 || $RamUsage > 80|| $DiskUsage > 80 || $BatteryPercentage < 20)
    echo "<tr  class='clickable-row'><a class='showmore'></a><td>"."<a href='CPUSentinelHistory.php?firstName=$FirstName&lastName=$LastName' style='color:inherit'>" ."<font color='#FF6B6B'>"."<div class='buttons'> $FirstName $LastName </div> </a>";
else
    echo "<tr class='clickable-row'><td>"."<a href='CPUSentinelHistory.php?firstName=$FirstName&lastName=$LastName' style='color:inherit'>"."<div class='buttons'> $FirstName $LastName </div> </a>";

if ($CpuUsage > 80 || $RamUsage > 80|| $DiskUsage > 80 || $BatteryPercentage < 20)
    echo "</td><td>"."<font color='#FF6B6B'> $CpuUsage" ;
else
    echo "</td><td>". $CpuUsage ;
if ($CpuUsage > 80 || $RamUsage > 80|| $DiskUsage > 80|| $BatteryPercentage < 20)
    echo "%</td><td>"."<font color='#FF6B6B'> $RamUsage";
else
    echo "%</td><td>". $RamUsage;
if ($CpuUsage > 80 || $RamUsage > 80|| $DiskUsage > 80 || $BatteryPercentage < 20)
    echo "%</td><td>". "<font color='#FF6B6B'> $DiskUsage";
else
    echo "%</td><td>". $DiskUsage;

if ($CpuUsage > 80 || $RamUsage > 80|| $DiskUsage > 80 || $BatteryPercentage < 20)
    echo "%</td><td>". "<font color='#FF6B6B'> $BatteryPercentage";
else
    echo "%</td><td>". $BatteryPercentage;

if (isPoweredON($DateAndTime) == TRUE)
    echo "%<td><div class='on'><a class='showmore'>ON</a></div></td>";
else if (isPoweredON($DateAndTime) == FALSE)
    echo "%<td><div class='off'><a class='showmore'>OFF</a></div></td>";
    
echo "<td><a href='CPUSentinelGraphs.php?firstName=$FirstName&lastName=$LastName&dateAndTime=$DateAndTime' style='color:inherit'>"."<div class='buttons'>View</div></a></td>";


    echo "<tr align='center' class='detail'><td colspan='10'><div><table></tr><th>Employee <br><br> First Name: $FirstName <br><br> Last Name: $LastName </th><th> CPU <br><br> Model Number: $CpuName <br><br> Core Count: $CpuNumberOfCores <br><br> Thread Count: $CpuNumberOfThreads <br><br> Base Clock: $CpuClockSpeed Ghz <br><br> L2 Cache Size: $CpuL2Cache MB <br><br> L3 Cache Size: $CpuL3Cache MB <br><br> Architecture: $CpuArchitecture </th><th> Memory <br><br> Capacity: $RamCapacity GB <br><br> </th> <th> Disk <br><br> Name: $DiskName <br><br> Interface: $DiskInterfaceType <br><br> Capacity: $DiskCapacityMB MB <br><br> Remaining Capacity: $DiskFree MB </th> <th> Battery <br><br> Name: $BatteryName <br><br> Voltage: $BatteryVoltage V <br><br> Time Remaining: $BatteryRuntime sec </th> </td></tr></table></td></tr>";

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



function sendMail(firstname, lastname, email, element) {
    if (element == 'Battery') {
        Email.send({
        Host : "smtp.gmail.com",
        Username : "cpusentinel",
        Password : "CpuSent5454",
        To : email,
        From : "CPUSentinel@gmail.com",
        Subject : "CPU Overload Alert!",
        Body : firstname + ' ' + lastname + "'s Battery has dropped below 20%." //here make sure to modify the name of the user
        }).then(
          message => alert(message)
        );
    }
    
    else {
    Email.send({
        Host : "smtp.gmail.com",
        Username : "cpusentinel",
        Password : "CpuSent5454",
        To : email,
        From : "CPUSentinel@gmail.com",
        Subject : "CPU Overload Alert!",
        Body : firstname + ' ' + lastname + "'s " + element + " has exceeded 80% usage." //here make sure to modify the name of the user
        }).then(
          message => alert(message)
        );
    }
}

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

