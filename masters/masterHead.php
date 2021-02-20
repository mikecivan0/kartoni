<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Expires" content="<?= gmdate('D, d M Y H:i:s', time()+86400) . ' GMT' ?>">
<meta http-equiv="Pragma" content="no-cache">
<?php 
header('Cache-Control: no-store, no-cache, must-revalidate'); 
header('Cache-Control: post-check=0, pre-check=0', FALSE); 
?>
<link href="<?= $putanjaApp ?>img/logo.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?= $putanjaApp ?>css/app.css" />
<link rel="stylesheet" href="<?= $putanjaApp ?>css/foundation.css" />
<link rel="stylesheet" href="<?= $putanjaApp ?>css/style.css" />
<script src="<?= $putanjaApp ?>js/vendor/modernizr.js"></script>

<meta name="description" content="Kartoteka fizikalne terapije">
<meta name="keywords" content="Fiziklana terapija, karton, Poliklinika Novoselec">
<meta name="author" content="Ivan Mikec">
<title><?= $title ?></title>
<?= $headScript ?>
</head>
<body class="<?= $bodyClass ?>">
