<?php class MvvmAPI extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        die('hello');
    }

    public function create(){
        die('create should only be called from the backend.');
    }

    public function read(){
        $post = $this->input->post();

        $where = array(
            'token' => $post['token']
        );
        $mvvm_token = $this->mvvmtoken_model->get($where);

        if(!$mvvm_token || !$mvvm_token->record_id){
            die('No matching token or record Id'); // kills execution if the token doesn't match or there is no record id
        }

        $now = strtotime(date('Y-m-d H:i:s') );
        $tokentime = strtotime($mvvm_token->created_at);

        $diff = ($now - $tokentime);

        if($diff < MVVM_TTL){  // update the record and return the new values that have been recorded if the token is still valid
            define('MVVM_TABLE', $mvvm_token->model);
            define('MVVM_RETURN_TYPE', 'object');
            $this->load->model('mvvm_model');

            $record = $this->mvvm_model->get($mvvm_token->record_id);
            $output = array(
                'status' => 'success',
                'record' => $record
            );

        } else { // if the token has expired
            $output = array(
                'status' => 0,
                'message' => 'You cannot read the data'
            );
        }

        echo json_encode( $output);
    }

    public function update(){
        $post = $this->input->post();

        $where = array(
            'token' => $post['token']
        );
        $mvvm_token = $this->mvvmtoken_model->get($where);

        if(!$mvvm_token || !$mvvm_token->record_id){
            die('No matching token or record Id'); // kills execution if the token doesn't match or there is no record id
        }

        $now = strtotime(date('Y-m-d H:i:s') );
        $tokentime = strtotime($mvvm_token->created_at);

        $diff = ($now - $tokentime);

        if($diff < MVVM_TTL){  // update the record and return the new values that have been recorded if the token is still valid
            define('MVVM_TABLE', $mvvm_token->model);
            define('MVVM_RETURN_TYPE', 'object');
            $this->load->model('mvvm_model');
            $this->mvvm_model->update($post['mvvm']);
            $record = $this->mvvm_model->get($mvvm_token->record_id);
            $output = array(
                'status' => 'success',
                'record' => $record
            );

        } else { // if the token has expired
            $output = array(
                'status' => 0,
                'message' => 'You cannot update the data'
            );
        }

        echo json_encode( $output);

    }

    public function delete(){
        $post = $this->input->post();

        $where = array(
            'token' => $post['token']
        );
        $mvvm_token = $this->mvvmtoken_model->get($where);

        if(!$mvvm_token || !$mvvm_token->record_id){
            die('No matching token or record Id'); // kills execution if the token doesn't match or there is no record id
        }

        $now = strtotime(date('Y-m-d H:i:s') );
        $tokentime = strtotime($mvvm_token->created_at);

        $diff = ($now - $tokentime);

        if($diff < MVVM_TTL){  // update the record and return the new values that have been recorded if the token is still valid
            define('MVVM_TABLE', $mvvm_token->model);
            define('MVVM_RETURN_TYPE', 'object');
            $this->load->model('mvvm_model');
            $this->mvvm_model->update($post['mvvm']);
            $record = $this->mvvm_model->delete($mvvm_token->record_id);
            $output = array(
                'status' => 'success',
                'message' => 'The record was deleted'
            );

        } else { // if the token has expired
            $output = array(
                'status' => 0,
                'message' => 'You cannot update the data'
            );
        }

        echo json_encode( $output);
    }

}