<?php
/* Smarty version 5.4.5, created on 2025-12-23 18:56:12
  from 'file:form_base.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_694ad7bcd1a330_21998238',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df59795266626ca66f64df2c4de44ad6157bcb99' => 
    array (
      0 => 'form_base.tpl',
      1 => 1766512520,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_694ad7bcd1a330_21998238 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1430567660694ad7bcd177a4_83660600', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block 'form_content'} */
class Block_328305218694ad7bcd180b5_11785306 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views\\templates';
?>
 <?php
}
}
/* {/block 'form_content'} */
/* {block "content"} */
class Block_1430567660694ad7bcd177a4_83660600 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views\\templates';
?>

<div class="row" style="justify-content: center;">
	<div class="col-6 col-12-small">
		<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_328305218694ad7bcd180b5_11785306', 'form_content', $this->tplIndex);
?>

	</div>
<?php
}
}
/* {/block "content"} */
}
