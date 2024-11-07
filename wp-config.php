<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bufftz' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'tvSudkenT@7HdLkE' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'yoH](?#V_@*e^*JdiGM~ek:f0z+/HwWUb9y_w;z)>@_$kZC=f?.S6z4dAm&p+-7L' );
define( 'SECURE_AUTH_KEY',  'I.Z_mIVX[uju`%!-7Bn>ubdwH1fw^KlIK1AD>q|b?Qzis}!MtX(/<hhCCi,lkf_]' );
define( 'LOGGED_IN_KEY',    'd:G,8k~38kKr`ot<~6o`7sPO4z:ks}~m}1dX%<21$:5#0!uV3]*D8ra7]zkcP[Pi' );
define( 'NONCE_KEY',        '`av#J4zEWrjzls;s=o7-x6:z|I2qZpST!)Q|VRB{hcI5Pa]{J!o2_G f5zu`b;Xg' );
define( 'AUTH_SALT',        'M]orjH@NIfe}oAM-P]]Gr+8t[^^o|)Gks=!X;Y6Ty!I2m%4o*@AEaI)>][] &.G{' );
define( 'SECURE_AUTH_SALT', 'V9Mz*cJf6STxBSjE$SO-]Oa6Ivs,]lsv*/U9rN{S_q=O(ALx^2*y}8;I>ah@tM/Y' );
define( 'LOGGED_IN_SALT',   'aga7d_3 |*?)b)+V722cKU6U 5LhaF.8C8*k+G`iNv9TXaklxxCKLEy%4&JFLWV#' );
define( 'NONCE_SALT',       'T:dv!U2SOI3O-^~ef?|+zZ1r`aEG|]%=WPs!c&xTUdh$#wT.t$pWG{-*~Jdw~31*' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
