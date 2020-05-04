<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/18
 * Time: 16:05
 */

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Http\UploadedFile;
use Qcloud\Cos\Client;
use Qcloud\Cos\Exception\ServiceResponseException;


class ToolController extends Controller
{

        public function uploads(Request $request){

                $file = fopen($_FILES['file']['tmp_name'], 'rb');
                $ext  = pathinfo($_FILES['file']['name'])['extension'];
                $cosClient = new Client(array(
                    'region' => 'ap-chengdu', #地域，如ap-guangzhou,ap-beijing-1
                    'credentials' => array(
                        'secretId' => env('TXCloudUploadSecretId'),
                        'secretKey' => env('TXCloudUploadSecretKey'),
                    ),
                ));
                try {
                    $bucket = env('help-1300617916');
                    //$bucket = 'oyb-1258356039';
                    $uid = 0;
                    $key = uniqid() . '_' . $uid . '.' . $ext;

                   $result = $cosClient->putObject(array('Bucket' => $bucket, 'Key' => $key, 'Body' => $file));
                    /*$result=$cosClient->listObjects(array(
                        'Bucket' =>$bucket, //格式：BucketName-APPID
                        'Delimiter' => '',
                        'EncodingType' => 'url',
                        'Marker' => 'doc/picture.jpg',
                        'Prefix' => 'doc',
                        'MaxKeys' => 1000,
                    )); ;*/
                }catch (\Exception $e){
                    echo "$e\n";
                }
                //print_r($result);
                if($request->get('dir')){

                    return response()->json(['status'=>1,'path'=>$result['Location']]);
                }
                // var_dump($request->all());
                return response()->json(['status'=>1,'path'=>$result['Location']]);


        }
}