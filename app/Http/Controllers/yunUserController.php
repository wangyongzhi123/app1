<?php

namespace App\Http\Controllers;

use App\Service\YunUser\YunUserService;
use Illuminate\Http\Request;

class yunUserController
{
    public function getRank(Request $request)
    {
        $params     = $request->all();
        $default    = "curl -H 'Host: app10006.eapps.dingtalkcloud.com' -H 'Cookie:Hm_lpvt_0b89ed3906fb80f3cbed4c2bcce5d512=1734501059; Hm_lvt_0b89ed3906fb80f3cbed4c2bcce5d512=1734500976; HMACCOUNT=52143B98E71CADDF' -H 'sec-ch-ua: \"Chromium\";v=\"96\"' -H 'accept: application/json, text/plain, */*' -H 'customname: 3df783ec-b75e-49b7-bbf4-e1b2d1738ffb' -H 'sec-ch-ua-mobile: ?0' -H 'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 13_2_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36 DingTalk(7.6.0-macOS-macOS-MAS-38513772) nw Channel/201200 Architecture/x86_64' -H 'token: 210856cd-1e00-4e11-ad15-6953bbd0ee0c' -H 'sec-ch-ua-platform: \"Mac OS X\"' -H 'sec-fetch-site: same-origin' -H 'sec-fetch-mode: cors' -H 'sec-fetch-dest: empty' -H 'accept-language: zh-CN,zh;q=0.9' --compressed 'https://app10006.eapps.dingtalkcloud.com/community/staffIntegral/scoreRankV2?pageNo=1&pageSize=30&rankType=3&__platform=pc&versionNumber=3'";
        $url        = $params['url'] ?? $default;
        $saveResult = (new YunUserService())->getUser($url);
        //dd($saveResult);
        return view('yunUser', ['saveResult' => $saveResult, 'url' => $url ?? '']);
    }
}
