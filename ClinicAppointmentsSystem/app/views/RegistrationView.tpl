{extends file="form_base.tpl"}
{block name="form_content"}
<form method="post" action="{url action='register'}">
	<div class="row gtr-uniform">
		<div class="col-6 col-12-xsmall">
			{include file="form_base_input.tpl" type="text" name="name" id="name" value=($form->user_data->name??null) placeholder="Imię"} 
		</div>
		<div class="col-6 col-12-xsmall">
			{include file="form_base_input.tpl" type="text" name="surname" id="surname" value=($form->user_data->surname??null) placeholder="Nazwisko"} 
		</div>
		<div class="col-12">
			{include file="form_base_input.tpl" type="text" name="pesel" id="pesel" value=($form->user_data->pesel??null) placeholder="PESEL"} 
		</div>
        {*{if \core\RoleUtils::inRole('receptionist')}
		<div class="col-4">
			<input type="radio" id="temporaryUser" name="isTemporaryUser" value="1" {if $form->isTemporaryUser}checked{/if} />
			<label for="temporaryUser">Tymczasowy</label>
		</div>
        {/if}*}
        <div class="col-12">
			{include file="form_base_input.tpl" type="password" name="password" id="password" value="" placeholder="Hasło"} 
        </div>
								
		<div class="col-12">
			<input type="submit" value="Zarejestruj się" class="primary" />
		</div>
	</div>
</form>

{/block}