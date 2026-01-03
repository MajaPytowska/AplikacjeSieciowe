<?php
/* Smarty version 5.4.5, created on 2026-01-02 15:50:33
  from 'file:RegistrationView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6957db396036d3_97776081',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4054f4c4cb6af356a463615d37bcaab24d83a4d1' => 
    array (
      0 => 'RegistrationView.tpl',
      1 => 1767365430,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:form_base_input.tpl' => 4,
  ),
))) {
function content_6957db396036d3_97776081 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6109865626957db395ea064_68672101', "form_content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "form_base.tpl", $_smarty_current_dir);
}
/* {block "form_content"} */
class Block_6109865626957db395ea064_68672101 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>

<form method="post" action="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'register'), $_smarty_tpl);?>
">
	<div class="row gtr-uniform">
		<div class="col-6 col-12-xsmall">
			<?php $_smarty_tpl->renderSubTemplate("file:form_base_input.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"text",'name'=>"name",'id'=>"name",'value'=>($_smarty_tpl->getValue('form')->user_data->name ?? null),'placeholder'=>"Imię"), (int) 0, $_smarty_current_dir);
?> 
		</div>
		<div class="col-6 col-12-xsmall">
			<?php $_smarty_tpl->renderSubTemplate("file:form_base_input.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"text",'name'=>"surname",'id'=>"surname",'value'=>($_smarty_tpl->getValue('form')->user_data->surname ?? null),'placeholder'=>"Nazwisko"), (int) 0, $_smarty_current_dir);
?> 
		</div>
		<div class="col-12">
			<?php $_smarty_tpl->renderSubTemplate("file:form_base_input.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"text",'name'=>"pesel",'id'=>"pesel",'value'=>($_smarty_tpl->getValue('form')->user_data->pesel ?? null),'placeholder'=>"PESEL"), (int) 0, $_smarty_current_dir);
?> 
		</div>
                <div class="col-12">
			<?php $_smarty_tpl->renderSubTemplate("file:form_base_input.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"password",'name'=>"password",'id'=>"password",'value'=>'','placeholder'=>"Hasło"), (int) 0, $_smarty_current_dir);
?> 
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
