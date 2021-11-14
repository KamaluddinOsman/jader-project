<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Soon</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!--
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE
	DESIGNED & DEVELOPED by FREEHTML5.CO

	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,400italic,700' rel='stylesheet' type='text/css'> -->
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{ asset('site/css/animate.css') }}">

        <!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('site/css/icomoon.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{ asset('site/css/bootstrap.css') }}">
	<!-- Theme style  -->
	<link rel="stylesheet" href="{{ asset('site/css/style.css') }}">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

        <style>
            @font-face {
                font-family: BlueOcean;
                src: url("{{asset('site/fonts/BlueOcean.ttf')}}");
            }
            @font-face {
                font-family: VIP-Rawy-Regular;
                src: url("{{asset('site/fonts/VIP-Rawy-Regular.otf')}}");
            }
        </style>
	</head>
	<body>

	<div class="fh5co-loader"></div>

	<div id="page">

	<div id="fh5co-container" class="js-fullheight">
		<div class="countdown-wrap js-fullheight">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="display-t js-fullheight">
						<div class="display-tc animate-box">
							<nav class="fh5co-nav" role="navigation">
								<div id="fh5co-logo"><a style="font-family: BlueOcean" href="#">قريباً</a></div>
							</nav>
							<h1 style="font-family: BlueOcean">تطبيق جدير</h1>
							<h2 style="font-family: VIP-Rawy-Regular; color: #8BC34A !important; font-size: 25px">كل شئ فى أى مكان</h2>
							<div class="simply-countdown simply-countdown-one"></div>
							<div class="row">
								<div class="col-md-12 desc">
{{--									<h2 style="font-family: VIP-Rawy-Regular">من هو جدير <br> جدير هي واحدة من أكبر منصات التوصيل في المنطقة. أكسبتها تجربة جدير الفريدة عند الطلب أعلى تقييمات للمستخدمين من بين جميع منصات التوصيل الكبيرة الأخرى في كل من متجر تطبيقات<br> Apple ومتجر Google Play. </h2>--}}
										<div class="col-md-12 col-md-offset-0">
											<div class="form-group">
                                                <img style="width: 200px; height: 70px" src="{{asset("site/images/1.png")}}">
                                                <img style="width: 200px; height: 70px" src="{{asset("site/images/2.png")}}">
											</div>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-cover js-fullheight" style="background-image:url({{asset("site/images/3.png")}});">

		</div>
	</div>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>

	<!-- jQuery -->
	<script src="{{asset('site/js/jquery.min.js')}}"></script>
	<!-- jQuery Easing -->
	<script src="{{asset('site/js/jquery.easing.1.3.js')}}"></script>
	<!-- Bootstrap -->
	<script src="{{asset('site/js/bootstrap.min.js')}}"></script>
	<!-- Waypoints -->
	<script src="{{asset('site/js/jquery.waypoints.min.js')}}"></script>

	<!-- Count Down -->
	<script src="{{asset('site/js/simplyCountdown.js')}}"></script>
	<!-- Main -->
	<script src="{{asset('site/js/main.js')}}"></script>

	<script>
    var d = new Date(new Date().getTime() + 180 * 120 * 120 * 2000);

    // default example
    simplyCountdown('.simply-countdown-one', {
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate()
    });

    //jQuery example
    $('#simply-countdown-losange').simplyCountdown({
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate(),
        enableUtc: false
    });
</script>

	</body>
</html>

