<?php
/* Smarty version 5.5.1, created on 2025-12-03 13:42:22
  from 'file:form_base.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6930302ebd9541_60927523',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '26a877ef1ef72d56b36ca60abc36bfbe6683b89d' => 
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
function content_6930302ebd9541_60927523 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_6\\app\\views\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14910031106930302ebc4d91_66553994', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block 'header'} */
class Block_8511723476930302ebc5bc6_10839975 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_6\\app\\views\\templates';
?>
 <?php
}
}
/* {/block 'header'} */
/* {block 'form_content'} */
class Block_7273804096930302ebcd1c4_67697790 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_6\\app\\views\\templates';
?>
 <?php
}
}
/* {/block 'form_content'} */
/* {block 'side_panel_content'} */
class Block_6772694246930302ebd26c7_14637284 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_6\\app\\views\\templates';
?>
 <?php
}
}
/* {/block 'side_panel_content'} */
/* {block 'content'} */
class Block_14910031106930302ebc4d91_66553994 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_6\\app\\views\\templates';
?>
 
	<header class="major">
		<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8511723476930302ebc5bc6_10839975', 'header', $this->tplIndex);
?>

	</header>
	<div class="row" style="justify-content: center;">
	<div class="col-6 col-12-small">
		<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7273804096930302ebcd1c4_67697790', 'form_content', $this->tplIndex);
?>

	</div>
	<?php if ($_smarty_tpl->getValue('hide_header')) {?> <!--Pominiecie nagłówka oznacza podjęcie interackji z formularzem - może się to zakończyć wiadomościami błędów lub pokazaniem rezultatu-->
		<div class="col-6 col-12-small">
			<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6772694246930302ebd26c7_14637284', 'side_panel_content', $this->tplIndex);
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
