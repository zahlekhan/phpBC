<?php
function maskPhone(string $phone): string {
  return substr($phone,0,2).str_repeat("*",strlen($phone)-4).substr($phone,-2);
}

$test = "1234567890";
print(maskPhone($test));
print("test");
?>
