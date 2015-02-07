<?php

namespace TNCY\SchoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    public function indexAction()
    {
        return $this->render('TNCYSchoolBundle:Default:index.html.twig');
    }

    /**
     * get the user information
     * @param  int id
     * @return view
     */
    public function userAction($id)
    {

        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->find($id);
        
        if (!$user) {
            throw $this->createNotFoundException('The user does not exist');
        }

        return $this->render('TNCYSchoolBundle:Default:profile.html.twig',array("user"=>$user));
    }
    /**
     * get the github information
     * @param  int id
     * @return view
     */
    public function githubUserAction($id)
    {

        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->find($id);
        
        if (!$user) {
            throw $this->createNotFoundException('The user does not exist');
        }

        $repositories = $this->getGithubUserRepositories($user->getGithub());
        return $this->render('TNCYSchoolBundle:Default:github.html.twig',array("user"=>$user,"repositories"=>json_decode($repositories,true)));
    }
    /**
     * get the user's github repositories 
     * @param  [type]
     * @return [type]
     */
    public function getGithubUserRepositories($name){
        return $this->githubRequest('users/FlorianKromer/repos');
    }

    /**
     * template for a github api request
     * @param  [type]
     * @return [type]
     */
    public function githubRequest($url){
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

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }



    /**
     * template for a facebook api request
     * @param  [type]
     * @return [type]
     */
    public function facebookRequest($url){
        $base = 'https://api.github.com/';
        $ch = curl_init();
        //config curl
        curl_setopt($ch, CURLOPT_URL, $base.$url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}