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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bannon_cms');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'mysql');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'A2?4|Ixi>W|j:@fzQtzyAT$CE|c,;=NMKtP|#@jrg[~r1t=U_q.F0%_1b^B+?|08');
define('SECURE_AUTH_KEY',  'V`t} N,O<r*jhn<E-d9^K8Cyy12|msEUB{<3;6o+x~6 ([&X<Q(Dssosyn<#ZIi=');
define('LOGGED_IN_KEY',    '.E>8yuX}0 *6z+MVn$D|s,b_0b!K+8_S9m/RqTM+wXg!Qm|N/)knHRtG5hf.6Lp*');
define('NONCE_KEY',        'gvQHxN<]_:$QG:I9Dgr,WRyyi[-E<k_B(FA;.-WJspqqUskIx|&TPNszCrOvx *6');
define('AUTH_SALT',        'nsozNH+@.ukmm)gK&O4(#UI~1OoB-Ml LjBh(l^f&{T~Idb8ks&$DD]ZHv=p?]Oz');
define('SECURE_AUTH_SALT', 'JummUbb{M5|iUv IG)D]U![1M0a@[,J_q22y?-zY|UW?*qJnof>|<_^Jb%9S/`.~');
define('LOGGED_IN_SALT',   '6)SU;#H-Yu0Vh M>,;!>;|:rth+L<<)u%+*eO u=j2z*$U}Tnzap>me-~3|B.~&(');
define('NONCE_SALT',       '}F=h%uvU_j+})^fZF:Gv*<]UkAJ16M&P Cv3 q3Hw a>jRPu(Hw vHZ]dBd.M)5<');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = '9kBj_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
