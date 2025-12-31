{extends file="main.tpl"}

{block name="content"}

{include file="messages.tpl"}

<div>
    <div class="col-6">
        <a class="button primary small" href="{url action='showNewAppointmentForm'}">Dodaj wizytę</a>
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
            {if count($appointments) == 0}
                <tr>
                    <td colspan="8">No appointments.</td>
                </tr>
            {else}
            {foreach from=$appointments item=appointment}
                <tr>
                    <td>{$appointment->date}</td>
                    <td>{$appointment->startTime}-{$appointment->endTime}</td>
                    <td>{$appointment->officeName}</td>
                    <td>{$appointment->doctor->name} {$appointment->doctor->surname}</td>
                    <td>{$appointment->isAvailable ? "TAK" : "NIE"}
                        {if !$appointment->isAvailable}
                        <br/>
                        {$appointment->patientName} {$appointment->patientSurname} ({$appointment->patientPesel})
                        <br/>
                        {$appointment->visitReason}
                        {/if}
                    </td>
                    <td>
                        <a class="button primary fit small" href="{url action='deleteAppointment' param1=$appointment->id}">Usuń</a>
                        <a class="button primary fit small" href="{url action='editAppointment' param1=$appointment->id}">Edytuj</a>
                        {if $appointment->isAvailable == true}
                            <a class="button primary fit small" href="{url action='bookAppointment' param1=$appointment->id}">Umów</a>
                        {else}
                            <a class="button primary fit small" href="{url action='cancelAppointment' param1=$appointment->id}">Anuluj</a>
                        {/if}
                    </td>
                </tr>
            {/foreach}
            {/if}
        </tbody>
    </table>
</div>

{/block}