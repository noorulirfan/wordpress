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
define('DB_NAME', 'mysecondwebsite');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '/t:(x,$O{CyGfx=HF#y}Fv])~ =Ir<PvU/6FIih%!.j=i/V>2`Q:,C,{z#;[eiCt');
define('SECURE_AUTH_KEY',  'hYHIQgdmCI8v@`2Mh=! 8;/^jFbh/le-jHo;&lj*X_4#2J7;3-CC]D{L<<sgXz)V');
define('LOGGED_IN_KEY',    'QtwX:CiTQKmCj({GS7K:)mk|N_TCYyyfF;dnNs!Lpk&G3#R|$5<;aJ9g/rpDEn?`');
define('NONCE_KEY',        '$rBNqB]Oku=nXou$9tXV<sToiC8d<LQm(~sl:MSCCihYZh&TyACO&@|1ekzm1%r.');
define('AUTH_SALT',        'C<Eh+n9yPD&%SZ~JuEq<9mv]Dvnjg{AGry]y+t.dVZncHP4YqKnOqQQ>GE{(s*}`');
define('SECURE_AUTH_SALT', 'wA6h%/H8!3N`0~sClk=jvjAZnYJYRw,=YG.Pok1#7MWo:=BcY_7L:/r()3+h?aX#');
define('LOGGED_IN_SALT',   'fgeHN^?ngr=R)&=4z/:{@]GD<|FR=,]c{CdFtlXmWIcB^uMNSsT cZgJ=6iF,bjW');
define('NONCE_SALT',       'MZisR|xBpn2cb~qP}vB Nci.Bpe8x?]%&,pnJ@djbTMj.-~=n.qg<=6<5%N/e^v=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_four';

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
