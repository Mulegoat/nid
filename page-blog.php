<?php
/*
 Template Name: Blog Page
*/
?>
<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="inner-page cf">

						<div id="main" class="m-all t-all d-all cf" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="m-all t-all d1of4 cf">
									<h1 class="h1 page-title--news" itemprop="headline"><?php the_title(); ?></h1>
								</header> <?php // end article header ?>

							    <section class="m-all t-all d-2of3 entry-content cf" itemprop="articleBody">

									<?php

									//Return Posts for News
									$args=array(
									  'cat' =>1,
									  'posts_per_page' => -1
									);

									// the query
									$the_query = new WP_Query( $args ); ?>

									<?php if ( $the_query->have_posts() ) : ?>

									  <!-- the loop -->
									  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

											<article id="post-<?php the_ID(); ?>" <?php post_class('m-all t-all d-all box--theme3 cf'); ?> role="article" data-id="<?php the_ID(); ?>">

												<div class="box__thumb m-all t-all d-all">
													<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'bones-thumb-1600' ); ?></a>
												</div>
												<div class="box__copy m-all t-all d-2of3 island">

													<header>
														<h2 class="h1 single-title"><a class="header-link" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
														<p class="byline vcard">Written by <?php the_author(); ?></p>

													</header>

													<section>
														<p><?php the_excerpt();?></p>

													</section>

													<footer class="cf">
														<p><a class="button--theme3" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">Read More ></a></p>
													</footer>
												</div>

											</article>

									  <?php endwhile; ?>
									  <!-- end of the loop -->

									  <?php wp_reset_postdata(); ?>

									<?php else:  ?>
									  <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
									<?php endif; ?>

								</section> <!-- end article section -->


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
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div> <?php // end #main ?>

						<?php //get_sidebar(); ?>

				</div> <?php // end #inner-content ?>

			</div> <?php // end #content ?>

<?php get_footer(); ?>
