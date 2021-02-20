<div class="large-12 columns">
	<div class="pagination-centered">
	  <ul class="pagination">
		<?php 
			
			for($i=1; $i<=$ukupnoStranica; $i++){
				echo "<li";
				echo ($stranica==$i) ? " class='current'>" : ">";
				echo "<a href='index.php?stranica=" . $i . "&redoslijed=" . $redoslijed . "'>" . $i . "</a>"; 
				echo "</li>";
			}
		
		?>
	  </ul>
	</div>
</div>