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

						<div class="heroContent_desktop slider cf">
							<?php $shortcode = get_field('category_slider'); echo do_shortcode ($shortcode);?>
						</div>

						<?php //get_sidebar(); ?>

				</div>
				<?php get_footer(); ?>

			</div>

