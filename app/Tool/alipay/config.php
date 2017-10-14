<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016080800191647",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEpQIBAAKCAQEA195xDt5tltaepSmqnxBI+xui8lkmkP2+LOEiqeCKjfP4UbzyB183x2TNAG+kkMMSwFh6xbANQx6JKtuWINYcB8vfPAcxPkBV53ckq7dW7+atFB3gUQC7RytwPASN1CKHWBmmXnP66kbpFMrDmQc+bmozfs9N6WWXKb85xS58pXnOSklwFEIclnqiyHiU6hLFoHJtHY+leEd3BdeVnk2Gua74lkEU4MNdr63E5Fzuqqnj+Olemc6VquaNyJgcxDqeNwVJQxxRZbf3f/KtCK2xRiRMR8e2y48Zhx/v/RtvXytQJ2yksL7lfm6Rfv3Cx6kigEDLXg4lUEAffKrHhHtuQwIDAQABAoIBAQDO1ylloeNIAOWKRF5kg2oqkdSUeq/lhfzPa/mW5LxeQELTr0QJpEcCG6gCnvcEbqZs/1rESWirw3qTQkybsgyxu7tu/UVF7MdjPlo43zfCLznwaKAjfZv1Gb41A/gSJ/OfixRKtL7b9I4pig/ZdYNwsPoeq+xvkxRAwCZOtbhhpI2A6pnswEqVe7sPthv4LTsh27Qg1brvqbNmmZvV6KyTlpe5mNghsUOQnMzwqoKOKvhYhhK6kv2t7uSpZAOajGRAxHsSeb/ijb+ptmSMFqYKoXx3zrxFmFJPynjuXTL+faILhsuVBPfR8Mw2JJsHEyA8f9kzRGdyqCU/uD53jcPhAoGBAPrAW+A+YWzDOeTGIVawvwIAg7tuaFr+1MvZsp0vZ2mh/OIifhDmaMavnePbDDfFzuZzKN516OBoTdyQHLYBjq84FfRuRVwlX/Oe9qvkOEoIq0uiQo6ido3ewSh7HR++NFe3pajnfJ/hrzCFBJPx0s834UTdhXH/7H/Q0ZRgmZRPAoGBANxjKpYmGRQOQfaH2xnVjrdIwtp3GXriLwgvXnl4fDUUKRS9PN52R5ZbTAMYYo6lZknwJM55riIvg+P7gh2hY7c8/tb64UlxJLBPECJVOBjyM9lkEWk9UFkCJvEm4Pg5ygsJtbO2A7+TOM57Ehx5pXDAJWKEQv6GQTrlX2VEm+XNAoGBAIfK0jaPMa130AtfbMCIuPf5lV1UfjkBFfZLL5pGCKfA7LT93u2CCa3HfybdAjHV8qUEKlbG3dVhRwEyHgpGr6GeKu2TJgavytWg+Y6+6ejV5wXvmkGqI6/SuSIWAgClvazfLFxa+DeRPZF2B7Oi2voTFfB4UoMZCFdzm3vSEHmrAoGAIY6r/l7gtLATFTHMh9t/tqLKoK8/3vkvxiRIU2CoMQDX3IOQECOcdOWD5njBEQ1YTOvW/uWCQUxQ3db/EfnwEAemmh9rTF6BAqOXRlMJjqragEB/cjHW2Sa9vTx5RvKttA6Pb0TIv1Pwc2hD8rgHG+r2BlEzTkQtDIW+h9HxlwUCgYEA82wxQYlRN/c91KuCSrTblQ1RlJ5r5GQuNLbZl6RMIJoDOMYXPzEseKLpi+RC7ZIeMlz9PIuHrLnY2AThNf48OB1ul39QgUMNo1LIo3BCT6C2o6XcFZkPr/1R2c2tJeyrLQVmVpUEMFQHji0UL9/HRNci7AMHWaXkjqSsRafte2w=",
		
		//异步通知地址
		'notify_url' => "http://".$_SERVER['HTTP_HOST']."/book/public/service/pay/notify",
		
		//同步跳转
		'return_url' => "http://".$_SERVER['HTTP_HOST']."/book/public/service/pay/call_back",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",//https://openapi.alipay.com/gateway.do

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzstMNRCEaMBt5gtqAiUlbb27hhj+W5e5/9jWo7XerE29jPPLDjL+gblcf/RaT+g7tQ2ddoCqlkwoK1C+eWllikxBtePVbceUhHZvI+lmsRmGnptxBYWep/B0ELWkDBX02BIJX1yErzGHiIMPqF6JlExx7nGHQhoBvpLMDZdjs1JWK3i+I6pxRj//4ac3EBWavwlY+sdr5JxN0NhbDJx3zagG5bLx93S+GZi6Wn/LLTKD/UIIAKt3fAC2gCVq91gPT9AIMIDviZIx21EVQKrpKljSAyOU84cHBKR7VoyBkiM20SUylP7GD5dXpPGyGSbhb9GWipNF6bh4MmKrLPPhBwIDAQAB",
		
	
);