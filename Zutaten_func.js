var room = 1;
function zutaten() {
	if(room < 16){
		room++;
		var objTo = document.getElementById('zutatenlist')
		var divtest = document.createElement("div");
		//divtest.setAttribute("class", "form-group");
		divtest.setAttribute("class", "form-group removeclass"+room);
		var rdiv = 'removeclass'+room;
		divtest.innerHTML = '<div class="form-group"><input type="number" class="form-control" id="Menge" name="Menge[]" value="" placeholder="Menge" style="margin-left:-8px;margin-right:4px; width:100px;"></div><div class="form-group"><div class="input-group"><select class="form-control" id="Einheit" name="Einheit[]" style="width:110px;margin-right:4px;"><option value="Stück">Stück</option><option value="g">g</option><option value="dg">dg</option><option value="kg">kg</option><option value="TL">TL</option><option value="EL">EL</option><option value="ml">ml</option><option value="Dose">Dose</option><option value="Prise">Prise</option></select></div></div><div class="form-group"><input type="text" class="form-control" id="Zutat" name="Zutat[]" value="" placeholder="Zutat" style="width:200px;margin-right:4px;"></div><div class="form-group"><button type="button" id = "button_plus" onclick="zutaten();">+</button></div>';
		objTo.appendChild(divtest)
	}
}
   function remove_education_fields(rid) {
	   $('.removeclass'+rid).remove();
   }