<?php
namespace Owner\Controller;

class SaleController extends BaseController
{
    private $Student;
    private $studentFamily;
    private $studentMarketing;
    private $studentSales;
    private $studentOperation;

    public function _initialize()
    {
        parent::_initialize();
        $this->Student = M('Student');
        $this->studentFamily = M('student_family');
        $this->studentMarketing = M('student_marketing');
        $this->studentSales = M('student_sales');
        $this->studentOperation = M('student_operation');
    }

    public function index()
    {
        $this->redirect('sale/');
    }

    public function view(string $table)
    {
        $this->update();
    }

    public function update(string $table)
    {
        $this->display();
    }

    public function move(string $table)
    {
        $this->display();
    }
}
