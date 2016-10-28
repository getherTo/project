<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/24
 * Time: 11:17
 */
header("Content-type:text/html;charset=utf-8");
 $a = "1 2 3 4 5 6 7 8 9";
 $b = explode(" ",$a);
print_r($b) ;
echo "<hr>";
 $arr = ['1','2','3','4','5','6','7','8','9'];
 $arr1 = implode(" ",$arr);
echo $arr1;
echo "<hr>";
$names = ['丁骁', '黄舟', '时伟伟', '李建华', '樊瑞', '吴延祥', '周鹏飞', '邓科',
    '卢阳', '刘青山', '李路华', '吴勇', '高彦隆', '邵刚', '帅师', '宣浩',
    '吴波', '许兵', '吴灿', '李小平', '张彪', '窦和平', '肖飞', '王鲍',
    '蒋亚昆', '陈浩', '冯阳', '李亚回', '董亚南', '储进朝',
    '姜磊', '梁竟萧', '缪全龙', '刘丹', '符亲冉', '李松', '刘波', '吴振杨',
    '张磊', '杨征', '方波', '张钱隆', '徐治达', '张灿灿', '陈子文', '卜文俊'];
echo "<table border='1'>";
echo "<tr>";
foreach ($names as $val){
    echo "<td>".mb_substr($val,0,1,'utf-8')."</td>";
}
echo "</tr>";
echo "<tr>";
foreach($names as $val1){
    echo "<td>".mb_substr($val1,1,2,'UTF-8')."</td>";
}
echo "</tr>";
$arr =[];
foreach ($names as $val){
    $s =mb_substr($val,0,1,'utf-8');
    if ($arr[$s]){
        ($arr[$s]++);
    }else{
        ($arr[$s]=1);
    }
}
//print_r($arr);
echo"<tr>";
foreach($arr as $key1=>$val2){
    echo "<td>".$val2."</td>";
}
echo"</tr>";
echo "</table>";
