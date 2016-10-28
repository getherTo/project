<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/22
 * Time: 18:31
 */
header("Content-type:text/html;charset=utf-8");
$team = ['丁骁', '黄舟', '时伟伟', '李建华', '樊瑞', '吴波', '卢阳', '刘青山',
    '李路华', '吴勇', '高彦隆', '邵刚', '帅师', '宣浩', '许兵', '吴灿', '李小平',
    '张彪', '窦和平', '肖飞', '王鲍', '蒋亚昆', '陈浩', '冯阳', '李亚回', '董亚南',
    '储进朝', '吴延祥', '周鹏飞', '邓科', '张磊', '姜磊', '梁竟萧', '缪全龙', '刘丹',
    '符亲冉', '李松', '刘波', '吴振杨', '杨征', '方波', '张钱隆', '徐治达', '张灿灿', '陈子文', '卜文俊'];
$team1 = array_chunk($team,5);
?>
<table border="1" align="center" width="500">
    <?php
    /* foreach ($team1 as $name) {
         echo "<tr>";
         echo "<td>".$name[0]."</td>";
         echo "<td>".$name[1]."</td>";
         echo "<td>".$name[2]."</td>";
         echo "<td>".$name[3]."</td>";
         echo "<td>".$name[4]."</td>";
         echo "</tr>";
    }*/?>
  <?php
foreach ($team1 as $name) {
    echo "<tr>";
        foreach($name as $name1){
            echo "<td>".$name1."</td>";

        } echo "</tr>";
}
?>
</table>



