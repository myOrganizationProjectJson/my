<?php !defined("__TPL_IN__") && exit(); ?><?php include $GLOBALS['__TPL__']->inc('../common/head.html'); ?><?php include $GLOBALS['__TPL__']->inc('menu.html'); ?><script language="javascript" src="<?php echo DIARY_ROOT_REF; ?>lib/calendar/WdatePicker.js"></script>
<script language="javascript" src="lib/kindeditor/kindeditor.js"></script>
<script language="javascript" src="lib/kindeditor/lang/zh_CN.js"></script>

<div id="diary_title"><?php echo lang('edit'); ?><?php echo lang('diary'); ?></div>

<div id="edit_box">
<form action="<?php echo DIARY_ROOT_REF; ?>index.php?m=diary&a=submitedit" method="post" submittype="ajax">
    <div class="clear">
        <div class="left">
        <?php echo lang('datetime'); ?>:
        <input type="text" class="text" name="datetime" style="cursor:pointer;" readonly="readonly" onfocus="WdatePicker()" check="require" warning="<?php echo lang('datetime_is_null'); ?>" value="<?php echo($diary_view['time']); ?>" />
        </div>
        <div type="status" class="left line2em"></div>
    </div>
    <div class="clear">
        <div class="left">
        <textarea name="content" style="width:600px;height:400px;"><?php echo htmlspecialchars($diary_view['content']); ?></textarea>
        </div>
        <div type="status" class="left line2em"></div>
    </div>
    <div class="clear">
<input type="submit" class="button" value="<?php echo lang('save'); ?>" onclick="editor.sync();" />
    </div>
</form>
</div>

<script language="javascript">
var editor;
KindEditor.ready(function(K) {
editor = K.create('textarea[name="content"]', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : false,
items : [
'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
'insertunorderedlist', '|', 'emoticons', 'image', 'link']
});
});

</script><?php include $GLOBALS['__TPL__']->inc('../common/foot.html'); ?>