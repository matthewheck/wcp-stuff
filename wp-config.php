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
define('DB_NAME', '');

/** MySQL database username */
define('DB_USER', '');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '');

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
define('AUTH_KEY',         '.?$c+6>m-p(bZD6g@l QG+ gPEFz+@&|E|JcdWB;Q01]vSYx;fnf?`I,YMQlJ+/A');
define('SECURE_AUTH_KEY',  'Bx$EW^KoYA%OVW38ko../`[A.bC,pzU<*/7;jn}CWtK<|[y>N{aZ[rynVRvc#f!(');
define('LOGGED_IN_KEY',    ' W9O(-Dx|R=Aa-`5`a_BGlL,% di]SrsX!y==izC5s5v]YFoq/(E-L(xm?_opAdk');
define('NONCE_KEY',        ';DzO}[%Mn:Xt<iJ:Ij(g>*LK>6bH_Esj1)kTd7~TMZ+m1&bC3a2)[4,vu#K8NWPx');
define('AUTH_SALT',        '0& Pl?8)4gbW*K1)Y<|[!)dF[p+JRjh3W+g&~/2{M:>,8XTkqfpq_O8*.&J>{0w7');
define('SECURE_AUTH_SALT', '=pY$J9pFRUv5an+x]pz?[O|xW%;F!`Fn~ c0>~^CU^l#h3g-oK><e+&|(4dqoj/:');
define('LOGGED_IN_SALT',   'I@g5NfvO--f|ol_1@:Z?4$I}1pi!~dkAx-t8r.RMWW3R}A}yh2O;8d^$nITB]xmG');
define('NONCE_SALT',       '7*yX3!FmgG+[YT=(d ,)C`I?RtwV|-n;]o:u.y!-(9kNQ|1=L3ZA|_:k-%V;&oB|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
