<?php

namespace App\Service;

use GuzzleHttp\Client;

class SendUrlService
{
    protected $client;
    protected $type;
    protected $url;
    protected $header;
    protected $data;

    /**
     * 发送请求
     *
     * @param string $type 请求类型
     * @param string $url 请求地址
     * @param array $data 请求数据
     * @return void
     */
    public function __construct($type, $url,  $data = [])
    {
        $this->client        = new Client();
        $this->type          = $type;
        $this->data = $data;
        $this->url = $url;
    }

    public function curlSend()
    {
        //dd([$this->type, $this->url, $this->data]);
        $response = $this->client->request($this->type, $this->url, $this->data);

        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            return ['status' => false, 'code' => $statusCode, 'msg' => '请求失败'];
        }
        // 处理响应
        // ...
        $body = $response->getBody()->getContents();
        //dd($body);
        return ['status' => true, 'code' => $statusCode, 'data' => $body];
    }
}
