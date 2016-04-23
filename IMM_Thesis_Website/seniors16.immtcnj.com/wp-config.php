<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/seniors16_admin/seniors16.immtcnj.com/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'seniors16_immtcnj_com');

/** MySQL database username */
define('DB_USER', 'seniors16immtcnj');

/** MySQL database password */
define('DB_PASSWORD', 'w62FGu8t');

/** MySQL hostname */
define('DB_HOST', 'mysql.seniors16.immtcnj.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '3a2wj67EEAL;6T+~V8/!Rmx5"IgC3"N8T?qbQnY"a2xhWmvGxa;8O0Y1N&3wFPMs');
define('SECURE_AUTH_KEY',  ';kRfm!ry+);3T|dO6F^0dCMjmDw3#QHM:^N38FA^qvrT(917!Atx8Qx*)@#QvoP@');
define('LOGGED_IN_KEY',    '4%7hY)5HzI@v460"0Tl9K^tkvP9@S&HSMnG(@@s/Lf(f`;c3r)*5@HgNzzmCdJ5y');
define('NONCE_KEY',        'WiciQz7cr3aX*oa"5TZfZM0/rkJw$K/3/+kcqUofQ;LTpm&Y!Rn)0wm_r(Lb#@f7');
define('AUTH_SALT',        '$*f)F*Gck@UiupIMI%ti7I;I60tshYtoEg9Y3H8!7ajQ(""PKW$HDGZ|~q9ll5+d');
define('SECURE_AUTH_SALT', 'o`yJQMyp`pCrKw_B(g~0n2*JOf#HI&HNV0pZj(DF@R3dHeAEjpd(liEQ@CHZ6wy7');
define('LOGGED_IN_SALT',   'TO3tkAfe$_g3YO4#F;#6B$cY~f$u!L&pFkb72VD?r)f_kN*LdQ$vZLa2bqMc3sdj');
define('NONCE_SALT',       '_f@p^3(|e!n(NZ#5l^PWI5glh5`e#B?17&mi7U7`^UgI_n@S~hm0p"8/A3I|t7a|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_mir8tm_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

