<?php
/**
 * Template Name: Students Page
 *
 * This is the template for the students page.
 *
 * Author: Brian Passafaro
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main homepage" role="main">
		<div class="row">
			<div class="container">
				<div class="col-xs-12">
					<p align="center"><span style="text-align: center;font-size: 50px;">Students</span></p>
				</div>
				<div class="col-xs-12">
					<?php echo do_shortcode("[post_grid id='127']"); ?>
				</div>
			</div>
		</div>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
