<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div style="overflow:hidden;">
			<div class="social-navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'social' ) ); ?>
			</div>
			<!--
				<div style="display:block;float:left;position:relative;">
					<p>The College of New Jersey,</p>
					<p>AIMM building</p>
					<p>2000 Pennington Road,</p>
					<p>Ewing, NJ 08628</p>
				</div> -->
			</div>
			<!--
			<div style="display:inline-block;float:right;">
				Copyright &#169; 2016 IMM
			</div> -->
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
