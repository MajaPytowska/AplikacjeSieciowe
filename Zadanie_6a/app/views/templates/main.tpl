<!DOCTYPE HTML>
<!--
	Highlights by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>{$page_title|default:"Tytuł"}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{$conf->app_url}/assets/css/main.css" />
	</head>
	<body>
		<!-- Header -->
			<section id="header">
				<header class="major">
					<h1>{$page_header}</h1>
					<p>{$page_description}</p>
				</header>
				<div class="container">
					<ul class="actions special">
						<li><a href="#one" class="button primary scrolly">Rozpocznij</a></li>
					</ul>
				</div>
			</section>
		<!-- One -->
			<section id="one" class="main special">
				<div class="container">
					<div class="content">
						{block name=content} {/block}
					</div>
				</div>
			</section>
		<!-- Logout Section -->
			{if !$loginView}
				<section id="two" class="main special">
					<div class="container">
						<div class="content">
							<h2>Koniec na dziś?</h2>
							<ul class="actions special">
								<li><a href="{$conf->action_url}logout" class="button primary">Wyloguj</a></li>
							</ul>
						</div>
					</div>
				</section>
			{/if}
		<!-- Footer -->
			<section id="footer">
				<div class="container">
					<blockquote>
						<strong>Puste kieszenie nigdy nie powstrzymały nikogo przed podjęciem działania.<br/>
						Mogą to zrobić tylko puste głowy i puste serca.</strong><br/>
						      Norman Vincent Peale
					</blockquote>
				</div>
				<footer>
					<ul class="icons">
						<li><a href="" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
						<li><a href="" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="" class="icon brands alt fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="" class="icon solid alt fa-envelope"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>Autor: Maja Pytowska</li><li>Szablon: <a href="https://html5up.net/highlights">HTML5 UP</a></li><li>Grafika tła: AI</a></li>
					</ul>
				</footer>
			</section>

		<!-- Scripts -->
		 {if $hide_header}
			<script src="{$conf->app_url}/assets/js/scroll_to_calc.js"></script>
		 {/if}
			<script src="{$conf->app_url}/assets/js/jquery.min.js"></script>
			<script src="{$conf->app_url}/assets/js/jquery.scrollex.min.js"></script>
			<script src="{$conf->app_url}/assets/js/jquery.scrolly.min.js"></script>
			<script src="{$conf->app_url}/assets/js/browser.min.js"></script>
			<script src="{$conf->app_url}/assets/js/breakpoints.min.js"></script>
			<script src="{$conf->app_url}/assets/js/util.js"></script>
			<script src="{$conf->app_url}/assets/js/main.js"></script>         

	</body>
</html>