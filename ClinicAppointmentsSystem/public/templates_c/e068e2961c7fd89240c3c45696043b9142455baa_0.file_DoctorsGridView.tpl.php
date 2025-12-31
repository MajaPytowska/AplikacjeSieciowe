<?php
/* Smarty version 5.4.5, created on 2025-12-31 19:34:18
  from 'file:DoctorsGridView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_69556caa1f8367_61228470',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e068e2961c7fd89240c3c45696043b9142455baa' => 
    array (
      0 => 'DoctorsGridView.tpl',
      1 => 1767206024,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69556caa1f8367_61228470 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_80365147569556caa1e2d45_82413039', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_80365147569556caa1e2d45_82413039 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>

<div class="box alt">
	<div class="row gtr-50 gtr-uniform">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('doctors'), 'doctor');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('doctor')->value) {
$foreach0DoElse = false;
?>
		<div class="col-3 col-4-medium col-6-small col-12-xsmall">
            <span class="image fit"><img src="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('asset_url')->handle(array('path'=>($_smarty_tpl->getValue('doctor')->photoUrl ?? "images/pic01.jpg"),'type'=>"images"), $_smarty_tpl);?>
" alt="Zdjęcie dr <?php echo $_smarty_tpl->getValue('doctor')->name;?>
 <?php echo $_smarty_tpl->getValue('doctor')->surname;?>
" /></span>
            <h2><?php echo $_smarty_tpl->getValue('doctor')->name;?>
 <?php echo $_smarty_tpl->getValue('doctor')->surname;?>
</h2>
            <p>Specjalizacja: <br/> <?php echo $_smarty_tpl->getValue('doctor')->specializations;?>
</p>
            <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showDoctorDetails','param1'=>$_smarty_tpl->getValue('doctor')->id), $_smarty_tpl);?>
" class="button fit small">Wybierz</a>
        </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
	</div>
</div>
<?php
}
}
/* {/block "content"} */
}
