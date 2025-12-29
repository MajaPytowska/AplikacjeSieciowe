<?php
/* Smarty version 5.4.5, created on 2025-12-29 12:38:43
  from 'file:messages.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_69526843b85fc4_76111403',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7217334e40971a8a0016006129079259ed6c8ed' => 
    array (
      0 => 'messages.tpl',
      1 => 1767007996,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69526843b85fc4_76111403 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views\\templates';
if (!$_smarty_tpl->getValue('msgs')->isEmpty()) {?>
	<div class="message error">
		<h3 class="icon solid fa-exclamation-triangle" >Błędy</h3>
			<ol>
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('msgs')->getMessages(), 'msg');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach0DoElse = false;
?>
					<li><?php echo $_smarty_tpl->getValue('msg')->text;?>
</li>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			</ol>
	</div>
<?php }
}
}
