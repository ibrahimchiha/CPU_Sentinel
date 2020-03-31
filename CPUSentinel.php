<!doctype html>

<html>
    
    <style>
        tr[data-href] {
            cursor: pointer;
        }
    </style>
    
    <style>

* {
  font-family: sans-serif;
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
tr {
    background: white;
color: black;
}
tr:nth-child(4n+1), tr:nth-child(4n+2) {
    background: black;
color: white;
}
.content-table th,
.content-table td {
  padding: 12px 15px;
}

</style>
    
    <body text="white">
        
<head>
    
<title> CPU Sentinel </title>

</head>

<style type="text/css">
tr.detail {
  display: none;
  width: 100%;
    
    
}
tr.detail div {
  display: none;
}
.showmore:hover {
  cursor: pointer;
}

A {text-decoration: none;}
</style>

<body>
<br>
<br>
<h1 align="center"> CPU Sentinel </h1>
<body style ="background: black">

<br>
<br>
<br>
<br>
<br>



<table  align = "center" class="content-table" width = "1200" height = "150">
<thead>
<tr>
    <th> PC ID </th>
    <th> CPU % </th>
    <th> RAM % </th>
    <th> Disk % </th>
    <th> GPU % </th>
    <th> Battery % </th>
    <th> Graph </th>
    <th> History </th>
    <th> Show More </th>
</tr>




<?php


    
$conn = mysqli_connect("127.0.0.1", "root", "sentinel123", "CPU Sentinel");
// Check connection
if (mysqli_connect_errno()) {
  echo "Connection to database failed! " . mysqli_connect_error();
  exit();
}
$sql = "SELECT Employee.employee_id, cpu_usage, ram_usage, capacity_mb, remaining_capacity_mb, gpu_usage, percentage_remaining, first_name, last_name, Employee.operating_system, Employee.admin_id, Cpu.manufacturer AS cpu_manufacturer, Cpu.model_nb AS cpu_model_nb, Cpu.nb_cores, Cpu.nb_threads, Cpu.cache_size_mb, Cpu.architecture, Cpu.base_clock_speed_ghz AS cpu_base_clock_speed_ghz, Cpu.boost_clock_speed_ghz AS cpu_boost_clock_speed_ghz, ram.manufacturer AS ram_manufacturer, ram.model_nb AS ram_model_nb, ram.capacity_gb, ram.stick_type, ram.cell_type, ram.clock_freq_mhz, storage_drive.manufacturer AS storage_drive_manufacturer, storage_drive.model_nb AS storage_drive_model_nb, storage_drive.drive_type, storage_drive.max_bandwidth_mbps, storage_drive.interface, storage_drive.capacity_mb, storage_drive.remaining_capacity_mb, storage_drive.dram_cache_gb, gpu.manufacturer AS gpu_manufacturer,gpu.base_clock_mhz AS gpu_base_clock_mhz, gpu.boost_clock_mhz AS gpu_boost_clock_mhz, gpu.memory_size_gb AS gpu_memory_size_gb, gpu.memory_type AS gpu_memory_type, gpu.memory_clock_mhz AS gpu_memory_clock_mhz, gpu.model_nb AS gpu_model_nb, battery.manufacturer AS battery_manufacturer, battery.model_nb AS battery_model_nb, battery.battery_type, battery.capacity_wh AS battery_capacity_wh, battery.nb_cells AS battery_nb_cells, battery.capacity_mah AS battery_capacity_mah, battery.voltage AS battery_voltage, battery.time_remaining_sec AS battery_time_remaining_sec FROM `CPU Sentinel`.Employee, `CPU Sentinel`.cpu, `CPU Sentinel`.ram, `CPU Sentinel`.storage_drive, `CPU Sentinel`.gpu, `CPU Sentinel`.battery WHERE Employee.employee_id = cpu.employee_id and Employee.employee_id = ram.employee_id and Employee.employee_id = storage_drive.employee_id and Employee.employee_id = gpu.employee_id and Employee.employee_id = battery.employee_id ORDER BY cpu_usage DESC, ram_usage DESC, gpu_usage DESC, percentage_remaining ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    $pcID = $row["employee_id"];
    $cpu = $row["cpu_usage"];
    $ram =  $row["ram_usage"];
    $disk = round(($row["remaining_capacity_mb"]/$row["capacity_mb"])*100, 0);
    $gpu = $row["gpu_usage"];
    $battery = $row["percentage_remaining"];
    
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $operating_system = $row["operating_system"];
    $admin_id = $row["admin_id"];
    
    $cpu_manufacturer = $row["cpu_manufacturer"];
    $cpu_base_clock_speed_ghz = $row["cpu_base_clock_speed_ghz"];
    $cpu_boost_clock_speed_ghz = $row["cpu_boost_clock_speed_ghz"];
    $cpu_model_nb = $row["cpu_model_nb"];
    $cpu_nb_cores = $row["nb_cores"];
    $cpu_nb_threads = $row["nb_threads"];
    $cpu_cache_size_mb = $row["cache_size_mb"];
    $cpu_architecture = $row["architecture"];
    
    $ram_manufacturer = $row["ram_manufacturer"];
    $ram_model_nb = $row["ram_model_nb"];
    $ram_capacity_gb = $row["capacity_gb"];
    $ram_stick_type = $row["stick_type"];
    $ram_cell_type = $row["cell_type"];
    $ram_clock_freq_mhz = $row["clock_freq_mhz"];
    
    $storage_drive_manufacturer = $row["storage_drive_manufacturer"];
    $storage_drive_model_nb = $row["storage_drive_model_nb"];
    $storage_drive_type = $row["drive_type"];
    $storage_drive_max_bandwidth_mbps = $row["max_bandwidth_mbps"];
    $storage_drive_interface = $row["interface"];
    $storage_drive_capacity_mb = $row["capacity_mb"];
    $storage_drive_remaining_capacity_mb = $row["remaining_capacity_mb"];
    $storage_drive_dram_cache_gb = $row["dram_cache_gb"];
    
    $gpu_manufacturer = $row["gpu_manufacturer"];
    $gpu_base_clock_mhz = $row["gpu_base_clock_mhz"];
    $gpu_boost_clock_mhz = $row["gpu_boost_clock_mhz"];
    $gpu_memory_size_gb = $row["gpu_memory_size_gb"];
    $gpu_memory_type = $row["gpu_memory_type"];
    $gpu_memory_clock_mhz = $row["gpu_memory_clock_mhz"];
    $gpu_model_nb = $row["gpu_model_nb"];
    
    
    $battery_manufacturer = $row["battery_manufacturer"];
    $battery_model_nb = $row["battery_model_nb"];
    $battery_type = $row["battery_type"];
    $battery_capacity_wh = $row["battery_capacity_wh"];
    $battery_nb_cells = $row["battery_nb_cells"];
    $battery_capacity_mah = $row["battery_capacity_mah"];
    $battery_voltage = $row["battery_voltage"];
    $battery_time_remaining_sec = $row["battery_time_remaining_sec"];
    
    
    
    
    


    
    
    

    
//
    //echo "<tr><td>" ."<font color='red'> $pcID"."</td><td>". $cpu . "%</td><td>". $ram . "%</td><td>"
//. $disk."<td><a href='CPU Sentinel Graphs.php?pc_id=$pcID&cpu=$cpu&ram=$ram&disk=$disk'>Graph</a></td>";

if ($cpu >= 90 || $ram >= 90|| $disk >=90 || $gpu >= 90 || $battery <= 20)
    echo "<tr><td>" ."<font color='red'> $pcID";
else
    echo "<tr><td>".$pcID;
if ($cpu >= 90 || $ram >= 90|| $disk >=90 || $gpu >= 90 || $battery <= 20)
    echo "</td><td>"."<font color='red'> $cpu" ;
else
    echo "</td><td>". $cpu ;
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
echo "%<td><a href='CPU Sentinel Graphs.php?pc_id=$pcID&cpu=$cpu&ram=$ram&disk=$disk&gpu=$gpu&battery=$battery' style='color:inherit'>View</a></td>";
echo "<td><a href='CPUSentinelHistory.php?pc_id=$pcID' style='color:inherit'> View</a></td>";
    
echo "<td><a class='showmore'>Show More</a></td>";
echo "<tr class='detail'><td colspan='10'><div><table></tr><th>Employee <br><br> First Name: $first_name <br><br> Last Name: $last_name<br><br> Operating System: $operating_system <br><br> Admin ID: $admin_id</th><th> CPU <br><br> Manufacture: $cpu_manufacturer<br><br> Model Number: $cpu_model_nb <br><br> Core Count: $cpu_nb_cores <br><br> Thread Count: $cpu_nb_threads <br><br> Base Clock: $cpu_base_clock_speed_ghz Ghz<br><br>Boost Clock: $cpu_boost_clock_speed_ghz Ghz <br><br> Cache Size: $cpu_cache_size_mb MB <br><br> Architecture: $cpu_architecture Gen</th> <th> Memory <br><br> Manufacture: $ram_manufacturer <br><br> Model Number: $ram_model_nb <br><br> Capacity: $ram_capacity_gb GB <br><br> Clock Speed: $ram_clock_freq_mhz Mhz <br><br> Stick Type: $ram_stick_type <br><br> Cell Type: $ram_cell_type </th> <th> Disk <br><br> Manufacture: $storage_drive_manufacturer <br><br> Model Number: $storage_drive_model_nb <br><br> Type: $storage_drive_type <br><br> Max Bandwidth: $storage_drive_max_bandwidth_mbps Mbps <br><br> Interface: $storage_drive_interface <br><br> Capacity: $storage_drive_capacity_mb MB <br><br> Remaining Capacity: $storage_drive_remaining_capacity_mb <br><br> DRAM Cache: $storage_drive_dram_cache_gb GB </th> <th> GPU <br><br> Manufacture: $gpu_manufacturer <br><br> Model Number: $gpu_model_nb <br><br> Base Clock: $gpu_base_clock_mhz Mhz <br><br> Boost Clock: $gpu_boost_clock_mhz <br><br> VRAM: $gpu_memory_size_gb GB <br><br> VRAM Type: $gpu_memory_type <br><br> VRAM Clock Speed: $gpu_memory_clock_mhz Mhz </th> <th> Battery <br><br> Manufacture: $battery_manufacturer <br><br> Model Number: $battery_model_nb <br><br> Type: $battery_type <br><br> Power: $battery_capacity_wh Wh <br><br> Number of Cells: $battery_nb_cells <br><br> Capacity: $battery_capacity_mah mah <br><br> Voltage: $battery_voltage V <br><br> Time Remaining: $battery_time_remaining_sec sec </th> </td></tr></table></td></tr>";

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
