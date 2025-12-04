{extends file="main.tpl"}
{block name=content} 
	<header class="major">
		{block name=header} {/block}
	</header>
	<div class="row" style="justify-content: center;">
	<div class="col-6 col-12-small">
		{block name=form_content} {/block}
	</div>
	{if $hide_header} <!--Pominiecie nagłówka oznacza podjęcie interackji z formularzem - może się to zakończyć wiadomościami błędów lub pokazaniem rezultatu-->
		<div class="col-6 col-12-small">
			{block name=side_panel_content} {/block}
			{include file='messages.tpl'}
		</div>
	{/if}
	</div>								
{/block}