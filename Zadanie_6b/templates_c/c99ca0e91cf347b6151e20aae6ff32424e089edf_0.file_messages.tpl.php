<?php
/* Smarty version 5.5.1, created on 2025-12-03 14:31:41
  from 'file:messages.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_69303bbd5396b9_90726845',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c99ca0e91cf347b6151e20aae6ff32424e089edf' => 
    array (
      0 => 'messages.tpl',
      1 => 1764762785,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69303bbd5396b9_90726845 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_6\\app\\views\\templates';
if ($_smarty_tpl->getValue('messages')->isError()) {?>
	<div class="message error">
		<h3 class="icon solid fa-exclamation-triangle" >Błędy</h3>
			<ol>
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('messages')->getErrors(), 'msg');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach0DoElse = false;
?>
					<li><?php echo $_smarty_tpl->getValue('msg');?>
</li>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			</ol>
	</div>
<?php }?>

<?php if ($_smarty_tpl->getValue('messages')->isInfo()) {?>
	<div class="message info">
		<h3 class="icon solid fa-bookmark" >Pamiętaj</h3>
			<ol>
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('messages')->getInfos(), 'info');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('info')->value) {
$foreach1DoElse = false;
?>
					<li><?php echo $_smarty_tpl->getValue('info');?>
</li>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			</ol>
	</div>
<?php }
}
}
