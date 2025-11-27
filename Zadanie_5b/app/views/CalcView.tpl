{extends file="main.tpl"}
{block name=content} 
					<header class="major">
						<h2>Wypełnij formularz</h2>
					</header>
					<div class="row" style="justify-content: center;">
						<form class="col-6 col-12-small" method="post" action="{$conf->action_url}calcCalculate">
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
					{if $hide_header} <!--Pominiecie nagłówka oznacza podjęcie interackji z formularzem - może się to zakończyć wiadomościami błędów lub pokazaniem rezultatu-->
					<div class="col-6 col-12-small">
						{if $messages->isError()}
							<div class="message error">
								<h3 class="icon solid fa-exclamation-triangle" >Błędy</h3>
								<ol>
									{foreach $messages->getErrors() as $msg}
										<li>{$msg}</li>
									{/foreach}
								</ol>
							</div>
						{/if}
						{if isset($result->result_value)}
							<div class="message success">
								<h3 class="icon solid fa-check" >Twoja rata miesięczna</h3>
								<div class="result"><u>{$result->result_value} {$result->currency}</u></div>
							</div>
						{/if}
						{if $messages->isInfo()}
							<div class="message info">
								<h3 class="icon solid fa-bookmark" >Pamiętaj</h3>
								<ol>
									{foreach $messages->getInfos() as $info}
										<li>{$info}</li>
									{/foreach}
								</ol>
							</div>
						{/if}
					</div>
					{/if}
					</div>
{/block}