<?php
/*
Template Name: Contact Us
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="inner-page cf">

				    <div id="main" class="m-all t-all d-all cf" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					    <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">



<!-- 								<div class="m-all t-1of2 d-1of2 cf">
								<div class="cf">
									<h3 class="h2">Fill out the form below</h3>
									<?php //gravity_form(1, false, false, false, '', true); ?>
								</div>
							</div> -->

							<div class="m-all t-1of3 d-1of3 cf">


								<div class="address-container box--theme3 cf">

									<header class="cf">

										<h1 class="h1 page-title"><?php the_title(); ?></h1>

									</header> <?php // end article header ?>

									<ul class="m-all t-all d-all cf first company-info">
										<li class="company-info__item">
											<span class="company-info__icon icon-location"></span>
											<span class="company-info__item--address--name">Nigel Irens Design,</span>
											<span class="company-info__item--address">Tanners Yard House,</span>
											<span class="company-info__item--address">Ashburton,</span>
											<span class="company-info__item--address">Devon,</span>
											<span class="company-info__item--address">TQ13 7DD</span>
										</li>
										<li class="company-info__item"><span class="company-info__icon icon-phone"></span><a target="_blank" href="tel:01364653503">+44 (0)1364 652 554</a></li>
										<li class="company-info__item"><span class="company-info__icon icon-envelop-opened"></span><a href="mailto:<?php echo get_option('admin_email'); ?>">Via Email</a></li>
									</ul>

								    <div class="m-all t-all d-all cf first">
								    	<a class="button" target="_blank" href="https://www.google.com/maps/dir//Tanners+Yard+House,+St+Lawrence+Ln,+Ashburton,+Newton+Abbot+TQ13+7DD,+UK/@50.5137175,-3.7894676,13z/data=!4m8!4m7!1m0!1m5!1m1!1s0x486d0272b2356c3f:0x9af698e9edf7d2df!2m2!1d-3.7549202!2d50.5150271">Get Directions ></a>
								    </div>

								</div>
							</div>


						    <section class="entry-content m-all t-2of3 d-2of3 cf" itemprop="articleBody">


								<div id="map" class="map-container first">

									<div id="locationMap">
										<?php echo do_shortcode( "[mapsmarker marker='1']" ); ?>
									</div>

								</div>

							    <?php the_content(); ?>




							</section> <!-- end article section -->

						    <footer class="article-footer">

							    <?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>

						    </footer> <!-- end article footer -->


					    </article> <!-- end article -->

					    <?php endwhile; else : ?>

    					    <article id="post-not-found" class="hentry cf">
    					    	<header class="article-header">
    					    		<h1><?php _e("Oh Dear...", "bonestheme"); ?></h1>
    					    	</header>
    					    	<section class="entry-content">
    					    		<p><?php _e("Nothing to see here!", "bonestheme"); ?></p>
    					    	</section>
    					    	<footer class="article-footer">
    					    	    <p><?php _e("Try going back to the previous page.", "bonestheme"); ?></p>
    					    	</footer>
    					    </article>

					    <?php endif; ?>

    				</div> <!-- end #main -->


				</div> <!-- end #inner-content -->

				<?php get_footer(); ?>

			</div> <!-- end #content -->

