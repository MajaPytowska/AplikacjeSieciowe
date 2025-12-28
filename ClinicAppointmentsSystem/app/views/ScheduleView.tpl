{extends file="main.tpl"}

{block name="content"}
<div>
    <div class="col-6">
        <select id="doctorSelect" onchange="{url action='loadSchedule' value=this.value}">
            <option value="">Wybierz lekarza</option>
            {foreach from=$doctors item=doctor}
                <option value="{$doctor->id}">{$doctor->name} {$doctor->surname}</option>
            {/foreach}
    </div>
    <div class="col-6">
        <a class="button primary fit small" href="{url action='addAppointment'}">Dodaj wizytę</a>
    </div>
    </div>
<div>
    <table id="scheduleTable">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Office</th>
                <th>Doctor</th>
                <th>Availability</th>
                <th>Patient</th>
                <th>Visit reason</th>
                <th>Actions</th>
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
                    <td>{$appointment->time}</td>
                    <td>{$appointment->office}</td>
                    <td>{$appointment->doctorName}</td>
                    <td>{$appointment->available}</td>
                    <td>{$appointment->patientName}</td>
                    <td>{$appointment->visitReason}</td>
                    <td>
                        <a class="button primary fit small" href="{url action='deleteAppointment' param1=$appointment->id}">Usuń</a>
                        <a class="button primary fit small" href="{url action='editAppointment' param1=$appointment->id}">Edytuj</a>
                        {if $appointment->available == true}
                            <a class="button primary fit small" href="{url action='bookAppointment' param1=$appointment->id}">Umów</a>
                        {else}
                            <a class="button primary fit small" href="{url action='cancelAppointment' param1=$appointment->id}">Anuluj</a>
                        {/if}
                    </td>
                </tr>
            {/foreach}
            {/if}
        </tbody>
</div>
{/block}