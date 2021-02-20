<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';

Auth::isDoctorOrRoot($ida, $putanjaApp);

header('location: ' . $putanjaApp . 'doctor/pacijenti.php');
/*
$title = 'Doktor';
$bodyClass = 'vjezbe';
include_once '../masters/masterHead.php';
include_once '../masters/izbornik.php';

include_once '../masters/masterBottom.php';

*/
