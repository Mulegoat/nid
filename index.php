<?php get_header(); ?>

			<div id="content" class="wrap">

				<div id="inner-content" class="inner-page cf">

					<div id="main" class="m-all t-all d-all cf" role="main">

						<article class="cf" role="article">

							<div class="scrollButtons">
								<a href="#" class="scrollNav__list__item__link nextSection icon-arrow-up"></a>
								<a href="#" class="scrollNav__list__item__link prevSection icon-arrow-down"></a>
							</div>

							<div class="m-all t-all d-all cf">

								<?php if(get_field('home_section', 'option')): ?>

									<?php while(has_sub_field('home_section', 'option')): ?>

									<div class="m-all t-all d-all block">
										<div class="section-<?php the_sub_field('section_number');?>">
											<div class="slider__img"><img class="wp-post-image" src="<?php the_sub_field('section_image'); ?>"></div>
											<div class="box--theme1 heroHeader">
												<h1 class="h1 slide-title">
													<a class="header-link" href="<?php the_sub_field('section_link'); ?>"><?php the_sub_field('section_title');?></a>
												</h1>
												<p class="slide-excerpt"><?php the_sub_field('section_excerpt');?></p>
												<p><a class="button--theme1" href="<?php the_sub_field('section_link'); ?>"><span class="button__label">Read More</span> ></a></p>
											</div>
										</div>
									</div>

									<?php endwhile; ?>



								<?php endif; ?>

							</div>

<!-- 							<div id="heroContent_mobile" class="slider cf">
								<?php echo get_new_royalslider(6); ?>
							</div>
							<div class="mobile-only cf">
								<p>Over the past three decades we’ve been privileged to be involved at the cutting-edge of Offshore <a href="http://www.nigelirens.com/yacht-categories/racing-boats">Racing Multihull</a> development.</p>
								<p>Just as exciting to us, though, is applying some of the slippery technology to all kinds of other vessels – both <a href="http://www.nigelirens.com/yacht-categories/sail-boats">sail</a> and <a href="http://www.nigelirens.com/yacht-categories/power-boats">power.</a></p>
								<p>If you would like to know more about who we are and what we do, please <a href="contact">contact us</a>.</p>
							</div> -->

						</article> <?php // end article ?>

					</div> <?php // end #main ?>

					<?php //get_sidebar(); ?>

				</div> <?php // end #inner-content ?>

				<?php get_footer(); ?>

			</div> <?php // end #content ?>

