<?php class Test_model extends MY_Model {

    public $table = "test";
    public $primary_key = "id";

    public function __construct()
    {
        parent::__construct();
        $this->return_as = "object";
    }

}
