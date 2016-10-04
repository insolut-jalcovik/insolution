<?php
//run using  php-cgi -f color_fill.php x=2 y=3 color=5


$coord_x = $_GET["x"];
$coord_y = $_GET["y"];
$color = $_GET["color"];

$canvas[] = array(0,4,0,0,0,2,0,0,0,0,0,0,1);
$canvas[] = array(0,4,0,0,0,2,0,0,0,0,0,0,1);
$canvas[] = array(0,4,0,0,0,2,0,0,0,0,0,0,1);
$canvas[] = array(0,4,0,0,0,2,7,7,7,7,7,7,1);
$canvas[] = array(0,4,0,0,0,2,0,0,0,0,0,0,1);
$canvas[] = array(0,4,0,0,0,3,0,0,0,0,0,0,1);
$canvas[] = array(0,0,3,3,3,0,0,0,0,0,0,0,1);
$canvas[] = array(0,0,0,0,8,0,0,0,0,0,0,0,1);

function draw($currentArray){
	print "\n";
	for ($i=0; $i<sizeof($currentArray); $i++){
		for ($j=0; $j<sizeof($currentArray[0]); $j++){
			print " ".$currentArray[$i][$j]." ";
		}
		print "\n";
	}	
}

function recursive_fill(&$canvas, $x, $y, $color, $new_color){
	if (($x == -1)||($y== -1)|| $x > sizeof($canvas)-1|| $y > sizeof($canvas[0])-1){
		return;
	}
	
	if ($canvas[$x][$y] != $color){
		return;
	}
	$canvas[$x][$y] = $new_color;
	recursive_fill($canvas, $x+1, $y, $color, $new_color);
	recursive_fill($canvas, $x-1, $y, $color, $new_color);
	recursive_fill($canvas, $x, $y+1, $color, $new_color);
	recursive_fill($canvas, $x, $y-1, $color, $new_color);
	return $canvas;
}


function fill($canvas, $x, $y, $color){
	$old_color = $canvas[$x][$y];
	$canvas = recursive_fill($canvas, $x, $y, $old_color, $color);
	
	draw($canvas);
}

draw($canvas);

fill($canvas, $coord_x, $coord_y, $color);




?>

