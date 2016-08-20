	@include('header')

<script>

function cekDoubleEmail() {
document.getElementById("submit").style.visibility = "hidden";
	  $.ajax({
  method: "POST",
  url: "cekdoubleemail",
  data: { email: document.getElementById("email").value }
})
  .done(function( data ) {
    if(data == 0){
			$("#validasi").html("Email dapat digunakan");
			document.getElementById('submit').disabled = false;
			document.getElementById('validasi').style.color = "#ffffff";
		}else{
			$("#validasi").html("Email tidak dapat digunakan");
			document.getElementById('submit').disabled = true;
			document.getElementById('validasi').style.color = "#ff0000";
		}
  });
}
	  
function cekSekolah(){

	$.ajax({
	  method: "POST",
	  url: "ceksekolah",
	  data: { sekolah: document.getElementById("id_sekolah").value }
	})
	
	  .done(function( data ) {
		var datalist = document.getElementById('id_sekolahh');
		while (datalist.hasChildNodes()) {
			datalist.removeChild(datalist.lastChild);
		}
			for (var i = 0; i < data.length; i++) {
				var option = document.createElement('option');
				option.value = data[i]['nama'];
				datalist.appendChild(option);
			}
		});
	cekValidSekolah();
}

function cekValidSekolah(){
document.getElementById("submit").style.visibility = "hidden";
$.ajax({
  method: "POST",
  url: "cekvalidsekolah",
  data: { sekolah: document.getElementById("id_sekolah").value }
})
  .done(function( data ) {
    if(data == 0){
			$("#sekolahbaru").html("Sekolah belum terdaftar, tambahkan terlebih dahulu");
			document.getElementById('div_tambah_sekolah').style.visibility = "visible";
			document.getElementById('sekolahbaru').style.color = "#ff0000";
		}else{
			$("#sekolahbaru").html("");
			document.getElementById('div_tambah_sekolah').style.visibility = "hidden";
			document.getElementById('sekolahbaru').style.color = "#ff0000";
		}
  });
}

function cekValidSekolah1(){
$.ajax({
  method: "POST",
  url: "cekvalidsekolah",
  data: { sekolah: document.getElementById("id_sekolah").value }
})
  .done(function( data ) {
    if(data == 0){
			$("#sekolahbaru").html("Sekolah belum terdaftar, tambahkan terlebih dahulu");
			document.getElementById('div_tambah_sekolah').style.visibility = "visible";
			document.getElementById('sekolahbaru').style.color = "#ff0000";
			document.getElementById('id_sekolah').value = "";
		}else{
			$("#sekolahbaru").html("Sekolah Sudah Terdaftar");
			document.getElementById('div_tambah_sekolah').style.visibility = "hidden";
			document.getElementById('sekolahbaru').style.color = "#ff0000";
		}
  });
}

function cekValidSekolah2(){
$.ajax({
  method: "POST",
  url: "cekvalidsekolah",
  data: { sekolah: document.getElementById("nama_sekolah_baru").value }
})
  .done(function( data ) {
    if(data == 0){
			$("#nama_sekolah_baru_not").html("");
			document.getElementById('tambahkan_sekolah').disabled = false;
		}else{
			$("#nama_sekolah_baru_not").html("Sekolah Sudah Terdaftar");
			document.getElementById('tambahkan_sekolah').disabled = true;
		}
  });
}

function cekValidasiTambahSekolah(){
	var error = 0;
	if(document.getElementById('nama_sekolah_baru').value == ""){
		//document.getElementById('nama_sekolah_baru_not').value = "Nama Sekolah Harus di isi";
		$("#nama_sekolah_baru_not").html("Nama Sekolah Harus di isi");
		error = 1;
	}else{
		$("#nama_sekolah_baru_not").html("");
	}
	
	if(document.getElementById('provinsi_sekolah_baru').value == ""){
		//document.getElementById('provinsi_sekolah_baru_not').value = "Provinsi Harus di isi";
		$("#provinsi_sekolah_baru_not").html("Provinsi Harus di isi");
		error = 1;
	}else{
		$("#provinsi_sekolah_baru_not").html("");
	}
	
	if(document.getElementById('kabupaten_sekolah_baru').value == ""){
		//document.getElementById('kabupaten_sekolah_baru_not').value = "Kabupaten Harus di isi";
		$("#kabupaten_sekolah_baru_not").html("Kabupaten Harus di isi");
		error = 1;
	}else{
		$("#kabupaten_sekolah_baru_not").html("");
	}
	
	if(error == 0){
		$.ajax({
		  method: "POST",
		  url: "tambahkansekolah",
		  data:  "nama=" + document.getElementById("nama_sekolah_baru").value+ "&kabupaten=" + document.getElementById('kabupaten_sekolah_baru').value
		})
		  .done(function( data ) {
			document.getElementById('div_tambah_sekolah').style.visibility = "hidden";
		  });
	}
}

function select_kabupaten(){
	$.ajax({
	  method: "POST",
	  url: "getkabupaten",
	  data: { provinsi: document.getElementById("provinsi_sekolah_baru").value }
	})
	  .done(function( data ) {
			var datalist = document.getElementById('kabupaten_sekolah_baru');
			while (datalist.hasChildNodes()) {
				datalist.removeChild(datalist.lastChild);
			}
			var option = document.createElement('option');
			option.value = "";
			option.text = "Pilih Kabupaten";
			datalist.appendChild(option);
			for (var i = 0; i < data.length; i++) {
				var option = document.createElement('option');
				option.value = data[i]['id_kabupaten'];
				option.text = data[i]['kabupaten'];
				datalist.appendChild(option);
			}
		});
}

function cekerror() {
	document.getElementById("submit").style.visibility = "visible";
	$.ajax({
	  method: "POST",
	  url: "cekdoubleemail",
	  data: { email: document.getElementById("email").value }
	})
	  .done(function( data ) {
		if(data == 0){
			var pass1 = document.getElementById("p1").value;
			var pass2 = document.getElementById("p2").value;
			if (pass1 != pass2) {
				document.getElementById("p1").value = "";
				document.getElementById("p2").value = "";
			}
			else {
				$.ajax({
				  method: "POST",
				  url: "cekvalidsekolah",
				  data: { sekolah: document.getElementById("id_sekolah").value }
				})
				  .done(function( data ) {
					if(data == 0){
							document.getElementById("id_sekolah").value = "";
						}
						else{
							var pass = document.getElementById("p1").value;
							var score = scorePassword(pass);
							if (score > 40){
									
								} else if (score >= 0){
									$("#password_strength").html("Password Lemah");
									document.getElementById("p1").value = "";
									document.getElementById("p2").value = "";
								}
						}
				  })
				  .fail(function() {
					document.getElementById("id_sekolah").value = "";
				  });
			}
		}else{
			document.getElementById("email").value = "";
			$("#validasi").html("Email tidak dapat digunakan");
			document.getElementById('validasi').style.color = "#ff0000";
		}
	  })
	  .fail(function() {
		document.getElementById("email").value = "";
		$("#validasi").html("Email tidak dapat digunakan");
		document.getElementById('validasi').style.color = "#ff0000";
	  });
}

function scorePassword(pass) {
    var score = 0;
    if (!pass)
        return score;

    // award every unique letter until 5 repetitions
    var letters = new Object();
    for (var i=0; i<pass.length; i++) {
        letters[pass[i]] = (letters[pass[i]] || 0) + 1;
        score += 5.0 / letters[pass[i]];
    }

    // bonus points for mixing it up
    var variations = {
        digits: /\d/.test(pass),
        lower: /[a-z]/.test(pass),
        upper: /[A-Z]/.test(pass),
        nonWords: /\W/.test(pass),
    }

    variationCount = 0;
    for (var check in variations) {
        variationCount += (variations[check] == true) ? 1 : 0;
    }
    score += (variationCount - 1) * 10;

    return parseInt(score);
}

function checkPassStrength() {
	var pass = document.getElementById("p1").value;
    var score = scorePassword(pass);
    if (score > 30){
        $("#password_strength").html("");
		} else if (score >= 0){
        $("#password_strength").html("Password Lemah");
		}
	cekValidPassword();
}
</script>

    <!-- LOGIN -->
    <section id="login-content" class="login-content">
        <div class="awe-parallax bg-login-content"></div>
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="row">
    
    
                
                <!-- FORM -->
                <div class="col-lg-4 pull-right">
                    <div class="form-login">
                        {!! Form::open(['url' => 'saveregister','method'=>'POST','files'=>true]) !!}
                            <h2 class="text-uppercase">sign up</h2>
                            <div class="form-fullname">
								<input class ="first-name" name="namadepan" type="text" placeholder="First name" required>
								<input class="last-name" name="namabelakang" type="text" placeholder="Last name">
                            </div>
							<div class="form-email">
							<br>
								<b><div id="validasi" style="color:white"></div></b>
								<input type="email" placeholder="Email" id="email" name="email" required onkeyup="cekDoubleEmail()">
								
                            </div>
							<div class="form-password">
								<input type="password" placeholder="Password" id="p1" name="password" required onkeyup="checkPassStrength()">
								<div id="password_strength" style="color:red">Password Lemah</div>
                            </div>
							<div class="form-password">
								<input type="password" placeholder="Ulang Password" id="p2" name="password2" required  onkeyup="cekValidPassword()">
								<div id="password" style="color:white"></div>
                            </div>
							<br>
							<div class="mc-select">
								<select class="select" name="type" required onchange="cekValidPassword()">
									<option value=''>Pilih Type</option>
									<option value='1'>Siswa</option>
									<option value='2'>Guru</option>
								</select>
							</div>
							<div class="form-password">
								<input id="id_sekolah" name="id_sekolah" list="id_sekolahh" placeholder="Pilih Sekolah" onkeyup="cekSekolah()" required/>
								<b><div id="sekolahbaru" style="color:white"></div></b>
								<datalist id="id_sekolahh">
								</datalist>
                            </div>
							
							<div class="panel panel-default" id="div_tambah_sekolah">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#question-1" onclick="cekValidSekolah1()" id="button_tambah_sekolah">
											Tambahkan Sekolah Baru
										</a>
									</h4>
								</div>
								<div id="question-1" class="panel-collapse collapse">
									<div class="form-password">
										<input type="text" placeholder="Nama Sekolah" id="nama_sekolah_baru" name="nsb" onkeyup="cekValidSekolah2()" >
										<div id="nama_sekolah_baru_not"style="color:red"></div>
									</div>
									<div class="mc-select">
										<select class="select" name="psb" id="provinsi_sekolah_baru" onchange="select_kabupaten()" >
											<option value=''>Pilih Provinsi</option>
<option value='1'>Provinsi Aceh</option><option value='2'>Provinsi Sumatera Utara</option><option value='3'>Provinsi Sumatera Barat</option><option value='4'>Provinsi Jambi</option><option value='5'>Provinsi Riau</option><option value='6'>Provinsi Kepulauan Riau</option><option value='7'>Provinsi Bengkulu</option><option value='8'>Provinsi Sumatera Selatan</option><option value='9'>Provinsi Bangka Belitung</option><option value='10'>Provinsi Lampung</option><option value='11'>Provinsi Banten</option><option value='12'>Provinsi DKI Jakarta</option><option value='13'>Provinsi Jawa Barat</option><option value='14'>Provinsi Jawa Tengah</option><option value='15'>Provinsi DI Yogyakarta</option><option value='16'>Provinsi Jawa Timur</option><option value='17'>Provinsi Bali</option><option value='18'>Provinsi Nusa Tenggara Barat</option><option value='19'>Provinsi Nusa Tenggara Timur</option><option value='20'>Provinsi Kalimantan Barat</option><option value='21'>Provinsi Kalimantan Tengah</option><option value='22'>Provinsi Kalimantan Selatan</option><option value='23'>Provinsi Kalimantan Timur</option><option value='24'>Provinsi Kalimantan Utara</option><option value='25'>Provinsi Sulawesi Utara</option><option value='26'>Provinsi Gorontalo</option><option value='27'>Provinsi Sulawesi Tengah</option><option value='28'>Provinsi Sulawesi Barat</option><option value='29'>Provinsi Sulawesi Selatan</option><option value='30'>Provinsi Sulawesi Tenggara</option><option value='31'>Provinsi Maluku</option><option value='32'>Provinsi Maluku Utara</option><option value='33'>Provinsi Papua Barat</option><option value='34'>Provinsi Papua</option>
										</select>
										<div id="provinsi_sekolah_baru_not" style="color:red"></div>
									</div>
									<div class="mc-select">
										<select class="select" name="ksb" id="kabupaten_sekolah_baru" >
											<option value=''>Pilih Kabupaten</option>
										</select>
										<div id="kabupaten_sekolah_baru_not" style="color:red"></div>
									</div>
									<br>
									<div class="mc-btn">
										<input type="button" value="Tambahkan" id="tambahkan_sekolah" style="color:black" onclick="cekValidasiTambahSekolah()">
									</div>
								</div>
							</div>
							
							
							<br>
                            <div class="mc-select">
								<select class="select" name="id_jenjang" required>
									<option value=''>Pilih Jenjang</option>
									<option value='1'>SD</option>
									<option value='2'>SMP</option>
									<option value='3'>SMA</option>
								</select>
                            </div>
							<div class="choses-file up-file">
                                <input type="file" name="foto" accept="image/*" required>
                                <input type="hidden">
                                <a href="" class="mc-btn btn-style-6">Pilih File</a>
                            </div>
                            <div class="form-submit-1">
                                <input id="button" type="button" value="Periksa lagi" class="mc-btn btn-style-1" onclick="cekerror()">
                            </div>
							<div class="form-submit-1">
                                <input id="submit" type="submit" value="Become a member" class="mc-btn btn-style-1" style="visibility:hidden;">
                            </div>
                            <div class="link">
                                <a href="login">
                                    <i class="icon md-arrow-right"></i>Already have account ? Log in
                                </a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- END / FORM -->
    
                <div class="image">
                    <img src="images/homeslider/img-thumb.png" alt="">
                </div>
    
            </div>
        </div>
    </section>
    <!-- END / LOGIN -->
  
<script>
function cekValidPassword() {
	cekDoubleEmail();
    var pass1 = document.getElementById("p1").value;
    var pass2 = document.getElementById("p2").value;
    if (pass1 != pass2) {
        document.getElementById('submit').disabled = true;
		$("#password").html("Password tidak sama");
		document.getElementById('password').style.color = "#ff0000";
    }
    else {
        document.getElementById('submit').disabled = false;
		$("#password").html("");
    }
}



</script>

	@include('footer')