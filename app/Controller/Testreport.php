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
 * Test Profile controller.
 *
 * The test report controller takes care of all things that come up when a logged user files a report.
 *
 * @package Domaato
 * @subpackage Controller
 * @version $Id$
 */

class Controller_Testreport extends Controller
{

    /**
     * Container for beans to browse.
     *
     * @var array
     */
    public $records = array();

      /**
     * Holds a instance of the bean to handle.
     *
     * @var RedBean_OODBBean
     */
    public $record;

     /**
     * Instatiate a TestProfile controller.
     *
     * A session is started and the testprofile environment is set up.
     */
    public function __construct()
    {
        session_start();
        Auth::check();
    }

     /**
     * Renders a users profile page 
     *
     * In order to view a profile, users must be logged in
     * otherwise user is forwarded to the login page.
     */

    public function index()
    {

        Permission::check(Flight::get('user'), 'report', 'index');

        $current =  Flight::get('user')->current();
        $id = $current->id; 

        $this->layout = 'index';
        $this->render();

    }


 /**
     * Renders a page where user writes a report on a certain business.
     *
     * @param int $person_id The id of the person bean to attach a report to
     */

    public function add($person_id)
    {
      
        Permission::check(Flight::get('user'), 'report', 'addreport');
        $this->action = 'add';
        if (! isset($_SESSION['report_id'])) {
            $_SESSION['report_id'] = 0;
        }
        $this->record = R::load('report', $_SESSION['report_id']);
        $this->record->person = $person = R::load('person', $person_id);
        if (Flight::request()->method == 'POST') {
            $this->record = R::graph(Flight::request()->data->dialog, true);
            $this->record->person = $person;
            $this->record->user = Flight::get('user');
            R::begin();
            try {
                R::store($this->record);
                $this->record->broadcast();
                R::commit();
                $this->notifyAbout('success');
                $this->redirect("/testprofile");
            } catch (Exception $e) {
                error_log($e);
                R::rollback();
                $this->notifyAbout('error');
            }
        }
        $this->layout = 'addreport';
        $this->google_maps = false;
        $this->render();

    }

    /**
     * Renders a domaato report page.
     */
    public function render()
    {

        Flight::render('domaato/shared/notification', array(
            'record' => $this->record
         ), 'notification');
         //
         Flight::render('domaato/shared/navigation/account', array(), 'navigation_account');
         Flight::render('domaato/shared/navigation/main', array(), 'navigation_main');
         Flight::render('domaato/shared/navigation', array(), 'navigation');
         Flight::render('domaato/shared/header', array(), 'header');

        Flight::render('testreport/' . $this->layout, array(
            'language' => Flight::get('language'),
            'record' => $this->record,
            'records' => $this->records
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('test_report_' . $this->layout),
            'language' => Flight::get('language')
        ));


    }
    


}