{extends file="main.tpl"}

{block name="content"}

{include file="messages.tpl"}

{if !$isPatient}
<div>
    <div class="col-6">
        <a class="button primary small" href="{url action='showNewAppointmentForm'}">Dodaj wizytę</a>
    </div>
</div>

<div class="row">
    <form id="scheduleFilterForm" onsubmit="return false;">
        <div class="col-3">
            <input type="text" id="dateTimeFrom" name="dateTimeFrom" placeholder="Od" value="{$form->dateTimeFrom|escape}" />
        </div>

        <div class="col-3">
            <input type="text" id="dateTimeTo" name="dateTimeTo" placeholder="Do" value="{$form->dateTimeTo|escape}" />
        </div>

        <div class="col-3">
            <select id="doctorId" name="doctorId">
                <option value="">Wszyscy lekarze</option>
                {foreach from=$doctors item=doctor}
                    <option value="{$doctor->id}" {if $form->doctorId == $doctor->id}selected{/if}>
                        {$doctor->name} {$doctor->surname}
                    </option>
                {/foreach}
            </select>
        </div>

        <div class="col-3">
            <select id="appointmentStatus" name="appointmentStatus">
                <option value="" {if $form->appointmentStatus == ''}selected{/if}>Wszystkie wizyty</option>
                <option value="1" {if $form->appointmentStatus == '1'}selected{/if}>Tylko wolne</option>
                <option value="0" {if $form->appointmentStatus == '0'}selected{/if}>Tylko zajęte</option>
            </select>
        </div>

        <div class="col-3">
            <button type="submit" class="button primary">Filtruj</button>
        </div>
        <input type="hidden" id="pageInput" name="page" value="1">
    </form>
</div>
{/if}

<div id="scheduleTableWrapper" class="table-wrapper">
    {include file="ScheduleTable.tpl"}
</div>

{/block}