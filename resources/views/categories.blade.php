	@include('header')
    <!-- SUB BANNER -->
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
    <!-- END / SUB BANNER -->


    <!-- PAGE CONTROL -->
    <section class="page-control">
        <div class="container">
            <div class="page-info">
                <a href="">Kategori</a>
            </div>
            <div class="page-view">
                Tampilan
                <span class="page-view-info view-grid active" title="View grid"><i class="icon md-ico-2"></i></span>
                <span class="page-view-info view-list" title="View list"><i class="icon md-ico-1"></i></span>
                <div class="mc-select" style="width:370px">
					<select class="select" name="" id="all-categories" onchange="showHide(this.value)">
                        <option value="0" @if($data['InJenjang'] == 0) {{ "selected" }} @endif >Tampilkan Semua</option>
                        <option value="1" @if($data['InJenjang'] == 1) {{ "selected" }} @endif >Sekolah Dasar(SD) Sederajat</option>
                        <option value="2" @if($data['InJenjang'] == 2) {{ "selected" }} @endif >Sekolah Menengah Pertama(SMP) Sederajat</option>
                        <option value="3" @if($data['InJenjang'] == 3) {{ "selected" }} @endif >Sekolah Menengah Atas(SMA) Sederajat</option>
                        <option value="4" @if($data['InJenjang'] == 4) {{ "selected" }} @endif >Umum</option>
                    </select>						
                </div>
            </div>
        </div>
    </section>
    <!-- END / PAGE CONTROL -->
    
    <!-- CATEGORIES CONTENT -->
    <section id="categories-content" class="categories-content">
        <div class="container">
            <div class="row">
    
                <div class="col-md-9 col-md-push-3">
                    <div class="content grid">
                        <div class="row">
                            <!-- ITEM -->
							@forelse($data['bab'] as $key => $value)
                            <div class="col-sm-6 col-md-4 bab{{ $value->id_mapel }} mapel{{ $value->id_jenjang }}">
                                <div class="mc-item mc-item-2">
                                    <div class="image-heading">
                                        <img src="images/catalog/{{ $value->gambar}}" alt="">
                                    </div>
                                    <div class="meta-categories"><a href="daftarpertanyaan?p=1&b={{ $value->id_bab }}">{{ $value->mapel }}</a></div>
                                    <div class="content-item">
                                        <div class="image-author">
                                        </div>
                                        <h4><a href="daftarpertanyaan?p=1&b={{ $value->id_bab }}">{{ $value->bab }} </a></h4>
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
                                </div>
                            </div>
							@empty
							<p>Tidak ada data</p>
							@endforelse
                            <!-- END / ITEM -->
                            
                        </div>
                    </div>
                </div>

                <!-- SIDEBAR CATEGORIES -->
                <div class="col-md-3 col-md-pull-9">
                    <aside class="sidebar-categories">
                        <div class="inner">
    
                            <!-- WIDGET CATEGORIES -->
                            <div class="widget widget_categories">
                                <ul class="list-style-block">
								@forelse($data['mapel'] as $key => $value)
                                    <li class="mapel{{ $value->id_jenjang }}" onClick="showHide2({{ $value->id_mapel }})";><a href="#">{{ $value->mapel }}</a></li>
								@empty
									<p>Tidak ada data</p>
								@endforelse
                                </ul>
                            </div>
                            <!-- END / WIDGET CATEGORIES -->
                        </div>
                    </aside>
                </div>
                <!-- END / SIDEBAR CATEGORIES -->
    
            </div>
        </div>
    </section>
	<script>
	
	

	function showHide(id) {
		for(var a = 1; a < 5; a++) {
		$( ".mapel" + a ).show();
		}
		
		if(id != 0){
			for(var a = 1; a < 5; a++) {
			if(a != id)
			$( ".mapel" + a ).hide();
			}
		}
	}
	
	$( document ).ready(function() {
		if({{$data['InMapel']}} == 0){
			showHide({{$data['InJenjang']}});
		}else{
			showHide2({{$data['InMapel']}});
		}
	});
	
	function showHide2(id) {
		for(var a = 1; a < 500; a++) {
		$( ".bab" + a ).show();
		}
		
		if(id != 0){
			for(var a = 1; a < 5; a++) {
			if(a != id)
			$( ".bab" + a ).hide();
			}
		}
	}
	
	
	</script>
	
    <!-- END / CATEGORIES CONTENT -->
    @include('footer')