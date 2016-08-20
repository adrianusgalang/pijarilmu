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
	
	<!-- AFTER SLIDER -->
    <section id="after-slider" class="after-slider section">
        <div class="awe-color bg-color-1"></div>
        <div class="after-slider-bg-2"></div>
        <div class="container">
    
            <div class="after-slider-content tb">
                <div class="inner tb-cell">
                    <h4>Cari kategori </h4>
                    <div class="course-keyword">
                        <input style="width:230%"type="text" placeholder="Cari kategori">
                    </div>
                </div>
				@if(isset($data['id_user']))
                <div class="tb-cell text-right">
                    <div class="form-actions">
                        <a href="tambahpertanyaan" class="mc-btn btn-style-1">Buat Pertanyaan</a>
                    </div>
                </div>
				@endif
            </div>
    
        </div>
    </section>
    <!-- END / AFTER SLIDER -->
	
    <!-- COURSE -->
    <section class="course-top">
        <div class="container">
            <div class="row">    
                <div class="col-md-12">
                    <div class="tabs-page">				
						<div class="breadcrumb">
							<a href="home">Halaman Utama</a> > 
                            <a href="daftarpertanyaan">Pertanyaan</a> > 
                            Daftar Pertanyaan
						</div>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- REVIEW -->
                            <div class="tab-pane fade in active" id="review"> 
                                <ul class="list-review">
								@forelse($data['question'] as $key => $value)
                                    <li class="review">
                                        <div class="body-review">
                                            <div class="review-author">
                                                <a href="#">
                                                    <img src="images/catalog/{{ $value->foto }}" alt="">
                                                    <i class="icon md-email"></i>
                                                    <i class="icon md-user-plus"></i>
                                                </a>
                                            </div>
                                            <div class="content-review">
                                                <h4 class="sm black">
                                                    <a href="">{{ $value->nama }}</a>
                                                </h4>
                                                <div class="rating">
											@for ($i = 1; $i <= 5; $i++) {
												@if($i <= $value->bintang)
                                                    <a href="" class="active"></a>
												@else
                                                    <a href=""></a>										
												@endif
											@endfor
                                                </div>
                                                <em>{{ $value->timestamp }}</em>
												<p>{!! $value->soal !!}</p>
												<br>
											@if(isset($data['id_user']))
												<a href="viewpertanyaan?q={{ $value->id_soal }}" class="mc-btn-3 btn-style-2">Reply</a>
											@else
												<a href="viewpertanyaan?q={{ $value->id_soal }}" class="mc-btn-3 btn-style-2">Detail</a>
											@endif
												<a class="mc-btn-1 btn-style-3">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>
												<p>Kategori : </p>
												<a href="" class="mc-btn-2 btn-style-2">{{ $value->jenjang }}</a>
												<a href="" class="mc-btn-2 btn-style-2">{{ $value->mapel }}</a>
												<a href="" class="mc-btn-2 btn-style-2">{{ $value->bab }}</a>
                                            </div>
                                        </div>
                                    </li> 
								@empty
									<p>Tidak ada data</p>
								@endforelse	
									<br>
									<center>
									@if(isset($data['prev']) && isset($data['next']))
										<a href="daftarpertanyaan?p={{ $data['prev'] }}&b={{ $data['currentBab'] }}"><i class="icon md-arrow-left"></i> Sebelumnya</a><a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a><a href="daftarpertanyaan?p={{ $data['next'] }}&b={{ $data['currentBab'] }}">Selanjutnya <i class="icon md-arrow-right"></i></a>
									@elseif(isset($data['prev']))
										<a href="daftarpertanyaan?p={{ $data['prev'] }}&b={{ $data['currentBab'] }}"><i class="icon md-arrow-left"></i> Sebelumnya</a>
									@elseif(isset($data['next']))
										<a href="daftarpertanyaan?p={{ $data['next'] }}&b={{ $data['currentBab'] }}">Selanjutnya <i class="icon md-arrow-right"></i></a>
									@endif
									</center>
                                </ul>
                            </div>
                            <!-- END / REVIEW -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / COURSE TOP -->
    
    @include('footer')