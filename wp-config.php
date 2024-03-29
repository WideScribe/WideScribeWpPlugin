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
define('DB_NAME', 'vxlpay2');

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
define('AUTH_KEY',         '%INcK:`JD:alvg*kZ[k}{rlkYC!n(2_+/R _HI-hl~4d/WyIZH.@Fa?pG|Po!+0h');
define('SECURE_AUTH_KEY',  '&RD]9oP`6ZL.`0bfmrhpml5Z0WF]94+Odq?-w-^Btq5FAkk+VtR !21P/g9/S3j|');
define('LOGGED_IN_KEY',    '%#?ODmlIV&*y|]3*&8rpr -XdrREcg2wR^)/dbW$bu*m$%X|{7/~2&sScw*07=@g');
define('NONCE_KEY',        '+QF@{:v-L@ol1-|4>c)]-;rB1l/>8Xc^!p:eQIX<eD,I2|+>)h!.*dkK,Me3F7ig');
define('AUTH_SALT',        'T=@>EZ1|@~m(xT<LW#,+%8F6;gxlNtpV,eh0ma}+|Ov^!&Zlk}TR46^:2BjjLwY+');
define('SECURE_AUTH_SALT', '|7-KOJSJA#|>S8-pM%L`]EhkH7jJfF[;tW|f` K,DzaG%y-hr /&Z)8H)CSDYeE+');
define('LOGGED_IN_SALT',   '!33+7TH`~|T:(>TnZ(S|R2bRSc(xV)r? Wt&:&PF&dYgbzlP WuK$BM$yb(>F uv');
define('NONCE_SALT',       ';w[$uLw7@d}?F9Ud}ET]|0.4ZyZ]EWU^Zxzf2kxG}^rv,@Q3f*tt:cJy.Mq:BWDm');

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
define('WP_DEBUG', true);

define( 'WP_DEBUG_DISPLAY', true );
define('WP_DEBUG_LOG', true);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
