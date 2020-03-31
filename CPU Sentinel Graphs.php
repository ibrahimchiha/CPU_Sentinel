<?php

$pcID = $_GET['pc_id'];
$cpu = $_GET['cpu'];
$ram = $_GET['ram'];
$disk = $_GET['disk'];
$gpu = $_GET['gpu'];
$battery = $_GET['battery'];


 
$dataPoints = array(
	array("label"=> "CPU", "y"=> $cpu),
	array("label"=> "RAM", "y"=> $ram),
	array("label"=> "Disk", "y"=> $disk),
	array("label"=> "GPU", "y"=> $gpu),
	array("label"=> "Battery", "y"=> $battery)
);
	
?>

<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	backgroundColor: "black",
	title: {
		text: "System Usage",
		fontColor: "white",
	},
	subtitles: [{
		fontColor: "white",
		text: <?php echo $pcID; ?>
	}],
	
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
		indexLabelFontColor: "white",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<body style ="background: black">
<div id="chartContainer" style="height: 900px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>  
