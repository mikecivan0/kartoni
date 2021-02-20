<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::ifAuth($ida, $putanjaApp); //ako je korisnik već logiran prebaci ga na njegovu home stranicu

if (isset($_GET["error"])){
	$_SESSION[$ida . "attempt"] = (!isset($_SESSION[$ida . "attempt"])) ? 2 : $_SESSION[$ida . "attempt"]-1;
}						
	
include_once '../alati/Html.php';
include_once '../alati/Alati.php';
$bodyClass = 'vjezbe';
include_once '../masters/masterHead.php';
$title = 'Prijava';
$username = (isset($_GET["username"])) ? $_GET["username"] : "";
?>

<div id="iconsWrap">
   <a target="_blank" href='https://www.linkedin.com/in/ivan-mikec-32911619a/'>
   	<img class="linkedInLink" src="../img/linkedin.png" alt="LinkedIn icon"/>
   </a>
   <a target="_blank" href='https://github.com/mikecivan0/zupniUred'>
   	<img class="gitLink" src="../img/github.png" alt="GitHub icon"/>
   </a>
</div>

<div class="container-fluid mt80 pt80">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 mt20">
			<div class="panel panel-default">
				<div class="panel-heading">
					Prijava u sustav 
					<span class="plavaSlova fs08rem">(podaci za prijavu se nalaze u Priručniku za korisnike)</span>
				</div>
				<div class="panel-body">				
					<?php if(!isset($_SESSION[$ida . "attempt"])||(isset($_SESSION[$ida . "attempt"])&&$_SESSION[$ida . "attempt"]>=1)):
							  if (isset($_GET["error"])){ ?>
								<div id="porukaGreske" class="alert alert-danger">
									<ul>								
										<?=	"<li>" . Alati::porukaPrijave($_GET["error"]) . "</li>"; ?>								
									</ul>
								</div>
							<?php } ?> 
						<form id="forma" class="form-horizontal" role="form" method="POST" action="autoriziraj.php">
							<div class="form-group">
								<label class="col-md-4 control-label">Korisničko ime</label>
								<div class="col-md-6">
									<?= Html::Input(null, 'text', 'username', 'username',array('form-control'),null,$username,array('autofocus'=>true),false) ?>
								</div>
							</div>
	
							<div class="form-group">
								<label class="col-md-4 control-label">Lozinka</label>
								<div class="col-md-6 mb15">
									<?= Html::Input(null, 'password', 'password', 'password',array('form-control','mb0'),null,null,null,false) ?>
								</div>
	
							
								<div class="col-md-3 col-md-offset-6">
									<?= Html::Submit('Prijava', array('btn','btn-primary'),array('id'=>'gumb')) ?>
								</div>
							</div>				
						</form>
					<?php endif; ?>
					
					<?php if(isset($_SESSION[$ida . "attempt"])): ?>						
						<div class="mt40 objasnjenje">
							<?php 
								if($_SESSION[$ida . "attempt"]<1){
									$footerScript .= '<script src="' . $putanjaApp . 'js/auth.js"></script>';
									echo '<div id="counter"></div>';
							 	}else{
									echo "Preostali broj pokušaja: " . $_SESSION[$ida . "attempt"];
							} ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="row mt40">
				<div class="large-6 medium-8 small-12 columns end">
					<a target="_blank" href="<?= $putanjaApp ?>manual.html">			
						<img class="fleft mr5" style="width: 45px; height: 45px;" src="<?= $putanjaApp ?>img/manual.png" />			
						<div style="padding-top: 11px">Priručnik za korisnike</div>
					</a>
				</div>
			</div>
		</div>		
	</div>
</div>


<?php
	include_once '../masters/masterBottom.php';
?>
