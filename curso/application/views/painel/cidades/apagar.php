<div class="jumbotron" style="padding: 10px;">
    <h1>Apagar cidade</h1>
</div>
<div class="row">
    <div class="col-md-12">
		<form action="" method="post">
			<div class="form-group"><label>Tem certeza que deseja apagar a cidade <?= $cidade->cid_nome; ?> ? </label>
				<div class="form-row">
					<div class="col-md-6">
						<a class="form-control btn btn-primary btn-block" href="<?= base_url(); ?>painel/cidades">Cancelar</a>
					</div>
					<div class="col-md-6">
						<input class="form-control btn btn-danger btn-block" type="submit" name="apagar" value="Apagar">
					</div>
				</div>
			</div>
        </form>
    </div>
</div>