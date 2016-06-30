<?php
namespace Owner\Controller;

class MarketingController extends BaseController
{
    private $Event;
    private $eventActual;
    private $eventOperation;
    private $Student;
    private $studentFamily;
    private $studentMarketing;
    private $studentSales;
    private $studentOperation;
    private $branchDict;
    public function _initialize()
    {
        parent::_initialize();
        $this->Event = M('Event');
        $this->eventActual = M('event_actual');
        $this->eventOperation = M('event_operation');

        $this->Student = M('Student');
        $this->studentFamily = M('student_family');
        $this->studentMarketing = M('student_marketing');
        $this->studentSales = M('student_sales');
        $this->studentOperation = M('student_operation');

        //活动负责人
        $Member = M('Member');
        $map['branch_id'] = I('get.bid');
        $memList = $Member->where($map)->select();
        $this->assign('memList', $memList);
        //活动种类
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
        die('Error !');
    }

    public function view(string $table)
    {
        $map['branch_id'] = I('get.bid');
        if ($table == 'event') {
            //分页
            $count = $this->Event->join('LEFT JOIN t_event_actual ON t_event.id = t_event_actual.event_id')->where($map)->count();
            $Page = new \Think\Page($count , 2);
            $show = $Page->show();

            $results = $this->Event->join('LEFT JOIN t_event_actual ON t_event.id = t_event_actual.event_id')->where($map)->limit($Page->firstRow.','.$Page->listRows)->field('t_event.id, t_event.title, t_event_actual.quantity_actual, t_event.time_begin, t_event.time_end, t_event.user, t_event.status')->order('t_event.id desc')->select();
            int2string($results, [
                'status' => ['0' => '取消', '1' => '进行中', '2' => '已结束'],
            ]);
        }else{
            $marketingMap = [];
            if (I('get.branch_evt') != '' || I('get.branch_dict') != '') {
                $ids = [];
                
                if(I('get.branch_evt')){
                    $marketingMap['branch_event'] = I('get.branch_evt');
                }

                if(I('get.branch_dict')){
                    $marketingMap['branch_dict'] = I('get.branch_dict');
                }
                
                
                
                $idsTmp = $this->studentMarketing->where($marketingMap)->field('student_id')->select(false);

                foreach ($idsTmp as $val) {
                    $ids[] = $val['student_id'];
                }
                $map['id'] = array('in', implode(',', $ids));
            }
            $namePhone = I('get.namePhone');
            if($namePhone){
                $map['name|phone'] = $namePhone;
            }
            //分页
            $count = $this->Student->where($map)->count();
            $Page = new \Think\Page($count,2);
            $show = $Page->show();
            $results = $this->Student->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
            int2string($results, [
                'sex' => ['0' => '女', '1' => '男'],
            ]);
            $this->assign('page',$show);
        }
        $this->assign('page',$show);
        $this->assign('results', $results);
        $eventTitle = $this->Event->field('id, title')->select();
        $this->assign('eventTitle' , $eventTitle);
        

        $this->display('view-' . $table);
    }

    public function create(string $table, int $bid)
    {
        if (IS_POST) {
            $insData['title'] = I('post.title');
            $insData['location'] = I('post.location');
            $insData['type'] = I('post.type');
            $insData['time_begin'] = I('post.time_begin');
            $insData['time_end'] = I('post.time_end');
            $insData['projected_costs'] = I('post.projected_costs');
            $insData['quantity'] = I('post.quantity');
            $insData['user'] = I('post.user');
            $insData['execute_days'] = I('post.execute_days');
            $insData['execute_nums'] = I('post.execute_nums');
            $insData['timetable'] = I('post.timetable');
            $insData['desc'] = I('post.desc');
            $insData['branch_id'] = I('get.bid');
            $insData['status'] = 1;
            $status = $this->Event->add($insData);
            unset($insData);
            $insData['create_user'] = session('UID');
            $insData['create_time'] = date('Y-m-d H:i:s', time());
            $insData['event_id'] = $status;
            $this->eventOperation->add($insData);
            chkStatus($status, '新增成功', '新增失败', '/marketing/view.html?table=' . $table . '&bid=' . $bid);
        }
        $branchDict = M('branchDict');
        $map['branch_id'] = I('get.bid');
        $map['class'] = "活动类型";
        $eventType = $branchDict->where($map)->select();
        $this->assign('eventType', $eventType);

        $this->display('create-' . $table);
    }

    public function update(string $table, int $bid)
    {
        $map['id'] = I('get.id');
        $event = $this->Event->where($map)->find();
        $eventMap['event_id'] = $event['id'];
        $eventActual = $this->eventActual->where($eventMap)->find();
        $eventOperation = $this->eventOperation->where($eventMap)->find();

        //dump($eventActual);
        $this->assign('event', $event);
        $this->assign('eventActual', $eventActual);
        $this->assign('eventOperation', $eventOperation);

        //上面试展示原有信息，下面是获取保存信息
        if (IS_POST) {
            $updateData['title'] = I('post.title');
            $updateData['location'] = I('post.location');
            $updateData['type'] = I('post.type');
            $updateData['time_begin'] = I('post.time_begin');
            $updateData['time_end'] = I('post.time_end');
            $updateData['projected_costs'] = I('post.projected_costs');
            $updateData['quantity'] = I('post.quantity');
            $updateData['user'] = I('post.user');
            $updateData['execute_nums'] = I('post.execute_nums');
            $updateData['execute_days'] = I('post.execute_days');
            $updateData['desc'] = I('post.desc');
            $updateData['branch_id'] = I('get.bid');
            $updateData['status'] = I('post.status');
            $statusEvent = $this->Event->where($map)->save($updateData);
            if ($statusEvent === false) {
                $this->alert('更新失败');
            }
            $actualData['time_begin_actual'] = I('time_begin_actual');
            $actualData['time_end_actual'] = I('time_end_actual');
            $actualData['amount_actual'] = I('amount_actual');
            $actualData['quantity_actual'] = I('quantity_actual');
            $actualData['summary_actual'] = I('summary_actual');
            $chkData = $this->eventActual->where($eventMap)->field('id')->find();
            if (!$chkData) {
                $actualData['event_id'] = $event['id'];
                $statusEventActual = $this->eventActual->add($actualData);
            } else {
                $statusEventActual = $this->eventActual->where($eventMap)->save($actualData);
            }

            if (false === $statusEventActual) {
                $this->alert('更新失败');
            }

            unset($updateData);
            $updateData['update_user'] = session('UID');
            $updateData['update_time'] = date('Y-m-d H:i:s', time());
            $statusEventOperation = $this->eventOperation->where($eventMap)->save($updateData);
            chkStatus($statusEventActual, '更新成功', '更新失败', '/marketing/view.html?table=' . $table . '&bid=' . $bid);
        }

        $this->display('update-' . $table);
    }
    public function eventDel(string $table, int $bid)
    {
        $evtId = I('get.id');
        $map['id'] = $evtId;
        $eventMap['event_id'] = $evtId;
        $statusOperation = $this->eventOperation->where($eventMap)->delete();
        $statusActual = $this->eventActual->where($eventMap)->delete();
        $statusEvent = $this->Event->where($map)->delete();
        chkStatus($statusEvent, '删除成功', '删除失败', '/marketing/view.html?table=' . $table . '&bid=' . $bid);
    }

    public function import(string $table, int $bid)
    {
        if (IS_POST) {
            $studentRules = [
                ['name', 'require', '姓名必填'],
                ['phone', 'require', '联系方式必填'],
                ['intention', 'require', '意向科目必填'],
            ];
            if(!$studentData = $this->Student->validate($studentRules)->create()){
                $this->alert($this->Student->getError());
                return false;
            }
            $familyData = $this->studentFamily->create();
            $marketingData = $this->studentMarketing->create();
            $salesData = $this->studentSales->create();
            $studentId = $this->Student->add($studentData);

            $familyData['student_id'] = $studentId;
            $marketingData['student_id'] = $studentId;
            $marketingData['branch_event'] = I('get.evt_id');
            $salesData['student_id'] = $studentId;
            $operationData['create_user'] = session('UID');
            $operationData['student_id'] = $studentId;
            $this->studentFamily->add($familyData);
            $this->studentMarketing->add($marketingData);
            $this->studentOperation->add($operationData);
            $this->studentSales->add($salesData);
            chkStatus($studentId, '导入成功', '导入失败', '/marketing/view.html?table=collect&bid=' . $bid);
        }

        $this->display('import-' . $table);
    }
}
