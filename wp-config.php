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
define( 'DB_NAME', 'ctcanteen_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         ' dU&-V`!.xlnUS2i{9~rJG:%?Ye?_MiKn?FYv(G_K6a`#k4uTXi[MJ:deCJ7v{2C' );
define( 'SECURE_AUTH_KEY',  '12A9YRG`Kp)y4d0+d]A)(bg^qj4jmfY&d--mM_UcbQ!yM;KJ3my=^.._VrWhKYXY' );
define( 'LOGGED_IN_KEY',    '>5t<! 16M8>jt2g-)/7kcQ<$FJbgh>^>sIs?&>w|_V?L-;Jzkc(-VZ9YgyW^{zy@' );
define( 'NONCE_KEY',        'ZOq:Ur5co{OFMzKDm1,z] FIjCMk?:-vM;y: !e9Y{IDw>o`iTeO>^B6v+RC4!BK' );
define( 'AUTH_SALT',        'YjdFe{~G1edsStC*C[&j$ hIp3o4N|HxNoD-`GEkN8<^q|7Q%XwzC9)eDpwx>Bf#' );
define( 'SECURE_AUTH_SALT', 'y%5iwr?i@f<}Cwf=K01TSjX*z&ZchxMD<m.sSrGM,b+D{l&j5?&Yz%3GqMm~`4`}' );
define( 'LOGGED_IN_SALT',   '] J]+m3&KQ|oa{e#F:uC%R8^a6ch;/!-4/&Ecwy3i]?NE0E:nDkb+ `$oKn]fUaW' );
define( 'NONCE_SALT',       '!?(e%rdH$Y03J[Cju>O8cOwt~PBwn?(?NTkzZm%17`c2Rz+6> 5q`2JDTZ(^<ze2' );

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
