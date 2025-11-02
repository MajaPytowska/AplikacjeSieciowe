<?php
/* Smarty version 5.5.1, created on 2025-11-02 00:52:12
  from 'file:C:\xampp\htdocs\Zadanie_3/app/credit_calc_view.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_69069d2cc6a179_77591921',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fee751e12f7ef3848262004cdc30a25b27298613' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Zadanie_3/app/credit_calc_view.html',
      1 => 1762041127,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69069d2cc6a179_77591921 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_3\\app';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_32315333569069d2cc4be81_97586682', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "../templates/main.html", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_32315333569069d2cc4be81_97586682 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_3\\app';
?>
 
					<header class="major">
						<h2>Wypełnij formularz</h2>
					</header>
					<div class="row" style="justify-content: center;">
						<form class="col-6 col-12-small" method="post" action="<?php echo $_smarty_tpl->getValue('app_url');?>
/app/credit_calc.php">
						<div class="row gtr-uniform">
							<div class="col-12"><input type="text" name="credit" id="name" value="<?php echo $_smarty_tpl->getValue('form')['credit'];?>
" placeholder="Kwota"/></div>
							<div class="col-12"><input type="text" name="years" id="email" placeholder="Ilość lat" value="<?php echo $_smarty_tpl->getValue('form')['years'];?>
"/></div>
							<div class="col-12"><select name="proc" id="message">
								<option style="display: none;" value="">Wybierz oprocentowanie</option>
								<?php
$_smarty_tpl->assign('i', null);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 10+1 - (1) : 1-(10)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
									<option value="<?php echo $_smarty_tpl->getValue('i');?>
" <?php if ($_smarty_tpl->getValue('form')['proc'] == $_smarty_tpl->getValue('i')) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('i');?>
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
					<?php if ($_smarty_tpl->getValue('hide_header')) {?> <!--równoważne z informacją że formulaż posiada wprowadzone dane-->
					<div class="col-6 col-12-small">
						<?php if (!( !$_smarty_tpl->hasVariable('messages') || empty($_smarty_tpl->getValue('messages')))) {?>
							<div class="message error">
								<h3 class="icon solid fa-exclamation-triangle" >Błędy</h3>
								<ol>
									<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('messages'), 'msg');
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
						<?php if ((true && ($_smarty_tpl->hasVariable('result') && null !== ($_smarty_tpl->getValue('result') ?? null)))) {?>
							<div class="message success">
								<h3 class="icon solid fa-check" >Twoja rata miesięczna</h3>
								<div class="result"><u><?php echo $_smarty_tpl->getValue('result');?>
 zł</u></div>
							</div>
						<?php }?>
						<?php if (!( !$_smarty_tpl->hasVariable('infos') || empty($_smarty_tpl->getValue('infos')))) {?>
							<div class="message info">
								<h3 class="icon solid fa-bookmark" >Pamiętaj</h3>
								<ol>
									<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('infos'), 'info');
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
						<?php }?>
					</div>
					<?php }?>
					</div>
<?php
}
}
/* {/block 'content'} */
}
