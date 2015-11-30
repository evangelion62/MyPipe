<?php
switch ($action) {
	case 'index':
		ob_start();
		require_once 'view/home/index.php';
		$content = ob_get_contents();
		ob_end_clean();
		require_once 'view/layout/layout.php';
	break;
	
	default:
		;
	break;
}