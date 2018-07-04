<div class="container marginTop">
	<div class="row">
		<div class="col-xs-12">

			<?php if($tpl["dados"]["msg"] != "") { ?>
				<div class="alert alert-info marginTop">
					<strong><?=$tpl["dados"]["msg"]?></strong>
				</div>
			<?php } ?>
			
			<a href="index.php?m=admin&c=posts&a=cadastrarPost" class="btn btn-primary btn-large">Cadastrar novo post</a>
			
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Título</th>
						<th width="200">Data/Hora</th>
						<th width="40"></th>
						<th width="40"></th>
						<th width="40"></th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($tpl["dados"]["posts"] as $post) { ?>
					<?php $date = new DateTime($post["postdata"]); ?>					
					<tr>
						<td><?=$post["posttitulo"]?></td>
						<td><?=$date->format('d/m/Y H:i:s')?></td>
						<td>
							<a href="index.php?m=admin&c=posts&a=alterarPost&id=<?=$post["postid"]?>" class="btn btn-primary">Alterar</a>
						</td>
						<td>
							<a href="index.php?m=admin&c=posts&a=excluirPost&id=<?=$post["postid"]?>" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir o registro?')">Excluir</a>
						</td>
						<td>
							<a href="index.php?m=admin&c=imagens&id=<?=$post["postid"]?>" class="btn btn-info">Imagens</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
				
			</table>
		
		</div>
	</div>
</div>