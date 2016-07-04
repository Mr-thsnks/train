<?php
namespace Owner\Controller;

class TeachingController extends BaseController
{
    private $teachStudent;
    private $teachClass;
    private $Member;
    public function _initialize()
    {
        parent::_initialize();
        $this->teachStudent = D('teaching_student');
        $this->teachClass = M('teaching_class');
        $this->Member = M('member');
    }

    public function index()
    {
        die('Error !');
    }

    public function view(string $table, int $bid)
    {
        switch ($table) {
            case 'student':
                $map['member_id'] = session('UID');
                $results = $this->teachStudent->where($map)->select();
                break;
            case 'class':
                $map['branch_id'] = $bid;
                $class = $this->teachClass->where($map)->select();
                int2string($class, [
                    'class_status' => ['1' => '招生中', '2' => '开课中' , '3' => '已结课'],
                ]);
                $this->assign('class' , $class);
                break;
            case 'subject':
                break;
            case 'priced':
                break;
            case 'exam':
                break;
            case 'hours':
                break;
            case 'transfer':
                break;
            case 'course':
                break;
            case 'timetable':
                break;

            default:
                die('Error !');
                break;
        }

        
        $this->assign('results', $results);
        $this->display('view-' . $table);
    }

    public function add(string $table , int $bid){
        // $map['status'] = 1;
        // $map['branch_id'] = $bid;
        $authGroup = M('auth_group');
        $authGroupAcc = M('auth_group_access');
        $gid = $authGroup->where('title = "教师"')->field('id')->find();
        $map['group_id'] = ['in', $gid['id']];
        $memberId = $authGroupAcc->where($map)->field('uid')->select();

        $ids = '';
        $dot = '';
        foreach ($memberId as $val) {
            $ids .= $dot.$val['uid'];
            $dot = ',';
        }
        unset($map);
        $map['id'] = ['in' , $ids];
        $teacher = $this->Member->where($map)->field('id, name')->select();
        $this->assign('teacher' , $teacher);
        unset($map);
        $map['branch_id'] = $bid;
        $subject = M('branch_subject')->where($map)->field('title')->select();
        $this->assign('subject' , $subject);

        if(IS_POST){
            $addClass = $this->teachClass->create();
            $addClass['branch_id'] = $bid;
            $results = $this->teachClass->where()->add($addClass);
            chkStatus($results , "新增成功"  , "新增失败" , '/teaching/view.html?table=class&bid=' .$bid);
        }
        
        $this->display('add-' . $table);
    }
}
