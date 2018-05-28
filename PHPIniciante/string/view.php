<!DOCTYPE html>
<html>
<head>
	<title><?= $titulo ?></title>
</head>
<body>
	<?php foreach ($array as $linha) { ?>
		<p><?= $linha ?></p>
	<?php } ?>

	<p><?php print_r("Split: " . $str_split); ?></p>

	<p><?php print_r("Explode: " . $explode); ?></p>

	<p><?= "implode: " . ($implode); ?></p>
</body>
</html>

