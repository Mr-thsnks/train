<?php
namespace Owner\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function index($user = null, $passwd = null)
    {
        //md5(encrypt('Training');
        if (IS_POST) {
            $Member = M('Member');
            $map['user'] = $user;
            $result = $Member->where($map)->field('id, passwd')->find();
            if (!$result || $result['passwd'] != md5(encrypt($passwd))) {
                $this->alert('用户名或密码错误！');
                return false;
            }
            $change['last_login'] = date('Y-m-d H:i:s', NOW_TIME);
            $change['last_ip'] = get_client_ip();
            unset($map);
            $map['id'] = $result['id'];
            $Member->where($map)->save($change);
            session('UID', $result['id']);
            redirect('/');
        }
        $this->display();
    }
}
