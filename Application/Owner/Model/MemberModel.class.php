<?php
namespace Owner\Model;

use Think\Model;

class MemberModel extends Model
{
    protected $_validate = array(
        array('user','' ,'登陆账号已存在',0,'unique',1),
    );

    protected $_auto = array(
        array('passwd', 'passwd', 3, 'function'),
    );
}
