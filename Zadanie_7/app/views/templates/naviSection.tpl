{if !$navConfig->isEmpty()}
<section id="two" class="main special">
	<div class="container">
		<div class="content">
			<div class="row navigation-grid" style="justify-content: center;">
			{if $navConfig->isNavSet()}
				<div class="col-6 col-12-small">
					<h2>{$navConfig->title}</h2>
						<ul class="actions special">
							<li><a href="{$conf->action_url}{$navConfig->action}" class="button primary">Przejdź</a></li>
						</ul>
				</div>
			{/if}
			{if $navConfig->showLogOut}
				<div class="col-6 col-12-small">
					<h2>Koniec na dziś?</h2>
						<ul class="actions special">
							<li><a href="{$conf->action_url}logout" class="button primary">Wyloguj</a></li>
						</ul>
				</div>
			{/if}
			</div>
		</div>
	</div>
</section>
{/if}
