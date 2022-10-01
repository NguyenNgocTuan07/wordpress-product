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

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', '' );


/** Database hostname */

define( 'DB_HOST', 'mariadb:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


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

define( 'AUTH_KEY',         'wI6(_p!4Rc] f;URAWb  m(zpB`95D#C[cED5(#+$KGb-g@AwX6ZoW >s7i4ISNk' );

define( 'SECURE_AUTH_KEY',  ',_Mb(.z7n{I5SVCD_US!QXnlL+&-zdGNMd!4KQ_<rD{bKZx0hitC6obH1[f8`T%&' );

define( 'LOGGED_IN_KEY',    'so=GK8U!Df89.D=sq0L2F*7N`XYKo6j*XI!JkGlJqJ5wn5pWJM5zA{@$:S[Nm5;L' );

define( 'NONCE_KEY',        'z2b,^fF/|j=[jV<K)V<`$yux P7+yO^? {kFzf.i`S0T@?$);D]txoMd=Fu%u3!i' );

define( 'AUTH_SALT',        '6qbmCcJ7r,eW:76[b32~Z~Wt}M ~Qp*2U$pqZ5kFeT^M>+*RB@ZJJbxjvkN?2CiL' );

define( 'SECURE_AUTH_SALT', '$?fVGkxpEs;L&?6A9YCBT+L iT4y>!,vpP/.g6do!peB7GfF%cyU ~-f/eu~y9f?' );

define( 'LOGGED_IN_SALT',   'ZP;yerM3^(F.Cy8769q<xkK;HrdSjKpS4]/]j--qaglN[GwQw?d+TD_&5i5GkrnM' );

define( 'NONCE_SALT',       '^8Q(S=$5TlBh-+u^q!(ZXJUf+8J:,r@||3ln.qi_Pl(~a6jWXT+>;/.0(@kI<b}A' );


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




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', false );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
