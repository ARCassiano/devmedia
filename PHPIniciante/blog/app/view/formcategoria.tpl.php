<div class="container marginTop">
	<div class="row">
		<div class="col-xs-12">
			<div class="well well-small">
				<h4><?=$tpl["dados"]["tituloform"]?></h4>
			</div>
		</div>
	</div>
	<form method="POST" action="index.php?m=admin&c=categorias&a=<?=$tpl["dados"]["action"]?>">
		<div class="row">
			<div class="col-xs-2">
					<strong>Nome Categoria:</strong>
			</div>
			<div class="col-xs-10">
					<input type="text" name="categoriatitulo" class="col-xs-12 form-control" value="<?=$tpl["dados"]["categoriatitulo"]?>" autofocus required />
			</div>
		</div>
		
		<div class="row marginTop">
			<div class="col-xs-2">
					<input type="submit" value="<?=$tpl["dados"]["labelbtnsubmit"]?>" class="btn btn-primary btn-large" />
			</div>
		</div>
		<input type="hidden" value="<?=$tpl["dados"]["categoriaid"]?>" name="categoriaid" />
	</form>
</div>