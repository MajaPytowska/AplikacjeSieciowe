<?php
/* Smarty version 5.4.5, created on 2025-12-23 23:53:53
  from 'file:LoginView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_694b1d813c7669_60725306',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a6526927a272613cee4d6c27517f08f44bcba58' => 
    array (
      0 => 'LoginView.tpl',
      1 => 1766530430,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_694b1d813c7669_60725306 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_136627148694b1d813ac0e6_00602409', "form_content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "form_base.tpl", $_smarty_current_dir);
}
/* {block "form_content"} */
class Block_136627148694b1d813ac0e6_00602409 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>

<form method="post" action="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'login'), $_smarty_tpl);?>
">
	<div class="row gtr-uniform">
	    <div class="col-12">
			<input type="text" name="login" id="login" value="<?php echo $_smarty_tpl->getValue('form')->login ?? null;?>
" placeholder="Login" />
            <?php if ($_smarty_tpl->getValue('msgs')->isMessage('login')) {?>
                <label for="login"><?php echo $_smarty_tpl->getValue('msgs')->getMessage('login')->text;?>
</label>
            <?php }?>
		</div>
		<div class="col-12">
			<input type="password" name="password" id="password" value="" placeholder="Hasło" />
            <?php if ($_smarty_tpl->getValue('msgs')->isMessage('password')) {?>
                <label for="password"><?php echo $_smarty_tpl->getValue('msgs')->getMessage('password')->text;?>
</label>
            <?php }?>
		</div>
        <?php if ($_smarty_tpl->getValue('msgs')->isMessage('general')) {?>
            <div class="col-12">
                <?php echo $_smarty_tpl->getValue('msgs')->getMessage('general')->text;?>

            </div>	
        <?php }?>							
		<div class="col-12" style="justify-content: center;">
			<input type="submit" value="Zaloguj się" class="primary"/>
		</div>
        <div class="col-12" style="margin-top:1em;">
            Nie masz konta? <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showRegistrationForm'), $_smarty_tpl);?>
">Zarejestruj się</a>
        </div>
	</div>
</form>

<?php
}
}
/* {/block "form_content"} */
}
