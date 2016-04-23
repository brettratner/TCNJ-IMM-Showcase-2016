<?php
/**
 * Administration Functions
 *
 * This file is deprecated, use 'wp-admin/includes/admin.php' instead.
 *
 * @deprecated 2.5.0
 * @package WordPress
 * @subpackage Administration
 */

_deprecated_file( basename(__FILE__), '2.5', 'wp-admin/includes/admin.php' );

/** WordPress Administration API: Includes all Administration functions. */
require_once(ABSPATH . 'wp-admin/includes/admin.php');

<?php // look to see if we've disabled sidebar in a custom field, if not show it
	$disableSidebar = get_post_meta($post->ID, 'disableSidebar', $single = true);
	if ($disableSidebar !== 'true') { get_sidebar(); }
?>