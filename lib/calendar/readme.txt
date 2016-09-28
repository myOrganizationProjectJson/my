只需要加载WdatePicker.js文件


示例1-1-1 常规调用
 
<input id="d11" type="text" onClick="WdatePicker()"/>

示例1-1-2 图标触发
  
<input id="d12" type="text"/>
<img onclick="WdatePicker({el:'d12'})" src="../skin/datePicker.gif" width="16" height="22" align="absmiddle">

示例1-2-1 周显示简单应用 
 
<input id="d121" type="text" onfocus="WdatePicker({isShowWeek:true})"/>

注意:周算法参考的是ISO8601定义的方法,如果您对此有疑问,请详见:http://en.wikipedia.org/wiki/ISO_week_date

周算法选择(4.7新增)
相关属性:whichDayIsfirstWeek
周算法不同的地方有一些差异
常见算法有三种
1. ISO8601:规定第一个星期四为第一周,默认值: 4
2. MSExcel:1月1日所在的周: 可以填写: 7
3. 自己根据需要自定义,每年的第一个星期X作为第一周,可以填写: X (X可以是1-7之间任何一个数字)

示例1-2-2 利用onpicked事件把周赋值给另外的文本框
    您选择了第  (W格式)周, 另外您可以使用WW格式:  周 
<input type="text" class="Wdate" id="d122" onFocus="WdatePicker({isShowWeek:true,onpicked:function() {$dp.$('d122_1').value=$dp.cal.getP('W','W');$dp.$('d122_2').value=$dp.cal.getP('W','WW');}})"/>

onpicked 用法详见自定义事件
$dp.cal.getP 用法详见内置函数和属性


4.只读开关,高亮周末功能 设置readOnly属性 true 或 false 可指定日期框是否只读 
设置highLineWeekDay属性 ture 或 false 可指定是否高亮周末 

示例2-1 平面显示演示
<div id="div1"></div>
<script>
WdatePicker({eCont:'div1',onpicked:function(dp){alert('你选择的日期是:'+dp.cal.getDateStr())}})
</script>

示例2-2 将日期返回到<span>中
2008-01-01 

代码:
<span id="demospan">2008-01-01</span> 
<img onClick="WdatePicker({el:'demospan'})" src="../../My97DatePicker/skin/datePicker.gif" width="16" height="22" align="absmiddle" style="cursor:pointer" />

示例2-3-1 起始日期简单应用 
默认的起始日期为 1980-05-01
当日期框为空值时,将使用 1980-05-01 做为起始日期 

 
<input type="text" id="d221" onFocus="WdatePicker({startDate:'1980-05-01'})"/>

示例2-3-2 alwaysUseStartDate属性应用
默认的起始日期为 1980-05-01
当日期框无论是何值,始终使用 1980-05-01 做为起始日期 

 
<input type="text" id="d222" onFocus="WdatePicker({startDate:'1980-05-01',alwaysUseStartDate:true})"/>

示例2-3-3 使用内置参数
除了使用静态的日期值以外,还可以使用动态参数(如:%y,%M分别表示当前年和月)

下例演示,年月日使用当年当月的1日,时分秒使用00:00:00作为起始时间

 
<input type="text" id="d233" onFocus="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>

二. 功能及示例2. 特色功能 1.平面显示 日期控件支持平面显示功能,只要设置一下eCont属性就可以把它当作日历来使用了,无需触发条件,直接显示在页面上



示例2-1 平面显示演示
<div id="div1"></div>
<script>
WdatePicker({eCont:'div1',onpicked:function(dp){alert('你选择的日期是:'+dp.cal.getDateStr())}})
</script>

$dp.cal.getDateStr 用法详见内置函数和属性

2.支持多种容器 除了可以将值返回给input以外,还可以通过配置el属性将值返回给其他的元素(如:textarea,div,span)等,带有innerHTML属性的HTML元素

示例2-2 将日期返回到<span>中
2008-01-01 

代码:
<span id="demospan">2008-01-01</span> 
<img onClick="WdatePicker({el:'demospan'})" src="../../My97DatePicker/skin/datePicker.gif" width="16" height="22" align="absmiddle" style="cursor:pointer" />

3.起始日期功能 
注意:日期格式必须与 realDateFmt 和 realTimeFmt 一致 
有时在项目中需要选择生日之类的日期,而默认点开始日期都是当前日期,导致年份选择非常麻烦,你可以通过起始日期功能加上配置alwaysUseStartDate属性轻松解决此类问题

示例2-3-1 起始日期简单应用 
默认的起始日期为 1980-05-01
当日期框为空值时,将使用 1980-05-01 做为起始日期 

 
<input type="text" id="d221" onFocus="WdatePicker({startDate:'1980-05-01'})"/>

示例2-3-2 alwaysUseStartDate属性应用
默认的起始日期为 1980-05-01
当日期框无论是何值,始终使用 1980-05-01 做为起始日期 

 
<input type="text" id="d222" onFocus="WdatePicker({startDate:'1980-05-01',alwaysUseStartDate:true})"/>

示例2-3-3 使用内置参数
除了使用静态的日期值以外,还可以使用动态参数(如:%y,%M分别表示当前年和月)

下例演示,年月日使用当年当月的1日,时分秒使用00:00:00作为起始时间

 
<input type="text" id="d233" onFocus="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>

4.自定义格式 yMdHmswW分别代表年月日时分秒星期周,你可以任意组合这些元素来自定义你个性化的日期格式. 


日期格式表 格式 说明 
y 将年份表示为最多两位数字。如果年份多于两位数，则结果中仅显示两位低位数。 
yy  同上，如果小于两位数，前面补零。 
yyy 将年份表示为三位数字。如果少于三位数，前面补零。 
yyyy 将年份表示为四位数字。如果少于四位数，前面补零。 
M 将月份表示为从 1 至 12 的数字 
MM 同上，如果小于两位数，前面补零。 
MMM 返回月份的缩写 一月 至 十二月 (英文状态下 Jan to Dec) 。 
MMMM 返回月份的全称 一月 至 十二月 (英文状态下 January to December) 。 
d 将月中日期表示为从 1 至 31 的数字。 
dd 同上，如果小于两位数，前面补零。 
H  将小时表示为从 0 至 23 的数字。 
HH 同上，如果小于两位数，前面补零。 
m 将分钟表示为从 0 至 59 的数字。 
mm 同上，如果小于两位数，前面补零。 
s 将秒表示为从 0 至 59 的数字。 
ss 同上，如果小于两位数，前面补零。 
w 返回星期对应的数字 0 (星期天) - 6 (星期六) 。 
D 返回星期的缩写 一 至 六 (英文状态下 Sun to Sat) 。 
DD 返回星期的全称 星期一 至 星期六 (英文状态下 Sunday to Saturday) 。 
W 返回周对应的数字 (1 - 53) 。 
WW 同上，如果小于两位数，前面补零 (01 - 53) 。 

示例
格式字符串 值 
yyyy-MM-dd HH:mm:ss 2008-03-12 19:20:00 
yy年M月 08年3月 
yyyyMMdd 20080312 
今天是:yyyy年M年d HH时mm分  今天是:2008年3月12日 19时20分 
H:m:s 19:20:0 
y年 8年 
MMMM d, yyyy 三月 12, 2008 

示例 2-4-1: 年月日时分秒
 
<input type="text" id="d241" onfocus="WdatePicker({dateFmt:'yyyy年MM月dd日 HH时mm分ss秒'})" class="Wdate" style="width:300px"/>

注意:点两次才能选择日期的原因,详见 autoPickDate 属性

示例 2-4-2 时分秒
 
<input type="text" id="d242" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'H:mm:ss'})" class="Wdate"/>

注意:这里提前使用了皮肤(skin)属性,所以你会看到一个不同的皮肤,皮肤属性详见自定义和动态切换皮肤 

示例 2-4-3 年月
 
<input type="text" id="d243" onfocus="WdatePicker({skin:'whyGreen',dateFmt:'yyyy年MM月'})" class="Wdate"/>

示例 2-4-4 取得系统可识别的日期值(重要)
类似于 1999年7月5日 这样的日期是不能够被系统识别的,他必须转换为能够识别的类型如 1999-07-05 

 真实的日期值是:  
<input id="d244" type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy年M月d日',vel:'d244_2'})"/>
<input id="d244_2" type="text" />

注意:在实际应用中,一般会把vel指定为一个hidden控件,这里是为了把真实值展示出来,所以使用文本框
关键属性: vel 指定一个控件或控件的ID,必须具有value属性(如input),用于存储真实值(也就是realDateFmt和realTimeFmt格式化后的值)

示例 2-4-5 星期, 月 日, 年(4.6新增)
 
<input type="text" id="d245" onfocus="WdatePicker({dateFmt:'DD, MMMM d, yyyy'})" class="Wdate"/>

5.双月日历功能(4.6新增) 可以同时弹出两个月的日历

示例2-5 双月日历功能
 
<input class="Wdate" type="text" onfocus="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd'})"/>

注意:双月日历一般只用于包含年月日三个元素的场景,另外设置该属性时,autoPickDate自动设置为true

6.自动纠错功能 纠错处理可设置为3种模式:提示(默认) 自动纠错 标记,当日期框中的值不符合格式时,系统会尝试自动修复,如果修复失败会根据您设置的纠错处理模式进行处理,错误判断功能非常智能它可以保证用户输入的值是一个合法的值

示例2-6-1 不合法的日期演示
请在下面的日期框中填入一个不合法的日期(如:1997-02-29),再尝试离开焦点
使用默认容错模式 提示模式 errDealMode = 0 在输入错误日期时,会先提示 
 

注意:1997年不是闰年哦

示例2-6-2 超出日期限制范围的日期也被认为是一个不合法的日期
最大日期是2000-01-10 ,如果在下框中填入的日期 大于 2000-01-10(如2000-01-12)也会被认为是不合法的日期 
自动纠错模式 errDealMode = 1 在输入错误日期时,自动恢复前一次正确的值
 

示例2-6-3 使用无效天和无效日期功能限制的日期也被认为是一个不合法的日期
如:
2008-02-20 无效日期限制
2008-02-02 2008-02-09 2008-02-16 2008-02-23 无效天限制
都是无效日期
您可以尝试在下框中输入这些日期,并离开焦点

标记模式 errDealMode = 2 在输入错误日期时,不做提示和更改,只是做一个标记,但此时日期框不会马上隐藏
 

注意:标记类:WdateFmtErr是在skin目录下WdatePicker.css中定义的

7.跨无限级框架显示 无论你把日期控件放在哪里,你都不需要担心会被外层的iframe所遮挡进而影响客户体验,因为My97日期控件是可以跨无限级框架显示的

示例2-7 跨无限级框架演示
可无限跨越框架iframe,无论怎么嵌套框架都不必担心了,即使有滚动条也不怕

8.民国年日历和其他特殊日历 当年份格式设置为yyy格式时,利用年份差量属性yearOffset(默认值1911民国元年),可实现民国年日历和其他特殊日历

示例2-8 民国年演示
 
<input type="text" id="d28" onClick="WdatePicker({dateFmt:'yyy/MM/dd'})"/>

注意:年份格式设置成yyy时,真正的日期将会减去一个差量yearOffset(默认值为:1911),如果是民国年使用默认值即可无需另外配置,如果是其他的差量,可以通过参数的形式配置

9.编辑功能 当日期框里面有值时,修改完某个属性后,只要点击这个按钮就可以实现时间和日期的编辑

示例2-9 日期和时间的编辑演示
您可以尝试对下面框中的月份改为1,然后点击更新,你会发现日期由 2000-02-29 01:00:00 变为 2000-01-29 01:00:00
 

10.为编程带来方便 如果el的值是this,可省略,即所有的el:this都可以不写 
日期框设置为disabled时,禁止更改日期(不弹出选择框) 
如果没有定义onpicked事件,自动触发文本框的onchange事件 
如果没有定义oncleared事件,清空时,自动触发onchange事件

11.其他属性 设置readOnly属性,可指定日期框是否只读 
设置highLineWeekDay属性,可指定是否高亮周末 
设置isShowOthers属性,可指定是否显示其他月的日期 
加上class="Wdate"就会在选择框右边出现日期图标

3. 多语言和自定义皮肤4. 日期范围限制5. 自定义事件6. 快速选择功能 三. 配置说明四. 如何使用

? 2010 My97 All Rights Reserved.     LinezingStat    浙ICP备09049265号 


