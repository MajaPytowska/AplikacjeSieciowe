{if !$msgs->isEmpty()}
	<div class="message error">
		<h3 class="icon solid fa-exclamation-triangle" >Błędy</h3>
			<ol>
				{foreach $msgs->getMessages() as $msg}
					<li>{$msg->text}</li>
				{/foreach}
			</ol>
	</div>
{/if}