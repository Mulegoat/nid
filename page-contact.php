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
											<span class="company-info__item--address--name"><?php the_field('company_name'); ?></span>
											<span class="company-info__item--address"><?php the_field('address_1'); ?></span>
											<span class="company-info__item--address"><?php the_field('address_2'); ?></span>
											<span class="company-info__item--address"><?php the_field('address_3'); ?></span>
											<span class="company-info__item--address"><?php the_field('address_4'); ?></span>
										</li>
										<li class="company-info__item"><span class="company-info__icon icon-phone"></span><a target="_blank" href="<?php the_field('telephone_link'); ?>"><?php the_field('telephone_number'); ?></a></li>
										<li class="company-info__item"><span class="company-info__icon icon-envelop-opened"></span><a href="mailto:<?php echo get_option('admin_email'); ?>">Via Email</a></li>
									</ul>

								    <div class="m-all t-all d-all cf first">
								    	<a class="button" target="_blank" href="<?php the_field('directions_link'); ?>">Get Directions ></a>
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

