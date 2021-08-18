    <?php
function snakeToCamel(array $literals): array {
  $res = [];
  foreach($literals as $literal) {
    $words = explode("_",$literal);
    $str = $words[0];
    foreach($words as $idx => $word){
      if ($idx == 0) continue;
      $str = $str . ucfirst($word);
    }
    array_push($res,$str);
  }
  return $res;
}

$test = ["snake_case", "camel_case"];
print_r(snakeToCamel($test));
?>
