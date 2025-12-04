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