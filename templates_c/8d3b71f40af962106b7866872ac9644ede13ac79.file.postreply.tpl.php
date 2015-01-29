<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-01-29 13:02:12
         compiled from "lib\tpl\postreply.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1994254ca098a21fb21-43786522%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d3b71f40af962106b7866872ac9644ede13ac79' => 
    array (
      0 => 'lib\\tpl\\postreply.tpl',
      1 => 1422532908,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1994254ca098a21fb21-43786522',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54ca098a3b3e00_54668515',
  'variables' => 
  array (
    'postadded' => 0,
    'thread' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ca098a3b3e00_54668515')) {function content_54ca098a3b3e00_54668515($_smarty_tpl) {?><div class="row">
<div class="col-lg-12">
<?php if (isset($_smarty_tpl->tpl_vars['postadded']->value)) {?>
	<div class="alert alert-success">
		Your post has been added. Click <a href="thread/<?php echo $_smarty_tpl->tpl_vars['thread']->value;?>
">here</a> to return to the thread.
	</div>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
	<div class="alert alert-warning">
		<?php echo $_smarty_tpl->tpl_vars['error']->value;?>

	</div>
<?php }?>

<form method="POST">
    <div class="form-group">
        <textarea name="content" class="form-control" placeholder="Add a message to this thread"></textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success" name="addpost">
            Add Message
        </button>
    </div>
</form>
</div>
</div><?php }} ?>
