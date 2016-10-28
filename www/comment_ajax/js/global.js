$(function () {

    // 输入框绑定键盘弹起事件
    $('#saytxt').bind("keyup", function () {
        recount(); // 计算字符数
    });

    $("#myform").submit( function () {
        var saytxt = $("#saytxt").val(); // 输入框的值
        if (saytxt == "") { // 输入的内容为空
            $("#msg").show().html("请输入内容.").fadeOut(4000);  // 显示提示信息，并在4秒内消失
            return false;
        }

        // 显示提示信息，正在处理
        $('.counter').html('<img style="padding:8px 12px" src="images/load.gif" alt="正在处理..." />');

        $.ajax({
            type: "POST", // 使用post提交数据
            url: "submit.php",  // 提交到后台的php文件
            data: {saytxt: saytxt, user_name: $("#user_name").val()}, // 数据
            success: function ( html ) {
                if ( html ) {
                    $('#saywrap').prepend(html); // 追加到元素的最前面
                    $('#saytxt').val('');  // 清空输入框
                    $('#user_name').val('');  // 清空输入框
                    recount(); // 重新计算文字个数
                    $("#msg").show().html("您的说说发布成功.").fadeOut(6000);
                    $("#no_record").remove();
                }
            }
        });
        return false;
    });
});

function recount() {
    var maxlen = 140;
    var current = maxlen - $('#saytxt').val().length;
    $('.counter').html(current);
    if (current < 1 || current > maxlen) {
        $('.counter').css('color', '#D40D12');
        $('input.sub_btn').attr('disabled', 'disabled');
        $('.counter').html(0);
        $("#msg").show();
        $("#msg").html("您发布的内容有误！.");
        $("#msg").fadeOut(5000);
    }
    else{
        $('input.sub_btn').removeAttr('disabled');
    }
    if (current < 10){
        $('.counter').css('color', '#D40D12');
    } else {
        $('.counter').css('color', '#cccccc');
    }

};