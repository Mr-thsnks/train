<?php
namespace Owner\Controller;
class IndexController extends BaseController {
    public function _initialize(){
        parent::_initialize();
    }
    
    public function index(){
        $this -> display();
    }

    public function side(){
        $this ->display();
    }
}