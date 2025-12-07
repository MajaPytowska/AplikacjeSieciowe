<?php
/* Smarty version 5.5.1, created on 2025-12-07 21:34:48
  from 'file:LoginView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6935e4e8c366a6_93228878',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c179c668a3e2086b30a4334c3a65b69e12e54afd' => 
    array (
      0 => 'LoginView.tpl',
      1 => 1764849711,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6935e4e8c366a6_93228878 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10008732286935e4e8c264f3_88143003', 'header');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10353125956935e4e8c31923_69686980', 'form_content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "form_base.tpl", $_smarty_current_dir);
}
/* {block 'header'} */
class Block_10008732286935e4e8c264f3_88143003 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views';
?>
 
	<h2>Zaloguj się do systemu</h2>
<?php
}
}
/* {/block 'header'} */
/* {block 'form_content'} */
class Block_10353125956935e4e8c31923_69686980 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views';
?>
 
	<form method="post" action="<?php echo $_smarty_tpl->getValue('conf')->action_url;?>
login">
		<div class="row gtr-uniform">
			<div class="col-12"><input type="text" name="login" id="username" placeholder="Login" value="<?php echo $_smarty_tpl->getValue('form')->login;?>
"/></div>
			<div class="col-12"><input type="password" name="password" id="password" placeholder="Hasło" value="<?php echo $_smarty_tpl->getValue('form')->password;?>
"/></div>
			<div class="col-12">
				<ul class="actions special">
					<li><input type="submit" value="Zaloguj" class="primary"/></li>
				</ul>
			</div>
		</div>
	</form>
<?php
}
}
/* {/block 'form_content'} */
}
