<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
header("Content-type:text/html;charset=UTF-8");
$country1 = ['rank'=>1,'name'=>"美国",'gold'=>28, 'silver'=>28, 'bronze'=>28, 'amount'=>84];
$country2 = ['rank'=>1,'name'=>"英国",'gold'=>19, 'silver'=>19, 'bronze'=>12, 'amount'=>50];
$country3 = ['rank'=>1,'name'=>"中国",'gold'=>17, 'silver'=>15, 'bronze'=>19, 'amount'=>51];
$top10 = [$country1,$country2,$country3];
print_r($top10);
?>
<table style="text-align: center" align="center" border="1" width="700">
    <tr>
        <td>排名</td>
        <td>国家/地区</td>
        <td>金牌</td>
        <td>银牌</td>
        <td>铜牌</td>
        <td>总数</td>
    </tr>
    <tr>
        <td><?php echo $country1["rank"]?></td>
        <td><img src="USA.jpg"><?php echo $country1["name"]?></td>
        <td><?php echo $country1["gold"]?></td>
        <td><?php echo $country1["silver"]?></td>
        <td><?php echo $country1["bronze"]?></td>
        <td><?php echo $country1["amount"]?></td>
    </tr>
    <tr>
        <td><?php echo $country2["rank"]?></td>
        <td><img src="GBR.jpg"><?php echo $country2["name"]?></td>
        <td><?php echo $country2["gold"]?></td>
        <td><?php echo $country2["silver"]?></td>
        <td><?php echo $country2["bronze"]?></td>
        <td><?php echo $country2["amount"]?></td>
    </tr>
    <tr>
        <td><?php echo $country3["rank"]?></td>
        <td><img src="CHN.jpg"><?php echo $country3["name"]?></td>
        <td><?php echo $country3["gold"]?></td>
        <td><?php echo $country3["silver"]?></td>
        <td><?php echo $country3["bronze"]?></td>
        <td><?php echo $country3["amount"]?></td>
    </tr>
</table>
</body>
</html>

