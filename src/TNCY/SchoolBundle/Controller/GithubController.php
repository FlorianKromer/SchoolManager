<?php

namespace TNCY\SchoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GithubController extends Controller
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

    public function userRepositoriesAction($id)
    {

        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->find($id);
        
        if (!$user) {
            throw $this->createNotFoundException('The user does not exist');
        }

        $repositories = $this->getUserRepositories($user->getGithub());
        return $this->render('TNCYSchoolBundle:Default:github.html.twig',array("user"=>$user,"repositories"=>json_decode($repositories,true)));
    }

    public function getUserRepositories($name){
        return $this->request('users/FlorianKromer/repos');
    }

    public function request($url){
        $base = 'https://api.github.com/';
        $ch = curl_init();
        //config curl
        curl_setopt($ch, CURLOPT_URL, $base.$url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_USERAGENT,'Awesome-Octocat-App');

        //result
        $result = curl_exec($ch);

        
        curl_close($ch);

        return $result;
    }
}