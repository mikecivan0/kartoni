$(function() {	
	$( "#redoslijed" ).change(function() {
	  window.location.replace('index.php?stranica=' + $("#hfStranica").val() + '&redoslijed=' + $("#redoslijed").val());
	});
});
