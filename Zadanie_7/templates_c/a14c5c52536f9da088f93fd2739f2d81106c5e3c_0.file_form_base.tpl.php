<?php
/* Smarty version 5.5.1, created on 2025-12-07 21:34:48
  from 'file:form_base.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6935e4e8f1c1a4_33326115',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a14c5c52536f9da088f93fd2739f2d81106c5e3c' => 
    array (
      0 => 'form_base.tpl',
      1 => 1764765733,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
))) {
function content_6935e4e8f1c1a4_33326115 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14879625756935e4e8f05342_09245211', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block 'header'} */
class Block_14863288506935e4e8f05bc4_41563787 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views\\templates';
?>
 <?php
}
}
/* {/block 'header'} */
/* {block 'form_content'} */
class Block_3682254086935e4e8f07ba5_81849067 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views\\templates';
?>
 <?php
}
}
/* {/block 'form_content'} */
/* {block 'side_panel_content'} */
class Block_8317368476935e4e8f101a6_99930434 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views\\templates';
?>
 <?php
}
}
/* {/block 'side_panel_content'} */
/* {block 'content'} */
class Block_14879625756935e4e8f05342_09245211 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views\\templates';
?>
 
	<header class="major">
		<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14863288506935e4e8f05bc4_41563787', 'header', $this->tplIndex);
?>

	</header>
	<div class="row" style="justify-content: center;">
	<div class="col-6 col-12-small">
		<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3682254086935e4e8f07ba5_81849067', 'form_content', $this->tplIndex);
?>

	</div>
	<?php if ($_smarty_tpl->getValue('hide_header')) {?> <!--Pominiecie nagłówka oznacza podjęcie interackji z formularzem - może się to zakończyć wiadomościami błędów lub pokazaniem rezultatu-->
		<div class="col-6 col-12-small">
			<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8317368476935e4e8f101a6_99930434', 'side_panel_content', $this->tplIndex);
?>

			<?php $_smarty_tpl->renderSubTemplate('file:messages.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
		</div>
	<?php }?>
	</div>								
<?php
}
}
/* {/block 'content'} */
}
