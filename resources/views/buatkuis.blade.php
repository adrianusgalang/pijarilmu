@include('header')

<script>
function getMapel(){
	$.ajax({
	  method: "POST",
	  url: "getmapelbyjenjang",
	  data: { jenjang: document.getElementById("id_jenjang").value }
	})
	  .done(function( data ) {
			var datalist = document.getElementById('mata_pelajaran');
			while (datalist.hasChildNodes()) {
				datalist.removeChild(datalist.lastChild);
			}
			var option = document.createElement('option');
			option.value = "";
			option.text = "Pilih Mata Pelajaran";
			datalist.appendChild(option);
			for (var i = 0; i < data.length; i++) {
				var option = document.createElement('option');
				option.value = data[i]['id_mapel'];
				option.text = data[i]['mapel'];
				datalist.appendChild(option);
			}
		});
}

function getBab(){
	$.ajax({
	  method: "POST",
	  url: "getbabbymapel",
	  data: { mapel: document.getElementById("mata_pelajaran").value }
	})
	  .done(function( data ) {
			var datalist = document.getElementById('bab');
			while (datalist.hasChildNodes()) {
				datalist.removeChild(datalist.lastChild);
			}
			var option = document.createElement('option');
			option.value = "";
			option.text = "Pilih BAB";
			datalist.appendChild(option);
			for (var i = 0; i < data.length; i++) {
				var option = document.createElement('option');
				option.value = data[i]['id_bab'];
				option.text = data[i]['bab'];
				datalist.appendChild(option);
			}
		});
}
</script>

<section class="sub-banner sub-banner-create-course">
        <div class="awe-parallax bg-profile-feature"></div>
        <div class="awe-overlay overlay-color-3"></div>
        <div class="container">
            <h2 class="md ilbl">Buat Kuis</h2>
        </div>
    </section>
    <!-- END / BANNER CREATE COURSE -->

    <!-- CREATE COURSE CONTENT -->
    <section id="create-course-section" class="create-course-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="create-course-sidebar">
                        <ul class="list-bar">
                            <li class="active"><span class="count">1</span>Informasi Kuis</li>
                            <li><span class="count">2</span>Soal</li>
                            <li><span class="count">3</span>Aturan Kuis</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="create-course-content">
						{!! Form::open(['url' => 'savebuatkuis','method'=>'POST']) !!}
                        <div class="tab-content">
                            <!-- DESIGN OUTLINE -->
                            <div class="tab-pane fade in active" id="design-outline">

                                <!-- SECTIONS -->
                                <div class="dc-sections">
                                    <!-- DC SECTION INFO -->
                                    <div class="dc-section-info">
									
										<div class="title-section">
                                            <h4 class="xsm">Informasi Kuis</h4>
                                        </div>
                                        <!-- DC SECTION BODY -->
                                        <div class="dc-section-body">

                                            <!-- DC UNIT -->
                                            <div class="dc-unit-info dc-course-item">
                                                <div class="dc-content-title">
                                                    <h5 class="xsm black">Detail Kuis</h5>
                                                    
                                                </div>

                                                <div class="unit-body dc-item-body">
                                                    <table class="tb-course">
                                                        <tbody>
                                                            <tr class="tb-unit-title">
                                                                <td class="label-info">
                                                                    <label for="">Nama Kuis</label>
                                                                </td>
                                                                <td class="td-form-item">
                                                                    <div class="form-item">
                                                                        <input type="text" name="nama_kuis" required>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr class="tb-desc">
                                                                <td class="label-info">
                                                                    <label for="">Deskripsi</label>
                                                                </td>
                                                                <td class="td-form-item">
                                                                    <div class="form-textarea-wrapper">
                                                                        <textarea name="deskripsi" required></textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>
															
															<tr class="tb-unit-title">
                                                                <td class="label-info">
                                                                    <label for="">Jenjang</label>
                                                                </td>
																<td>
                                                                <div class="mc-select">
																	<select class="select" id="id_jenjang" name="jenjang" required onchange="getMapel()">
																		<option value=''>Pilih Jenjang</option>
																		<option value='1'>Sekolah Dasar</option>
																		<option value='2'>SMP</option>
																		<option value='3'>SMA</option>
																		<option value='4'>Umum</option>
																	</select>
																</div>
																</td>
                                                            </tr>
															
															<tr class="tb-unit-title">
                                                                <td class="label-info">
                                                                    <label for="">Mata Pelajaran</label>
                                                                </td>
                                                                <td>
                                                                    <div class="mc-select">
																		<select class="select" name="mapel" id="mata_pelajaran" required onchange="getBab()" >
																			<option value=''>Pilih Mata Pelajaran</option>
																		</select>
																	</div>
                                                                </td>
                                                            </tr>

															<tr class="tb-unit-title">
                                                                <td class="label-info">
                                                                    <label for="">Bab</label>
                                                                </td>
                                                                <td>
                                                                    <div class="mc-select">
																		<select class="select" name="bab" id="bab" required >
																			<option value=''>Pilih BAB</option>
																		</select>
																	</div>
                                                                </td>
                                                            </tr>
                                                            
															<tr class="tb-unit-title">
                                                                <td class="label-info">
                                                                    <label for="">Banyak Soal</label>
                                                                </td>
                                                                <td class="td-form-item">
                                                                    <div class="form-item">
                                                                        <input type="text" name="banyak_soal" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                                    </div>
                                                                </td>
                                                            </tr>
															
															<tr class="tb-unit-title">
                                                                <td class="label-info">
                                                                    <label for="">Waktu</label>
                                                                </td>
                                                                <td class="td-form-item">
                                                                    <div class="form-item">
                                                                        <input type="text" name="waktu" placeholder="menit" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                                    </div>
                                                                </td>
                                                            </tr>
															
															<tr>
																<td>
																<div class="form-submit-1">
																	<input id="submit" type="submit" value="Lanjutkan" class="mc-btn btn-style-1">
																</div>
																</td>
															</tr>
                                                        </tbody>
                                                    </table>
                                                    
                                                </div>
                                            </div>
                                            <!-- END / DC UNIT -->
											


                                        </div>
                                        <!-- END / DC SECTION BODY -->

                                    </div>
                                    <!-- END / DC SECTION INFO -->

                                    <!-- BUTTON ADD AND POPUP SECTION -->
                                    
                                </div>
                                <!-- END / SECTIONS -->

                                <!-- END / ADD QUESTION POPUP -->
                                
                                
                            </div>
                            <!-- END / DESIGN OUTLINE -->    
    
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / CREATE COURSE CONTENT -->
@include('footer')