<?php


namespace App\Http\Traits;



use Illuminate\Http\Response;
Trait BaseResponseTrait {
    /**
     * 默认数据返回类型
     * @var null
     */
    private static $responseType = NULL;

    /**
     * 设置返回数据类型
     * @return void
     */
    public static function setResponseType(string $type): void
    {
        if (is_null(self::$responseType)) {
            self::$responseType = $type;
        }
    }

    /**
     * 获取响应类型
     * @return string
     */
    public static function getResponseType()
    {
        return self::$responseType;
    }

    public function setResponseHeader(){

    }
    /**
     * 对象克隆
     * @return void
     */
    private function __clone()
    {
        // 禁止克隆
    }

    /**
     * 操作成功返回的数据
     * @param string $msg   提示信息
     * @param mixed $data   要返回的数据
     * @param int   $code   错误码，默认为1
     * @param string $type  输出类型
     * @param array $header 发送的 Header 信息
     */
    public  function success($data = null, $code = 200, $msg = '', $type = null, array $header = [])
    {
        if ($msg == '') {
            $msg = 'success';
        }

        return self::make($msg, $data, $code, $type, $header);
    }

    /**
     * 操作失败返回的数据
     * @param string $msg   提示信息
     * @param mixed $data   要返回的数据
     * @param int   $code   错误码，默认为0
     * @param string $type  输出类型
     * @param array $header 发送的 Header 信息
     */
    public  function error($code = 10001, $msg = '', $data = null, $type = null, array $header = []): object
    {
        if ($msg == '') {
            $msg = 'fail';
        }

        return self::make($msg, $data, $code, $type, $header);
    }

    /**
     * 返回封装后的 API 数据到客户端
     * @param mixed  $msg    提示信息
     * @param mixed  $data   要返回的数据
     * @param int    $code   错误码，默认为0
     * @param string $type   输出类型，支持json/xml/jsonp
     * @param array  $header 发送的 Header 信息
     * @return void
     * @throws HttpResponseException
     */
    private  function make($msg, $data = null, $code = 200, $type = null, array $header = [])
    {
        $result = [
            'status' => $code,
            'code'   => $code,
            'msg'    => $msg,
            'time'   => time(),
            'data'   => $data,
        ];
        if (isset($header['statuscode']))
        {
            $code = $header['statuscode'];
            unset($header['statuscode']);
        }
        else
        {
            //未设置状态码,根据code值判断
            $code = ($code >= 1000 || $code < 200) ? 200 : $code;
        }
        //return Response::create($result,$code ,$header);
        //return response($result,$code,$header);
        return  response()->json($result,$code);
    }

}
