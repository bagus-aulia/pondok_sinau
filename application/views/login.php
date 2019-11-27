<div id="login">
	<div class="row">
		<div class="delay-alert">
		<?php echo $this->session->flashdata('login_fail'); ?>
		</div>
		<div class="col-lg-5">
			<!-- form login -->
			<form action="" method="post">
				<div class="panel panel-primary">
					<div class="panel-heading"></div>
					<div class="panel-body">
						<label for="" class="control-label">Username :</label>
						<input type="text" class="form-control" name="username">
						<?php echo form_error() ?>
						<br>
						<label for="" class="control-label">Password :</label>
						<input type="password" name="password" class="form-control">
						<?php echo form_error() ?>
					</div>
					<div class="panel-footer">
						<div class="container-fluid">
							<button class="btn btn-primary"><i class="fa fa-sign-in"></i> Login</button>
						</div>
					</div>
				</div>
			</form>
		</div>

		<div class="col-lg-7">
		    <center>
		        <img src="<?= base_url('assets/img/logo.jpg') ?>" height="130px">
		    </center>
			<h2>Selamat Datang di Taman Baca Masyarakat Pondok Sinau Lentera Anak Nusantara</h2>
			<blockquote>
				<p><small>Silahkan Login untuk masuk ke aplikasi</small></p>
			</blockquote>
		</div>
	</div>
</div>

<script>
	$(function(){
		$('.delay-alert').delay(2000).hide(100);
	})
</script>