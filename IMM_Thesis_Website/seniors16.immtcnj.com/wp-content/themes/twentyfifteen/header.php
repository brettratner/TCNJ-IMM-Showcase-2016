<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<script src="https://use.typekit.net/dfj3eyb.js"></script>
	<script>
		try{
			Typekit.load({
				async: true
			});
		}catch(e){

		}
	</script>
	<script>
		function toggleNav(){

				if (document.getElementsByTagName("header")[0].className == "toggleNav") {
					document.getElementsByTagName("header")[0].className = "";
					document.getElementById("toggle").innerHTML = '<i class="fa fa-bars fa-3x"></i>';
				} else {
					document.getElementsByTagName("header")[0].className = "toggleNav";
					document.getElementById("toggle").innerHTML = '<i class="fa fa-times fa-3x"></i>';
				}

		}
	</script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<header>
	<a href="http://seniors16.immtcnj.com/">
		<img src="http://seniors16.immtcnj.com/wp-content/themes/twentyfifteen/showcase_logo.png" />
	</a>
	<div class="navigation">
  		<ul class="links">
			<li class="selected">
				<a href="http://seniors16.immtcnj.com/">Home</a>
			</li>
			<li>
				<a href="http://seniors16.immtcnj.com/students/">Students</a>
			</li>
			<li>
				<a href="#">Schedule</a>
			</li>
			<li>
				<a href="#">Sponsors</a>
			</li>
			<li>
				<a href="#">Contact</a>
			</li>
		</ul>
	</div>
	<div id="toggle" onclick="toggleNav();">
		<i class="fa fa-bars fa-3x"></i>
	</div>
</header>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyfifteen' ); ?></a>

	<?php
	/* Sidebar
	 ?>

	<div id="sidebar" class="sidebar">
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
				<?php
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif;
				?>
				<button class="secondary-toggle"><?php _e( 'Menu and widgets', 'twentyfifteen' ); ?></button>
			</div><!-- .site-branding -->
		</header><!-- .site-header -->

		<?php get_sidebar(); ?>
	</div><!-- .sidebar -->

	<?php
	*/
	?>

	<div id="content" class="site-content">
