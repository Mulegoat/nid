<?php
/*
This is the custom post type post template.
If you edit the post type name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom post type is called
register_post_type( 'bookmarks',
then your single template should be
single-bookmarks.php

*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="inner-page cf">

					<div id="main" class="m-all t-all d-all cf" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('article cf'); ?> role="article">

							<div id="heroSlider" class="slider">
								<?php $shortcode = get_field('image_slider'); echo do_shortcode ($shortcode);?>
							</div>

							<div id="copyContainer" class="box--theme3">
								<nav class="scrollNav">
									<ul class="scrollNav__list">
										<li class="scrollNav__list__item closeContent is--hidden">
											<span class="scrollNav__list__item__label">Close</span>
											<a class="scrollNav__list__item__link icon icon-cross" href="#"></a>
										</li>
										<li class="scrollNav__list__item openContent">
											<span class="scrollNav__list__item__label">Info</span>
											<a class="scrollNav__list__item__link icon icon-info"  href="#"></a>
										</li>
										<?php
											// get_posts in same custom taxonomy
											$postlist_args = array(
											   'posts_per_page'  => -1,
											   'orderby'         => 'menu_order',
											   'order'           => 'ASC',
											   'post_type'       => 'boat',
											   'post_status'	 =>  'publish'
											   //'your_custom_taxonomy' => 'your_custom_taxonomy_term'
											);
											$postlist = get_posts( $postlist_args );

											// get ids of posts retrieved from get_posts
											$ids = array();
											foreach ($postlist as $thepost) {
											   $ids[] = $thepost->ID;
											}

											// get and echo previous and next post in the same taxonomy
											$thisindex = array_search($post->ID, $ids);
											$previd = $ids[$thisindex-1];
											$nextid = $ids[$thisindex+1];
											if ( !empty($previd) ) {
											   echo '<li class="scrollNav__list__item"><span class="scrollNav__list__item__label">Prev Boat</span><a class="scrollNav__list__item__link icon icon-arrow-left" href="' . get_permalink($previd). '"></a></li>';
											}
											if ( empty($previd) ) {
											   echo '<li class="scrollNav__list__item"><span class="scrollNav__list__item__label">Prev Boat</span><a class="scrollNav__list__item__link icon icon-arrow-left" href="http://www.nigelirens.com/boats/sail-boats/apc78"></a></li>';
											}

											if ( !empty($nextid) ) {
											   echo '<li class="scrollNav__list__item"><span class="scrollNav__list__item__label">Next Boat</span><a class="scrollNav__list__item__link icon icon-arrow-right" href="' . get_permalink($nextid). '"></a></li>';
											}
											if ( empty($nextid) ) {
											   echo '<li class="scrollNav__list__item"><span class="scrollNav__list__item__label">Next Boat</span><a class="scrollNav__list__item__link icon icon-arrow-right" href="http://www.nigelirens.com/boats/power-boats/ilan"></a></li>';
											}
										?>

										<li class="scrollNav__list__item">
											<span class="scrollNav__list__item__label">Contact</span>
											<a class="scrollNav__list__item__link icon icon-envelop" href="mailto:mail@nigelirens.com"></a>
										</li>
									</ul>
								</nav>
								<div class="box-container scroll-pane cf">

									<div class="inner-wrap">

										<header class="cf">

									       	<nav class="m-all t-all d-all shareContent cf">
									    		<?php echo do_shortcode("[ssba]");?>
									    	</nav>

											<div class="cf">
										    	<h1 class="h1 custom-post-type-title"><?php the_title(); ?></h1>
												<p class="tags"><?php echo get_the_term_list( get_the_ID(), 'boat_cat', '<span class="tags-title">' . __( 'Category:', 'bonestheme' ) . '</span> ', ', ' ) ?></p>
												<p class="tags"><?php echo get_the_term_list( get_the_ID(), 'boat-classes', '<span class="tags-title">' . __( 'Class:', 'bonestheme' ) . '</span> ', ', ' ) ?></p>
											</div>

										</header>

										<div class="video--inline">
											<?php the_field('video_link'); ?>
										</div>

										<section class="entry-content cf">

											<div class="project__copy">
												<p><?php the_field('client_brief');?></p>
												<p><?php the_field('photo_attr');?></p>
											</div>

										</section>

										<footer id="relatedArticles" class="cf">

											<h2 class="h2">Related Yachts</h2>

											<div class="container-fluid">
												<div class="row">
													<div class="m-all t-all d-all">
														<div class="row portfolio-full-width ">
															<div id="portfolio-projects" class="no-sortable grid-portfolio">
															<?php // begin custom related loop ?>

															<?php

															// get the custom post type's taxonomy terms

															$custom_taxterms = wp_get_object_terms( $post->ID, 'boat-classes', array('fields' => 'ids') );
															// arguments
															$args = array(
															'post_type' => 'boat',
															'post_status' => 'publish',
															'posts_per_page' => 6, // you may edit this number
															'orderby' => 'rand',
															'tax_query' => array(
															    array(
															        'taxonomy' => 'boat-classes',
															        'field' => 'id',
															        'terms' => $custom_taxterms
															    )
															),
															'post__not_in' => array ($post->ID),
															);
															$related_items = new WP_Query( $args );
															// loop over query
															if ($related_items->have_posts()) :
															echo '<ul id="projects">';
															while ( $related_items->have_posts() ) : $related_items->the_post();
															?>
																<li class="item-project m-all t-1of3 d-1of2 cf characters ">
																	<div class="item-container  ">
																		<div class="hover-wrap">
																			<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
																				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"></a>
																				<a class="box__thumb" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'bones-thumb-360' ); ?></a>
																				<header class="project-name">
																					<div class="va">
																						<div class="project-title">
																							<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
																							<div class="project-excerpt"><?php the_excerpt( '<span class="read-more">' . __( 'Read More &raquo;', 'bonestheme' ) . '</span>' ); ?></div>
																						</div>
																					</div>
																				</header>
																			</article>
																		</div>
																	</div>
																</li>
																<?php
															endwhile;
															echo '</ul>';
															else: echo '<div>There are no related yachts</div>';
															endif;
															// Reset Post Data
															wp_reset_postdata();
															?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</footer>
									</div>
								</div>
							</div>
						</article>

						<?php endwhile; ?>

						<?php else : ?>

						<article id="post-not-found" class="hentry cf">
							<header class="article-header">
								<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
							</header>
							<section class="entry-content">
								<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
							</section>
							<footer class="article-footer">
								<p><?php _e( 'This is the error message in the single-custom_type.php template.', 'bonestheme' ); ?></p>
							</footer>
						</article>

						<?php endif; ?>

				</div>

			</div>

		</div>

		<?php get_footer(); ?>
