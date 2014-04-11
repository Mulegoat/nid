<?php
/*
Template Name: Archive Boats
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="inner-page cf">

					<div id="main" class="island m-all t-all d-all cf" role="main">

						<h1 class="h1"><?php post_type_archive_title(); ?></h1>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header>

									<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

								</header> <?php // end article header ?>

								<section class="entry-content cf">

									<?php the_excerpt(); ?>

								</section> <?php // end article section ?>

								<footer>

								</footer> <?php // end article footer ?>

							</article> <?php // end article ?>

							<?php endwhile; ?>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the custom posty type archive template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div> <?php // end #main ?>

						<?php //get_sidebar(); ?>

								</div> <?php // end #inner-content ?>

			</div> <?php // end #content ?>

<?php get_footer(); ?>
