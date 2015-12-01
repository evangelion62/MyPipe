<?php
class Pageoption extends Entity{
	//definition de la structure base de donné
	public static $_properties = array (
			//table page
			'pageoption'=>array(
					'pageid'=>array(
							Entity::TYPE=>Entity::INT,
							Entity::LEN=>Entity::INT_MAX_LEN,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'id de la page de l option',
					),
					'name'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>Entity::VARCHAR_MAX_LEN,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'nom de l option',
					),
					'value'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>Entity::VARCHAR_MAX_LEN,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'valeur de l option'
					)
			),
	);
	//attributs
	protected $_pageid;
	protected $_name;
	protected $_value;
}