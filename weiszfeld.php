<?php 
function addArray($arr1, $arr2) {
  // adds the values at identical keys together
  foreach (array_intersect_key($arr2, $arr1) as $key => $val) $arr1[$key] += $val;
  $arr1 += $arr2; 
  return $arr1; 
}

function subtractArray($arr1, $arr2) {  
  // subtract an array from another array
  foreach($arr1 as $key => &$val){
    if(isset($arr2[$key])){
      $val -= $arr2[$key];
    }
  }
  return $arr1;
}

function vectorNorm($array){
  $squareSum = 0;
  foreach($array as $value){
    $squareSum += pow($value,2);
  }
  $norm = sqrt($squareSum);
  return $norm;
}

function multiplyArray($arr, $scalar){
  return array_map( 
    function($val, $factor) { return $val * $factor; }, 
    $arr,
    array_fill(0, count($arr), $scalar)
  );
}

function divideArray($arr, $scalar){
  return array_map( 
    function($val, $factor) { return $val / $factor; }, 
    $arr,
    array_fill(0, count($arr), $scalar)
  );
}

function weiszfeld($dataArray,$previousEstimate){
  $numerator = [0];
  $denominator = 0;
  $keys = array_keys($dataArray[0]);
  foreach ($dataArray as $dataPoint) {
    $numerator = addArray($numerator, divideArray($dataPoint,vectorNorm(subtractArray($dataPoint,$previousEstimate))));
  }

  foreach ($dataArray as $dataPoint) {
    $denominator = $denominator + 1/(vectorNorm(subtractArray($dataPoint,$previousEstimate)));
  }

  $median = divideArray($numerator,$denominator);

  $median = array_combine($keys,$median);
  return $median;
}

function getMedian($dataArray,$iterations,$decimalPlaces){
  /*
  Serves as a wrapper for weiszfeld() allowing for arbitrary number of iterations 
  & returns value to arbitrary number of decimal places
  */

  $median = weiszfeld($dataArray,[0,0,0,0,0,0]);
  for($i=0;$i<$iterations;$i++){
    $median = weiszfeld($dataArray,$median);
  }
  return $median; 
}
?>