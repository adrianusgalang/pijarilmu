	@include('header')
	
	<script>
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
	</script>
	
    <!-- PROFILE FEATURE -->
    <section class="profile-feature">
        <div class="awe-parallax bg-profile-feature"></div>
        <div class="awe-overlay overlay-color-3"></div>
        <div class="container">
            <div class="info-author">
			@forelse($data['user'] as $key => $value)
                <div class="image">
                    <img src="images/catalog/{{ $value->foto }}" alt="">
                </div>    
                <div class="name-author">
                    <h2 class="big">{{ $value->nama }}</h2>
                </div> 
			@empty
				<p>Tidak ada data</p>
			@endforelse
            </div>
        </div>
    </section>
    <!-- END / PROFILE FEATURE -->

    <!-- PROFILE -->
    <section class="profile">
        <div class="container">
            <h3 class="md black">Edit Profile</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="avatar-acount">
					@forelse($data['user'] as $key => $value)
					{!! Form::open(['url' => 'edituser','method'=>'POST','files'=>true]) !!}
                        <div class="changes-avatar">
                            <div class="img-acount">
                                <img src="images/catalog/{{ $value->foto}}" alt="">
                            </div>
                            <div class="choses-file up-file">
                                <input type="file" name="foto" accept="image/*">
                                <input type="hidden" name="photoName">
                                <a href="" class="mc-btn btn-style-6">Changes image</a>
                            </div>
                        </div>   
                        <div class="info-acount">
                            <div class="security">
                                <div class="tittle-security">
									<h5>Nama</h5>
									<input type="text" name="nama" value="{{ $value->nama }}" required>
									<h5>Tentang Saya</h5>
									<input type="text" name="about" value="{{ $value->about }}" required>
                                    <h5>Password</h5>
                                    <input type="password" placeholder="Current password" required onkeyup="checkCurrentPassword()" id="currentPasswordField">
									<b><div id="currentPassword"></div></b>
                                    <input type="password" name="password" placeholder="New password" required id="password1" onkeyup="checkPassStrength()">
									<b><div id="password_strength" style="color:red; visibility:hidden">Password Lemah</div></b>
                                    <input type="password" placeholder="Confirm password" required id="password2" onkeyup="checkSamePassword()">
									<b><div id="samePassword"></div></b>
									<h5>Jenjang</h5>
									<div class="mc-select">
										<select class="select" name="id_jenjang" required>
											<option value='1' @if($value->id_jenjang == 1) {{ "selected" }} @endif >SD</option>
											<option value='2' @if($value->id_jenjang == 2) {{ "selected" }} @endif >SMP</option>
											<option value='3' @if($value->id_jenjang == 3) {{ "selected" }} @endif >SMA</option>
										</select>
									</div>
									<h5>Sekolah</h5>
									<input id="id_sekolah" name="id_sekolah" list="id_sekolahh" placeholder="Pilih Sekolah" onkeyup="cekSekolah()" value="{{ $value->namaSekolah }}">
									<b><div id="sekolahbaru" style="color:black"></div></b>
									<datalist id="id_sekolahh">
									</datalist>
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
									<input id="button" type="button" value="Periksa lagi" class="mc-btn btn-style-1" onclick="cekError()">
                                </div>
                            </div>
                        </div>
                        <div class="input-save">   
                            <input type="submit" value="Save changes" class="mc-btn btn-style-1" style="visibility:hidden" id="submit">
                        </div>
					{!! Form::close() !!}
					@empty
						<p>Tidak ada data</p>
					@endforelse
                    </div>    
                </div>
            </div>
        </div>
    </section>
    <!-- END / PROFILE -->
	
	<script>	
		function checkCurrentPassword() {
			$.ajax({
			  method: "POST",
			  url: "cekpassword",
			  data: { password: document.getElementById("currentPasswordField").value }
			})
		    .done(function( data ) {
				if(data == 0){
					$("#currentPassword").html("Password salah");
					document.getElementById('submit').disabled = false;
					document.getElementById('currentPassword').style.color = "#ff0000";
				}else{
					$("#currentPassword").html("Password benar");
					document.getElementById('submit').disabled = true;
					document.getElementById('currentPassword').style.color = "#000000";
				}
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
			var pass = document.getElementById("password1").value;
			var score = scorePassword(pass);
			if (score > 30) {
				document.getElementById('submit').disabled = false;
				document.getElementById('password_strength').style.visibility = "hidden";
			} else if (score >= 0) {
				document.getElementById('submit').disabled = true;
				document.getElementById('password_strength').style.visibility = "visible";
			}
		}
	
		function checkSamePassword() {
			var pass1 = document.getElementById("password1").value;
			var pass2 = document.getElementById("password2").value;
			if (pass1 != pass2) {
				document.getElementById('submit').disabled = true;
				$("#samePassword").html("Password tidak sama");
				document.getElementById('samePassword').style.color = "#ff0000";
			}
			else {
				document.getElementById('submit').disabled = false;
				$("#samePassword").html("Password sama");
				document.getElementById('samePassword').style.color = "#000000";
			}
		}
		
		function cekError() {
			document.getElementById("submit").style.visibility = "visible";
			$.ajax({
			  method: "POST",
			  url: "cekpassword",
			  data: { password: document.getElementById("currentPasswordField").value }
			})
		    .done(function( data ) {
				if(data == 0){
					$("#currentPassword").html("Password salah");
					document.getElementById('submit').disabled = false;
					document.getElementById('currentPassword').style.color = "#ff0000";
				}else{
					$("#currentPassword").html("Password benar");
					document.getElementById('submit').disabled = true;
					document.getElementById('currentPassword').style.color = "#000000";
					var pass = document.getElementById("password1").value;
					var score = scorePassword(pass);
					if (score > 30) {
						document.getElementById('submit').disabled = false;
						document.getElementById('password_strength').style.visibility = "hidden";
						var pass1 = document.getElementById("password1").value;
						var pass2 = document.getElementById("password2").value;
						if (pass1 != pass2) {
							document.getElementById('submit').disabled = true;
							$("#samePassword").html("Password tidak sama");
							document.getElementById('samePassword').style.color = "#ff0000";
						}
						else {
							document.getElementById('submit').disabled = false;
							$("#samePassword").html("Password sama");
							document.getElementById('samePassword').style.color = "#000000";
						}
					} else if (score >= 0) {
						document.getElementById('submit').disabled = true;
						document.getElementById('password_strength').style.visibility = "visible";
					}
				}
			});
		}
	</script>

	@include('footer')