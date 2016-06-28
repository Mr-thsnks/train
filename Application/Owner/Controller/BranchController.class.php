<?php
namespace Owner\Controller;

class BranchController extends BaseController
{
    private $Branch;
    private $Member;
    public function _initialize()
    {
        parent::_initialize();
        $this->Branch = D('Branch');
        $this->Member = D('Member');
    }

    public function index()
    {
        $this->display();
    }

    public function view(string $table, int $bid)
    {
        //$map['table'] = $table;
        //$results = $this->BranchSetting->where($map)->order('id desc')->select();
        //$this->assign('results', $results);
        $this->display('view-'.$table);
    }

    public function create(string $table)
    {
        if (empty($table)) {
            die('Error');
        }

        if (IS_POST && $table == 'campus') {
            if (!$branchData = $this->Branch->create()) {
                $error = $this->Branch->getError();
                $this->alert($error);
                return false;
            }
            $status = $this->Branch->add($branchData);
            chkStatus($status, '新增成功', '新增失败', '/Branch/create.html?table='.$table);
        }

        if (IS_POST && $table == 'user') {
            if (!$memberData = $this->Member->create()) {
                $error = $this->Member->getError();
                $this->alert($error);
                return false;
            }
            $status = $this->Member->add($memberData);
            if($status){
                $authGroupAccess = M('auth_group_access');
                $insData['uid'] = $status;
                $insData['group_id'] = I('post.auth');
                $authGroupAccess->add($insData);
            }
            chkStatus($status, '新增成功', '新增失败', '/Branch/create.html?table='.$table);
        }

        if ($table == 'campus') {
            $results = $this->Branch->order('id desc')->select();
            $this->assign('results', $results);
        } else {
            $branch = $this->Branch->field('id, organizat')->order('id desc')->select();
            $map['id'] = array('gt', '1');
            $results = $this->Member->where($map)->order('id desc')->select();
            $this->assign('branch', $branch);
            $this->assign('results', $results);
        }
        $this->display('crate-' . $table);
    }

    public function update(string $table, int $id)
    {
        $map['id'] = $id;
        if($table == 'campus'){
            if(IS_POST){
                $branchSave = $this->Branch->create();
                $status = $this->Branch->where($map)->save($branchSave);
            }
            $result = $this->Branch->where($map)->find();
        }else{
            if(IS_POST){
                $memberSave = $this->Member->create();
                $status = $this->Member->where($map)->save($memberSave);
            }
            $branch = $this->Branch->field('id, organizat')->order('id desc')->select();
            $this->assign('branch', $branch);
            $result = $this->Member->where($map)->find();
        }

        if(isset($status) && $status){
            $this->alert('修改成功', '/Branch/create.html?table='.$table);
        }

        $this->assign('result', $result);
        $this->display('update-' . $table);
    }

    public function del(string $table, int $id){
        $map['id'] = $id;
        if($table == 'campus'){
            $status = $this->Branch->where($map)->delete();
            chkStatus($status, '删除成功', '删除失败', '/branch/create.html?table=campus');
        }else{
            $status = $this->Member->where($map)->delete();
            $authGroupAccess = M('auth_group_access');
            unset($map);
            $map['uid'] = $id;
            $authGroupAccess->where($map)->delete();
            chkStatus($status, '删除成功', '删除失败', '/branch/create.html?table=user');
        }
    }
}
