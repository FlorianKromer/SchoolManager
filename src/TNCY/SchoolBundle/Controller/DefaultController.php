<?php

namespace TNCY\SchoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	public function indexAction()
	{
		return $this->render('TNCYSchoolBundle:Default:index.html.twig');
	}
	public function userAction($id)
	{

        $userManager = $this->get('fos_user.user_manager');

		$user = $userManager->find($id);
		
		if (!$user) {
	        throw $this->createNotFoundException('The user does not exist');
	    }

		return $this->render('TNCYSchoolBundle:Default:profile.html.twig',array("user"=>$user));
	}

}
