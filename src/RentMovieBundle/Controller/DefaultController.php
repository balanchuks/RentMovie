<?php

namespace RentMovieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use RentMovieBundle\Entity\LogIn;

class DefaultController extends Controller
{
    public function mainAction(Request $request)
    {
		if($request->getMethod()=='POST'){
			$username=$request->get('login');
			$password=$request->get('password');
			
			$em = $this->getDoctrine()->getEntityManager();
			$repository = $em->getRepository('RentMovieBundle:LogIn');
		
			$user = $repository->findOneBy(array('login'=>$username,'password'=>$password));
			if($user){
				return $this->render('RentMovieBundle:Default:index.html.twig', array('name'=>$user->getName()));
			}
		}
		else{
		return $this->render('RentMovieBundle:Default:index.html.twig');
		}
	}
	public function registrationAction(Request $request){
		if($request->getMethod()=='POST'){
			$username=$request->get('login');
			$password=$request->get('password');
			$name=$request->get('name');
			$surname=$request->get('surname');
			$email=$request->get('email');
			$pesel=$request->get('pesel');
			
			$user = new LogIn();
			$user->setLogin($username);
			$user->setPassword($password);
			$user->setName($name);
			$user->setSurname($surname);
			$user->setEmail($email);
			$user->setPesel($pesel);
			
			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($user);
			$em->flush();
		}
		return $this->render('RentMovieBundle:Default:registration.html.twig');
	}
}
