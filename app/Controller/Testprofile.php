<?php
/**
 * Domaato.
 *
 * @package Domaato
 * @subpackage Controller
 * @author $Author$
 * @version $Id$
 */

/**
 * Profile controller.
 *
 * The report controller takes care of all things that come up when a logged user files a report.
 *
 * @package Domaato
 * @subpackage Controller
 * @version $Id$
 */

class Controller_Testprofile extends Controller
{
    /**
     * Container for javascripts to load.
     *
     * @var array
     */
    public $javascripts = array(
    );

    /**
     * Holds the base url.
     *
     * @var string
     */
    public $base_url;

     /**
     * Holds the type of the bean(s) to handle.
     *
     * @var string
     */
    public $type;

      /**
     * Holds the id of the bean to handle.
     *
     * @var int
     */
    public $id;

     /**
     * Holds possible actions.
     *
     * @var array
     */
    public $actions;

     /**
     * Holds the name of the layout to use.
     *
     * @var string
     */
    public $layout;

    /**
     * Holds a instance of the bean to handle.
     *
     * @var RedBean_OODBBean
     */
    public $record;

     /**
     * Holds a instance of a filter bean.
     *
     * @var RedBean_OODBBean
     */
    public $filter;

      /**
     * Holds the total number of beans found.
     *
     * @var int
     */
    public $total_records = 0;

    /**
     * Container for selected beans.
     *
     * @var array
     */
    public $selection = array();
    
    /**
     * Holds the current page.
     *
     * @var int
     */
    public $page = 1;

    /**
     * Holds the current order index.
     *
     * @var int
     */
    public $order = 0;

    /**
     * Holds the current sort dir(ection) index.
     *
     * @var int
     */
    public $dir = 0;

    /**
     * Container for order dir(ections).
     *
     * @var array
     */
    public $dir_map = array(
        0 => 'ASC',
        1 => 'DESC'
    );

    /**
     * Holds a instance of a Pagination class.
     *
     * @var Pagination
     */
    public $pagination;

    /**
     * Container for beans to browse.
     *
     * @var array
     */
    public $records = array();

    /**
     * Boolean wether to load google maps code or not.
     */
    public $google_maps = false;

     /**
     * Holds the template to render.
     *
     * @var string
     */
    public $template;

    /**
     * Instatiate a report controller.
     *
     * A session is started and the report environment is set up.
     */
    public function __construct()
    {
        session_start();
        Auth::check();
        $this->template = 'testprofile/index';
    }

    /**
     * Renders a page where users may choose or search a business to report on.
     *
     * In order to file a report
     * user must be logged in
     * otherwise user is forwarded to the login page.
     */
  
     /**
     * Renders a page to view the user's profile (person bean).
     *
     * @param int $id The id of the person bean to load
     */

    public function index($id)
    {
      $current =  Flight::get('user')->current();
      $id = $current->id; 
      //$this->redirect('/profile/'.$id.''); 
      $this->records = R::findAll( 'report', 'WHERE user_id = '.$id.'');
      $this->records = array_values($this->records);
      $this->layout = 'index';
      $this->render();
    }

    /**
     * Renders a page where user reviews a report.
     *
     * @param int $report_id The id of the report bean
     */
    public function show()
    {
      Permission::check(Flight::get('user'), 'report', 'usertestreports');

      $this->layout = 'usertestreports';
      $this->render();
    }
    
     /**
     * Displays page to add a new bean of given type.
     *
     * On a GET request a form is represented that has to be filled in by the client. On a POST
     * request a new bean is created and the client is redirected to a choosen next url.
     *
     * @param string $layout
     */
    
    /**
     * Renders the profile page.
    */

    public function render(){

        Flight::render('domaato/shared/notification', array(
            'record' => $this->record
         ), 'notification');
         //
         Flight::render('domaato/shared/navigation/account', array(), 'navigation_account');
         Flight::render('domaato/shared/navigation/main', array(), 'navigation_main');
         Flight::render('domaato/shared/navigation', array(), 'navigation');
         Flight::render('domaato/shared/header', array(), 'header');
         Flight::render('testprofile/usertestreports', array(
            'record' => $this->record, 
            'records' => $this->records
         ), 'usertestreports');
         Flight::render('testprofile/' . $this->layout, array(
            'language' => Flight::get('language'),
            'record' => Flight::get('user'),
            'records' => $this->records
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('test_report_' . $this->layout),
            'language' => Flight::get('language')
        ));


    }

}