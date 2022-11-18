<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp-curso' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '_~Gt8R{<_qH%_?1oYZLCV:UuYc 83g9/)%08}SUX7`U,UrGd)87TZZKEg3Dyowuo' );
define( 'SECURE_AUTH_KEY',  '5U1T/oZ9SFX,$I RSo/4b0H9CH=XV8(v<jaB}V/!]9;!+w~A2CwXEk`4OF_DAX2^' );
define( 'LOGGED_IN_KEY',    'D[=<.E=7=nD,/EXDSZHHCp1JiLEVgtiz/dl)q!EzXBdy#c3`lEG #qzWOSTU{X^t' );
define( 'NONCE_KEY',        '!s lm;I0Q;zZ}[.W^Y!2M@Z_JA{}6*NT3ICREFbj{>bdd$04lt!{By`%1D&f+X6|' );
define( 'AUTH_SALT',        '/K?# #~f3fU{O]{P_Y=d8: 4 P[>OJ x8!cA2z`(S7SvuHfaXD@NJ_<x^SZ5XE,V' );
define( 'SECURE_AUTH_SALT', 'SdkYV61/J#5V<M24$(l]3*g|9kxe^zN%UmK/1:[M.];e{Zg,jwVD!niYM014yr<o' );
define( 'LOGGED_IN_SALT',   'V%<F]WFUlXS6]e#}&N]Nu2@Sj[n_WLP1-5vyB;CW/60Ja~@7v*[4CTe`;A$@xW&d' );
define( 'NONCE_SALT',       'XqBGd@l]MS!.N%b.!NO{v;KEFapi?eThP=d^-S#8i6 CXg;/Vqy)mr<Ek~G+@dY8' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
