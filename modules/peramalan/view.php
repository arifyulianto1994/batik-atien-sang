<section class="content-header">
	<h1>
		<i class="fa fa-refresh"></i>Peramalan
	</h1>
	<ol class="breadcrumb">
		<li><a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a></li>
		<li class="active">Peramalan</li>
	</ol>
</section>

<!-- main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">

			<div class="box box-primary">
				<form role="form" class="form-horizontal" method="GET" action="modules/peramalan/proses.php">
					<div class="box-body">

						<div class="form-group">
							<label class="col-sm-1">Bulan</label>
								<div class="col-sm-2">
									<select class="chosen-select" name="Bulan" data-placeholder="--Pilih--" autocomplete="off" required>
										<option value=""></option>
										<option value="Januari">Januari</option>
										<option value="Februari">Februari</option>
										<option value="Maret">Maret</option>
										<option value="April">April</option>
										<option value="Mei">Mei</option>
										<option value="Juni">Juni</option>
										<option value="Juli">Juli</option>
										<option value="Agustus">Agustus</option>
										<option value="September">September</option>
										<option value="Oktober">Oktober</option>
										<option value="November">November</option>
										<option value="Desember">Desember</option>
									</select>
								</div>

							<label class="col-sm-1">Jenis</label>
								<div class="col-sm-2">
									<select class="chosen-select" name="Jenis" data-placeholder="--Pilih--" autocomplete="off" required>
										<option value=""></option>
										<option value="Blouse">Blouse</option>
										<option value="Sarimbit">Sarimbit</option>
										<option value="Pakaian Anak">Pakaian Anak</option>
										<option value="Brukat">Brukat</option>
										<option value="Brukat">Gamis</option>
									</select>
								</div>
						</div>
					</div>

					<div class="box-footer">
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-11">
								<button type="submit" class="btn btn-primary btn-social btn-submit">
									<i class="fa fa-refresh"></i>Ramal
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

