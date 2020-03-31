<!doctype html>

<html>
    
    
    
    <style>
        tr[data-href] {
            cursor: pointer;
        }
    </style>
	
	<style>








* {
  font-family: sans-serif; /* Change your font family */
}
.content-table {
  border-collapse: collapse;
/*  margin: 25px 0;*/
  font-size: 0.9em;
  min-width: 400px;
  border-radius: 5px 5px 0 0;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  text-align: center;
  font-weight: bold;
  overflow: hidden;
}


th {
color: white;
}

th {
background-color: #F1C40F;
color: black;
}
tr:nth-child(odd) {background-color: white; color: black}

.content-table th,
.content-table td {
  padding: 12px 15px;
}
A {text-decoration: none;}
</style>
    
    <body text="white">
        
<head>
    
<title> CPU Sentinel </title>
<!--<link href="CPU Sentinel.css" rel="stylesheet" type"text/css">-->
</head>


<body>
<br>
<br>
<h1 align="center"> CPU Sentinel </h1>
<h2 align="center"> PC <?php echo $_GET['pc_id'] ?> </h2>
<body style ="background: black">

<br>
<br>
<br>



<table  align = "center" class="content-table" width = "1000" height = "150">
<thead>
<tr>
    <th> CPU % </th>
    <th> RAM % </th>
    <th> Disk % </th>
	<th> GPU % </th>
	<th> Battery % </th>
	<th> Graph </th>
</tr>




<?php

$pcID = $_GET['pc_id'];
if ($pcID < 10)
	$pcID = '0'.$pcID;
$conn = mysqli_connect("127.0.0.1", "root", "sentinel123", "CPU Sentinel");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}


$sql = 'SELECT cpu_usage, ram_usage, capacity_mb, remaining_capacity_mb, gpu_usage, percentage_remaining FROM pc'.$pcID.' ORDER BY cpu_usage DESC, ram_usage DESC, gpu_usage DESC, percentage_remaining ASC';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
	$cpu = $row["cpu_usage"];
	$ram =  $row["ram_usage"];
	$disk = round(($row["remaining_capacity_mb"]/$row["capacity_mb"])*100, 0);
	$gpu = $row["gpu_usage"];
	$battery = $row["percentage_remaining"];
	
	//echo "<tr><td>" ."<font color='red'> $pcID"."</td><td>". $cpu . "%</td><td>". $ram . "%</td><td>"
//. $disk."<td><a href='CPU Sentinel Graphs.php?pc_id=$pcID&cpu=$cpu&ram=$ram&disk=$disk'>Graph</a></td>";


if ($cpu >= 90 || $ram >= 90|| $disk >=90 || $gpu >= 90 || $battery <= 20)
	echo "<tr><td>"."<font color='red'> $cpu" ;
else
	echo "</tr><td>". $cpu ;
if ($cpu >= 90 || $ram >= 90|| $disk >=90 || $gpu >= 90 || $battery <= 20)
	echo "%</td><td>"."<font color='red'> $ram";
else
	echo "%</td><td>". $ram;
if ($cpu >= 90 || $ram >= 90|| $disk >=90 || $gpu >= 90 || $battery <= 20)
	echo "%</td><td>". "<font color='red'> $disk";
else
	echo "%</td><td>". $disk;
if ($cpu >= 90 || $ram >= 90|| $disk >=90 || $gpu >= 90 || $battery <= 20)
	echo "%</td><td>". "<font color='red'> $gpu";
else
	echo "%</td><td>". $gpu;
if ($cpu >= 90 || $ram >= 90|| $disk >=90 || $gpu >= 90 || $battery <= 20)
	echo "%</td><td>". "<font color='red'> $battery";
else
	echo "%</td><td>". $battery;
echo "%<td><a href='CPU Sentinel Graphs.php?pc_id=$pcID&cpu=$cpu&ram=$ram&disk=$disk&gpu=$gpu&battery=$battery'style='color:inherit'>View</a></td>";

}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>


</table>




<!--<script>-->
<!--    document.addEventListener("DOMContentLoaded", () => {-->
<!--                              const rows = document.querySelectorAll("tr[data=href]");-->
<!--                              -->
<!--                              rows.forEach(row => {-->
<!--                                           row.addEventListener("click", ()=> {-->
<!--                                                                window.location.href = row.dataset.href;-->
<!--                                                                });-->
<!--                                           });-->
<!--                              });-->
<!--                              -->
<!--                              </script>-->



<script>
    
    $(document).ready(function () {
                      $(document.body).on("click", "tr[data-href]", function () {
                                          window.location.href = this.dataset.href
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
<footer>
  <div class="container">
    CPU Sentinel &copy; 2020
<br>
    CMPS 253 Software Engineering
<br>
<br>
  </div>
</footer>
</html>
