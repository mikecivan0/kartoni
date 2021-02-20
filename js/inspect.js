$(document).keydown(function(event) {
	if ((event.ctrlKey && (event.keyCode != 65 && event.keyCode != 67 && event.keyCode != 86 && event.keyCode != 90 && event.keyCode != 89 && event.keyCode != 88)) || (event.ctrlKey && event.shiftKey && event.keyCode != 86) || event.keyCode == 123) {
		return false;
		//onemogućavanje ikakvog manipuliranja stranicom, osim ctrl + (a,c,v,x,z,y,shift+v) ili f12
	}
});

$(document).on("contextmenu", function(e) {
	e.preventDefault();
	//onemogućavanje korištenja desnog klika
});
