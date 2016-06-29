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
        $branchDict = M('branchDict');
        $map['branch_id'] = I('get.bid');
        $map['class'] = "活动类型";
        $eventType = $branchDict->where($map)->select();
        $this->assign('eventType', $eventType);
    }

    public function index()
    {
        die('Error !');
    }

    public function view(string $table)
    {
        $map['branch_id'] = I('get.bid');
        $results = $this->Event->where($map)->order('id desc')->select();
        int2string($results, [
            'status' => ['0' => '取消', '1' => '进行中', '2' => '已结束'],
        ]);
        $this->assign('results', $results);
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
            $studentData = $this->Student->create();
            $familyData = $this->studentFamily->create();
            $marketingData = $this->studentMarketing->create();
            $salesData = $this->studentSales->create();
            $operationData = $this->studentOperation->create();
            _print($studentData);
            _print($familyData);
            _print($marketingData);
            _print($salesData);
            _print($operationData);
            die;
        }
        $this->display('import-' . $table);
    }
}
