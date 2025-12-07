<?php
/* Smarty version 5.5.1, created on 2025-12-07 21:35:03
  from 'file:CalcTableView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6935e4f7566714_39720092',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '99161dfd6aedc1c164861c5200bd5e2675360971' => 
    array (
      0 => 'CalcTableView.tpl',
      1 => 1765139567,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6935e4f7566714_39720092 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_5997049286935e4f7547434_16427561', 'content');
?>
 <?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_5997049286935e4f7547434_16427561 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views';
?>
 
<header class="major">
	<h2>Historia obliczeń</h2>
</header>
	<div class="row" style="justify-content: center; min-width: 0;">
	<div class="col-12" style="overflow-x: auto;">
		<table>
			<thead>
				<tr>
					<th>Data obliczenia</th>
					<th>Kwota kredytu</th>
					<th>Ilość lat</th>
					<th>Oprocentowanie</th>
					<th>Rata miesięczna</th>
				</tr>
			</thead>
			<tbody>
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('form'), 'f');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('f')->value) {
$foreach0DoElse = false;
?>
				<tr>
					<td><?php echo $_smarty_tpl->getValue('f')['date'];?>
</td>
					<td><?php echo $_smarty_tpl->getValue('f')['loan'];?>
 zł</td>
					<td><?php echo $_smarty_tpl->getValue('f')['years'];?>
</td>
					<td><?php echo $_smarty_tpl->getValue('f')['procent'];?>
%</td>
					<td><?php echo $_smarty_tpl->getValue('f')['result'];?>
 zł</td>
				</tr>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			</tbody>
		</table>
	</div>
	</div>
<?php
}
}
/* {/block 'content'} */
}
