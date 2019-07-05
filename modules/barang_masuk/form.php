		
<script type="text/javascript">
	function tampil_batik(input){
		var num = input.value;

		$.post("modules/barang_masuk/batik.php", {
			dataidbatik:num,
		}, function(response){
			$('#stok').html(response)

			document.getElementById('jumlah_masuk').focus();
		});
	}	

	function cek_jumlah_masuk(input){
		jml =document.formBarangMasuk.jumlah_masuk.value;
		var jumlah = eval(jml);
		if(jumlah < 1){
			alert('Jumlah Masuk Tidak Boleh Nol!');
			input.value = input.value.substring(0,input.value.lenght-1);
		}
	}

	function hitung_total_stok(){
		bil1 = document.formBarangMasuk.stok.value;
		bil2 = document.formBarangMasuk.jumlah_masuk.value;

		if(bil2 == "") {
			var hasil = "";
		}
		else{
			var hasil = eval(bil1)+eval(bil2);
		}

		document.formBarangMasuk.total_stok.value = (hasil);
	}

</script>

<script>
 	
	$(document).ready(function() {

		var kode = $('#kd_transaksi').val();

		// load data total bayar
		let tunai = 0;
		$('#total').prop('readonly', true).val(tunai);

		// ambil data total bayar 
		$.ajax({
			url: "modules/barang_masuk/proses.php",
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
				"url": "modules/barang_masuk/load_ajax.php",
				"type": "post",
				"data":  {
						code : kode
					}
			},
			"columnDefs": [
				{
					"searchable": false,
					"orderable": false,
					"targets": 3,
					"render": function(data, type, row){
						var sub_total = formatRupiah(data.toString(), '');
						return sub_total;
					}
				},
				{
					"searchable": false,
					"orderable": false,
					"targets": 4,
					"render": function(data, type, row){
						var btn = "<a data-id=\""+data+"\" class=\"btn btn-danger btn-xs\" onclick=\"hapus("+data+")\"><i class=\"glyphicon glyphicon-remove\"></i></a></<a>";
						return btn;
					}
				}
			]
        } );

		// ambil harga dan stok sesuai pilihan barang 
		$('#kd_barang').change(function(e){
			const kode_barang = $(this).val();

			$.ajax({
				url: 'modules/barang_masuk/proses.php',
				type: 'get',
				dataType: 'json',
				data: {kode_barang: kode_barang},
				success: function(data){
					$('#stok').val(data.stok);
					$('#harga').val(formatRupiah(data.harga.toString(), ''));
				}	
			})
		})

		// menghitung total harga 
		$("#jumlah_masuk").keyup(function(){
			var jumlah_masuk 	= $(this).val();
			var harga 			= $("#harga").val().replace(/\./g,'');
			var total 			= parseInt(jumlah_masuk) * parseInt(harga);
			$("#sub_total").val(formatRupiah(total.toString(), ''));
		});
		
		// proses kirim data simpan data produk
		$('#tambah').click(function(e){
			e.preventDefault();
			var dataForm = $('#myForm').serialize();

			$.ajax({
				url: 'modules/barang_masuk/proses.php',
				data: dataForm,
				type: 'post',
				success: function(response){
					$('#table-keranjang').DataTable().ajax.reload();
					tunai = parseInt(response);
					$('#total').val(formatRupiah(tunai.toString(), ''));
				}
			})
		})

		// ubah nominal tunai ke format rupiah ketika diketik
		$('#tunai').keyup(function(){
			var nominal = $(this).val();
			$(this).val(formatRupiah(nominal.toString(), ''));

			const tunai 	= $(this).val().replace(/\./g,'');
			const total 	= $('#total').val().replace(/\./g,'');
			const kembali 	= parseInt(tunai) - parseInt(total);

			$('#kembali').val(formatRupiah(kembali.toString(), ''));
		})

		// proses simpan bayar
		$('#bayar').click(function(){
			const total = $('#total').val();
			const tanggal = $();

			$.ajax({
				url: 'modules/barang_masuk/proses.php',
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
			url: 'modules/barang_masuk/proses.php',
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
				<i class="fa fa-edit icon-title"></i>Input Data Batik Masuk
			</h1>
			<ol class="breadcrumb">
				<li><a href="?module=beranda"><i class="fa fa-home"></i>Beranda</a></li>
				<li><a href="?module=barang_masuk">Batik Masuk</a></li>
				<li class="active">Tambah</li>
			</ol>
		</section>

		<!-- main content -->
		<section class="content">
			<div class="row">	
				<div class="col-md-12">
					<div class="box box-primary">
						<!-- form statrt -->
						<form role="form" class="form-horizontal" action="modules/barang_masuk/proses.php" method="POST" name="formBarangMasuk" id="myForm">
							<div class="box-body">
								<?php 
									// query utk buat kode transaksi
									$query_id = mysqli_query($mysqli, "SELECT RIGHT(kd_transaksi,7) as kode FROM tb_barang_masuk ORDER BY kd_transaksi DESC LIMIT 1") or die('Ada kesalahan pada query tampil kode transaksi : '.mysqli_error($mysqli));
									$count=mysqli_num_rows($query_id);

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
									$kd_transaksi = "TM-$tahun-$buat_id";
								 ?>

								 <div class="form-group">
								 	<label class="col-md-2 control-label">Kode Transaksi</label>
								 	<div class="col-md-5">
								 		<input type="text" id="kd_transaksi" class="form-control" name="kd_transaksi" value="<?php echo $kd_transaksi; ?>" readonly required>
								 	</div>
								 </div>

								 <div class="form-group">
								 	<label class="col-md-2 control-label">Tanggal</label>
								 	<div class="col-md-5">
								 		<input type="text" class="form-control date-picker" date-date-format="dd-mm-yyyy" name="tanggal_masuk" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" required>
								 	</div>
								 </div>

								 <hr>

								 <div class="form-group">
								 	<label class="col-md-2 control-label">Batik</label>
								 	<div class="col-md-5">
								 		<select class="chosen-select" name="kd_barang" data-placeholder="--Pilih--" id="kd_barang">
								 			<option value=""></option>
								 			<?php 
								 				$query_batik = mysqli_query($mysqli, "SELECT kd_barang, nama_barang FROM tb_pakaian ORDER BY nama_barang ASC") or die('Ada kesalahan pada query tampil batik: '.mysqli_error($mysqli));

								 				while($data_batik = mysqli_fetch_assoc($query_batik)){
								 					echo"<option value=\"$data_batik[kd_barang]\">$data_batik[nama_barang]</option>";
								 				}
								 			 ?>
								 		</select>
								 	</div>
								 </div>

								 <div class="form-group">
								 	<label class="col-md-2 control-label">Nama Supplier</label>
								 	<div class="col-md-5">
								 		<select class="chosen-select" name="kd_supplier" data-placeholder="--Pilih--" autocomplete="off" required>
								 			<option value=""></option>
								 			<?php 
								 				$query_suppl = mysqli_query($mysqli, "SELECT kd_supplier, nama_supplier FROM tb_supplier ORDER BY nama_supplier ASC") or die('Ada kesalahan pada query tampil suppl: '.mysqli_error($mysqli));

								 				while($data_suppl = mysqli_fetch_assoc($query_suppl)){ ?>
								 					<option value="<?= $data_suppl['kd_supplier'] ?>"> <?= $data_suppl['kd_supplier'] ?> | <?= $data_suppl['nama_supplier'] ?></option>
								 				<?php } ?>
								 		</select>
								 	</div>
								 </div>

								 <span>
								 	<div class="form-group">
								 		<label class="col-md-2 control-label">Stok</label>
								 		<div class="col-md-5">
								 			<input type="text" class="form-control" id="stok" name="stok" readonly>
								 		</div>
								 	</div>
								 </span>

								 <div class="form-group">
								 	<label class="col-md-2 control-label">Jumlah Masuk</label>
								 	<div class="col-md-5">
								 		<input type="text" class="form-control" id="jumlah_masuk" name="jumlah_masuk" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="hitung_total_stok(this)&cek_jumlah_masuk(this)" required>
								 	</div>
								 </div>

								 <div class="form-group">
								 	<label class="col-md-2 control-label">Total Stok</label>
								 	<div class="col-md-5">
								 		<input type="text" class="form-control" id="total_stok" name="total_stok" readonly required>
								 	</div>
								 </div>

								 <div class="form-group">
										<label class="col-md-2 control-label">Harga</label>
										<div class="col-md-5">
											<div class="input-group">
												<span class="input-group-addon">Rp.</span>
												<input type="text" class="form-control" id="harga" name="harga" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" readonly>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Total</label>
										<div class="col-md-5">
											<div class="input-group">
												<span class="input-group-addon">Rp.</span>
												<input type="text" class="form-control" id="sub_total" name="sub_total" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" readonly="readonly">
											</div>
										</div>
									</div>

								<div class="row box-footer">
									<div class="col-md-7 col-sm-7 col-xs-12 col-lg-7 text-right">
										<input type="submit" class="btn btn-success btn-submit" id="tambah" name="tambah" value="Tambah" href="?module=form_barang_masuk&form=add&id=$data[kd_transaksi]">	
									</div>
								</div>
							<!-- ./box body -->
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
										<th class="center">Tanggal Masuk</th>
										<th class="center">Nama Barang</th>
										<th class="center">Jumlah Masuk</th>
										<th class="center">Sub Total</th>
										<th class="center">Aksi</th>
									</tr>
								</thead>
							</table>
							<table class="table table-bordered table-striped table-hover text-center">
								<!-- tampilan tabel header -->
								<thead>
									<tr>
										<th colspan="4" class="text-right">Total</th>
										<th>
											<input type="text" class="form-control" id="total" name="total" readonly="readonly">
										</th>
									</tr>
									<tr>
										<th colspan="4">Tunai</th>
										<th> 
											<input type="text" class="form-control" id="tunai" name="tunai">
										</th>
									</tr>
									<tr>
										<th colspan="4">Kembali</th>
										<th>
											<input type="text" class="form-control" id="kembali" name="kembali" readonly="readonly">
										</th>
									</tr>
								</thead>
							</table>
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 text-right">
									<input type="submit" class="btn btn-success btn-submit" id="bayar" value="Bayar">	
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