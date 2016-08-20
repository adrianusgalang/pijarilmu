    @include('header')
	
	<!-- HOME SLIDER -->
    <section class="slide" style="background-image: url(images/homeslider/bg.jpg)">
        <div class="container">
            <div class="slide-cn" id="slide-home">
                <!-- SLIDE ITEM -->
                <div class="slide-item">
                    <div class="item-inner">
                        <div class="text">
                            <h2>Learn more - Earn more</h2>
                            <p>this is not only an elegant theme but also<br> a course management system<br> for wordpress and drupal
                            </p>
                            <div class="group">
                                <a href="#" class="mc-btn btn-style-1">See full features</a>
                            </div>
                        </div>

                        <div class="img">
                            <img src="images/homeslider/img-thumb.png" alt="">
                        </div>
                    </div>

                </div>  
                <!-- SLIDE ITEM -->     

                <!-- SLIDE ITEM -->
                <div class="slide-item">
                    <div class="item-inner">
                        <div class="text">
                            <h2>Learn more - Earn more</h2>
                            <p>this is not only an elegant theme but also<br> a course management system<br> for wordpress and drupal
                            </p>
                            <div class="group">
                                <a href="#" class="mc-btn btn-style-1">See full features</a>
                            </div>
                        </div>

                        <div class="img">
                            <img src="images/homeslider/img-thumb.png" alt="">
                        </div>

                    </div>  
                </div>  
                <!-- SLIDE ITEM -->  

            </div>
        </div>
    </section>
    <!-- END / HOME SLIDER -->


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
                <div class="tb-cell text-right">
                    <div class="form-actions">
                        <input type="submit" value="Find Course" class="mc-btn btn-style-1">
                    </div>
                </div>
            </div>
    
        </div>
    </section>
    <!-- END / AFTER SLIDER -->
    
    <!-- SECTION 1 -->
    <section id="mc-section-1" class="mc-section-1 section">
        <div class="container">
            <div class="row">
                
                <div class="col-md-5">
                    <div class="mc-section-1-content-1"> 
                        <h2 class="big">Online And Offline Training Course Management</h2>
                        <p class="mc-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        <a href="#" class="mc-btn btn-style-1">About us</a>
                    </div>
                </div>
    
                <div class="col-md-6 col-lg-offset-1">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="featured-item">
                                <i class="icon icon-featured-1"></i>
                                <h4 class="title-box text-uppercase">CLEAN AND EASY</h4>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam  tincidunt ut laoreet</p>
                            </div>
                        </div>
    
                        <div class="col-sm-6">
                            <div class="featured-item">
                                <i class="icon icon-featured-2"></i>
                                <h4 class="title-box text-uppercase">TEACH AS YOU CAN</h4>
                                <p> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit</p>
                            </div>
                        </div>
    
                        <div class="col-sm-6">
                            <div class="featured-item">
                                <i class="icon icon-featured-3"></i>
                                <h4 class="title-box text-uppercase">COMMUNITY SUPPORT</h4>
                                <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat</p>
                            </div>
                        </div>
    
                        <div class="col-sm-6">
                            <div class="featured-item">
                                <i class="icon icon-featured-4"></i>
                                <h4 class="title-box text-uppercase">TRACKING PERFORMANCE</h4>
                                <p> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit</p>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </section>
    <!-- END / SECTION 1 -->

    <!-- SECTION 3 -->
    <section id="mc-section-3" class="mc-section-3 section">
        <div class="container">
            <!-- FEATURE -->
            <div class="feature-course">
                <h4 class="title-box text-uppercase">Kategori </h4>
                <a href="" class="all-course mc-btn btn-style-1">Lihat semua</a>
                <div class="row">
                    <div class="feature-slider">
					@forelse($data['mapel'] as $key => $value)
                        <div class="mc-item mc-item-1">
                            <div class="image-heading">
                                <img src="images/catalog/{{ $value->image}}" alt="">
                            </div>
                            <div class="content-item">
                                <h4><a href="categories?mapel={{ $value->mapel }}&jenjang=0">{{ $value->mapel }}</a></h4>
                                <div class="name-author">
									@if($value->id_jenjang == 1)
										<a href="#">Sekolah Dasar(SD) Sederajat</a>								
									@endif
                                    @if($value->id_jenjang == 2)
										<a href="#">Sekolah Menengah Pertama(SMP) Sederajat</a>								
									@endif
									@if($value->id_jenjang == 3)
										<a href="#">Sekolah Menengah Atas(SMA) Sederajat</a>								
									@endif
									@if($value->id_jenjang == 4)
										<a href="#">Umum</a>								
									@endif
                                </div>
                            </div>
                            <div class="ft-item">
                                <div class="comment-info">
                                    <i class="icon md-comment"></i>
                                    {{ $value->jumlahSoal }}
                                </div>
                                <div class="price">
                                    @if($value->id_jenjang == 1)
										SD							
									@endif
                                    @if($value->id_jenjang == 2)
										SMP						
									@endif
									@if($value->id_jenjang == 3)
										SMA							
									@endif
									@if($value->id_jenjang == 4)
										Umum						
									@endif
                                    
                                </div>
                            </div>
                        </div>
					@empty
						<p>Tidak ada data</p>
					@endforelse
                    </div>
                </div>
            </div>
            <!-- END / FEATURE -->
        </div>
    </section>
    <!-- END / SECTION 3 -->
	
	@include('footer')