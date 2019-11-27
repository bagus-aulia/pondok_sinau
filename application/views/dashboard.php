<div id="dashboard">
	<div class="jumbotron">
		<div class="container">
			<h2><strong>Hai, Anda berhasil login sebagai <?= $this->session->userdata('level') == '1' ? "Admin" : "Pustakawan" ?></strong></h2>
			<p>Selamat Datang di Taman Baca Masyarakat Pondok Sinau Lentera Anak Nusantara</p>
			<blockquote>
				<p> <small>Pilih menu diatas untuk mulai mengelola data perpustakaan</small></p>
			</blockquote>
		</div>
	</div>
	<h2></h2>
	<h3></h3>

</div>