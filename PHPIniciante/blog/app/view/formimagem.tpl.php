<div class="container marginTop">
	<div class="row">
		<div class="col-xs-12">
			<div class="well well-small">
				<h4><?=$tpl["dados"]["tituloform"]?></h4>
			</div>
		</div>
	</div>
	<form enctype="multipart/form-data" method="POST" action="index.php?m=admin&c=imagens&a=<?=$tpl["dados"]["action"]?>">
		
		<?php if($tpl["dados"]["imagemid"] == "") { ?>
		<div class="row">
			<div class="col-xs-3">
					<strong>Selecione uma imagem:</strong>
			</div>
			<div class="col-xs-9">
					<input type="file" name="arquivo" required />
					<input type="hidden" name="MAX_FILE_SIZE" value="1000" />
			</div>
		</div>
		<?php } ?>
		
		<div class="row marginTop">
			<div class="col-xs-3">
					<strong>Legenda da imagem:</strong>
			</div>
			<div class="col-xs-9">
					<input type="text" name="imagemlegenda" class="col-xs-12 form-control" value="<?=$tpl["dados"]["imagemlegenda"]?>" autofocus />
			</div>
		</div>
		
		<div class="row marginTop">
			<div class="col-xs-3">
					<strong>Imagem destaque?</strong>
			</div>
			<div class="col-xs-9">
					<label>
						<input type="radio" name="imagemdestaque" value="0" <?php if($tpl["dados"]["imagemdestaque"] == 0) echo "checked"; ?>> Não
					</label>
					<label>
						<input type="radio" name="imagemdestaque" value="1" <?php if($tpl["dados"]["imagemdestaque"] == 1) echo "checked"; ?>> Sim
					</label>
			</div>
		</div>
		
		<div class="row marginTop">
			<div class="col-xs-2">
					<input type="submit" value="<?=$tpl["dados"]["labelbtnsubmit"]?>" class="btn btn-primary btn-large" />
			</div>
		</div>
		<input type="hidden" value="<?=$tpl["dados"]["imagemid"]?>" name="imagemid" />
		<input type="hidden" value="<?=$tpl["dados"]["postid"]?>" name="postid" />
	</form>
</div>