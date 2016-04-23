<?php
/**
 * Template Name: Overview Page
 *
 * This is the template is for listing all the targeted individuals in an organized fashion.
 *
 * Author: Justin Cheng
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() );

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
