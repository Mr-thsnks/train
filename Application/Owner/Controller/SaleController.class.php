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

        //字典设置
        $this->branchDict = M('branch_dict');
        $dictMap['branch_id'] = $map['branch_id'];
        $eventDict = $this->branchDict->where($map)->select();
        //客户等级
        $dict = [];
        foreach ($eventDict as $key => $val) {
            switch ($val['class']) {
                case '客户等级':
                    $dict[0][] = $val;
                    break;
                case '信息来源':
                    $dict[1][] = $val;
                    break;
                case '活动类型':
                    $dict[2][] = $val;
                    break;
                
                default:
                    # code...
                    break;
            }
            
        }
        $this->assign('clientLevel', $dict[0]);
        $this->assign('infoSources', $dict[1]);
        $this->assign('eventType', $dict[2]);
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
        $map['id'] = I('get.id');
        $student = $this->Student->where($map)->find();
        $studentMap['student_id'] = $student['id'];
        $studentFamily = $this->studentFamily->where($studentMap)->find(); 
        int2string($student, [
            'marital' =>['0'=>'未婚' , '1'=>'已婚'],
        ]);
        $studentMarketing = $this->studentMarketing->where($studentMap)->find();
        $studentSales = $this->studentSales->where($studentMap)->find();
        $studentOperation = $this->studentOperation->where($studentMap)->find();
        $this->assign('student' , $student);
        $this->assign('studentFamily' , $studentFamily);
        $this->assign('studentSales' , $studentSales);
        $this->assign('studentMarketing' , $studentMarketing);
        $this->assign('studentOperation' , $studentOperation);

        $this->display('update-' . $table);
    }

    public function move(string $table)
    {
        $this->display();
    }
}
