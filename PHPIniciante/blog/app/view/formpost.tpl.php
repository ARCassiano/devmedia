<div class="container marginTop">
	<div class="row">
		<div class="col-xs-12">
			<div class="well well-small">
				<h4><?=$tpl["dados"]["tituloform"]?></h4>
			</div>
		</div>
	</div>
	
	<?php if($tpl["dados"]["postcriadoem"] != ""){ ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-info">
					Post criado em <?=$tpl["dados"]["postcriadoem"]?> por <?=$tpl["dados"]["postusuarionome"]?>.
				</div>
			</div>
		</div>
	<?php } ?>
	
	<form method="POST" action="index.php?m=admin&c=posts&a=<?=$tpl["dados"]["action"]?>">
		<div class="row">
			<div class="col-xs-2">
					<strong>Título Post:</strong>
			</div>
			<div class="col-xs-10">
					<input type="text" name="posttitulo" class="col-xs-12 form-control" value="<?=$tpl["dados"]["posttitulo"]?>" autofocus required />
			</div>
		</div>
		
		<div class="row marginTop">
			<div class="col-xs-2">
					<strong>Data:</strong>
			</div>
			<div class="col-xs-10">
					<input type="text" name="postdata" class="col-xs-12 form-control" value="<?=$tpl["dados"]["postdata"]?>" placeholder="<?=$tpl["dados"]["auxPostData"]?>" required />
			</div>
		</div>
		
		<div class="row marginTop">
			<div class="col-xs-2">
					<strong>Texto Completo:</strong>
			</div>
			<div class="col-xs-10">
				<textarea name="posttexto" class="col-xs-12 form-control"><?=$tpl["dados"]["posttexto"]?></textarea>
			</div>
		</div>
		
		<div class="row marginTop">
			<div class="col-xs-2">
					<strong>Bloqueado?</strong>
			</div>
			<div class="col-xs-10">
				<label>
					<input type="radio" name="postbloqueado" value="1" <?php if($tpl["dados"]["postbloqueado"] == 1) echo "checked"; ?>> Sim
				</label>
				<label>
					<input type="radio" name="postbloqueado" value="0" <?php if($tpl["dados"]["postbloqueado"] == 0) echo "checked"; ?>> Não
				</label>
			</div>
		</div>
		
		<div class="row marginTop">
			<div class="col-xs-2">
					<strong>Categoria:</strong>
			</div>
			<div class="col-xs-10">
				<select name="postcategoria" class="form-control">
					<?php foreach($tpl["dados"]["categorias"] as $cat){?>
						<option value="<?=$cat["categoriaid"]?>" <?php if($cat["categoriaid"] == $tpl["dados"]["postcategoriaid"]) echo ' selected="selected" '; ?>><?=$cat["categoriatitulo"]?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="row marginTop">
			<div class="col-xs-2">
					<input type="submit" value="<?=$tpl["dados"]["labelbtnsubmit"]?>" class="btn btn-primary btn-large" />
			</div>
		</div>
		<input type="hidden" value="<?=$tpl["dados"]["postid"]?>" name="postid" />
	</form>
</div>