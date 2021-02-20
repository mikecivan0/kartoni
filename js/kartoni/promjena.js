$(document).ready(function() {
  if (sessionStorage.scrollTop != "undefined") {
    $(window).scrollTop(sessionStorage.scrollTop);
	sessionStorage.scrollTop = "undefined";
  }
});

$(function() {

	//klik na gumb brisanja kartona
	$(".brisanjeKartona").click(function(event) {
		event.preventDefault();
		swal({
			title : 'Potvrda brisanja',
			text : 'Ovim postupkom obrisat će se prikazani karton i sve terapije koje su upisane u njega. Želite li doista obrisati ovaj karton?',
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
					url : "../sql/ajax/kartoni/brisanje.php",
					data : "kartonId=" + $("#hfKartonId").val(),
					success : function(vratioServer) {
						if (vratioServer == "Karton obrisan") {
							window.location = "index.php";
						} else {
							swal('Greška!', vratioServer, 'error');
						}
					}
				});
			}
		});
	});
	
	//klik na gumb kopiranja kartona
	$(".kopiranje").click(function(event) {
		event.preventDefault();
		swal({
			title : 'Potvrda kopiranja',
			text : 'Ovim postupkom kopirat će se "Osnovni podaci" i "Ostali podaci" ovog kartona u novi karton. Želite li doista kopirati ovaj karton?',
			type : 'warning',
			showCancelButton : true,
			confirmButtonColor : '#3085d6',
			cancelButtonColor : '#d33',
			confirmButtonText : 'Da, kopiraj!',
			cancelButtonText : 'Ne, odustani!',
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					type : "POST",
					url : "../sql/ajax/kartoni/kopiranje.php",
					data : "kartonId=" + $("#hfKartonId").val(),
					success : function(vratioServer) {
						var odgovor = vratioServer.split("/");
						if (odgovor[0] == "Karton kopiran") {
							window.location = location.pathname + '?id=' + odgovor[1];	
						} else {
							swal('Greška!', vratioServer, 'error');
						}
					}
				});
			}
		});
	});

	//klik na gumb unosa seta terapija
	$(".unosTerapija").click(function(event) {
		event.preventDefault();
		var pt = $("#datumPrveTerapije").val();
		var zt = $("#datumZadnjeTerapije").val();
		$.ajax({
			type : "POST",
			url : "../sql/ajax/terapije/noviSetTerapija.php",
			data : "kartonId=" + $("#hfKartonId").val() + "&datumPrveTerapije=" + pt + "&datumZadnjeTerapije=" + zt,
			success : function(vratioServer) {
				if (vratioServer == "Unešeno") {
					$.cookie("datumPrveTh", pt);
					$.cookie("datumZadnjeTh", zt);
					formKartonaAction('datumiTerapija');
					$("#formKartona").submit();
				} else {
					swal('Greška!', vratioServer, 'error');
				}
			}
		});
	});

	//klik na gumb unosa mjera
	$(".unesiMjere").click(function(event) {
		if($("#datumMjerenja").val()){
			event.preventDefault();
			$.ajax({
				type : "POST",
				url : "../sql/ajax/kartoni/noveMjere.php?id=" + $("#hfKartonId").val(),
				data : "hfOsobaId=" + $("#hfOsobaId").val() + "&datum=" + $("#datumMjerenja").val() + "&bolesnaStrana=" + $("#bolesnaStrana").val() + "&lPolazisteDeltoideusa=" + $("#lPolazisteDeltoideusa").val() + "&dPolazisteDeltoideusa=" + $("#dPolazisteDeltoideusa").val() + "&lHvatisteDeltoideusa=" + $("#lHvatisteDeltoideusa").val() + "&dHvatisteDeltoideusa=" + $("#dHvatisteDeltoideusa").val() + "&lSredinaNadlaktice=" + $("#lSredinaNadlaktice").val() + "&dSredinaNadlaktice=" + $("#dSredinaNadlaktice").val() + "&lPrekoOlekranona=" + $("#lPrekoOlekranona").val() + "&dPrekoOlekranona=" + $("#dPrekoOlekranona").val() + "&lPrekoSredinePodlaktice=" + $("#lPrekoSredinePodlaktice").val() + "&dPrekoSredinePodlaktice=" + $("#dPrekoSredinePodlaktice").val() + "&lPrekoRucnogZgloba=" + $("#lPrekoRucnogZgloba").val() + "&dPrekoRucnogZgloba=" + $("#dPrekoRucnogZgloba").val() + "&lPrekoMetacarpusa=" + $("#lPrekoMetacarpusa").val() + "&dPrekoMetacarpusa=" + $("#dPrekoMetacarpusa").val() + "&lOPrsta=" + $("#lOPrsta").val() + "&dOPrsta=" + $("#dOPrsta").val() + "&l15IznadPatele=" + $("#l15IznadPatele").val() + "&d15IznadPatele=" + $("#d15IznadPatele").val() + "&lPrekoPatele=" + $("#lPrekoPatele").val() + "&dPrekoPatele=" + $("#dPrekoPatele").val() + "&l15IspodPatele=" + $("#l15IspodPatele").val() + "&d15IspodPatele=" + $("#d15IspodPatele").val() + "&lPrekoMaleola=" + $("#lPrekoMaleola").val() + "&dPrekoMaleola=" + $("#dPrekoMaleola").val() + "&lPrekoPete=" + $("#lPrekoPete").val() + "&dPrekoPete=" + $("#dPrekoPete").val() + "&lPrekoDorsumaStopala=" + $("#lPrekoDorsumaStopala").val() + "&dPrekoDorsumaStopala=" + $("#dPrekoDorsumaStopala").val() + "&CFlesh=" + $("#CFlesh").val() + "&indSagGibC=" + $("#indSagGibC").val() + "&lLatFleksC=" + $("#lLatFleksC").val() + "&dLatFleksC=" + $("#dLatFleksC").val() + "&lRotacijaC=" + $("#lRotacijaC").val() + "&dRotacijaC=" + $("#dRotacijaC").val() + "&indSagGibT=" + $("#indSagGibT").val() + "&ODisanja=" + $("#ODisanja").val() + "&indSagGibL=" + $("#indSagGibL").val() + "&lLatFlexTrupa=" + $("#lLatFlexTrupa").val() + "&dLatFlexTrupa=" + $("#dLatFlexTrupa").val() + "&lZnakTetiveNaLuku=" + $("#lZnakTetiveNaLuku").val() + "&dZnakTetiveNaLuku=" + $("#dZnakTetiveNaLuku").val() + "&fenomenGumeneLopte=" + $("#fenomenGumeneLopte").val() + "&lRameAbd=" + $("#lRameAbd").val() + "&dRameAbd=" + $("#dRameAbd").val() + "&lRameElev=" + $("#lRameElev").val() + "&dRameElev=" + $("#dRameElev").val() + "&lRameAnt=" + $("#lRameAnt").val() + "&dRameAnt=" + $("#dRameAnt").val() + "&lRameRet=" + $("#lRameRet").val() + "&dRameRet=" + $("#dRameRet").val() + "&lRameURot=" + $("#lRameURot").val() + "&dRameURot=" + $("#dRameURot").val() + "&lRameVRot=" + $("#lRameVRot").val() + "&dRameVRot=" + $("#dRameVRot").val() + "&lRameHorAbd=" + $("#lRameHorAbd").val() + "&dRameHorAbd=" + $("#dRameHorAbd").val() + "&lRameHorAdd=" + $("#lRameHorAdd").val() + "&dRameHorAdd=" + $("#dRameHorAdd").val() + "&lLakatExt=" + $("#lLakatExt").val() + "&dLakatExt=" + $("#dLakatExt").val() + "&lLakatFlex=" + $("#lLakatFlex").val() + "&dLakatFlex=" + $("#dLakatFlex").val() + "&lSupinacija=" + $("#lSupinacija").val() + "&dSupinacija=" + $("#dSupinacija").val() + "&lPronacija=" + $("#lPronacija").val() + "&dPronacija=" + $("#dPronacija").val() + "&lVolarFlex=" + $("#lVolarFlex").val() + "&dVolarFlex=" + $("#dVolarFlex").val() + "&lDorsalFlex=" + $("#lDorsalFlex").val() + "&dDorsalFlex=" + $("#dDorsalFlex").val() + "&lAbdUln=" + $("#lAbdUln").val() + "&dAbdUln=" + $("#dAbdUln").val() + "&lAbdRad=" + $("#lAbdRad").val() + "&dAbdRad=" + $("#dAbdRad").val() + "&lRPalacAbd=" + $("#lRPalacAbd").val() + "&dRPalacAbd=" + $("#dRPalacAbd").val() + "&lRPalacAdd=" + $("#lRPalacAdd").val() + "&dRPalacAdd=" + $("#dRPalacAdd").val() + "&lRPalacFlex=" + $("#lRPalacFlex").val() + "&dRPalacFlex=" + $("#dRPalacFlex").val() + "&lRPalacExt=" + $("#lRPalacExt").val() + "&dRPalacExt=" + $("#dRPalacExt").val() + "&lRPalac1ZglFlex=" + $("#lRPalac1ZglFlex").val() + "&dRPalac1ZglFlex=" + $("#dRPalac1ZglFlex").val() + "&lRPalacOpozicija=" + $("#lRPalacOpozicija").val() + "&dRPalacOpozicija=" + $("#dRPalacOpozicija").val() + "&lR2Pr1ZglExt=" + $("#lR2Pr1ZglExt").val() + "&dR2Pr1ZglExt=" + $("#dR2Pr1ZglExt").val() + "&lR2Pr1ZglFlex=" + $("#lR2Pr1ZglFlex").val() + "&dR2Pr1ZglFlex=" + $("#dR2Pr1ZglFlex").val() + "&lR2Pr2ZglFlex=" + $("#lR2Pr2ZglFlex").val() + "&dR2Pr2ZglFlex=" + $("#dR2Pr2ZglFlex").val() + "&lR2Pr3ZglFlex=" + $("#lR2Pr3ZglFlex").val() + "&dR2Pr3ZglFlex=" + $("#dR2Pr3ZglFlex").val() + "&lR3Pr1ZglExt=" + $("#lR3Pr1ZglExt").val() + "&dR3Pr1ZglExt=" + $("#dR3Pr1ZglExt").val() + "&lR3Pr1ZglFlex=" + $("#lR3Pr1ZglFlex").val() + "&dR3Pr1ZglFlex=" + $("#dR3Pr1ZglFlex").val() + "&lR3Pr2ZglFlex=" + $("#lR3Pr2ZglFlex").val() + "&dR3Pr2ZglFlex=" + $("#dR3Pr2ZglFlex").val() + "&lR3Pr3ZglFlex=" + $("#lR3Pr3ZglFlex").val() + "&dR3Pr3ZglFlex=" + $("#dR3Pr3ZglFlex").val() + "&lR4Pr1ZglExt=" + $("#lR4Pr1ZglExt").val() + "&dR4Pr1ZglExt=" + $("#dR4Pr1ZglExt").val() + "&lR4Pr1ZglFlex=" + $("#lR4Pr1ZglFlex").val() + "&dR4Pr1ZglFlex=" + $("#dR4Pr1ZglFlex").val() + "&lR4Pr2ZglFlex=" + $("#lR4Pr2ZglFlex").val() + "&dR4Pr2ZglFlex=" + $("#dR4Pr2ZglFlex").val() + "&lR4Pr3ZglFlex=" + $("#lR4Pr3ZglFlex").val() + "&dR4Pr3ZglFlex=" + $("#dR4Pr3ZglFlex").val() + "&lR5Pr1ZglExt=" + $("#lR5Pr1ZglExt").val() + "&dR5Pr1ZglExt=" + $("#dR5Pr1ZglExt").val() + "&lR5Pr1ZglFlex=" + $("#lR5Pr1ZglFlex").val() + "&dR5Pr1ZglFlex=" + $("#dR5Pr1ZglFlex").val() + "&lR5Pr2ZglFlex=" + $("#lR5Pr2ZglFlex").val() + "&dR5Pr2ZglFlex=" + $("#dR5Pr2ZglFlex").val() + "&lR5Pr3ZglFlex=" + $("#lR5Pr3ZglFlex").val() + "&dR5Pr3ZglFlex=" + $("#dR5Pr3ZglFlex").val() + "&lKukFlexIsprKoljeno=" + $("#lKukFlexIsprKoljeno").val() + "&dKukFlexIsprKoljeno=" + $("#dKukFlexIsprKoljeno").val() + "&lKukFlexSavKoljeno=" + $("#lKukFlexSavKoljeno").val() + "&dKukFlexSavKoljeno=" + $("#dKukFlexSavKoljeno").val() + "&lKukExt=" + $("#lKukExt").val() + "&dKukExt=" + $("#dKukExt").val() + "&lKukAbd=" + $("#lKukAbd").val() + "&dKukAbd=" + $("#dKukAbd").val() + "&lKukAdd=" + $("#lKukAdd").val() + "&dKukAdd=" + $("#dKukAdd").val() + "&lKukUnRot=" + $("#lKukUnRot").val() + "&dKukUnRot=" + $("#dKukUnRot").val() + "&lKukVanRot=" + $("#lKukVanRot").val() + "&dKukVanRot=" + $("#dKukVanRot").val() + "&lKoljFlex=" + $("#lKoljFlex").val() + "&dKoljFlex=" + $("#dKoljFlex").val() + "&lKoljExt=" + $("#lKoljExt").val() + "&dKoljExt=" + $("#dKoljExt").val() + "&lSkZglDorFlex=" + $("#lSkZglDorFlex").val() + "&dSkZglDorFlex=" + $("#dSkZglDorFlex").val() + "&lSkZglPlanFlex=" + $("#lSkZglPlanFlex").val() + "&dSkZglPlanFlex=" + $("#dSkZglPlanFlex").val() + "&lSkZglEver=" + $("#lSkZglEver").val() + "&dSkZglEver=" + $("#dSkZglEver").val() + "&lSkZglInv=" + $("#lSkZglInv").val() + "&dSkZglInv=" + $("#dSkZglInv").val() + "&lNPalac1ZglExt=" + $("#lNPalac1ZglExt").val() + "&dNPalac1ZglExt=" + $("#dNPalac1ZglExt").val() + "&lNPalac1ZglFlex=" + $("#lNPalac1ZglFlex").val() + "&dNPalac1ZglFlex=" + $("#dNPalac1ZglFlex").val() + "&lNPalac2ZglFlex=" + $("#lNPalac2ZglFlex").val() + "&dNPalac2ZglFlex=" + $("#dNPalac2ZglFlex").val() + "&lOrbOr=" + encodeURIComponent($("#lOrbOr").val()) + "&dOrbOr=" + encodeURIComponent($("#dOrbOr").val()) + "&lOrbOc=" + encodeURIComponent($("#lOrbOc").val()) + "&dOrbOc=" + encodeURIComponent($("#dOrbOc").val()) + "&lZyg=" + encodeURIComponent($("#lZyg").val()) + "&dZyg=" + encodeURIComponent($("#dZyg").val()) + "&lFront=" + encodeURIComponent($("#lFront").val()) + "&dFront=" + encodeURIComponent($("#dFront").val()) + "&flexCapitEtColi=" + encodeURIComponent($("#flexCapitEtColi").val()) + "&extCapitEtColi=" + encodeURIComponent($("#extCapitEtColi").val()) + "&rectusAbdom=" + encodeURIComponent($("#rectusAbdom").val()) + "&extTrunci=" + encodeURIComponent($("#extTrunci").val()) + "&lObliquiAbd=" + encodeURIComponent($("#lObliquiAbd").val()) + "&dObliquiAbd=" + encodeURIComponent($("#dObliquiAbd").val()) + "&lFlexLatTrunci=" + encodeURIComponent($("#lFlexLatTrunci").val()) + "&dFlexLatTrunci=" + encodeURIComponent($("#dFlexLatTrunci").val()) + "&lIliopsoas=" + encodeURIComponent($("#lIliopsoas").val()) + "&dIliopsoas=" + encodeURIComponent($("#dIliopsoas").val()) + "&lGlutMax=" + encodeURIComponent($("#lGlutMax").val()) + "&dGlutMax=" + encodeURIComponent($("#dGlutMax").val()) + "&lAddCoxae=" + encodeURIComponent($("#lAddCoxae").val()) + "&dAddCoxae=" + encodeURIComponent($("#dAddCoxae").val()) + "&lGlutMed=" + encodeURIComponent($("#lGlutMed").val()) + "&dGlutMed=" + encodeURIComponent($("#dGlutMed").val()) + "&lRotIntCoxae=" + encodeURIComponent($("#lRotIntCoxae").val()) + "&dRotIntCoxae=" + encodeURIComponent($("#dRotIntCoxae").val()) + "&lTenFasLat=" + encodeURIComponent($("#lTenFasLat").val()) + "&dTenFasLat=" + encodeURIComponent($("#dTenFasLat").val()) + "&lRotExtCoxae=" + encodeURIComponent($("#lRotExtCoxae").val()) + "&dRotExtCoxae=" + encodeURIComponent($("#dRotExtCoxae").val()) + "&lSartorius=" + encodeURIComponent($("#lSartorius").val()) + "&dSartorius=" + encodeURIComponent($("#dSartorius").val()) + "&lBicFem=" + encodeURIComponent($("#lBicFem").val()) + "&dBicFem=" + encodeURIComponent($("#dBicFem").val()) + "&lSemEtSem=" + encodeURIComponent($("#lSemEtSem").val()) + "&dSemEtSem=" + encodeURIComponent($("#dSemEtSem").val()) + "&lQuadFem=" + encodeURIComponent($("#lQuadFem").val()) + "&dQuadFem=" + encodeURIComponent($("#dQuadFem").val()) + "&lGastroc=" + encodeURIComponent($("#lGastroc").val()) + "&dGastroc=" + encodeURIComponent($("#dGastroc").val()) + "&lSoleus=" + encodeURIComponent($("#lSoleus").val()) + "&dSoleus=" + encodeURIComponent($("#dSoleus").val()) + "&lTibAnt=" + encodeURIComponent($("#lTibAnt").val()) + "&dTibAnt=" + encodeURIComponent($("#dTibAnt").val()) + "&lTibPost=" + encodeURIComponent($("#lTibPost").val()) + "&dTibPost=" + encodeURIComponent($("#dTibPost").val()) + "&lPer=" + encodeURIComponent($("#lPer").val()) + "&dPer=" + encodeURIComponent($("#dPer").val()) + "&lLumbEtInterPed=" + encodeURIComponent($("#lLumbEtInterPed").val()) + "&dLumbEtInterPed=" + encodeURIComponent($("#dLumbEtInterPed").val()) + "&lFlexDigBre=" + encodeURIComponent($("#lFlexDigBre").val()) + "&dFlexDigBre=" + encodeURIComponent($("#dFlexDigBre").val()) + "&lFlexDigLon=" + encodeURIComponent($("#lFlexDigLon").val()) + "&dFlexDigLon=" + encodeURIComponent($("#dFlexDigLon").val()) + "&lExtDigLon=" + encodeURIComponent($("#lExtDigLon").val()) + "&dExtDigLon=" + encodeURIComponent($("#dExtDigLon").val()) + "&lExtDigCom=" + encodeURIComponent($("#lExtDigCom").val()) + "&dExtDigCom=" + encodeURIComponent($("#dExtDigCom").val()) + "&lFlexHalLon=" + encodeURIComponent($("#lFlexHalLon").val()) + "&dFlexHalLon=" + encodeURIComponent($("#dFlexHalLon").val()) + "&lFlexHalBre=" + encodeURIComponent($("#lFlexHalBre").val()) + "&dFlexHalBre=" + encodeURIComponent($("#dFlexHalBre").val()) + "&lExtHalLon=" + encodeURIComponent($("#lExtHalLon").val()) + "&dExtHalLon=" + encodeURIComponent($("#dExtHalLon").val()) + "&lSerrAnt=" + encodeURIComponent($("#lSerrAnt").val()) + "&dSerrAnt=" + encodeURIComponent($("#dSerrAnt").val()) + "&lTrapDesc=" + encodeURIComponent($("#lTrapDesc").val()) + "&dTrapDesc=" + encodeURIComponent($("#dTrapDesc").val()) + "&lTrapAsc=" + encodeURIComponent($("#lTrapAsc").val()) + "&dTrapAsc=" + encodeURIComponent($("#dTrapAsc").val()) + "&lRhomb=" + encodeURIComponent($("#lRhomb").val()) + "&dRhomb=" + encodeURIComponent($("#dRhomb").val()) + "&lDeltClav=" + encodeURIComponent($("#lDeltClav").val()) + "&dDeltClav=" + encodeURIComponent($("#dDeltClav").val()) + "&lDeltAcr=" + encodeURIComponent($("#lDeltAcr").val()) + "&dDeltAcr=" + encodeURIComponent($("#dDeltAcr").val()) + "&lDeltSpin=" + encodeURIComponent($("#lDeltSpin").val()) + "&dDeltSpin=" + encodeURIComponent($("#dDeltSpin").val()) + "&lLattDor=" + encodeURIComponent($("#lLattDor").val()) + "&dLattDor=" + encodeURIComponent($("#dLattDor").val()) + "&lPectMaj=" + encodeURIComponent($("#lPectMaj").val()) + "&dPectMaj=" + encodeURIComponent($("#dPectMaj").val()) + "&lRotExtBra=" + encodeURIComponent($("#lRotExtBra").val()) + "&dRotExtBra=" + encodeURIComponent($("#dRotExtBra").val()) + "&lRotIntBra=" + encodeURIComponent($("#lRotIntBra").val()) + "&dRotIntBra=" + encodeURIComponent($("#dRotIntBra").val()) + "&lBicBra=" + encodeURIComponent($("#lBicBra").val()) + "&dBicBra=" + encodeURIComponent($("#dBicBra").val()) + "&lBrachialis=" + encodeURIComponent($("#lBrachialis").val()) + "&dBrachialis=" + encodeURIComponent($("#dBrachialis").val()) + "&lBrachioradialis=" + encodeURIComponent($("#lBrachioradialis").val()) + "&dBrachioradialis=" + encodeURIComponent($("#dBrachioradialis").val()) + "&lTriBra=" + encodeURIComponent($("#lTriBra").val()) + "&dTriBra=" + encodeURIComponent($("#dTriBra").val()) + "&lSupinator=" + encodeURIComponent($("#lSupinator").val()) + "&dSupinator=" + encodeURIComponent($("#dSupinator").val()) + "&lPron=" + encodeURIComponent($("#lPron").val()) + "&dPron=" + encodeURIComponent($("#dPron").val()) + "&lFlexCarpRad=" + encodeURIComponent($("#lFlexCarpRad").val()) + "&dFlexCarpRad=" + encodeURIComponent($("#dFlexCarpRad").val()) + "&lFlexCarpUln=" + encodeURIComponent($("#lFlexCarpUln").val()) + "&dFlexCarpUln=" + encodeURIComponent($("#dFlexCarpUln").val()) + "&lExtCarpRad=" + encodeURIComponent($("#lExtCarpRad").val()) + "&dExtCarpRad=" + encodeURIComponent($("#dExtCarpRad").val()) + "&lExtCarpUln=" + encodeURIComponent($("#lExtCarpUln").val()) + "&dExtCarpUln=" + encodeURIComponent($("#dExtCarpUln").val()) + "&lLumbEtInterossei=" + encodeURIComponent($("#lLumbEtInterossei").val()) + "&dLumbEtInterossei=" + encodeURIComponent($("#dLumbEtInterossei").val()) + "&lExtDigComCarp=" + encodeURIComponent($("#lExtDigComCarp").val()) + "&dExtDigComCarp=" + encodeURIComponent($("#dExtDigComCarp").val()) + "&lFlexDigSubl=" + encodeURIComponent($("#lFlexDigSubl").val()) + "&dFlexDigSubl=" + encodeURIComponent($("#dFlexDigSubl").val()) + "&lFlexDigProf=" + encodeURIComponent($("#lFlexDigProf").val()) + "&dFlexDigProf=" + encodeURIComponent($("#dFlexDigProf").val()) + "&lAddDig=" + encodeURIComponent($("#lAddDig").val()) + "&dAddDig=" + encodeURIComponent($("#dAddDig").val()) + "&lAbdDig=" + encodeURIComponent($("#lAbdDig").val()) + "&dAbdDig=" + encodeURIComponent($("#dAbdDig").val()) + "&lAbdPol=" + encodeURIComponent($("#lAbdPol").val()) + "&dAbdPol=" + encodeURIComponent($("#dAbdPol").val()) + "&lAddPol=" + encodeURIComponent($("#lAddPol").val()) + "&dAddPol=" + encodeURIComponent($("#dAddPol").val()) + "&lOppon=" + encodeURIComponent($("#lOppon").val()) + "&dOppon=" + encodeURIComponent($("#dOppon").val()) + "&lFlexPolBre=" + encodeURIComponent($("#lFlexPolBre").val()) + "&dFlexPolBre=" + encodeURIComponent($("#dFlexPolBre").val()) + "&lFlexPolLon=" + encodeURIComponent($("#lFlexPolLon").val()) + "&dFlexPolLon=" + encodeURIComponent($("#dFlexPolLon").val()) + "&lExtPolBre=" + encodeURIComponent($("#lExtPolBre").val()) + "&dExtPolBre=" + encodeURIComponent($("#dExtPolBre").val()) + "&lExtPolLon=" + encodeURIComponent($("#lExtPolLon").val()) + "&dExtPolLon=" + encodeURIComponent($("#dExtPolLon").val()) + "&lSakaDinam=" + $("#lSakaDinam").val() + "&dSakaDinam=" + $("#dSakaDinam").val() + "&neHoda=" + $("#neHoda").val() + "&hodSaStakama=" + $("#hodSaStakama").val() + "&stoji=" + $("#stoji").val() + "&hodSaStapovima=" + $("#hodSaStapovima").val() + "&hodSaAparatima=" + $("#hodSaAparatima").val() + "&hodSamostalno=" + $("#hodSamostalno").val() + "&hodSaKorzetom=" + $("#hodSaKorzetom").val() + "&ideStepenicama=" + $("#ideStepenicama").val() + "&pomocniAparati=" + $("#pomocniAparati").val() + "&deformiteti=" + $("#deformiteti").val(),
				success : function(vratioServer) {
					if (vratioServer == "Mjere unešene") {
						formKartonaAction('mjere');
						$("#formKartona").submit();
					} else {
						swal('Greška!', vratioServer, 'error');
					}
				}
			});
		}else{
			swal('Greška!', 'Obavezno unijeti datum mjerenja', 'error');
		}
	});
	
	//klik na gumb promjene terapije
	$(".promjenaTerapije").click(function(event) {
		event.preventDefault();
		var id = $(this).attr('id');
		var datum = $("#datum" + id).html();	
		$("#datumPromjene").val(htmlDatum(datum));
		$("#hfTerapijaId").val(id);	
	});
	
	//klik gumba potvrde u modalu
	$("#gumbModalaTerapije").click(function() {
	
		if ($("#datumPromjene").val().length == 0) {//prvo provjera je li datum unešen
			swal('Greška', 'Obavezno unesite datum', 'error');
		} else {
			//dodavanje obaveznih polja
			$.ajax({
				type : "POST",
				url : "../sql/ajax/terapije/promjena.php",
				data : "id=" + $("#hfTerapijaId").val() + "&datum=" + $("#datumPromjene").val(),
				success : function(vratioServer) {
					if (vratioServer != "Promijenjeno") {
						swal('Greška', vratioServer, 'error');						
					} else {
						formKartonaAction('datumiTerapija');
						spremiScroll();
						$("#formKartona").submit();
					}	
				}
			});			
		}
	});
	
	//klik na gumb brisanja datuma terapija
	$("#brisiDatumeTerapija").on('click', function() {
		var brojDatuma = $('input:checkbox:checked').length;
		var textSwal = (brojDatuma==1) ? 'Želite li doista obrisati ovaj datum terapije?' : 'Želite li doista obrisati sve označene datume terapija?'; 
		swal({
			title : 'Potvrda brisanja',
			text : textSwal,
			type : 'warning',
			showCancelButton : true,
			confirmButtonColor : '#3085d6',
			cancelButtonColor : '#d33',
			confirmButtonText : 'Da, obriši!',
			cancelButtonText : 'Ne, odustani!',
		}).then(function(result) {
			if (result.value) {
				var data = [];
				$("input:checkbox[namjena=datumTerapijeCheckbox]:checked").each(function() {
					if($.isNumeric($(this).val())){ //provjera jesu li id-i brojevi, da se ne bi dogodio inection
						data.push({id : $(this).val()});
					}				
				});
				$.ajax({
					type : "POST",
					url : "../sql/ajax/terapije/brisanje.php",
					data : "ids=" + JSON.stringify(data) + "&karton_id=" + $("#hfKartonId").val(),
					success : function(vratioServer) {
						if (vratioServer == "Datumi terapija obrisani") {	
							spremiScroll();
							formKartonaAction('datumiTerapija');
							$("#formKartona").submit();
						} else {
							swal('Greška!', vratioServer, 'error');
						}
					}
				});
			}
		});
	}); 

	//označavanje svih datuma
	$("#sviDatumi").click(function() {
		if ($("#sviDatumi").is(':checked')) {
			$("input[namjena=datumTerapijeCheckbox]").each(function() {
				$(this).prop("checked", true);
			});
		} else {
			$("input[namjena=datumTerapijeCheckbox]").each(function() {
				$(this).prop("checked", false);
			});
		}
	});
	
	//polazivanje i sakrivanje ikone brisanja
	$("input[type=checkbox]").click(function() {
		if ($("input:checkbox:checked").length > 0) {
			$("#brisiDatumeTerapija").show();
		} else {
			$("#brisiDatumeTerapija").hide();
		}
	});

	
	//promjena form actiona i fokusa na poljima kada se klikne na tab
	$(".tab-title").click(function() {
		var tab = $(this).children().attr("href").substring(1);
		if(tab=='osnovniPodaci'){
			var loc = location.pathname + '?id=' + $("#hfKartonId").val();
		}else{
			var loc = location.pathname + '?id=' + $("#hfKartonId").val() + '&tab=' + tab;			
		}
		
		switch(tab){
			case 'osnovniPodaci':
			var fokus = $('#ime');
			break;
			
			case 'ostaliPodaci':
			var fokus = $('#upis');
			break;
			
			case 'datumiTerapija':
			var fokus = $('#datumPrveTerapije');
			break;
			
			case 'mjere':
			var fokus = $('#datumMjerenja');
			break;
		}
		
		setTimeout(function() { fokus.focus(); }, 50);
		
		$("#formKartona").attr('action',loc);
		
	});	

});

//formatiranje datuma
function hrvDatum(datum) {
	if (datum.length > 0) {
		var dijeloviDatuma = datum.split("-");
		return dijeloviDatuma[2] + "." + dijeloviDatuma[1] + "." + dijeloviDatuma[0] + ".";
	} else {
		return '';
	}
}
	
function htmlDatum(datum) {
	if (datum.length > 0) {
		var dijeloviDatuma = datum.split(".");
		return dijeloviDatuma[2] + "-" + dijeloviDatuma[1] + "-" + dijeloviDatuma[0];
	} else {
		return '';
	}
}

function formKartonaAction(tab){
	var loc = location.pathname + '?id=' + $("#hfKartonId").val() + '&tab=' + tab;	
	$("#formKartona").attr('action',loc);
}

function spremiScroll() {
  sessionStorage.scrollTop = $(this).scrollTop();
}
