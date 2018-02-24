<?php
	DEFINE("DB_HOST", "localhost");
	DEFINE("DB_USER", "root");
	DEFINE("DB_PW", "");
	DEFINE("DB_DATABASE", "kochbuch");
	
	session_start();
?>
<html>
	<head>
		<title>Kochbuch</title>
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
			}
			h2 {
				color: darkred;
				text-align: center;
				font-size: 2.5em;
				margin-top: 0px;
			}
			#test {
				margin-top: 15px;
				width: 180px;
				display: inline-block;
			}
			.kategories {
				float: left;
				width: 13%;
				background-color: #ddd;
				position: fixed;
				font-size: 1.5em;
				text-align: center;
			}
			.data {
				width: 66%;
				background-color: #eee;
				padding: 10px;
				margin-left: 17%;
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
				position: relative;
				left: 87%;
				top: 35%;
				width: 13%;
				background-color: #ddd;
				position: fixed;
				font-size: 1.5em;
				text-align: center;
			}
		</style>-->
		
	</head>
	
	<body>
		<?php	
			$insertR = true;
		
			$connection = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_DATABASE) or die("Verbindung konnte nicht hergestellt werden");
			//echo "Datenbankzugriff erfolgreich!<br/>";
			
			//print_r ($_POST);
			$sqlInsertRezepte = 
			"INSERT INTO `rezepte` (`BenutzerID`, `RezeptName`, `Kategorie`, `Dauer`, `Schwierigkeit`, `freigeschaltet`, `deaktiviert`, `Datum`, `BenutzerName`) 
			VALUES ('".$_SESSION["ben_id"]."', '".utf8_decode($_POST["Rezeptname"])."', '".utf8_decode($_POST["Kategorie"])."', 
			'".$_POST["Dauer"]."', '".$_POST["Schwierigkeit"]."', '0', '0', '".date("Y-m-d")."', '".utf8_decode($_SESSION["ben_name"])."');";
			$result = mysqli_query($connection, $sqlInsertRezepte);
			
			$insertR = $result;
			
			if($insertR){
				$sqlSelectRezeptID = "SELECT RezeptID FROM `rezepte` WHERE RezeptName = '".utf8_decode($_POST["Rezeptname"])."';";
				$result = mysqli_query($connection, $sqlSelectRezeptID);	
				$row 	= mysqli_fetch_array($result);
				$rID 	= $row["RezeptID"];
				//echo $sqlSelectRezeptID;
				
				$einheitliste;
				$zutatenliste;
				foreach($_POST["Einheit"] as $counter){
					if($counter == "")
						break;
					$einheitliste[] = utf8_decode($counter);
				}	
				
				foreach($_POST["Zutat"] as $counter){
					if($counter == "")
						break;
					$zutatenliste[] = utf8_decode($counter);
				}	
				
			
				$i = 0;
				$zutaten_DB = "";
				foreach($_POST["Menge"] as $counter){
					if($counter == "")
						break;
					if($i>0)
						$zutaten_DB .= "<br/>";
					$zutaten_DB .= utf8_decode($counter)." ".$einheitliste[$i]." ".$zutatenliste[$i];
					$i++;
				}
				//echo $zutaten_DB;
				
				$sqlInsertZutaten = "INSERT INTO `zutaten` (`RezeptID`, `ZutatName`) 
									VALUES ('".$rID."' , '".$zutaten_DB."');";
				
				$result = mysqli_query($connection, $sqlInsertZutaten);	
				$insertZ = $result;
				
				//echo $sqlInsertZutaten;
				
				$sqlInsertSchritte = "INSERT INTO `schritte` (RezeptID, Schritt)
								VALUES ('".$rID."' ,'".utf8_decode($_POST["anleitung"])."');";
				$result = mysqli_query($connection, $sqlInsertSchritte);	
				$insertS = $result;
				//echo $sqlInsertSchritte;
				
				if($insertR && $insertS && $insertZ){
					echo "<script> alert('Erfolgreich eingetragen!');
					window.location.replace('main.php'); </script>";
				}	
				else{
					echo "<script> alert('Fehler bei der Eingabe!');
					window.location.replace('form_write.php'); </script>";
				}
			}

		?>
	</body>
</html>










