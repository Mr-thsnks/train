<?php
namespace Owner\Controller;

class SettingController extends BaseController
{

    private $BranchDict;
    private $BranchDisc;
    private $BranchSubject;
    private $BranchPriced;
    private $BranchExp;
    private $Table;

    public function _initialize()
    {
        parent::_initialize();
        $this->BranchDict = M('branch_dict');
        $this->BranchDisc = M('branch_disc');
        $this->BranchSubject = M('branch_subject');
        $this->BranchPriced = M('branch_priced');
        $this->BranchExp = M('branch_expire');
    }

    public function view(string $table, int $bid)
    {
        //$map['table'] = $table;
        $map['branch_id'] = $bid;

        switch ($table) {
            case 'dict':
                $results = $this->BranchDict->where($map)->order('id desc')->select();
                int2string($results, [
                    'status' => ['0' => '停用', '1' => '使用'],
                ]);
                break;
            case 'disc':
                $results = $this->BranchDisc->where($map)->order('id desc')->select();
                int2string($results, [
                    'type' => ['1' => '折扣', '1' => '减价'],
                ]);
                break;
            case 'subject':
                $results = $this->BranchSubject->where($map)->order('id desc')->select();
                int2string($results, [
                    'type' => ['1' => '折扣', '1' => '减价'],
                ]);
                break;
            case 'priced':
                $results = $this->BranchPriced->where($map)->order('id desc')->select();
                break;
            case 'expire':
                $results = $this->BranchExp->where($map)->order('id desc')->select();
                break;

            default:
                die('Error ! <br>not found ' . $table . ' table');
                break;
        }

        $this->assign('results', $results);
        $this->display('Branch:view-' . $table);
    }

    public function create(string $table, int $bid)
    {
        if (IS_POST) {
            switch ($table) {
                case 'dict':
                    if (!$dictData = $this->BranchDict->create()) {
                        $error = $this->BranchDict->getError();
                        $this->alert($error);
                    }
                    $dictData['branch_id'] = $bid;
                    $dictData['operator'] = session('UID');
                    $status = $this->BranchDict->add($dictData);
                    break;

                case 'disc':
                    if (!$discData = $this->BranchDisc->create()) {
                        $error = $this->BranchDisc->getError();
                        $this->alert($error);
                    }
                    $discData['branch_id'] = $bid;
                    $discData['operator'] = session('UID');
                    $status = $this->BranchDisc->add($discData);
                    break;

                case 'subject':
                    if (!$subjectData = $this->BranchSubject->create()) {
                        $error = $this->BranchSubject->getError();
                        $this->alert($error);
                    }
                    $subjectData['branch_id'] = $bid;
                    $subjectData['operator'] = session('UID');
                    // _print($subjectData);
                    // die;
                    $status = $this->BranchSubject->add($subjectData);
                    break;

                case 'priced':
                    if (!$pricedData = $this->BranchPriced->create()) {
                        $error = $this->BranchPriced->getError();
                        $this->alert($error);
                    }
                    $pricedData['branch_id'] = $bid;
                    //$pricedData['operator'] = session('UID');
                    $status = $this->BranchPriced->add($pricedData);
                    break;

                case 'expire':
                    if (!$expData = $this->BranchExp->create()) {
                        $error = $this->BranchExp->getError();
                        $this->alert($error);
                    }
                    $expData['branch_id'] = $bid;
                    $expData['operator'] = session('UID');
                    $status = $this->BranchExp->add($expData);
                    break;

                default:
                    die('Error ! <br>not found ' . $table . ' table');
                    break;
            }
            chkStatus($status, '新增成功', '新增失败', '/setting/view.html?table=' . $table . '&bid=' . $bid);
        }
        //$this->BranchSetting->find();
        $this->display('Branch:create-' . $table);
    }

    public function update(string $table, int $bid, int $id)
    {
        $map['id'] = $id;

        if (IS_POST) {
            switch ($table) {
                case 'dict':
                    if (!$dictData = $this->BranchDict->create()) {
                        $error = $this->BranchDict->getError();
                        $this->alert($error);
                        return false;
                    }
                    $status = $this->BranchDict->where($map)->save($dictData);
                    break;
                case 'disc':
                    if (!$discData = $this->BranchDisc->create()) {
                        $error = $this->BranchDisc->getError();
                        $this->alert($error);
                        return false;
                    }
                    $status = $this->BranchDisc->where($map)->save($discData);
                    break;
                case 'subject':
                    if (!$subjectData = $this->BranchSubject->create()) {
                        $error = $this->BranchSubject->getError();
                        $this->alert($error);
                        return false;
                    }
                    $status = $this->BranchSubject->where($map)->save($subjectData);
                    break;
                case 'priced':
                    if (!$pricedData = $this->BranchPriced->create()) {
                        $error = $this->BranchPriced->getError();
                        $this->alert($error);
                        return false;
                    }
                    $status = $this->BranchPriced->where($map)->save($pricedData);
                    break;
                case 'expire':
                    if (!$expireData = $this->BranchExp->create()) {
                        $error = $this->BranchExp->getError();
                        $this->alert($error);
                        return false;
                    }
                    $status = $this->BranchExp->where($map)->save($expireData);
                    break;

                default:
                    die('Error ! <br>not found ' . $table . ' table');
                    break;
            }
            chkStatus($status, '修改成功', '修改失败', '/setting/view.html?table=' . $table . '&bid=' . $bid);
        }

        if($table != 'auth'){
            $this->Table = M('branch_' . $table);
            $result = $this->Table->where($map)->find();
        }

        
        $this->assign('result', $result);
        $this->display('Branch:update-' . $table);
    }

    public function del(string $table, int $bid, int $id)
    {
        if($table == 'subject'){
            $sid = $this->BranchPriced->field('subject_id')->find();
            if($sid){
                $this->alert('当前科目有关联数据 \n删除失败');
                return false;
            }
        }
        $this->Table = M('branch_' . $table);
        $map['id'] = $id;
        $status = $this->Table->where($map)->delete();
        chkStatus($status, '删除成功', '删除失败', '/setting/view.html?table=' . $table . '&bid=' . $bid);
    }

    public function auth()
    {
        $authGroup = M('auth_group');
        $results = $authGroup->field('id, title, status')->select();
        int2string($results, [
            'status' => ['0' => '停用', '1' => '使用'],
        ]);
        $this->assign('results', $results);
        $this->display('Branch:view-auth');
    }

}
