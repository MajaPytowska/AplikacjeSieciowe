<?php
/* Smarty version 5.4.5, created on 2026-01-02 16:30:52
  from 'file:ScheduleView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6957e4ac07c791_38293040',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e10e99aba6dffa291e14858b14fe8c4bd2243fc8' => 
    array (
      0 => 'ScheduleView.tpl',
      1 => 1767367848,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
))) {
function content_6957e4ac07c791_38293040 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2418794996957e4ac033590_28594660', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_2418794996957e4ac033590_28594660 extends \Smarty\Runtime\Block
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
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('appointment')->value) {
$foreach0DoElse = false;
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
