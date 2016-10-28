<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
echo "<hr>";
for ($i = 1; $i<=100;$i++){
    if ($i % 2 == 0){
        echo $i."&nbsp;";
    };
};
echo "<br>";
echo "<hr>";
for ($i = 1; $i<=100;$i++){
    if ($i % 2 == 1){
        echo $i."&nbsp;";
    };
};
echo "<hr>";
?>
<table border="1" align="center" cellpadding="1" cellspacing="0" width="600">
    <?php
    for($v=1;$v<=9;$v++){
        echo "<tr>";
        for($x=1;$x<=$v;$x++){
            echo "<td>$v*$x=".$v*$x."</td>";
        }
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>