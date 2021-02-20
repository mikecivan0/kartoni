function razlika(prvi, zadnji) {
    return Math.round((zadnji-prvi)/(1000*60*60*24));
}

$(".spremi").on("click", function() {	

	var odDatuma = $("#odDatuma").val();
	var doDatuma = $("#doDatuma").val();
	
	if(!odDatuma||!doDatuma){
		swal("Datumi!", "Obavezno unijeti oba datuma!", "error");
	}else{
		var odD = new Date(odDatuma);
		var doD = new Date(doDatuma);
		if(odD>doD){
			swal("Greška!", "Prvi datum mora biti manji od drugoga!", "error");
		}else{
			var razlikaDana = razlika(odD,doD);
			if(razlikaDana>14){
				swal("Greška!", "Ne smije biti više od 14 dana razlike između datuma!", "error");
			}else{
				$("#izborDatuma").submit();
			}
		}	
	}
});

