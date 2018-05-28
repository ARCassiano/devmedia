<!DOCTYPE html>
<html>
<head>
	<title><?= $titulo ?></title>
</head>
<body>
	<?php foreach ($array as $linha) { ?>
		<p><?= $linha ?></p>
	<?php } ?>

	<p><?php echo "Split: " . print_r($str_split); ?></p>

	<p><?php echo "Explode: " . print_r($explode); ?></p>

	<p><?= "implode: " . ($implode); ?></p>
</body>
</html>

