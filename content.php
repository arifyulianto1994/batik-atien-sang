<?php 
	// panggil file db.php utk koneksi ke db
require_once "config/database.php";
// panggil file fungsi tambahan
require_once "config/fungsi_tanggal.php";
require_once "config/fungsi_rupiah.php";

// jika user blm login, alihkan ke halaman login dan tampilkan pesan=1
if(empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}

// jika user sdh login, maka jalankan perintah utk pemanggilan file halaman login
else {
	// jika halaman konten yg dipilih beranda panggil file view beranda
	if($_GET['module'] == 'beranda') {
		include "modules/beranda/view.php";
	}
	// jika halaman  konten yg dipilih batik, panggil file view hp
	elseif($_GET['module'] == 'batik'){
		include "modules/batik/view.php";
	}
	// jika halaman konten yg dipilih form batik, panggil file form batik
	elseif($_GET['module'] == 'form_batik'){
		include "modules/batik/form.php";
	}

	// jika hal konten yg dipilih barang_masuk, panggil file view barang masuk
	elseif($_GET['module'] == 'barang_masuk'){
		include "modules/barang_masuk/view.php";
	}

	// jika halaman konten yg dipilih form barangmasuk, panggil file form barang masuk
	elseif($_GET['module'] == 'form_barang_masuk'){
		include "modules/barang_masuk/form.php";
	}
	// jika hal konten yg dipilih barang_keluar, panggil file view barang keluar
	elseif($_GET['module'] == 'barang_keluar'){
		include "modules/barang_keluar/view.php";
	}

	// jika halaman konten yg dipilih form barangkeluar, panggil file form barang keluar
	elseif($_GET['module'] == 'form_barang_keluar'){
		include "modules/barang_keluar/form.php";
	}

	// jjika halaman konten yg dipilih data supplier, panggil file view  supplier
	elseif($_GET['module'] == 'supplier'){
		include "modules/supplier/view.php";
	}
	// jika halaman konten yg dipilih form suppl, panggil file suppl
	elseif($_GET['module']=='form_supplier'){
		include "modules/supplier/form.php";
	}

	// jika halaman konten yg dipilih laporan stok panggil file view lap stok
	elseif($_GET['module'] == 'lap_stok'){
		include "modules/lap_stok/view.php";
	}

	// jika halaman konten yg dipilih laporan barang_masuk panggil file view lap barang masuk
	elseif($_GET['module'] == 'lap_barang_masuk'){
		include "modules/lap_barang_masuk/view.php";
	}

	// jika halaman konten yg dipilih laporan barang_keluar panggil file view lap barang keluar
	elseif($_GET['module'] == 'lap_barang_keluar'){
		include "modules/lap_barang_keluar/view.php";

	// // jika halaman konten yg dipilihgrafik penj panggil file view grafik penj
	// elseif($_GET['module'] == 'grafik_penjualan'){
	// 	include "modules/grafik_penjualan/view.php";
	}
	// jika halaman konten yg dipilih peramalan panggil file view peramalan
	elseif($_GET['module'] == 'lap_peramalan'){
		include "modules/lap_peramalan/view.php";

	}
	// jika halaman konten yg dipilih lap peramalan panggil file view lap. peramalan
	elseif($_GET['module'] == 'peramalan'){
		include "modules/peramalan/view.php";
	}

	// jika halaman konten yg dipilih user, panggil file view user 
	elseif($_GET['module'] == 'user'){
		include "modules/user/view.php";
	} 

	// jika halaman konten yg dipilih form user panggil form user 
	elseif($_GET['module'] == 'form_user'){
	include "modules/user/form.php";
	}

	//jika halaman konten yg dipilih profil, panggil file view profil 
	elseif($_GET['module'] == 'profil'){
		include "modules/profil/view.php";
	} 

	// jika halaman konten yg dipilih form profil, panggil file form profil
	elseif($_GET['module'] == 'form_profil'){
		include "modules/profil/form.php";
	}

	// jika halaaman konten yg dipilih password panggil file view password
	elseif($_GET['module'] == 'password'){
		include "modules/password/view.php";
	}
	// jika halaaman konten yg dipilih lap_ pramalan panggil file view lap peramalan
	elseif($_GET['module'] == 'lap_peramalan'){
		include "modules/lap_peramalan/view.php";
	}
}
 ?>