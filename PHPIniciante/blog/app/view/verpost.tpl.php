<div class="container">
<div class="row">
<div class="col-sm-8 blog-main">
	<?php $post = $tpl["verpost"]["post"]; ?>
	
	<?php 
		$date = new DateTime($post->postdata);
	?>
  <div class="blog-post">
	
	<h2 class="blog-post-title"><?=$post->posttitulo?></h2>
	<p class="blog-post-meta"><?=$date->format('d/m/Y H:i:s')?> por <?=$post->postusuarionome?>. Categoria: <strong><?=$post->postcategoria?></strong></p>
	
	<?php if($post->postimagemdestaque != "") { ?>
		<img src="upload/<?=$post->postimagemdestaque?>" width="100%" />
	<?php } ?>
	
	<p><?=$post->posttexto?></p>
	
	<?php if(count($tpl["verpost"]["imagens"])>0) { ?>
	<?php foreach($tpl["verpost"]["imagens"] as $img) { ?>
	
	<a href="upload/<?=$img["imagemarquivo"]?>" target="_blank">
		<img src="upload/thumb/<?=$img["imagemarquivo"]?>" width="180" align="left" style="margin:10px;" />
	</a>
	<?php }} ?>
  </div><!-- /.blog-post -->
	
  
</div><!-- /.blog-main -->

<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
  <div class="sidebar-module sidebar-module-inset">
	<h4>Sobre</h4>
	<p>Fale um pouco sobre você</p>
  </div>
  <div class="sidebar-module">
	<h4>Categorias</h4>
	<ol class="list-unstyled">
	  <?php foreach($tpl["verpost"]["categorias"] as $categoria) { ?>
		<li><a href="index.php?m=categoria&id=<?=$categoria["categoriaid"]?>"><?=$categoria["categoriatitulo"]?></a></li>
	  <?php } ?>
	</ol>
  </div>
  
</div><!-- /.blog-sidebar -->
</div><!-- /.row -->
</div><!-- /.container -->