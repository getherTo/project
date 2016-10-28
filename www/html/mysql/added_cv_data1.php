<?php

/*
批量生成一批简历数据
要求：
name 随机
sex   性别 男 女 （根据名字来定）
city  城市 ( 随机 合肥， 芜湖， 阜阳，六安， 安庆， 亳州，马鞍山，淮南 ...)
height 身高 ( 男： 1.5 - 2.0   女： 1.3 - 1.9  )
weight 体重 （男： 40-150   女 30-120）
birthday 出生日期 （1950 - 2000）
mobile    手机 （11位， 13 15 17 18 ）
created_at  创建时间 （ 随机一个时间  ）


赵 钱 孙 李 周 吴 郑 王

冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞

熊 纪 舒 屈 项 祝 董 梁

杜 阮 蓝 闽 席 季 麻 强

贾 路 娄 危 江 童 颜 郭

梅 盛 林 刁 锺 徐 丘 骆

高 夏 蔡 田 樊 胡 凌 霍

虞 万 支 柯 昝 管 卢 莫

经 房 裘 缪 干 解 应 宗

丁 宣 贲 邓 郁 单 杭 洪

包 诸 左 石 崔 吉 钮 龚

程 嵇 邢 滑 裴 陆 荣 翁

荀 羊 於 惠 甄 麹 家 封

芮 羿 储 靳 汲 邴 糜 松

井 段 富 巫 乌 焦 巴 弓

牧 隗 山 谷 车 侯 宓 蓬

全 郗 班 仰 秋 仲 伊 宫

宁 仇 栾 暴 甘 斜 厉 戎

祖 武 符 刘 景 詹 束 龙

叶 幸 司 韶 郜 黎 蓟 薄

印 宿 白 怀 蒲 邰 从 鄂

索 咸 籍 赖 卓 蔺 屠 蒙

池 乔 阴 郁 胥 能 苍 双

闻 莘 党 翟 谭 贡 劳 逄

姬 申 扶 堵 冉 宰 郦 雍

郤 璩 桑 桂 濮 牛 寿 通

边 扈 燕 冀 郏 浦 尚 农

温 别 庄 晏 柴 瞿 阎 充

慕 连 茹 习 宦 艾 鱼 容

向 古 易 慎 戈 廖 庾 终

暨 居 衡 步 都 耿 满 弘

匡 国 文 寇 广 禄 阙 东

欧 殳 沃 利 蔚 越 夔 隆

师 巩 厍 聂 晁 勾 敖 融

冷 訾 辛 阚 那 简 饶 空

曾 毋 沙 乜 养 鞠 须 丰

巢 关 蒯 相 查 后 荆 红

游 竺 权 逑 盖 益 桓 公

万俟 司马 上官 欧阳

夏侯 诸葛 闻人 东方

赫连 皇甫 尉迟 公羊

澹台 公冶 宗政 濮阳

淳于 单于 太叔 申屠

公孙 仲孙 轩辕 令狐

锺离 宇文 长孙 慕容

鲜于 闾丘 司徒 司空

丌官 司寇 仉 督 子车

颛孙 端木 巫马 公西

漆雕 乐正 壤驷 公良

拓拔 夹谷 宰父 谷梁

晋 楚 阎 法 汝 鄢 涂 钦

段干 百里 东郭 南门

呼延 归 海 羊舌 微生

岳 帅 缑 亢 况 后 有 琴

梁丘 左丘 东门 西门

商 牟 佘 佴 伯 赏 南宫

墨 哈 谯 笪 年 爱 阳 佟

第五 言 福

 */


$str_first_name = '赵 钱 孙 李 周 吴 郑 王

冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞

冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞

冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞

冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞

冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞


冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞

冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞
冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞
冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞
冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞
冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞
冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞
冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞
冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞
冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞
冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞
冯 陈 楮 卫 蒋 沈 韩 杨

朱 秦 尤 许 何 吕 施 张

孔 曹 严 华 金 魏 陶 姜

戚 谢 邹 喻 柏 水 窦 章

云 苏 潘 葛 奚 范 彭 郎

鲁 韦 昌 马 苗 凤 花 方

俞 任 袁 柳 酆 鲍 史 唐

费 廉 岑 薛 雷 贺 倪 汤

滕 殷 罗 毕 郝 邬 安 常

乐 于 时 傅 皮 卞 齐 康

伍 余 元 卜 顾 孟 平 黄

和 穆 萧 尹 姚 邵 湛 汪

祁 毛 禹 狄 米 贝 明 臧

计 伏 成 戴 谈 宋 茅 庞

熊 纪 舒 屈 项 祝 董 梁

杜 阮 蓝 闽 席 季 麻 强

贾 路 娄 危 江 童 颜 郭

梅 盛 林 刁 锺 徐 丘 骆

高 夏 蔡 田 樊 胡 凌 霍

虞 万 支 柯 昝 管 卢 莫

经 房 裘 缪 干 解 应 宗

丁 宣 贲 邓 郁 单 杭 洪

包 诸 左 石 崔 吉 钮 龚

程 嵇 邢 滑 裴 陆 荣 翁

荀 羊 於 惠 甄 麹 家 封

芮 羿 储 靳 汲 邴 糜 松

井 段 富 巫 乌 焦 巴 弓

牧 隗 山 谷 车 侯 宓 蓬

全 郗 班 仰 秋 仲 伊 宫

宁 仇 栾 暴 甘 斜 厉 戎

祖 武 符 刘 景 詹 束 龙

叶 幸 司 韶 郜 黎 蓟 薄

印 宿 白 怀 蒲 邰 从 鄂

索 咸 籍 赖 卓 蔺 屠 蒙

池 乔 阴 郁 胥 能 苍 双

闻 莘 党 翟 谭 贡 劳 逄

姬 申 扶 堵 冉 宰 郦 雍

郤 璩 桑 桂 濮 牛 寿 通

边 扈 燕 冀 郏 浦 尚 农

温 别 庄 晏 柴 瞿 阎 充

慕 连 茹 习 宦 艾 鱼 容

向 古 易 慎 戈 廖 庾 终

暨 居 衡 步 都 耿 满 弘

匡 国 文 寇 广 禄 阙 东

欧 殳 沃 利 蔚 越 夔 隆

师 巩 厍 聂 晁 勾 敖 融

冷 訾 辛 阚 那 简 饶 空

曾 毋 沙 乜 养 鞠 须 丰

巢 关 蒯 相 查 后 荆 红

游 竺 权 逑 盖 益 桓 公

万俟 司马 上官 欧阳

夏侯 诸葛 闻人 东方

赫连 皇甫 尉迟 公羊

澹台 公冶 宗政 濮阳

淳于 单于 太叔 申屠

公孙 仲孙 轩辕 令狐

锺离 宇文 长孙 慕容

鲜于 闾丘 司徒 司空

丌官 司寇 仉 督 子车

颛孙 端木 巫马 公西

漆雕 乐正 壤驷 公良

拓拔 夹谷 宰父 谷梁

晋 楚 阎 法 汝 鄢 涂 钦

段干 百里 东郭 南门

呼延 归 海 羊舌 微生

岳 帅 缑 亢 况 后 有 琴

梁丘 左丘 东门 西门

商 牟 佘 佴 伯 赏 南宫

墨 哈 谯 笪 年 爱 阳 佟

第五 言 福';


header("Content-type: text/html; charset=utf-8");


$arr1 = explode("\r\n", $str_first_name);
$arr_first_name = array(); // 存姓
foreach( $arr1 as $val ){
    if( $val == "" ) continue;
    $arr2 = explode(" ", $val);
    if( count($arr2)>0){
       foreach( $arr2 as $val2 ){
           $arr_first_name[] =  $val2;
       }
    }
}


$str_names = '嘉懿 煜城 懿轩 烨伟 苑博 伟泽 熠彤

鸿煊 博涛 烨霖 烨华 煜祺 智宸 正豪

昊然 明杰 立诚 立轩 立辉 峻熙 弘文

熠彤 鸿煊 烨霖 哲瀚 鑫鹏 致远 俊驰

雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛

雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛


雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛


雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛

雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛

雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛

雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛

雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛

雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛

雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛

雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛
雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛
雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛
雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛
雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛
雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛
雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛
雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛
雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛
雨泽 烨磊 晟睿 天佑 文昊 修洁 黎昕

远航 旭尧 鸿涛 伟祺 荣轩 越泽 浩宇

瑾瑜 皓轩 擎苍 擎宇 志泽 睿渊 楷瑞

子轩 弘文 哲瀚 雨泽 鑫磊 修杰 伟诚

建辉 晋鹏 天磊 绍辉 泽洋 明轩 健柏

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛

鹏煊 昊强 伟宸 博超 君浩 子骞 明辉

鹏涛 炎彬 鹤轩 越彬 风华 靖琪 明诚

高格 光华 国源 冠宇 晗昱 涵润 翰飞

翰海 昊乾 浩博 和安 弘博 宏恺 鸿朗

华奥 华灿 嘉慕 坚秉 建明 金鑫 锦程

瑾瑜 晋鹏 经赋 景同 靖琪 君昊 俊明

仁 義 禮 智 信 勇 忠 孝 溫 良 恭 謙 誠

偉 剛 勇 毅 俊 峰 強 軍 平 保 東 文 輝 力 明 永 

健 世 廣 志 義 興 良 海 山 仁 波 寧 貴 福 生 龍 元 

全 國 勝 學 祥 才 發 武 新 利 清 飛 彬 富 順 信 子 

傑 濤 昌 成 康 星 光 天 達 安 岩 中 茂 進 林 有 堅 

和 彪 博 誠 先 敬 震 振 壯 會 思 群 豪 心 邦 承 樂 

紹 功 松 善 厚 慶 磊 民 友 裕 河 哲 江 超 浩 亮 政 

謙 亨 奇 固 之 輪 翰 朗 伯 宏 言 若 鳴 朋 斌 梁 棟 

維 啟 克 倫 翔 旭 鵬 澤 晨 辰 士 以 建 家 致 樹 炎 

德 行 時 泰 盛 雄 琛 鈞 冠 策 騰 楠 榕 風 航 弘

季同 开济 凯安 康成 乐语 力勤 良哲

理群 茂彦 敏博 明达 朋义 彭泽 鹏举

濮存 溥心 璞瑜 浦泽 奇邃 祺祥 荣轩

锐达 睿慈 绍祺 圣杰 晟睿 思源 斯年

泰宁 天佑 同巍 奕伟 祺温 文虹 向笛

心远 欣德 新翰 兴言 星阑 修为 旭尧

炫明 学真 雪风 雅昶 阳曦 烨熠 英韶

永贞 咏德 宇寰 雨泽 玉韵 越彬 蕴和

哲彦 振海 正志 子晋 自怡 德赫 君平

帅 英 硕 威 清 直 铿 强 刚 钢 坚 巍 勇 猛 谦 仁

凯文  博涵  泰哲  誉胜  智宸  一鸣  志明  学礼  永胜  恩泽  有成  安邦  自光
智   睿   知   聪   荣   志   立   耀   勋   卓   友   建   功   彰   达
树   林   柏   帆   山   河   岩   川   风   雨   天   景   森   淼   炎   焱   磊   霄   旷   广   宏
顺   和   康   富   福   贵   正   新   贺   益   鑫   祥   利   升   兴
';

$arr1 = explode("\r\n", $str_names);
$arr_male_name = array(); // 男性名字
foreach ( $arr1 as $val ){
    if($val == "") continue;
    $arr2 = explode(" ", $val);
    foreach($arr2 as $val2 ){
        if($val2 == "" ) continue;
        $arr_male_name[] = $val2;
    }
}

$num = 500;

$first_name_index = array_rand($arr_first_name,$num);


$last_name_index = array_rand($arr_male_name,$num);

$arr_male_full_name = array(); // 男性名字
for( $i=0;$i<$num;$i++){
    $arr_male_full_name[] = $arr_first_name[$first_name_index[$i]] . $arr_male_name[$last_name_index[$i]];
}



$str_female = '秀 娟 英 华 慧 巧 美 娜 静 淑 惠 珠 翠 雅 芝 玉 萍 红 娥 玲 

芬 芳 燕 彩 春 菊 兰 凤 洁 梅 琳 素 云 莲 真 环 雪 荣 爱 妹 

霞 香 月 莺 媛 艳 瑞 凡 佳 嘉 琼 勤 珍 贞 莉 桂 娣 叶 璧 璐 

娅 琦 晶 妍 茜 秋 珊 莎 锦 黛 青 倩 婷 姣 婉 娴 瑾 颖 露 瑶 

怡 婵 雁 蓓 纨 仪 荷 丹 蓉 眉 君 琴 蕊 薇 菁 梦 岚 苑 婕 馨 

瑗 琰 韵 融 园 艺 咏 卿 聪 澜 纯 毓 悦 昭 冰 爽 琬 茗 羽 希 

宁 欣 飘 育 滢 馥 筠 柔 竹 霭 凝 晓 欢 霄 枫 芸 菲 寒 伊 亚 

宜 可 姬 舒 影 荔 枝 思 丽
筠 柔 竹 霭 凝 晓 欢 霄 枫 芸 菲 寒 伊 亚 宜 可 姬 舒 影 荔 枝 思 丽 秀 娟 英 华 慧 巧 美 娜 静 淑 惠 珠 翠 雅 芝 玉 萍 红 娥 玲 芬 芳 燕 彩 春 菊 勤 珍 贞 莉 兰 凤 洁 梅 琳 素 云 莲 真 环 雪 荣 爱 妹 霞 香 月 莺 媛  艳 瑞 凡 佳 嘉 琼 桂 娣 叶 璧 璐 娅 琦 晶 妍 茜 秋 珊 莎 锦 黛 青 倩 婷 姣 婉 娴 瑾 颖 露 瑶 怡 婵 雁 蓓 纨 仪 荷 丹 蓉 眉 君 琴 蕊 薇 菁 梦 岚  苑 婕 馨 瑗 琰 韵 融 园 艺 咏 卿 聪 澜 纯 毓 悦 昭 冰 爽 琬 茗 羽 希 宁 欣 飘 育 滢 馥
瑾 萱 轩 璇 菀 婉 然 含 涵 洛 沁 露 雪 斐 艺
賢 淑 德 慧 貞 卿 端 莊 靜 秀 雅
秀 娟 英 華 慧 巧 美 娜 靜 淑 惠 珠 翠 雅 芝 玉 

萍 紅 娥 玲 芬 芳 燕 彩 春 菊 蘭 鳳 潔 梅 琳 素 雲 

蓮 真 環 雪 榮 愛 妹 霞 香 月 鶯 媛 豔 瑞 凡 佳 嘉 

瓊 勤 珍 貞 莉 桂 娣 葉 璧 璐 婭 琦 晶 妍 茜 秋 珊 

莎 錦 黛 青 倩 婷 姣 婉 嫻 瑾 穎 露 瑤 怡 嬋 雁 蓓 

紈 儀 荷 丹 蓉 眉 君 琴 蕊 薇 菁 夢 嵐 苑 婕 馨 瑗 

琰 韻 融 園 藝 詠 卿 聰 瀾 純 毓 悅 昭 冰 爽 琬 茗 

羽 希 寧 欣 飄 育 瀅 馥 筠 柔 竹 靄 凝 曉 歡 霄 楓 

芸 菲 寒 伊 亞 宜 可 姬 舒 影 荔 枝 思 麗
宜 可 姬 舒 影 荔 枝 思 丽
筠 柔 竹 霭 凝 晓 欢 霄 枫 芸 菲 寒 伊 亚 宜 可 姬 舒 影 荔 枝 思 丽 秀 娟 英 华 慧 巧 美 娜 静 淑 惠 珠 翠 雅 芝 玉 萍 红 娥 玲 芬 芳 燕 彩 春 菊 勤 珍 贞 莉 兰 凤 洁 梅 琳 素 云 莲 真 环 雪 荣 爱 妹 霞 香 月 莺 媛  艳 瑞 凡 佳 嘉 琼 桂 娣 叶 璧 璐 娅 琦 晶 妍 茜 秋 珊 莎 锦 黛 青 倩 婷 姣 婉 娴 瑾 颖 露 瑶 怡 婵 雁 蓓 纨 仪 荷 丹 蓉 眉 君 琴 蕊 薇 菁 梦 岚  苑 婕 馨 瑗 琰 韵 融 园 艺 咏 卿 聪 澜 纯 毓 悦 昭 冰 爽 琬 茗 羽 希 宁 欣 飘 育 滢 馥
瑾 萱 轩 璇 菀 婉 然 含 涵 洛 沁 露 雪 斐 艺
賢 淑 德 慧 貞 卿 端 莊 靜 秀 雅
秀 娟 英 華 慧 巧 美 娜 靜 淑 惠 珠 翠 雅 芝 玉

萍 紅 娥 玲 芬 芳 燕 彩 春 菊 蘭 鳳 潔 梅 琳 素 雲

蓮 真 環 雪 榮 愛 妹 霞 香 月 鶯 媛 豔 瑞 凡 佳 嘉

瓊 勤 珍 貞 莉 桂 娣 葉 璧 璐 婭 琦 晶 妍 茜 秋 珊

莎 錦 黛 青 倩 婷 姣 婉 嫻 瑾 穎 露 瑤 怡 嬋 雁 蓓

紈 儀 荷 丹 蓉 眉 君 琴 蕊 薇 菁 夢 嵐 苑 婕 馨 瑗

琰 韻 融 園 藝 詠 卿 聰 瀾 純 毓 悅 昭 冰 爽 琬 茗

羽 希 寧 欣 飄 育 瀅 馥 筠 柔 竹 靄 凝 曉 歡 霄 楓

芸 菲 寒 伊 亞 宜 可 姬 舒 影 荔 枝 思 麗
宜 可 姬 舒 影 荔 枝 思 丽
筠 柔 竹 霭 凝 晓 欢 霄 枫 芸 菲 寒 伊 亚 宜 可 姬 舒 影 荔 枝 思 丽 秀 娟 英 华 慧 巧 美 娜 静 淑 惠 珠 翠 雅 芝 玉 萍 红 娥 玲 芬 芳 燕 彩 春 菊 勤 珍 贞 莉 兰 凤 洁 梅 琳 素 云 莲 真 环 雪 荣 爱 妹 霞 香 月 莺 媛  艳 瑞 凡 佳 嘉 琼 桂 娣 叶 璧 璐 娅 琦 晶 妍 茜 秋 珊 莎 锦 黛 青 倩 婷 姣 婉 娴 瑾 颖 露 瑶 怡 婵 雁 蓓 纨 仪 荷 丹 蓉 眉 君 琴 蕊 薇 菁 梦 岚  苑 婕 馨 瑗 琰 韵 融 园 艺 咏 卿 聪 澜 纯 毓 悦 昭 冰 爽 琬 茗 羽 希 宁 欣 飘 育 滢 馥
瑾 萱 轩 璇 菀 婉 然 含 涵 洛 沁 露 雪 斐 艺
賢 淑 德 慧 貞 卿 端 莊 靜 秀 雅
秀 娟 英 華 慧 巧 美 娜 靜 淑 惠 珠 翠 雅 芝 玉

萍 紅 娥 玲 芬 芳 燕 彩 春 菊 蘭 鳳 潔 梅 琳 素 雲

蓮 真 環 雪 榮 愛 妹 霞 香 月 鶯 媛 豔 瑞 凡 佳 嘉

瓊 勤 珍 貞 莉 桂 娣 葉 璧 璐 婭 琦 晶 妍 茜 秋 珊

莎 錦 黛 青 倩 婷 姣 婉 嫻 瑾 穎 露 瑤 怡 嬋 雁 蓓

紈 儀 荷 丹 蓉 眉 君 琴 蕊 薇 菁 夢 嵐 苑 婕 馨 瑗

琰 韻 融 園 藝 詠 卿 聰 瀾 純 毓 悅 昭 冰 爽 琬 茗

羽 希 寧 欣 飄 育 瀅 馥 筠 柔 竹 靄 凝 曉 歡 霄 楓

芸 菲 寒 伊 亞 宜 可 姬 舒 影 荔 枝 思 麗
宜 可 姬 舒 影 荔 枝 思 丽
筠 柔 竹 霭 凝 晓 欢 霄 枫 芸 菲 寒 伊 亚 宜 可 姬 舒 影 荔 枝 思 丽 秀 娟 英 华 慧 巧 美 娜 静 淑 惠 珠 翠 雅 芝 玉 萍 红 娥 玲 芬 芳 燕 彩 春 菊 勤 珍 贞 莉 兰 凤 洁 梅 琳 素 云 莲 真 环 雪 荣 爱 妹 霞 香 月 莺 媛  艳 瑞 凡 佳 嘉 琼 桂 娣 叶 璧 璐 娅 琦 晶 妍 茜 秋 珊 莎 锦 黛 青 倩 婷 姣 婉 娴 瑾 颖 露 瑶 怡 婵 雁 蓓 纨 仪 荷 丹 蓉 眉 君 琴 蕊 薇 菁 梦 岚  苑 婕 馨 瑗 琰 韵 融 园 艺 咏 卿 聪 澜 纯 毓 悦 昭 冰 爽 琬 茗 羽 希 宁 欣 飘 育 滢 馥
瑾 萱 轩 璇 菀 婉 然 含 涵 洛 沁 露 雪 斐 艺
賢 淑 德 慧 貞 卿 端 莊 靜 秀 雅
秀 娟 英 華 慧 巧 美 娜 靜 淑 惠 珠 翠 雅 芝 玉

萍 紅 娥 玲 芬 芳 燕 彩 春 菊 蘭 鳳 潔 梅 琳 素 雲

蓮 真 環 雪 榮 愛 妹 霞 香 月 鶯 媛 豔 瑞 凡 佳 嘉

瓊 勤 珍 貞 莉 桂 娣 葉 璧 璐 婭 琦 晶 妍 茜 秋 珊

莎 錦 黛 青 倩 婷 姣 婉 嫻 瑾 穎 露 瑤 怡 嬋 雁 蓓

紈 儀 荷 丹 蓉 眉 君 琴 蕊 薇 菁 夢 嵐 苑 婕 馨 瑗

琰 韻 融 園 藝 詠 卿 聰 瀾 純 毓 悅 昭 冰 爽 琬 茗

羽 希 寧 欣 飄 育 瀅 馥 筠 柔 竹 靄 凝 曉 歡 霄 楓

芸 菲 寒 伊 亞 宜 可 姬 舒 影 荔 枝 思 麗
宜 可 姬 舒 影 荔 枝 思 丽
筠 柔 竹 霭 凝 晓 欢 霄 枫 芸 菲 寒 伊 亚 宜 可 姬 舒 影 荔 枝 思 丽 秀 娟 英 华 慧 巧 美 娜 静 淑 惠 珠 翠 雅 芝 玉 萍 红 娥 玲 芬 芳 燕 彩 春 菊 勤 珍 贞 莉 兰 凤 洁 梅 琳 素 云 莲 真 环 雪 荣 爱 妹 霞 香 月 莺 媛  艳 瑞 凡 佳 嘉 琼 桂 娣 叶 璧 璐 娅 琦 晶 妍 茜 秋 珊 莎 锦 黛 青 倩 婷 姣 婉 娴 瑾 颖 露 瑶 怡 婵 雁 蓓 纨 仪 荷 丹 蓉 眉 君 琴 蕊 薇 菁 梦 岚  苑 婕 馨 瑗 琰 韵 融 园 艺 咏 卿 聪 澜 纯 毓 悦 昭 冰 爽 琬 茗 羽 希 宁 欣 飘 育 滢 馥
瑾 萱 轩 璇 菀 婉 然 含 涵 洛 沁 露 雪 斐 艺
賢 淑 德 慧 貞 卿 端 莊 靜 秀 雅
秀 娟 英 華 慧 巧 美 娜 靜 淑 惠 珠 翠 雅 芝 玉

萍 紅 娥 玲 芬 芳 燕 彩 春 菊 蘭 鳳 潔 梅 琳 素 雲

蓮 真 環 雪 榮 愛 妹 霞 香 月 鶯 媛 豔 瑞 凡 佳 嘉

瓊 勤 珍 貞 莉 桂 娣 葉 璧 璐 婭 琦 晶 妍 茜 秋 珊

莎 錦 黛 青 倩 婷 姣 婉 嫻 瑾 穎 露 瑤 怡 嬋 雁 蓓

紈 儀 荷 丹 蓉 眉 君 琴 蕊 薇 菁 夢 嵐 苑 婕 馨 瑗

琰 韻 融 園 藝 詠 卿 聰 瀾 純 毓 悅 昭 冰 爽 琬 茗

羽 希 寧 欣 飄 育 瀅 馥 筠 柔 竹 靄 凝 曉 歡 霄 楓

芸 菲 寒 伊 亞 宜 可 姬 舒 影 荔 枝 思 麗
宜 可 姬 舒 影 荔 枝 思 丽
筠 柔 竹 霭 凝 晓 欢 霄 枫 芸 菲 寒 伊 亚 宜 可 姬 舒 影 荔 枝 思 丽 秀 娟 英 华 慧 巧 美 娜 静 淑 惠 珠 翠 雅 芝 玉 萍 红 娥 玲 芬 芳 燕 彩 春 菊 勤 珍 贞 莉 兰 凤 洁 梅 琳 素 云 莲 真 环 雪 荣 爱 妹 霞 香 月 莺 媛  艳 瑞 凡 佳 嘉 琼 桂 娣 叶 璧 璐 娅 琦 晶 妍 茜 秋 珊 莎 锦 黛 青 倩 婷 姣 婉 娴 瑾 颖 露 瑶 怡 婵 雁 蓓 纨 仪 荷 丹 蓉 眉 君 琴 蕊 薇 菁 梦 岚  苑 婕 馨 瑗 琰 韵 融 园 艺 咏 卿 聪 澜 纯 毓 悦 昭 冰 爽 琬 茗 羽 希 宁 欣 飘 育 滢 馥
瑾 萱 轩 璇 菀 婉 然 含 涵 洛 沁 露 雪 斐 艺
賢 淑 德 慧 貞 卿 端 莊 靜 秀 雅
秀 娟 英 華 慧 巧 美 娜 靜 淑 惠 珠 翠 雅 芝 玉

萍 紅 娥 玲 芬 芳 燕 彩 春 菊 蘭 鳳 潔 梅 琳 素 雲

蓮 真 環 雪 榮 愛 妹 霞 香 月 鶯 媛 豔 瑞 凡 佳 嘉

瓊 勤 珍 貞 莉 桂 娣 葉 璧 璐 婭 琦 晶 妍 茜 秋 珊

莎 錦 黛 青 倩 婷 姣 婉 嫻 瑾 穎 露 瑤 怡 嬋 雁 蓓

紈 儀 荷 丹 蓉 眉 君 琴 蕊 薇 菁 夢 嵐 苑 婕 馨 瑗

琰 韻 融 園 藝 詠 卿 聰 瀾 純 毓 悅 昭 冰 爽 琬 茗

羽 希 寧 欣 飄 育 瀅 馥 筠 柔 竹 靄 凝 曉 歡 霄 楓

芸 菲 寒 伊 亞 宜 可 姬 舒 影 荔 枝 思 麗
宜 可 姬 舒 影 荔 枝 思 丽
筠 柔 竹 霭 凝 晓 欢 霄 枫 芸 菲 寒 伊 亚 宜 可 姬 舒 影 荔 枝 思 丽 秀 娟 英 华 慧 巧 美 娜 静 淑 惠 珠 翠 雅 芝 玉 萍 红 娥 玲 芬 芳 燕 彩 春 菊 勤 珍 贞 莉 兰 凤 洁 梅 琳 素 云 莲 真 环 雪 荣 爱 妹 霞 香 月 莺 媛  艳 瑞 凡 佳 嘉 琼 桂 娣 叶 璧 璐 娅 琦 晶 妍 茜 秋 珊 莎 锦 黛 青 倩 婷 姣 婉 娴 瑾 颖 露 瑶 怡 婵 雁 蓓 纨 仪 荷 丹 蓉 眉 君 琴 蕊 薇 菁 梦 岚  苑 婕 馨 瑗 琰 韵 融 园 艺 咏 卿 聪 澜 纯 毓 悦 昭 冰 爽 琬 茗 羽 希 宁 欣 飘 育 滢 馥
瑾 萱 轩 璇 菀 婉 然 含 涵 洛 沁 露 雪 斐 艺
賢 淑 德 慧 貞 卿 端 莊 靜 秀 雅
秀 娟 英 華 慧 巧 美 娜 靜 淑 惠 珠 翠 雅 芝 玉

萍 紅 娥 玲 芬 芳 燕 彩 春 菊 蘭 鳳 潔 梅 琳 素 雲

蓮 真 環 雪 榮 愛 妹 霞 香 月 鶯 媛 豔 瑞 凡 佳 嘉

瓊 勤 珍 貞 莉 桂 娣 葉 璧 璐 婭 琦 晶 妍 茜 秋 珊

莎 錦 黛 青 倩 婷 姣 婉 嫻 瑾 穎 露 瑤 怡 嬋 雁 蓓

紈 儀 荷 丹 蓉 眉 君 琴 蕊 薇 菁 夢 嵐 苑 婕 馨 瑗

琰 韻 融 園 藝 詠 卿 聰 瀾 純 毓 悅 昭 冰 爽 琬 茗

羽 希 寧 欣 飄 育 瀅 馥 筠 柔 竹 靄 凝 曉 歡 霄 楓

芸 菲 寒 伊 亞 宜 可 姬 舒 影 荔 枝 思 麗
宜 可 姬 舒 影 荔 枝 思 丽
筠 柔 竹 霭 凝 晓 欢 霄 枫 芸 菲 寒 伊 亚 宜 可 姬 舒 影 荔 枝 思 丽 秀 娟 英 华 慧 巧 美 娜 静 淑 惠 珠 翠 雅 芝 玉 萍 红 娥 玲 芬 芳 燕 彩 春 菊 勤 珍 贞 莉 兰 凤 洁 梅 琳 素 云 莲 真 环 雪 荣 爱 妹 霞 香 月 莺 媛  艳 瑞 凡 佳 嘉 琼 桂 娣 叶 璧 璐 娅 琦 晶 妍 茜 秋 珊 莎 锦 黛 青 倩 婷 姣 婉 娴 瑾 颖 露 瑶 怡 婵 雁 蓓 纨 仪 荷 丹 蓉 眉 君 琴 蕊 薇 菁 梦 岚  苑 婕 馨 瑗 琰 韵 融 园 艺 咏 卿 聪 澜 纯 毓 悦 昭 冰 爽 琬 茗 羽 希 宁 欣 飘 育 滢 馥
瑾 萱 轩 璇 菀 婉 然 含 涵 洛 沁 露 雪 斐 艺
賢 淑 德 慧 貞 卿 端 莊 靜 秀 雅
秀 娟 英 華 慧 巧 美 娜 靜 淑 惠 珠 翠 雅 芝 玉

萍 紅 娥 玲 芬 芳 燕 彩 春 菊 蘭 鳳 潔 梅 琳 素 雲

蓮 真 環 雪 榮 愛 妹 霞 香 月 鶯 媛 豔 瑞 凡 佳 嘉

瓊 勤 珍 貞 莉 桂 娣 葉 璧 璐 婭 琦 晶 妍 茜 秋 珊

莎 錦 黛 青 倩 婷 姣 婉 嫻 瑾 穎 露 瑤 怡 嬋 雁 蓓

紈 儀 荷 丹 蓉 眉 君 琴 蕊 薇 菁 夢 嵐 苑 婕 馨 瑗

琰 韻 融 園 藝 詠 卿 聰 瀾 純 毓 悅 昭 冰 爽 琬 茗

羽 希 寧 欣 飄 育 瀅 馥 筠 柔 竹 靄 凝 曉 歡 霄 楓

芸 菲 寒 伊 亞 宜 可 姬 舒 影 荔 枝 思 麗
';

$arr1 = explode("\r\n", $str_female);
$arr_female_name = array(); // 女性名字
foreach ( $arr1 as $val ){
    if($val == "") continue;
    $arr2 = explode(" ", $val);
    foreach($arr2 as $val2 ){
        if($val2 == "" ) continue;
        $arr_female_name[] = $val2;
    }
}

$last_female_index = array_rand($arr_female_name,$num);


$arr_female_full_name  = array(); // 女性名字
for( $i=0;$i<$num;$i++){
    $arr_female_full_name[] = $arr_first_name[$first_name_index[$i]] . $arr_female_name[$last_female_index[$i]];
}


/*
 * name 随机
sex   性别 男 女 （根据名字来定）
city  城市 ( 随机 合肥， 芜湖， 阜阳，六安， 安庆， 亳州，马鞍山，淮南 ...)
height 身高 ( 男： 150 - 200   女： 130 - 190  )
weight 体重 （男： 40-150   女 30-120）
birthday 出生日期 （1950 - 2000）
mobile    手机 （11位， 13 15 17 18 ）
created_at  创建时间 （ 随机一个时间  ）
 */

$arr_sex = ["男", "女"];
$arr_city = ["合肥", "芜湖", "阜阳", "六安", "安庆", "亳州", "马鞍山", "淮南"];
$arr_mobile = [13,15,17,18];
$sql_data = "";
for( $i = 1; $i < $num; $i++){

    $sex_index = rand(0,1);
    $sex = $arr_sex[$sex_index];
    if($sex=="男"){
        $name = $arr_male_full_name[$i];
        $height = rand(160,200);
        $weight = rand(40,130);
    } else {
        $name = $arr_female_full_name[$i];
        $height = rand(150,185);
        $weight = rand(30,100);
    }
    $birthday =  rand(1970, 2000). "-". rand(1,12) . "-". rand(1, 28);
    $city = $arr_city[rand(0, count($arr_city)-1)];

    $last_mobile = "";
    for( $j = 1; $j <= 9; $j++){
        $last_mobile .= rand(0,9);
    }

    $mobile =  $arr_mobile[rand(0,3)] . $last_mobile;
    $created_at =  "2016-08-31";
    $sql_data .=  "insert into cv ( name, sex, city, height, weight, birthday, mobile, created_at) values(  \"$name\", \"$sex\", \"$city\", $height, $weight,  \"$birthday\", \"$mobile\", \"$created_at\"  );\r\n";
}

// 将sql写入文件
file_put_contents("cv_data.sql", $sql_data,FILE_APPEND);

echo "写入sql文件 cv_data.sql 成功！";








