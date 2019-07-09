<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'keranjang_keluar';

$join = 'tb_pakaian ON keranjang_keluar.kd_barang = tb_pakaian.kd_barang';
 
// Table's primary key
$primaryKey = 'id_keranjang';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id_keranjang',  'dt' => 0 ),
    array( 'db' => 'kd_transaksi',  'dt' => 1 ),
    array( 'db' => 'tanggal_keluar',   'dt' => 2 ),
    array( 'db' => 'nama_barang',   'dt' => 3 ),
    array( 'db' => 'jumlah_keluar',   'dt' => 4 ),
    array( 'db' => 'harga',   'dt' => 5 ),
    array( 'db' => 'sub_total',   'dt' =>6 )
    
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'db_batik',
    'host' => 'localhost'
);


$kode = $_POST['code'];
 

$where = "keranjang_keluar.kd_transaksi = '$kode'";
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../../library/ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $join, $where )
);