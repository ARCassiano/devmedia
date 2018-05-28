<!DOCTYPE html>
<html>
<head>
	<title><?= $titulo ?></title>
</head>
<body>
	<?php foreach ($array as $linha) { ?>
		<p><?= $linha ?></p>
	<?php } ?>

	<p><?php print_r($str_split); ?></p>

	<p><?= print_r($explode); ?></p>

	<p><?= print_r($implode); ?></p>
</body>
</html>

