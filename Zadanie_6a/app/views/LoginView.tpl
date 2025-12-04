{extends file="form_base.tpl"}

{block name=header} 
	<h2>Zaloguj się do systemu</h2>
{/block}

{block name=form_content} 
	<form method="post" action="{$conf->action_url}login">
		<div class="row gtr-uniform">
			<div class="col-12"><input type="text" name="login" id="username" placeholder="Login"/></div>
			<div class="col-12"><input type="password" name="password" id="password" placeholder="Hasło""/></div>
			<div class="col-12">
				<ul class="actions special">
					<li><input type="submit" value="Zaloguj" class="primary"/></li>
				</ul>
			</div>
		</div>
	</form>
{/block}