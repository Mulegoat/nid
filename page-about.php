<?php
/*
 Template Name: About Page
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="inner-page cf">

				    <div id="main" class="m-all t-all d-all cf" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<div class="m-all t-all d-all cf fullScreenBG bgAbout">

									<div class="article-copy">

										<div class="m-all t-1of2 d-2of5 last-col island box--theme7">

									       	<nav class="shareContent m-all t-all d-all cf">
									    		<?php echo do_shortcode("[ssba]");?>
									    	</nav>

											<header class="cf">
												<h1 class="h1 page-title"><?php the_title(); ?></h1>
											</header> <?php // end article header ?>

											<section class="entry-content cf" itemprop="articleBody">

												<?php the_content(); ?>

											</section> <?php // end article section ?>

											<footer class="article-footer">

											</footer> <?php // end article footer ?>
										</div>
									</div>
								</div>
<!-- 								<img class="wp-post-image" src="<?php the_field('main_image');?>"/>
 -->
								<?php //comments_template(); ?>

							</article> <?php // end article ?>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div> <?php // end #main ?>

						<?php //get_sidebar(); ?>

				</div> <?php // end #inner-content ?>

			</div> <?php // end #content ?>

<?php get_footer(); ?>
