<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $title ?> - Lentera Anak Nusantara</title>
		<link rel="icon" type="image/png" href="<?= base_url('assets/img/logo.ico') ?>"/>

		<!-- Bootstrap CSS -->
		<link href="<?php echo base_url() ?>assets/cosmo.min.css" rel="stylesheet">
		<!-- font awesome -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css">
		<!-- data-animate -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/data-animate.css">
		<!-- alert css -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/alert/sweetalert.css">
		<!-- datepicker -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/datepicker/datepicker3.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- jQuery -->
		<script src="<?php echo base_url() ?>assets/jQuery-2.1.4.min.js"></script>
		<script src="<?php echo base_url() ?>assets/js/jquery-qrcode-0.14.0.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url() ?>assets/alert/sweetalert.min.js"></script>

	</head>
	<body>
		<!-- header -->
		<?php echo $_header ?>
		<!-- content -->
		<div class="container">
			<legend>
				<?php echo $title; ?>
			</legend>
			<?php echo $_content; ?>
		</div>
		<hr>
		<div class="footer">
			<p class="text-center">
				<strong>
					&copy; <?php echo date('Y') ?> TBM Pondok Sinau Lentera Anak Nusantara<br>
				</strong>
					Jl. Pepen No. 52 Mojosari - Kepanjen Kab. Malang<br/>
					Email : pondoksinau.lensa@gmail.com
			</p>
		</div>

		<!-- modal fade -->
		<div class="modal fade" id="modal-delete">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<p>Delete Data</p>
					</div>
					<div class="modal-body">
						<input type="hidden" name="idhapus" id="idhapus">
						<p>Apakah anda yakin ingin menghapus data ini?</p>
					</div>
					<div class="modal-footer">
						<button id="konfirmasi" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
						<button class="btn btn-info" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>

		<!-- jquery additional -->
		<script src="<?php echo base_url() ?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
		<script src="<?php echo base_url() ?>assets/datepicker/bootstrap-datepicker.js"></script>
		
		<!-- jquery action -->
		<script>
			$(function(){
				tinymce.init({
						selector: "textarea",
					    plugins: [
					        "advlist autolink lists link image charmap print preview anchor",
					        "searchreplace visualblocks code fullscreen",
					        "insertdatetime media table contextmenu paste"
					    ],
					    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
				});
			});
		</script>
	</body>
</html>