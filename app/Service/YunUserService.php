<?php

namespace App\Service;

use App\Models\YunUser;

class YunUserService
{
    public function save($data)
    {
        // TODO: Implement save() method.
        $commonData = [];

        $list = $data['list'] ?? [];
        foreach ($list as $value) {
            $commonData[] = [
                'user_id'      => $value['userId'],
                'rank'         => $value['rank'],
                'user_name'    => $value['userName'],
                'dept_name'    => $value['deptName'] ?? '',
                'change_score' => $value['changeScore'] ?? 0,
                'deduct_score' => $value['deductScore'] ?? 0,
                'add_score'    => $value['addScore'] ?? 0,
                'avatar'       => $value['avatar'] ?? ''
            ];
        }
//        $commonDatas = array_chunk($commonData, 300);
//        dd($commonData[0]);
        if ($commonData) {
//            foreach ($commonDatas as $item){
                try {
                    $singField   = ['user_id'];
                    $updateField = ['rank', 'user_name', 'dept_name', 'change_score', 'deduct_score', 'add_score', 'avatar'];
                    YunUser::upSert($commonData, $singField, $updateField);
                } catch (\Exception $e) {
                    return ['status' => false, 'msg' => $e->getMessage()];
                }
//            }

        }
        return ['status' => true, 'total' => count($commonData)];

    }
}
