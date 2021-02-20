$(function() {	
	$("#pacijent").autocomplete({
		source : '../sql/ajax/pacijenti/nadjiOsobu.php',
		minLength : 2,
		autoFocus : true,
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			window.location.replace('pacijenti.php?id=' + ui.item.id);
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li>").append("<a><b>" + item.prezime + " " + item.ime + ", " + item.godiste + "</b>, MBO <b>" + item.mbo + "</a>").appendTo(ul);
	};
	
	$("#gumbPretrage").click(function() {
		if ($("#hfOsobaId").val().length != 0) {
			window.location.replace('pacijenti.php?id=' + $("#hfOsobaId").val());
		}
	});
});
