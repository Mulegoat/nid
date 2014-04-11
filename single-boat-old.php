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
										<ul>
											<li>
												<a class="openContent icon icon-cross is--active" href="#"></a>
											</li>
<!-- 											<li>
												<a class="closeContent icon icon-cross" href="#"></a>
											</li>
											<li>
												<a class="icon-"></a>
											</li> -->
										</ul>
									</nav>
									<div class="m-all t-all d-all island">

								       	<nav class="m-all t-1of2 d-1of2 shareContent last-col">
								    		<?php echo do_shortcode("[ssba]");?>
								    	</nav>

										<header class="m-all t-all d-all article-header">
									    	<h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>
										</header>
									</div>
									<div class="box-container list island cf">

										<section class="m-all t-all d-all entry-content cf">
											<p><?php the_field('client_brief');?></p>
											<p><?php the_field('project_description');?></p>
										</section>

										<footer class="m-all t-all d-all cf">
											<p class="tags"><?php echo get_the_term_list( get_the_ID(), 'boat_cat', '<span class="tags-title">' . __( 'Class:', 'bonestheme' ) . '</span> ', ', ' ) ?></p>
										</footer>

									<h3 class="h3">Other Yachts</h3>


								        <?php

								        // get the custom post type's taxonomy terms

								        $custom_taxterms = wp_get_object_terms( $post->ID,
								        'category', array('fields' => 'ids') );
								        // arguments
								        $args = array(
								        'post_type' => 'boat',
								        'post_status' => 'publish',
								        'posts_per_page' => -1, // you may edit this number
								        'orderby' => 'rand',
								        'post__not_in' => array ($post->ID),
								        );
								        $related_items = new WP_Query( $args );
								        // loop over query
								        if ($related_items->have_posts()) : ;
								        while ( $related_items->have_posts() ) : $related_items->the_post();
								        ?>
											<article id="post-<?php the_ID(); ?>" <?php post_class('box box--theme3 cf'); ?> role="article" data-id="<?php the_ID(); ?>">

												<div class="box__thumb">
													<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'bones-thumb-360' ); ?></a>
												</div>
												<div class="box__copy">

													<header>
														<h2 class="h3"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
													</header>

													<section>
<!-- 														<p class="box__excerpt"><?php the_excerpt(); ?></p>
 -->													</section>

													<footer class="article-footer">
														<div class="tags"><?php echo get_the_term_list( get_the_ID(), 'boat_cat', '<span class="tags-title">' . __( 'Class:', 'bonestheme' ) . '</span> ', ', ' ) ?></div>
													</footer>
												</div>

											</article>
								        <?php
								        endwhile;
								        endif;
								        // Reset Post Data
								        wp_reset_postdata();
								        ?>

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
				<?php get_footer(); ?>
			</div>

