<?php
switch ($action) {
	case 'add':
		if (!empty($_POST['pageoptionid'])&&!empty($_POST['pipeid'])&&!empty($_POST['nameoption'])&&!empty($_POST['value'])){
			$pipeoptionManager = new PipeoptionManager($bdd);
			$pipeoption = new Pipeoption($_POST);
			$pipeoptionManager->add($pipe);
			
			header('Location: ?controler=pipeoption&action=list');
		}else{
			ob_start();
			require_once 'view/pipeoption/add.php';
			$content = ob_get_contents();
			ob_end_clean();
			require_once 'view/layout/layout.php';
		}
	break;

	case 'list':
		if (!empty($_GET['id'])){

			$pipeoptionManager = new PipeoptionManager($bdd);
			$pipeoptionsall=$pipeoptionManager-> getList('pipeid') ;
			$pipeoptions=array();
			
			foreach ($pipeoptionsall as $pipeoption){
				if ($pipeoption->pipeid()==$_GET['id']){
					$pipeoptions[]=$pipeoption;
				}
			}
			
			ob_start();
			require_once 'view/pipeoption/list.php';
			$content = ob_get_contents();
			ob_end_clean();
			require_once 'view/layout/layout.php';
		}
	break;
	
	default:
		;
	break;
}