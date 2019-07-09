<script type="text/javascript">
	// function tampil_batik(input){
	// 	var num = input.value;

	// 	$.post("modules/barang_keluar/batik.php", {
	// 		dataidbatik:num,
	// 	}, function(response){
	// 		$('#stok').html(response)

	// 		document.getElementById('jumlah_masuk').focus();
	// 	});
	// }


	$(document).ready(function(){

		
		var kode = $('#kd_transaksi').val();

		// load data total bayar
		let tunai = 0;
		$('#total').prop('readonly', true).val(tunai);

		// ambil data total bayar 
		$.ajax({
			url: "modules/barang_keluar/proses.php",
			type: "post",
			data: {id: kode},
			success: function(response){
				if (response) {
					tunai = tunai + parseInt(response);
					$('#total').val(formatRupiah(tunai.toString(), ''));
				}
			}
		})	

		// load datatable
		$('#table-keranjang').DataTable( {
			"bFilter": false,
			"bPaginate": false,
			"bSort": false,
			"bInfo": false,
            "processing": true,
            "serverSide": true,
			"dataSrc": "",
            "ajax": {
				"url": "modules/barang_keluar/load_ajax.php",
				"type": "post",
				"data":  {
						code : kode
					}
			},
			"columnDefs": [
				{
					"searchable": false,
					"orderable": false,
					"targets": 5,
					"className": 'dt-body-right',
					"render": function(data, type, row){
						var harga = formatRupiah(data.toString(), '');
						return harga;
					}
				},
				{
					"searchable": false,
					"orderable": false,
					"targets": 6,
					"className": 'dt-body-right',
					"render": function(data, type, row){
						var total = formatRupiah(data.toString(), '');
						return total;
					}
				},
				{
					"searchable": false,
					"orderable": false,
					"targets": 0,
					"render": function(data, type, row){
						var btn = "<a data-id=\""+data+"\" class=\"btn btn-danger btn-xs\" onclick=\"hapus("+data+")\"><i class=\"glyphicon glyphicon-trash\"></i></a></<a>";
						return btn;
					}
				}
			]
        } );

		// ambil harga dan stok sesuai pilihan barang 
		$('#kd_barang').change(function(){
			const kode_barang = $(this).val();

			$.ajax({
				url: 'modules/barang_keluar/proses.php',
				type: 'get',
				dataType: 'json',
				data: {kode_barang: kode_barang},
				success: function(data){
					$('#stok').val(data.stok);
					$('#harga').val(formatRupiah(data.harga.toString(), ''));
				}	
			})
		});

		// proses kirim data simpan data produk
		$('#tambah').click(function(e){
			e.preventDefault();
			var dataForm = $('#myForm').serialize();

			$.ajax({
				url: 'modules/barang_keluar/proses.php',
				data: dataForm,
				type: 'post',
				success: function(response){
					$('#table-keranjang').DataTable().ajax.reload();
					tunai = parseInt(response);
					$('#total').val(formatRupiah(tunai.toString(), ''));
				}
			})
		})

		// menghitung total harga 
		$("#jumlah_keluar").keyup(function(){
			var jumlah_keluar 	= $(this).val();
			var stok_lama 		= $('#stok').val(); 

			var stok_baru 		= parseInt(stok_lama) - parseInt(jumlah_keluar);

			// $('#stok').val(stok_baru);

			var harga 			= $("#harga").val().replace(/\./g,'');
			var sub_total 		= parseInt(jumlah_keluar) * parseInt(harga);
			$("#sub_total").val(formatRupiah(sub_total.toString(), ''));
		});

		// ubah nominal tunai ke format rupiah ketika diketik
		$('#tunai').keyup(function(){
			var nominal = $(this).val();
			$(this).val(formatRupiah(nominal.toString(), ''));

			const tunai 	= $(this).val().replace(/\./g,'');
			const total 	= $('#total').val().replace(/\./g,'');
			const kembali 	= parseInt(tunai) - parseInt(total);

			// nominal minus jika uang tunai kurang dari total bayar
			if (parseInt(tunai) < parseInt(total)) {
				$('#kembali').val('-' + formatRupiah(kembali.toString(), ''));
			} else {
				$('#kembali').val(formatRupiah(kembali.toString(), ''));
			}
		})

		// proses simpan bayar
		$('#bayar').click(function(){
			const total = $('#total').val();

			$.ajax({
				url: 'modules/barang_keluar/proses.php',
				data: {
						code: kode,
						bayar: total
					},
				type: 'post',
				success: function(response){
					location.reload();
				}
			})
		})

	});	


	// fungsi hapus data list produk
	function hapus(id){
		var id_keranjang = id;

		$.ajax({
			url: 'modules/barang_keluar/proses.php',
			data: {id: id_keranjang},
			type: 'get',
			success: function(response){
				if (response > 0) {
					$('#table-keranjang').DataTable().ajax.reload();
				}
			}
		})
	}

	
	/* Fungsi mengubah angka ke formatRupiah */
	function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
	}
</script>

<?php 
	// fungsi utk cek tampilan form
	// jika form add data yg diklik
	if($_GET['form']=='add') { ?>
		<!-- tampilan form addd data -->
		<!-- content header -->
		<section class="content-header">
			<h1>
				<i class="fa fa-edit icon-title"></i>Input Data Batik Keluar
			</h1>
			<ol class="breadcrumb">
				<li><a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a></li>
				<li><a href="?module=barang_keluar">Batik Keluar</a></li>
				<li class="active">Tambah</li>
			</ol>
		</section>

		<!-- main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<!-- form statrt -->
						<form role="form" class="form-horizontal" action="modules/barang_keluar/proses.php?act=insert" method="POST" name="formBarangKeluar" id="myForm">
							<div class="box-body">
								<?php 
									// query utk buat kode transaksi
									$query_id = mysqli_query($mysqli, "SELECT RIGHT(kd_transaksi,7) as kode FROM tb_barang_keluar ORDER BY kd_transaksi DESC LIMIT 1") or die('Ada kesalahan pada query tampil kode transaksi : '.mysqli_error($mysqli));
									$count = mysqli_num_rows($query_id);

									if($count <> 0){
										// ambil data kode trans
										$data_id = mysqli_fetch_assoc($query_id);
										$kode = $data_id['kode']+1;
									}else{
										$kode=1;
									}

									// buat kode trans
									$tahun = date("Y");
									$buat_id = str_pad($kode, 7, "0", STR_PAD_LEFT);
									$kd_transaksi = "TK-$tahun-$buat_id";
								 ?>

								 <div class="form-group">
								 	<label class="col-sm-2 control-label">Kode Transaksi</label>
								 	<div class="col-sm-5">
								 		<input type="text" class="form-control" id="kd_transaksi" name="kd_transaksi" value="<?php echo $kd_transaksi; ?>" readonly required>
								 	</div>
								 </div>

								 <div class="form-group">
								 	<label class="col-sm-2 control-label">Tanggal Keluar</label>
								 	<div class="col-sm-5">
								 		<input type="text" class="form-control date-picker" date-date-format="dd-mm-yyyy" name="tanggal_keluar" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" required>
								 	</div>
								 </div>
								 
								 <div class="form-group">
								 	<label class="col-sm-2 control-label">Batik</label>
								 	<div class="col-sm-5">
								 		<select class="chosen-select" id="kd_barang" name="kd_barang" data-placeholder="--Pilih--" autocomplete="off" required>
								 			<option value=""></option>
								 			<?php 
								 				$query_batik = mysqli_query($mysqli, "SELECT kd_barang, nama_barang FROM tb_pakaian ORDER BY nama_barang ASC") or die('Ada kesalahan pada query tampil batik: '.mysqli_error($mysqli));

								 				while ($data_batik = mysqli_fetch_assoc($query_batik)) {
								 			 ?>
												<option value="<?php echo $data_batik["kd_barang"] ?>"> <?php echo $data_batik["nama_barang"] ?></option>
											<?php } ?>
								 		</select>
								 	</div>
								 </div>

								 <span>
								 	<div class="form-group">
								 		<label class="col-sm-2 control-label">Stok</label>
								 		<div class="col-sm-5">
								 			<input type="text" class="form-control" id="stok" name="stok" readonly required>
								 		</div>
								 	</div>
								 </span>

								   <div class="form-group">
								 	<label class="col-sm-2 control-label">Jumlah</label>
								 	<div class="col-sm-5">
								 		<input type="text" class="form-control" id="jumlah_keluar" name="jumlah_keluar" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
								 	</div>
								 </div>

								 	<div class="form-group">
										<label class="col-sm-2 control-label">Harga</label>
										<div class="col-sm-5">
											<div class="input-group">
												<span class="input-group-addon">Rp.</span>
												<input type="text" class="form-control" id="harga" name="harga" autocomplete="off" onKeyPress="return goodchars(event, '0123456789,this>" readonly required>
											</div>
										</div>
									</div>

								  	<div class="form-group">
										<label class="col-sm-2 control-label">Total</label>
										<div class="col-sm-5">
											<div class="input-group">
												<span class="input-group-addon">Rp.</span>
												<input type="text" class="form-control" id="sub_total" name="sub_total" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" readonly required>
											</div>
										</div>
									</div>
									
								 <hr>

							<!-- ./box body -->
							</div>

							<div class="row box-footer">
									<div class="col-md-7 col-sm-7 col-xs-12 col-lg-7 text-right">
										<input type="submit" class="btn btn-success btn-submit" id="tambah" name="tambah" value="Tambah" href="?module=form_barang_masuk&form=add&id=$data[kd_transaksi]">	
									</div>
								</div>
							
						</form>
					</div>
				</div>
			</div>
		</section>


		<section class="content">
			<h3>
				<i class="fa fa-shopping-cart icon-title"></i>List Produk
			</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-body">
							<table id="table-keranjang" class="table table-bordered table-striped table-hover text-center">
								<!-- tampilan tabel header -->
								<thead>
									<tr>
										<!-- <th class="center">No.</th> -->
										<th class="center">Aksi</th>
										<th class="center">Kode Transaksi</th>
										<th class="center">Tanggal</th>
										<th class="center">Nama Barang</th>
										<th class="center">Jumlah</th>
										<th class="center">Harga</th>
										<th class="center">Total</th>
									</tr>
								</thead>
							</table>

							<hr>

							<div class="row">
								<div class="form-group">
								 	<label class="col-md-9 control-label text-right">Total</label>
								 	<div class="col-md-3">
								 		<input type="text" class="form-control text-right" id="total" name="total" autocomplete="off" required disabled> 
								 	</div>
								 </div>

								<div class="form-group">
								 	<label class="col-md-9 control-label text-right">Tunai</label>
								 	<div class="col-md-3">
								 		<input type="text" class="form-control text-right" id="tunai" name="tunai" autocomplete="off" required>
								 	</div>
								 </div>

								<div class="form-group">
								 	<label class="col-md-9 control-label text-right">Kembali</label>
								 	<div class="col-md-3">
								 		<input type="text" class="form-control text-right" id="kembali" name="kembali" autocomplete="off" required disabled>
								 	</div>
								 </div>
							</div>

							<hr>

							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
									<input type="submit" class="btn btn-success btn-submit pull-right" id="bayar" value="Bayar">	
								</div>
							</div>
			 			</div>
						
				
			 		</div>
				</div>
			</div>	
		</section>
<?php 
}
 ?>