<?php
/* Smarty version 5.4.5, created on 2026-02-19 20:42:16
  from 'file:ScheduleView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_69976798c05871_89587676',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e10e99aba6dffa291e14858b14fe8c4bd2243fc8' => 
    array (
      0 => 'ScheduleView.tpl',
      1 => 1771530126,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
    'file:ScheduleTable.tpl' => 1,
  ),
))) {
function content_69976798c05871_89587676 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_80210790469976798bbaf09_91762228', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_80210790469976798bbaf09_91762228 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>


<?php $_smarty_tpl->renderSubTemplate("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<?php if (!$_smarty_tpl->getValue('isPatient')) {?>
<div>
    <div class="col-6">
        <a class="button primary small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showNewAppointmentForm'), $_smarty_tpl);?>
">Dodaj wizytę</a>
    </div>
</div>

<div class="row">
    <form id="scheduleFilterForm" onsubmit="return false;">
        <div class="col-3">
            <input type="text" id="dateTimeFrom" name="dateTimeFrom" placeholder="Od" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('form')->dateTimeFrom, ENT_QUOTES, 'UTF-8', true);?>
" />
        </div>

        <div class="col-3">
            <input type="text" id="dateTimeTo" name="dateTimeTo" placeholder="Do" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('form')->dateTimeTo, ENT_QUOTES, 'UTF-8', true);?>
" />
        </div>

        <div class="col-3">
            <select id="doctorId" name="doctorId">
                <option value="">Wszyscy lekarze</option>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('doctors'), 'doctor');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('doctor')->value) {
$foreach0DoElse = false;
?>
                    <option value="<?php echo $_smarty_tpl->getValue('doctor')->id;?>
" <?php if ($_smarty_tpl->getValue('form')->doctorId == $_smarty_tpl->getValue('doctor')->id) {?>selected<?php }?>>
                        <?php echo $_smarty_tpl->getValue('doctor')->name;?>
 <?php echo $_smarty_tpl->getValue('doctor')->surname;?>

                    </option>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </select>
        </div>

        <div class="col-3">
            <select id="appointmentStatus" name="appointmentStatus">
                <option value="" <?php if ($_smarty_tpl->getValue('form')->appointmentStatus == '') {?>selected<?php }?>>Wszystkie wizyty</option>
                <option value="1" <?php if ($_smarty_tpl->getValue('form')->appointmentStatus == '1') {?>selected<?php }?>>Tylko wolne</option>
                <option value="0" <?php if ($_smarty_tpl->getValue('form')->appointmentStatus == '0') {?>selected<?php }?>>Tylko zajęte</option>
            </select>
        </div>

        <div class="col-3">
            <button type="submit" class="button primary">Filtruj</button>
        </div>
        <input type="hidden" id="pageInput" name="page" value="1">
    </form>
</div>
<?php }?>

<div id="scheduleTableWrapper" class="table-wrapper">
    <?php $_smarty_tpl->renderSubTemplate("file:ScheduleTable.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
</div>

<?php
}
}
/* {/block "content"} */
}
