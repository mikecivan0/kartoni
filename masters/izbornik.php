<?php
$userPath = ($podaci -> razina=='user') ? 'kartoni' : $podaci->razina;
?>
<div class="row">
	<div class="sticky">
		<nav class="top-bar" data-topbar="" role="navigation" data-options="sticky_on: large">
			<ul class="title-area" style="line-height: 1.3;">
				<!-- Title Area -->
				<li class="name pl5">
					<a class="pe-7s-home" href="<?= $putanjaApp . $userPath . "/index.php" ?>"></a>
				</li>
				<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				<li class="toggle-topbar menu-icon">
					<a href="#"><span>Menu</span></a>
				</li>
			</ul>
			<section class="top-bar-section">
				<ul>
					<?php if(isset($_SESSION[$ida . "autoriziran"])){ ?>
						<?php if($_SESSION[$ida . "autoriziran"]->razina=='doctor'){ ?>
							<li>
								<a href="<?= $putanjaApp ?>doctor/pacijenti.php">Pregled pacijenata</a>
							</li>
						<?php } ?>
						<?php if($_SESSION[$ida . "autoriziran"]->razina=='user'){ ?>
							<li>
								<a href="<?= $putanjaApp ?>kartoni/index.php">Kartoni (F2)</a>
							</li>
							<li>
								<a href="<?= $putanjaApp ?>osobe/pacijenti.php">Pacijenti</a>
							</li>
							<li>
								<a href="<?= $putanjaApp ?>filteri/index.php">Filteri</a>
							</li>
							<li>
								<a href="<?= $putanjaApp ?>grupe/index.php">Ispis kartona grupe</a>
							</li>
							<li>
								<a href="<?= $putanjaApp ?>lista/index.php">Lista za zvati</a>
							</li>								
							<li>
								<a href="<?= $putanjaApp ?>protokol/index.php">Protokol</a>
							</li>							
							<li>
								<a target="_blank" href="<?= $putanjaApp ?>backup/index.php">Backup</a>
							</li>												
						<?php }
						if($_SESSION[$ida . "autoriziran"]->razina=='root'){ ?>	
							<li>
								<a target="_blank" href="<?= $putanjaApp ?>backup/index.php">Backup</a>
							</li>
							<li>
								<a href="<?= $putanjaApp ?>root/korisnici/index.php">Korisnici</a>
							</li>
							<li>
								<a href="<?= $putanjaApp ?>root/neradniDani/index.php">Neradni dani</a>
							</li>
							<li>
								<a href="<?= $putanjaApp ?>root/postavkeProtokola/index.php">Brojevi kojih nema u protokolu</a>
							</li>
						<?php }
					} ?>
				</ul>
				<ul class="right">
					<?php if(isset($_SESSION[$ida . "autoriziran"])){ ?>
					<li>
						<a class="pe-7s-power transparent" href="<?= $putanjaApp ?>auth/odjava.php"></a>
					</li>
					<?php } ?>
				</ul>

			</section>
		</nav>
	</div>
</div>
