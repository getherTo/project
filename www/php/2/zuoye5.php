<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/22
 * Time: 18:59
 */
header("Content-type:text/html;charset=utf-8");
$team = ['丁骁', '黄舟', '时伟伟', '李建华', '樊瑞', '吴波', '卢阳', '刘青山',
    '李路华', '吴勇', '高彦隆', '邵刚', '帅师', '宣浩', '许兵', '吴灿', '李小平',
    '张彪', '窦和平', '肖飞', '王鲍', '蒋亚昆', '陈浩', '冯阳', '李亚回', '董亚南',
    '储进朝', '吴延祥', '周鹏飞', '邓科', '张磊', '姜磊', '梁竟萧', '缪全龙', '刘丹',
    '符亲冉', '李松', '刘波', '吴振杨', '杨征', '方波', '张钱隆', '徐治达', '张灿灿', '陈子文', '卜文俊'];
/*foreach($team as $team1){
    echo $team1;
    echo "&nbsp;";
}*/
if ($_GET['check']!=null){
if (in_array($_GET['check'],$team)){
    echo "存在";
} else{
    echo "不存在请重新输入";
}
}
?>
<form>
    <input type="text" name="check">
    <input type="submit" value="提交">
</form>