$('button').copiq({
  parent: '.item-to-copy',
  content: '.text-to-copy'
});

function promijeniTekst(){
    var e = document.getElementById("gumbKopiranja");
    e.innerHTML = "Mjere su kopirane";
	$('#gumbKopiranja').addClass('disabled success');
}