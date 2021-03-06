<?php


//******************************************************
define('WP_SITEURL', 'http://p4.linhtruong.com');
define('WP_HOME', 'http://p4.linhtruong.com');
//********************************************************
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
define('DB_NAME', 'db552988739');

/** MySQL database username */
define('DB_USER', 'dbo552988739');

/** MySQL database password */
define('DB_PASSWORD', 'SECRET PASSWORD');

/** MySQL hostname */
define('DB_HOST', 'db552988739.db.1and1.com:3306');

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
define('AUTH_KEY',         '7PK&Pk)y34^u!^%0iWohVirW!IL@%)ABVQnQNY!DKLyr)4)iS^tTJVtxSodf#ada');
define('SECURE_AUTH_KEY',  'jP$3Km#S&lYSICa3BK$(e2boUlN&5(iMIgllV1iKeWGMJmXFU$2Vh2Tx!qB36EKJ');
define('LOGGED_IN_KEY',    'vNG&)Ptb%qm*jC02VH5Hd9Yf2eTb21Fd3uWyGG$NiX#69Qlp@SwTxpHEYKkT2a*r');
define('NONCE_KEY',        'lgDgh^dY9Bs%tKWt*#3OJolfVdCUdtk5!sgM!zVC%BE94s1IekA#6OU9n85)EQuO');
define('AUTH_SALT',        '9zW(ccH^xVRnN$A0^pZ0eS%#*BZcdJR%u^RuUkoIJMR$rKx^8BjRAEG^FqM($)sZ');
define('SECURE_AUTH_SALT', 'drz0wFsbZrA2dpzZwH17pKHOsbrcP)B4No)UNEHcWyP3rvn9SRq4fAtb!fU6i$a5');
define('LOGGED_IN_SALT',   '&Uzlxnt)e4GRzvbu3A5fio#wbek&ErVYBtk9r)r*ZRu*%X83dhZLj7xJMAO!f4LA');
define('NONCE_SALT',       'LNDVVIsVqGxT(ZQZrhsSGx1aMPlZornx9M!tI665jPLt83jiA9sJ5)hKPY0m)2)6');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'CSCIE12_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define ('WPLANG', 'en_US');

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

/** Disable Auto Update. */
define( 'WP_AUTO_UPDATE_CORE', false );