$(function() {	
	$("#pacijent").autocomplete({
		source : '../sql/ajax/pacijenti/nadjiOsobuZaListu.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			window.location.replace('izborNalaza.php?id=' + ui.item.id);
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a><b>" + item.prezime + " " + item.ime + ", " + item.godiste + "</b>, MBO <b>" + item.mbo + "</a>").appendTo(ul);
	};
	
});

function brisanjeUnosa(id){
	swal({
		title : 'Potvrda brisanja',
		text : 'Ovim postupkom obrisat će se ovaj unos. Želite li ga doista obrisati?',
		type : 'warning',
		showCancelButton : true,
		confirmButtonColor : '#3085d6',
		cancelButtonColor : '#d33',
		confirmButtonText : 'Da, obriši!',
		cancelButtonText : 'Ne, odustani!',
	}).then(function(result) {
		if (result.value) {
			$.ajax({
				type : "POST",
				url : "../sql/ajax/lista/brisanjeUnosa.php",
				data : "id=" + id,
				success : function(vratioServer) {
					if (vratioServer == "Unos obrisan") {
						window.location = "index.php";
					} else {
						swal('Greška!', vratioServer, 'error');
					}
				}
			});
		}
	});
}

$(".brisanjeListe").on("click", function(){
	swal({
		title : 'Potvrda brisanja',
		text : 'Ovim postupkom obrisat cijela lista. Želite li ju doista obrisati?',
		type : 'warning',
		showCancelButton : true,
		confirmButtonColor : '#3085d6',
		cancelButtonColor : '#d33',
		confirmButtonText : 'Da, obriši!',
		cancelButtonText : 'Ne, odustani!',
	}).then(function(result) {
		if (result.value) {
			$.ajax({
				type : "POST",
				url : "../sql/ajax/lista/brisanjeListe.php",
				data : "id=true",
				success : function(vratioServer) {
					if (vratioServer == "Lista obrisana") {
						window.location = "index.php";
					} else {
						swal('Greška!', vratioServer, 'error');
					}
				}
			});
		}
	});
});


