	@include('header')
	<section class="sub-banner section">
        <div class="awe-parallax bg-profile-feature"></div>
        <div class="awe-overlay overlay-color-3"></div>
        <div class="container">
            <div class="sub-banner-content">
                <h2 class="big">This is banner for promoted course</h2>
                <p>this is not only an elegant theme but also a course management system for wordpress and drupal</p>
                <a href="#" class="mc-btn btn-style-3">See course</a>
            </div>
        </div>
    </section>
    <!-- COURSE -->
		<script src="ckeditor/ckeditor.js"></script>
    <section class="course-top">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="sidebar-course-intro">
                        <div class="breadcrumb">
                            <a href="">Home</a> / 
                            <a href="">Course</a> / 
                            Home Fitntess training
                        </div>
						@forelse($data['question'] as $key => $value)
                        <div class="widget widget_share">
							
                            <i class="icon fa fa-question-circle"></i>
							<h4 class="xsm black bold">Detail Pertanyaan</h4>
							
							<h4 class="sm black">
								<a href="">by : {{ $value->nama }}</a>
							</h4>			
							<em class="black">{{ $value->timestamp }}</em>
							<div class="share-body">
                                   
										{!! $value->soal !!}
									
                            </div>
							
                        </div>
						@empty
						<p>Tidak ada data</p>
						@endforelse
                        <hr class="line">
                        <!--<div class="widget widget_share">
                            <i class="icon md-forward"></i>
                            <h4 class="xsm black bold">Bagikan Pertanyaan Ini</h4>
                            <div class="share-body">
                                <a href="#" class="twitter" title="twitter">
                                    <i class="icon md-twitter"></i>
                                </a>
                                <a href="#" class="pinterest" title="pinterest">
                                    <i class="icon md-pinterest-1"></i>
                                </a>
                                <a href="#" class="facebook" title="facebook">
                                    <i class="icon md-facebook-1"></i>
                                </a>
                                <a href="#" class="google-plus" title="google plus">
                                    <i class="icon md-google-plus"></i>
                                </a>
                            </div>
                        </div>-->
                    </div>
                </div>    
                <div class="col-md-7">
                    <div class="tabs-page">
                        <!-- Tab panes -->
                        <div class="tab-content">    
                            <!-- COMMENT -->
                            <div class="tab-pane fade in active" id="conment">
                                <ul class="commentlist">
								<!-- bapak -->
								@if(count($data['jawabanSoal']) > 0 )
								@forelse($data['jawabanSoal'] as $key => $value)
                                    <li class="comment">
                                        <div class="comment-body">
                                            <div class="comment-author">
                                                <a href="#">
                                                    <img src="images/team-13.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="comment-content">
                                                <cite class="fn sm black bold"><a href="">{{ $value->nama }}</a></cite>
												<br>
                                                <p>{!!$value->jawaban!!}</p>
                                                <br>
                                                <div class="comment-meta">
                                                   <a href="#">{{ $value->timestamp }}</a>
                                                   <a onclick="showHide('{{ $value->id_jawaban }}')">Show/Hide {{ count($value->jawabannya) }} reply</a>
                                                </div>
    
                                            </div>
                                        </div>
										<!--anak -->
										
                                        <ul class="children" id="{{ $value->id_jawaban }}">
										
											@if(count($value->jawabannya) > 0)
											@forelse($value->jawabannya as $key2=> $jawabannya)
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <div class="comment-author">
                                                        <a href="#">
                                                            <img src="images/team-13.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="comment-content">
                                                        <cite class="fn sm black bold"><a href="">{{ $jawabannya->nama }}</a></cite>
														<br>
                                                        <p>{!!$jawabannya->jawaban !!}</p>
                                                        <br>
                                                        <div class="comment-meta">
                                                            <a href="#">{!!$jawabannya->timestamp !!}</a>
                                                        </div>
    
                                                    </div>
                                                </div>
                                            </li>
											@empty
											<p>Tidak ada data</p>
											@endforelse	
											@endif
											<li class="comment">
                                                <div class="comment-body">
													<div id="respond">
														{!! Form::open(['url' => 'savejawaban','method'=>'POST','files'=>true]) !!}
															<p><b>Masukkan jawaban disini</b></p>
															<br>
															<div class="post-editor text-form-editor">
																<textarea name="jawabanjawaban{{ $value->id_jawaban }}" id="jawabanjawaban{{ $value->id_jawaban }}" rows="25" cols="50" required></textarea>
															</div>
															<div class="form-submit">
																<input type="submit" value="Post" class="mc-btn-2 btn-style-2">
															</div>
															<input type="hidden" name="tipejawaban" value = "0">
															<input type="hidden" name="id_jawaban" value = "{{ $value->id_jawaban }}">
															<input type="hidden" name="id_soal" value = "{{ $data['id_soal'] }}">
														{!! Form::close() !!}
													</div>
												</div>
											</li>
											<script>
											CKEDITOR.replace('jawabanjawaban{{ $value->id_jawaban }}', {
											  "filebrowserImageUploadUrl": "ckeditor/plugins/imgupload/iaupload.php",
											  extraPlugins: 'enterkey',
											  enterMode: 2,
											  shiftEnterMode: 1
											});
											</script>
                                        </ul>
                                    </li>
									@empty
									<p>Tidak ada data</p>
									@endforelse	
									@endif
									<!-- end bapak -->
                                    <li class="comment">
                                        <div class="comment-body">
											<div id="respond">
												{!! Form::open(['url' => 'savejawaban','method'=>'POST','files'=>true]) !!}
												<p><b>Masukkan jawaban disini</b></p>
															<br>
													<div class="post-editor text-form-editor">
														<textarea name="jawabansoal{{ $data['id_soal'] }}" id="jawabansoal{{ $data['id_soal'] }}" rows="25" cols="50"  required></textarea>
													</div>
													<div class="form-submit">
														<input type="submit" value="Post" class="mc-btn-2 btn-style-2">
													</div>
													<input type="hidden" name="tipejawaban" value = "1">
													<input type="hidden" name="id_jawaban" value = "{{ $data['id_soal'] }}">
													<input type="hidden" name="id_soal" value = "{{ $data['id_soal'] }}">
												{!! Form::close() !!}
											</div>
										</div>
									</li>
                                </ul>
                            </div>
                            <!-- END / COMMENT -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<script>
	function showHide(id) {
		$( "#" + id ).toggle( "fast" );
	}
	
	CKEDITOR.replace("jawabansoal{{ $data['id_soal'] }}", {
	  "filebrowserImageUploadUrl": "ckeditor/plugins/imgupload/iaupload.php",
	  extraPlugins: 'enterkey',
	  enterMode: 2,
	  shiftEnterMode: 1
	});
	
		
	</script>
    <!-- END / COURSE TOP -->    
    @include('footer')