<div class="container marginTop">
	<div class="row">
		<div class="col-xs-12">
			<a href="index.php?m=admin&c=categorias&a=cadastrarCategoria" class="btn btn-primary btn-large">Cadastrar nova categoria</a>
			
			<?php if($tpl["dados"]["msg"] != "") { ?>
				<div class="alert alert-info marginTop">
					<strong><?=$tpl["dados"]["msg"]?></strong>
				</div>
			<?php } ?>
			
			<table class="table table-striped table-bordered table-hover marginTop">
				<thead>
					<tr>
						<th width="40">ID</th>
						<th>Nome Categoria</th>
						<th width="40"></th>
						<th width="40"></th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach($tpl["dados"]["categorias"] as $categoria) { ?>
										
					<tr>
						<td><?=$categoria["categoriaid"]?></td>
						<td><?=$categoria["categoriatitulo"]?> (<?=$categoria["numeroposts"]?>)</td>
						<td>
							<a href="index.php?m=admin&c=categorias&a=alterarCategoria&id=<?=$categoria["categoriaid"]?>" class="btn btn-primary">Alterar</a>
						</td>
						<td>
							<a href="index.php?m=admin&c=categorias&a=excluirCategoria&id=<?=$categoria["categoriaid"]?>" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir o registro?')">Excluir</a>
						</td>
					</tr>
					
					<?php } ?>
				</tbody>
				
			</table>
		
		</div>
	</div>
</div>