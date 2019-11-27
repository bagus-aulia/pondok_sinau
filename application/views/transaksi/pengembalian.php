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
<!-- Jquery ajx -->
<script>
	
	$(function(){
		//cari data peminjaman
		$("#cari").click(function(){
			var id = $("#id_anggota").val();

			if(id == "")
			{
				swal("Peringatan!!", "ID tidak boleh kosong", "error");
			}
			else
			{
				$.ajax({
					url : "<?php echo site_url('pengembalian/cariData') ?>",
					type : "POST",
					data : "id_anggota="+id,
					beforeSend : function(){
						$("#alert-loading").html('<div class="alert alert-info"><i class="fa fa-spinner fa-spin"></i> Sedang mengambil data ... </div>');
					},
					success : function(msg){
						if (msg == "") {
							swal("Info", "ID Anggota tidak ada dalam transaksi peminjaman", "error");
							$("#tampil_data").html("");
						}
						else
						{
							$("#tampil_data").html(msg);		
						}
					}
				})
			}
		});	

		
	})

</script>
<div id="pengembalian">
	<div class="panel panel-primary">
		<div class="panel-heading">
			Pengembalian Buku
		</div>
		<div class="panel-body">
			<div id="anggota">
				<div class="row">
					<div class="col-md-12">
						<input type="text" id="return_qr_buku" name="kd_buku" class="form-control" placeholder="Taruh kursor disini sebelum menye-scan qr code">
						<input type="hidden" id="site_url" value="<?= base_url() ?>">
					</div>
					<!--<div class="col-md-3">-->
					<!--	<input type="text" id="id_anggota" class="form-control" placeholder="Masukan ID Anggota">-->
					<!--</div>-->
					<!--<div class="col-md-2">-->
					<!--	<p class="btn btn-primary" id="cari"><i class="fa fa-search"></i></p>-->
					<!--</div>					-->
				</div>
			</div>
			<div class="tampil">
				<div id="tampil_data"></div>
			</div>
		</div>
	</div>
</div>

<!--<div class="qr-box">
    <div style="text-align: center; padding-bottom: 10px;">Scan Book QR CODE</div>
    <input type="hidden" id="site_url" value="<?= base_url() ?>">
    <div id="qr-area" style="position: relative;">
        <div id="scanner-laser-area">
            <canvas id="qr-canvas"></canvas>
            <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
            <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
            <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
            <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>-->

<!--<script type="text/javascript" src="<?php echo base_url('assets/js/filereader.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/qrcodelib.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/webcodecamjs-back.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/main.js') ?>"></script>
-->

<script type="text/javascript" src="<?php echo base_url('assets/js/scan.js') ?>"></script>