<?php
/*
This is the custom post type taxonomy template.
If you edit the custom taxonomy name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom taxonomy is called
register_taxonomy( 'shoes',
then your single template should be
taxonomy-shoes.php

*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="inner-page cf">

					<div id="main" class="m-all t-all d-all island cf" role="main">

						<header class="archive-header">
							<h1 class="archive-title h1">Boat Class: <?php single_cat_title(); ?></h1>
						</header>

						<div class="container-fluid">
							<div class="row">
								<div class="m-all t-all d-all">
									<div class="row portfolio-full-width ">
										<div id="portfolio-projects" class="no-sortable grid-portfolio">
											<ul id="projects">

											<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

												<li class="item-project m-all t-1of3 d-1of3 w-1of4 cf characters">
													<div class="item-container">
														<div class="hover-wrap">
															<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
																<a class="project-link" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"></a>
																<a class="box__thumb" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'bones-thumb-360' ); ?></a>
																<header class="project-name">
																	<div class="va">
																		<div class="project-title">
																			<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
																			<div class="project-excerpt"><?php the_field('project_description'); ?>
																				<div><a class="button--theme1" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><span class="icon-arrow-right"></span></a></div>
																			</div>

																		</div>
																	</div>
																</header>
															</article>
														</div>
													</div>
												</li>

											<?php endwhile; ?>

											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>

						<?php if ( function_exists( 'bones_page_navi' ) ) { ?>
								<?php bones_page_navi(); ?>
						<?php } else { ?>
								<nav class="wp-prev-next">
									<ul class="cf">
										<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
										<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
									</ul>
								</nav>
						<?php } ?>

						<?php else : ?>

								<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the taxonomy-boat_cat.php template.', 'bonestheme' ); ?></p>
									</footer>
								</article>

						<?php endif; ?>

					</div>

					<?php //get_sidebar(); ?>

				</div>
				<?php get_footer(); ?>

			</div>

