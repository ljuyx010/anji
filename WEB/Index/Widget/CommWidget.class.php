<?php
namespace Index\Widget;
use Think\Controller;

class CommWidget extends Controller{
	public function banner () {
		$this->display('Comm:banner');
	}
}
?>