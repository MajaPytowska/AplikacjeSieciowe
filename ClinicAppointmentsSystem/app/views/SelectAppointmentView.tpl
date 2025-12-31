{extends file="main.tpl"}

{block name="content"}

{include file="messages.tpl"}

<div>
    {if count($appointments) >0}
    {foreach from=$appointments item=appointment}
    <div class="row">
        <h2>{$appointment->date}</h2>
        <h3>{$appointment->startTime}-{$appointment->endTime}</h3>
        <a href="{url action='selectAppointment' param1=$appointment->id}" class="button fit small">Wybierz</a>
    </div>
    {/foreach}
    {else}
        <h2>Brak dostępnych wizyt</h2>
    {/if}
</div>

{/block}