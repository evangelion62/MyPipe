<?php
switch ($action) {
	case 'index':
		
		/*création des tables*/
		$pipeManager = new PipeManager($bdd);
		$pipeManager->createTable();
		$pipeoptionManager = new PipeoptionManager($bdd);
		$pipeoptionManager->createTable();
		$imgManager = new ImgManager($bdd);
		$imgManager->createTable();
		$pageManager = new PageManager($bdd);
		$pageManager->createTable();
		$pageoptionManager = new PageoptionManager($bdd);
		$pageoptionManager->createTable();
		$userManager = new UserManager($bdd);
		$userManager->createTable();
		$tokenManager = new TokenManager($bdd);
		$tokenManager->createTable();
		
		/*redirection*/
		header('Location: ?controler=install&action=firstuser');
	break;
	
	case 'firstuser':
		$userManager = new UserManager($bdd);
		if ($userManager->count()>0){
			header('Location: ?controler=index');
		}else{
			header('Location: ?controler=user&action=add');
		}
	break;
	
	default:
		;
	break;
}