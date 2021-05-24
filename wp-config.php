<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'vkapsit' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Cd:w;j[p]>oLN4^~s^@gx%bk&N7/,K:z]T1kp@}X$Rr!NCpUxJ;|G(p]viM_N2B%' );
define( 'SECURE_AUTH_KEY',  ')KnY-oG>IV2Wuzr8|TGzI)~{H}NUyJXsWV;YLR]9%7{8`sbjc,O<JO2~;k&0Tnn ' );
define( 'LOGGED_IN_KEY',    'mYPSNg*jJ?@Xn>PE}2sMoi@/lK0/jKSy%nD$U||[CnwBF~K4stAGzZdz`3(P38u|' );
define( 'NONCE_KEY',        'F<bU#wW]@c+&;(XF/uaj/2sd3(IY=MrTkfaPtlV0B35>kpeQ]aDKZef8O}DK]]Dm' );
define( 'AUTH_SALT',        '-=xsKYAk]sd8xqS]1ruh<Q :q`H:5~Wg[dA]D`Z3mw!UF2&M%!]-#/K~lj,{<;QS' );
define( 'SECURE_AUTH_SALT', 'z`@?fC9?P8^Q7!6Q2g#k?Vbg&,+r<fi{jShmh_J?w}QF>dFb U59>+oLT`lRR5))' );
define( 'LOGGED_IN_SALT',   'ulxF1^:]vEyxIF8v6U+N4^3tS (ZG~l|N]V6dvgMHegv:%0)*UBHo*vG=i-s-~iW' );
define( 'NONCE_SALT',       '3x_8b0jS>-|pG)_Q/#<?;?LB1rv[WL^P?9fP6d-B.@vIn LGA}M%,9d nbR>/Z_4' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
