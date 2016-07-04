<?php
namespace Owner\Controller;
use Think\Controller;
use Think\Auth;

class AuthController extends Controller
{
    protected function _initialize()
    {
        
        if (!session('UID')) {
            redirect('/Login.html');
        }
        if (session('UID') == (1||10)) {
            return true;
        }
        $auth = new Auth();
        if(!$auth -> check('/'.CONTROLLER_NAME.'/'.ACTION_NAME , session('UID'))){
            $this -> alert('没有权限');
        }
    }
}
