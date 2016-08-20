	@include('header')

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
            
            <h3 class="md black">Profile</h3>
            <div class="row">
                <div class="col-md-9">
                    <div class="avatar-acount">
					@forelse($data['user'] as $key => $value)
                        <div class="changes-avatar">
                            <div class="img-acount">
                                <img src="images/catalog/{{ $value->foto}}" alt="">
                            </div>
                        </div>   
                        <div class="info-acount">
                            <h3 class="md black">{{ $value->nama }}</h3>
                            <p>{{ $value->about }}</p>
                            <div class="profile-email-address">
                                <div class="profile-email">
                                    <h5>Jenjang</h5>
                                    <p>@if($value->id_jenjang == 1) {{ "SD" }} @elseif ($value->id_jenjang == 2) {{ "SMP" }} @elseif ($value->id_jenjang == 3) {{ "SMA" }} @endif</p>
                                </div>
                                <div class="profile-address">
                                    <h5>Sekolah</h5>
                                    <p>{{ $value->namaSekolah }}</p>
                                </div>
                            </div>
                        </div>
					@empty
						<p>Tidak ada data</p>
					@endforelse
                    </div>    
                </div>                
            </div>    
        </div>
    </section>
    <!-- END / PROFILE -->

	@include('footer')