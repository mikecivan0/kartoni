$(function() {	
	var noviDatum = $("#datumMjerenja").val();
	var dijeloviNovogDatuma = noviDatum.split("-")
	var hrvNoviDatum = dijeloviNovogDatuma[2] + "." + dijeloviNovogDatuma[1] + "." + dijeloviNovogDatuma[0] + ".";
	swal('Greška!', 'Mjere sa datumom <b>' + hrvNoviDatum + '</b> su već unešene. Ne možete više puta unijeti mjere sa istim datumom. Ukoliko želite dodati/izmijeniti neke mjere za određeni datum molimo idite na izmjenu mjera sa tim datumom.', 'error');	
});
