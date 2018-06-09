<?php
namespace Index\Controller;
use Think\Controller;
use \Lib;

class VoteController extends Controller{
	//投票视图
	public function index () {
		$id = I('id','',intval);
		$cate = Lib\Cate::catetkd($id);
		$this->cid = $cate[0]['id'];
		$this->fid = $cate[0]['pid'];
		$this->title = $cate[0]['name'];
		$this->keywords = $cate[0]['keywords'];
		$this->description = $cate[0]['description'];
		$this->pic = $cate[0]['pic'];
		$this->model = $cate[0]['model'];
		if ($cate[0]['model'] !== 'Vote'){
			$this->error('页面不存在');
		}

		$vote=M('vote')->where(array('cid'=>$id))->order('sort ASC,id ASC')->select();
		$vas=array();
		foreach($vote as $v){
			$an = array();
			$ans = M('answer')->where(array('vid'=>$v['id']))->select();
			$an = array('ans'=>$ans);
			$vas[] = array_merge($v,$an);
		}
		$this->vote=$vas;
		$this->display();
		
	}
	//验证码
	Public function verify(){
		ob_clean();
    $config = array(
        'font-size' => 10,
        'length' => 4,
        'imageW' => 180,
        'imageH' => 50,
        'useNoise' => false,
    	);
	$verify = new \Think\Verify($config);
	$verify->entry(2);
	}

	//投票记录入库
	public function voteDo(){
		
			if (IS_POST){
				
			 $ip = get_client_ip();
			 $cid= I('cid','',intval);
			 $dx = $_POST['radio'];
			 $text= $_POST['text'];
			 if(M('record')->where(array('cid'=>$cid,'ip'=>$ip))->find()){$this->error('您已经参加了答题，请不要重复参加！');}	//防刷票
			 $fx=array();
			 foreach($dx as $v){
				$fx=array_merge($v,$fx);
			 }
			 $sum=count($fx)+count($text);
			 $count=M('vote')->where(array('cid'=>$cid))->count();

			 if($sum >= $count){
				
				$w['id']=array('in',$fx);
				M('answer')->where($w)->setInc('votes',1);
				if($text){
					foreach($text as $key=>$vol){
						$arr=array();
						$arr=array('vid'=>$key,'answer'=>$vol);
						M('answer')->add($arr);
						$str=$str."[简答".$key.":".$vol."]";
					}					
				}
				$char = implode(",", $dx);
				$date=array(
					'cid'=>$cid,
					'ip'=>$ip,
					'time'=>time(),
					'records'=> "单/多选:".$char."<br />".$str
					);
				if(M('record')->add($date)){
					$this->success('答题成功,谢谢您的参与',U(MODULE_NAME.'/Vote/index',array('id'=>$cid)));
				}else{
					$this->error('答题失败');
				}
			 }else{
				$this->error('请填写所有的题目');
			 }
			}else{
				$this->error('页面不存在');
			}
	}
	
	
}
?>