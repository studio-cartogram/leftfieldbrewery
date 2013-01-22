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
define('DB_NAME', 'lfb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'w(0JGA3[O+VoI>6H.+J8sFMPVN9+;&uX%2+~s0V8SL_Ri+xx8Iow!?Ylg$obLv6I');
define('SECURE_AUTH_KEY',  'e^E0toozZE@P[!d^B>VEVu|=MOZ$D )D|Nt!`EO$xlvv{ZTW.?SS#V`xWP,*!~5F');
define('LOGGED_IN_KEY',    'FvVLRq(P6F$+5PwB214SA>6G/=_Y*Qtwxv%+C{b~ee-~%cIwz #J&e$1H#,Aa4Vs');
define('NONCE_KEY',        'D+}6I~:};s)R]4uAq:/_*bc)8e%NRy) RhRuZ$`e, SbSqhSv{LA}]U<9FO*U`iQ');
define('AUTH_SALT',        '0;@D>V;r~H55*.kJh6};c<cQa$E?!cA!+&xr-#C,.N`rk}14<e,lXKx06rC|2-0f');
define('SECURE_AUTH_SALT', 'Pzo|1U8a$3,O=M)D9,t=j_F~U@g0&=u3)5G[SEyYw4a$jt/th^Ds%AcB.m1#8kxV');
define('LOGGED_IN_SALT',   'lF`E;{lOEIrJYM~a-$-#d`upX42QE~P@cns<KbDA4P- w~Ut11Xe<?q[={l^c}^]');
define('NONCE_SALT',       'zfDsvja=?AQNNSV8+*K%k1dgvJ1s8*B@ah5~j?jS]& TEC6F=RH!=ee{nW/UY[&q');

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
