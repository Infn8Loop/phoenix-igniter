<?php class MY_Controller extends CI_Controller {

    public function __construct(){ // this runs the constructor function of the parent class. Thereby making this class a CI controller class [code igniter's main controller]
        parent::__construct();
        $this->load->helper('url');
    }
    
    // functions and variables declared in this class will be scopeable from anywhere else in the application, if our other controllers extend from here. 
    public function five_test(){
        return 'Five';
    }
    
    public function mustache($view, $data){
        $data['site_url'] = site_url();
        $mustache = new Mustache_Engine;
        $output = $this->load->view($view, $data, true);
        echo $mustache->render($output, $data);
    }

    public function return_mustache($view, $data){
        $data['site_url'] = site_url();
        $mustache = new Mustache_Engine;
        $output = $this->load->view($view, $data, true);
        return $mustache->render($output, $data);
    }

    public function content($view, $data, $mustache){
        if($mustache == true){
            $first = $this->load->view('includes/header', false, true);
            $second = $this->return_mustache($view, $data);
            $third = $this->load->view('includes/footer', false, true);
            echo $first . $second . $third;
        } else {
            $this->load->view('includes/header');
            $this->load->view($view, $data);
            $this->load->view('includes/footer');
        }


    }

}
?>