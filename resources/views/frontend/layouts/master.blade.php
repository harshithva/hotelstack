<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

	<meta charset="utf-8" />
	<title>HotelPlex – @yield('title')</title>

	<!-- Meta Data -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="format-detection" content="telephone=no" />
	<meta name="format-detection" content="address=no" />
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
	<link rel="apple-touch-icon" sizes="180x180" href="./frontend/assets/images/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="./frontend/assets/images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="./frontend/assets/images/favicons/favicon-16x16.png">
	<link rel="manifest" href="./frontend/assets/images/favicons/site.webmanifest">

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="./frontend/assets/styles/style.css" />
	<link rel="stylesheet" type="text/css" href="./frontend/assets/demo/style-demo.css" />

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
				<img class="logotype" src="./frontend/assets/images/ui/logo-white.png" alt="HotelPlex">
			</a>
			<div class="navbar__menu">
				<button class="hamburger" type="button">
					<span></span>
					<span></span>
				</button>
				<ul class="nav">
					<li class="nav__item _is-current"><a class="nav__link" href="rooms.html"><span
								data-hover="Rooms">Rooms</span></a></li>
					<li class="nav__item"><a class="nav__link" href="gallery.html"><span
								data-hover="Gallery">Gallery</span></a></li>
					<li class="nav__item"><a class="nav__link" href="about.html"><span data-hover="About Us">About
								Us</span></a></li>
					<li class="nav__item"><a class="nav__link" href="blog.html"><span data-hover="Blog">Blog</span></a>
					</li>
					<li class="nav__item"><a class="nav__link" href="contact.html"><span data-hover="Contact Us">Contact
								Us</span></a></li>
					{{-- <li class="nav__item"><a class="btn btn__medium" href="/login"><i class="btn-icon-left icon-bookmark"></i>Reservations</a></li> --}}
				</ul>
			</div>
			<div class="navbar__btn">
				@if(Auth::user())
				<a class="btn btn__medium" href="/login"><i class="btn-icon-left icon-bookmark"></i>Hi,
					{{Auth::user()->name}}</a>
				@else
				<a class="btn btn__medium" href="/login"><i class="btn-icon-left icon-bookmark"></i>Sign in</a>
				@endif
			</div>
		</nav>
	</header>

	@yield('main')

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
				<div class="youtube-popup" data-yt-url="{{ $home->video_link }}"></div>
			</div>
		</div>
	</div>

	{{-- <!-- Button Live Chat -->
		<div class="btn-floating js-show-to-scroll"><i class="icon-bubble"></i></div> --}}
	<!-- JavaScripts -->
	{{-- <script src="./frontend/assets/js/jquery-3.4.1.min.js"></script> --}}
	<script src="{{ asset('backend/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
	<script src="./frontend/assets/js/plugins.min.js"></script>
	<script src="./frontend/assets/js/common.js"></script>

	<script src="./frontend/assets/demo/plugins-demo.js"></script>

	@yield('script')
</body>

</html>