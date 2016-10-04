<?php
$queens = $_GET["queens"];

for ($i=0; $i<$queens; $i++){
	for ($j=0; $j<$queens; $j++){
		$currentArray[$i][$j] = 0;
	}
}

$GLOBALS['solutions'] = 0;

function checkPositionPossibility($row, $column, $currentArray, $queens){
	//check rows and columns
	for ($i=0; $i < ($queens-1); $i++){
		if ($currentArray[$row][$i] == 1){
			return 0;
		}
		if ($currentArray[$i][$column] == 1){
			return 0;
		}
	}
	
	//checking diagonals 
	for ($i=0; $i<$queens; $i++){
		for ($j=0; $j<$queens; $j++){
			if ($currentArray[$i][$j] == 1){
				if (((abs($row-$i))/(abs($column-$j))) == 1){
					return 0;
				}
			}
		}
	}
	
	return 1;
}

function find_previous_column($row){
	return array_search('1', $row);
}



function recursion($m, $n, $currentArray, $queens){
 	for ($i=$m; $i<$queens; $i++){
 		for ($j=$n; $j<$queens; $j++){
 			if(($i>0) && false === find_previous_column($currentArray[$i-1])){
 				return;
 			}
			if(checkPositionPossibility($i, $j, $currentArray, $queens) == 1){
				if ($i == ($queens-1)){ // we found another solution
					$GLOBALS['solutions']++;
					return;
				}
				
				recursion($i, $j+1, $currentArray, $queens);
				$currentArray[$i][$j] = 1;
				recursion($i+1, 0, $currentArray, $queens);
 				return;
			}
 		}
 	}
}

recursion (0, 0, $currentArray, $queens);
echo "possibilities for ".$queens." queens: ".$GLOBALS['solutions'];

?>

