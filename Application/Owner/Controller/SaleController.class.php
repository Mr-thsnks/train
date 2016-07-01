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
        $this->redirect('/sale/view');
    }

    public function view(string $table)
    {
        $map['branch_id'] = I('get.bid');
        if($table == 'customer'){
            $results = $this->Student->where($map)->field('')->select();
            int2string($results, [
                'sex' => ['0' => '女', '1' => '男'],
            ]);
            //dump($results);die;

        }

        $this->assign('results' , $results);
        $this->display('view-' . $table);
    }

    public function add(string $table , int $bid){

        $this->display('view' . $table);
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
