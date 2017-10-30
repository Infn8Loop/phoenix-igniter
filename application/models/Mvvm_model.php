<?php class Mvvm_model extends MY_Model {

    public $table = MVVM_TABLE;
    public $primary_key = "id";

    public function __construct()
    {
        parent::__construct();

        if(MVVM_RETURN_TYPE == 'array'){
            $this->return_as = "array";
        } else if(MVVM_RETURN_TYPE == "object"){
            $this->return_as = "object";
        } else {
            die('You must define MVVM_RETURN_TYPE as array or object.');
        }

    }

}
