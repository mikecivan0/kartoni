$(function() {	
	$("#pacijent").autocomplete({
		source : '../sql/ajax/pacijenti/nadjiOsobu.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			window.location.replace('pacijenti.php?id=' + ui.item.id);
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a><b>" + item.prezime + " " + item.ime + ", " + item.godiste + "</b>, MBO <b>" + item.mbo + "</a>").appendTo(ul);
	};
	
	
	//klik na gumb brisanja osobe
	$(".brisanjePacijenta").click(function(event) {
		event.preventDefault();
		swal({
			title : 'Potvrda brisanja',
			text : 'Ovim postupkom obrisat će se podaci pacijenta. Želite li doista obrisati podatke ovog pacijenta?',
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
					url : "../sql/ajax/pacijenti/brisanje.php",
					data : "osobaId=" + $("#hfOsobaId").val(),
					success : function(vratioServer) {
						if (vratioServer == "Osoba obrisana") {
							window.location = "pacijenti.php";
						} else {
							swal('Greška!', vratioServer, 'error');
						}
					}
				});
			}
		});
	});
	
	//klik na gumb kreiranja kartona
	$(".kreirajKarton").click(function(event) {
		event.preventDefault();
		swal({
			title : 'Potvrda kreiranja',
			text : 'Ovim postupkom kreirat ćete novi prazan karton sa podacima ovog pacijenta. Želite li doista kreirati novi karton za ovog pacijenta?',
			type : 'warning',
			showCancelButton : true,
			confirmButtonColor : '#3085d6',
			cancelButtonColor : '#d33',
			confirmButtonText : 'Da, kreiraj karton!',
			cancelButtonText : 'Ne, odustani!',
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					type : "POST",
					url : "../sql/ajax/kartoni/novi.php",
					data : "osobaId=" + $("#hfOsobaId").val(),
					success : function(vratioServer) {
						if (vratioServer == "Karton kreiran") {
							window.location.href = window.location.href;	
						} else {
							swal('Greška!', vratioServer, 'error');
						}
					}
				});
			}
		});
	});
	
	//klik na gumb osvjezavanja podataka
	$(".osvjezi").click(function() {  
		window.location.href = window.location.href;						
	});
});


