<div class="container marginTop">
	<div class="row">
		<div class="col-xs-12">
			<a href="index.php?m=admin&c=imagens&a=cadastrarImagem&postid=<?=$tpl["dados"]["postid"]?>" class="btn btn-primary btn-large">Cadastrar nova imagem</a>
			
			<?php if($tpl["dados"]["msg"] != "") { ?>
				<div class="alert alert-info marginTop">
					<strong><?=$tpl["dados"]["msg"]?></strong>
				</div>
			<?php } ?>
			
			<table class="table table-striped table-bordered table-hover marginTop">
				<thead>
					<tr>
						<th width="40">Imagem</th>
						<th>Imagem legenda</th>
						<th width="40"></th>
						<th width="40"></th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($tpl["dados"]["imagens"] as $imagem) { ?>
										
					<tr>
						<td><img src="upload/thumb/<?=$imagem["imagemarquivo"]?>" width="100%" /></td>
						<td><?=$imagem["imagemlegenda"]?></td>
						<td>
							<a href="index.php?m=admin&c=imagens&a=alterarImagem&id=<?=$imagem["imagemid"]?>" class="btn btn-primary">Alterar</a>
						</td>
						<td>
							<a href="index.php?m=admin&c=imagens&a=excluirImagem&id=<?=$imagem["imagemid"]?>&postid=<?=$tpl["dados"]["postid"]?>" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir o registro?')">Excluir</a>
						</td>
					</tr>
					
					<?php } ?>
				</tbody>
				
			</table>
		
		</div>
	</div>
</div>