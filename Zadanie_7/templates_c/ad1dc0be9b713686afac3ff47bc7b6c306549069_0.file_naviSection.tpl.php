<?php
/* Smarty version 5.5.1, created on 2025-12-07 21:34:49
  from 'file:naviSection.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6935e4e978ceb8_71489899',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad1dc0be9b713686afac3ff47bc7b6c306549069' => 
    array (
      0 => 'naviSection.tpl',
      1 => 1765137571,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6935e4e978ceb8_71489899 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_7\\app\\views\\templates';
if (!$_smarty_tpl->getValue('navConfig')->isEmpty()) {?>
<section id="two" class="main special">
	<div class="container">
		<div class="content">
			<div class="row navigation-grid" style="justify-content: center;">
			<?php if ($_smarty_tpl->getValue('navConfig')->isNavSet()) {?>
				<div class="col-6 col-12-small">
					<h2><?php echo $_smarty_tpl->getValue('navConfig')->title;?>
</h2>
						<ul class="actions special">
							<li><a href="<?php echo $_smarty_tpl->getValue('conf')->action_url;
echo $_smarty_tpl->getValue('navConfig')->action;?>
" class="button primary">Przejdź</a></li>
						</ul>
				</div>
			<?php }?>
			<?php if ($_smarty_tpl->getValue('navConfig')->showLogOut) {?>
				<div class="col-6 col-12-small">
					<h2>Koniec na dziś?</h2>
						<ul class="actions special">
							<li><a href="<?php echo $_smarty_tpl->getValue('conf')->action_url;?>
logout" class="button primary">Wyloguj</a></li>
						</ul>
				</div>
			<?php }?>
			</div>
		</div>
	</div>
</section>
<?php }
}
}
