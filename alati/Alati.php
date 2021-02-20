<?php

class Alati{
	
	public static function prilagodiUdaljenosti($osnovno,$prilagodjeno){
		$obj = new stdClass();
		foreach ($prilagodjeno as $key => $value) {
			$obj->$key = $value + $osnovno->$key .  "mm;";
		}
		return $obj;
	}
	
	public static function prilagodiVisinu($str,$pocetnaVisina,$breakpoint){
		$visina = strlen($str)>$breakpoint ? (substr($pocetnaVisina,0, -3) - 2.5) . 'mm;' : $pocetnaVisina;
		return $visina;
	}
	
	public static function datum($str){
		$date = (empty($str)) ? null :  date("d.m.Y.", strtotime($str));
		return $date;
	}
	
	public static function datumSaHrvMjesecom($str){
		$datum = explode("-",$str);
		
		//obrada dana
		$dan = (substr( $datum[2], 0, 1 ) == 0) ? substr( $datum[2], 1 ) : $datum[2]; //ako je u danu prva nula tada je makni
		
		//obrada mjeseca	
		$mjesec = (substr( $datum[1], 0, 1 ) == 0) ? substr( $datum[1], 1 ) : $datum[1]; //ako je u mjesecu prva nula tada je makni
		   
			switch($mjesec){
				case 1:
					$hrvMj = "sij";
				break;
				
				case 2:
					$hrvMj = "vlč";
				break;
				
				case 3:
					$hrvMj = "ožu";
				break;
				
				case 4:
					$hrvMj = "tra";
				break;
				
				case 5:
					$hrvMj = "svi";
				break;
				
				case 6:
					$hrvMj = "lip";
				break;
				
				case 7:
					$hrvMj = "srp";
				break;
				
				case 8:
					$hrvMj = "kol";
				break;
				
				case 9:
					$hrvMj = "ruj";
				break;
				
				case 10:
					$hrvMj = "lis";
				break;
				
				case 11:
					$hrvMj = "stu";
				break;
				
				case 12:
					$hrvMj = "pro";
				break;
			}
		return $dan . ". " . $hrvMj;
	}
	
	public static function datumPoruke($str){
		$date = (substr($str,0,4)==date("Y")) ? self::datumSaHrvMjesecom($str) : self::datum($str);			
		return $date;
	}
	
	public static function vrijeme($str){
		$time = empty($str) ? null :  date("H:i", strtotime($str));
		return $time;
	}
	
	public static function oduzmiZadnjuRijec($str){
        return preg_replace('/\W\w+\s*(\W*)$/', '$1', $str);
    }
	
	public static function removeTags($str, $tagName){
	return str_replace("<" . $tagName .">", "", str_replace("</" . $tagName .">", "<br />", $str));
	}
	
	public static function odrediFont($str){
        //prilagodi font duljini posta 'hfZupa'
        $duljina = strlen($str);
        switch ($duljina) {
            case $duljina < 60:
                $font = 0.9;
                break;

            case $duljina >= 60 && $duljina < 70:
                $font = 0.8;
				break;

            case $duljina >= 70 && $duljina < 80:
                $font = 0.7;
                break;

            case $duljina >= 80 && $duljina < 90:
                $font = 0.6;
                break;

            case $duljina >= 90 && $duljina < 95:
                $font = 0.5;
                break;

            case $duljina >= 95:
                $font = 0.4;
                break;
        }

        return 'font-size: ' . $font . 'rem !important;';
    }
	
		
	//sljedeće 2 funkcije su za konvertiranje stringa iz baze u objekt sa podacima udaljenosti u pdf-u
	
	//ova funkcija je za konvertiranje array u objekt
	public static function obj_ColumnToArrayToObj($obj,$column){	
		$array = self::strToArray($obj,$column);
		$object = (object) $array;
		return $object;
	}
	
	public static function dodajMM($obj,$column){
		$array = self::strToArray($obj,$column);
		array_walk($array, function(&$value, $key) { $value .= 'mm;'; });
		$object = (object) $array;	
		return $object;		
	}
	
	//ova funkcija služi i za konvertiranje objekt->string u array u svrhu kreiranja forme za izmjenu udaljenosti
	public static function strToArray($obj,$column){
		parse_str($obj->$column,$array);
		return $array;	
	}
	
	
	public static function labela($key){
		return ucfirst(preg_replace('/(?<!\ )[A-Z]/', ' $0', $key));
	}
	
	public static function splitOnTwo($str,$breakpoint){
	$list = explode(' ',$str);
	$output1 = '';
	$output2 = '';
		foreach ($list as $key => $value) {
			if(strlen($output1)<=$breakpoint){
				$output1 .= $value . ' ';
			}else{
				$output2 .= $value . ' ';
			}	
		}	
	return array($output1, $output2);
	}
	
	//funkcija za pravljenje sraćene poruke za vizualni prikaz
	public static function poruka($str,$breakpoint=null){
		if($breakpoint!=null){
			$poruka = substr($str, 0, $breakpoint);
			$poruka .= " ...";
			return $poruka;
		}else{
			return $str;
		}
	}
	
	
	public static function porukaPrijave($str){
		switch ($str) {
			case 1:
				$poruka ='Neaktivan korisnik';
				break;
			
			case 2:
				$poruka ='Nepostojeći korisnik';
				break;
				
			case 3:
				$poruka ='Upišite lozinku';
				break;
			
			case 4:
				$poruka ='Nedovoljna razina ovlasti';
				break;
				
			case 5:
				$poruka ='Upišite korisničko ime';
				break;
				
			case 6:
				$poruka ='Netočna lozinka';
				break;
				
			case 7:
				$poruka ='Istekla Vam je licenca. Uplatite naknadu za korištenje i kontaktirajte administratora da bi Ste se ponovno mogli služiti aplikacijom. Hvala';
				break;
				
			default:
				$poruka = 'Greška';
				break;
		}
		return $poruka;
	}
	
	public static function porukaIstekaLicence($str){
		switch ($str) {
			case 0:
				$poruka ='Danas';
				break;
			
			case 1:
				$poruka ='Sutra';
				break;
				
			default:
				$poruka ='Za ' . $str . ' dana';
				break;
		}
		$poruka .= ' Vam ističe licenca za korištenje aplikacije. Uplatite naknadu za korištenje i kontaktirajte administratora da bi Ste se i dalje mogli služiti aplikacijom. Hvala';
		return $poruka;
	}
	
	
	public function brojPoruka ($ukupno,$offset,$brojPoruka){
		$od = $offset+1;
		$do = $od+$brojPoruka-1;
		$str = ($ukupno<=20) ? $ukupno : $od . "-" . $do;
		return $str . " od " . $ukupno;
		
	}
	
	public static function pagination($ukupno,$poStranici){
		$brojStranica = floor($ukupno/$poStranici);
		$i = 1;
		do {
		    echo $i;
		} while ($i <= $brojStranica);
		
		return '<ul class="pagination" role="menubar" aria-label="Pagination">
								  <li class="arrow unavailable" aria-disabled="true"><a href="">&laquo;</a></li>
								  <li class="current"><a href="">1</a></li>
								  <li><a href="">2</a></li>
								  <li><a href="">3</a></li>
								  <li><a href="">4</a></li>
								  <li class="unavailable" aria-disabled="true"><a href="">&hellip;</a></li>
								  <li><a href="">12</a></li>
								  <li><a href="">13</a></li>
								  <li class="arrow"><a href="">&raquo;</a></li>
								</ul>';
	}

	public static function prethodnaStranica(){
		$user = (isset($_POST["hfUserId"])) ? "&user=" . $_POST["hfUserId"] : null;
		$userZaPrvuStranicu = (isset($_POST["hfUserId"])) ? "?user=" . $_POST["hfUserId"] : null;
		$link = ($_GET["stranica"]<=1) ? $_SERVER["PHP_SELF"] . $userZaPrvuStranicu : $_SERVER["PHP_SELF"] . "?stranica=" . ($_GET["stranica"]-1) . $user;
		return '<li class="arrow" aria-disabled="true"><a href="' . $link . '">&laquo;</a></li>';		
	}
	
	public static function sljedecaStranica($brojStranica){
		$user = (isset($_POST["hfUserId"])) ? "&user=" . $_POST["hfUserId"] : null;	
		$link = ($_GET["stranica"]>=$brojStranica) ? $_SERVER["PHP_SELF"] . "?stranica=" . $brojStranica . $user : $_SERVER["PHP_SELF"] . "?stranica=" . ($_GET["stranica"]+1) . $user;
		return '<li class="arrow" aria-disabled="true"><a href="' . $link . '">&raquo;</a></li>';
	}

	public static function promijeniDioStringa($str,$rep,$start,$end){
		$noviString = substr($str, $start, $end).$rep;  
		return $noviString;
	}
	
	public static function ordinarijat($str){
		$bezZadnjeRijeci = self::oduzmiZadnjuRijec($str);
		$ordinarijat = self::promijeniDioStringa($bezZadnjeRijeci, 'om', 0, -1);
		return $ordinarijat;
	}
	
	public static function hrvMjesec($str){
			switch($str){
				case 1:
					$hrvMj = "Siječanj";
				break;
				
				case 2:
					$hrvMj = "Veljača";
				break;
				
				case 3:
					$hrvMj = "Ožujak";
				break;
				
				case 4:
					$hrvMj = "Travanj";
				break;
				
				case 5:
					$hrvMj = "Svibanj";
				break;
				
				case 6:
					$hrvMj = "Lipanj";
				break;
				
				case 7:
					$hrvMj = "Srpanj";
				break;
				
				case 8:
					$hrvMj = "Kolovoz";
				break;
				
				case 9:
					$hrvMj = "Rujan";
				break;
				
				case 10:
					$hrvMj = "Listopad";
				break;
				
				case 11:
					$hrvMj = "Studeni";
				break;
				
				case 12:
					$hrvMj = "Prosinac";
				break;
			}
		return $hrvMj;
	}
	
	public static function daLiJeGodinaIMjesec($godina,$mjesec,$godinaTransakcije,$mjesecTransakcije){
		return ($godinaTransakcije==$godina->godina&&$mjesecTransakcije==$mjesec->mjesec) ? ' class="red"' : null;
	}
	
	public static function daLiJeGodina($prop,$godina,$godinaTransakcije){
		if($prop=='style'){
			return ($godinaTransakcije!=$godina->godina) ? ' style="display: none;"' : null;
		}
		
		if($prop=='class'){
			return ($godinaTransakcije==$godina->godina) ? ' red' : null;
		}
	}
	
	public static function hrIznos($iznos){
		$iznos = str_replace(',', 'n', $iznos);
		$iznos = str_replace('.', ',', $iznos);
		$iznos = str_replace('n', '.', $iznos);
		
		return $iznos;
	}
	
	public function rimski_broj($int) 
	{ 
    $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
    $return = ''; 
    while($int > 0) 
    { 
        foreach($table as $rom=>$arb) 
        { 
            if($int >= $arb) 
            { 
                $int -= $arb; 
                $return .= $rom; 
                break; 
            } 
        } 
    } 

    return $return; 
	} 

	public static function prazniRedoviTablice($brTr,$brTd){
		for ($i=0; $i < $brTr; $i++) { 
					echo "<tr>";
						for ($j=0; $j < $brTd; $j++) { 
							echo "<td></td>";
						}					
					echo "</tr>";
				}
	}
}