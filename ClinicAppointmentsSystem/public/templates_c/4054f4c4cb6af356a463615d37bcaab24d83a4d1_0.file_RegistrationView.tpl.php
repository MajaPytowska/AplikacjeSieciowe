<?php
/* Smarty version 5.4.5, created on 2026-01-03 20:01:45
  from 'file:RegistrationView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_69596799bfd260_31090740',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4054f4c4cb6af356a463615d37bcaab24d83a4d1' => 
    array (
      0 => 'RegistrationView.tpl',
      1 => 1767466902,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69596799bfd260_31090740 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_52991555869596799bc6910_23761809', "form_content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "form_base.tpl", $_smarty_current_dir);
}
/* {block "form_content"} */
class Block_52991555869596799bc6910_23761809 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>

<form method="post" action="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'register'), $_smarty_tpl);?>
">
	<div class="row gtr-uniform">
		<div class="col-6 col-12-xsmall">
			<input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->getValue('form')->user_data->name;?>
" placeholder="Imię" />
		</div>
		<div class="col-6 col-12-xsmall">
			<input type="text" name="surname" id="surname" value="<?php echo $_smarty_tpl->getValue('form')->user_data->surname;?>
" placeholder="Nazwisko" />
		</div>
		<div class="col-12">
			<input type="text" name="pesel" id="pesel" value="<?php echo $_smarty_tpl->getValue('form')->user_data->pesel;?>
" placeholder="PESEL" />
		</div>
                <div class="col-12">
			<input type="password" name="password" id="password" placeholder="Hasło" />
		</div>
		<div class="col-12">
			<input type="password" name="confirm_password" id="confirm_password" placeholder="Potwierdź hasło" />
		</div>
		<div class="col-12">
			<input type="submit" value="Zarejestruj się" class="primary" />
		</div>
	</div>
</form>

<?php
}
}
/* {/block "form_content"} */
}
