<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <meta charset="utf-8" />
    <title>HotelPlex – Hotel Booking</title>

	<!-- Meta Data -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <meta name="author" content="ArtTemplates" />
    <meta name="description" content="HotelPlex — Best Hotel Management System" />

    <!-- Twitter data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@ArtTemplates">
    <meta name="twitter:title" content="HotelPlex">
    <meta name="twitter:description" content="HotelPlex — Best Hotel Management System">
    <meta name="twitter:image" content="assets/images/social.html">

    <!-- Open Graph data -->
    <meta property="og:title" content="ArtTemplate" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="your url website" />
    <meta property="og:image" content="assets/images/social.html" />
    <meta property="og:description" content="HotelPlex — Best Hotel Management System" />
    <meta property="og:site_name" content="HotelPlex" />

	<!-- Favicons -->
	<link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicons/apple-touch-icon-57x57.png">
	<link rel="shortcut icon" href="assets/images/favicons/favicon.png" type="image/png">

    <!-- Styles -->
	<link rel="stylesheet" type="text/css" href="assets/styles/style.css"/>
    <link rel="stylesheet" type="text/css" href="assets/demo/style-demo.css"/>

    </head>
    <body>
        <!-- Preloader -->
    <div class="preloader">
	    <div class="preloader__wrap">
		    <div class="preloader__progress"><span></span></div>
		</div>
	</div>

    <!-- Header -->
	<header class="header">
	    <nav class="navbar navbar-white navbar-overlay">
            <a class="logo-link" href="home.html">
                <img class="logotype" src="assets/images/ui/logo-white.png" alt="HotelPlex">
		    </a>
		    <div class="navbar__menu">
		        <button class="hamburger" type="button">
				    <span></span>
					<span></span>
				</button>
			    <ul class="nav">
				    <li class="nav__item _is-current"><a class="nav__link" href="rooms.html"><span data-hover="Rooms">Rooms</span></a></li>
				    <li class="nav__item"><a class="nav__link" href="gallery.html"><span data-hover="Gallery">Gallery</span></a></li>
				    <li class="nav__item"><a class="nav__link" href="about.html"><span data-hover="About Us">About Us</span></a></li>
				    <li class="nav__item"><a class="nav__link" href="blog.html"><span data-hover="Blog">Blog</span></a></li>
				    <li class="nav__item"><a class="nav__link" href="contact.html"><span data-hover="Contact Us">Contact Us</span></a></li>
					<li class="nav__item"><a class="btn btn__medium" href="#"><i class="btn-icon-left icon-bookmark"></i>Reservations</a></li>
			    </ul>
	        </div>
		    <div class="navbar__btn">
		        <a class="btn btn__medium" href="rooms.html"><i class="btn-icon-left icon-bookmark"></i>Reservations</a>
		    </div>	
	    </nav>
	</header>
	<!-- /Header -->
    
	<!-- Content -->
	<main class="main">
        <!-- Intro -->
		<section class="intro">
		    <div class="intro__bg-wrap">
		        <div class="overlay intro__bg js-image js-parallax" data-image="assets/images/image_header_04.jpg"></div>
			</div>
	        <div class="container intro__container">
		        <div class="row h-100 align-items-center">
			        <div class="col-12 col-md-12 col-xl-8">
				        <span class="title title--overhead text-white js-lines">Welcome to"HotelPlex Hotel</span>
		                <h1 class="title title--display-1 js-lines">Feeling cool like your favorite place.</h1>
					    <button class="intro__btn-play js-lines" id="play">Adventure<span class="btn-play btn-play__popup"></span></button>
				    </div>
                </div>				
		    </div>
		    <!-- Scroll To -->
		    <a class="scroll-to" href="%21.html#about">Scroll<span class="scroll-to__line"></span></a>
	    </section>
	    <!-- /Intro -->
	
		<!-- Booking -->
		<div class="bottom-panel booking-panel">
		    <form class="bottom-panel__wrap d-flex">
			    <div class="row bottom-panel__form-wrap">
			        <div class="form-group col-date-to col-12 col-sm-6 col-md-4 slash">
				        <label class="labelFeature" for="check-in">Check in</label>
                        <input type="text" class="inputFeature input-arrow readonly js-datepicker" id="check-in" name="check-in" placeholder="Select date" required="required" autocomplete="off">
				    </div>
				    <div class="form-group col-date-from col-12 col-sm-6 col-md-4 slash">
				        <label class="labelFeature" for="check-out">Check out</label>
                        <input type="text" class="inputFeature input-arrow readonly js-datepicker" id="check-out" name="check-out" placeholder="Select date" required="required" autocomplete="off">
				    </div>
				    <div class="form-group col-12 col-md-4 dropdown">
					    <div class="closeDropdown" id="dropdownPersonsAction" data-toggle="dropdown" data-display="static">
				            <label class="labelFeature" for="person-total">Person</label>
                            <input type="text" class="inputFeature input-arrow readonly" id="person-total" name="person" placeholder="Select person" required="required" autocomplete="off">
						</div>
						
						<!-- Dropdown person -->
						<div class="dropdown-menu dropdown-menu-lg-left dropdown-menu-right" id="dropdownPersons" aria-labelledby="dropdownPersonsAction">
						    <div class="row">
						        <div class="form-group col-6 col__left">
							        <label class="label" for="person-adult">Adults</label>
						            <div class="js-quantity">
									    <span class="qty-minus icon-minus"></span>
									    <input type="number" class="inputText js-quantity-input" id="person-adult" name="person-adalt" value="0" min="1" max="8" readonly="readonly">
										<span class="qty-plus icon-plus"></span>
									</div>	
							    </div>
							    <div class="form-group col-6 col__right">
							        <label class="label" for="person-kids">Kids</label>
									<div class="js-quantity">
									    <span class="qty-minus icon-minus"></span>
							            <input type="number" class="inputText js-quantity-input" id="person-kids" name="person-kids" value="0" min="0" max="8" readonly="readonly">
										<span class="qty-plus icon-plus"></span>
									</div>
							    </div>
							</div>
							<div class="row row-footer">
							    <div class="col-6 col__left">
							        <button type="button" class="btn btn__small btn__second btn-reset-persons w-100">Clear</button>
								</div>
							    <div class="col-6 col__right">
							        <button type="button" class="btn btn__small btn-close-dropdown w-100">Apply</button>
								</div>
							</div>	
						</div>
						<!-- /Dropdown person -->
				    </div>
				</div>
		        <button type="submit" class="btn-booking"><span>Next</span>Book Now</button>
			</form>
		</div>	
	    <!-- /Booking -->

 <!-- Section About Us -->
 <section id="about" class="container section">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-8">
            <span class="title title--overhead js-lines">About Us</span>
            <h1 class="title title--h1 js-lines">Begin your amazing adventure.</h1>
        </div>
        <div class="col-12 col-lg-6 text-left text-sm-justify">
            <p class="mr-0 mr-lg-4 paragraph js-scroll-show">The humid subtropical climate, high mountains, exotic vegetation, endless beaches, national parks, historic architecture, exciting attraction sites, art festivals and lively multicultural environment make Sochi a prominent resort destination.</p>
        </div>
        <div class="col-12 col-lg-6 text-left text-sm-justify">
            <p class="ml-0 ml-lg-4 paragraph js-scroll-show">HotelPlex has a lot to offer for anyone who loves nature, sports, history, sunny beach leisure and active adventures. There is too much to do and too many things to see in Sochi so you will never be bored.</p>
        </div>
        
        <div class="col-12 col-lg-6">
            <figure class="about-image-wrap mr-0 mr-lg-4">
                <a class="about-link" href="about.html">Explore More <i class="icon-arrow-special"></i></a>
                <img class="cover about-image-portrait" src="assets/images/about_image_01.jpg" alt="about" />
            </figure>	
        </div>
        <div class="col-12 col-lg-6">
            <figure class="about-image-wrap ml-0 ml-lg-4">
                <img class="cover about-image-landscape" src="assets/images/about_image_02.jpg" alt="about" />
            </figure>
        </div>
    </div>
</section>
		
		<!-- Section Rooms -->
		<section class="container section">	
	        <div class="row align-items-end">
		        <div class="col-12 col-md-12 col-lg-8">
			        <span class="title title--overhead js-lines">Rooms</span>
			        <h1 class="title title--h1 js-lines">Rooms / Suites.</h1>
			    </div>
				<div class="col-12 col-md-12 col-lg-4 text-lg-right d-none d-md-block">
				    <a class="btn-link header-btn-more" href="rooms.html">See all Rooms</a>
				</div>
			</div>
			
			<!-- Grid -->
			<div class="row">
				<div class="col-12 col-md-12 col-lg-8">
				    <!-- ItemRoom -->
				    <div class="itemRoom">
					    <span class="badge">Popular</span>
					    <figure class="itemRoom__img-wrap">
						    <a class="itemRoom__link" href="room_details.html">
							    <img class="cover" src="assets/images/image_room_01.jpg" alt="room" />
							</a>
						</figure>
						<div class="itemRoom__details">
						    <h4 class="title title--h4">Comfort Room</h4>
							<div class="itemRoom__price">$89<span>night</span></div>
						</div>	
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-4">
				    <!-- ItemRoom -->
				    <div class="itemRoom">
					    <figure class="itemRoom__img-wrap">
						    <a class="itemRoom__link" href="room_details.html">
							    <img class="cover" src="assets/images/image_room_02.jpg" alt="room" />
							</a>
						</figure>
						<div class="itemRoom__details">
						    <h4 class="title title--h4">Luxe Room</h4>
							<div class="itemRoom__price">$256<span>night</span></div>
						</div>
					</div>	
				</div>
				<div class="col-12 col-md-6 col-lg-4">
				    <!-- ItemRoom -->
				    <div class="itemRoom">
					    <figure class="itemRoom__img-wrap">
						    <a class="itemRoom__link" href="room_details.html">
							    <img class="cover" src="assets/images/image_room_03.jpg" alt="room" />
							</a>
						</figure>
						<div class="itemRoom__details">
						    <h4 class="title title--h4">Grand Delux Room</h4>
							<div class="itemRoom__price">$99<span>night</span></div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-4">
				    <!-- ItemRoom -->
				    <div class="itemRoom">
					    <figure class="itemRoom__img-wrap">
						    <a class="itemRoom__link" href="room_details.html">
							    <img class="cover" src="assets/images/image_room_04.jpg" alt="room" />
							</a>
						</figure>
						<div class="itemRoom__details">
						    <h4 class="title title--h4">Standard Room</h4>
							<div class="itemRoom__price">$49<span>night</span></div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-4">
				    <!-- ItemRoom -->
				    <div class="itemRoom mb-0">
					    <figure class="itemRoom__img-wrap">
						    <a class="itemRoom__link" href="room_details.html">
							    <img class="cover" src="assets/images/image_room_05.jpg" alt="room" />
							</a>
						</figure>
						<div class="itemRoom__details">
						    <h4 class="title title--h4">Apartments</h4>
							<div class="itemRoom__price">$649<span>night</span></div>
						</div>
					</div>
				</div>
            </div>			
	    </section>
		
		<!-- Section Achievements -->
		<section class="container section">	
	        <div class="row">
		        <div class="col-12 col-lg-7">
                    <h2 class="title-description js-lines">We strive to be the best in our field to make you even more comfortable.</h2>
                </div>
            </div>
			
			<div class="row">
			    <!-- Item count -->
			    <div class="col-6 col-md-3 col__left">
				    <div class="ach-box">
				        <span class="title title--overhead js-lines">Spa offers</span>
				        <div class="item-count"><span>32</span>+</div>
					</div>
				</div>
				
			    <!-- Item count -->
			    <div class="col-6 col-md-3 col__right">
				    <div class="ach-box">
				        <span class="title title--overhead js-lines">Rooms</span>
				        <div class="item-count"><span>24</span>+</div>
					</div>
				</div>
				
			    <!-- Item count -->
			    <div class="col-6 col-md-3 col__left">
				    <div class="ach-box">
				        <span class="title title--overhead js-lines">Beaches</span>
				        <div class="item-count"><span>3</span>+</div>
					</div>
				</div>
				
			    <!-- Item count -->
			    <div class="col-6 col-md-3 col__right">
				    <div class="ach-box">
				        <span class="title title--overhead js-lines">Happy clients</span>
				        <div class="item-count"><span>10</span>k</div>
					</div>
				</div>
			</div>
        </section>

		<!-- Section Testimonials -->
		<section class="section section-testimonials section-gray section-gray--cutoutTop">
		    <div class="container">
			    <div class="row">
				    <div class="col-12">
			            <span class="title title--overhead js-lines">Testimonials</span>
			            <h1 class="title title--h1 js-lines">What clients <br><span class="text-accent">say about us.</span></h1>
			        </div>
					
					<div class="col-12">
					    <!-- Carousel -->
					    <div class="swiper-container js-testimonials mb-5">
						    <div class="swiper-wrapper">
							    <!-- Testimonials item -->
                                <div class="testimonials-item swiper-slide">
								    <h4 class="title title--h4">Best hotel!</h4>
									<p class="testimonials-item__caption">— The hotel has everything you need. On the ground floor there is a lobby bar, on the second floor there is a zone with an indoor pool and sauna, on the seventh floor there is a restaurant and spa-salon. The rooms are cleaned every day.</p>
								    <div class="author-wrap">
									    <div class="author-picture"><img class="cover" src="assets/images/person.jpg" alt="Jacob Lane" /></div>
										<div>
										    <div class="author-name">Jacob Lane</div>
										    <div class="author-country">from USA</div>
										</div>
									</div>
								</div>
							    <!-- Testimonials item -->
                                <div class="testimonials-item swiper-slide">
								    <h4 class="title title--h4">Comfortable hotel.</h4>
									<p class="testimonials-item__caption">— Well, what can I say, every year, day and hour, this place is being transformed for the better. The staff is completely competent and friendly, Everything around is blooming, pleasing, nourishing and making the holiday bright.</p>
								    <div class="author-wrap">
									    <div class="author-picture"><img class="cover" src="assets/images/person2.jpg" alt="Victoria Wilson" /></div>
										<div>
										    <div class="author-name">Victoria Wilson</div>
										    <div class="author-country">from France</div>
										</div>
									</div>
								</div>
							    <!-- Testimonials item -->
                                <div class="testimonials-item swiper-slide">
								    <h4 class="title title--h4">The modern.</h4>
									<p class="testimonials-item__caption">— The modern 5 * Hotel"HotelPlex Center is an ideal solution for combining business and leisure. Stylish design and exceptional service will satisfy the desires of any guest. 150 rooms with balcony (non-smoking), sea view, trendy restaurant.</p>
								    <div class="author-wrap">
									    <div class="author-picture"><img class="cover" src="assets/images/person3.jpg" alt="Max Edwards" /></div>
										<div>
										    <div class="author-name">Max Edwards</div>
										    <div class="author-country">from Germany</div>
										</div>
									</div>
								</div>
							    <!-- Testimonials item -->
                                <div class="testimonials-item swiper-slide">
								    <h4 class="title title--h4">Best hotel!</h4>
									<p class="testimonials-item__caption">— The hotel has everything you need. On the ground floor there is a lobby bar, on the second floor there is a zone with an indoor pool and sauna, on the seventh floor there is a restaurant and spa-salon. The rooms are cleaned every day.</p>
								    <div class="author-wrap">
									    <div class="author-picture"><img class="cover" src="assets/images/person.jpg" alt="Jacob Lane" /></div>
										<div>
										    <div class="author-name">Jacob Lane</div>
										    <div class="author-country">from USA</div>
										</div>
									</div>
								</div>
							    <!-- Testimonials item -->
                                <div class="testimonials-item swiper-slide">
								    <h4 class="title title--h4">Comfortable hotel.</h4>
									<p class="testimonials-item__caption">— Well, what can I say, every year, day and hour, this place is being transformed for the better. The staff is completely competent and friendly, Everything around is blooming, pleasing, nourishing and making the holiday bright.</p>
								    <div class="author-wrap">
									    <div class="author-picture"><img class="cover" src="assets/images/person2.jpg" alt="Victoria Wilson" /></div>
										<div>
										    <div class="author-name">Victoria Wilson</div>
										    <div class="author-country">from France</div>
										</div>
									</div>
								</div>
							    <!-- Testimonials item -->
                                <div class="testimonials-item swiper-slide">
								    <h4 class="title title--h4">The modern.</h4>
									<p class="testimonials-item__caption">— The modern 5 * Hotel"HotelPlex Center is an ideal solution for combining business and leisure. Stylish design and exceptional service will satisfy the desires of any guest. 150 rooms with balcony (non-smoking), sea view, trendy restaurant.</p>
								    <div class="author-wrap">
									    <div class="author-picture"><img class="cover" src="assets/images/person3.jpg" alt="Max Edwards" /></div>
										<div>
										    <div class="author-name">Max Edwards</div>
										    <div class="author-country">from Germany</div>
										</div>
									</div>
								</div>
                            </div>
							
							<!-- Pagination  -->
                            <div class="swiper-pagination"></div>
						</div>
						<!-- /Carousel -->
					</div>
				</div>
			</div>
        </section>
		
	    <!-- Section CTA -->
	    <section class="container">
	        <div class="row cta-box cta-negative js-scroll-show">
			    <div class="col-12 col-lg-7">
			        <h2 class="title title--h2">Make room for adventure.</h2>
				    <p class="paragraph">Book your room right now and start your amazing adventure full of discoveries and experiences with"HotelPlex.</p>
				</div>
				<div class="col-12 col-lg-5 text-lg-right">
				    <a href="rooms.html" class="btn btn__large btn--white">Reservations <i class="btn-icon-right icon-arrow-special"></i></a>
				</div>
			</div>
	    </section>
	</main>
	<!-- /Content -->
	
	<!-- Footer -->
	<footer class="footer">
	    <div class="footer__left">
			<ul class="footer__info">
			    <li>© 2020 HotelPlex</li>
			    <li><a href="text-page.html">Terms & Conditions</a></li>
				<li><a href="text-page.html">Privacy Policy</a></li>
			</ul>
		</div>
		<ul class="footer__social">
		    <li><a href="#" class="social-link"><i class="icon-facebook-alt"></i></a></li>
		    <li><a href="#" class="social-link"><i class="icon-twitter-alt"></i></a></li>
		    <li><a href="#" class="social-link"><i class="icon-instagram"></i></a></li>
		</ul>
	</footer>

    <!-- Lightbox hero video -->
    <div class="lightbox-backdrop">
	    <div class="close-popup icon-x"></div>
        <div class="lightbox-content">
            <div class="video-foreground">
			    <div class="youtube-popup" data-yt-url="https://www.youtube.com/embed/HSsqzzuGTPo?autoplay=1&amp;"></div>
            </div>
        </div>
    </div>

    {{-- <!-- Button Live Chat -->
	<div class="btn-floating js-show-to-scroll"><i class="icon-bubble"></i></div> --}}

	<!-- JavaScripts -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/plugins.min.js"></script>
    <script src="assets/js/common.js"></script>
    
	<script src="assets/demo/plugins-demo.js"></script>     
    </body>
</html>
