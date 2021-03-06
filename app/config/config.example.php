<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Configuration
 * @author $Author$
 * @version $Id$
 */

/**
 * Set internal encoding to UTF-8.
 */
mb_internal_encoding('UTF-8');

/**
 * Set the time zone.
 */
date_default_timezone_set('Europe/Berlin');

/**
 * Define constant install password.
 */
define('CINNEBAR_INSTALL_PASS', password_hash('Secret', PASSWORD_DEFAULT));

/**
 * Error logging on.
 */
Flight::set('flight.log_errors', true);

/**
 * Add a path to your src directory for autoloading.
 */
Flight::path(__DIR__ . '/../../src');
Flight::path(__DIR__ . '/../../app');

/**
 * Define constant with path to the vendor directory.
 */
define('VENDORS', __DIR__.'/../../vendor/');

/**
 * Setup our database.
 */
R::setup('mysql:host=localhost;dbname=DBNAME', 'UNAME', 'SECRET');
R::freeze(false);
//R::$writer->setUseCache(true);

/**
 * Allow RedBean Cooker Plugin to load beans for compatibility.
 */
RedBeanPHP\Plugin\Cooker::enableBeanLoading(true);

/**
 * Set the path to the default views directory.
 *
 * Your controllers may easily change this back and forth.
 */
Flight::set('flight.views.path', __DIR__ . '/../res/tpl');

/**
 * Set the absolute path to your public directory.
 *
 * Example: http://localhost/path/to/public
 */
Flight::set('full_path', '');

/**
 * Set the absolute path to your media directory.
 *
 * Example: http://localhost/path/to/media
 */
Flight::set('media_path', '/upload');

/**
 * Set the maximum file size for uploads in bytes.
 */
Flight::set('max_upload_size', 2097152);

/**
 * Set the directory where to store user uploaded files.
 */
Flight::set('upload_dir', __DIR__ . '/../../public/upload');

/**
 * Set the default language.
 */
Flight::set('default_language', 'de');

/**
 * Set possible languages.
 */
Flight::set('possible_languages', R::dispense('language')->getEnabled(Flight::get('default_language')));

/**
 * Set the current language.
 *
 * This get changed by our routes if the called url begins with a 2-character iso code.
 */
Flight::set('language', 'de');

/**
 * Sets some template for localization.
 */
Flight::set('templates', array(
    'date' => '%x',
    'time' => '%X',
    'datetime' => '%x %X'
));

/**
 * Setting.
 */
Flight::map('setting', function() {
    return R::load('setting', 1);//setting there can only be one
});

/**
 * Textile.
 */
Flight::map('textile', function($text, $restricted = false) {
    $parser = new Textile('html5');
    return $parser->TextileThis($text);
});

/**
 * Blessed folder.
 */
Flight::map('blessedfolder', function() {
    return R::load('domain', Flight::setting()->blessedfolder);//
});

/**
 * Sites folder.
 */
Flight::map('sitesfolder', function() {
    return R::load('domain', Flight::setting()->sitesfolder);//
});

/**
 * Blessed folder.
 */
Flight::map('basecurrency', function() {
    return R::load('currency', Flight::setting()->basecurrency);
});

/**
 * Sets a locale category according to the current language.
 */
Flight::map('setlocale', function($category = LC_TIME) {
    return setlocale($category, Flight::get('language').'_'.strtoupper(Flight::get('language')).'.UTF-8');
});

// There shall be non url rewriter and session id gets handled by cookies only
ini_set('url_rewriter.tags', '');
ini_set('session.use_trans_sid', '0');
ini_set('session.use_cookies', '1');
ini_set('session.use_only_cookies', '1');

/**
 * Define the maximum session lifetime in seconds.
 */
define('MAX_SESSION_LIFETIME', 14400); // 4 hours

$sessionhandler = new Sessionhandler_Database();
session_set_save_handler(array($sessionhandler, 'open'),
                         array($sessionhandler, 'close'),
                         array($sessionhandler, 'read'),
                         array($sessionhandler, 'write'),
                         array($sessionhandler, 'destroy'),
                         array($sessionhandler, 'gc'));
register_shutdown_function('session_write_close');

/**
 * Set the session name.
 *
 * If you have changed session parameter or handling in a new release change
 * the session name to ensure that older sessions are no longer used.
 */
session_name('CINNEBARv1');