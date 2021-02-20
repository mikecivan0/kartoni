function dodajNaListuZaZvati(id) {
	var vrijeme = $("#vrijeme").val();
	var tipTerapije = $("#tipTerapije").val();
	if(!vrijeme){
		swal("Vrijeme dolaska!", "Obavezno unijeti vrijeme dolaska!", "error");
	}else{
		swal({
		title : 'Potvrda unošenja',
		text : 'Želite li doista dodati osobu na listu?',
		type : 'warning',
		showCancelButton : true,
		confirmButtonColor : '#3085d6',
		cancelButtonColor : '#d33',
		confirmButtonText : 'Da, želim!',
		cancelButtonText : 'Ne, odustani!',
		}).then(function(result) {
			if (result.value) {
				$.cookie("vrijeme", vrijeme);
				$.cookie("tipTerapije", tipTerapije);
				$.ajax({
					type : "POST",
					url : "../sql/ajax/lista/unos.php",
					data : "osoba_id=" + $("#hfOsobaId").val() + "&vrijeme=" + $("#vrijeme").val() + "&tipTerapije=" + tipTerapije + 
						   "&nastavno=" + $("#nastavno").val() + "&napomena=" + $("#napomena").val(),
					success : function(vratioServer) {
						if (vratioServer == "Unešeno") {
							window.location = "index.php";
						} else {
							swal('Greška!', vratioServer, 'error');
						}
					}
				});
			}
		});		
	}	
}

