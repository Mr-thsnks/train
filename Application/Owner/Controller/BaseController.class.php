<?php
namespace Owner\Controller;
use Think\Controller;
class BaseController extends AuthController{
    public function _initialize(){
        parent::_initialize();
        if(!session('UID')){
            redirect('/Login.html');
        }
        define('CSS' , strtolower(CONTROLLER_NAME).'.css');
        define('JS' , strtolower(CONTROLLER_NAME).'.css');
        $css = './public/stylesheets/'.CSS;
        $js = './public/javascripts/'.JS;
        if(file_exists($css)){
            $this -> assign('css' , CSS);
        }
        if(file_exists($js)){
            $this -> assign('js' , JS);
        }

        $Branch = M('Branch');
        $leftBranch = $Branch->field('id, organizat')->select();
        $this->assign('leftBranch', $leftBranch);
    }

    public function _empty($name){
        $this -> display('Public:error404');
    }
}