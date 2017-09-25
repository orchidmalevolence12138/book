<?php
namespace App\Tool\SMS;
use App\Tool\SMS\REST;
use App\Models\M3Result;
//include_once("./CCPRestSmsSDK.php");
class SendTemplateSMS{


    public function sendTemplateSMS($to,$datas,$tempId){

        // 初始化REST SDK
        global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;

        //主帐号,对应开官网发者主账号下的 ACCOUNT SID
        $accountSid= '8aaf07085ea24877015ea7daf048028b';

//主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
        $accountToken= '00529958a30f42a0859b9eecd340f0e3';

//应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
//在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
        $appId='8aaf07085ea24877015ea7daf1aa0292';

//请求地址
//沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
//生产环境（用户应用上线使用）：app.cloopen.com
        $serverIP='sandboxapp.cloopen.com';


//请求端口，生产环境和沙盒环境一致
        $serverPort='8883';


//REST版本号，在官网文档REST介绍中获得。
        $softVersion = '2013-12-26';

        $rest = new REST($serverIP,$serverPort,$softVersion);
        $rest->setAccount($accountSid,$accountToken);
        $rest->setAppId($appId);

        $m3result = new M3Result;

        // 发送模板短信
       // echo "Sending TemplateSMS to $to <br/>";
        $result = $rest->sendTemplateSMS($to,$datas,$tempId);
        if($result == NULL ) {
            $m3result->status = 3;
            $m3result->message ="result error!" ;

            //break;
        }
        if($result->statusCode!=0) {
            $m3result->status = $result->statusCode;
            $m3result->message = $result->statusMsg;
            //TODO 添加错误处理逻辑
        }else{
            $m3result->status = 0;
            $m3result->message ="发送成功！" ;
           /* echo "Sendind TemplateSMS success!<br/>";
            // 获取返回信息
            $smsmessage = $result->TemplateSMS;
            echo "dateCreated:".$smsmessage->dateCreated."<br/>";
            echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";*/
            //TODO 添加成功处理逻辑
        }
        return $m3result;
    }
//Demo调用
    //**************************************举例说明***********************************************************************
    //*假设您用测试Demo的APP ID，则需使用默认模板ID 1，发送手机号是13800000000，传入参数为6532和5，则调用方式为           *
    //*result = sendTemplateSMS("13800000000" ,array('6532','5'),"1");																		  *
    //*则13800000000手机号收到的短信内容是：【云通讯】您使用的是云通讯短信模板，您的验证码是6532，请于5分钟内正确输入     *
    //*********************************************************************************************************************
//sendTemplateSMS("",array('',''),"");//手机号码，替换内容数组，模板ID


}
?>
