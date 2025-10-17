<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator kredytowy</title>
<link rel="stylesheet" href="<?php print(_APP_ROOT);?>/app/css/general_stylesheet.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css">
</head>
<body>
<div class="main-container">
<h2>Kalkulator kredytowy</h2>
<form action="<?php print(_APP_URL);?>/app/credit_calc.php" method="post" class="pure-form pure-form-stacked">
	<label for="id_credit">Kwota kredytu [zł]: </label>
	<input id="id_credit" type="text" name="credit" value="<?php out($form['credit'])?>"/><br />
	<label for="id_years">Illość lat: </label>
	<input id="id_years" type="text" name="years" value="<?php out($form['years'])?>"/><br />
	<label for="id_op">Oprocentowanie roczne: </label>
	<select id="id_op" name="proc">
	<?php
	echo '<option style="display: none;" value="">Wybierz oprocentowanie</option>';
	for($i=1;$i<=10;$i++){
			echo '<option value="'.$i.'" '.($form['proc'] == $i ? 'selected':'').'>'.$i.'%</option>';
		}
	?>
	</select><br/>
	<input type="submit" value="Oblicz ratę miesięczną" class="pure-button pure-button-primary">
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

<!--wyświetlenie wyniku jeśli istnieje-->
<?php if (isset($result)){ ?>
<div class="base-el message-box" style="background-color: #96C983;">
<?php echo "Rata miesięczna: $result zł"; ?>
</div>
<?php } ?>

<div style="width:90%; margin: 2em auto;">
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>
</div>
</body>
</html>