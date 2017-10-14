<?php

namespace App\Http\Controllers\Service;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

class PayController extends Controller{

    public function alipay(Request $request){

        require_once(app_path().'/Tool/alipay/wappay/service/AlipayTradeService.php');
        require_once(app_path().'/Tool/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php');
        require(app_path().'/Tool/alipay/config.php');

        //if (!empty($_POST['WIDout_trade_no'])&& trim($_POST['WIDout_trade_no'])!=""){
        if (!empty($_POST['order_no'])&& trim($_POST['order_no'])!=""){
            //商户订单号，商户网站订单系统中唯一订单号，必填
            //$out_trade_no = $_POST['WIDout_trade_no'];
            $out_trade_no = $_POST['order_no'];
            //订单名称，必填
            //$subject = $_POST['WIDsubject'];
            $subject = $_POST['name'];
            //付款金额，必填
           // $total_amount = $_POST['WIDtotal_amount'];
            $total_amount = $_POST['total_price'];
            //商品描述，可空
            $body = '';//$_POST['WIDbody'];

            //超时时间
            $timeout_express="1m";

            $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);

            $payResponse = new \AlipayTradeService($config);
            $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

            return ;
        }
    }


    public function notify(){

        require_once(app_path()."/Tool/alipay/config.php");
        require_once(app_path().'/Tool/alipay/wappay/service/AlipayTradeService.php');


        $arr=$_POST;
        $alipaySevice = new \AlipayTradeService($config);
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);

        if($result) {//验证成功

            //商户订单号

            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号

            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];


            if($_POST['trade_status'] == 'TRADE_FINISHED') {

                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序

                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
                Log::info('支付完成');
            }
            else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——


            Log::info('支付成功');
            $order = Order::where('order_no', $out_trade_no)->first();
            $order->status = 2;
            $order->save();

            return "success";		//请不要修改或删除

        }else {
            //验证失败
            Log::info('支付验证失败');
            return "fail";	//请不要修改或删除

        }
    }

    public function callback(){

        require_once(app_path()."/Tool/alipay/config.php");
        require_once(app_path().'/Tool/alipay/wappay/service/AlipayTradeService.php');


        $arr=$_GET;
        $alipaySevice = new \AlipayTradeService($config);
        $result = $alipaySevice->check($arr);

        if($result) {//验证成功

            //商户订单号

            $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

            //支付宝交易号

            $trade_no = htmlspecialchars($_GET['trade_no']);

            return "验证成功<br />外部订单号：".$out_trade_no;

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            return "验证失败";
        }


    }

    public function wxPay(Request $request) {
        $openid = $request->session()->get('openid', '');
        if($openid == '') {
            $m3_result = new M3Result;
            $m3_result->status = 1;
            $m3_result->message = 'Session已过期, 请重新提交订单';

            return $m3_result;
        }

        return WXTool::wxPayData($request->input('name'), $request->input('order_no'), 1, $openid);
    }

   /* public function wxNotify() {
        Log::info('微信支付回调开始');
        $return_data = file_get_contents("php://input");
        Log::info('return_data: '.$return_data);

        libxml_disable_entity_loader(true);
        $data = simplexml_load_string($return_data, 'SimpleXMLElement', LIBXML_NOCDATA);

        Log::info('return_code: '.$data->return_code);
        if($data->return_code == 'SUCCESS') {
            $order = Order::where('order_no', $data->out_trade_no)->first();
            $order->status = 2;
            $order->save();

            return "<xml>
                <return_code><![CDATA[SUCCESS]]></return_code>
                <return_msg><![CDATA[OK]]></return_msg>
              </xml>";
        }

        return "<xml>
              <return_code><![CDATA[FAIL]]></return_code>
              <return_msg><![CDATA[FAIL]]></return_msg>
            </xml>";

    }*/

}
