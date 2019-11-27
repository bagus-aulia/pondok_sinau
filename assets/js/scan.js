$(document).ready(function(){
    $('#qr_buku').on("input", function() {
        var base = $("#site_url").val();

        $.ajax({
			url : base + "peminjaman/addBook",
			type : "POST",
			data : "kd_buku=" + $('#qr_buku').val(),
			success : function(msg){
				if(msg == "not_found"){
				    alert("Buku tidak terdaftar!");
				}else if(msg == "borrowed"){
				    alert("Buku tidak tersedia atau masih dipinjam.");
				}else{
				    $("#tampilbuku").load(base + 'peminjaman/tampilBuku');
				}
				
				$('#qr_buku').val("");
			}
		}); 
    });
    
    $('#return_qr_buku').on("input", function() {
        var base = $("#site_url").val();
        var kd_buku = $('#return_qr_buku').val();

		$.ajax({
			url : base + "pengembalian/searchTrans",
			type : "POST",
			data : {kd_buku},
			beforeSend : function(){
				$("#alert-loading").html('<div class="alert alert-info"><i class="fa fa-spinner fa-spin"></i> Sedang mengambil data ... </div>');
			},
			success : function(msg){
				if (msg == "") {
		            alert("Buku tidak ada dalam transaksi peminjaman");
					$("#tampil_data").html("");
				}
				else
				{
					$("#tampil_data").html(msg);		
				}
				
				$('#return_qr_buku').val("");
			},
			error : function(err){
			    alert("popo");
			    alert(err.responseText);
			}
		});
    });
})