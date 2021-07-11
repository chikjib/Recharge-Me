
    <!-- Footer Section Start -->
    <footer>
        <div class=" container">
            <div class="footer-text">
                <!-- About Us Section Start -->
                <div class="row">
                    <div class="col-sm-4 col-lg-4 col-md-4 col-12">
                        <h4>About Us</h4>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been
                            the industryzzzz's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley
                            of type and scrambled it to make a type specimen book.It has survived not only five
                            centuries,
                            but also the leap into electronic typesetting, remaining essentially unchanged.
                        </p>
                        <hr id="hr_border2">
                        <h4 class="menu">Follow Us</h4>
                        <ul class="list-inline mb-2">
                            <li>
                                <a href="#"> <i class="livicon" data-name="facebook" data-size="18" data-loop="true"
                                        data-c="#ccc" data-hc="#ccc"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#"> <i class="livicon" data-name="twitter" data-size="18" data-loop="true"
                                        data-c="#ccc" data-hc="#ccc"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#"> <i class="livicon" data-name="google-plus" data-size="18" data-loop="true"
                                        data-c="#ccc" data-hc="#ccc"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#"> <i class="livicon" data-name="linkedin" data-size="18" data-loop="true"
                                        data-c="#ccc" data-hc="#ccc"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#"> <i class="livicon" data-name="rss" data-size="18" data-loop="true"
                                        data-c="#ccc" data-hc="#ccc"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- //About us Section End -->
                    <!-- Contact Section Start -->
                    <div class="col-sm-4 col-lg-4 col-md-4 col-12">
                        <h4>Contact Us</h4>
                        <ul class="list-unstyled">
                            <li>35,Lorem Lis Street, Park Ave</li>
                            <li>Lis Street, India.</li>
                            <li><i class="livicon icon4 icon3" data-name="cellphone" data-size="18" data-loop="true"
                                    data-c="#ccc" data-hc="#ccc"></i>Phone:9140 123 4588
                            </li>
                            <li><i class="livicon icon4 icon3" data-name="printer" data-size="18" data-loop="true"
                                    data-c="#ccc" data-hc="#ccc"></i> Fax:400 423 1456
                            </li>
                            <li>
                                <i class="livicon icon3" data-name="mail-alt" data-size="20" data-loop="true"
                                    data-c="#ccc" data-hc="#ccc"></i>
                                Email: <a class="text-success" href="mailto:info@joshadmin.com">info@joshadmin.com</a>
                            </li>
                            <li><i class="livicon icon4 icon3" data-name="skype" data-size="18" data-loop="true"
                                    data-c="#ccc" data-hc="#ccc"></i> Skype: <a class="text-success"
                                    href="skype:Joshadmin">Joshadmin</a>
                            </li>
                        </ul>
                        <hr id="hr_border">
                        
                    </div>
                    <!-- //Contact Section End -->
                    <!-- Recent post Section Start -->
                    <div class="col-sm-4 col-lg-4 col-md-4 col-12">
                        <h4>Recent Posts</h4>
                        <?php 
                            $postsfooter = DB::table('posts')->latest()->take(5)->get();
                        ?>
                        @if($postsfooter)
                        @foreach ($postsfooter as $postfooter)
                        <div class="media">
                            <img class="media-object rounded-circle mr-3" src="{{ asset('front/images/logo.png') }}"
                                alt="image">
                            <div class="media-body">
                                <p class="media-heading text-justify">{!! illuminate\Support\Str::words($postfooter->body, 50, '...') !!}</p>
                                <p class="text-right"><i>{{ $postfooter->author }}</i></p>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <!-- //Recent Post Section End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- //Footer Section End -->
        <div class=" col-12 copyright">
            <div class="container">
                <p>Copyright &copy; Josh Admin Template, {{ date('Y') }}</p>
            </div>
        </div>
    </footer>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"
        data-original-title="Return to top" data-toggle="tooltip" data-placement="left">
        <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
    </a>



    <!--global js starts-->
    <script type="text/javascript" src="{{ asset('front/js/frontend/lib.js') }}"></script>
    <!--global js end-->
    <!-- begin page level js -->
    <!-- page level js starts-->
<script type="text/javascript" src="{{ asset('front/js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/vendors/wow/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/frontend/carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/frontend/index.js') }}"></script>
<!--page level js ends-->
    <!-- end page level js -->
    <script>
        $(".navbar-toggler-icon").click(function () {
        $(this).closest('.navbar').find('.collapse').toggleClass('collapse1')
    })

    $(function () {
        $('[data-toggle="tooltip"]').tooltip().css('font-size', '14px');
    })
    </script>

</body>
</html>