<?php
	DEFINE("DB_HOST", "localhost");
	DEFINE("DB_USER", "root");
	DEFINE("DB_PW", "");
	DEFINE("DB_DATABASE", "kochbuch");
	
	function createTable($array){
		echo "<table>";
		for($i = 0; $i < count($array); $i++) {
			echo "<tr>";
			for($j = 0; $j < count($array[$i]); $j++) {
				if($i == 0)
					echo "<th style='background-color:tomato;'>{$array[$i][$j]}</th>";
				else if ($j == 1)
					echo "<td style='background-color: #eee;'><a href='main.php?gericht=".$array[$i][$j]."'>".$array[$i][$j]."</a></td>";
				else
					echo "<td style='background-color: #eee;'>{$array[$i][$j]}</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}	
	session_start();

?>
<html>
	<head>
		<title>Marvs Kochbuch</title>
		<meta charset = "utf-8">
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
				width: 180px;
				display: inline-block;
			}
			.kategories {
				position: absolute;
				top: 0;
				height: 100%;
				float: left;
				width: 13%;
				background-color: #e2d17c;
				position: fixed;
				font-size: 1.5em;
				text-align: center;
				min-width: 13%;
			}
			.data {
				width: 66%;
				background-color: #eee;
				padding: 10px;
				margin-left: 17%;
				font-size: 1.3em;
				min-width: 66%;
			}
			td, th {
				border: solid 2px black;
				padding: 3px;
				text-align: center;
				font-size: 1.5em;
				min-width: 200px;
			}

			table {
				border: solid 3px black;
				border-collapse: collapse; 
				margin: 0 auto;
			}
			.bearbeiten{
				position: absolute;
				top: 0;
				height: 100%;
				left: 87%;
				width: 13%;
				background-color: #e2d17c;
				position: fixed;
				font-size: 1.5em;
				text-align: center;
				min-width: 13%;
			}
		</style>-->
		
	</head>
	
	<body>
		<?php
			if(!isset($_SESSION["ben_name"])){
				echo "<script> alert('Zuerst anmelden!'); 
				window.location.replace('index.php'); </script>";
			}			
			$connection = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_DATABASE) or die("Verbindung konnte nicht hergestellt werden");
			//Überprüfung der Anmeldung
			if(isset($_POST["Username"]))
			{
				$username 	= $_POST["Username"];
				$password 	= $_POST["Password"];
				
				$sqlSelect = "SELECT Passwort, Admin, BenutzerID FROM benutzer WHERE BenutzerName = \"" . $username . "\";";
				$result = mysqli_query($connection, $sqlSelect);
				
				$row 	= mysqli_fetch_array($result);			
				$admin 	= $row["Admin"];
				$ben_id	= $row["BenutzerID"];			
				
				if(!($password == $row["Passwort"])){
					echo "<script> alert('Fehler bei der Eingabe!'); 
					window.location.replace('index.php'); </script>";
				}
				else{
					if($admin == 1){
						$_SESSION["Admin"] = true;
						$_SESSION["ben_id"] = $ben_id;
						$_SESSION["ben_name"] = $username;
					}
					else {
						$_SESSION["Admin"] = false;
						$_SESSION["ben_id"] = $ben_id;
						$_SESSION["ben_name"] = $username;
					}
					echo"<script>window.location.replace('main.php'); </script>";
				}						
			}			
			else{
				//Aufbau der Seite 
				echo "<p style='position:absolute; left: 70%;margin-bottom:0px;font-size: 1.4em;'>Willkommen, ".$_SESSION["ben_name"]."<br/></p>";
				if($_SESSION["ben_name"]== "Gast")
					echo "<p><br/><a style='position:absolute; left: 81.8%;margin-bottom:0px;font-size: 1.4em;' href='index.php'>Einloggen</a></p>";
				else
					echo "<p><br/><a style='position:absolute; left: 83%;margin-bottom:0px;font-size: 1.4em;' href='index.php'>Logout</a></p>";			
				echo "<h1>Marvs Kochbuch</h1>";
				
				echo "<div class='kategories'>
					<br/><br/><br/><br/><br/>
					<a href='main.php'>Neueste Rezepte</a><br/><br/>
					<a href='main.php?kategorie=Vorspeise'>Vorspeise</a><br/><br/>
					<a href='main.php?kategorie=Hauptspeise'>Hauptspeise</a><br/><br/>
					<a href='main.php?kategorie=Beilage'>Beilage</a><br/><br/>
					<a href='main.php?kategorie=Nachspeise'>Nachspeise</a><br/><br/>
					<a href='main.php?kategorie=Snack'>Snack</a><br/><br/>
					</div>";
					
				echo "<div class='bearbeiten'>";
				if($_SESSION["ben_name"] != "Gast"){					
						echo "<br/><br/><br/><br/><br/><br/><br/><br/>
						<a href='form_write.php'>Rezept hinzufügen</a><br/><br/>
						<br/><a href='main.php?name=set'>eigene Rezepte</a><br/><br/>";
					if($_SESSION["Admin"])
						echo "<br/><a href='main.php?kategorie=Vorspeise'>Adminbereich</a><br/><br/>";
				}
				echo "<br/></div>";
					
				if(isset($_GET["kategorie"])){
					//Kategorienansicht
					$sqlSelect = "SELECT Kategorie, RezeptName, Dauer, Schwierigkeit FROM rezepte WHERE Kategorie = \"". $_GET["kategorie"]."\";";
					$result = mysqli_query($connection, $sqlSelect);
					$array_data;
					$i = 1;
					$array_data[0] = array("Kategorie", "Gericht", "Dauer(min)", "Schwierigkeit");
					while($row = mysqli_fetch_array($result)){
						$array_data[$i][] = utf8_encode($row["Kategorie"]);
						$array_data[$i][] = utf8_encode($row["RezeptName"]);
						$array_data[$i][] = utf8_encode($row["Dauer"]);
						$array_data[$i][] = utf8_encode($row["Schwierigkeit"]);
						$i++;
					}			
					echo "<div class='data'> <h2>Übersicht Gerichte der Kategorie - ".$_GET["kategorie"]."</h2>";
					createTable($array_data);
					echo "</div>";
				}
				else if(isset($_GET["gericht"])){
					//Gericht-Detailansicht
					$sqlSelect = "SELECT RezeptID, Kategorie, RezeptName, Dauer, Schwierigkeit, Datum, BenutzerName FROM rezepte WHERE RezeptName = \"". utf8_decode($_GET["gericht"])."\";";
					
					$result = mysqli_query($connection, $sqlSelect);
					$array_data;
					$i = 1;
					$array_data[0] = array("Kategorie", "Gericht", "Dauer(min)", "Schwierigkeit", "eingetragen von", "hinzugefügt am");
					while($row = mysqli_fetch_array($result)){
						$array_data[$i][] = utf8_encode($row["Kategorie"]);
						$array_data[$i][] = utf8_encode($row["RezeptName"]);
						$array_data[$i][] = utf8_encode($row["Dauer"]);
						$array_data[$i][] = utf8_encode($row["Schwierigkeit"]);
						$array_data[$i][] = utf8_encode($row["BenutzerName"]);
						$array_data[$i][] = utf8_encode($row["Datum"]);
						$rezeptID = $row["RezeptID"];
						$i++;
					}								
					echo "<div class='data'>
							<h2>Details - ".$_GET["gericht"]."</h2>";
					createTable($array_data);
					
					$sqlSelect = "SELECT ZutatName FROM zutaten WHERE RezeptID = " . $rezeptID . ";";	
					
					$result = mysqli_query($connection, $sqlSelect);
					$row = mysqli_fetch_array($result); 
					echo "<br/><br/><b style='font-size: 1.5em;'>Benötigte Zutaten:</b><br/><br/>
							".utf8_encode($row["ZutatName"]) ."<br/>";

									
					$sqlSelect = "SELECT Schritt FROM schritte WHERE RezeptID = " . $rezeptID . ";";	
					
					$result = mysqli_query($connection, $sqlSelect);
					$row = mysqli_fetch_array($result); 
					
					$anleitung = explode(".", utf8_encode($row["Schritt"]));
					echo "<br/><br/><b style='font-size: 1.5em;'>Anleitung:</b><br/><br/>";
					foreach($anleitung as $schritt){
						if($schritt != "" && $schritt != " ")
							echo $schritt.".<br/>";
					}
					echo "</div>";						
					
				}
				else if(isset($_GET["name"])){
					//eigene Rezepte
					$sqlSelect = "SELECT Kategorie, RezeptName, Dauer, Schwierigkeit, Datum FROM rezepte WHERE BenutzerName = \"".$_SESSION["ben_name"]."\";";
					
					$result = mysqli_query($connection, $sqlSelect);
					$array_data;
					$i = 1;
					$array_data[0] = array("Kategorie", "Gericht", "Dauer(min)", "Schwierigkeit", "hinzugefügt am", "bearbeiten");
					while($row = mysqli_fetch_array($result)){
						$array_data[$i][] = utf8_encode($row["Kategorie"]);
						$array_data[$i][] = utf8_encode($row["RezeptName"]);
						$array_data[$i][] = utf8_encode($row["Dauer"]);
						$array_data[$i][] = utf8_encode($row["Schwierigkeit"]);
						$array_data[$i][] = utf8_encode($row["Datum"]);
						$array_data[$i][] = "<a href='main.php?gericht=".utf8_encode($row["RezeptName"])."'>hier</a>";
						$i++;
					}			
					echo "<div class='data'>
							<h2>Übersicht eigene Gerichte</h2>";
					createTable($array_data);
					echo "</div>";					
				}
				else {
					//Standardauswahl
					$sqlSelect = "SELECT Kategorie, RezeptName, Dauer, Schwierigkeit FROM rezepte;";
					
					$result = mysqli_query($connection, $sqlSelect);
					$array_data;
					$i = 1;
					$array_data[0] = array("Kategorie", "Gericht", "Dauer(min)", "Schwierigkeit");
					while($row = mysqli_fetch_array($result)){
						$array_data[$i][] = utf8_encode($row["Kategorie"]);
						$array_data[$i][] = utf8_encode($row["RezeptName"]);
						$array_data[$i][] = utf8_encode($row["Dauer"]);
						$array_data[$i][] = utf8_encode($row["Schwierigkeit"]);
						$i++;
					}			
					echo "<div class='data'>
							<h2>Übersicht Gerichte</h2>";
					createTable($array_data);
					echo "</div>";
				}					
			}			
		?>
		
	</body>
</html>










