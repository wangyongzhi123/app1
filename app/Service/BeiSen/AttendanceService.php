<?php

namespace App\Service\BeiSen;

use App\Models\UserAttendance;
use App\Models\UserRelateInfos;
use App\Service\SendUrlService;

class AttendanceService
{
    protected $attendData;

    public function getAttendanceOpen($month,$PageIndex,$PageSize)
    {
        $body = [
            "Month"=>$month,
                    "PageIndex"=>$PageIndex,
                    "PageSize" => $PageSize
        ];
        $params = [
            'headers' => [
                'Authorization' => 'Bearer X4eTEiMr-b5kTmn9UY2ZAZ-hpr4FV69KVkgD1ivhw0ZXaeWjd1zAsB9fr2_OshRGRq7yj9cfZ',
                'Content-Type'  => 'application/json'
            ],
            'body'    => json_encode($body)
        ];
        $sendUrlService = new SendUrlService('POST','openapi.italent.cn/AttendanceOpen/api/v1/WorkShiftRecord/GetList', $params);
        $data = $sendUrlService->curlSend();
//        dd($data);
//        $data['data'] = '{"Data":{"WorkShiftRecordList":[{"StaffId":123833019,"Email":"katherine.he@ibaiqiu.com","CardNumber":"1462","Month":"2024-07-01 00:00:00","OIdAttendanceOrgan":"3221532","JobType":2,"OIdAttendanceGroup":null,"Day1":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day2":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day3":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day4":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day5":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day6":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day7":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day8":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day9":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day10":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day11":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day12":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day13":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day14":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day15":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day16":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day17":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day18":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day19":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day20":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day21":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day22":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day23":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day24":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day25":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day26":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day27":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day28":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day29":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day30":"35c0d7fb-680b-4aa6-8963-808c4b248e47","Day31":"35c0d7fb-680b-4aa6-8963-808c4b248e47","IsValid":true,"CreatedTime":"2023-07-01 04:17:21","ModifiedTime":"2024-07-24 14:57:17","OId":"521ace21-fee4-4d3d-baf3-a9a9e269f0fa"},{"StaffId":123833038,"Email":"kevin.li@ibaiqiu.com","CardNumber":"1990","Month":"2024-07-01 00:00:00","OIdAttendanceOrgan":"3604375","JobType":2,"OIdAttendanceGroup":null,"Day1":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day2":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day3":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day4":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day5":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day6":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day7":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day8":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day9":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day10":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day11":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day12":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day13":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day14":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day15":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day16":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day17":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day18":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day19":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day20":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day21":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day22":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day23":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day24":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day25":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day26":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day27":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day28":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day29":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day30":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day31":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","IsValid":true,"CreatedTime":"2023-07-01 04:17:22","ModifiedTime":"2024-08-15 12:17:15","OId":"27f07ca8-3d3d-4531-a27a-9278f5073efa"},{"StaffId":123833040,"Email":"bert.wang@ibaiqiu.com","CardNumber":"5772","Month":"2024-07-01 00:00:00","OIdAttendanceOrgan":"3604356","JobType":2,"OIdAttendanceGroup":null,"Day1":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day2":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day3":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day4":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day5":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day6":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day7":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day8":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day9":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day10":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day11":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day12":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day13":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day14":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day15":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day16":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day17":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day18":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day19":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day20":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day21":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day22":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day23":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day24":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day25":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day26":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day27":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day28":"155fd048-7002-496a-82c7-f34df7d5c8dc","Day29":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day30":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","Day31":"a25c0fe3-b58f-44c3-9392-3bc887c49f61","IsValid":true,"CreatedTime":"2023-07-01 04:17:21","ModifiedTime":"2024-08-09 11:16:25","OId":"41626f33-7e67-4781-9a72-db225d51d079"}],"Total":1674},"Code":200,"Message":null}';
        $_data   = is_array($data['data']) ? $data['data'] : json_decode($data['data'], 1);
        //dd($_data);
        $_data = $_data['Data'];
        //dd($_data);
        $userInfos =  $userAttendance = [];
        foreach ($_data['WorkShiftRecordList'] as $item){
            $userInfos[] = [
                'staff_id' => $item['StaffId'],
                'email'    => $item['Email'],
                'card_number' => $item['CardNumber'],
            ];
            $_day = [];
            foreach ($item as $k=>$v){
                if(strpos($k,'Day') !== false){
                    $_day[$k] = $v;
                }
            }
            $userAttendance[] = [
                'staff_id' => $item['StaffId'],
                'month'    => $item['Month'],
                'o_id_attendance_organ'=> $item['OIdAttendanceOrgan'],
                'job_type' => $item['JobType'],
                'o_id_attendance_group'=> $item['OIdAttendanceGroup'],
                'day_data'=>json_encode($_day),
                'is_valid' => $item['IsValid'],
                'created_time' => $item['CreatedTime'],
                'modified_time' => $item['ModifiedTime'],
                'o_id' => $item['OId'],
            ];
        }
//        dd($userAttendance);
//        dd([$userInfos,$userAttendance]);
        if($userInfos){
            $singField   = ['staff_id'];
            $updateField = ['email', 'card_number'];
            UserRelateInfos::upSert($userInfos,$singField,$updateField);
        }
        if($userAttendance){
            $singField   = ['staff_id','month'];
            $updateField = ['o_id_attendance_organ','job_type', 'o_id_attendance_group','day_data','is_valid','created_time','modified_time','o_id'];
            UserAttendance::upSert($userAttendance,$singField,$updateField);
        }

        return $_data;
        //dd($_data);


    }

    public function setData($month,$page=1,$pageSize=200){

        $apiRes = self::getAttendanceOpen($month,$page,$pageSize);

        if($apiRes['Total']/$pageSize > $page){
            $page++;
            self::setData($month,$page,$pageSize);
        }


    }
}
