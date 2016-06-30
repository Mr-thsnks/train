<?php

function findStudentInfo(string $table, int $id, string $filter){
    $Table = M($table);
    $map['student_id'] = $id;
    $result = $Table->where($map)->field($filter)->find();
    return $result[$filter];
}

function findStudentCreateUser(int $id, string $filter){
    $Table = M('student_operation');
    $map['student_id'] = $id;
    $result = $Table->where($map)->field($filter)->find();
    return $result[$filter];
}

function findBranch(int $id, string $filter)
{
    if ($id == 0) {
        return '没有分校信息';
    }
    $Branch = M('Branch');
    $map['id'] = $id;
    $result = $Branch->where($map)->field($filter)->find();
    return $result[$filter];
}

function findAuth(int $id)
{
    $authGroupAccess = M('auth_group_access');
    $map['uid'] = $id;
    $groupId = $authGroupAccess->where($map)->field('group_id')->find();
    $authGroup = M('auth_group');
    unset($map);
    $map['id'] = $groupId['group_id'];
    $result = $authGroup->where($map)->field('title')->find();
    return $result['title'];
}

function findMember(int $id, string $filter)
{
    //_print($id);
    $Member = M('Member');
    $map['id'] = $id;
    $result = $Member->where($map)->field($filter)->find();
    return $result[$filter];
}

function findSubject(int $id)
{
    $Subject = M('branch_subject');
    $map['id'] = $id;
    $subject = $Subject->where($map)->field('title')->find();
    return $subject['title'];
}
