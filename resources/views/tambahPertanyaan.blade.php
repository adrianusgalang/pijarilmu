	@include('header')

    <!-- SUB BANNER -->
    <section class="sub-banner sub-banner-course">
        <div class="awe-static bg-sub-banner-course"></div>
        <div class="container">
            <div class="sub-banner-content">
                <h2 class="text-center">Tambah Pertanyaan</h2>
            </div>
        </div>
    </section>
    <!-- END / SUB BANNER -->


    <!-- COURSE -->
    <section class="course-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sidebar-course-intro">
                        <div class="breadcrumb">
                            <a href="home">Halaman Utama</a> > 
                            <a href="daftarpertanyaan">Pertanyaan</a> > 
                            Tambah Pertanyaan
                        </div>   
                    </div>
					<div class="form-discussion">
					{!! Form::open(['url' => 'savequestion','method'=>'POST','files'=>true]) !!}
						<div class="form-question mc-select">
							<select class="select" id="jenjang" onchange="selectMapel()" required>
								<option value="">Pilih Jenjang</option>
							@forelse($data['jenjang'] as $key => $value)
								<option value="{{ $value->id_jenjang }}">{{ $value->jenjang }}</option>
							@empty
								<p>Tidak ada data</p>
							@endforelse
							</select>
						</div>
						<div class="form-question mc-select">
							<select class="select" id="mapel" onchange="selectBab()" required>
								<option value="">Pilih Mata Pelajaran</option>
							</select>
						</div>
						<div class="form-question mc-select">
							<select class="select" id="bab" name="bab" required>
								<option value="">Pilih Bab</option>
							</select>
						</div>
						<div class="post-editor text-form-editor">
							<textarea name="pertanyaan" id="pertanyaan" rows="25" cols="50" required>
								Masukkan pertanyaan disini
							</textarea>
						</div>
                        <div class="form-submit">
							<input type="submit" value="Simpan Pertanyaan" class="mc-btn-2 btn-style-2">
						</div>
					{!! Form::close() !!}
					</div>
                </div>    
            </div>
        </div>
    </section>
    <!-- END / COURSE TOP -->
	
	<script src="ckeditor/ckeditor.js"></script>
	
	<script>
		CKEDITOR.replace('pertanyaan', {
		  "filebrowserImageUploadUrl": "ckeditor/plugins/imgupload/iaupload.php",
		  extraPlugins: 'enterkey',
		  enterMode: 2,
		  shiftEnterMode: 1
		});
	
		function selectMapel() {
			$.ajax({
			  method: "POST",
			  url: "getmapelbyjenjang",
			  data: { jenjang: document.getElementById("jenjang").value }
			})
			.done(function( data ) {
				var select = document.getElementById('mapel');
				while (select.hasChildNodes()) {
					select.removeChild(select.lastChild);
				}
				var option = document.createElement('option');
				option.value = "";
				option.text = "Pilih Mata Pelajaran";
				select.appendChild(option);
				for (var i = 0; i < data.length; i++) {
					var option = document.createElement('option');
					option.value = data[i]['id_mapel'];
					option.text = data[i]['mapel'];
					select.appendChild(option);
				}
			});
		}
		
		function selectBab() {
			$.ajax({
			  method: "POST",
			  url: "getbabbymapel",
			  data: { mapel: document.getElementById("mapel").value }
			})
			.done(function( data ) {
				var select = document.getElementById('bab');
				while (select.hasChildNodes()) {
					select.removeChild(select.lastChild);
				}
				var option = document.createElement('option');
				option.value = "";
				option.text = "Pilih Bab";
				select.appendChild(option);
				for (var i = 0; i < data.length; i++) {
					var option = document.createElement('option');
					option.value = data[i]['id_bab'];
					option.text = data[i]['bab'];
					select.appendChild(option);
				}
			});
		}
	</script>
        
    @include('footer')