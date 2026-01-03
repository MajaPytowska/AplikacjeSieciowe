<?php
/* Smarty version 5.4.5, created on 2026-01-02 15:49:02
  from 'file:PatientsManView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6957dade64f565_93636725',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '915ebbb720e6a0c263bc98fd3f17be71fe3026ed' => 
    array (
      0 => 'PatientsManView.tpl',
      1 => 1767365339,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
))) {
function content_6957dade64f565_93636725 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6799876746957dade62fea8_22723905', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_6799876746957dade62fea8_22723905 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>


<?php $_smarty_tpl->renderSubTemplate("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<div>
    <div class="col-6">
        <a class="button primary small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showRegistrationForm'), $_smarty_tpl);?>
">Zarejestruj nowego pacjenta</a>
    </div>
</div>
<div class="table-wrapper">
    <table id="patientsTable" class="alt">
        <thead>
            <tr>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>PESEL</th>
                <th>Status konta</th>
                <th style="width: 30%">Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('patients')) == 0) {?>
                <tr>
                    <td colspan="5">Brak pacjentów.</td>
                </tr>
            <?php } else { ?>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('patients'), 'patient');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('patient')->value) {
$foreach0DoElse = false;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->getValue('patient')->name;?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('patient')->surname;?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('patient')->pesel;?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('patient')->status;?>
</td>
                    <td>
                        <?php if ($_smarty_tpl->getValue('isReceptionist')) {?>
                            <?php if ($_smarty_tpl->getValue('patient')->status == 'active') {?>
                                <button class="button fit small disabled" disabled>Deklaracja złożona</button>
                            <?php } else { ?>
                                <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'confirmDeclaration','param1'=>$_smarty_tpl->getValue('patient')->id), $_smarty_tpl);?>
">Potwierdź złożenie deklaracji</a>
                            <?php }?>
                        <?php }?>
                        <?php if ($_smarty_tpl->getValue('isAdmin')) {?>
                            <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'deletePatient','param1'=>$_smarty_tpl->getValue('patient')->id), $_smarty_tpl);?>
">Usuń</a>
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
