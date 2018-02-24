<?php 
	session_start();
?>
<html>
	<head>
		<title>Neues Rezept</title>
		<script src="Zutaten_func.js"></script>
		<link rel="stylesheet" href="kochbuch_style.css">
		<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
		<!--<style>
			body {
				background-color: lightblue;
				box-sizing: border-box;
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
				text-align: center;
			}
			#all2 {
				margin-top: 50px;
				margin-left: 10%;
				width: 80%;
				height: 80%;
				min-width: 80%;
			}
			#button {
				padding: 10px 20px;
				margin-top: 20px;
				font-size: 20px;
				position: absolute;
				left:47%;
				top: 86%;
			}
			.form-group{
				height:30px;
				line-height:30px;
				display:inline-block;
				margin-bottom: 7px;
				margin-left: 8px;
				vertical-align:middle;
			}
			.form-control{
				display:inline-block;
				vertical-align:middle;
				display:block;
				height:34px;
				padding:1px 7px;
				font-size:14px;
				border:1px solid #ccc;
				border-radius:4px;
			}
			#button_plus{
				display:inline-block;
				padding: 1px 7px;
				font-size: 20px;
				vertical-align:middle;
				float: right;
				background-color: #4CAF50;
			}
			#zutatenlist {
				position: absolute;
				width: 40%;
				top: 20%;
				left: 34%;
				float: left;
				min-width: 40%;
			}
			#anleitung{
				position: absolute;
				width: 20%;
				top: 20%;
				left: 62%;
				float: left;	
				min-width: 20%;
			}
		</style>-->
		
	</head>
	
	<body>
		<br/>	
		<h1>Neues Rezept hinzufügen</h1>
			
		<fieldset id="all2">
			<legend style="font-size:22px;"><b>Daten eingeben</b></legend>
			<form action="insert.php" method="post">
				
				<br/><label id = "test" for = "Rezeptname">Name des Gerichts:</label><input type="text" name="Rezeptname" style="font-size:20px;width: 200px;font-size:14px;border:1px solid #ccc;border-radius:4px;padding: 4px 2px;" required /><br/><br/>
				<label id = "test" for = "Kategorie" style="width: 196px;">Kategorie:</label><!--<input type="text" name="Kategorie" required /><br/><br/>-->
				<select name="Kategorie" style="width:110px; height:25px; font-size:14px;border:1px solid #ccc;border-radius:4px;height:34px;padding: 4px 2px; display:inline-block;">			
							<option value="Vorspeise">Vorspeise</option>
							<option value="Hauptspeise">Hauptspeise</option>
							<option value="Beilage">Beilage</option>
							<option value="Nachspeise">Nachspeise</option>
							<option value="Snack">Snack</option>
				</select><br/><br/>
				<label id = "test" for = "Dauer">Dauer:</label><input style="text-align:center; width: 110px;font-size:14px;border:1px solid #ccc;border-radius:4px;padding: 4px 2px;" type="number" name="Dauer" required /><br/><br/>
				<label id = "test" for = "Schwierigkeit">Schwierigkeit:</label><input style="font-size:14px;border:1px solid #ccc;border-radius:4px;padding: 4px 2px;text-align:center; width: 110px;" type="number" min=1 max=5 name="Schwierigkeit" required /><br/><br/>
				
					
				<div id="zutatenlist">
					<p style="font-size:22px; margin-top: 0px; margin-bottom: 5px;">&emsp;&emsp;Zutaten eintragen:</p>
					<div class="form-group">
						<input type="number" class="form-control" id="Menge" name="Menge[]" value="" placeholder="Menge" style="width:100px;">
					</div>
					
					<div class="form-group">
						<div class="input-group">
						<select class="form-control" id="Einheit" name="Einheit[]" style="width:110px;">			
							<option value="Stück">Stück</option>
							<option value="g">g</option>
							<option value="dg">dg</option>
							<option value="kg">kg</option>
							<option value="TL">TL</option>
							<option value="EL">EL</option>
							<option value="ml">ml</option>
							<option value="Dose">Dose</option>
							<option value="Prise">Prise</option>
						</select>
						</div>
					</div>
					
					<div class="form-group">
						<input type="text" class="form-control" id="Zutat" name="Zutat[]" value="" placeholder="Zutat" style="width:200px;">
					</div>			
					<div class="form-group">
						<button type="button" id = "button_plus" onclick="zutaten();">+</button>
					</div>
				</div>
						
				<div id="anleitung">
					<p style="font-size:22px; margin-top: 0px; margin-bottom: 7px;">&emsp;&emsp;Anleitung hier eintragen:</p>
					<textarea style="resize: none;" name="anleitung" rows="30" cols="60"></textarea>
				</div>
				
				<p style="font-size: 1.3em; margin-top: 27%; margin-left: 85%;">Zurück zur <a href='main.php'>Hauptseite</a></p>
				
				<input type="submit" value="einfügen" id = "button"/>
			</form>
		</fieldset>
	</body>
</html>