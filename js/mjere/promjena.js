$(function() {

	//klik na gumb brisanja mjera
	$(".obrisiMjere").click(function(event) {
		event.preventDefault();
		swal({
			title : 'Potvrda brisanja',
			text : 'Ovim postupkom obrisat će se sve mjere ovog pacijenta sa tim datumom. Želite li doista obrisati mjere?',
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
					url : "../sql/ajax/mjere/brisanje.php?osoba_id=" + $("#hfOsobaId").val(),
					data : "id=" + $("#hfMjereId").val(),
					success : function(vratioServer) {
						if (vratioServer == "Mjere obrisane") {
							window.location = $("#putanjaApp").val() + "kartoni/promjena.php?id=" + $("#hfKartonId").val() + "&tab=mjere";
						} else {
							swal('Greška!', vratioServer, 'error');
						}
					}
				});
			}
		});
	});
	
	//promjena fokusa kod učitavanja
	var hfMjera = $("#hfNazivMjere").val();
	var nazivMjere = hfMjera.substring(1, hfMjera.length);     //oduzmi prvo slovo 'l' ili 'd'
	
	
	//mjere koje se nalaze samo sa lijeve strane a nisu 'CFlesh' ili 'ODisanja'
	var mjereZaSmanjitiPrvoSlovo = ['IndSagGibC', 'IndSagGibT', 'IndSagGibL', 'FenomenGumeneLopte', 'FlexCaptEtColi', 
		 					   		'ExtCapitEtColi', 'ExtTrunci', 'RectusAbdom'];
	
	
	if(jQuery.inArray(nazivMjere, mjereZaSmanjitiPrvoSlovo) != -1){ 	//ako je naziv mjere neki od onih koji se nalaze samo lijevo
		var prvoSlovo = nazivMjere.slice(0, 1); 		//izdvoji prvo slovo  
		var ostatakNaziva = nazivMjere.slice(1, nazivMjere.length);   	//izdvoji ostatak naziva
		var maloPrvoSlovo = prvoSlovo.toLowerCase(); 			//smanji prvo slovo	
		var noviNazivMjere = maloPrvoSlovo + ostatakNaziva;
	}else{
		noviNazivMjere = hfMjera;
	}
	
	var mjera = $("#" + noviNazivMjere);
	var roditelj1 = mjera.parent().parent().parent();	
	var roditelj2 = roditelj1.parent();	
	mjera.parent().parent().parent();	
	setTimeout(function() { 
		roditelj2.addClass('active'); 
		roditelj1.addClass('active'); 
		mjera.focus(); }, 
	50);		
	
});
