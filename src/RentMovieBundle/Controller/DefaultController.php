<?php

namespace RentMovieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use RentMovieBundle\Entity\LogIn;
use RentMovieBundle\Models\Logout;

class DefaultController extends Controller
{
    public function mainAction(Request $request)
    {
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		
		if($request->getMethod()=='POST'){
			$session->clear();
		
			$username=$request->get('login');
			$password=$request->get('password');
			
			$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
			if($userr){
			$login=new Logout();
			$login->setUsername($username);
			$login->setPassword($password);
			$session->set('login',$login);
			/*	$session = $this->getRequest()->getSession();
			$session->set('foo', $userr->getName());
			$session->save();*/
				return $this->render('RentMovieBundle:Default:index.html.twig', array('name'=>$userr->getName()));
			}
		}
		else{
			if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:index.html.twig', array('name'=>$userr->getName()));
				}
			}
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
	public function logoutAction(Request $request){
		$session=$this->getRequest()->getSession();
		$session->clear();
		return $this->render('RentMovieBundle:Default:index.html.twig');
	}
	public function prideAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:pride.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:pride.html.twig');
	}
	public function gameAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:game.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:game.html.twig');
	}
	public function beanAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:bean.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:bean.html.twig');
	}
	public function wordsAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:words.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:words.html.twig');
	}
	public function mindAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:mind.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:mind.html.twig');
	}
	public function penguinsAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:penguins.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:penguins.html.twig');
	}
	public function dragonAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:dragon.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:dragon.html.twig');
	}
	public function sinisterAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:sinister.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:sinister.html.twig');
	}
	public function conjuringAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:conjuring.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:conjuring.html.twig');
	}
	public function hobbitOneAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:hobbit1.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:hobbit1.html.twig');
	}
	public function hobbitTwoAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:hobbit2.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:hobbit2.html.twig');
	}
	public function lucyAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:lucy.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:lucy.html.twig');
	}
	public function melodramaAction()
    {
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:melodrama.html.twig', array('name'=>$userr->getName()));
				}
			}
        return $this->render('RentMovieBundle:Default:melodrama.html.twig', array());
    }
	 public function comedyAction()
    {
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:comedy.html.twig', array('name'=>$userr->getName()));
				}
			}
        return $this->render('RentMovieBundle:Default:comedy.html.twig', array());
    }
	 public function dramaAction()
    {
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:drama.html.twig', array('name'=>$userr->getName()));
				}
			}
        return $this->render('RentMovieBundle:Default:drama.html.twig', array());
    }
	 public function horrorAction()
    {
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:horror.html.twig', array('name'=>$userr->getName()));
				}
			}
        return $this->render('RentMovieBundle:Default:horror.html.twig', array());
    }
	 public function fantasyAction()
    {
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:fantasy.html.twig', array('name'=>$userr->getName()));
				}
			}
        return $this->render('RentMovieBundle:Default:fantasy.html.twig', array());
    }
	 public function scienceAction()
    {
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:science.html.twig', array('name'=>$userr->getName()));
				}
			}
        return $this->render('RentMovieBundle:Default:science.html.twig', array());
    }
	public function cartoonAction()
    {
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:LogIn');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:cartoon.html.twig', array('name'=>$userr->getName()));
				}
			}
        return $this->render('RentMovieBundle:Default:cartoon.html.twig', array());
    }
	public function formAction()
    {
        return $this->render('RentMovieBundle:Default:form.html.twig', array());
    }
}
