<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Logowanie</title>
	<link rel="stylesheet" href="<?php print(_APP_ROOT);?>/app/css/general_stylesheet.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css">
</head>
<body>

<div class="main-container">

<form action="<?php print(_APP_ROOT); ?>/app/security/login.php" method="post" class="pure-form pure-form-stacked">
	<legend>Logowanie</legend>
	<fieldset>
		<label for="id_login">Login: </label>
		<input id="id_login" type="text" name="login" value="<?php out($form['login']); ?>" />
		<label for="id_pass">Password: </label>
		<input id="id_pass" type="password" name="pass" />
	</fieldset>
	<input type="submit" value="zaloguj" class="pure-button pure-button-primary"/>
</form>	

<!--wyświeltenie listy błędów, jeśli istnieją-->
<?php
if (!empty( $messages )) {
	echo '<ol class="base-el message-box" style="background-color: #ED8B84;">';
		foreach ( $messages as $msg ) {
			echo "<li>$msg</li>";
		}
	echo '</ol>';
}
?>

</div>

</body>
</html>