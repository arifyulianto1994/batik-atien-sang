<!-- content header -->
<section class="content-header">
	<h1>
		<i class="fa fa-file-text-o icon-title"></i>Laporan Peramalan
	</h1>
	<ol class="breadcrumb">
		<li><a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a></li>
		<li class="active">Laporan</li>
		<li class="active">Laporan Peramalan</li>
	</ol>
</section>

<!-- main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			
			<!-- form laporan -->
			<div class="box box-primary">
				<!-- form start -->
				<form role="form" class="form-horizontal" method="GET" action="modules/lap_peramalan/cetak.php" target="_blank">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Jenis</label>
								<div class="col-sm-2">
									<select class="chosen-select" name="jenis" data-placeholder="--Pilih--" autocomplete="off" required>
										<option value=""></option>
										<option value="Blouse">Blouse</option>
										<option value="Gamis">Gamis</option>
										<option value="Brukat">Brukat</option>
										<option value="Pakaian Anak">Pakaian Anak</option>
										<option value="Sarimbit">Sarimbit</option>
									</select>
								</div>
						</div>		
					</div>

					<div class="box-footer">
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-11">
								<button type="submit" class="btn btn-primary btn-social btn-submit">Lihat
									<!-- <i class="fa fa-print"></i>Lihat -->
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>