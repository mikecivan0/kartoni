<div class="footer pl5 hide-for-small-only">
    <span>Powered by ЯedoC     &copy;<?= $copyright ?></span>
</div>
<script src="<?= $putanjaApp ?>js/vendor/jquery.js"></script>
<script src="<?= $putanjaApp ?>js/foundation.min.js"></script>
<link rel="stylesheet" href="<?= $putanjaApp ?>css/jquery-ui.css" />
<script src="<?= $putanjaApp ?>js/tinymce/tinymce.min.js"></script>

<!--
mora se 2 puta učitati foundation() jer se
preklapaju skripte
-->
  	<script>
		$(document).foundation();		
    </script>   
	<script src="<?= $putanjaApp ?>js/jquery-ui.js"></script>	  
	<script src="<?= $putanjaApp ?>js/jquery-1.9.1.js"></script><!-- dodano radi bug-a sa označavanjem select-a kod uzastopnog autocompleta -->
	<script src="<?= $putanjaApp ?>js/jquery-ui.js"></script>	  <!-- mora se dva puta učitati da bi radio autocomplete -->
	<script src="<?= $putanjaApp ?>js/swal.js"></script>
  <?= $footerScript ?>
</body>
</html>
