<?php
/* Smarty version 5.4.5, created on 2026-01-09 08:34:46
  from 'file:ScheduleView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6960af96d695a6_03282323',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e10e99aba6dffa291e14858b14fe8c4bd2243fc8' => 
    array (
      0 => 'ScheduleView.tpl',
      1 => 1767944048,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
))) {
function content_6960af96d695a6_03282323 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_16254522916960af96d19690_70410236', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_16254522916960af96d19690_70410236 extends \Smarty\Runtime\Block
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
    <form method="post" action="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'filterAppointments'), $_smarty_tpl);?>
">
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
    </form>
</div>
<?php }?>

<div class="table-wrapper">
    <table id="scheduleTable" class="alt">
        <thead>
            <tr>
                <th>Data</th>
                <th>Godzina</th>
                <th>Gabinet</th>
                <th>Lekarz</th>
                <?php if ($_smarty_tpl->getValue('isPatient')) {?>
                    <th>Przyczyna wizyty</th>
                <?php } else { ?>
                    <th>Wolny</th>
                <?php }?>
                <th style="width: 10%;">Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('appointments')) == 0) {?>
                <tr>
                    <td colspan="8">No appointments.</td>
                </tr>
            <?php } else { ?>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('appointments'), 'appointment');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('appointment')->value) {
$foreach1DoElse = false;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->getValue('appointment')->date;?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('appointment')->startTime;?>
-<?php echo $_smarty_tpl->getValue('appointment')->endTime;?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('appointment')->officeName;?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('appointment')->doctor->name;?>
 <?php echo $_smarty_tpl->getValue('appointment')->doctor->surname;?>
</td>
                    <?php if ($_smarty_tpl->getValue('isPatient')) {?>
                        <td><?php echo $_smarty_tpl->getValue('appointment')->visitReason;?>
</td>
                    <?php } else { ?>
                        <td><?php echo $_smarty_tpl->getValue('appointment')->isAvailable ? "TAK" : "NIE";?>

                            <?php if (!$_smarty_tpl->getValue('appointment')->isAvailable) {?>
                            <br/>
                            <?php echo $_smarty_tpl->getValue('appointment')->patientName;?>
 <?php echo $_smarty_tpl->getValue('appointment')->patientSurname;?>
 (<?php echo $_smarty_tpl->getValue('appointment')->patientPesel;?>
)
                            <br/>
                            <?php echo $_smarty_tpl->getValue('appointment')->visitReason;?>

                            <?php }?>
                        </td>
                    <?php }?>
                    <td>
                        <?php if ($_smarty_tpl->getValue('isPatient')) {?>
                            <?php if (!$_smarty_tpl->getValue('appointment')->isAvailable) {?>
                                <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'cancelAppointment','param1'=>$_smarty_tpl->getValue('appointment')->id), $_smarty_tpl);?>
">Anuluj</a>
                            <?php }?>
                        <?php } else { ?>
                            <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'deleteAppointment','param1'=>$_smarty_tpl->getValue('appointment')->id), $_smarty_tpl);?>
">Usuń</a>
                            <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'editAppointment','param1'=>$_smarty_tpl->getValue('appointment')->id), $_smarty_tpl);?>
">Edytuj</a>
                            <?php if ($_smarty_tpl->getValue('appointment')->isAvailable == true) {?>
                                <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'bookAppointment','param1'=>$_smarty_tpl->getValue('appointment')->id), $_smarty_tpl);?>
">Umów</a>
                            <?php } else { ?>
                                <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'cancelAppointment','param1'=>$_smarty_tpl->getValue('appointment')->id), $_smarty_tpl);?>
">Anuluj</a>
                            <?php }?>
                        <?php }?>
                    </td>
                </tr>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php }?>
        </tbody>
    </table>
</div>

<?php
}
}
/* {/block "content"} */
}
