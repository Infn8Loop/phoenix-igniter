<?php class MY_Controller extends CI_Controller {

    public function __construct(){ // this runs the constructor function of the parent class. Thereby making this class a CI controller class [code igniter's main controller]
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('test_model');
        $this->load->model('mvvmtoken_model');
        define('MVVM_URL', site_url('MvvmAPI/') );
        define('MVVM_TTL', 900); // seconds that an mmvm token stays alive
    }
    
    // functions and variables declared in this class will be scopeable from anywhere else in the application, if our other controllers extend from here.
    
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

    public function content($view, $data = false, $template_yn = false){
        if($template_yn == true){
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

    protected function mvvm_create($table, $id, $returntype = 'object'){
        define('MVVM_TABLE', $table);
        define('MVVM_RETURN_TYPE', $returntype);
        $this->load->model('mvvm_model');
        $token = bin2hex(openssl_random_pseudo_bytes(64));
        $insert = array(
            'model' => $table,
            'record_id' => $id,
            'token' => $token
        );
        $this->mvvmtoken_model->insert($insert);
        $record = $this->mvvm_model->get($id);
        $mvvm = array(
            'record' => $record,
            'token' => $token
        );
        return($mvvm);
    }

    protected function mvvm_new_record($table, $returntype){
        define('MVVM_TABLE', $table);
        define('MVVM_RETURN_TYPE', $returntype);
        $this->load->model('mvvm_model');
        $token = bin2hex(openssl_random_pseudo_bytes(64));
        $id = $this->mvvm_model->insert(array() );
        $insert = array(
            'model' => $table,
            'record_id' => $id,
            'token' => $token
        );
        $this->mvvmtoken_model->insert($insert);
        $record = $this->mvvm_model->get($id);
        $mvvm = array(
            'record' => $record,
            'token' => $token
        );
        return($mvvm);
    }


}
