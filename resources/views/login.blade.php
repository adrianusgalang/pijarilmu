	@include('header')

    <!-- LOGIN -->
    <section id="login-content" class="login-content">
        <div class="awe-parallax bg-login-content"></div>
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="row">

                <!-- FORM -->
                <div class="col-xs-12 col-lg-4 pull-right">
                    <div class="form-login">
                        {!! Form::open(['url' => 'ceklogin','method'=>'POST']) !!}
                            <h2 class="text-uppercase">Masuk ke Pijar Ilmu</h2>
                            <div class="form-email">
                                <input type="text" placeholder="Email" name="email" required>
                            </div>
                            <div class="form-password">
                                <input type="password" placeholder="Password" name="password" required>
                            </div>
                            <div class="form-submit-1">
                                <input type="submit" value="Masuk" class="mc-btn btn-style-1">
                            </div>
                            <div class="link">
                                <a href="register">
                                    <i class="icon md-arrow-right"></i>Belum punya akun? Gabung disini
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
    
	@include('footer')