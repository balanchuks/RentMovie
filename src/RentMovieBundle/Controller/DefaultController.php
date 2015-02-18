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
<<<<<<< HEAD
	public function prideAction(){
		return $this->render('RentMovieBundle:Default:pride.html.twig');
	}
	public function gameAction(){
		return $this->render('RentMovieBundle:Default:game.html.twig');
	}
	public function beanAction(){
		return $this->render('RentMovieBundle:Default:bean.html.twig');
	}
	public function wordsAction(){
		return $this->render('RentMovieBundle:Default:words.html.twig');
	}
	public function mindAction(){
		return $this->render('RentMovieBundle:Default:mind.html.twig');
	}
	public function penguinsAction(){
		return $this->render('RentMovieBundle:Default:penguins.html.twig');
	}
	public function dragonAction(){
		return $this->render('RentMovieBundle:Default:dragon.html.twig');
	}
	public function sinisterAction(){
		return $this->render('RentMovieBundle:Default:sinister.html.twig');
	}
	public function conjuringAction(){
		return $this->render('RentMovieBundle:Default:conjuring.html.twig');
	}
	public function hobbitOneAction(){
		return $this->render('RentMovieBundle:Default:hobbit1.html.twig');
	}
	public function hobbitTwoAction(){
		return $this->render('RentMovieBundle:Default:hobbit2.html.twig');
	}
	public function lucyAction(){
		return $this->render('RentMovieBundle:Default:lucy.html.twig');
	}
=======
	public function melodramaAction()
    {
        return $this->render('RentMovieBundle:Default:melodrama.html.twig', array());
    }
	 public function comedyAction()
    {
        return $this->render('RentMovieBundle:Default:comedy.html.twig', array());
    }
	 public function dramaAction()
    {
        return $this->render('RentMovieBundle:Default:drama.html.twig', array());
    }
	 public function horrorAction()
    {
        return $this->render('RentMovieBundle:Default:horror.html.twig', array());
    }
	 public function fantasyAction()
    {
        return $this->render('RentMovieBundle:Default:fantasy.html.twig', array());
    }
	 public function scienceAction()
    {
        return $this->render('RentMovieBundle:Default:science.html.twig', array());
    }
	public function cartoonAction()
    {
        return $this->render('RentMovieBundle:Default:cartoon.html.twig', array());
    }
>>>>>>> 7dd633d27bdba3512b82ba79f537fc86573d34cb
}
