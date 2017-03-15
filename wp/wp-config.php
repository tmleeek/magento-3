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
define('DB_NAME', 'magento_sawbones');

/** MySQL database username */
define('DB_USER', 'admin');

/** MySQL database password */
define('DB_PASSWORD', 'admin');

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
define('AUTH_KEY',         'v$(Aj%qyBp&`@%>0*$Qe_Drw5$8IZ7)e{vN?@[$juzFGi6&<?Fm[MqHnC+ZcTAfY');
define('SECURE_AUTH_KEY',  '(i|AK Y*^{=u3&k:%X/U<7Q^#2R@f}pjdRF;HQ@#VsxEeuY%2|HKqd_/@*;rdb`*');
define('LOGGED_IN_KEY',    '!RC+dvB_R&OAK0_L9KI gDJ&n (--cr]=(F{KC`irg<HicA:zURy#.s `Q>-=KQf');
define('NONCE_KEY',        'i@tJvY3N0t%68pPf2UKC.2/;UbC 31(tSRR}=Dd0,3zL$(~dX<n!qg*grK8R*#Gi');
define('AUTH_SALT',        ';e4.|kU!*W2Rf0u$RI+Z.{HR;< 1v~(4m{^yhAyyb/5rU*-;Lc]]FlI:<-b=N;l6');
define('SECURE_AUTH_SALT', '`1kw^k3aT*Mt(rlM^om]17sTaYt7l@W6Wot[WTd(R][xRQ]ZJy)`vBpm28(hls>n');
define('LOGGED_IN_SALT',   'qG`}hm]QmC^}NNV|9m/=fjT8R!FR6lz^*R$_Rdx:_W@K%(6MQw(^}E--!O qIFit');
define('NONCE_SALT',       'hQu`wU$@l7d+ -HvEZ=%v4k!w%}o]`i> YSM3GYJ3p>C4+nu9.M:TLJ,K|7shhLL');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
