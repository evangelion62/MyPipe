<?php
class Pipeoption extends Entity{
	//definition de la structure base de donné
	public static $_properties = array (
			//table pipeoption
			'pipeoption'=>array(
					'pipeid'=>array(
							Entity::TYPE=>Entity::INT,
							Entity::LEN=>Entity::INT_MAX_LEN,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'id de la page de l image',
					),
					'nameoption'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>Entity::VARCHAR_MAX_LEN,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'nom de l option',
					),
					'value'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>255,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'valeur'
					)
			),
	);
	//attributs
	protected $_pageoptionid;
	protected $_pipeid;
	protected $_nameoption;
	protected $_value;
}