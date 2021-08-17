<?php
function foo(string $req) {
  $body = json_decode($req, true);
  $names = [];
  $ages = [];
  $cities = [];
  //print_r($body);
  foreach($body["players"] as $player){
    array_push($names,$player['name']);
    array_push($ages,$player['age']);
    array_push($cities,$player['address']['city']);
  }
  print("TASK 1: Get all names , age, city into arrays each");
  echo '<br/>';
  print_r($names);
  echo '<br/>';
  print_r($ages);
  echo '<br/>';
  print_r($cities);
  echo '<br/>';
  echo '<br/>';

  print("TASK 2:Get all unique names from the stringify JSON");
  echo '<br/>';
  $uniqNames = array_unique($names);
  print_r($uniqNames);
  echo '<br/>';
  echo '<br/>';

  print("TASK 3:Get the name of Persons with max age\n");
  echo '<br/>';
  $maxAge = max($ages);
  $oldestPlayers = [];
  foreach($ages as $idx=>$age){
    if ($age == $maxAge){
      array_push($oldestPlayers,$names[$idx]);
    }
  }
  print_r($oldestPlayers);
}

$test = "{\"players\":[{\"name\":\"Ganguly\",\"age\":45,\"address\":{\"city\":\"Hyderabad\"}},{\"name\":\"Dravid\",\"age\":45,\"address\":{\"city\":\"Hyderabad\"}},{\"name\":\"Dhoni\",\"Age\":37,\"address\":{\"city\":\"Hyderabad\"}},{\"name\":\"Virat\",\"age\":35,\"address\":{\"city\":\"Hyderabad\"}},{\"name\":\"Jadeja\",\"age\":35,\"address\":{\"city\":\"Hyderabad\"}},{\"name\":\"Jadeja\",\"age\":35,\"address\":{\"city\":\"Hyderabad\"}}]}";
foo($test);
?>
