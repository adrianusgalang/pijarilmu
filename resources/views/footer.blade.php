    <!-- FOOTER -->
    <footer id="footer" class="footer">
        <div class="first-footer">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="widget megacourse">
                            <h3 class="md">Pijar Ilmu</h3>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat</p>
                            <a href="home" class="mc-btn btn-style-1">Home</a>
                        </div>
                    </div> 

                    <div class="col-md-3">
                        <div class="widget widget_latest_new">
                            <h3 class="sm">Pertanyaan Terkini</h3>
                            <ul>
							@forelse($data['lastesQuestion'] as $key => $value)
                                <li>
                                    <a href="viewpertanyaan?q={{$value->id_soal}}">
                                        <div class="image-thumb">
                                            <img src="images/team-13.jpg" alt="">
                                        </div>
                                        <span>{!!$value->soal!!}</span>
                                    </a>
                                </li>
							@empty
								<p>Tidak ada data</p>
							@endforelse
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="widget quick_link">
                            <h3 class="sm">Quick Links</h3>
                            <ul class="list-style-block">
                                <li><a href="#">About Pijar Ilmu</a></li>
                                <li><a href="#">How to Use</a></li>
								<li><a href="#">About Us</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="widget widget_latest_new">
                            <h3 class="sm">Kategori</h3>
                            <ul>
                                <li>
                                    <a href="categories?mapel=0&jenjang=1">
                                        <div class="image-thumb">
                                            <img src="images/team-13.jpg" alt="">
                                        </div>
                                        <span>Sekolah Dasar(SD) Sederajat</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="categories?mapel=0&jenjang=2">
                                        <div class="image-thumb">
                                            <img src="images/team-13.jpg" alt="">
                                        </div>
                                        <span>Sekolah Menengah Pertama(SMP) Sederajat</span>
                                    </a>
                                </li>
								<li>
                                    <a href="categories?mapel=0&jenjang=3">
                                        <div class="image-thumb">
                                            <img src="images/team-13.jpg" alt="">
                                        </div>
                                        <span>Sekolah Menengah Atas(SMA) Sederajat</span>
                                    </a>
                                </li>
								<li>
                                    <a href="categories?mapel=0&jenjang=4">
                                        <div class="image-thumb">
                                            <img src="images/team-13.jpg" alt="">
                                        </div>
                                        <span>Umum</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="second-footer">
            <div class="container">
                <div class="contact">
                    <div class="email">
                        <i class="icon md-email"></i>
                        <a href="mailto:pijarilmu2016@gmail.com">Mail Us</a>
                    </div>
                    <div class="phone">
                        <i class="fa fa-mobile"></i>
                        <span>+62 xxx xxx xxx</span>
                    </div>
                    <div class="address">
                        <i class="fa fa-map-marker"></i>
                        <span>Bandung, Indonesia</span>
                    </div>
                </div>
                <p class="copyright">Copyright © 2016 Pijar Ilmu. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- END / FOOTER -->
	
</div>
<!-- END / PAGE WRAP -->

<!-- Load jQuery -->

<script type="text/javascript" src="js/library/bootstrap.min.js"></script>
<script type="text/javascript" src="js/library/jquery.owl.carousel.js"></script>
<script type="text/javascript" src="js/library/jquery.appear.min.js"></script>
<script type="text/javascript" src="js/library/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="js/library/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script>
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>
</body>
</html>