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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/stock/public_html/blog/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'stock_blog');

/** MySQL database username */
define('DB_USER', 'stock_bloguser');

/** MySQL database password */
//define('DB_PASSWORD', '8i_bSBW]*!fN');
define('DB_PASSWORD', '^fpmC~onmSwg');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('DISALLOW_FILE_EDIT', TRUE); // Sucuri Security: Thu, 23 Jul 2015 06:06:03 +0000


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '9k+f?xp$LC;i?<QzfMq4-/UQ_A0d{b4(UwAn^Bp?|UrQIOrG|ry-Zju9++/S9eFI');
define('SECURE_AUTH_KEY',  'n$r5I&Ys|d0,wNqO^yFY>dP6Z} dRdp6g3i Y_.u:$/E2d|0DuN,9o:L`Y{}[cHx');
define('LOGGED_IN_KEY',    'ZbpM%g+~Bt%A2t+`./y-w{&bSm_8+FJ``[++$^>}MwYT*ox@3r]N:rLg+D+:Ap*s');
define('NONCE_KEY',        'N^V{BbvBQ%$49kh#1S$,aou@:N1r~MeJ.$|hL~pc02oD 5=Hz{LQS9T}5:Q$VABN');
define('AUTH_SALT',        'o53s3x,(j>:Oq{&PHMt6-:1!7!J~wC0BGQMN2O,A(lR_;$LkaKd;8f=i:=L/,+5M');
define('SECURE_AUTH_SALT', 'r5a4g|j4;i0kdpy.ZPJQAw|kJT|$M_r[p={-M&Y[aEv|0PtJl)Qc5vDzQbrc`mw<');
define('LOGGED_IN_SALT',   '1E@QsK{es9D-uIk;MAv!GTw0@)^rtfJ/H6;oI}G(i*U^sc^Q+# F.-+*;HA#l! A');
define('NONCE_SALT',       ',_s|OhAD:BO_)TVko<*2*m`Gt=!Ge?e0xbWmt%.>$G)`hC<DlAmE]:c.[Llx1&,b');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'sb_';

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
