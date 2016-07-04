<?php
namespace Owner\Controller;

class TeachingController extends BaseController
{
    private $teachStudent;
    public function _initialize()
    {
        parent::_initialize();
        $this->teachStudent = D('teaching_student');
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
}
