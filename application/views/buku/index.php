<div id="buku">
	<div id="delay-alert">
		<?php  
			echo $this->session->flashdata('add_success');
			echo $this->session->flashdata('update_success');
			echo $this->session->flashdata('delete_success');
		?>
	</div>
	<div class="panel panel-info">
		<div class="panel-body">
			<div class="well well-sm">
				<a href="<?php echo site_url('buku/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
			</div>
			<div class="table-responsive">
				<div class="panel panel-warning">
					<div class="panel-body">
						<form action="<?php echo site_url('buku/cariData') ?>" method="post">	
						<div class="col-sm-4 pull-right">
							<div class="form-group pull-right">
							  <div class="input-group">
							    <input type="text" class="form-control" placeholder="cari berdasarkan judul / kode">
							    <span class="input-group-btn">
							      <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
							    </span>
							  </div>
							</div>
						</div>
						</form>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Cover</th>
									<th>Kode Buku</th>
									<th>Judul</th>
									<th>Penerbit</th>
									<th>Pengarang</th>
									<th>Deskripsi</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($buku as $b): ?>
									<tr>
										<td>
											<?php 
											    $image = $this->custom->cek_foto($b->cover);

												echo '<img src="'.$image.'" alt="" width="100" height="150">';
											?>
										</td>
										<td><?php echo $b->kd_buku ?></td>
										<td>
											<?php echo $b->judul ?><br>
											<a href="<?php echo site_url('buku/edit/'.$b->kd_buku) ?>">Edit</a>&nbsp;|&nbsp;
											<a href="#" class="hapus" kode="<?php echo $b->kd_buku ?>">Hapus</a>&nbsp;|&nbsp;
											<a href="#" class="qrcode" kode="<?php echo $b->kd_buku ?>" judul="<?= $b->judul ?>">QRCode</a>
										</td>
										<td><?php echo $b->penerbit ?></td>
										<td><?php echo $b->pengarang ?></td>
										<td width="300"><?php echo $b->deskripsi ?></td>
										<td>
											<?php  
												
												$status;

												if ($b->status == "y") {
													$status = "Tersedia";
												}
												elseif ($b->status == "n") {
													$status = "Tidak tersedia / sedang di pinjam";
												}

												echo $status;
											?>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="paging">
					<?php echo $paging ?>
				</div>
			</div>			
			</div>
		</div>
</div>

<div class="modal fade" id="modal-qrcode">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<p>QRCode - <span class="bookcode"></span></p>
			</div>
			<div class="modal-body">
			    <img src="<?= base_url('assets/img/mini-logo.png') ?>" height="50px" style="display: none" id="library-logo">
				<center>
				    <canvas id="qrCanvas" width="200" height="250" style="border:1px solid #000000;"></canvas>
				</center>
			</div>
			<div class="modal-footer">
				<a href="javascript:void(0)" class="btn btn-success" id="downloadQR">Download</a>
				<a href="javascript:void(0)" class="btn btn-primary" id="printQR">Cetak</a>
				<button class="btn btn-info" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script>
    $(function(){
		//delay alert
		$('#delay-alert').delay(2000).fadeOut(2000);

		//delete buku
		$('.hapus').click(function(){
			var kode = $(this).attr('kode');
			$('#idhapus').val(kode);
			$('#modal-delete').modal('show');
		});
		
		//qrcode buku
		$('.qrcode').click(function(){
			var kode   = $(this).attr('kode');
			var judul  = $(this).attr('judul');
			var judul1 = judul;
			var judul2 = '';
			var judul3 = '';
			var qrCode = kode + ";";
			var img    = document.getElementById('library-logo');
			var c      = document.getElementById('qrCanvas');
            var ctx    = c.getContext("2d");
            ctx.clearRect(0, 0, c.width, c.height);
            ctx.fillStyle = "white";
            ctx.fillRect(0, 0, c.width, c.height);
            
            ctx.rect(0, 0, 200, 250);
            ctx.stroke();
            
            if (judul.length >= 20){
              judul1   = judul.substring(0, judul.indexOf(' ', 15));
              judul2   = judul.substring(judul.indexOf(' ', 15), judul.indexOf(' ', 30));
              
              if(judul.length >= 40){
                judul3 = judul.substring(judul.indexOf(' ', 30), judul.indexOf(' ', 45));    
              }
              
              if(judul.length >= 55){
                judul3 = judul3 + "...";
              }
            }
            
			$('.bookcode').html(kode);
            
            ctx.drawImage(img,150,200, 40, 40);
            
            ctx.font = "bold 12px Arial";
            ctx.textAlign = 'left';
            ctx.fillStyle = 'black';
            ctx.fillText(judul1.trim(),10,210);
            ctx.fillText(judul2.trim(),10,225);
            ctx.fillText(judul3.trim(),10,240);
			
			$('#qrCanvas').qrcode({
                text    : kode,
                size    : 180,
                top     : 10,
                left    : 10,
            });
            
			$('#modal-qrcode').modal('show');
		});
		
		$('#downloadQR').click(function () {
            var kode = $('.bookcode').html();
            
            // var canvas = document.getElementById("qrCanvas");
            // var img    = canvas.toDataURL("image/png");
            // document.write('<img src="'+img+'"/>');

            downloadCanvas(this, "qrCanvas", kode);
        });
    
        $('#printQR').click(function (){
            var kode = $('.bookcode').html();
            var prcanvas  = document.getElementById('qrCanvas').toDataURL();
            
            var windownya = '<!DOCTYPE html>';
            windownya += '<html>';
            windownya += '<head><title>Buku - ' + kode + ' </title></head>';
            windownya += '<body>';
            windownya += '<img src="' + prcanvas + '" >';
            windownya += '</body>';
            windownya += '</html>';
    
            var bukawindow = window.open('','','width=600,height=400');
            bukawindow.document.open();
            bukawindow.document.write(windownya);
            bukawindow.document.close();
            bukawindow.focus();
            bukawindow.print();
            bukawindow.close();
        });

		$('#konfirmasi').click(function(){
			var kode = $("#idhapus").val();

			$.ajax({
				url  : "<?php echo site_url('buku/hapus') ?>",
				type : "POST",
				data : "id_hapus="+kode,
				success : function(html){
					location.reload();
				} 
			});
		});
	})
	
	function downloadCanvas(link, canvasId, filename) {
        link.href = document.getElementById(canvasId).toDataURL();
        link.download = filename;
    }

</script>