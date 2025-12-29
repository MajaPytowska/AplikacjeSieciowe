<?php
/* Smarty version 5.4.5, created on 2025-12-29 15:22:44
  from 'file:ScheduleView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_69528eb402b0d0_12511899',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e10e99aba6dffa291e14858b14fe8c4bd2243fc8' => 
    array (
      0 => 'ScheduleView.tpl',
      1 => 1767018155,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
))) {
function content_69528eb402b0d0_12511899 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_139005605569528eb3f23d56_22658660', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_139005605569528eb3f23d56_22658660 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>


<?php $_smarty_tpl->renderSubTemplate("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<div>
    <div class="col-6">
        <a class="button primary small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showNewAppointmentForm'), $_smarty_tpl);?>
">Dodaj wizytę</a>
    </div>
</div>
<div class="table-wrapper">
    <table id="scheduleTable" class="alt">
        <thead>
            <tr>
                <th>Data</th>
                <th>Godzina</th>
                <th>Gabinet</th>
                <th>Lekarz</th>
                <th>Wolny</th>
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
                    <td><?php echo $_smarty_tpl->getValue('appointment')->isAvailable ? "TAK" : "NIE";?>
</td>
                    <td>
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
