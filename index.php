<?php 
	session_start();
	$_SESSION["Admin"] = false;
	$_SESSION["ben_name"] = "Gast";
?>
<html>
	<head>
		<title>Anmeldung</title>
		<link rel="stylesheet" href="kochbuch_style.css">
		<!--<style>
			body {
				background-color: lightblue;
			}
			h1 {
				color: darkred;				
				text-align: center;
				font-size: 3.5em;
				margin-top: 0px;
				text-shadow: -2px -2px white, 1px 1px #333;
			}
			h2 {
				color: #c66d00;
				text-align: center;
				font-size: 2.3em;
				margin-top: 0px;
				text-shadow: 0 -1px 1px #111, 0 1px 1px #fff;
			}
			#test {
				margin-top: 15px;
				font-size: 20px;
				width: 200px;
				display: inline-block;
			}
			#all {
				margin-top: 100px;
				margin-left: 39.3%;
				width: 20%;
				height: 25%;
			}
			#button2 {
				position: absolute;
				left: 47%;
				padding: 10px 20px;
				font-size: 20px;
				margin-top: 20px;
			}
			#linkguest {
				text-align: center;
				font-size: 1.3em;
			}
		</style>-->
		
	</head>
	
	<body>
		<br/>	
		<h1>Willkommen</h1>
		<h2>Bitte melden Sie sich an!</h2>
			
		<fieldset id="all">
			<legend style="font-size:22px;"><b>Anmeldedaten eintragen</b></legend>
			<form action="main.php" method="post">
				<label id = "test" for = "Username">Benutzername:</label><input type="text" name="Username" required /><br/>
				<label id = "test" for = "Password">Passwort:</label><input type="password" name="Password" required /><br/>					
				
				<input type="submit" value="Anmelden" id = "button2"/>
				<br/><br/><br/><br/><p id="linkguest">Weiter als <a href='main.php'>Gast</a></p>
			</form>
		</fieldset>
	</body>
</html>