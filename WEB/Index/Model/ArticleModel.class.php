<?php
namespace Index\Model;
use Think\Model\RelationModel;

class ArticleModel extends RelationModel{
	Protected $tableName = 'article';
	Protected $_link = array(
		'attr' => array(
			'mapping_type' => self::MANY_TO_MANY,
			'mapping_name' => 'attr',
			'foreign_key' => 'artid',
			'relation_foreign_key' => 'attrid',
			'relation_table' => 'lj_article_attr'
			)
		);
}
?>