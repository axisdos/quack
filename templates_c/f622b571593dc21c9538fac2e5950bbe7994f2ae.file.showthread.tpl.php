<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-01-19 19:41:19
         compiled from "lib\tpl\showthread.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18806549ef72ff1cfb5-67511612%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f622b571593dc21c9538fac2e5950bbe7994f2ae' => 
    array (
      0 => 'lib\\tpl\\showthread.tpl',
      1 => 1421692877,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18806549ef72ff1cfb5-67511612',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_549ef7305415a4_70046886',
  'variables' => 
  array (
    'error' => 0,
    'success' => 0,
    'firstpost' => 0,
    'noreplies' => 0,
    'subposts' => 0,
    'post' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549ef7305415a4_70046886')) {function content_549ef7305415a4_70046886($_smarty_tpl) {?><div class="container">
    <div class="row">
        <div class="col-lg-7 col-lg-offset-1">
            <?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
                <div class="alert alert-warning">
                    <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

                </div>
            <?php }?>
            
            <?php if (isset($_smarty_tpl->tpl_vars['success']->value)) {?>
                <div class="alert alert-success">
                    <?php echo $_smarty_tpl->tpl_vars['success']->value;?>

                </div>
            <?php }?>
            <h2 style="margin-top: 0"><?php echo $_smarty_tpl->tpl_vars['firstpost']->value['thread_title'];?>
</h2>
            <hr />
            <div class="postbit">
                <!-- BEGIN AVATAR -->
                <?php if ($_smarty_tpl->tpl_vars['firstpost']->value['avatar']==null) {?>
                    <img src="https://en.gravatar.com/images/gravatars/no_gravatar.gif" class="avatar" />
                <?php } else { ?>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['firstpost']->value['avatar'];?>
" class="avatar" />
                <?php }?>

                <span class="pull-left">
                    <a href="#"><?php echo $_smarty_tpl->tpl_vars['firstpost']->value['username'];?>
</a>
                    <br />
                    0 messages
                </span>

                <span class="pull-right">
                    <?php echo timeAgo($_smarty_tpl->tpl_vars['firstpost']->value['date']);?>

                </span>
                <!-- END AVATAR -->
            </div>
            <div style="clear:both;"></div>

            <div class="row">
                <div class="col-lg-12">
                    <br />
                    <?php echo purify($_smarty_tpl->tpl_vars['firstpost']->value['thread_content']);?>

                </div>
            </div>
            <hr />

            <?php if (isset($_smarty_tpl->tpl_vars['noreplies']->value)) {?>
                <div class="alert alert-warning">
                    There are no replies to this thread yet
                </div>
            <?php }?>

            <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['subposts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
                <div class="postbit">
                    <?php if ($_smarty_tpl->tpl_vars['post']->value['avatar']==null) {?>
                        <img src="https://en.gravatar.com/images/gravatars/no_gravatar.gif" class="avatar" />
                    <?php } else { ?>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['post']->value['avatar'];?>
" class="avatar" />
                    <?php }?>

                    <span class="pull-left">
                        <a href="#"><?php echo $_smarty_tpl->tpl_vars['post']->value['username'];?>
</a>
                        <br />
                        0 messages
                    </span>

                    <span class="pull-right">
                        <?php echo timeAgo($_smarty_tpl->tpl_vars['post']->value['date']);?>

                    </span>
                </div>
                <div style="clear:both"></div>

                <div class="row">
                    <div class="col-lg-12">
                        <br />
                        <?php echo purify($_smarty_tpl->tpl_vars['post']->value['reply_content']);?>

                    </div>
                </div>
                <hr />
            <?php } ?>   

            <?php if (isset($_smarty_tpl->tpl_vars['user']->value)) {?>
                <form method="POST">
                    <div class="form-group">
                        <textarea name="message" class="form-control" placeholder="Add a message to this thread"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="addpost">
                            Add Message
                        </button>
                    </div>
                </form>
            <?php }?>
        </div>

        <div class="col-lg-3">

        </div>
    </div>
</div><?php }} ?>
