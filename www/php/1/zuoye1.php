<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
header("Content-type:text/html;charset=utf-8");
$team1 = array("rank"=>1,"name"=>"山东鲁能","round"=>11,"spf"=>"7/1/3","goal"=>11,"score"=>22);
$team2 = array("rank"=>2,"name"=>"广州恒大","round"=>11,"spf"=>"7/1/3","goal"=>15,"score"=>22);
$team3 = array("rank"=>3,"name"=>"上海上港","round"=>11,"spf"=>"7/1/3","goal"=>11,"score"=>22);
$team4 = array("rank"=>4,"name"=>"北京国安","round"=>11,"spf"=>"7/1/3","goal"=>8,"score"=>17);
$team5 = array("rank"=>5,"name"=>"广州富力","round"=>11,"spf"=>"7/1/3","goal"=>3,"score"=>16);
$team6 = array("rank"=>6,"name"=>"江苏舜天","round"=>11,"spf"=>"7/1/3","goal"=>-1,"score"=>15);
$team7 = array("rank"=>7,"name"=>"石家庄永昌","round"=>11,"spf"=>"7/1/3","goal"=>1,"score"=>14);
$team8 = array("rank"=>8,"name"=>"上海申花","round"=>11,"spf"=>"7/1/3","goal"=>-5,"score"=>14);
$team9 = array("rank"=>9,"name"=>"辽宁宏远","round"=>10,"spf"=>"7/1/3","goal"=>-5,"score"=>12);
$team10 = array("rank"=>10,"name"=>"河南建业","round"=>10,"spf"=>"7/1/3","goal"=>-2,"score"=>12);
$top10 = [$team1,$team2,$team3,$team4,$team5,$team6,$team7,$team8,$team9,$team10];
?>
<table style="text-align: center" align="center" border="1" width="700">
<tr>
    <tr>
        <td>排名</td>
        <td>球队</td>
        <td>场次</td>
        <td>胜/负/平</td>
        <td>净胜球</td>
        <td>积分</td>
    </tr>
    <?php foreach ($top10 as $i){
    echo "<tr>";
        foreach ($i as $s=>$w){
          echo "<td>".$w."</td>"  ;
        };
        echo "</tr>";
    };

    ?>
</table>
</body>
</html>

