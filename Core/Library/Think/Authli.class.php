<?php
namespace Think;

class Authli{

	    //默认配置
    protected $_config = array(
        'AUTH_ON'           => true,                      // 认证开关
        'AUTH_TYPE'         => 1,                         // 认证方式，1为实时认证；2为登录认证。
        'AUTH_GROUP'        => 'auth_group',        // 用户组数据表名
        'AUTH_GROUP_ACCESS' => 'auth_group_access', // 用户-用户组关系表
        'AUTH_RULE'         => 'auth_rule',         // 权限规则表
        'AUTH_USER'         => 'admin'             // 用户信息表
    );

    public function __construct() {
        $prefix = C('DB_PREFIX');
        $this->_config['AUTH_GROUP'] = $prefix.$this->_config['AUTH_GROUP'];
        $this->_config['AUTH_RULE'] = $prefix.$this->_config['AUTH_RULE'];
        $this->_config['AUTH_USER'] = $prefix.$this->_config['AUTH_USER'];
        $this->_config['AUTH_GROUP_ACCESS'] = $prefix.$this->_config['AUTH_GROUP_ACCESS'];
        if (C('AUTH_CONFIG')) {
            //可设置配置项 AUTH_CONFIG, 此配置项为数组。
            $this->_config = array_merge($this->_config, C('AUTH_CONFIG'));
        }
    }

    /**
      * 检查权限
      * @param name string|array  需要验证的规则列表,支持逗号分隔的权限规则或索引数组
      * @param uid  int           认证用户的id
      * @param string mode        执行check的模式
      * @param relation string    如果为 'or' 表示满足任一条规则即通过验证;如果为 'and'则表示需满足所有规则才能通过验证
      * @return boolean           通过验证返回true;失败返回false
     */
    public function check($name, $uid) {
        if (!$this->_config['AUTH_ON']) return true;
        $user=M()->table($this->_config['AUTH_USER'])->field('csr')->where(array('id'=>$uid))->find();
        if($user['csr']){return true;}
        if(!session('?allist')){
        $allist = $this->allAuthList(); //获取所有有效规则列表
        session('allist',$allist);
        }
        if(!session('?rule_'.$uid)){
        $rule = $this->getAuthList($uid); //获取用户需要验证的所有有效规则列表
        session('rule_'.$uid,$rule);
        }
        
        if (is_string($name)) {
            $name = strtolower($name);
        }
        
        if(!in_array($name,session('allist'))){
            return true;
        }
        if(in_array($name,session('rule_'.$uid))){
            return true;
        }else{
            return false;
        }
        
    }

    //读取数据库中所有的权限列表
    protected function allAuthList(){
        $rules = M()->table($this->_config['AUTH_RULE'])->field('condition,name')->select();
        foreach($rules as $rule){
            $authList[] = strtolower($rule['name']);
        }
        return array_unique($authList);
    }
    /**
     * 获得权限列表
     * @param integer $uid  用户id
     * @param integer $type 
     */
    protected function getAuthList($uid) {

        $user_groups = M()
            ->table($this->_config['AUTH_GROUP_ACCESS'] . ' a')
            ->where("a.uid=".$uid." and g.status='1'")
            ->join($this->_config['AUTH_GROUP']." g on a.group_id=g.id")
            ->field('uid,group_id,title,rules')->find();
        $rule_ids=explode(',', $user_groups['rules']);
        $rules=M()->table($this->_config['AUTH_RULE'])->field('name')->where(array('id'=>array('in',$rule_ids)))->select();
        //循环规则，判断结果。
        $authList = array();   //
        foreach ($rules as $rule) {            
            $authList[] = strtolower($rule['name']);
        }

        return array_unique($authList);
    }

}