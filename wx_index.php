<?php
/**
 * wechat推送类，精简版
 * create time 2018/07/19
 * @author Wang
 */
Class WechatPush{
	//推送消息模板,XML格式
	private $template;
	//推送消息内容
	private $content;

	/**
	 * @todo  构造函数，初始化类内参数
	 * @param [string] $[template] [推送消息模板]
	 * @param [string] $[content] [推送消息内容]
	 */
	public function __construct($template = '',$content = ''){
		$this->content  = $content;
		$this->template = $template;
	}
	/**
	 * @todo  推送消息
	 * @return [type] [description]
	 */
	public function reponseMsg(){
		//获取到微信推送过来post数据（xml格式）
		if(PHP_VERSION >= '7.0.0'){
			//据说php7不再支持HTTP_RAW_POST_DATA
			$post_arr = file_get_contents('php://input');
		}else{
			$post_arr = $GLOBALS['HTTP_RAW_POST_DATA'];
		}
		if(empty($post_arr)){
			$this->replyError('微信传输数据获取为空');
		}
        $post_obj = simplexml_load_string($post_arr);
        //判断该数据包是否是订阅的事件推送
        if(strtolower($post_obj->MsgType) === 'event'){
        	//如果是关注 subscribe 事件
            if( strtolower($post_obj->Event === 'subscribe') ){
            	$toUser   = $post_obj->FromUserName;
                $fromUser = $post_obj->ToUserName;
                $time     = time();
                $msgType  = 'text';
                //.'公众账号:::::'.$post_obj->FromUserName.'用户id:::::'.$postObj->ToUserName
                $content  = $this->content;
                $template = $this->template;
				if(empty($template)){
					$this->replyError('推送模板为空');
				}
				if(empty($content)){
					$this->replyError('推送内容为空');
				}
                $info     = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
                $this->replySuccess($info);
            }
        }
	}
	/**
	 * @todo  成功
	 * @param  [string]  $data [成功返回的推送信息]
	 * @return [array]   $response
	 */
	private function replySuccess($data){
		$state = 1;
		$response = ['code' => $state, 'result' => $data];
		return $response;
	}
	/**
	 * @todo  失败
	 * @param  [string] $msg [失败返回的信息]
	 * @return [array]  $response
	 */
	private function replyError($msg){
		$state = -1;
		$response = ['code' => $state, 'result' => $data];
		return $response;
	}
}



$content = '欢迎关注我们的微信公众账号';
$template = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[%s]]></MsgType>
			<Content><![CDATA[%s]]></Content>
			</xml>";
$wechat_push = new WechatPush($template, $content);
$msg = $wechat_push->reponseMsg();
if($msg['code'] === 1){
	echo $msg['result'];
}
