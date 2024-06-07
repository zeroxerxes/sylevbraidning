<?php
define( 'WP_CACHE', true );




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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'stylxmtx_wp817' );

/** Database username */
define( 'DB_USER', 'stylxmtx_wp817' );

/** Database password */
define( 'DB_PASSWORD', '3Sg[pF]RN!c]H9)3' );

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
define( 'AUTH_KEY',         'wfgoq1kqsrbnk4iuuagp3nmammiwlwyki2m3dbvplg5guqpgbkhstgk0xiv27phh' );
define( 'SECURE_AUTH_KEY',  'qg64fxyi2cjwgz5f0she7jjtlrcj0h8pfdcaj11wxz0dgfakj8dedz5zyrj762oq' );
define( 'LOGGED_IN_KEY',    'eazhquu2vknuk0g2qc1ckpb2tknedklistimc9auen7sdyxjvxyl4spufjwikpph' );
define( 'NONCE_KEY',        '6lqwwxj3e1iptvqg7xq6vqr9bir1u0o2n1araso8qryfrcv0awhimq7ncz5zzmnq' );
define( 'AUTH_SALT',        'rm4po6yelslvev4p4der9ko8idgbrhzwquyeaqnjzairphvtpt8gata2g1fd6yzj' );
define( 'SECURE_AUTH_SALT', 'yaak36mdm3wjqnj42uzmvn6w84j4f33fmbowumpxvrkbx9eaoyjtdzpm0xzwqcfk' );
define( 'LOGGED_IN_SALT',   'qj3kyxzlxznfjy7rpxiz6r160oxg2akrxrr3x4z056rmcw3bayt4x92qpvv0aamp' );
define( 'NONCE_SALT',       'tyh6lq3mx2xsrcoj6qdtuv0hzcdiz3q1abstbdkozpn88a115scr9f6zhpmgh735' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp1j_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
