<!-- Jquery & ajax -->
<style>
    .scanner-laser {
        position: absolute;
        margin: 20px;
        height: 30px;
        width: 30px;
        opacity: 0.5;
    }
    
    .laser-leftTop {
        top: 0;
        left: 0;
        border-top: solid red 5px;
        border-left: solid red 5px;
    }
    
    .laser-leftBottom {
        bottom: 0;
        left: 0;
        border-bottom: solid red 5px;
        border-left: solid red 5px;
    }
    
    .laser-rightTop {
        top: 0;
        right: 0;
        border-top: solid red 5px;
        border-right: solid red 5px;
    }
    
    .laser-rightBottom {
        bottom: 0;
        right: 0;
        border-bottom: solid red 5px;
        border-right: solid red 5px;
        JS
    }
    
    .qr-box {
        width: 270px;
        margin-left: 10px;
        float: left; 
        padding: 4px 8px; 
        border: solid 1px #2780E3;
    }
</style>
<script>
		$(function(){
			function loadData(args)
			{
				$("#tampilbuku").load("<?php echo site_url('peminjaman/tampilBuku') ?>");
			}

			loadData();	

			//cari anggota
			$("#carianggota").click(function(event) {

					var id = $("#kode").val();

					$.ajax({
						url : "<?php echo site_url('peminjaman/cariAnggota') ?>",
						type : "POST",
						data : "id_anggota="+id,
						success : function(msg){
							$("#nama").val(msg);
						}
					});
				
			});

			//cari buku
			$("#caribuku").click(function(event) {

					var kd_buku = $("#kd_buku").val();

					$.ajax({
						url : "<?php echo site_url('peminjaman/cariBuku') ?>",
						type : "POST",
						data : "kd_buku="+kd_buku,
						success : function(msg){
							 ex = msg.split("|");

							var judul = ex[0];
							var pengarang = ex[1];

							$("#judul").val(judul);
							$("#pengarang").val(pengarang);
						}
					});
			
			});

			//tambah buku
			$('#tambahbuku').click(function(){
				var kd_buku = $("#kd_buku").val();
				var judul = $("#judul").val();
				var pengarang = $("#pengarang").val();

				if(kd_buku == "" && judul == "" && pengarang == "")
				{
					alert("Field Harus Terisi Semua .. !!!!");
				}
				else{
					$.ajax({
						url : "<?php echo site_url('peminjaman/tambahBuku') ?>",
						type : "POST",
						data : "kd_buku="+kd_buku+"&judul="+judul+"&pengarang="+pengarang,
						success : function(msg)
						{
							loadData();
						}
					});
				}
			});

			//simpan data
			$("#simpan").click(function(){
				var kd_pinjam = $("#kd_peminjaman").val();
				var tgl_pinjam = $("#tgl_pinjam").val();
				var tgl_kembali = $("#tgl_kembali").val();
				var id_anggota = $("#kode").val();


				if (id_anggota == "" && $("#nama").val() == "" && $("#kd_buku").val() == "" && $("#judul").val() == "") {
					swal({title : "Peringatan", text : "Field tidak boleh kosong !!!", type : "error", timer:2000});
				}
				else
				{
					$.ajax({
						url : "<?php echo site_url('peminjaman/simpan') ?>",
						type : "POST",
						data : {
									//key : value
									kd_peminjaman : kd_pinjam,
									tgl_pinjam : tgl_pinjam,
									tgl_kembali : tgl_kembali,
									id_anggota : id_anggota
								},	
						beforeSend : function(){
							$("#loading_simpan").html('<div class="alert alert-info"><i class="fa fa-spinner fa-spin"></i> Sedang Mempross data ...</div>');
						},
						success : function(html)
						{
							location.reload();
						}
					})
				}
			})

		})
</script>
<?php echo $this->session->flashdata('sukses'); ?>
<!-- end -->
<div id="peminjaman" style="width: 100%">
		<div id="loading_simpan"></div>
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="row form-horizontal">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="col-md-4 control-label`">Kode Peminjaman</label>
							<div class="col-md-7">
								<input type="text" name="kd_peminjaman" id="kd_peminjaman" readonly class="form-control" value="<?php echo $kd_peminjaman ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-4 control-label">Tanggal Pinjam</label>
							<div class="col-md-7">
								<input type="text" name="tgl_pinjam" id="tgl_pinjam" readonly class="form-control" value="<?php echo $tanggal_sekarang ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-4 control-label">Tgl Harus Kembali</label>
							<div class="col-md-7">
								<input type="text" name="tgl_kembali" id="tgl_kembali" readonly class="form-control" value="<?php echo $tanggal_tempo ?>">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Id Anggota</label>
							<div class="col-md-7">
								<div class="row">
									<div class="col-md-10">
										<input type="text" name="id_anggota"  id="kode" class="form-control" required>
									</div>
									<div class="col-md-2">
										<p class='btn btn-warning' id="carianggota"><i class="fa fa-search"></i></p>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Nama</label>
							<div class="col-md-8">
								<input type="text" id="nama" name="nama" class="form-control" readonly required>
							</div>
						</div>
					</div>		
				</div>
				<hr>
				<div class="panel panel-info">
					<div class="panel-heading">
						Buku yang akan di pinjam
					</div>
					<div class="panel-body">
						<!--<div class="row">-->
						<!--	<div class="col-md-4">-->
						<!--		<div class="row">-->
						<!--			<div class="col-md-9">-->
						<!--				<input type="text" id="kd_buku" name="kd_buku" class="form-control" placeholder="Masukan Kode Buku" required>-->
						<!--			</div>-->
						<!--			<div class="col-md-2">-->
						<!--				<p class="btn btn-info" id="caribuku" ><i class="fa fa-search"></i></p>-->
						<!--			</div>-->
						<!--		</div>-->
								
						<!--	</div>-->
						<!--	<div class="col-md-3">-->
						<!--		<input type="text" id="judul" name="judul" class="form-control" placeholder="Judul Buku" readonly required> -->
						<!--	</div>-->
						<!--	<div class="col-md-3">-->
						<!--		<input type="text" id="pengarang" class="form-control" name="pengarang" placeholder="Pengarang" readonly required>-->
						<!--	</div>-->
						<!--	<div class="col-md-2">-->
						<!--		<p id="tambahbuku" class="btn btn-primary"><i class="fa fa-plus"></i></p>-->
						<!--	</div>-->
						<!--</div>-->
						<div class="row" style="padding: 15px 0">
							<div class="col-md-12">
								<input type="text" id="qr_buku" name="kd_buku" class="form-control" placeholder="Taruh kursor disini sebelum menye-scan qr code">
								<input type="hidden" id="site_url" value="<?= base_url() ?>">
							</div>
						</div>
						<div id="tampilbuku">
							
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<button class="btn btn-primary" id="simpan">Simpan Peminjaman </button>
			</div>
		</div>
</div>

<!--<div class="qr-box">-->
<!--    <div style="text-align: center; padding-bottom: 10px;">Scan Book QR CODE</div>-->
<!--    <input type="hidden" id="site_url" value="<?= base_url() ?>">-->
<!--    <div id="qr-area" style="position: relative;">-->
<!--        <div id="scanner-laser-area">-->
<!--            <canvas id="qr-canvas"></canvas>-->
<!--            <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>-->
<!--            <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>-->
<!--            <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>-->
<!--            <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>-->
<!--        </div>-->
<!--        <div class="clear"></div>-->
<!--    </div>-->
<!--</div>-->

<!--<script type="text/javascript" src="<?php echo base_url('assets/js/filereader.js') ?>"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url('assets/js/qrcodelib.js') ?>"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url('assets/js/webcodecamjs.js') ?>"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url('assets/js/main.js') ?>"></script>-->

<script type="text/javascript" src="<?php echo base_url('assets/js/scan.js') ?>"></script>