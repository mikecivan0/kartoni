$(function() {	
	$("div.panel").each(function(){		
		$(this).hover(
			function() { $(this).addClass("izabraniKarton"); },
			function() { $(this).removeClass("izabraniKarton"); }
		);
	});
});

function kreirajNalaz(nalaz_id) {
	var prvaTh = $("#datumPT").val();
	var zadnjaTh = $("#datumZT").val();
	if(!prvaTh||!zadnjaTh){
		swal("Datumi terapija!", "Obavezno unijeti datum prve i zadnje terapije!", "error");
	}else{
		var pt = new Date(prvaTh);
		var zt = new Date(zadnjaTh);
		if(pt>zt){
			swal("Greška!", "Datum prve terapije mora biti manji od datuma zadnje terapije!", "error");
		}else{
			if(razlika(pt,zt)>30){
				swal("Greška!", "Ne smije biti više od 30 dana razlike između datuma prve i zadnje terapije!", "error");
			}else{
				swal({
				title : 'Potvrda kreiranja kartona',
				text : 'Želite li doista kreirati karton prema ovom nalazu?',
				type : 'warning',
				showCancelButton : true,
				confirmButtonColor : '#3085d6',
				cancelButtonColor : '#d33',
				confirmButtonText : 'Da, želim!',
				cancelButtonText : 'Ne, odustani!',
				}).then(function(result) {
					if (result.value) {
						$.cookie("datumPT", prvaTh);
						$.cookie("datumZT", zadnjaTh);
						window.location.href = $("#putanjaApp").val() + "kartoni/kreirajKartonPoNalazu.php?nalaz_id=" + nalaz_id + 
												"&osoba_id=" + $("#hfOsobaId").val() + "&prvaTh=" + prvaTh + "&zadnjaTh=" + zadnjaTh;	
					}
				});
			}
		}	
	}
	
}



function razlika(prvi, zadnji) {
    return Math.round((zadnji-prvi)/(1000*60*60*24));
}