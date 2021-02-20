$(function() {
	var counter = 60;
	var interval = setInterval(function() {
		if (counter == 0) {
	      	document.location = 'odjava.php';
	    }else{
	    	var nastavak = '';	    	
			if(counter>=5&&counter<=20){
				nastavak = 'sekundi';
			}else{
				var str = counter.toString(); //potreban comvert u string da bi se moglo napraviti substr()
				var param = str.substr(str.length -1);
				var paramInt = parseInt(param); //vrati param u integer radi switcha
				switch(paramInt){
					case 1:
						nastavak = 'sekundu';
					break;
					
					case 2:
					case 3:
					case 4:
						nastavak = 'sekunde';
					break;
					
					default: 
						nastavak = 'sekundi';
					break;					
				}	
			}		 
		    $("#counter").html("Prijava će ponovno biti moguća za " + counter + " " + nastavak);
		    counter--;	    
	    }		
	}, 1000);
});