<?php

namespace App\Service;

use GuzzleHttp\Client;

class SendRequestService
{
    protected $client;
    protected $type;
    protected $url;
    protected $urlPath;
    protected $header;
    protected $resetPageSize;
    protected $data;

    /**
     * 发送请求
     *
     * @param string $type 请求类型
     * @param string $url 请求地址
     * @param array $data 请求数据
     * @return void
     */
    public function __construct($type, $url, $resetPageSize = 0, $data = [])
    {
        //curl -H 'Host: app10006.eapps.dingtalkcloud.com' -H 'sec-ch-ua: "Chromium";v="96"' -H 'accept: application/json, text/plain, */*' -H 'customname: e26b7ff6-a15b-47ea-8440-571049f942e3' -H 'sec-ch-ua-mobile: ?0' -H 'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 13_2_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36 DingTalk(7.6.0-macOS-macOS-MAS-38513772) nw Channel/201200 Architecture/x86_64' -H 'token: 9ef2694c-8c35-4df7-af08-9d9291ddd7fc' -H 'sec-ch-ua-platform: "Mac OS X"' -H 'origin: https://s.forwe.store' -H 'sec-fetch-site: cross-site' -H 'sec-fetch-mode: cors' -H 'sec-fetch-dest: empty' -H 'accept-language: zh-CN,zh;q=0.9' --compressed 'https://app10006.eapps.dingtalkcloud.com/community/feed/detail?feedId=4380216&sign=4a3bda4aad6ede66ecff8337ffca683f&__platform=pc&versionNumber=3'
        $this->client        = new Client();
        $this->type          = $type;
        $this->resetPageSize = $resetPageSize;
        $this->data = $data;
        $this->transformStringUrlParams($url);
    }


    public function resetUrlPageSize($urlPath, $size)
    {
        $urlPathArr = explode('?', $urlPath);
        $urlParams  = explode('&', $urlPathArr[1]);
        foreach ($urlParams as $key => $value) {
            $valueArr = explode('=', $value);
            if ($valueArr[0] == 'pageSize') {
                $urlParams[$key] = 'pageSize=' . $size;
            }
        }
        $urlPathArr[1] = implode('&', $urlParams);
        return implode('?', $urlPathArr);
    }


    public function sendGetRequest()
    {
        $response   = $this->client->request('GET', $this->urlPath, [
            'headers'         => $this->header,
            'allow_redirects' => false,
        ]);
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            return ['status' => false, 'code' => $statusCode, 'msg' => '请求失败'];
        }
        // 处理响应
        // ...
        $body = $response->getBody()->getContents();
        return ['status' => true, 'code' => $statusCode, 'data' => $body];

    }

    public function transformStringUrlParams($string)
    {
        $strArr  = explode('--compressed', $string);
        $urlPath = str_replace(["'", '"'], '', trim($strArr[1]));
        if ($this->resetPageSize > 0) {
            $urlPath = $this->resetUrlPageSize($urlPath, $this->resetPageSize);
        }
        $header = $strArr[0];
        $header = str_replace('curl', '', $header);

        $headerArr    = explode("-H", $header);
        $newHeaderArr = [];
        foreach ($headerArr as $value) {
            $value = trim($value);
            if (empty($value)) {
                continue;
            }
            $valueArr = explode(':', $value);
            if (count($valueArr) != 2) {
                continue;
            }
            foreach ($valueArr as $_k => $_v) {
                $_v            = trim($_v);
                $valueArr[$_k] = str_replace(["'", '"'], '', $_v);
            }
            $newHeaderArr[$valueArr[0]] = $valueArr[1];
        }
        $this->urlPath = $urlPath;
        $this->header  = $newHeaderArr;

    }

}
