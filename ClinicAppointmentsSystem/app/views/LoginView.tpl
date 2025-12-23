{extends file="form_base.tpl"}
{block name="form_content"}
<form method="post" action="{url action='login'}">
	<div class="row gtr-uniform">
	    <div class="col-12">
			<input type="text" name="login" id="login" value="{$form->login ?? null}" placeholder="Login" />
            {if $msgs->isMessage('login')}
                <label for="login">{$msgs->getMessage('login')->text}</label>
            {/if}
		</div>
		<div class="col-12">
			<input type="password" name="password" id="password" value="" placeholder="Hasło" />
            {if $msgs->isMessage('password')}
                <label for="password">{$msgs->getMessage('password')->text}</label>
            {/if}
		</div>
        {if $msgs->isMessage('general')}
            <div class="col-12">
                {$msgs->getMessage('general')->text}
            </div>	
        {/if}							
		<div class="col-12" style="justify-content: center;">
			<input type="submit" value="Zaloguj się" class="primary"/>
		</div>
        <div class="col-12" style="margin-top:1em;">
            Nie masz konta? <a href="{url action='showRegistrationForm'}">Zarejestruj się</a>
        </div>
	</div>
</form>

{/block}