<?php
$queens = $_GET["queens"];

for ($i=0; $i<$queens; $i++){
	for ($j=0; $j<$queens; $j++){
		$currentArray[$i][$j] = 0;
	}
}

$GLOBALS['solutions'] = 0;

function vykresli($currentArray){
	print "\n";
	for ($i=0; $i<sizeof($currentArray); $i++){
		for ($j=0; $j<sizeof($currentArray); $j++){
			print " ".$currentArray[$i][$j]." ";
		}
		print "\n";
	}	
}

function checkPosition($row, $column, $currentArray, $queens){
	for ($i=0; $i < ($queens-1); $i++){
		if ($currentArray[$row][$i] == 1){
			return 0;
		}
		if ($currentArray[$i][$column] == 1){
			return 0;
		}
	}
	
	$m = $row; $n = $column;
	while (($m >= 0)&&($n >= 0)){
		if ($currentArray[$m][$n] == 1){
			return 0;
		}
		$m--; $n--; 
	}
	
	$m = $row; $n = $column;
	while (($m <= ($queens-1))&&($n >= 0)){
		if ($currentArray[$m][$n] == 1){
			return 0;
		}
		$m++; $n--;
	}
	
	$m = $row; $n = $column;
	while (($m <= ($queens-1))&&($n <= ($queens-1))){
		if ($currentArray[$m][$n] == 1){
			return 0;
		}
		$m++; $n++;
	}
	
	$m = $row; $n = $column;
	while (($m >= 0)&&($n <= ($queens-1))){
		if ($currentArray[$m][$n] == 1){
			return 0;
		}
		$m--; $n++;
	}
	return 1;
}

function find_previous_column($row){
	return array_search('1', $row);
}



function recursion($m, $n, $currentArray, $queens){
	$currentArray[$m][$n-1] = 0;
	
 	for ($i=$m; $i<$queens; $i++){
 		for ($j=$n; $j<$queens; $j++){
 			if(($i>0) && false === find_previous_column($currentArray[$i-1])){
 				return;
 			}
			if(checkPosition($i, $j, $currentArray, $queens) == 1){
				$currentArray[$i][$j] = 1;
				if ($i == ($queens-1)){
					$GLOBALS['solutions']++;
					return;
				}
				recursion($i+1, 0, $currentArray, $queens);		
 				recursion($i, $j+1, $currentArray, $queens);
 				return;
			}
 		}
 	}
}

recursion (0, 0, $currentArray, $queens);
echo "possibilities for ".$queens." queens: ".$GLOBALS['solutions'];

?>

