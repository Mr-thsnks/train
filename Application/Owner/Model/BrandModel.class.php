<?php
namespace Owner\Model;
use Think\Model;

class BranchModel extends Model{
    protected $_validate = array(
        array('organizat','' ,'组织机构名称已存在',0,'unique',1),
        array('organizat','0,60' ,'组织机构 : 只能输入60字以内字符',2,'length',2),
        array('principal','0,60' ,'组织机构 : 只能输入60字以内字符',2,'length',2),
        array('phone','0,60' ,'组织机构 : 只能输入60字以内字符',2,'length',2),
        array('addr','0,60' ,'组织机构 : 只能输入60字以内字符',2,'length',2),
        array('inside_call','0,60' ,'组织机构 : 只能输入60字以内字符',2,'length',2)
    );
}