{extends file="form_base.tpl"}
{block name=header} 
	{if isset($user)}
		<span class="icon solid fa-user" >{$user->login}</span>
	{/if}
	<h2>Kalkulator kredytowy</h2>
{/block}


{block name=form_content} 
						<form method="post" action="{$conf->action_url}calcCalculate">
						<div class="row gtr-uniform">
							<div class="col-12"><input type="text" name="credit" id="name" value="{$form->credit}" placeholder="Kwota"/></div>
							<div class="col-12"><input type="text" name="years" id="email" placeholder="Ilość lat" value="{$form->years}"/></div>
							<div class="col-12"><select name="proc">
								<option style="display: none;" value="">Wybierz oprocentowanie</option>
								{for $i=1 to 10}
									<option value="{$i}" {if $form->procent == $i}selected{/if}>{$i}%</option>
								{/for}
							</select></div>
							<div class="col-12">
								<ul class="actions special">
									<li><input type="submit" value="Oblicz" class="primary"/></li>
								</ul>
							</div>
						</div>
					</form>
{/block}

{block name=side_panel_content} 
{if isset($result->result_value)}
							<div class="message success">
								<h3 class="icon solid fa-check" >Twoja rata miesięczna</h3>
								<div class="result"><u>{$result->result_value} {$result->currency}</u></div>
							</div>
						{/if}
{/block}