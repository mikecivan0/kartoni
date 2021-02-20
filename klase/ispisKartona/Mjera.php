<?php
class Mjera extends SQL{
	protected $osoba_id;
	
	function __construct($osobaId){
		$this->osoba_id = $osobaId;
	}
	
	public function isMesurements(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//traženje mjera određenog pacijenta po datumima
		$izraz = $veza->prepare("select * from kartoni_mjere where osoba_id=:id;");
		$izraz->bindParam(":id", $this->osoba_id);
		$izraz->execute();		
		return $izraz->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function find($id){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//traženje mjera određenog pacijenta po datumima
		$izraz = $veza->prepare("select * from kartoni_mjere where id=:id;");
		$izraz->bindParam(":id", $id);
		$izraz->execute();		
		return $izraz->fetch(PDO::FETCH_OBJ);
	}
	
	public function delete(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//brisanje upisanih mjera
		$izraz = $veza->prepare("delete from kartoni_mjere where id=:id;");
		$izraz->bindParam(":id", $_POST["id"]);
		$izraz->execute();	
		
		return "Mjere obrisane";			
	}
	
	public function provjeraPrijeUnosa(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//brisanje upisanih mjera
		$izraz = $veza->prepare("select id from kartoni_mjere where osoba_id=:osoba_id and datum=:datum;");
		$izraz->bindParam(":osoba_id", $this->osoba_id);
		$izraz->bindParam(":datum", $_POST["datum"]);
		$izraz->execute();	
		
		$imaMjera = $izraz->fetch(PDO::FETCH_OBJ);
		
		if(!empty($imaMjera)){
			return false;
		}else{
			return true;
		} 		
	}
	
	public function provjeraPrijePromjene(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//brisanje upisanih mjera
		$izraz = $veza->prepare("select id from kartoni_mjere where osoba_id=:osoba_id and datum=:datum and id!=:id;");
		$izraz->bindParam(":osoba_id", $this->osoba_id);
		$izraz->bindParam(":datum", $_POST["datumMjerenja"]);
		$izraz->bindParam(":id", $_POST["hfMjereId"]);
		$izraz->execute();	
		
		$imaMjera = $izraz->fetch(PDO::FETCH_OBJ);
		
		if(!empty($imaMjera)){
			return false;
		}else{
			return true;
		} 		
	}
	
	public function insert(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//unos novih mjera
		$izraz = $veza->prepare("insert into kartoni_mjere(osoba_id,datum,bolesnaStrana,lPolazisteDeltoideusa,dPolazisteDeltoideusa,lHvatisteDeltoideusa,dHvatisteDeltoideusa,
								lSredinaNadlaktice,dSredinaNadlaktice,lPrekoOlekranona,dPrekoOlekranona,lPrekoSredinePodlaktice,dPrekoSredinePodlaktice,
								lPrekoRucnogZgloba,dPrekoRucnogZgloba,lPrekoMetacarpusa,dPrekoMetacarpusa,lOPrsta,dOPrsta,l15IznadPatele,d15IznadPatele,lPrekoPatele,
								dPrekoPatele,l15IspodPatele,d15IspodPatele,lPrekoMaleola,dPrekoMaleola,lPrekoPete,dPrekoPete,lPrekoDorsumaStopala,
								dPrekoDorsumaStopala,lCFlesh,dCFlesh,lIndSagGibC,dIndSagGibC,lLatFleksC,dLatFleksC,lRotacijaC,dRotacijaC,lIndSagGibT,dIndSagGibT,lODisanja,dODisanja,lIndSagGibL,dIndSagGibL,
								lLatFlexTrupa,dLatFlexTrupa,lZnakTetiveNaLuku,dZnakTetiveNaLuku,lFenomenGumeneLopte,dFenomenGumeneLopte,lRameAbd,dRameAbd,lRameElev,
								dRameElev,lRameAnt,dRameAnt,lRameRet,dRameRet,lRameURot,dRameURot,lRameVRot,dRameVRot,lRameHorAbd,dRameHorAbd,
								lRameHorAdd,dRameHorAdd,lLakatExt,dLakatExt,lLakatFlex,dLakatFlex,lSupinacija,dSupinacija,lPronacija,dPronacija,
								lVolarFlex,dVolarFlex,lDorsalFlex,dDorsalFlex,lAbdUln,dAbdUln,lAbdRad,dAbdRad,lRPalacAbd,dRPalacAbd,lRPalacAdd,
								dRPalacAdd,lRPalacFlex,dRPalacFlex,lRPalacExt,dRPalacExt,lRPalac1ZglFlex,dRPalac1ZglFlex,lRPalacOpozicija,dRPalacOpozicija,lR2Pr1ZglExt,dR2Pr1ZglExt,lR2Pr1ZglFlex,
								dR2Pr1ZglFlex,lR2Pr2ZglFlex,dR2Pr2ZglFlex,lR2Pr3ZglFlex,dR2Pr3ZglFlex,lR3Pr1ZglExt,dR3Pr1ZglExt,lR3Pr1ZglFlex,
								dR3Pr1ZglFlex,lR3Pr2ZglFlex,dR3Pr2ZglFlex,lR3Pr3ZglFlex,dR3Pr3ZglFlex,lR4Pr1ZglExt,dR4Pr1ZglExt,lR4Pr1ZglFlex,
								dR4Pr1ZglFlex,lR4Pr2ZglFlex,dR4Pr2ZglFlex,lR4Pr3ZglFlex,dR4Pr3ZglFlex,lR5Pr1ZglExt,dR5Pr1ZglExt,lR5Pr1ZglFlex,
								dR5Pr1ZglFlex,lR5Pr2ZglFlex,dR5Pr2ZglFlex,lR5Pr3ZglFlex,dR5Pr3ZglFlex,lKukFlexIsprKoljeno,dKukFlexIsprKoljeno,
								lKukFlexSavKoljeno,dKukFlexSavKoljeno,lKukExt,dKukExt,lKukAbd,dKukAbd,lKukAdd,dKukAdd,lKukUnRot,dKukUnRot,lKukVanRot,
								dKukVanRot,lKoljFlex,dKoljFlex,lKoljExt,dKoljExt,lSkZglDorFlex,dSkZglDorFlex,lSkZglPlanFlex,dSkZglPlanFlex,lSkZglEver,
								dSkZglEver,lSkZglInv,dSkZglInv,lNPalac1ZglExt,dNPalac1ZglExt,lNPalac1ZglFlex,dNPalac1ZglFlex,lNPalac2ZglFlex,dNPalac2ZglFlex,lOrbOr,dOrbOr,lOrbOc,dOrbOc,lZyg,dZyg,lFront,dFront,
								lFlexCapitEtColi,dFlexCapitEtColi,lExtCapitEtColi,dExtCapitEtColi,lRectusAbdom,dRectusAbdom,lExtTrunci,dExtTrunci,lObliquiAbd,dObliquiAbd,lFlexLatTrunci,dFlexLatTrunci,lIliopsoas,dIliopsoas,
								lGlutMax,dGlutMax,lAddCoxae,dAddCoxae,lGlutMed,dGlutMed,lRotIntCoxae,dRotIntCoxae,lTenFasLat,dTenFasLat,lRotExtCoxae,dRotExtCoxae,
								lSartorius,dSartorius,lBicFem,dBicFem,lSemEtSem,dSemEtSem,lQuadFem,dQuadFem,lGastroc,dGastroc,lSoleus,dSoleus,lTibAnt,dTibAnt,lTibPost,
								dTibPost,lPer,dPer,lLumbEtInterPed,dLumbEtInterPed,lFlexDigBre,dFlexDigBre,lFlexDigLon,dFlexDigLon,lExtDigLon,dExtDigLon,lExtDigCom,
								dExtDigCom,lFlexHalLon,dFlexHalLon,lFlexHalBre,dFlexHalBre,lExtHalLon,dExtHalLon,lSerrAnt,dSerrAnt,lTrapDesc,dTrapDesc,lTrapAsc,dTrapAsc,lRhomb,
								dRhomb,lDeltClav,dDeltClav,lDeltAcr,dDeltAcr,lDeltSpin,dDeltSpin,lLattDor,dLattDor,lPectMaj,dPectMaj,lRotExtBra,dRotExtBra,lRotIntBra,
								dRotIntBra,lBicBra,dBicBra,lBrachialis,dBrachialis,lBrachioradialis,dBrachioradialis,lTriBra,dTriBra,lSupinator,dSupinator,lPron,dPron,
								lFlexCarpRad,dFlexCarpRad,lFlexCarpUln,dFlexCarpUln,lExtCarpRad,dExtCarpRad,lExtCarpUln,dExtCarpUln,lLumbEtInterossei,dLumbEtInterossei,
								lExtDigComCarp,dExtDigComCarp,lFlexDigSubl,dFlexDigSubl,lFlexDigProf,dFlexDigProf,lAddDig,dAddDig,lAbdDig,dAbdDig,lAbdPol,dAbdPol,lAddPol,
								dAddPol,lOppon,dOppon,lFlexPolBre,dFlexPolBre,lFlexPolLon,dFlexPolLon,lExtPolBre,dExtPolBre,lExtPolLon,dExtPolLon,lSakaDinam,dSakaDinam,neHoda,hodSaStakama,stoji,
								hodSaStapovima,hodSaAparatima,hodSamostalno,hodSaKorzetom,ideStepenicama,pomocniAparati,scoliosis)
								
								values(:osoba_id,:datum,:bolesnaStrana,:lPolazisteDeltoideusa,:dPolazisteDeltoideusa,:lHvatisteDeltoideusa,:dHvatisteDeltoideusa,
								:lSredinaNadlaktice,:dSredinaNadlaktice,:lPrekoOlekranona,:dPrekoOlekranona,:lPrekoSredinePodlaktice,:dPrekoSredinePodlaktice,
								:lPrekoRucnogZgloba,:dPrekoRucnogZgloba,:lPrekoMetacarpusa,:dPrekoMetacarpusa,:lOPrsta,:dOPrsta,:l15IznadPatele,:d15IznadPatele,:lPrekoPatele,
								:dPrekoPatele,:l15IspodPatele,:d15IspodPatele,:lPrekoMaleola,:dPrekoMaleola,:lPrekoPete,:dPrekoPete,:lPrekoDorsumaStopala,
								:dPrekoDorsumaStopala,:lCFlesh,:dCFlesh,:lIndSagGibC,:dIndSagGibC,:lLatFleksC,:dLatFleksC,:lRotacijaC,:dRotacijaC,:lIndSagGibT,:dIndSagGibT,:lODisanja,:dODisanja,:lIndSagGibL,:dIndSagGibL,
								:lLatFlexTrupa,:dLatFlexTrupa,:lZnakTetiveNaLuku,:dZnakTetiveNaLuku,:lFenomenGumeneLopte,:dFenomenGumeneLopte,:lRameAbd,:dRameAbd,:lRameElev,
								:dRameElev,:lRameAnt,:dRameAnt,:lRameRet,:dRameRet,:lRameURot,:dRameURot,:lRameVRot,:dRameVRot,:lRameHorAbd,:dRameHorAbd,
								:lRameHorAdd,:dRameHorAdd,:lLakatExt,:dLakatExt,:lLakatFlex,:dLakatFlex,:lSupinacija,:dSupinacija,:lPronacija,:dPronacija,
								:lVolarFlex,:dVolarFlex,:lDorsalFlex,:dDorsalFlex,:lAbdUln,:dAbdUln,:lAbdRad,:dAbdRad,:lRPalacAbd,:dRPalacAbd,:lRPalacAdd,
								:dRPalacAdd,:lRPalacFlex,:dRPalacFlex,:lRPalacExt,:dRPalacExt,:lRPalac1ZglFlex,:dRPalac1ZglFlex,:lRPalacOpozicija,:dRPalacOpozicija,:lR2Pr1ZglExt,:dR2Pr1ZglExt,:lR2Pr1ZglFlex,
								:dR2Pr1ZglFlex,:lR2Pr2ZglFlex,:dR2Pr2ZglFlex,:lR2Pr3ZglFlex,:dR2Pr3ZglFlex,:lR3Pr1ZglExt,:dR3Pr1ZglExt,:lR3Pr1ZglFlex,
								:dR3Pr1ZglFlex,:lR3Pr2ZglFlex,:dR3Pr2ZglFlex,:lR3Pr3ZglFlex,:dR3Pr3ZglFlex,:lR4Pr1ZglExt,:dR4Pr1ZglExt,:lR4Pr1ZglFlex,
								:dR4Pr1ZglFlex,:lR4Pr2ZglFlex,:dR4Pr2ZglFlex,:lR4Pr3ZglFlex,:dR4Pr3ZglFlex,:lR5Pr1ZglExt,:dR5Pr1ZglExt,:lR5Pr1ZglFlex,
								:dR5Pr1ZglFlex,:lR5Pr2ZglFlex,:dR5Pr2ZglFlex,:lR5Pr3ZglFlex,:dR5Pr3ZglFlex,:lKukFlexIsprKoljeno,:dKukFlexIsprKoljeno,
								:lKukFlexSavKoljeno,:dKukFlexSavKoljeno,:lKukExt,:dKukExt,:lKukAbd,:dKukAbd,:lKukAdd,:dKukAdd,:lKukUnRot,:dKukUnRot,:lKukVanRot,
								:dKukVanRot,:lKoljFlex,:dKoljFlex,:lKoljExt,:dKoljExt,:lSkZglDorFlex,:dSkZglDorFlex,:lSkZglPlanFlex,:dSkZglPlanFlex,:lSkZglEver,
								:dSkZglEver,:lSkZglInv,:dSkZglInv,:lNPalac1ZglExt,:dNPalac1ZglExt,:lNPalac1ZglFlex,:dNPalac1ZglFlex,:lNPalac2ZglFlex,:dNPalac2ZglFlex,:lOrbOr,:dOrbOr,:lOrbOc,:dOrbOc,:lZyg,:dZyg,:lFront,:dFront,
								:lFlexCapitEtColi,:dFlexCapitEtColi,:dExtCapitEtColi,:dExtCapitEtColi,:lRectusAbdom,:dRectusAbdom,:lExtTrunci,:dExtTrunci,:lObliquiAbd,:dObliquiAbd,:lFlexLatTrunci,:dFlexLatTrunci,:lIliopsoas,:dIliopsoas,
								:lGlutMax,:dGlutMax,:lAddCoxae,:dAddCoxae,:lGlutMed,:dGlutMed,:lRotIntCoxae,:dRotIntCoxae,:lTenFasLat,:dTenFasLat,:lRotExtCoxae,:dRotExtCoxae,
								:lSartorius,:dSartorius,:lBicFem,:dBicFem,:lSemEtSem,:dSemEtSem,:lQuadFem,:dQuadFem,:lGastroc,:dGastroc,:lSoleus,:dSoleus,:lTibAnt,:dTibAnt,:lTibPost,
								:dTibPost,:lPer,:dPer,:lLumbEtInterPed,:dLumbEtInterPed,:lFlexDigBre,:dFlexDigBre,:lFlexDigLon,:dFlexDigLon,:lExtDigLon,:dExtDigLon,:lExtDigCom,
								:dExtDigCom,:lFlexHalLon,:dFlexHalLon,:lFlexHalBre,:dFlexHalBre,:lExtHalLon,:dExtHalLon,:lSerrAnt,:dSerrAnt,:lTrapDesc,:dTrapDesc,:lTrapAsc,:dTrapAsc,:lRhomb,
								:dRhomb,:lDeltClav,:dDeltClav,:lDeltAcr,:dDeltAcr,:lDeltSpin,:dDeltSpin,:lLattDor,:dLattDor,:lPectMaj,:dPectMaj,:lRotExtBra,:dRotExtBra,:lRotIntBra,
								:dRotIntBra,:lBicBra,:dBicBra,:lBrachialis,:dBrachialis,:lBrachioradialis,:dBrachioradialis,:lTriBra,:dTriBra,:lSupinator,:dSupinator,:lPron,:dPron,
								:lFlexCarpRad,:dFlexCarpRad,:lFlexCarpUln,:dFlexCarpUln,:lExtCarpRad,:dExtCarpRad,:lExtCarpUln,:dExtCarpUln,:lLumbEtInterossei,:dLumbEtInterossei,
								:lExtDigComCarp,:dExtDigComCarp,:lFlexDigSubl,:dFlexDigSubl,:lFlexDigProf,:dFlexDigProf,:lAddDig,:dAddDig,:lAbdDig,:dAbdDig,:lAbdPol,:dAbdPol,:lAddPol,
								:dAddPol,:lOppon,:dOppon,:lFlexPolBre,:dFlexPolBre,:lFlexPolLon,:dFlexPolLon,:lExtPolBre,:dExtPolBre,:lExtPolLon,:dExtPolLon,:lSakaDinam,:dSakaDinam,:neHoda,:hodSaStakama,:stoji,
								:hodSaStapovima,:hodSaAparatima,:hodSamostalno,:hodSaKorzetom,:ideStepenicama,:pomocniAparati,:scoliosis);");
		
		$izraz->bindParam(":osoba_id", $this->osoba_id);
		$izraz->bindParam(":datum", $_POST["datum"]);
		$izraz->bindParam(":bolesnaStrana", $_POST["bolesnaStrana"]);
		$izraz->bindParam(":lPolazisteDeltoideusa", $_POST["lPolazisteDeltoideusa"]);
		$izraz->bindParam(":dPolazisteDeltoideusa", $_POST["dPolazisteDeltoideusa"]);
		$izraz->bindParam(":lHvatisteDeltoideusa", $_POST["lHvatisteDeltoideusa"]);
		$izraz->bindParam(":dHvatisteDeltoideusa", $_POST["dHvatisteDeltoideusa"]);
		$izraz->bindParam(":lSredinaNadlaktice", $_POST["lSredinaNadlaktice"]);
		$izraz->bindParam(":dSredinaNadlaktice", $_POST["dSredinaNadlaktice"]);
		$izraz->bindParam(":lPrekoOlekranona", $_POST["lPrekoOlekranona"]);
		$izraz->bindParam(":dPrekoOlekranona", $_POST["dPrekoOlekranona"]);
		$izraz->bindParam(":lPrekoSredinePodlaktice", $_POST["lPrekoSredinePodlaktice"]);
		$izraz->bindParam(":dPrekoSredinePodlaktice", $_POST["dPrekoSredinePodlaktice"]);
		$izraz->bindParam(":lPrekoRucnogZgloba", $_POST["lPrekoRucnogZgloba"]);
		$izraz->bindParam(":dPrekoRucnogZgloba", $_POST["dPrekoRucnogZgloba"]);
		$izraz->bindParam(":lPrekoMetacarpusa", $_POST["lPrekoMetacarpusa"]);
		$izraz->bindParam(":dPrekoMetacarpusa", $_POST["dPrekoMetacarpusa"]);
		$izraz->bindParam(":lOPrsta", $_POST["lOPrsta"]);
		$izraz->bindParam(":dOPrsta", $_POST["dOPrsta"]);
		$izraz->bindParam(":l15IznadPatele", $_POST["l15IznadPatele"]);
		$izraz->bindParam(":d15IznadPatele", $_POST["d15IznadPatele"]);
		$izraz->bindParam(":lPrekoPatele", $_POST["lPrekoPatele"]);
		$izraz->bindParam(":dPrekoPatele", $_POST["dPrekoPatele"]);
		$izraz->bindParam(":l15IspodPatele", $_POST["l15IspodPatele"]);
		$izraz->bindParam(":d15IspodPatele", $_POST["d15IspodPatele"]);
		$izraz->bindParam(":lPrekoMaleola", $_POST["lPrekoMaleola"]);
		$izraz->bindParam(":dPrekoMaleola", $_POST["dPrekoMaleola"]);
		$izraz->bindParam(":lPrekoPete", $_POST["lPrekoPete"]);
		$izraz->bindParam(":dPrekoPete", $_POST["dPrekoPete"]);
		$izraz->bindParam(":lPrekoDorsumaStopala", $_POST["lPrekoDorsumaStopala"]);
		$izraz->bindParam(":dPrekoDorsumaStopala", $_POST["dPrekoDorsumaStopala"]);
		$izraz->bindParam(":lCFlesh", $_POST["CFlesh"]);
		$izraz->bindParam(":dCFlesh", $_POST["CFlesh"]);
		$izraz->bindParam(":lIndSagGibC", $_POST["indSagGibC"]);
		$izraz->bindParam(":dIndSagGibC", $_POST["indSagGibC"]);
		$izraz->bindParam(":lLatFleksC", $_POST["lLatFleksC"]);
		$izraz->bindParam(":dLatFleksC", $_POST["dLatFleksC"]);
		$izraz->bindParam(":lRotacijaC", $_POST["lRotacijaC"]);
		$izraz->bindParam(":dRotacijaC", $_POST["dRotacijaC"]);
		$izraz->bindParam(":lIndSagGibT", $_POST["indSagGibT"]);
		$izraz->bindParam(":dIndSagGibT", $_POST["indSagGibT"]);
		$izraz->bindParam(":lODisanja", $_POST["ODisanja"]);
		$izraz->bindParam(":dODisanja", $_POST["ODisanja"]);
		$izraz->bindParam(":lIndSagGibL", $_POST["indSagGibL"]);
		$izraz->bindParam(":dIndSagGibL", $_POST["indSagGibL"]);
		$izraz->bindParam(":lLatFlexTrupa", $_POST["lLatFlexTrupa"]);
		$izraz->bindParam(":dLatFlexTrupa", $_POST["dLatFlexTrupa"]);
		$izraz->bindParam(":lZnakTetiveNaLuku", $_POST["lZnakTetiveNaLuku"]);
		$izraz->bindParam(":dZnakTetiveNaLuku", $_POST["dZnakTetiveNaLuku"]);
		$izraz->bindParam(":lFenomenGumeneLopte", $_POST["fenomenGumeneLopte"]);
		$izraz->bindParam(":dFenomenGumeneLopte", $_POST["fenomenGumeneLopte"]);
		$izraz->bindParam(":lRameAbd", $_POST["lRameAbd"]);
		$izraz->bindParam(":dRameAbd", $_POST["dRameAbd"]);
		$izraz->bindParam(":lRameElev", $_POST["lRameElev"]);
		$izraz->bindParam(":dRameElev", $_POST["dRameElev"]);
		$izraz->bindParam(":lRameAnt", $_POST["lRameAnt"]);
		$izraz->bindParam(":dRameAnt", $_POST["dRameAnt"]);
		$izraz->bindParam(":lRameRet", $_POST["lRameRet"]);
		$izraz->bindParam(":dRameRet", $_POST["dRameRet"]);
		$izraz->bindParam(":lRameURot", $_POST["lRameURot"]);
		$izraz->bindParam(":dRameURot", $_POST["dRameURot"]);
		$izraz->bindParam(":lRameVRot", $_POST["lRameVRot"]);
		$izraz->bindParam(":dRameVRot", $_POST["dRameVRot"]);
		$izraz->bindParam(":lRameHorAbd", $_POST["lRameHorAbd"]);
		$izraz->bindParam(":dRameHorAbd", $_POST["dRameHorAbd"]);
		$izraz->bindParam(":lRameHorAdd", $_POST["lRameHorAdd"]);
		$izraz->bindParam(":dRameHorAdd", $_POST["dRameHorAdd"]);
		$izraz->bindParam(":lLakatExt", $_POST["lLakatExt"]);
		$izraz->bindParam(":dLakatExt", $_POST["dLakatExt"]);
		$izraz->bindParam(":lLakatFlex", $_POST["lLakatFlex"]);
		$izraz->bindParam(":dLakatFlex", $_POST["dLakatFlex"]);
		$izraz->bindParam(":lSupinacija", $_POST["lSupinacija"]);
		$izraz->bindParam(":dSupinacija", $_POST["dSupinacija"]);
		$izraz->bindParam(":lPronacija", $_POST["lPronacija"]);
		$izraz->bindParam(":dPronacija", $_POST["dPronacija"]);
		$izraz->bindParam(":lVolarFlex", $_POST["lVolarFlex"]);
		$izraz->bindParam(":dVolarFlex", $_POST["dVolarFlex"]);
		$izraz->bindParam(":lDorsalFlex", $_POST["lDorsalFlex"]);
		$izraz->bindParam(":dDorsalFlex", $_POST["dDorsalFlex"]);
		$izraz->bindParam(":lAbdUln", $_POST["lAbdUln"]);
		$izraz->bindParam(":dAbdUln", $_POST["dAbdUln"]);
		$izraz->bindParam(":lAbdRad", $_POST["lAbdRad"]);
		$izraz->bindParam(":dAbdRad", $_POST["dAbdRad"]);
		$izraz->bindParam(":lRPalacAbd", $_POST["lRPalacAbd"]);
		$izraz->bindParam(":dRPalacAbd", $_POST["dRPalacAbd"]);
		$izraz->bindParam(":lRPalacAdd", $_POST["lRPalacAdd"]);
		$izraz->bindParam(":dRPalacAdd", $_POST["dRPalacAdd"]);
		$izraz->bindParam(":lRPalacFlex", $_POST["lRPalacFlex"]);
		$izraz->bindParam(":dRPalacFlex", $_POST["dRPalacFlex"]);
		$izraz->bindParam(":lRPalacExt", $_POST["lRPalacExt"]);
		$izraz->bindParam(":dRPalacExt", $_POST["dRPalacExt"]);
		$izraz->bindParam(":lRPalac1ZglFlex", $_POST["lRPalac1ZglFlex"]);
		$izraz->bindParam(":dRPalac1ZglFlex", $_POST["dRPalac1ZglFlex"]);
		$izraz->bindParam(":lRPalacOpozicija", $_POST["lRPalacOpozicija"]);
		$izraz->bindParam(":dRPalacOpozicija", $_POST["dRPalacOpozicija"]);
		$izraz->bindParam(":lR2Pr1ZglExt", $_POST["lR2Pr1ZglExt"]);
		$izraz->bindParam(":dR2Pr1ZglExt", $_POST["dR2Pr1ZglExt"]);
		$izraz->bindParam(":lR2Pr1ZglFlex", $_POST["lR2Pr1ZglFlex"]);
		$izraz->bindParam(":dR2Pr1ZglFlex", $_POST["dR2Pr1ZglFlex"]);
		$izraz->bindParam(":lR2Pr2ZglFlex", $_POST["lR2Pr2ZglFlex"]);
		$izraz->bindParam(":dR2Pr2ZglFlex", $_POST["dR2Pr2ZglFlex"]);
		$izraz->bindParam(":lR2Pr3ZglFlex", $_POST["lR2Pr3ZglFlex"]);
		$izraz->bindParam(":dR2Pr3ZglFlex", $_POST["dR2Pr3ZglFlex"]);
		$izraz->bindParam(":lR3Pr1ZglExt", $_POST["lR3Pr1ZglExt"]);
		$izraz->bindParam(":dR3Pr1ZglExt", $_POST["dR3Pr1ZglExt"]);
		$izraz->bindParam(":lR3Pr1ZglFlex", $_POST["lR3Pr1ZglFlex"]);
		$izraz->bindParam(":dR3Pr1ZglFlex", $_POST["dR3Pr1ZglFlex"]);
		$izraz->bindParam(":lR3Pr2ZglFlex", $_POST["lR3Pr2ZglFlex"]);
		$izraz->bindParam(":dR3Pr2ZglFlex", $_POST["dR3Pr2ZglFlex"]);
		$izraz->bindParam(":lR3Pr3ZglFlex", $_POST["lR3Pr3ZglFlex"]);
		$izraz->bindParam(":dR3Pr3ZglFlex", $_POST["dR3Pr3ZglFlex"]);
		$izraz->bindParam(":lR4Pr1ZglExt", $_POST["lR4Pr1ZglExt"]);
		$izraz->bindParam(":dR4Pr1ZglExt", $_POST["dR4Pr1ZglExt"]);
		$izraz->bindParam(":lR4Pr1ZglFlex", $_POST["lR4Pr1ZglFlex"]);
		$izraz->bindParam(":dR4Pr1ZglFlex", $_POST["dR4Pr1ZglFlex"]);
		$izraz->bindParam(":lR4Pr2ZglFlex", $_POST["lR4Pr2ZglFlex"]);
		$izraz->bindParam(":dR4Pr2ZglFlex", $_POST["dR4Pr2ZglFlex"]);
		$izraz->bindParam(":lR4Pr3ZglFlex", $_POST["lR4Pr3ZglFlex"]);
		$izraz->bindParam(":dR4Pr3ZglFlex", $_POST["dR4Pr3ZglFlex"]);
		$izraz->bindParam(":lR5Pr1ZglExt", $_POST["lR5Pr1ZglExt"]);
		$izraz->bindParam(":dR5Pr1ZglExt", $_POST["dR5Pr1ZglExt"]);
		$izraz->bindParam(":lR5Pr1ZglFlex", $_POST["lR5Pr1ZglFlex"]);
		$izraz->bindParam(":dR5Pr1ZglFlex", $_POST["dR5Pr1ZglFlex"]);
		$izraz->bindParam(":lR5Pr2ZglFlex", $_POST["lR5Pr2ZglFlex"]);
		$izraz->bindParam(":dR5Pr2ZglFlex", $_POST["dR5Pr2ZglFlex"]);
		$izraz->bindParam(":lR5Pr3ZglFlex", $_POST["lR5Pr3ZglFlex"]);
		$izraz->bindParam(":dR5Pr3ZglFlex", $_POST["dR5Pr3ZglFlex"]);
		$izraz->bindParam(":lKukFlexIsprKoljeno", $_POST["lKukFlexIsprKoljeno"]);
		$izraz->bindParam(":dKukFlexIsprKoljeno", $_POST["dKukFlexIsprKoljeno"]);
		$izraz->bindParam(":lKukFlexSavKoljeno", $_POST["lKukFlexSavKoljeno"]);
		$izraz->bindParam(":dKukFlexSavKoljeno", $_POST["dKukFlexSavKoljeno"]);
		$izraz->bindParam(":lKukExt", $_POST["lKukExt"]);
		$izraz->bindParam(":dKukExt", $_POST["dKukExt"]);
		$izraz->bindParam(":lKukAbd", $_POST["lKukAbd"]);
		$izraz->bindParam(":dKukAbd", $_POST["dKukAbd"]);
		$izraz->bindParam(":lKukAdd", $_POST["lKukAdd"]);
		$izraz->bindParam(":dKukAdd", $_POST["dKukAdd"]);
		$izraz->bindParam(":lKukUnRot", $_POST["lKukUnRot"]);
		$izraz->bindParam(":dKukUnRot", $_POST["dKukUnRot"]);
		$izraz->bindParam(":lKukVanRot", $_POST["lKukVanRot"]);
		$izraz->bindParam(":dKukVanRot", $_POST["dKukVanRot"]);
		$izraz->bindParam(":lKoljFlex", $_POST["lKoljFlex"]);
		$izraz->bindParam(":dKoljFlex", $_POST["dKoljFlex"]);
		$izraz->bindParam(":lKoljExt", $_POST["lKoljExt"]);
		$izraz->bindParam(":dKoljExt", $_POST["dKoljExt"]);
		$izraz->bindParam(":lSkZglDorFlex", $_POST["lSkZglDorFlex"]);
		$izraz->bindParam(":dSkZglDorFlex", $_POST["dSkZglDorFlex"]);
		$izraz->bindParam(":lSkZglPlanFlex", $_POST["lSkZglPlanFlex"]);
		$izraz->bindParam(":dSkZglPlanFlex", $_POST["dSkZglPlanFlex"]);
		$izraz->bindParam(":lSkZglEver", $_POST["lSkZglEver"]);
		$izraz->bindParam(":dSkZglEver", $_POST["dSkZglEver"]);
		$izraz->bindParam(":lSkZglInv", $_POST["lSkZglInv"]);
		$izraz->bindParam(":dSkZglInv", $_POST["dSkZglInv"]);
		$izraz->bindParam(":lNPalac1ZglExt", $_POST["lNPalac1ZglExt"]);
		$izraz->bindParam(":dNPalac1ZglExt", $_POST["dNPalac1ZglExt"]);
		$izraz->bindParam(":lNPalac1ZglFlex", $_POST["lNPalac1ZglFlex"]);
		$izraz->bindParam(":dNPalac1ZglFlex", $_POST["dNPalac1ZglFlex"]);
		$izraz->bindParam(":lNPalac2ZglFlex", $_POST["lNPalac2ZglFlex"]);
		$izraz->bindParam(":dNPalac2ZglFlex", $_POST["dNPalac2ZglFlex"]);
		$izraz->bindParam(":lOrbOr", $_POST["lOrbOr"]);
		$izraz->bindParam(":dOrbOr", $_POST["dOrbOr"]);
		$izraz->bindParam(":lOrbOc", $_POST["lOrbOc"]);
		$izraz->bindParam(":dOrbOc", $_POST["dOrbOc"]);
		$izraz->bindParam(":lZyg", $_POST["lZyg"]);
		$izraz->bindParam(":dZyg", $_POST["dZyg"]);
		$izraz->bindParam(":lFront", $_POST["lFront"]);
		$izraz->bindParam(":dFront", $_POST["dFront"]);
		$izraz->bindParam(":lFlexCapitEtColi", $_POST["flexCapitEtColi"]);
		$izraz->bindParam(":dFlexCapitEtColi", $_POST["flexCapitEtColi"]);
		$izraz->bindParam(":lExtCapitEtColi", $_POST["extCapitEtColi"]);
		$izraz->bindParam(":dExtCapitEtColi", $_POST["extCapitEtColi"]);
		$izraz->bindParam(":lRectusAbdom", $_POST["rectusAbdom"]);
		$izraz->bindParam(":dRectusAbdom", $_POST["rectusAbdom"]);
		$izraz->bindParam(":lExtTrunci", $_POST["extTrunci"]);
		$izraz->bindParam(":dExtTrunci", $_POST["extTrunci"]);
		$izraz->bindParam(":lObliquiAbd", $_POST["lObliquiAbd"]);
		$izraz->bindParam(":dObliquiAbd", $_POST["dObliquiAbd"]);
		$izraz->bindParam(":lFlexLatTrunci", $_POST["lFlexLatTrunci"]);
		$izraz->bindParam(":dFlexLatTrunci", $_POST["dFlexLatTrunci"]);
		$izraz->bindParam(":lIliopsoas", $_POST["lIliopsoas"]);
		$izraz->bindParam(":dIliopsoas", $_POST["dIliopsoas"]);
		$izraz->bindParam(":lGlutMax", $_POST["lGlutMax"]);
		$izraz->bindParam(":dGlutMax", $_POST["dGlutMax"]);
		$izraz->bindParam(":lAddCoxae", $_POST["lAddCoxae"]);
		$izraz->bindParam(":dAddCoxae", $_POST["dAddCoxae"]);
		$izraz->bindParam(":lGlutMed", $_POST["lGlutMed"]);
		$izraz->bindParam(":dGlutMed", $_POST["dGlutMed"]);
		$izraz->bindParam(":lRotIntCoxae", $_POST["lRotIntCoxae"]);
		$izraz->bindParam(":dRotIntCoxae", $_POST["dRotIntCoxae"]);
		$izraz->bindParam(":lTenFasLat", $_POST["lTenFasLat"]);
		$izraz->bindParam(":dTenFasLat", $_POST["dTenFasLat"]);
		$izraz->bindParam(":lRotExtCoxae", $_POST["lRotExtCoxae"]);
		$izraz->bindParam(":dRotExtCoxae", $_POST["dRotExtCoxae"]);
		$izraz->bindParam(":lSartorius", $_POST["lSartorius"]);
		$izraz->bindParam(":dSartorius", $_POST["dSartorius"]);
		$izraz->bindParam(":lBicFem", $_POST["lBicFem"]);
		$izraz->bindParam(":dBicFem", $_POST["dBicFem"]);
		$izraz->bindParam(":lSemEtSem", $_POST["lSemEtSem"]);
		$izraz->bindParam(":dSemEtSem", $_POST["dSemEtSem"]);
		$izraz->bindParam(":lQuadFem", $_POST["lQuadFem"]);
		$izraz->bindParam(":dQuadFem", $_POST["dQuadFem"]);
		$izraz->bindParam(":lGastroc", $_POST["lGastroc"]);
		$izraz->bindParam(":dGastroc", $_POST["dGastroc"]);
		$izraz->bindParam(":lSoleus", $_POST["lSoleus"]);
		$izraz->bindParam(":dSoleus", $_POST["dSoleus"]);
		$izraz->bindParam(":lTibAnt", $_POST["lTibAnt"]);
		$izraz->bindParam(":dTibAnt", $_POST["dTibAnt"]);
		$izraz->bindParam(":lTibPost", $_POST["lTibPost"]);
		$izraz->bindParam(":dTibPost", $_POST["dTibPost"]);
		$izraz->bindParam(":lPer", $_POST["lPer"]);
		$izraz->bindParam(":dPer", $_POST["dPer"]);
		$izraz->bindParam(":lLumbEtInterPed", $_POST["lLumbEtInterPed"]);
		$izraz->bindParam(":dLumbEtInterPed", $_POST["dLumbEtInterPed"]);
		$izraz->bindParam(":lFlexDigBre", $_POST["lFlexDigBre"]);
		$izraz->bindParam(":dFlexDigBre", $_POST["dFlexDigBre"]);
		$izraz->bindParam(":lFlexDigLon", $_POST["lFlexDigLon"]);
		$izraz->bindParam(":dFlexDigLon", $_POST["dFlexDigLon"]);
		$izraz->bindParam(":lExtDigLon", $_POST["lExtDigLon"]);
		$izraz->bindParam(":dExtDigLon", $_POST["dExtDigLon"]);
		$izraz->bindParam(":lExtDigCom", $_POST["lExtDigCom"]);
		$izraz->bindParam(":dExtDigCom", $_POST["dExtDigCom"]);
		$izraz->bindParam(":lFlexHalLon", $_POST["lFlexHalLon"]);
		$izraz->bindParam(":dFlexHalLon", $_POST["dFlexHalLon"]);
		$izraz->bindParam(":lFlexHalBre", $_POST["lFlexHalBre"]);
		$izraz->bindParam(":dFlexHalBre", $_POST["dFlexHalBre"]);
		$izraz->bindParam(":lExtHalLon", $_POST["lExtHalLon"]);
		$izraz->bindParam(":dExtHalLon", $_POST["dExtHalLon"]);
		$izraz->bindParam(":lSerrAnt", $_POST["lSerrAnt"]);
		$izraz->bindParam(":dSerrAnt", $_POST["dSerrAnt"]);
		$izraz->bindParam(":lTrapDesc", $_POST["lTrapDesc"]);
		$izraz->bindParam(":dTrapDesc", $_POST["dTrapDesc"]);
		$izraz->bindParam(":lTrapAsc", $_POST["lTrapAsc"]);
		$izraz->bindParam(":dTrapAsc", $_POST["dTrapAsc"]);
		$izraz->bindParam(":lRhomb", $_POST["lRhomb"]);
		$izraz->bindParam(":dRhomb", $_POST["dRhomb"]);
		$izraz->bindParam(":lDeltClav", $_POST["lDeltClav"]);
		$izraz->bindParam(":dDeltClav", $_POST["dDeltClav"]);
		$izraz->bindParam(":lDeltAcr", $_POST["lDeltAcr"]);
		$izraz->bindParam(":dDeltAcr", $_POST["dDeltAcr"]);
		$izraz->bindParam(":lDeltSpin", $_POST["lDeltSpin"]);
		$izraz->bindParam(":dDeltSpin", $_POST["dDeltSpin"]);
		$izraz->bindParam(":lLattDor", $_POST["lLattDor"]);
		$izraz->bindParam(":dLattDor", $_POST["dLattDor"]);
		$izraz->bindParam(":lPectMaj", $_POST["lPectMaj"]);
		$izraz->bindParam(":dPectMaj", $_POST["dPectMaj"]);
		$izraz->bindParam(":lRotExtBra", $_POST["lRotExtBra"]);
		$izraz->bindParam(":dRotExtBra", $_POST["dRotExtBra"]);
		$izraz->bindParam(":lRotIntBra", $_POST["lRotIntBra"]);
		$izraz->bindParam(":dRotIntBra", $_POST["dRotIntBra"]);
		$izraz->bindParam(":lBicBra", $_POST["lBicBra"]);
		$izraz->bindParam(":dBicBra", $_POST["dBicBra"]);
		$izraz->bindParam(":lBrachialis", $_POST["lBrachialis"]);
		$izraz->bindParam(":dBrachialis", $_POST["dBrachialis"]);
		$izraz->bindParam(":lBrachioradialis", $_POST["lBrachioradialis"]);
		$izraz->bindParam(":dBrachioradialis", $_POST["dBrachioradialis"]);
		$izraz->bindParam(":lTriBra", $_POST["lTriBra"]);
		$izraz->bindParam(":dTriBra", $_POST["dTriBra"]);
		$izraz->bindParam(":lSupinator", $_POST["lSupinator"]);
		$izraz->bindParam(":dSupinator", $_POST["dSupinator"]);
		$izraz->bindParam(":lPron", $_POST["lPron"]);
		$izraz->bindParam(":dPron", $_POST["dPron"]);
		$izraz->bindParam(":lFlexCarpRad", $_POST["lFlexCarpRad"]);
		$izraz->bindParam(":dFlexCarpRad", $_POST["dFlexCarpRad"]);
		$izraz->bindParam(":lFlexCarpUln", $_POST["lFlexCarpUln"]);
		$izraz->bindParam(":dFlexCarpUln", $_POST["dFlexCarpUln"]);
		$izraz->bindParam(":lExtCarpRad", $_POST["lExtCarpRad"]);
		$izraz->bindParam(":dExtCarpRad", $_POST["dExtCarpRad"]);
		$izraz->bindParam(":lExtCarpUln", $_POST["lExtCarpUln"]);
		$izraz->bindParam(":dExtCarpUln", $_POST["dExtCarpUln"]);
		$izraz->bindParam(":lLumbEtInterossei", $_POST["lLumbEtInterossei"]);
		$izraz->bindParam(":dLumbEtInterossei", $_POST["dLumbEtInterossei"]);
		$izraz->bindParam(":lExtDigComCarp", $_POST["lExtDigComCarp"]);
		$izraz->bindParam(":dExtDigComCarp", $_POST["dExtDigComCarp"]);
		$izraz->bindParam(":lFlexDigSubl", $_POST["lFlexDigSubl"]);
		$izraz->bindParam(":dFlexDigSubl", $_POST["dFlexDigSubl"]);
		$izraz->bindParam(":lFlexDigProf", $_POST["lFlexDigProf"]);
		$izraz->bindParam(":dFlexDigProf", $_POST["dFlexDigProf"]);
		$izraz->bindParam(":lAddDig", $_POST["lAddDig"]);
		$izraz->bindParam(":dAddDig", $_POST["dAddDig"]);
		$izraz->bindParam(":lAbdDig", $_POST["lAbdDig"]);
		$izraz->bindParam(":dAbdDig", $_POST["dAbdDig"]);
		$izraz->bindParam(":lAbdPol", $_POST["lAbdPol"]);
		$izraz->bindParam(":dAbdPol", $_POST["dAbdPol"]);
		$izraz->bindParam(":lAddPol", $_POST["lAddPol"]);
		$izraz->bindParam(":dAddPol", $_POST["dAddPol"]);
		$izraz->bindParam(":lOppon", $_POST["lOppon"]);
		$izraz->bindParam(":dOppon", $_POST["dOppon"]);
		$izraz->bindParam(":lFlexPolBre", $_POST["lFlexPolBre"]);
		$izraz->bindParam(":dFlexPolBre", $_POST["dFlexPolBre"]);
		$izraz->bindParam(":lFlexPolLon", $_POST["lFlexPolLon"]);
		$izraz->bindParam(":dFlexPolLon", $_POST["dFlexPolLon"]);
		$izraz->bindParam(":lExtPolBre", $_POST["lExtPolBre"]);
		$izraz->bindParam(":dExtPolBre", $_POST["dExtPolBre"]);
		$izraz->bindParam(":lExtPolLon", $_POST["lExtPolLon"]);
		$izraz->bindParam(":dExtPolLon", $_POST["dExtPolLon"]);
		$izraz->bindParam(":lSakaDinam", $_POST["lSakaDinam"]);
		$izraz->bindParam(":dSakaDinam", $_POST["dSakaDinam"]);
		$izraz->bindParam(":neHoda", $_POST["neHoda"]);
		$izraz->bindParam(":hodSaStakama", $_POST["hodSaStakama"]);
		$izraz->bindParam(":stoji", $_POST["stoji"]);
		$izraz->bindParam(":hodSaStapovima", $_POST["hodSaStapovima"]);
		$izraz->bindParam(":hodSaAparatima", $_POST["hodSaAparatima"]);
		$izraz->bindParam(":hodSamostalno", $_POST["hodSamostalno"]);
		$izraz->bindParam(":hodSaKorzetom", $_POST["hodSaKorzetom"]);
		$izraz->bindParam(":ideStepenicama", $_POST["ideStepenicama"]);
		$izraz->bindParam(":pomocniAparati", $_POST["pomocniAparati"]);
		$izraz->bindParam(":scoliosis", $_POST["scoliosis"]);
		$izraz->execute();	
		
		return "Mjere unešene";			
	}
	
	public function update(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//update upisanih mjera
		$izraz = $veza->prepare("update kartoni_mjere set datum=:datum,bolesnaStrana=:bolesnaStrana,lPolazisteDeltoideusa=:lPolazisteDeltoideusa,dPolazisteDeltoideusa=:dPolazisteDeltoideusa,
								lHvatisteDeltoideusa=:lHvatisteDeltoideusa,dHvatisteDeltoideusa=:dHvatisteDeltoideusa,lSredinaNadlaktice=:lSredinaNadlaktice,
								dSredinaNadlaktice=:dSredinaNadlaktice,lPrekoOlekranona=:lPrekoOlekranona,dPrekoOlekranona=:dPrekoOlekranona,
								lPrekoSredinePodlaktice=:lPrekoSredinePodlaktice,dPrekoSredinePodlaktice=:dPrekoSredinePodlaktice,
								lPrekoRucnogZgloba=:lPrekoRucnogZgloba,dPrekoRucnogZgloba=:dPrekoRucnogZgloba,lPrekoMetacarpusa=:lPrekoMetacarpusa,
								dPrekoMetacarpusa=:dPrekoMetacarpusa,lOPrsta=:lOPrsta,dOPrsta=:dOPrsta,l15IznadPatele=:l15IznadPatele,d15IznadPatele=:d15IznadPatele,
								lPrekoPatele=:lPrekoPatele,dPrekoPatele=:dPrekoPatele,l15IspodPatele=:l15IspodPatele,d15IspodPatele=:d15IspodPatele,
								lPrekoMaleola=:lPrekoMaleola,dPrekoMaleola=:dPrekoMaleola,lPrekoPete=:lPrekoPete,dPrekoPete=:dPrekoPete,
								lPrekoDorsumaStopala=:lPrekoDorsumaStopala,dPrekoDorsumaStopala=:dPrekoDorsumaStopala,lCFlesh=:CFlesh,dCFlesh=:CFlesh,lIndSagGibC=:indSagGibC,dIndSagGibC=:indSagGibC,
								lLatFleksC=:lLatFleksC,dLatFleksC=:dLatFleksC,lRotacijaC=:lRotacijaC,dRotacijaC=:dRotacijaC,lIndSagGibT=:indSagGibT,dIndSagGibT=:indSagGibT,
								lODisanja=:ODisanja,dODisanja=:ODisanja,lIndSagGibL=:indSagGibL,dIndSagGibL=:indSagGibL,lLatFlexTrupa=:lLatFlexTrupa,dLatFlexTrupa=:dLatFlexTrupa,lZnakTetiveNaLuku=:lZnakTetiveNaLuku,
								dZnakTetiveNaLuku=:dZnakTetiveNaLuku,lFenomenGumeneLopte=:fenomenGumeneLopte,dFenomenGumeneLopte=:fenomenGumeneLopte,lRameAbd=:lRameAbd,dRameAbd=:dRameAbd,
								lRameElev=:lRameElev,dRameElev=:dRameElev,lRameAnt=:lRameAnt,dRameAnt=:dRameAnt,lRameRet=:lRameRet,dRameRet=:dRameRet,
								lRameURot=:lRameURot,dRameURot=:dRameURot,lRameVRot=:lRameVRot,dRameVRot=:dRameVRot,lRameHorAbd=:lRameHorAbd,dRameHorAbd=:dRameHorAbd,
								lRameHorAdd=:lRameHorAdd,dRameHorAdd=:dRameHorAdd,lLakatExt=:lLakatExt,dLakatExt=:dLakatExt,lLakatFlex=:lLakatFlex,dLakatFlex=:dLakatFlex,
								lSupinacija=:lSupinacija,dSupinacija=:dSupinacija,lPronacija=:lPronacija,dPronacija=:dPronacija,lVolarFlex=:lVolarFlex,dVolarFlex=:dVolarFlex,
								lDorsalFlex=:lDorsalFlex,dDorsalFlex=:dDorsalFlex,lAbdUln=:lAbdUln,dAbdUln=:dAbdUln,lAbdRad=:lAbdRad,dAbdRad=:dAbdRad,lRPalacAbd=:lRPalacAbd,
								dRPalacAbd=:dRPalacAbd,lRPalacAdd=:lRPalacAdd,dRPalacAdd=:dRPalacAdd,lRPalacFlex=:lRPalacFlex,dRPalacFlex=:dRPalacFlex,lRPalacExt=:lRPalacExt,dRPalacExt=:dRPalacExt,lRPalac1ZglFlex=:lRPalac1ZglFlex,
								dRPalac1ZglFlex=:dRPalac1ZglFlex,lRPalacOpozicija=:lRPalacOpozicija,dRPalacOpozicija=:dRPalacOpozicija,lR2Pr1ZglExt=:lR2Pr1ZglExt,dR2Pr1ZglExt=:dR2Pr1ZglExt,lR2Pr1ZglFlex=:lR2Pr1ZglFlex,dR2Pr1ZglFlex=:dR2Pr1ZglFlex,
								lR2Pr2ZglFlex=:lR2Pr2ZglFlex,dR2Pr2ZglFlex=:dR2Pr2ZglFlex,lR2Pr3ZglFlex=:lR2Pr3ZglFlex,dR2Pr3ZglFlex=:dR2Pr3ZglFlex,lR3Pr1ZglExt=:lR3Pr1ZglExt,
								dR3Pr1ZglExt=:dR3Pr1ZglExt,lR3Pr1ZglFlex=:lR3Pr1ZglFlex,dR3Pr1ZglFlex=:dR3Pr1ZglFlex,lR3Pr2ZglFlex=:lR3Pr2ZglFlex,dR3Pr2ZglFlex=:dR3Pr2ZglFlex,
								lR3Pr3ZglFlex=:lR3Pr3ZglFlex,dR3Pr3ZglFlex=:dR3Pr3ZglFlex,lR4Pr1ZglExt=:lR4Pr1ZglExt,dR4Pr1ZglExt=:dR4Pr1ZglExt,lR4Pr1ZglFlex=:lR4Pr1ZglFlex,
								dR4Pr1ZglFlex=:dR4Pr1ZglFlex,lR4Pr2ZglFlex=:lR4Pr2ZglFlex,dR4Pr2ZglFlex=:dR4Pr2ZglFlex,lR4Pr3ZglFlex=:lR4Pr3ZglFlex,dR4Pr3ZglFlex=:dR4Pr3ZglFlex,
								lR5Pr1ZglExt=:lR5Pr1ZglExt,dR5Pr1ZglExt=:dR5Pr1ZglExt,lR5Pr1ZglFlex=:lR5Pr1ZglFlex,dR5Pr1ZglFlex=:dR5Pr1ZglFlex,lR5Pr2ZglFlex=:lR5Pr2ZglFlex,
								dR5Pr2ZglFlex=:dR5Pr2ZglFlex,lR5Pr3ZglFlex=:lR5Pr3ZglFlex,dR5Pr3ZglFlex=:dR5Pr3ZglFlex,lKukFlexIsprKoljeno=:lKukFlexIsprKoljeno,dKukFlexIsprKoljeno=:dKukFlexIsprKoljeno,
								lKukFlexSavKoljeno=:lKukFlexSavKoljeno,dKukFlexSavKoljeno=:dKukFlexSavKoljeno,lKukExt=:lKukExt,dKukExt=:dKukExt,lKukAbd=:lKukAbd,
								dKukAbd=:dKukAbd,lKukAdd=:lKukAdd,dKukAdd=:dKukAdd,lKukUnRot=:lKukUnRot,dKukUnRot=:dKukUnRot,lKukVanRot=:lKukVanRot,dKukVanRot=:dKukVanRot,
								lKoljFlex=:lKoljFlex,dKoljFlex=:dKoljFlex,lKoljExt=:lKoljExt,dKoljExt=:dKoljExt,lSkZglDorFlex=:lSkZglDorFlex,dSkZglDorFlex=:dSkZglDorFlex,
								lSkZglPlanFlex=:lSkZglPlanFlex,dSkZglPlanFlex=:dSkZglPlanFlex,lSkZglEver=:lSkZglEver,dSkZglEver=:dSkZglEver,lSkZglInv=:lSkZglInv,dSkZglInv=:dSkZglInv,
								lNPalac1ZglExt=:lNPalac1ZglExt,dNPalac1ZglExt=:dNPalac1ZglExt,lNPalac1ZglFlex=:lNPalac1ZglFlex,dNPalac1ZglFlex=:dNPalac1ZglFlex,lNPalac2ZglFlex=:lNPalac2ZglFlex,
								dNPalac2ZglFlex=:dNPalac2ZglFlex,lOrbOr=:lOrbOr,dOrbOr=:dOrbOr,lOrbOc=:lOrbOc,dOrbOc=:dOrbOc,lZyg=:lZyg,dZyg=:dZyg,lFront=:lFront,dFront=:dFront,lFlexCapitEtColi=:flexCapitEtColi,dFlexCapitEtColi=:flexCapitEtColi,
								lExtCapitEtColi=:extCapitEtColi,dExtCapitEtColi=:extCapitEtColi,lRectusAbdom=:rectusAbdom,dRectusAbdom=:rectusAbdom,lExtTrunci=:extTrunci,dExtTrunci=:extTrunci,
								lObliquiAbd=:lObliquiAbd,dObliquiAbd=:dObliquiAbd,lFlexLatTrunci=:lFlexLatTrunci,dFlexLatTrunci=:dFlexLatTrunci,lIliopsoas=:lIliopsoas,
								dIliopsoas=:dIliopsoas,lGlutMax=:lGlutMax,dGlutMax=:dGlutMax,lAddCoxae=:lAddCoxae,dAddCoxae=:dAddCoxae,lGlutMed=:lGlutMed,dGlutMed=:dGlutMed,
								lRotIntCoxae=:lRotIntCoxae,dRotIntCoxae=:dRotIntCoxae,lTenFasLat=:lTenFasLat,dTenFasLat=:dTenFasLat,lRotExtCoxae=:lRotExtCoxae,dRotExtCoxae=:dRotExtCoxae,
								lSartorius=:lSartorius,dSartorius=:dSartorius,lBicFem=:lBicFem,dBicFem=:dBicFem,lSemEtSem=:lSemEtSem,dSemEtSem=:dSemEtSem,lQuadFem=:lQuadFem,
								dQuadFem=:dQuadFem,lGastroc=:lGastroc,dGastroc=:dGastroc,lSoleus=:lSoleus,dSoleus=:dSoleus,lTibAnt=:lTibAnt,dTibAnt=:dTibAnt,lTibPost=:lTibPost,
								dTibPost=:dTibPost,lPer=:lPer,dPer=:dPer,lLumbEtInterPed=:lLumbEtInterPed,dLumbEtInterPed=:dLumbEtInterPed,lFlexDigBre=:lFlexDigBre,dFlexDigBre=:dFlexDigBre,
								lFlexDigLon=:lFlexDigLon,dFlexDigLon=:dFlexDigLon,lExtDigLon=:lExtDigLon,dExtDigLon=:dExtDigLon,lExtDigCom=:lExtDigCom,dExtDigCom=:dExtDigCom,lFlexHalLon=:lFlexHalLon,
								dFlexHalLon=:dFlexHalLon,lFlexHalBre=:lFlexHalBre,dFlexHalBre=:dFlexHalBre,lExtHalLon=:lExtHalLon,dExtHalLon=:dExtHalLon,lSerrAnt=:lSerrAnt,dSerrAnt=:dSerrAnt,
								lTrapDesc=:lTrapDesc,dTrapDesc=:dTrapDesc,lTrapAsc=:lTrapAsc,dTrapAsc=:dTrapAsc,lRhomb=:lRhomb,dRhomb=:dRhomb,lDeltClav=:lDeltClav,dDeltClav=:dDeltClav,lDeltAcr=:lDeltAcr,
								dDeltAcr=:dDeltAcr,lDeltSpin=:lDeltSpin,dDeltSpin=:dDeltSpin,lLattDor=:lLattDor,dLattDor=:dLattDor,lPectMaj=:lPectMaj,dPectMaj=:dPectMaj,lRotExtBra=:lRotExtBra,
								dRotExtBra=:dRotExtBra,lRotIntBra=:lRotIntBra,dRotIntBra=:dRotIntBra,lBicBra=:lBicBra,dBicBra=:dBicBra,lBrachialis=:lBrachialis,dBrachialis=:dBrachialis,
								lBrachioradialis=:lBrachioradialis,dBrachioradialis=:dBrachioradialis,lTriBra=:lTriBra,dTriBra=:dTriBra,lSupinator=:lSupinator,dSupinator=:dSupinator,
								lPron=:lPron,dPron=:dPron,lFlexCarpRad=:lFlexCarpRad,dFlexCarpRad=:dFlexCarpRad,lFlexCarpUln=:lFlexCarpUln,dFlexCarpUln=:dFlexCarpUln,lExtCarpRad=:lExtCarpRad,
								dExtCarpRad=:dExtCarpRad,lExtCarpUln=:lExtCarpUln,dExtCarpUln=:dExtCarpUln,lLumbEtInterossei=:lLumbEtInterossei,dLumbEtInterossei=:dLumbEtInterossei,lExtDigComCarp=:lExtDigComCarp,
								dExtDigComCarp=:dExtDigComCarp,lFlexDigSubl=:lFlexDigSubl,dFlexDigSubl=:dFlexDigSubl,lFlexDigProf=:lFlexDigProf,dFlexDigProf=:dFlexDigProf,lAddDig=:lAddDig,
								dAddDig=:dAddDig,lAbdDig=:lAbdDig,dAbdDig=:dAbdDig,lAbdPol=:lAbdPol,dAbdPol=:dAbdPol,lAddPol=:lAddPol,dAddPol=:dAddPol,lOppon=:lOppon,dOppon=:dOppon,
								lFlexPolBre=:lFlexPolBre,dFlexPolBre=:dFlexPolBre,lFlexPolLon=:lFlexPolLon,dFlexPolLon=:dFlexPolLon,lExtPolBre=:lExtPolBre,dExtPolBre=:dExtPolBre,
								lExtPolLon=:lExtPolLon,dExtPolLon=:dExtPolLon,lSakaDinam=:lSakaDinam,dSakaDinam=:dSakaDinam,neHoda=:neHoda,hodSaStakama=:hodSaStakama,stoji=:stoji,hodSaStapovima=:hodSaStapovima,
								hodSaAparatima=:hodSaAparatima,hodSamostalno=:hodSamostalno,hodSaKorzetom=:hodSaKorzetom,ideStepenicama=:ideStepenicama,pomocniAparati=:pomocniAparati,scoliosis=:scoliosis
								where id=:id;");
		$izraz->bindParam(":datum", $_POST["datumMjerenja"]);
		$izraz->bindParam(":bolesnaStrana", $_POST["bolesnaStrana"]);
		$izraz->bindParam(":lPolazisteDeltoideusa", $_POST["lPolazisteDeltoideusa"]);
		$izraz->bindParam(":dPolazisteDeltoideusa", $_POST["dPolazisteDeltoideusa"]);
		$izraz->bindParam(":lHvatisteDeltoideusa", $_POST["lHvatisteDeltoideusa"]);
		$izraz->bindParam(":dHvatisteDeltoideusa", $_POST["dHvatisteDeltoideusa"]);
		$izraz->bindParam(":lSredinaNadlaktice", $_POST["lSredinaNadlaktice"]);
		$izraz->bindParam(":dSredinaNadlaktice", $_POST["dSredinaNadlaktice"]);
		$izraz->bindParam(":lPrekoOlekranona", $_POST["lPrekoOlekranona"]);
		$izraz->bindParam(":dPrekoOlekranona", $_POST["dPrekoOlekranona"]);
		$izraz->bindParam(":lPrekoSredinePodlaktice", $_POST["lPrekoSredinePodlaktice"]);
		$izraz->bindParam(":dPrekoSredinePodlaktice", $_POST["dPrekoSredinePodlaktice"]);
		$izraz->bindParam(":lPrekoRucnogZgloba", $_POST["lPrekoRucnogZgloba"]);
		$izraz->bindParam(":dPrekoRucnogZgloba", $_POST["dPrekoRucnogZgloba"]);
		$izraz->bindParam(":lPrekoMetacarpusa", $_POST["lPrekoMetacarpusa"]);
		$izraz->bindParam(":dPrekoMetacarpusa", $_POST["dPrekoMetacarpusa"]);
		$izraz->bindParam(":lOPrsta", $_POST["lOPrsta"]);
		$izraz->bindParam(":dOPrsta", $_POST["dOPrsta"]);
		$izraz->bindParam(":l15IznadPatele", $_POST["l15IznadPatele"]);
		$izraz->bindParam(":d15IznadPatele", $_POST["d15IznadPatele"]);
		$izraz->bindParam(":lPrekoPatele", $_POST["lPrekoPatele"]);
		$izraz->bindParam(":dPrekoPatele", $_POST["dPrekoPatele"]);
		$izraz->bindParam(":l15IspodPatele", $_POST["l15IspodPatele"]);
		$izraz->bindParam(":d15IspodPatele", $_POST["d15IspodPatele"]);
		$izraz->bindParam(":lPrekoMaleola", $_POST["lPrekoMaleola"]);
		$izraz->bindParam(":dPrekoMaleola", $_POST["dPrekoMaleola"]);
		$izraz->bindParam(":lPrekoPete", $_POST["lPrekoPete"]);
		$izraz->bindParam(":dPrekoPete", $_POST["dPrekoPete"]);
		$izraz->bindParam(":lPrekoDorsumaStopala", $_POST["lPrekoDorsumaStopala"]);
		$izraz->bindParam(":dPrekoDorsumaStopala", $_POST["dPrekoDorsumaStopala"]);
		$izraz->bindParam(":CFlesh", $_POST["CFlesh"]);
		$izraz->bindParam(":indSagGibC", $_POST["indSagGibC"]);
		$izraz->bindParam(":lLatFleksC", $_POST["lLatFleksC"]);
		$izraz->bindParam(":dLatFleksC", $_POST["dLatFleksC"]);
		$izraz->bindParam(":lRotacijaC", $_POST["lRotacijaC"]);
		$izraz->bindParam(":dRotacijaC", $_POST["dRotacijaC"]);
		$izraz->bindParam(":indSagGibT", $_POST["indSagGibT"]);
		$izraz->bindParam(":ODisanja", $_POST["ODisanja"]);
		$izraz->bindParam(":indSagGibL", $_POST["indSagGibL"]);
		$izraz->bindParam(":lLatFlexTrupa", $_POST["lLatFlexTrupa"]);
		$izraz->bindParam(":dLatFlexTrupa", $_POST["dLatFlexTrupa"]);
		$izraz->bindParam(":lZnakTetiveNaLuku", $_POST["lZnakTetiveNaLuku"]);
		$izraz->bindParam(":dZnakTetiveNaLuku", $_POST["dZnakTetiveNaLuku"]);
		$izraz->bindParam(":fenomenGumeneLopte", $_POST["fenomenGumeneLopte"]);
		$izraz->bindParam(":lRameAbd", $_POST["lRameAbd"]);
		$izraz->bindParam(":dRameAbd", $_POST["dRameAbd"]);
		$izraz->bindParam(":lRameElev", $_POST["lRameElev"]);
		$izraz->bindParam(":dRameElev", $_POST["dRameElev"]);
		$izraz->bindParam(":lRameAnt", $_POST["lRameAnt"]);
		$izraz->bindParam(":dRameAnt", $_POST["dRameAnt"]);
		$izraz->bindParam(":lRameRet", $_POST["lRameRet"]);
		$izraz->bindParam(":dRameRet", $_POST["dRameRet"]);
		$izraz->bindParam(":lRameURot", $_POST["lRameURot"]);
		$izraz->bindParam(":dRameURot", $_POST["dRameURot"]);
		$izraz->bindParam(":lRameVRot", $_POST["lRameVRot"]);
		$izraz->bindParam(":dRameVRot", $_POST["dRameVRot"]);
		$izraz->bindParam(":lRameHorAbd", $_POST["lRameHorAbd"]);
		$izraz->bindParam(":dRameHorAbd", $_POST["dRameHorAbd"]);
		$izraz->bindParam(":lRameHorAdd", $_POST["lRameHorAdd"]);
		$izraz->bindParam(":dRameHorAdd", $_POST["dRameHorAdd"]);
		$izraz->bindParam(":lLakatExt", $_POST["lLakatExt"]);
		$izraz->bindParam(":dLakatExt", $_POST["dLakatExt"]);
		$izraz->bindParam(":lLakatFlex", $_POST["lLakatFlex"]);
		$izraz->bindParam(":dLakatFlex", $_POST["dLakatFlex"]);
		$izraz->bindParam(":lSupinacija", $_POST["lSupinacija"]);
		$izraz->bindParam(":dSupinacija", $_POST["dSupinacija"]);
		$izraz->bindParam(":lPronacija", $_POST["lPronacija"]);
		$izraz->bindParam(":dPronacija", $_POST["dPronacija"]);
		$izraz->bindParam(":lVolarFlex", $_POST["lVolarFlex"]);
		$izraz->bindParam(":dVolarFlex", $_POST["dVolarFlex"]);
		$izraz->bindParam(":lDorsalFlex", $_POST["lDorsalFlex"]);
		$izraz->bindParam(":dDorsalFlex", $_POST["dDorsalFlex"]);
		$izraz->bindParam(":lAbdUln", $_POST["lAbdUln"]);
		$izraz->bindParam(":dAbdUln", $_POST["dAbdUln"]);
		$izraz->bindParam(":lAbdRad", $_POST["lAbdRad"]);
		$izraz->bindParam(":dAbdRad", $_POST["dAbdRad"]);
		$izraz->bindParam(":lRPalacAbd", $_POST["lRPalacAbd"]);
		$izraz->bindParam(":dRPalacAbd", $_POST["dRPalacAbd"]);
		$izraz->bindParam(":lRPalacAdd", $_POST["lRPalacAdd"]);
		$izraz->bindParam(":dRPalacAdd", $_POST["dRPalacAdd"]);
		$izraz->bindParam(":lRPalacFlex", $_POST["lRPalacFlex"]);
		$izraz->bindParam(":dRPalacFlex", $_POST["dRPalacFlex"]);
		$izraz->bindParam(":lRPalacExt", $_POST["lRPalacExt"]);
		$izraz->bindParam(":dRPalacExt", $_POST["dRPalacExt"]);
		$izraz->bindParam(":lRPalac1ZglFlex", $_POST["lRPalac1ZglFlex"]);
		$izraz->bindParam(":dRPalac1ZglFlex", $_POST["dRPalac1ZglFlex"]);
		$izraz->bindParam(":lRPalacOpozicija", $_POST["lRPalacOpozicija"]);
		$izraz->bindParam(":dRPalacOpozicija", $_POST["dRPalacOpozicija"]);
		$izraz->bindParam(":lR2Pr1ZglExt", $_POST["lR2Pr1ZglExt"]);
		$izraz->bindParam(":dR2Pr1ZglExt", $_POST["dR2Pr1ZglExt"]);
		$izraz->bindParam(":lR2Pr1ZglFlex", $_POST["lR2Pr1ZglFlex"]);
		$izraz->bindParam(":dR2Pr1ZglFlex", $_POST["dR2Pr1ZglFlex"]);
		$izraz->bindParam(":lR2Pr2ZglFlex", $_POST["lR2Pr2ZglFlex"]);
		$izraz->bindParam(":dR2Pr2ZglFlex", $_POST["dR2Pr2ZglFlex"]);
		$izraz->bindParam(":lR2Pr3ZglFlex", $_POST["lR2Pr3ZglFlex"]);
		$izraz->bindParam(":dR2Pr3ZglFlex", $_POST["dR2Pr3ZglFlex"]);
		$izraz->bindParam(":lR3Pr1ZglExt", $_POST["lR3Pr1ZglExt"]);
		$izraz->bindParam(":dR3Pr1ZglExt", $_POST["dR3Pr1ZglExt"]);
		$izraz->bindParam(":lR3Pr1ZglFlex", $_POST["lR3Pr1ZglFlex"]);
		$izraz->bindParam(":dR3Pr1ZglFlex", $_POST["dR3Pr1ZglFlex"]);
		$izraz->bindParam(":lR3Pr2ZglFlex", $_POST["lR3Pr2ZglFlex"]);
		$izraz->bindParam(":dR3Pr2ZglFlex", $_POST["dR3Pr2ZglFlex"]);
		$izraz->bindParam(":lR3Pr3ZglFlex", $_POST["lR3Pr3ZglFlex"]);
		$izraz->bindParam(":dR3Pr3ZglFlex", $_POST["dR3Pr3ZglFlex"]);
		$izraz->bindParam(":lR4Pr1ZglExt", $_POST["lR4Pr1ZglExt"]);
		$izraz->bindParam(":dR4Pr1ZglExt", $_POST["dR4Pr1ZglExt"]);
		$izraz->bindParam(":lR4Pr1ZglFlex", $_POST["lR4Pr1ZglFlex"]);
		$izraz->bindParam(":dR4Pr1ZglFlex", $_POST["dR4Pr1ZglFlex"]);
		$izraz->bindParam(":lR4Pr2ZglFlex", $_POST["lR4Pr2ZglFlex"]);
		$izraz->bindParam(":dR4Pr2ZglFlex", $_POST["dR4Pr2ZglFlex"]);
		$izraz->bindParam(":lR4Pr3ZglFlex", $_POST["lR4Pr3ZglFlex"]);
		$izraz->bindParam(":dR4Pr3ZglFlex", $_POST["dR4Pr3ZglFlex"]);
		$izraz->bindParam(":lR5Pr1ZglExt", $_POST["lR5Pr1ZglExt"]);
		$izraz->bindParam(":dR5Pr1ZglExt", $_POST["dR5Pr1ZglExt"]);
		$izraz->bindParam(":lR5Pr1ZglFlex", $_POST["lR5Pr1ZglFlex"]);
		$izraz->bindParam(":dR5Pr1ZglFlex", $_POST["dR5Pr1ZglFlex"]);
		$izraz->bindParam(":lR5Pr2ZglFlex", $_POST["lR5Pr2ZglFlex"]);
		$izraz->bindParam(":dR5Pr2ZglFlex", $_POST["dR5Pr2ZglFlex"]);
		$izraz->bindParam(":lR5Pr3ZglFlex", $_POST["lR5Pr3ZglFlex"]);
		$izraz->bindParam(":dR5Pr3ZglFlex", $_POST["dR5Pr3ZglFlex"]);
		$izraz->bindParam(":lKukFlexIsprKoljeno", $_POST["lKukFlexIsprKoljeno"]);
		$izraz->bindParam(":dKukFlexIsprKoljeno", $_POST["dKukFlexIsprKoljeno"]);
		$izraz->bindParam(":lKukFlexSavKoljeno", $_POST["lKukFlexSavKoljeno"]);
		$izraz->bindParam(":dKukFlexSavKoljeno", $_POST["dKukFlexSavKoljeno"]);
		$izraz->bindParam(":lKukExt", $_POST["lKukExt"]);
		$izraz->bindParam(":dKukExt", $_POST["dKukExt"]);
		$izraz->bindParam(":lKukAbd", $_POST["lKukAbd"]);
		$izraz->bindParam(":dKukAbd", $_POST["dKukAbd"]);
		$izraz->bindParam(":lKukAdd", $_POST["lKukAdd"]);
		$izraz->bindParam(":dKukAdd", $_POST["dKukAdd"]);
		$izraz->bindParam(":lKukUnRot", $_POST["lKukUnRot"]);
		$izraz->bindParam(":dKukUnRot", $_POST["dKukUnRot"]);
		$izraz->bindParam(":lKukVanRot", $_POST["lKukVanRot"]);
		$izraz->bindParam(":dKukVanRot", $_POST["dKukVanRot"]);
		$izraz->bindParam(":lKoljFlex", $_POST["lKoljFlex"]);
		$izraz->bindParam(":dKoljFlex", $_POST["dKoljFlex"]);
		$izraz->bindParam(":lKoljExt", $_POST["lKoljExt"]);
		$izraz->bindParam(":dKoljExt", $_POST["dKoljExt"]);
		$izraz->bindParam(":lSkZglDorFlex", $_POST["lSkZglDorFlex"]);
		$izraz->bindParam(":dSkZglDorFlex", $_POST["dSkZglDorFlex"]);
		$izraz->bindParam(":lSkZglPlanFlex", $_POST["lSkZglPlanFlex"]);
		$izraz->bindParam(":dSkZglPlanFlex", $_POST["dSkZglPlanFlex"]);
		$izraz->bindParam(":lSkZglEver", $_POST["lSkZglEver"]);
		$izraz->bindParam(":dSkZglEver", $_POST["dSkZglEver"]);
		$izraz->bindParam(":lSkZglInv", $_POST["lSkZglInv"]);
		$izraz->bindParam(":dSkZglInv", $_POST["dSkZglInv"]);
		$izraz->bindParam(":lNPalac1ZglExt", $_POST["lNPalac1ZglExt"]);
		$izraz->bindParam(":dNPalac1ZglExt", $_POST["dNPalac1ZglExt"]);
		$izraz->bindParam(":lNPalac1ZglFlex", $_POST["lNPalac1ZglFlex"]);
		$izraz->bindParam(":dNPalac1ZglFlex", $_POST["dNPalac1ZglFlex"]);
		$izraz->bindParam(":lNPalac2ZglFlex", $_POST["lNPalac2ZglFlex"]);
		$izraz->bindParam(":dNPalac2ZglFlex", $_POST["dNPalac2ZglFlex"]);
		$izraz->bindParam(":lOrbOr", $_POST["lOrbOr"]);
		$izraz->bindParam(":dOrbOr", $_POST["dOrbOr"]);
		$izraz->bindParam(":lOrbOc", $_POST["lOrbOc"]);
		$izraz->bindParam(":dOrbOc", $_POST["dOrbOc"]);
		$izraz->bindParam(":lZyg", $_POST["lZyg"]);
		$izraz->bindParam(":dZyg", $_POST["dZyg"]);
		$izraz->bindParam(":lFront", $_POST["lFront"]);
		$izraz->bindParam(":dFront", $_POST["dFront"]);
		$izraz->bindParam(":flexCapitEtColi", $_POST["flexCapitEtColi"]);
		$izraz->bindParam(":extCapitEtColi", $_POST["extCapitEtColi"]);
		$izraz->bindParam(":rectusAbdom", $_POST["rectusAbdom"]);
		$izraz->bindParam(":extTrunci", $_POST["extTrunci"]);
		$izraz->bindParam(":lObliquiAbd", $_POST["lObliquiAbd"]);
		$izraz->bindParam(":dObliquiAbd", $_POST["dObliquiAbd"]);
		$izraz->bindParam(":lFlexLatTrunci", $_POST["lFlexLatTrunci"]);
		$izraz->bindParam(":dFlexLatTrunci", $_POST["dFlexLatTrunci"]);
		$izraz->bindParam(":lIliopsoas", $_POST["lIliopsoas"]);
		$izraz->bindParam(":dIliopsoas", $_POST["dIliopsoas"]);
		$izraz->bindParam(":lGlutMax", $_POST["lGlutMax"]);
		$izraz->bindParam(":dGlutMax", $_POST["dGlutMax"]);
		$izraz->bindParam(":lAddCoxae", $_POST["lAddCoxae"]);
		$izraz->bindParam(":dAddCoxae", $_POST["dAddCoxae"]);
		$izraz->bindParam(":lGlutMed", $_POST["lGlutMed"]);
		$izraz->bindParam(":dGlutMed", $_POST["dGlutMed"]);
		$izraz->bindParam(":lRotIntCoxae", $_POST["lRotIntCoxae"]);
		$izraz->bindParam(":dRotIntCoxae", $_POST["dRotIntCoxae"]);
		$izraz->bindParam(":lTenFasLat", $_POST["lTenFasLat"]);
		$izraz->bindParam(":dTenFasLat", $_POST["dTenFasLat"]);
		$izraz->bindParam(":lRotExtCoxae", $_POST["lRotExtCoxae"]);
		$izraz->bindParam(":dRotExtCoxae", $_POST["dRotExtCoxae"]);
		$izraz->bindParam(":lSartorius", $_POST["lSartorius"]);
		$izraz->bindParam(":dSartorius", $_POST["dSartorius"]);
		$izraz->bindParam(":lBicFem", $_POST["lBicFem"]);
		$izraz->bindParam(":dBicFem", $_POST["dBicFem"]);
		$izraz->bindParam(":lSemEtSem", $_POST["lSemEtSem"]);
		$izraz->bindParam(":dSemEtSem", $_POST["dSemEtSem"]);
		$izraz->bindParam(":lQuadFem", $_POST["lQuadFem"]);
		$izraz->bindParam(":dQuadFem", $_POST["dQuadFem"]);
		$izraz->bindParam(":lGastroc", $_POST["lGastroc"]);
		$izraz->bindParam(":dGastroc", $_POST["dGastroc"]);
		$izraz->bindParam(":lSoleus", $_POST["lSoleus"]);
		$izraz->bindParam(":dSoleus", $_POST["dSoleus"]);
		$izraz->bindParam(":lTibAnt", $_POST["lTibAnt"]);
		$izraz->bindParam(":dTibAnt", $_POST["dTibAnt"]);
		$izraz->bindParam(":lTibPost", $_POST["lTibPost"]);
		$izraz->bindParam(":dTibPost", $_POST["dTibPost"]);
		$izraz->bindParam(":lPer", $_POST["lPer"]);
		$izraz->bindParam(":dPer", $_POST["dPer"]);
		$izraz->bindParam(":lLumbEtInterPed", $_POST["lLumbEtInterPed"]);
		$izraz->bindParam(":dLumbEtInterPed", $_POST["dLumbEtInterPed"]);
		$izraz->bindParam(":lFlexDigBre", $_POST["lFlexDigBre"]);
		$izraz->bindParam(":dFlexDigBre", $_POST["dFlexDigBre"]);
		$izraz->bindParam(":lFlexDigLon", $_POST["lFlexDigLon"]);
		$izraz->bindParam(":dFlexDigLon", $_POST["dFlexDigLon"]);
		$izraz->bindParam(":lExtDigLon", $_POST["lExtDigLon"]);
		$izraz->bindParam(":dExtDigLon", $_POST["dExtDigLon"]);
		$izraz->bindParam(":lExtDigCom", $_POST["lExtDigCom"]);
		$izraz->bindParam(":dExtDigCom", $_POST["dExtDigCom"]);
		$izraz->bindParam(":lFlexHalLon", $_POST["lFlexHalLon"]);
		$izraz->bindParam(":dFlexHalLon", $_POST["dFlexHalLon"]);
		$izraz->bindParam(":lFlexHalBre", $_POST["lFlexHalBre"]);
		$izraz->bindParam(":dFlexHalBre", $_POST["dFlexHalBre"]);
		$izraz->bindParam(":lExtHalLon", $_POST["lExtHalLon"]);
		$izraz->bindParam(":dExtHalLon", $_POST["dExtHalLon"]);
		$izraz->bindParam(":lSerrAnt", $_POST["lSerrAnt"]);
		$izraz->bindParam(":dSerrAnt", $_POST["dSerrAnt"]);
		$izraz->bindParam(":lTrapDesc", $_POST["lTrapDesc"]);
		$izraz->bindParam(":dTrapDesc", $_POST["dTrapDesc"]);
		$izraz->bindParam(":lTrapAsc", $_POST["lTrapAsc"]);
		$izraz->bindParam(":dTrapAsc", $_POST["dTrapAsc"]);
		$izraz->bindParam(":lRhomb", $_POST["lRhomb"]);
		$izraz->bindParam(":dRhomb", $_POST["dRhomb"]);
		$izraz->bindParam(":lDeltClav", $_POST["lDeltClav"]);
		$izraz->bindParam(":dDeltClav", $_POST["dDeltClav"]);
		$izraz->bindParam(":lDeltAcr", $_POST["lDeltAcr"]);
		$izraz->bindParam(":dDeltAcr", $_POST["dDeltAcr"]);
		$izraz->bindParam(":lDeltSpin", $_POST["lDeltSpin"]);
		$izraz->bindParam(":dDeltSpin", $_POST["dDeltSpin"]);
		$izraz->bindParam(":lLattDor", $_POST["lLattDor"]);
		$izraz->bindParam(":dLattDor", $_POST["dLattDor"]);
		$izraz->bindParam(":lPectMaj", $_POST["lPectMaj"]);
		$izraz->bindParam(":dPectMaj", $_POST["dPectMaj"]);
		$izraz->bindParam(":lRotExtBra", $_POST["lRotExtBra"]);
		$izraz->bindParam(":dRotExtBra", $_POST["dRotExtBra"]);
		$izraz->bindParam(":lRotIntBra", $_POST["lRotIntBra"]);
		$izraz->bindParam(":dRotIntBra", $_POST["dRotIntBra"]);
		$izraz->bindParam(":lBicBra", $_POST["lBicBra"]);
		$izraz->bindParam(":dBicBra", $_POST["dBicBra"]);
		$izraz->bindParam(":lBrachialis", $_POST["lBrachialis"]);
		$izraz->bindParam(":dBrachialis", $_POST["dBrachialis"]);
		$izraz->bindParam(":lBrachioradialis", $_POST["lBrachioradialis"]);
		$izraz->bindParam(":dBrachioradialis", $_POST["dBrachioradialis"]);
		$izraz->bindParam(":lTriBra", $_POST["lTriBra"]);
		$izraz->bindParam(":dTriBra", $_POST["dTriBra"]);
		$izraz->bindParam(":lSupinator", $_POST["lSupinator"]);
		$izraz->bindParam(":dSupinator", $_POST["dSupinator"]);
		$izraz->bindParam(":lPron", $_POST["lPron"]);
		$izraz->bindParam(":dPron", $_POST["dPron"]);
		$izraz->bindParam(":lFlexCarpRad", $_POST["lFlexCarpRad"]);
		$izraz->bindParam(":dFlexCarpRad", $_POST["dFlexCarpRad"]);
		$izraz->bindParam(":lFlexCarpUln", $_POST["lFlexCarpUln"]);
		$izraz->bindParam(":dFlexCarpUln", $_POST["dFlexCarpUln"]);
		$izraz->bindParam(":lExtCarpRad", $_POST["lExtCarpRad"]);
		$izraz->bindParam(":dExtCarpRad", $_POST["dExtCarpRad"]);
		$izraz->bindParam(":lExtCarpUln", $_POST["lExtCarpUln"]);
		$izraz->bindParam(":dExtCarpUln", $_POST["dExtCarpUln"]);
		$izraz->bindParam(":lLumbEtInterossei", $_POST["lLumbEtInterossei"]);
		$izraz->bindParam(":dLumbEtInterossei", $_POST["dLumbEtInterossei"]);
		$izraz->bindParam(":lExtDigComCarp", $_POST["lExtDigComCarp"]);
		$izraz->bindParam(":dExtDigComCarp", $_POST["dExtDigComCarp"]);
		$izraz->bindParam(":lFlexDigSubl", $_POST["lFlexDigSubl"]);
		$izraz->bindParam(":dFlexDigSubl", $_POST["dFlexDigSubl"]);
		$izraz->bindParam(":lFlexDigProf", $_POST["lFlexDigProf"]);
		$izraz->bindParam(":dFlexDigProf", $_POST["dFlexDigProf"]);
		$izraz->bindParam(":lAddDig", $_POST["lAddDig"]);
		$izraz->bindParam(":dAddDig", $_POST["dAddDig"]);
		$izraz->bindParam(":lAbdDig", $_POST["lAbdDig"]);
		$izraz->bindParam(":dAbdDig", $_POST["dAbdDig"]);
		$izraz->bindParam(":lAbdPol", $_POST["lAbdPol"]);
		$izraz->bindParam(":dAbdPol", $_POST["dAbdPol"]);
		$izraz->bindParam(":lAddPol", $_POST["lAddPol"]);
		$izraz->bindParam(":dAddPol", $_POST["dAddPol"]);
		$izraz->bindParam(":lOppon", $_POST["lOppon"]);
		$izraz->bindParam(":dOppon", $_POST["dOppon"]);
		$izraz->bindParam(":lFlexPolBre", $_POST["lFlexPolBre"]);
		$izraz->bindParam(":dFlexPolBre", $_POST["dFlexPolBre"]);
		$izraz->bindParam(":lFlexPolLon", $_POST["lFlexPolLon"]);
		$izraz->bindParam(":dFlexPolLon", $_POST["dFlexPolLon"]);
		$izraz->bindParam(":lExtPolBre", $_POST["lExtPolBre"]);
		$izraz->bindParam(":dExtPolBre", $_POST["dExtPolBre"]);
		$izraz->bindParam(":lExtPolLon", $_POST["lExtPolLon"]);
		$izraz->bindParam(":dExtPolLon", $_POST["dExtPolLon"]);
		$izraz->bindParam(":lSakaDinam", $_POST["lSakaDinam"]);
		$izraz->bindParam(":dSakaDinam", $_POST["dSakaDinam"]);
		$izraz->bindParam(":neHoda", $_POST["neHoda"]);
		$izraz->bindParam(":hodSaStakama", $_POST["hodSaStakama"]);
		$izraz->bindParam(":stoji", $_POST["stoji"]);
		$izraz->bindParam(":hodSaStapovima", $_POST["hodSaStapovima"]);
		$izraz->bindParam(":hodSaAparatima", $_POST["hodSaAparatima"]);
		$izraz->bindParam(":hodSamostalno", $_POST["hodSamostalno"]);
		$izraz->bindParam(":hodSaKorzetom", $_POST["hodSaKorzetom"]);
		$izraz->bindParam(":ideStepenicama", $_POST["ideStepenicama"]);
		$izraz->bindParam(":pomocniAparati", $_POST["pomocniAparati"]);
		$izraz->bindParam(":scoliosis", $_POST["scoliosis"]);
		$izraz->bindParam(":id", $_POST["hfMjereId"]);
		$izraz->execute();
	}

	public function ispisMjera($doktorica=false){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		if(!empty($this->isMesurements())){
			
			$uneseneMjere = array(); //unešene mjere sa vrijednostima
			$naziviUnesenihMjera = array(); //nazivi unešenih mjera bez lijeva-desna, samo imena 
			$datumiLijevo = array(); //datumi lijevo
			$mjerePoDatumima = array(); //naziv ključa je datum mjere a vrijednost je klasa $mjere
			$neHoda = "";
			$hodSaStakama = "";
			$stoji = "";
			$hodSaStapovima = "";
			$hodSaAparatima = "";
			$hodSamostalno = "";
			$hodSaKorzetom = "";
			$ideStepenicama = "";
			$pomocniAparati = "";
			$scoliosis = "";
			
			//dohvati sve mjere
			$izraz = $veza->prepare("select * from kartoni_mjere where osoba_id=:id order by datum desc;");
			$izraz->bindParam(":id", $this->osoba_id);
			$izraz->execute();		
			$mjere = $izraz->fetchAll(PDO::FETCH_OBJ);
			
			$unosMjeraZaDoktoricu = true;
			$mjereZaDoktoricuLijevo = array();
			$mjereZaDoktoricuDesno = array();
			$nizZaDoktoricuLijevo = "";
			$nizZaDoktoricuDesno = "";
			
			//popuni nizove mjera iz tablice i vrijednosti varijabli ostalih mjera
			foreach ($mjere as $mjera) {
				
				if($doktorica==true){
					/*posebno popunjavanje mjera da doktorica može raditi copy paste u nalaz*/
					if($unosMjeraZaDoktoricu==true){
						$bolesnaStrana = $mjera->bolesnaStrana;
						foreach($mjera as $key=>$value){
							if($value!="" && $key!="id" && $key!="osoba_id" && $key!="bolesnaStrana" && $key!="datum" && $key!="neHoda" && $key!="hodSaStakama" &&
							   $key!="stoji" && $key!="hodSaStapovima" && $key!="hodSaAparatima" && $key!="hodSamostalno" && 
							   $key!="hodSaKorzetom" && $key!="ideStepenicama" && $key!="pomocniAparati" && $key!="scoliosis"){
								   
								if(preg_match('/^l.*$/i', $key) && ($bolesnaStrana==1 || $bolesnaStrana==3)){
									$mjereZaDoktoricuLijevo[$key]=$value;
								}
								
								if(preg_match('/^d.*$/i', $key) && ($bolesnaStrana==2 || $bolesnaStrana==3)){
									$mjereZaDoktoricuDesno[$key]=$value;
								}
								
							}
						}
						
						$unosMjeraZaDoktoricu=false;
					}
					/*završene posebne mjere za doktoricu*/
					
					if($mjera->neHoda!="") { $neHoda = $mjera->neHoda; }
					if($mjera->hodSaStakama!="") { $hodSaStakama = $mjera->hodSaStakama; }
					if($mjera->stoji!="") { $stoji = $mjera->stoji; }
					if($mjera->hodSaStapovima!="") { $hodSaStapovima = $mjera->hodSaStapovima; }
					if($mjera->hodSaAparatima!="") { $hodSaAparatima = $mjera->hodSaAparatima; }
					if($mjera->hodSamostalno!="") { $hodSamostalno = $mjera->hodSamostalno; }
					if($mjera->hodSaKorzetom!="") { $hodSaKorzetom = $mjera->hodSaKorzetom; }
					if($mjera->ideStepenicama!="") { $ideStepenicama = $mjera->ideStepenicama; }
					if($mjera->pomocniAparati!="") { $pomocniAparati = $mjera->pomocniAparati; }
					if($mjera->scoliosis!="") { $scoliosis = $mjera->scoliosis; }
				}else{
					if($mjera->neHoda!="") { $neHoda = "<a href='../mjere/promjena.php?id=" . $mjera->id . "&nazivMjere=neHoda&osoba_id=" . 
													   $mjera->osoba_id . "&karton_id=" . $_GET["id"] . "'>" . $mjera->neHoda . "</a>"; }
					if($mjera->hodSaStakama!="") { $hodSaStakama = "<a href='../mjere/promjena.php?id=" . $mjera->id . "&nazivMjere=hodSaStakama&osoba_id=" . 
													   $mjera->osoba_id . "&karton_id=" . $_GET["id"] . "'>" . $mjera->hodSaStakama . "</a>"; }
					if($mjera->stoji!="") { $stoji = "<a href='../mjere/promjena.php?id=" . $mjera->id . "&nazivMjere=stoji&osoba_id=" . 
													   $mjera->osoba_id . "&karton_id=" . $_GET["id"] . "'>" . $mjera->stoji . "</a>"; }
					if($mjera->hodSaStapovima!="") { $hodSaStapovima = "<a href='../mjere/promjena.php?id=" . $mjera->id . "&nazivMjere=hodSaStapovima&osoba_id=" . 
													   $mjera->osoba_id . "&karton_id=" . $_GET["id"] . "'>" . $mjera->hodSaStapovima . "</a>"; }
					if($mjera->hodSaAparatima!="") { $hodSaAparatima = "<a href='../mjere/promjena.php?id=" . $mjera->id . "&nazivMjere=hodSaAparatima&osoba_id=" . 
													   $mjera->osoba_id . "&karton_id=" . $_GET["id"] . "'>" . $mjera->hodSaAparatima . "</a>"; }
					if($mjera->hodSamostalno!="") { $hodSamostalno = "<a href='../mjere/promjena.php?id=" . $mjera->id . "&nazivMjere=hodSamostalno&osoba_id=" . 
													   $mjera->osoba_id . "&karton_id=" . $_GET["id"] . "'>" . $mjera->hodSamostalno . "</a>"; }
					if($mjera->hodSaKorzetom!="") { $hodSaKorzetom = "<a href='../mjere/promjena.php?id=" . $mjera->id . "&nazivMjere=hodSaKorzetom&osoba_id=" . 
													   $mjera->osoba_id . "&karton_id=" . $_GET["id"] . "'>" . $mjera->hodSaKorzetom . "</a>"; }
					if($mjera->ideStepenicama!="") { $ideStepenicama = "<a href='../mjere/promjena.php?id=" . $mjera->id . "&nazivMjere=ideStepenicama&osoba_id=" . 
													   $mjera->osoba_id . "&karton_id=" . $_GET["id"] . "'>" . $mjera->ideStepenicama . "</a>"; }
					if($mjera->pomocniAparati!="") { $pomocniAparati = "<a href='../mjere/promjena.php?id=" . $mjera->id . "&nazivMjere=pomocniAparati&osoba_id=" . 
													   $mjera->osoba_id . "&karton_id=" . $_GET["id"] . "'>" . $mjera->pomocniAparati . "</a>"; }
					if($mjera->scoliosis!="") { $scoliosis = "<a href='../mjere/promjena.php?id=" . $mjera->id . "&nazivMjere=scoliosis&osoba_id=" . 
													   $mjera->osoba_id . "&karton_id=" . $_GET["id"] . "'>" . $mjera->scoliosis . "</a>"; }
				}
				
				$mjerePoDatumima[$mjera->datum] = $mjera;
				array_push($datumiLijevo, $mjera->datum);
				foreach ($mjera as $key => $value) {
					//popuni niz sa mjera koje su unešene
					if(strlen($value)>0 && !in_array($key, $uneseneMjere) && $key!='id' && 
					 	$key!='osoba_id' && $key!='datum' && $key!='bolesnaStrana' && 
					 	$key!='neHoda' && $key!='hodSaStakama' && $key!='stoji' && 
					 	$key!='hodSaStapovima' && $key!='hodSaAparatima' && $key!='hodSamostalno' && 
					 	$key!='hodSaKorzetom' && $key!='ideStepenicama' && $key!='pomocniAparati' && 
					 	$key!='scoliosis'){ 
					 	$uneseneMjere[$key] = $value;
						
						//popuni niz sa nazivima mjera bez razlike lijevo-desno i bez l ili d na početku naziva
						if(preg_match('/^l.*$/i', $key)){
							$key = ltrim($key, "l");
							if(!in_array($key, $naziviUnesenihMjera)){
								array_push($naziviUnesenihMjera, $key);
							}
							
						}
						
						if(preg_match('/^d.*$/i', $key)){
							$key = ltrim($key, "d");
							if(!in_array($key, $naziviUnesenihMjera)){
								array_push($naziviUnesenihMjera, $key);
							}
							
						}
						
						
					 }
				}			
			}
			
			//datumi desno
			$datumiDesno = array_reverse($datumiLijevo);
			
			//zbroj datuma da se zna colspan za naslov tablice
			$brojDatuma = (count($datumiDesno)*2) + 1;
		
		
			//početak html tablice sa mjerama
			$html = "<table style='border-collapse: collapse; border: 1px solid black; margin: 0 auto;' class='mb100'><thead><tr><th style='text-align: center; vertical-align: middle;' colspan=" . $brojDatuma . ">Mjere</th></tr><tr>";
			
			
			//popunjavanje zaglavlja tablice sa datumima sa lijeve strane
			foreach ($datumiLijevo as $key => $datum) {
				$html .= "<th style='border: 1px black solid; font-size: 0.7rem; text-align: center; vertical-align: middle;'>" . $this->datum($datum) . "</th>";
			}
			
			$html .= "<th style='border: 1px black solid; font-size: 0.7rem; text-align: center; vertical-align: middle;'>Naziv mjere</th>";
			
			//popunjavanje zaglavlja tablice sa datumima sa desne strane
			foreach ($datumiDesno as $key => $datum) {
				$html .= "<th style='border: 1px black solid; font-size: 0.7rem; text-align: center; vertical-align: middle;'>" . $this->datum($datum) . "</th>";
			}
			
			$html .= "</tr></thead><tbody>";
			foreach ($naziviUnesenihMjera as $key => $nazivMjere) {
				$nazivMjereLijevo = "l" . $nazivMjere;
				$nazivMjereDesno = "d" . $nazivMjere;
				
				$html .= "<tr style='border: 1px black solid;'>";
				
				foreach ($datumiLijevo as $key => $datumMjereLijevo) {
					
					$html .= "<td style='border: 1px black solid; font-size: 0.7rem; text-align: center; vertical-align: middle;'>";					
					if($doktorica==false){
						$html .= "<a href='../mjere/promjena.php?id=" . $mjerePoDatumima[$datumMjereLijevo]->id . "&nazivMjere=" . 
																	$nazivMjereLijevo . "&osoba_id=" . $mjera->osoba_id . 
																	"&karton_id=" . $_GET["id"] . "'>" .
																	$mjerePoDatumima[$datumMjereLijevo]->$nazivMjereLijevo . 
								"</a>";	
					}else{
						$html .= $mjerePoDatumima[$datumMjereLijevo]->$nazivMjereLijevo;
					}								
						$html .= "</td>";
				}
				
				$html .= "<td style='border: 1px black solid; font-size: 0.7rem; text-align: center; vertical-align: middle;'>" . $this->nazivMjere($nazivMjere) . "</td>";
				
				foreach ($datumiDesno as $key => $datumMjereDesno) {
					$html .= "<td style='border: 1px black solid; font-size: 0.7rem; text-align: center; vertical-align: middle;'>";
					if($doktorica==false){
						$html .= "<a href='../mjere/promjena.php?id=" . $mjerePoDatumima[$datumMjereDesno]->id . "&nazivMjere=" . 
																	$nazivMjereDesno . "&osoba_id=" . $mjera->osoba_id . 
																	"&karton_id=" . $_GET["id"] . "'>" .
																	$mjerePoDatumima[$datumMjereDesno]->$nazivMjereDesno . 
								"</a>";	
					}else{
						$html .= $mjerePoDatumima[$datumMjereDesno]->$nazivMjereDesno;
					}								
						$html .= "</td>";
				}
				$html .= "</tr>";
			}
			
			
			$html .= "</tbody></table>";
			if($doktorica==true){
			$html .= ($neHoda!="" || $hodSaStakama!="" || $stoji!="" || $hodSaStapovima!="" || $hodSaAparatima!=""
					  || $hodSamostalno!="" || $hodSaKorzetom!="" || $ideStepenicama!="" || $pomocniAparati!="" || $scoliosis!="") ? 
					  "<h5 class='mt30 lhDetalji'><i>Dodatno</i></h5>" : "";
			}		  
			$html .= ($neHoda!="") ? "<p class='mb0 p0 lhDetalji'>Ne hoda od: " . $neHoda . "</p>" : "";
			$html .= ($hodSaStakama!="") ? "<p class='mb0 p0 lhDetalji'>Hoda sa štakama od: " . $hodSaStakama . "</p>" : "";
			$html .= ($stoji!="") ? "<p class='mb0 p0 lhDetalji'>Stoji od: " . $stoji . "</p>" : "";
			$html .= ($hodSaStapovima!="") ? "<p class='mb0 p0 lhDetalji'>Hoda sa štapovima od: " . $hodSaStapovima . "</p>" : "";
			$html .= ($hodSaAparatima!="") ? "<p class='mb0 p0 lhDetalji'>Hoda sa aparatima od: " . $hodSaAparatima . "</p>" : "";
			$html .= ($hodSamostalno!="") ? "<p class='mb0 p0 lhDetalji'>Hoda samostalno od: " . $hodSamostalno . "</p>" : "";
			$html .= ($hodSaKorzetom!="") ? "<p class='mb0 p0 lhDetalji'>Hoda sa korzetom od: " . $hodSaKorzetom . "</p>" : "";
			$html .= ($ideStepenicama!="") ? "<p class='mb0 p0 lhDetalji'>Ide stepenicama od: " . $ideStepenicama . "</p>" : "";
			$html .= ($pomocniAparati!="") ? "<p class='mb0 p0 lhDetalji'>Pomoćni aparati: " . $pomocniAparati . "</p>" : "";
			$html .= ($scoliosis!="") ? "<p class='mb0 p0 lhDetalji'>Scoliosi i drugi deformiteti: " . $scoliosis . "</p>" : "";


			if($doktorica==true){
				if(isset($_POST["ispisKartona"])){ //budući da se ista metoda koristi i za doktoricu i za ispis kartona grupe postavljen je filter
					$html .= "<div class='row'>
								<div class='large-12 columns'>							
									<p style='font-size: 0.8rem; margin-top: 10mm;'><b>Zadnje mjere</b></p>";							
				
									if(!empty($mjereZaDoktoricuLijevo)){
										foreach($mjereZaDoktoricuLijevo as $key=>$value){
											$nazivMjereZaDoktoricu = ltrim($key, "l");
											$nizZaDoktoricuLijevo .= lcfirst($this->puniNazivMjereZaDoktoricu($nazivMjereZaDoktoricu)) . " <b>" . $value . "</b>, ";							
										}
										
										$nizZaDoktoricuLijevo = "<b>Lijeva strana:</b> " . rtrim($nizZaDoktoricuLijevo, ", ");
										
										$html .= "<p style='font-size: 0.8rem;'>" . $nizZaDoktoricuLijevo . "</p>";
									}
									
									if(!empty($mjereZaDoktoricuDesno)){
										foreach($mjereZaDoktoricuDesno as $key=>$value){
											$nazivMjereZaDoktoricu = ltrim($key, "d");
											$nizZaDoktoricuDesno .= lcfirst($this->puniNazivMjereZaDoktoricu($nazivMjereZaDoktoricu)) . " <b>" . $value . "</b>, ";						
										}
										
										$nizZaDoktoricuDesno = "<b>Desna strana:</b> " . rtrim($nizZaDoktoricuDesno, ", ");
										$html .= "<p style='font-size: 0.8rem;'>" . $nizZaDoktoricuDesno . "</p>";
									}
					$html .= "</div></div>";
				}else{
					$html .= "<div class='row'>
								<div class='large-12 columns item-to-copy'>
								<button id='gumbKopiranja' class='copy button' onclick='promijeniTekst()'>
									Kopiraj zadnje mjere
								</button>
								<div class='text-to-copy bijelaPozadina'>
									<p style='font-size: 0.8rem; margin-top: 10mm;'><b>Zadnje mjere</b></p>";							
					
									if(!empty($mjereZaDoktoricuLijevo)){
										foreach($mjereZaDoktoricuLijevo as $key=>$value){
											$nazivMjereZaDoktoricu = ltrim($key, "l");
											$nizZaDoktoricuLijevo .= lcfirst($this->puniNazivMjereZaDoktoricu($nazivMjereZaDoktoricu)) . " <b>" . $value . "</b>, ";							
										}
										
										$nizZaDoktoricuLijevo = "<b>Lijeva strana:</b> " . rtrim($nizZaDoktoricuLijevo, ", ");
										
										$html .= "<p style='font-size: 0.8rem;'>" . $nizZaDoktoricuLijevo . "</p>";
									}
									
									if(!empty($mjereZaDoktoricuDesno)){
										foreach($mjereZaDoktoricuDesno as $key=>$value){
											$nazivMjereZaDoktoricu = ltrim($key, "d");
											$nizZaDoktoricuDesno .= lcfirst($this->puniNazivMjereZaDoktoricu($nazivMjereZaDoktoricu)) . " <b>" . $value . "</b>, ";						
										}
										
										$nizZaDoktoricuDesno = "<b>Desna strana:</b> " . rtrim($nizZaDoktoricuDesno, ", ");
										$html .= "<p style='font-size: 0.8rem;'>" . $nizZaDoktoricuDesno . "</p>";
									}
					$html .= "</div></div>";
				}				
			}
				
				return $html;
		}
	}

	private function datum($str){
		$date = (empty($str)) ? null :  date("d.m.Y.", strtotime($str));
		$array = str_split($date, 6); 

    	return implode("<br>", $array);
	}
	
	private function nazivMjere($str){
		
		switch ($str) {
			case 'PolazisteDeltoideusa':
				$naziv = 'Na polazištu m. deltoideusa';
				break;
			
			case 'HvatisteDeltoideusa':
				$naziv = 'Na hvatištu m. deltoideusa';
				break;
				
			case 'SredinaNadlaktice':
				$naziv = 'Po sredini nadlaktice';
				break;
				
			case 'PrekoOlekranona':
				$naziv = 'Preko olekranona';
				break;
				
			case 'PrekoSredinePodlaktice':
				$naziv = 'Po sredini podlaktice';
				break;
				
			case 'PrekoRucnogZgloba':
				$naziv = 'Preko ručnog zgloba';
				break;
				
			case 'PrekoMetacarpusa':
				$naziv = 'Preko MCP zgloba';
				break;
				
			case 'OPrsta':
				$naziv = 'Opeg prsta (prst, cm)';
				break;
				
			case '15IznadPatele':
				$naziv = '15cm iznad gornjeg ruba patele';
				break;
			
			case 'PrekoPatele':
				$naziv = 'Preko patele';
				break;
				
			case '15IspodPatele':
				$naziv = '15cm ispod donjeg ruba patele';
				break;
				
			case 'PrekoMaleola':
				$naziv = 'Preko maleola';
				break;
				
			case 'PrekoPete':
				$naziv = 'Preko pete pod kutom od 45°';
				break;
				
			case 'PrekoDorsumaStopala':
				$naziv = 'Preko najistaknutije točke dorsuma stopala';
				break;
				
			case 'CFlesh':
				$naziv = 'Cervikalni fleš u cm';
				break;
				
			case 'IndSagGibC':
				$naziv = 'Indeks sag. giblj. vrata';
				break;
			
			case 'LatFleksC':
				$naziv = 'Laterofleksija vrata u cm';
				break;
				
			case 'RotacijaC':
				$naziv = 'Rotacija vrata';
				break;
				
			case 'IndSagGibT':
				$naziv = 'Indeks sag. giblj. torakalne kralj.';
				break;
				
			case 'ODisanja':
				$naziv = 'Opseg disanja';
				break;
				
			case 'IndSagGibL':
				$naziv = 'Indeks sag. giblj. lumblane kralj.';
				break;
				
			case 'LatFlexTrupa':
				$naziv = 'Laterofleksija trupa';
				break;
				
			case 'ZnakTetiveNaLuku':
				$naziv = 'Znak tetive na luku';
				break;
				
			case 'FenomenGumeneLopte':
				$naziv = 'Fenomen gumene lopte';
				break;
				
			case 'RameAbd':
				$naziv = 'Abdukcija ramena (90°)';
				break;
				
			case 'RameElev':
				$naziv = 'Elevacija ramena (75°)';
				break;
				
			case 'RameAnt':
				$naziv = 'Antefleksija ramena (165°)';
				break;
				
			case 'RameRet':
				$naziv = 'Retrofleksija ramena (75°)';
				break;
				
			case 'RameURot':
				$naziv = 'Unutarnja rotacija ramena (90°)';
				break;
			
			case 'RameVRot':
				$naziv = 'Vanjska rotacija ramena (90°)';
				break;
				
			case 'RameHorAbd':
				$naziv = 'Horiz. abdukcija ramena (45°)';
				break;
				
			case 'RameHorAdd':
				$naziv = 'Horiz. addukcija ramena (135°)';
				break;
				
			case 'LakatExt':
				$naziv = 'Ekstenzija lakta (0°)';
				break;
				
			case 'LakatFlex':
				$naziv = 'Fleksija lakta (135°)';
				break;
				
			case 'Supinacija':
				$naziv = 'Supinacija podlaktice (80-90°)';
				break;
				
			case 'Pronacija':
				$naziv = 'Pronacija podlaktice (80-90°)';
				break;
				
			case 'VolarFlex':
				$naziv = 'Volarna fleksija šake (60-70°)';
				break;

			case 'DorsalFlex':
				$naziv = 'Dorzalna fleksija šake (60°)';
				break;
				
			case 'AbdUln':
				$naziv = 'Ulnarna abdukcija šake (50°)';
				break;
				
			case 'AbdRad':
				$naziv = 'Radijalna abdukcija šake (40°)';
				break;
				
			case 'RPalacAbd':
				$naziv = 'Abdukcija palca ruke (90°)';
				break;
				
			case 'RPalacAdd':
				$naziv = 'Addukcija palca ruke (0°)';
				break;
				
			case 'RPalacFlex':
				$naziv = 'Flex. MCP palca ruke (90°)';
				break;
			
			case 'RPalacExt':
				$naziv = 'Ext. MCP palca ruke (0°)';
				break;
			
			case 'RPalac1ZglFlex':
				$naziv = 'Flex. IF palca ruke (90°)';
				break;
				
			case 'RPalacOpozicija':
				$naziv = 'Opozicija (cm između vrhova I. i V. prsta)';
				break;

			case 'R2Pr1ZglExt':
				$naziv = 'II prst šake - ekstenzija MCP (0°)';
				break;
				
			case 'R2Pr1ZglFlex':
				$naziv = 'II prst šake - fleksija MCP (90°)';
				break;
				
			case 'R2Pr2ZglFlex':
				$naziv = 'II prst šake - fleksija PIP (100°)';
				break;
				
			case 'R2Pr3ZglFlex':
				$naziv = 'II prst šake - fleksija DIP (80°)';
				break;

			case 'R3Pr1ZglExt':
				$naziv = 'III prst šake - ekstenzija MCP (0°)';
				break;
				
			case 'R3Pr1ZglFlex':
				$naziv = 'III prst šake - fleksija MCP (90°)';
				break;
				
			case 'R3Pr2ZglFlex':
				$naziv = 'III prst šake - fleksija PIP (100°)';
				break;
				
			case 'R3Pr3ZglFlex':
				$naziv = 'III prst šake - fleksija DIP (80°)';
				break;

			case 'R4Pr1ZglExt':
				$naziv = 'IV prst šake - ekstenzija MCP (0°)';
				break;
				
			case 'R4Pr1ZglFlex':
				$naziv = 'IV prst šake - fleksija MCP (90°)';
				break;
				
			case 'R4Pr2ZglFlex':
				$naziv = 'IV prst šake - fleksija PIP (100°)';
				break;
				
			case 'R4Pr3ZglFlex':
				$naziv = 'IV prst šake - fleksija DIP (80°)';
				break;

			case 'R5Pr1ZglExt':
				$naziv = 'V prst šake - ekstenzija MCP (0°)';
				break;
				
			case 'R5Pr1ZglFlex':
				$naziv = 'V prst šake - fleksija MCP (90°)';
				break;
				
			case 'R5Pr2ZglFlex':
				$naziv = 'V prst šake - fleksija PIP (100°)';
				break;
				
			case 'R5Pr3ZglFlex':
				$naziv = 'V prst šake - fleksija DIP (80°)';
				break;

			case 'KukFlexIsprKoljeno':
				$naziv = 'Fleksija kuka opruženim koljenom (80°)';
				break;
				
			case 'KukFlexSavKoljeno':
				$naziv = 'Fleksija kuka savijenim koljenom (100°)';
				break;
				
			case 'KukExt':
				$naziv = 'Ekstenzija kuka (20°)';
				break;

			case 'KukAbd':
				$naziv = 'Abdukcija kuka (50°)';
				break;
				
			case 'KukAdd':
				$naziv = 'Addukcija kuka (30°)';
				break;
				
			case 'KukUnRot':
				$naziv = 'Unutarnja rotacija kuka (50°)';
				break;
				
			case 'KukVanRot':
				$naziv = 'Vanjska rotacija kuka (40°)';
				break;
				
			case 'KoljFlex':
				$naziv = 'Fleksija koljena (135°)';
				break;
				
			case 'KoljExt':
				$naziv = 'Ekstenzija koljena (0°)';
				break;	
				
			case 'SkZglDorFlex':
				$naziv = 'Dorz. fleks. skočnog zgloba (25°)';
				break;
				
			case 'SkZglPlanFlex':
				$naziv = 'Plant. fleks. skočnog zgloba (40°)';
				break;
				
			case 'SkZglEver':
				$naziv = 'Everzija stopala (30°)';
				break;
				
			case 'SkZglInv':
				$naziv = 'Inverzija stopala (40°)';
				break;		
				
			case 'NPalac1ZglExt':
				$naziv = 'Ekst. osnovnog zgl. nožnog palca (0°)';
				break;
				
			case 'NPalac1ZglFlex':
				$naziv = 'Fleks. osnovnog zgl. nožnog palca (40°)';
				break;
				
			case 'NPalac2ZglFlex':
				$naziv = 'Fleks. krajnjeg zgl. nožnog palca (45°)';
				break;	
				
			case 'OrbOr':
				$naziv = 'Orbicularis oris';
				break;
				
			case 'OrbOc':
				$naziv = 'Orbicularis oculi';
				break;			
	
			case 'Zyg':
				$naziv = 'Zygomaticus';
				break;			
	
			case 'Front':
				$naziv = 'Frontalis';
				break;
				
			case 'FlexCapitEtColi':
				$naziv = 'Flexores capitis et colli';
				break;	
				
			case 'ExtCapitEtColi':
				$naziv = 'Extensores capitis et colli';
				break;
				
			case 'RectusAbdom':
				$naziv = 'Rectus abdominis';
				break;
				
			case 'ExtTrunci':
				$naziv = 'Extensore trunci';
				break;
				
			case 'ObliquiAbd':
				$naziv = 'Obliqui abdominis';
				break;		
				
			case 'FlexLatTrunci':
				$naziv = 'Felxores lateralis trunci';
				break;	
				
			case 'Iliopsoas':
				$naziv = 'Iliopsoas';
				break;
				
			case 'GlutMax':
				$naziv = 'Gluteus maximus';
				break;		
				
			case 'AddCoxae':
				$naziv = 'Adductores coxae';
				break;	
				
			case 'GlutMed':
				$naziv = 'Gluteus medius';
				break;
				
			case 'RotIntCoxae':
				$naziv = 'Rotatores interni coxae';
				break;
				
			case 'TenFasLat':
				$naziv = 'Tensor fasciae latae';
				break;
				
			case 'RotExtCoxae':
				$naziv = 'Rotatores externi coxae';
				break;		
				
			case 'Sartorius':
				$naziv = 'Sartorius';
				break;		
				
			case 'BicFem':
				$naziv = 'Biseps femoris';
				break;
				
			case 'SemEtSem':
				$naziv = 'Semitendinosus et semimembranosus';
				break;		
				
			case 'QuadFem':
				$naziv = 'Quadriceps femoris';
				break;	
				
			case 'Gastroc':
				$naziv = 'Gastrocnemius';
				break;		
				
			case 'Soleus':
				$naziv = 'Soleus';
				break;		
				
			case 'TibAnt':
				$naziv = 'Tibialis anterior';
				break;
				
			case 'TibPost':
				$naziv = 'Tibialis posterior';
				break;		
				
			case 'Per':
				$naziv = 'Peroneus';
				break;		
				
			case 'LumbEtInterPed':
				$naziv = 'Lumbricales et interossei pedii';
				break;
				
			case 'FlexDigBre':
				$naziv = 'Flexor digitorum brevis pedii';
				break;		
				
			case 'FlexDigLon':
				$naziv = 'Flexor digitorum longus pedii';
				break;	
				
			case 'ExtDigLon':
				$naziv = 'Extensor digitorum longus pedii';
				break;		
				
			case 'ExtDigCom':
				$naziv = 'Extensor digitorum comunis pedii';
				break;		
				
			case 'FlexHalLon':
				$naziv = 'Flexor halucis longus';
				break;
				
			case 'FlexHalBre':
				$naziv = 'Flexor halucis brevis';
				break;		
				
			case 'ExtHalLon':
				$naziv = 'Extensor halucis longus';
				break;		
				
			case 'SerrAnt':
				$naziv = 'Serratus anterior';
				break;		
				
			case 'TrapDesc':
				$naziv = 'Trapezius descendes';
				break;
				
			case 'TrapAsc':
				$naziv = 'Trapezius ascendes';
				break;		
				
			case 'Rhomb':
				$naziv = 'Rhomboidei';
				break;	
				
			case 'DeltClav':
				$naziv = 'Deltoideus - clavic. et coracobrach.';
				break;
				
			case 'DeltAcr':
				$naziv = 'Deltoideus - acromialis';
				break;		
				
			case 'DeltSpin':
				$naziv = 'Deltoideus - spinalis';
				break;		
				
			case 'LattDor':
				$naziv = 'Latissimus dorsi';
				break;		
				
			case 'PectMaj':
				$naziv = 'Pectoralis major';
				break;
				
			case 'RotExtBra':
				$naziv = 'Rotatores externi humeri';
				break;		
				
			case 'RotIntBra':
				$naziv = 'Rotatores interni humeri';
				break;		
			
			case 'BicBra':
				$naziv = 'Biceps brachii';
				break;		
				
			case 'Brachialis':
				$naziv = 'Brachialis';
				break;		
				
			case 'Brachioradialis':
				$naziv = 'Brachioradialis';
				break;		
				
			case 'TriBra':
				$naziv = 'Triceps brachii';
				break;
				
			case 'Supinator':
				$naziv = 'Supinator, biceps brachii';
				break;		
				
			case 'Pron':
				$naziv = 'Pronator teres et quadratus';
				break;
				
			case 'FlexCarpRad':
				$naziv = 'Flexor carpi radialis';
				break;		
				
			case 'FlexCarpUln':
				$naziv = 'Flexor carpi ulnaris';
				break;
				
			case 'ExtCarpRad':
				$naziv = 'Extensor carpi radialis';
				break;		
				
			case 'ExtCarpUln':
				$naziv = 'Extensor carpi ulnaris';
				break;
				
			case 'LumbEtInterossei':
				$naziv = 'Lumbricales et interossei carpi';
				break;		
				
			case 'ExtDigComCarp':
				$naziv = 'Extensor digitorum communis';
				break;
				
			case 'FlexDigSubl':
				$naziv = 'Flexor digitorum sublimis';
				break;		
				
			case 'FlexDigProf':
				$naziv = 'Flexor digitorum profundus';
				break;
				
			case 'AddDig':
				$naziv = 'Adductores digitorum carpi';
				break;		
				
			case 'AbdDig':
				$naziv = 'Abductores digitorum carpi';
				break;	
			
			case 'AbdPol':
				$naziv = 'Abductor policis';
				break;
				
			case 'AddPol':
				$naziv = 'Adductor policis';
				break;		
				
			case 'Oppon':
				$naziv = 'Opponens policis et dig. minimi';
				break;
				
			case 'FlexPolBre':
				$naziv = 'Flexor policis brevis';
				break;		
				
			case 'FlexPolLon':
				$naziv = 'Flexor policis longus';
				break;
				
			case 'ExtPolBre':
				$naziv = 'Extensor policis brevis';
				break;		
				
			case 'ExtPolLon':
				$naziv = 'Extensor policis longus';
				break;		

			case 'SakaDinam':
				$naziv = 'Dinamometrija šake (kg)';
				break;	
		}

    	return $naziv;
	}
	
	private function puniNazivMjereZaDoktoricu($str){
		
		switch ($str) {
			case 'PolazisteDeltoideusa':
				$naziv = 'Na polazištu m. deltoideusa (opseg cm)';
				break;
			
			case 'HvatisteDeltoideusa':
				$naziv = 'Na hvatištu m. deltoideusa (opseg cm)';
				break;
				
			case 'SredinaNadlaktice':
				$naziv = 'Po sredini nadlaktice (opseg cm)';
				break;
				
			case 'PrekoOlekranona':
				$naziv = 'Preko olekranona (opseg cm)';
				break;
				
			case 'PrekoSredinePodlaktice':
				$naziv = 'Po sredini podlaktice (opseg cm)';
				break;
				
			case 'PrekoRucnogZgloba':
				$naziv = 'Preko ručnog zgloba (opseg cm)';
				break;
				
			case 'PrekoMetacarpusa':
				$naziv = 'Preko MCP zgloba (opseg cm)';
				break;
				
			case 'OPrsta':
				$naziv = 'Opeg prsta (prst, cm)';
				break;
				
			case '15IznadPatele':
				$naziv = '15cm iznad gornjeg ruba patele (opseg cm)';
				break;
			
			case 'PrekoPatele':
				$naziv = 'Preko patele (opseg cm)';
				break;
				
			case '15IspodPatele':
				$naziv = '15cm ispod donjeg ruba patele (opseg cm)';
				break;
				
			case 'PrekoMaleola':
				$naziv = 'Preko maleola (opseg cm)';
				break;
				
			case 'PrekoPete':
				$naziv = 'Preko pete pod kutom od 45° (opseg cm)';
				break;
				
			case 'PrekoDorsumaStopala':
				$naziv = 'Preko najistaknutije točke dorsuma stopala (opseg cm)';
				break;
				
			case 'CFlesh':
				$naziv = 'Cervikalni fleš u cm';
				break;
				
			case 'IndSagGibC':
				$naziv = 'Indeks sag. giblj. vrata u cm';
				break;
			
			case 'LatFleksC':
				$naziv = 'Laterofleksija vrata u cm';
				break;
				
			case 'RotacijaC':
				$naziv = 'Rotacija vrata u cm';
				break;
				
			case 'IndSagGibT':
				$naziv = 'Indeks sag. giblj. torakalne kralj. u cm';
				break;
				
			case 'ODisanja':
				$naziv = 'Opseg disanja u cm';
				break;
				
			case 'IndSagGibL':
				$naziv = 'Indeks sag. giblj. lumblane kralj. u cm';
				break;
				
			case 'LatFlexTrupa':
				$naziv = 'Laterofleksija trupa u cm';
				break;
				
			case 'ZnakTetiveNaLuku':
				$naziv = 'Znak tetive na luku u cm';
				break;
				
			case 'FenomenGumeneLopte':
				$naziv = 'Fenomen gumene lopte';
				break;
				
			case 'RameAbd':
				$naziv = 'Abdukcija ramena (ref. 90°)';
				break;
				
			case 'RameElev':
				$naziv = 'Elevacija ramena (ref. 75°)';
				break;
				
			case 'RameAnt':
				$naziv = 'Antefleksija ramena (ref. 165°)';
				break;
				
			case 'RameRet':
				$naziv = 'Retrofleksija ramena (ref. 75°)';
				break;
				
			case 'RameURot':
				$naziv = 'Unutarnja rotacija ramena (ref. 90°)';
				break;
			
			case 'RameVRot':
				$naziv = 'Vanjska rotacija ramena (ref. 90°)';
				break;
				
			case 'RameHorAbd':
				$naziv = 'Horiz. abdukcija ramena (ref. 45°)';
				break;
				
			case 'RameHorAdd':
				$naziv = 'Horiz. addukcija ramena (ref. 135°)';
				break;
				
			case 'LakatExt':
				$naziv = 'Ekstenzija lakta (ref. 0°)';
				break;
				
			case 'LakatFlex':
				$naziv = 'Fleksija lakta (ref. 135°)';
				break;
				
			case 'Supinacija':
				$naziv = 'Supinacija podlaktice (ref. 80-90°)';
				break;
				
			case 'Pronacija':
				$naziv = 'Pronacija podlaktice (ref. 80-90°)';
				break;
				
			case 'VolarFlex':
				$naziv = 'Volarna fleksija šake (ref. 60-70°)';
				break;

			case 'DorsalFlex':
				$naziv = 'Dorzalna fleksija šake (ref. 60°)';
				break;
				
			case 'AbdUln':
				$naziv = 'Ulnarna abdukcija šake (ref. 50°)';
				break;
				
			case 'AbdRad':
				$naziv = 'Radijalna abdukcija šake (ref. 40°)';
				break;
				
			case 'RPalacAbd':
				$naziv = 'Abdukcija palca ruke (ref. 90°)';
				break;
				
			case 'RPalacAdd':
				$naziv = 'Addukcija palca ruke (ref. 0°)';
				break;
				
			case 'RPalacFlex':
				$naziv = 'Flex. MCP palca ruke (ref. 90°)';
				break;
			
			case 'RPalacExt':
				$naziv = 'Ext. MCP palca ruke (ref. 0°)';
				break;
			
			case 'RPalac1ZglFlex':
				$naziv = 'Flex. IF palca ruke (ref. 90°)';
				break;
				
			case 'RPalacOpozicija':
				$naziv = 'Opozicija (cm između vrhova I. i V. prsta)';
				break;

			case 'R2Pr1ZglExt':
				$naziv = 'II prst šake - ekstenzija MCP (ref. 0°)';
				break;
				
			case 'R2Pr1ZglFlex':
				$naziv = 'II prst šake - fleksija MCP (ref. 90°)';
				break;
				
			case 'R2Pr2ZglFlex':
				$naziv = 'II prst šake - fleksija PIP (ref. 100°)';
				break;
				
			case 'R2Pr3ZglFlex':
				$naziv = 'II prst šake - fleksija DIP (ref. 80°)';
				break;

			case 'R3Pr1ZglExt':
				$naziv = 'III prst šake - ekstenzija MCP (ref. 0°)';
				break;
				
			case 'R3Pr1ZglFlex':
				$naziv = 'III prst šake - fleksija MCP (ref. 90°)';
				break;
				
			case 'R3Pr2ZglFlex':
				$naziv = 'III prst šake - fleksija PIP (ref. 100°)';
				break;
				
			case 'R3Pr3ZglFlex':
				$naziv = 'III prst šake - fleksija DIP (ref. 80°)';
				break;

			case 'R4Pr1ZglExt':
				$naziv = 'IV prst šake - ekstenzija MCP (ref. 0°)';
				break;
				
			case 'R4Pr1ZglFlex':
				$naziv = 'IV prst šake - fleksija MCP (ref. 90°)';
				break;
				
			case 'R4Pr2ZglFlex':
				$naziv = 'IV prst šake - fleksija PIP (ref. 100°)';
				break;
				
			case 'R4Pr3ZglFlex':
				$naziv = 'IV prst šake - fleksija DIP (ref. 80°)';
				break;

			case 'R5Pr1ZglExt':
				$naziv = 'V prst šake - ekstenzija MCP (ref. 0°)';
				break;
				
			case 'R5Pr1ZglFlex':
				$naziv = 'V prst šake - fleksija MCP (ref. 90°)';
				break;
				
			case 'R5Pr2ZglFlex':
				$naziv = 'V prst šake - fleksija PIP (ref. 100°)';
				break;
				
			case 'R5Pr3ZglFlex':
				$naziv = 'V prst šake - fleksija DIP (ref. 80°)';
				break;

			case 'KukFlexIsprKoljeno':
				$naziv = 'Fleksija kuka opruženim koljenom (ref. 80°)';
				break;
				
			case 'KukFlexSavKoljeno':
				$naziv = 'Fleksija kuka savijenim koljenom (ref. 100°)';
				break;
				
			case 'KukExt':
				$naziv = 'Ekstenzija kuka (ref. 20°)';
				break;

			case 'KukAbd':
				$naziv = 'Abdukcija kuka (ref. 50°)';
				break;
				
			case 'KukAdd':
				$naziv = 'Addukcija kuka (ref. 30°)';
				break;
				
			case 'KukUnRot':
				$naziv = 'Unutarnja rotacija kuka (ref. 50°)';
				break;
				
			case 'KukVanRot':
				$naziv = 'Vanjska rotacija kuka (ref. 40°)';
				break;
				
			case 'KoljFlex':
				$naziv = 'Fleksija koljena (ref. 135°)';
				break;
				
			case 'KoljExt':
				$naziv = 'Ekstenzija koljena (ref. 0°)';
				break;	
				
			case 'SkZglDorFlex':
				$naziv = 'Dorz. fleks. skočnog zgloba (ref. 25°)';
				break;
				
			case 'SkZglPlanFlex':
				$naziv = 'Plant. fleks. skočnog zgloba (ref. 40°)';
				break;
				
			case 'SkZglEver':
				$naziv = 'Everzija stopala (ref. 30°)';
				break;
				
			case 'SkZglInv':
				$naziv = 'Inverzija stopala (ref. 40°)';
				break;		
				
			case 'NPalac1ZglExt':
				$naziv = 'Ekst. osnovnog zgl. nožnog palca (ref. 0°)';
				break;
				
			case 'NPalac1ZglFlex':
				$naziv = 'Fleks. osnovnog zgl. nožnog palca (ref. 40°)';
				break;
				
			case 'NPalac2ZglFlex':
				$naziv = 'Fleks. krajnjeg zgl. nožnog palca (ref. 45°)';
				break;	
				
			case 'OrbOr':
				$naziv = 'Orbicularis oris';
				break;
				
			case 'OrbOc':
				$naziv = 'Orbicularis oculi';
				break;			
	
			case 'Zyg':
				$naziv = 'Zygomaticus';
				break;			
	
			case 'Front':
				$naziv = 'Frontalis';
				break;
				
			case 'FlexCapitEtColi':
				$naziv = 'Flexores capitis et colli';
				break;	
				
			case 'ExtCapitEtColi':
				$naziv = 'Extensores capitis et colli';
				break;
				
			case 'RectusAbdom':
				$naziv = 'Rectus abdominis';
				break;
				
			case 'ExtTrunci':
				$naziv = 'Extensore trunci';
				break;
				
			case 'ObliquiAbd':
				$naziv = 'Obliqui abdominis';
				break;		
				
			case 'FlexLatTrunci':
				$naziv = 'Felxores lateralis trunci';
				break;	
				
			case 'Iliopsoas':
				$naziv = 'Iliopsoas';
				break;
				
			case 'GlutMax':
				$naziv = 'Gluteus maximus';
				break;		
				
			case 'AddCoxae':
				$naziv = 'Adductores coxae';
				break;	
				
			case 'GlutMed':
				$naziv = 'Gluteus medius';
				break;
				
			case 'RotIntCoxae':
				$naziv = 'Rotatores interni coxae';
				break;
				
			case 'TenFasLat':
				$naziv = 'Tensor fasciae latae';
				break;
				
			case 'RotExtCoxae':
				$naziv = 'Rotatores externi coxae';
				break;		
				
			case 'Sartorius':
				$naziv = 'Sartorius';
				break;		
				
			case 'BicFem':
				$naziv = 'Biseps femoris';
				break;
				
			case 'SemEtSem':
				$naziv = 'Semitendinosus et semimembranosus';
				break;		
				
			case 'QuadFem':
				$naziv = 'Quadriceps femoris';
				break;	
				
			case 'Gastroc':
				$naziv = 'Gastrocnemius';
				break;		
				
			case 'Soleus':
				$naziv = 'Soleus';
				break;		
				
			case 'TibAnt':
				$naziv = 'Tibialis anterior';
				break;
				
			case 'TibPost':
				$naziv = 'Tibialis posterior';
				break;		
				
			case 'Per':
				$naziv = 'Peroneus';
				break;		
				
			case 'LumbEtInterPed':
				$naziv = 'Lumbricales et interossei pedii';
				break;
				
			case 'FlexDigBre':
				$naziv = 'Flexor digitorum brevis pedii';
				break;		
				
			case 'FlexDigLon':
				$naziv = 'Flexor digitorum longus pedii';
				break;	
				
			case 'ExtDigLon':
				$naziv = 'Extensor digitorum longus pedii';
				break;		
				
			case 'ExtDigCom':
				$naziv = 'Extensor digitorum comunis pedii';
				break;		
				
			case 'FlexHalLon':
				$naziv = 'Flexor halucis longus';
				break;
				
			case 'FlexHalBre':
				$naziv = 'Flexor halucis brevis';
				break;		
				
			case 'ExtHalLon':
				$naziv = 'Extensor halucis longus';
				break;		
				
			case 'SerrAnt':
				$naziv = 'Serratus anterior';
				break;		
				
			case 'TrapDesc':
				$naziv = 'Trapezius descendes';
				break;
				
			case 'TrapAsc':
				$naziv = 'Trapezius ascendes';
				break;		
				
			case 'Rhomb':
				$naziv = 'Rhomboidei';
				break;	
				
			case 'DeltClav':
				$naziv = 'Deltoideus - clavic. et coracobrach.';
				break;
				
			case 'DeltAcr':
				$naziv = 'Deltoideus - acromialis';
				break;		
				
			case 'DeltSpin':
				$naziv = 'Deltoideus - spinalis';
				break;		
				
			case 'LattDor':
				$naziv = 'Latissimus dorsi';
				break;		
				
			case 'PectMaj':
				$naziv = 'Pectoralis major';
				break;
				
			case 'RotExtBra':
				$naziv = 'Rotatores externi humeri';
				break;		
				
			case 'RotIntBra':
				$naziv = 'Rotatores interni humeri';
				break;		
			
			case 'BicBra':
				$naziv = 'Biceps brachii';
				break;		
				
			case 'Brachialis':
				$naziv = 'Brachialis';
				break;		
				
			case 'Brachioradialis':
				$naziv = 'Brachioradialis';
				break;		
				
			case 'TriBra':
				$naziv = 'Triceps brachii';
				break;
				
			case 'Supinator':
				$naziv = 'Supinator, biceps brachii';
				break;		
				
			case 'Pron':
				$naziv = 'Pronator teres et quadratus';
				break;
				
			case 'FlexCarpRad':
				$naziv = 'Flexor carpi radialis';
				break;		
				
			case 'FlexCarpUln':
				$naziv = 'Flexor carpi ulnaris';
				break;
				
			case 'ExtCarpRad':
				$naziv = 'Extensor carpi radialis';
				break;		
				
			case 'ExtCarpUln':
				$naziv = 'Extensor carpi ulnaris';
				break;
				
			case 'LumbEtInterossei':
				$naziv = 'Lumbricales et interossei carpi';
				break;		
				
			case 'ExtDigComCarp':
				$naziv = 'Extensor digitorum communis';
				break;
				
			case 'FlexDigSubl':
				$naziv = 'Flexor digitorum sublimis';
				break;		
				
			case 'FlexDigProf':
				$naziv = 'Flexor digitorum profundus';
				break;
				
			case 'AddDig':
				$naziv = 'Adductores digitorum carpi';
				break;		
				
			case 'AbdDig':
				$naziv = 'Abductores digitorum carpi';
				break;	
			
			case 'AbdPol':
				$naziv = 'Abductor policis';
				break;
				
			case 'AddPol':
				$naziv = 'Adductor policis';
				break;		
				
			case 'Oppon':
				$naziv = 'Opponens policis et dig. minimi';
				break;
				
			case 'FlexPolBre':
				$naziv = 'Flexor policis brevis';
				break;		
				
			case 'FlexPolLon':
				$naziv = 'Flexor policis longus';
				break;
				
			case 'ExtPolBre':
				$naziv = 'Extensor policis brevis';
				break;		
				
			case 'ExtPolLon':
				$naziv = 'Extensor policis longus';
				break;		

			case 'SakaDinam':
				$naziv = 'Dinamometrija šake (kg)';
				break;	
		}

    	return $naziv;
	}
}
