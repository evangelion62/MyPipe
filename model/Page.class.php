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
							Entity::KEY=>Entity::UNIQUE_KEY
					),
					'url'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>255,
							Entity::NULL_OR_NOT=>Entity::NOT_NULL,
							Entity::COMMENT=>'url image',
							Entity::KEY=>Entity::UNIQUE_KEY
					),
					'imgsrcs'=>array(
							Entity::TYPE=>Entity::TEXT,
							Entity::LEN=>9999,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'url image'
					),
					'views'=>array(
							Entity::TYPE=>Entity::INT,
							Entity::LEN=>Entity::INT_MAX_LEN,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'url image'
					),
					
					'dls'=>array(
							Entity::TYPE=>Entity::INT,
							Entity::LEN=>Entity::INT_MAX_LEN,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'url image'
					),
					'nblike'=>array(
							Entity::TYPE=>Entity::INT,
							Entity::LEN=>Entity::INT_MAX_LEN,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'url image'
					),
					'licens'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>255,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'url image'
					),
					'username'=>array(
							Entity::TYPE=>Entity::VARCHAR,
							Entity::LEN=>255,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'url image'
					),
					'summary'=>array(
							Entity::TYPE=>Entity::TEXT,
							Entity::LEN=>9999,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'url image'
					),
					'comments'=>array(
							Entity::TYPE=>Entity::TEXT,
							Entity::LEN=>9999,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'url image'
					),
					'tags'=>array(
							Entity::TYPE=>Entity::TEXT,
							Entity::LEN=>9999,
							Entity::NULL_OR_NOT=>NULL,
							Entity::COMMENT=>'url image'
					),
						
			),
	);
	//attributs
	protected $_title;
	protected $_url;
	protected $_imgsrcs;
	protected $_views;
	protected $_dls;
	protected $_nblike;
	protected $_licens;
	protected $_username;
	protected $_summary;
	protected $_comments;
	protected $_tags;
}