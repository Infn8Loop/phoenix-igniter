<?php 
class Test extends My_Controller { // the MY_Controller in the core folder is a controller that you can extend from for all of your controllers.
    
    function __construct(){
        parent::__construct();
    }
    
    public function index(){

        $objectamundo = new stdClass();

        $objectamundo->props = 'Properties';

        $data = array(
            'greeting' => 'hello',
            'planet' => 'world',
            'things' => array('thing1', 'thing2', 'thing3'),
            'obj' => $objectamundo
        );

        // the content method accepts a string for your view file, the data, and true or false to control whether you want to parse with mustache template engine
        // it includes your header and footer file

       $this->content('test', $data, true);


       // the mustache method works identical to the $this->load->view() method, BUT is parses with the mustache template engine

//        $this->mustache('test', $data);

    }

    public function testMvvm(){

        $this->data['mvvm'] =  $this->mvvm_new_record('customers', 'object');

        $this->content('test', $this->data, true);

    }


}