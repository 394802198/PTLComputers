<?php

/** Begin: Project Domain
 */
define( 'ROOT_PATH', 'http://localhost' );
/** End: Project Domain
 */

/** Begin: Initialize SESSION
 */
if( ! isset( $_SESSION ) ) session_start();
/** End: Initialize SESSION
 */

/** DATABASE CONFIG
 */
define( 'MY_DATABASE_HOST'  , 'localhost' );
define( 'MY_DATABASE_NAME'  , 'ptlstore' );
define( 'MY_USER_NAME'      , 'root' );
define( 'MY_USER_PASSWORD'  , '' );
define( 'MY_DB_DEBUG'       , 'development' );

/** MAIL SERVER CONFIGURATION
 */
