<?php
/* Smarty version 5.5.1, created on 2025-11-02 00:39:31
  from 'file:C:\xampp\htdocs\Zadanie_3\app\../templates/main.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_69069a33ddb7c7_04153082',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '061fa096e5bc7eb96505bca1be393c9d80d5f613' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Zadanie_3\\app\\../templates/main.html',
      1 => 1762040298,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69069a33ddb7c7_04153082 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_3\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE HTML>
<!--
	Highlights by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title><?php echo (($tmp = $_smarty_tpl->getValue('page_title') ?? null)===null||$tmp==='' ? "Tytuł" ?? null : $tmp);?>
</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<section id="header">
				<header class="major">
					<h1><?php echo $_smarty_tpl->getValue('page_header');?>
</h1>
					<p><?php echo $_smarty_tpl->getValue('page_description');?>
</p>
				</header>
				<div class="container">
					<ul class="actions special">
						<li><a href="#one" class="button primary scrolly">Rozpocznij</a></li>
					</ul>
				</div>
			</section>
		<!-- One -->
			<section id="one" class="main special">
				<div class="container">
					<div class="content">
						<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_187435938569069a33dd3511_52371099', 'content');
?>

					</div>
				</div>
		<!-- Footer -->
			<section id="footer">
				<div class="container">
					<blockquote>
						<strong>Puste kieszenie nigdy nie powstrzymały nikogo przed podjęciem działania.<br/>
						Mogą to zrobić tylko puste głowy i puste serca.</strong><br/>
						      Norman Vincent Peale
					</blockquote>
				</div>
				<footer>
					<ul class="icons">
						<li><a href="" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
						<li><a href="" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="" class="icon brands alt fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="" class="icon solid alt fa-envelope"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>Autor: Maja Pytowska</li><li>Szablon: <a href="https://html5up.net/highlights">HTML5 UP</a></li><li>Grafika tła: AI</a></li>
					</ul>
				</footer>
			</section>

		<!-- Scripts -->
		 <?php if ($_smarty_tpl->getValue('hide_header')) {?>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/scroll_to_calc.js"><?php echo '</script'; ?>
>
		 <?php }?>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/jquery.min.js"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/jquery.scrollex.min.js"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/jquery.scrolly.min.js"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/browser.min.js"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/breakpoints.min.js"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/util.js"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/main.js"><?php echo '</script'; ?>
>         

	</body>
</html><?php }
/* {block 'content'} */
class Block_187435938569069a33dd3511_52371099 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Zadanie_3\\templates';
?>
 <?php
}
}
/* {/block 'content'} */
}
