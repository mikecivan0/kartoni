$(function() {
	$("#pacijent").autocomplete({
		source : '../sql/ajax/kartoni/nadjiKarton.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			window.location.replace('promjena.php?id=' + ui.item.id);
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		var upis = (item.upis == false) ? '-' : item.upis;
		var prvaTh = (item.prvaTh == false) ? '-' : hrvDatum(item.prvaTh.datum);
		return $("<li>").append("<a>br. upisa <b>" + upis + "</b>, <b>" + item.prezime + " " + item.ime + ", " + item.godiste + "</b>, MBO <b>" + item.mbo + "</b>, početak terapije <b>" + prvaTh + "</b></a>").appendTo(ul);
	};
});

$("#gumbPretrage").click(function() {
	if ($("#hfKartonId").val().length != 0) {
		
	}
});

function hrvDatum(datum) {
	var dijeloviDatuma = datum.split("-");
	return dijeloviDatuma[2] + "." + dijeloviDatuma[1] + "." + dijeloviDatuma[0] + ".";
}

