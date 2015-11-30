<?php
class Page extends Entity{
	//definition de la structure base de donné
	public static $_properties = array (
			//table page
			'page'=>array(
					'title'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>Entity::VARCHAR_MAX_LEN,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'nom de l image',
					),
					'url'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>255,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'url image'
					)
			),
	);
	//attributs
	protected $_title;
	protected $_url;
}