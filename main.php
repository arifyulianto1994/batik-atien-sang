<?php 

session_start();
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Aplikasi Peramalan Persediaan Batik</title>
 	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 	<meta name="description" content="Aplikasi Peramalan Persediaan Batik">
 	<meta name="author" content="Annisa FZ" />


 	<link rel="shortcut-icon" href="assets/img/logo4.png" />
 	<!-- Bootstrap 3.3.2 -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />  
    <!-- DATA TABLES -->
    <!-- <link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" /> -->
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Datepicker -->
    <link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Chosen Select -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/chosen/css/chosen.min.css" />
    <!-- Theme style -->
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link href="assets/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

    
    <script type="text/javascript" src="assets/js/jquery-3.4.1.js"></script>
 	<!-- Fungsi untuk membatasi karakter yang diinputkan -->
    <script language="javascript">
      function getkey(e)
      {
        if (window.event)
          return window.event.keyCode;
        else if (e)
          return e.which;
        else
          return null;
      }

      function goodchars(e, goods, field)
      {
        var key, keychar;
        key = getkey(e);
        if (key == null) return true;
       
        keychar = String.fromCharCode(key);
        keychar = keychar.toLowerCase();
        goods = goods.toLowerCase();
       
        // check goodkeys
        if (goods.indexOf(keychar) != -1)
            return true;
        // control keys
        if ( key==null || key==0 || key==8 || key==9 || key==27 )
          return true;
          
        if (key == 13) {
          var i;
          for (i = 0; i < field.form.elements.length; i++)
            if (field == field.form.elements[i])
              break;
          i = (i + 1) % field.form.elements.length;
          field.form.elements[i].focus();
          return false;
        };
        // else return false
        return false;
      }
    </script>
  </head>
 <body class="skin-blue fixed">
 	<div class="wrapper">
 		<header class="main-header">
 			<!-- logo -->
 			<a href="?module=beranda" class="logo">
 				<img style="margin-top:-1px;margin-right:5px" src="assets/img/logo4.png" width="40" alt="Logo">
 				<span style="font-size: 18px">Batik Atien Sang</span>
 			</a>
 			<!-- header navbar -->
 			<nav class="navbar navbar-static-top" role="navigation">
 				<!-- sidebar button -->
 				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
 					<span class="sr-only">Toggle Navigation</span>
 				</a>
 				<div class="navbar-custom-menu">
 					<ul class="nav navbar-nav">
 						<!-- panggil file top_menu.php utk tampilkan menu -->
 						<?php include "top_menu.php" ?>
 					</ul>
 				</div>
 			</nav>
 		</header>
 		<aside class="main-sidebar">
 			<section class="sidebar">
 				<!-- panggil file sidebar_menu.phputk tsmpilkan menu -->
 				<?php include "sidebar_menu.php" ?>
 			</section>
 		</aside>

 		<!-- content wrapper  -->
 		<div class="content-wrapper">
 			<!-- panggil filr content_menu.php utk tampilkan konten -->
 			<?php include "content.php" ?>

 			<!-- Logout -->
 			<div class="modal fade" id="logout">
 				<div class="modal-dialog">
 					<div class="modal-content">
 						<div class="modal-header">
 							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
 							</button>
 							<h4 class="modal-title"><i class="fa fa-sign-out">Logout</i></h4>
 						</div>
 						<div class="modal-body">
 							<p>Apakah Anda yakin ingin logout ?</p>
 						</div>
 						<div class="modal-footer">
 							<a type="button" class="btn btn-danger" href="logout.php">Ya, Logout</a>
 							<button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
 						</div>
 					</div>
 				</div>
 			</div>

 		</div>

 		<footer class="main-footer">
 			<strong>Copyright &copy; 2019 - <a href="www.annisa.com">6P11</a></strong>
 		</footer>
 	</div>

 <!-- jQuery 2.1.3 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- datepicker -->
    <script src="assets/plugins/datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <!-- chosen select -->
    <script src="assets/plugins/chosen/js/chosen.jquery.min.js"></script>
    <!-- DATA TABES SCRIPT -->
    <!-- <script src="assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script> -->
    <!-- Datepicker -->
    <script src="assets/plugins/datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- maskMoney -->
    <script src="assets/js/jquery.maskMoney.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/js/app.min.js" type="text/javascript"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        // datepicker plugin
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        });

        // chosen select
        $('.chosen-select').chosen({allow_single_deselect:true}); 
        //resize the chosen on window resize
        
        // mask money
        $('#harga_beli').maskMoney({thousands:'.', decimal:',', precision:0});
        $('#harga_jual').maskMoney({thousands:'.', decimal:',', precision:0});
        $('#harga').maskMoney({thousands:'.', decimal:',', precision:0});

        $(window)
        .off('resize.chosen')
        .on('resize.chosen', function() {
          $('.chosen-select').each(function() {
             var $this = $(this);
             $this.next().css({'width': $this.parent().width()});
          })
        }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
          if(event_name != 'sidebar_collapsed') return;
          $('.chosen-select').each(function() {
             var $this = $(this);
             $this.next().css({'width': $this.parent().width()});
          })
        });
    
    
        $('#chosen-multiple-style .btn').on('click', function(e){
          var target = $(this).find('input[type=radio]');
          var which = parseInt(target.val());
          if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
           else $('#form-field-select-4').removeClass('tag-input-style');
        });

        // DataTables
        $("#dataTables1").dataTable();
        $('#dataTables2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });

       
      });
    </script>

  </body>
</html>