<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title(''); ?></title>

		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<!-- icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) -->
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- Load Typekit Font -->
		<script type="text/javascript">
		  (function(d) {
		    var config = {
		      kitId: 'xrf2fnr',
		      scriptTimeout: 3000
		    },
		    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='//use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
		  })(document);
		</script>
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<!-- drop Google Analytics Here -->
		<!-- end analytics -->

	</head>

	<body <?php body_class(); ?>>

		<div class="grid-stamp"></div>


		<div id="container">

			<div class="grid--baseline"></div>

			<header class="header mm-fixed-top" role="banner">

				<div id="inner-header" class="wrap cf">

					<div class="menu-trigger">
						<a class="icon-menu" href="#menu"></a>
					</div>
					<a class="desktop-only menu-trigger__label" href="#menu">Menu</a>


					<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
					<div id="logo" class="header__logo image-replacement">
						<a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a>
					</div>

					<?php // if you'd like to use the site description you can un-comment it below ?>
					<?php // bloginfo('description'); ?>



					<nav id="menu" class="main-menu" role="navigation">
						<?php wp_nav_menu(array(
						'container' => false,                           // remove nav container
						'container_class' => 'menu cf',                 // class of container (should you choose to use it)
						'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
						'menu_class' => 'nav top-nav cf',               // adding custom nav class
						'theme_location' => 'main-nav',                 // where it's located in the theme
						'before' => '',                                 // before the menu
	        			'after' => '',                                  // after the menu
	        			'link_before' => '',                            // before each link
	        			'link_after' => '',                             // after each link
	        			'depth' => 0,                                   // limit the depth of the nav
						'fallback_cb' => 'bones_main_nav_fallback'      // fallback function
						)); ?>

					</nav>

				</div> <?php // end #inner-header ?>

			</header> <?php // end header ?>
