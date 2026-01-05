{extends file="form_base.tpl"}
{block name="form_content"}
<form method="post" action="{url action='register'}">
	<div class="row gtr-uniform">
		<div class="col-6 col-12-xsmall">
			<input type="text" name="name" id="name" value="{$form->user_data->name}" placeholder="Imię" />
		</div>
		<div class="col-6 col-12-xsmall">
			<input type="text" name="surname" id="surname" value="{$form->user_data->surname}" placeholder="Nazwisko" />
		</div>
		<div class="col-12">
			<input type="text" name="pesel" id="pesel" value="{$form->user_data->pesel}" placeholder="PESEL" />
		</div>
        {*{if \core\RoleUtils::inRole('receptionist')}
		<div class="col-4">
			<input type="radio" id="temporaryUser" name="isTemporaryUser" value="1" {if $form->isTemporaryUser}checked{/if} />
			<label for="temporaryUser">Tymczasowy</label>
		</div>
        {/if}*}
        <div class="col-12">
			<input type="password" name="password" id="password" placeholder="Hasło" />
		</div>
		<div class="col-12">
			<input type="password" name="confirm_password" id="confirm_password" placeholder="Potwierdź hasło" />
		</div>
		<div class="col-12">
			<input type="submit" value="Zarejestruj się" class="primary" />
		</div>
	</div>
</form>

{/block}