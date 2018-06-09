<?php
namespace Website\Controller;
use Think\Controller;
use Lib;
/**
 *后台首页控制器
 */
class CommentController extends CommonController {
	/**
	 * 后台首页视图
	 * @return [type] [description]
	 */
    public function index (){
		$this->clist=M('ping')->field('fz,count(fz) as c,sum(dis) as s')->group('fz')->where(array('hfid'=>0))->select();
        $this->display();
    }
	
	public function lists (){
		$fz=I('fz');
		$ping=M('ping')->where(array('fz'=>$fz))->join('LEFT JOIN lj_member ON lj_ping.mid = lj_member.id')->field('lj_ping.*,lj_member.realname,lj_member.username')->order('lj_ping.id DESC')->select();
		$this->ping = Lib\Category::unlimitedForping($ping);
		$this->fz=$fz;
		$this->display();
	}
	
	public function shen (){
		$id=I('id',intval);
		$fz=I('fz');
		$rs=M('ping')->where(array('id'=>$id))->setField('dis',1);
		if($rs){
			$this->success('审核成功',U(MODULE_NAME.'/Comment/lists',array('fz'=>$fz)));
		}else{
			$this->error('审核失败');
		}
	}
	
	public function huif (){
		$fz=I('fz');
		$data=array(
			'fz'=>$fz,
			'hfid'=>I('hfid',intval),
			'time'=>time(),
			'dis'=>0,
			'ip'=>get_client_ip(),
			'neir'=>I('neir'),
		);
		if(M("ping")->add($data)){
			$this->success('回复成功',U(MODULE_NAME.'/Comment/lists',array('fz'=>$fz)));
		}else{
			$this->error('回复失败');
		}
	}
	
	public function delte (){
		$fz=I('fz');
		if(M("ping")->where('id='.I('id'))->delete()){
			$this->success('删除成功',U(MODULE_NAME.'/Comment/lists',array('fz'=>$fz)));
		}else{
			$this->error('删除失败');
		}
	}
   
}