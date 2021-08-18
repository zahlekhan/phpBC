 <?php
function flatten(array $multiDimArray): array {
  $res = [];
  foreach($multiDimArray as $row){
    if (is_array($row))
    {
      $nested = flatten($row);
      $res = array_merge($res,$nested);
    } else 
    {
      array_push($res,$row);
    }
  }
  return $res;
}

$test = [2, 3, [4,5], [6,7], 8];
print_r(flatten($test));
?>
