<!-- Footer Section -->
    <footer class="main-footer">
        <div class="container">
            <div class="row row-col-gap" data-gutter="60">
                <div class="col-md-8 col-sm-12 hidden-xs">
                    <div class="col-md-4 col-xs-12 p-none">
                        <h4>Learn More</h4>
                        <ul class="design">
                            <li><a href="#">About Us</a>
                            </li>
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#">Refund Policy</a>
                            </li>
                            <li><a href="#">Term & Conditions</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-md-4 col-xs-12 p-none">
                        <h4>Contact Us</h4>
                        <ul class="design">
                            <li><a href="#">Start Selling</a>
                            </li>
                            <li><a href="#">Advertise With Us</a>
                            </li>
                            <li><a href="#">Partner With Us</a>
                            </li>
                            <li><a href="#">Sitemap</a>
                            </li>
                            <li><a href="#">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-xs-12 p-none">
                        <h4>Our Community</h4>
                        <ul class="design">
                            <li><a href="#">850.296 Products</a>
                            </li>
                            <li><a href="#">1.207.300 Members</a>
                            </li>
                            <li><a href="#">74.059 Sellers</a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 ">
                    <h4 class="widget-title-sm">Newsletter</h4>
                    <form action="{{ URL::to('subscribe')}}" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label style="margin-bottom: 15px;">Sign up for our newsletter for stay up-to-date with our latest news in your inbox.</label>
                            <input class="newsletter-input form-control" placeholder="yourmail@gmail.com" type="text" name="email" />
                        </div>
                        <button class="btn btn-primary" type="submit" value="Subscribe" >Subscribe</button>
                    </form>
                </div>
            </div>
            <br/>
            <hr>
            <div class="row">
                
                <div class="col-md-8 col-xs-12">
                    <div class="col-md-5 col-xs-12 p-none">
                        <p class="copyright-text text-left"> &copy; 2017 <a href="#">Design Minister</a>. All rights reseved.</p>
                    </div>
                    <div class="col-md-7 col-xs-12">
                        <ul class="main-footer-social-list pull-right">
                            <li><a href="#"><img src="{{ asset('home_asset/fonts/006-facebook-logo.png')}}"/></a></li>
                            <li><a href="#"><img src="{{ asset('home_asset/fonts/005-twitter-logo-silhouette.png')}}"/></a></li>
                            <li><a href="#"><img src="{{ asset('home_asset/fonts/003-google-plus-symbol.png')}}"/></a></li>
                            <li><a href="#"><img src="{{ asset('home_asset/fonts/004-dribbble-logo.png')}}"/></a></li>
                            <li><a href="#"><img src="{{ asset('home_asset/fonts/002-pinterest.png')}}"/></a></li>
                            <li><a href="#"><img src="{{ asset('home_asset/fonts/001-behance-logo.png')}}"/></a></li>
                            
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <ul class="payment-icons-list">
                        <li>
                            <img src="{{ asset('home_asset/img/001-credit-card.png')}}" alt="Image Alternative text" title="Pay with Maestro" />
                        </li>

                        <li>
                            <img src="{{ asset('home_asset/img/003-visa.png')}}" alt="Image Alternative text" title="Pay with Visa" />
                        </li>
                        <li>
                            <img src="{{ asset('home_asset/img/002-paypal.png')}}" alt="Image Alternative text" title="Pay with Paypal" />
                        </li>

                    </ul>
                </div>
            </div>


        </div>
    </footer>