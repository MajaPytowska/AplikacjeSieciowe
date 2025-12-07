<?php
/* Smarty version 5.5.1, created on 2025-12-07 21:34:58
  from 'file:CalcView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6935e4f21addf3_41158509',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8aa034408493eac17d2fdb3916e30b442e192b2' => 
    array (
      0 => 'CalcView.tpl',
      1 => 1764777124,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6935e4f21addf3_41158509 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11266476626935e4f2181d38_00848975', 'header');
?>



<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2714355466935e4f2194308_94918285', 'form_content');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14262663506935e4f21a9937_21717096', 'side_panel_content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "form_base.tpl", $_smarty_current_dir);
}
/* {block 'header'} */
class Block_11266476626935e4f2181d38_00848975 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views';
?>
 
	<?php if ((true && ($_smarty_tpl->hasVariable('user') && null !== ($_smarty_tpl->getValue('user') ?? null)))) {?>
		<span class="icon solid fa-user" ><?php echo $_smarty_tpl->getValue('user')->login;?>
</span>
	<?php }?>
	<h2>Kalkulator kredytowy</h2>
<?php
}
}
/* {/block 'header'} */
/* {block 'form_content'} */
class Block_2714355466935e4f2194308_94918285 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views';
?>
 
						<form method="post" action="<?php echo $_smarty_tpl->getValue('conf')->action_url;?>
calcCalculate">
						<div class="row gtr-uniform">
							<div class="col-12"><input type="text" name="credit" id="name" value="<?php echo $_smarty_tpl->getValue('form')->credit;?>
" placeholder="Kwota"/></div>
							<div class="col-12"><input type="text" name="years" id="email" placeholder="Ilość lat" value="<?php echo $_smarty_tpl->getValue('form')->years;?>
"/></div>
							<div class="col-12"><select name="proc">
								<option style="display: none;" value="">Wybierz oprocentowanie</option>
								<?php
$_smarty_tpl->assign('i', null);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 10+1 - (1) : 1-(10)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
									<option value="<?php echo $_smarty_tpl->getValue('i');?>
" <?php if ($_smarty_tpl->getValue('form')->procent == $_smarty_tpl->getValue('i')) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('i');?>
%</option>
								<?php }
}
?>
							</select></div>
							<div class="col-12">
								<ul class="actions special">
									<li><input type="submit" value="Oblicz" class="primary"/></li>
								</ul>
							</div>
						</div>
					</form>
<?php
}
}
/* {/block 'form_content'} */
/* {block 'side_panel_content'} */
class Block_14262663506935e4f21a9937_21717096 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views';
?>
 
<?php if ((true && (true && null !== ($_smarty_tpl->getValue('result')->result_value ?? null)))) {?>
							<div class="message success">
								<h3 class="icon solid fa-check" >Twoja rata miesięczna</h3>
								<div class="result"><u><?php echo $_smarty_tpl->getValue('result')->result_value;?>
 <?php echo $_smarty_tpl->getValue('result')->currency;?>
</u></div>
							</div>
						<?php }
}
}
/* {/block 'side_panel_content'} */
}
