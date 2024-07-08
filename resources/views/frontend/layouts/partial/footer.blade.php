<footer class="footer">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 footer_col">
                <div class="footer_column footer_contact">
                    <div class="logo_container">
                        <div class="logo"><a href="#">{{ $settings->website_name }}</a></div>
                    </div>
                    <div class="footer_title">Got Question? Call Us 24/7</div>
                    <div class="footer_phone">{{ $settings->phone_two }}</div>
                    <div class="footer_contact_text">
                        <p >Address : {{ $settings->address }}</p>
                        
                    </div>
                    @php
                        $socials = DB::table('socials')->first();
                    @endphp
                    <div class="footer_social">
                        <ul>
                            <li><a href="{{ $socials->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{ $socials->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="{{ $socials->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="{{ $socials->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="{{ $socials->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            @php
                $pages_one = DB::table('pages')->where('page_position', 1)->get();
                $pages_two = DB::table('pages')->where('page_position', 2)->get();
            @endphp

            <div class="col-lg-2 offset-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Other Pages</div>
                    <ul class="footer_list">
                       @foreach ($pages_one as $row)
                       <li><a href="{{ route('view.page',$row->page_slug) }}">{{ $row->page_name ?? "Null" }}</a></li>
                       @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    <ul class="footer_list footer_list_2">
                        @foreach ($pages_two as $row)
                       <li><a href="{{ route('view.page',$row->page_slug) }}">{{ $row->page_name ?? "Null" }}</a></li>
                       @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Customer Care</div>
                    <ul class="footer_list">
                        <li><a href="{{ route('deshboard') }}">My Account</a></li>
                        <li><a href="{{ route('order.tracking') }}">Order Tracking</a></li>
                        <li><a href="{{ route('wishlist.view') }}">Wish List</a></li>
                        <li><a href="#">Our Bolg</a></li>
                        <li><a href="{{ route('contact.page') }}">Contact Us</a></li>
                        <li><a href="#">Become a vendor</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</footer>

<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col">
                
                <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                    <div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="fa fa-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Code Artist.IT</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </div>
                    <div class="logos ml-sm-auto">
                        <ul class="logos_list">
                            <li><a href="#"><img src="{{ asset ('frontend/images/logos_1.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset ('frontend/images/logos_2.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset ('frontend/images/logos_3.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset ('frontend/images/logos_4.png')}}" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
