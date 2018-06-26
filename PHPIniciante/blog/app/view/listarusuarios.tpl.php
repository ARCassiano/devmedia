<div class="container marginTop">
	<div class="row">
		<div class="col-xs-12">
			<a href="index.php?m=admin&c=usuarios&a=cadastrarUsuario" class="btn btn-primary btn-large">Cadastrar novo usuário</a>
			
			<?php if($tpl["dados"]["msg"] != "") { ?>
				<div class="alert alert-info marginTop">
					<strong><?=$tpl["dados"]["msg"]?></strong>
				</div>
			<?php } ?>
			
			<table class="table table-striped table-bordered table-hover marginTop">
				<thead>
					<tr>
						<th width="40">ID</th>
						<th>Usuários</th>
						<th>Nome</th>
						<th width="40"></th>
						<th width="40"></th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($tpl["dados"]["usuarios"] as $usuario) { ?>
										
					<tr>
						<td><?=$usuario["usuarioid"]?></td>
						<td><?=$usuario["usuariouser"]?></td>
						<td><?=$usuario["usuarionome"]?></td>
						<td>
							<a href="index.php?m=admin&c=usuarios&a=alterarUsuario&id=<?=$usuario["usuarioid"]?>" class="btn btn-primary">Alterar</a>
						</td>
						<td>
							<a href="index.php?m=admin&c=usuarios&a=excluirUsuario&id=<?=$usuario["usuarioid"]?>" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir o registro?')">Excluir</a>
						</td>
					</tr>
					
					<?php } ?>
				</tbody>
				
			</table>
		
		</div>
	</div>
</div>