<?php
namespace Index\Widget;
use Think\Controller;

class BannWidget extends Controller{
	public function banner () {
		$this->display('Bann:banner');
	}
}
?>