<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator kredytowy</title>
<style>
	body {
      font-family: Verdana, Arial;
    }
	h2 {
		font-weight: bold;
		margin-bottom: 10px;
	}
	.base-el{
		border-radius: 5px;
	}
	.message-box{
		margin: 20px; 
		padding: 10px 10px 10px 30px; 
		width:350px;
	}
	.submit-button{
		background-color:#8dd9cc;
		padding: 10px; 
		border:none;
		margin-top:5px;
	}
	.input-field{
		margin-bottom: 5px;
		padding: 5px;
		border: 1px solid #404040
	}
</style>
</head>
<body>
<h2>Kalkulator kredytowy</h2>
<form action="<?php print(_APP_URL);?>/app/credit_calc.php" method="post">
	<label for="id_credit">Kwota kredytu [zł]: </label>
	<input id="id_credit" type="text" name="credit" class=" base-el input-field" value="<?php if(isset($credit)) print($credit)?>"/><br />
	<label for="id_years">Illość lat: </label>
	<input id="id_years" type="text" name="years" class=" base-el input-field" value="<?php if(isset($years)) print($years)?>"/><br />
	<label for="id_op">Oprocentowanie roczne: </label>
	<select id="id_op" name="proc" class="base-el input-field">
	<?php
	echo '<option style="display: none;" value="">Wybierz oprocentowanie</option>';
	for($i=1;$i<=10;$i++){
			echo '<option value="'.$i.'" '.($proc == $i ? 'selected':'').'>'.$i.'%</option>';
		}
	?>
	</select><br/>
	<input type="submit" value="Oblicz ratę miesięczną" class=" base-el submit-button">
</form>	

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	echo '<ol class="base-el message-box" style="background-color: #ED8B84;">';
		foreach ( $messages as $msg ) {
			echo "<li>$msg</li>";
		}
	echo '</ol>';
}
?>

<?php if (isset($result)){ ?>
<div class="base-el message-box" style="background-color: #96C983;">
<?php echo "Rata miesięczna: $result zł"; ?>
</div>
<?php } ?>

</body>
</html>