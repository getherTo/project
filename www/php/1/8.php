<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<style>
    .red, .red a  {
        color: red;
    }

    .orange, .orange a {
        color: orange;
    }

    .yellow, .yellow a {
        color: #ffff00;
    }

    .green, .green a {
        color: green;
    }

    .blue, .blue a {
        color: blue;
    }

    .indigo, .indigo a {
        color: indigo;
    }

    .purple, .purple a {
        color: purple;
    }
</style>
<?php
header("content-type:textml;charset=utf-8");
$colors = ['red' => '红色', 'orange' => '橙色', 'yellow' => '黄色',
    'green' => '绿色', 'blue' => '蓝色', 'indigo' => '靛色', 'purple' => '
紫色'];
echo "<table border='1px' width='600px' align='center'>";
echo "<caption>七彩色</caption>";
echo "<tr>";
echo "<th>中文</th>";
echo "<th>英文</th>";
echo "</tr>";
foreach ($colors as $key => $color) {
    echo "<tr class='$key'>";
    echo "<td><a href='?color = $key'>$color</a></td>";
    echo "<td>$key</td>";
    echo "</tr>";
}
echo "</table>";
if (count($_GET) > 0) {
    if ($_GET['color'] == '红色') {
        $class = 'red';
    } else if ($_GET['color'] == '橙色') {
        $class = 'orange';
    } else if ($_GET['color'] == '黄色') {
        $class = 'yellow';
    } else if ($_GET['color'] == '绿色') {
        $class = 'green';
    } else if ($_GET['color'] == '蓝色') {
        $class = 'blue';
    } else if ($_GET['color'] == '靛色') {
        $class = 'indigo';
    } else if ($_GET['color'] == '紫色') {
        $class = 'purple';
    }
    echo "您点击的颜色是：<span class='$class'>" . $_GET['color'] .
        "</span>";
}
$red = [['name' => '梅花', 'img' => 'meihua.jpg'], ['name' => '山茶
花', 'img' => 'shanchahua.jpg'], ['name' => '虎刺梅', 'img' =>
    'hucimei.jpg']];
$orange = [['name' => '鹤望兰', 'img' => 'hewanglan.jpg'], ['name' =>
    '石榴花', 'img' => 'shiliuhua.jpg'], ['name' => '月季', 'img' =>
    'yueji.jpg']];
$yellow = [['name' => '桂花', 'img' => 'guihua.jpg'], ['name' => '菊花
', 'img' => 'juhua.jpg'], ['name' => '腊梅', 'img' => 'lamei.jpg']];
$green = [['name' => '贝壳花', 'img' => 'beikehua.jpg'], ['name' => '
春兰', 'img' => 'chunlan.jpg'], ['name' => '芙蓉菊', 'img' =>
    'furongju.jpg']];
$blue = [['name' => '桔梗', 'img' => 'jiegeng.jpg'], ['name' => '曼陀
罗', 'img' => 'mantuoluo.jpg'], ['name' => '香水草', 'img' =>
    'xiangshuicao.jpg']];
$indigo = [['name' => '灰莉', 'img' => 'huili.jpg'], ['name' => '石仙
桃', 'img' => 'shixiantao.jpg'], ['name' => '银合欢', 'img' =>
    'yinhehuan.jpg']];
$purple = [['name' => '薰衣草', 'img' => 'xunyicao.jpg'], ['name' => '
风信子', 'img' => 'fengxinzi.jpg'], ['name' => '紫薇', 'img' =>
    'ziwei.jpg']];
$flowers = ['red' => $red, 'orange' => $orange, 'yellow' => $yellow,
    'green' => $green, 'blue' => $blue, 'indigo' => $indigo, 'purple]' =>
        $purple];

if (count($_GET) > 0) {
    $show_color = $_GET['color'];
    $show_flower = $flowers[$show_color];
    echo "<table border='1px'>";
    foreach ($show_flower as $flower) {
        echo "<tr>";
        echo "<td>" . $flower['name'] . "</td>";
        echo "<td><img src='xin/{$flower['img']}'></td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
</body>
</html>
