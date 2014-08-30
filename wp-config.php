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
define('DB_NAME', 'vnptproduct');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'L$&Lq?Jnc+X7zyx0^yGe,[Rh01+9mx0PcU=sQkg8@g.N)-}:*`K=-Hv<Z_1tn)-3');
define('SECURE_AUTH_KEY',  'A^Y:#<|+Q`Q2TuOs:;:_hwa@ACHfJozdtqNS=nUXDPF?M?TnM4SC4K@SQWeE`|u^');
define('LOGGED_IN_KEY',    'Ud[#T!K{r`1Sk@[f7>YMoi4i/R6Q{ne1f21.>n$v>P}WWPIKDT-<8jFD(:,FL$v.');
define('NONCE_KEY',        '7l%,uKZ*_!|+{:G~H[+343P|P_epIB(-$N[[U6<p{/FO5s9DQ_o}tXgHs#)Tt6}t');
define('AUTH_SALT',        'VNIP`K=Y2a+TxWLMeJ4T)Rw8~2rAPuPuy+y^8[5_KN4m-:`s+(Vs#?X7%X{x&3Ox');
define('SECURE_AUTH_SALT', '2wb9m)!Hc[?D/NT~ceDh)j9Nst*+z &WhN-@1|V&M7%BfN~JhJG:I0,|Xdp<;wOa');
define('LOGGED_IN_SALT',   '&.((xw#~YW +Km&=WaM!V.)Ico-ejhk|/<Dd;FK1v)KIU:4T&C/u;E <,B`dSP e');
define('NONCE_SALT',       'K:0][XO<v~8(*OHXH>,>~#MZjE!=Kt4grOk4vY@+-X/O/]^m:OQE}Dh,.H 7_ixv');

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
