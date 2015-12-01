<?php
class Pipe extends Entity{
	//definition de la structure base de donné
	public static $_properties = array (
			//table pipe
			'pipe'=>array(
					'name'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>Entity::VARCHAR_MAX_LEN,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'nom du pipe',
					),
					'baseurl'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>255,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'url cible de base'
					)
			),
	);
	//attributs
	protected $_name;
	protected $_baseurl;
}