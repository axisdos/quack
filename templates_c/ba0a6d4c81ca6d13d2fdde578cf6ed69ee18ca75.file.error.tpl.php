<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-01-20 16:14:17
         compiled from "lib\tpl\error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103954be70c9953568-41992996%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba0a6d4c81ca6d13d2fdde578cf6ed69ee18ca75' => 
    array (
      0 => 'lib\\tpl\\error.tpl',
      1 => 1421766853,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103954be70c9953568-41992996',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54be70c99d47d2_91391524',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54be70c99d47d2_91391524')) {function content_54be70c99d47d2_91391524($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['msg']->value)) {?>
    <div class="alert alert-danger">
        <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

    </div>
<?php }?><?php }} ?>
