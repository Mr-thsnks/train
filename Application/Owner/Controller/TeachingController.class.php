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
        $this->redirect();
    }

    public function view(string $table, int $bid)
    {
        $this->display('view-' . $table);
    }
}
