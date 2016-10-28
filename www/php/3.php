<?php
header("Content-type:text/html;charset=utf-8");
$title="中国女明星";
$Name="林心如";
$pic="../html/imgs/1.jpg";

echo "<h1>$title</h1>";
echo "<h2>$Name</h2>";
echo "照片:<img src='$pic' width='300'>";


$foo=3;
$bar=$foo;
echo "$foo";

$foo=3;
$bar=&$foo;
$bar=5;
echo "$foo";
?>