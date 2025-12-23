<!DOCTYPE HTML>
<html>
	<head>
		<title>{$page_title|default:"Tytuł"}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index.html">Przychodnia</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="index.html">Strona główna</a></li>
											{if \core\RoleUtils::inRole("admin")}
												<li><a href="">Recepcjoniści</a></li>
												<li><a href="">Pacjenci</a></li>
											{elseif \core\RoleUtils::inRole("receptionist")}
												<li><a href="">Harmonogram</a></li>
												<li><a href="">Pacjenci</a></li>
												<li><a href="">Lekarze</a></li>
												<li><a href="">Predefiniowane przyczyny wizyt</a></li>
											{elseif \core\RoleUtils::inRole('patient')}
												<li><a href="">Moje konto</a></li>
												<li><a href="">Moje wizyty</a></li>
												<li><a href="">Umów wizytę</a></li>
											{/if}

											{if \core\RoleUtils::inAnyRole()}
												<li><a href="{url action="logout"}">Wyloguj</a></li>
											{else}
												<li><a href="{url action="login"}">Zaloguj</a></li>
												<li><a href="">Nasi Lekarze</a></li>
											{/if}

											<li><a href="elements.html">Elements</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<article id="main">
						{if $page_header}
							<header>
								<h2>{$page_header}</h2>
								<p>{$page_description}</p>
							</header>
						{/if}
						<section class="wrapper style5">
							<div class="inner">
								{block name="content"}{/block}
							</div>
						</section>
					</article>

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>