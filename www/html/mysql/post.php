<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Post练习</title>
</head>
<body>


<?php

// 获取$_POST变量
if( count($_POST) > 0 ){  // 检查是否有post提交

    // 打印所有post变量  调试语句
    // print_r($_POST);

    // 说明
    // 表名 为 test
    // 字段为  id， name, mobile, gender, introduction
    if($_POST['opt'] == "add"){
      // insert into 表名 (字段1， 字段2) values( 值1， 值2)；
        $sql = "insert into test ( id, name, mobile, gender, introduction )
                          values ( {$_POST['id']},'{$_POST['name']}','{$_POST['mobile']}','{$_POST['gender']}','{$_POST['introduction']}'  )
                 ";

    } else if ($_POST['opt'] == "delete"){
        // delete from 表名 where 条件
        $sql = "delete from test where id = {$_POST['id']}";
        $sql2 = "delete from test where name = '{$_POST['name']}'";
        $sql3 = "delete from test where mobile = '{$_POST['mobile']}'";
    }else if ($_POST['opt'] == "update"){
       // update 表名 set 字段1 = 值1， 字段2 = 值2 where 条件
        $sql = "update test set name = '{$_POST['name']}',
                                mobile = '{$_POST['mobile']}',
                                gender = '{$_POST['gender']}',
                                introduction = '{$_POST['introduction']}'
                            where id =   {$_POST['id']}";
    }else if ($_POST['opt'] == "select"){
        // select * from 表名 where  条件
        $sql = "select * from test where id = {$_POST['id']} ";
        $sql2 = "select * from test where name like '%{$_POST['name']}%'";
        $sql3 = "select * from test where sex = '{$_POST['gender']}' ";
    }

    echo $sql ;
    if( isset($sql2)){
        echo "<br>" . $sql2 ;
    }
    if( isset($sql3)){
        echo "<br>" . $sql3 ;
    }
}

?>

<form method="post" action="" name="form1">
    <table>
        <tr>
            <td colspan="2"><h1>POST练习</h1></td>
        </tr>
        <tr>
            <td><strong>操作:</strong></td>
            <td>
                <select name="opt">
                    <option value="0">-请选择-</option>
                    <option value="add" <?=($_POST['opt']=='add')?"selected":""?>>-增-</option>
                    <option value="delete" <?=($_POST['opt']=='delete')?"selected":""?>>-删-</option>
                    <option value="update" <?=($_POST['opt']=='update')?"selected":""?>>-改-</option>
                    <option value="select" <?=($_POST['opt']=='select')?"selected":""?>>-查-</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><strong>id:</strong></td>
            <td><input type="text" name="id" required placeholder="请输入id" style="width: 150px" /></td>
        </tr>
        <tr>
            <td><strong>姓名:</strong></td>
            <td><input type="text" name="name" required placeholder="请输入姓名" style="width: 150px" /></td>
        </tr>
        <tr>
            <td><strong>手机:</strong></td>
            <td><input type="text" name="mobile" required placeholder="请输入姓名" style="width: 150px" /></td>
        </tr>
        <tr>
            <td><strong>性别:</strong></td>
            <td>
                <label><input type="radio" name="gender" value="male">男</label>
                <label><input type="radio" name="gender" value="female">女</label>
            </td>
        </tr>
        <tr>
            <td><strong>简介:</strong></td>
            <td><textarea name="introduction" style="width: 200px; height: 150px"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="提交"> <input type="reset" value="重置"></td>
        </tr>
    </table>
</form>


</body>
</html>