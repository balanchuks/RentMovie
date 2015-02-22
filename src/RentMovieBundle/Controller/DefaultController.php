<?php

namespace RentMovieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use RentMovieBundle\Entity\Client;
use RentMovieBundle\Entity\Payment;
use RentMovieBundle\Entity\Orders;
use RentMovieBundle\Entity\Movies;
use RentMovieBundle\Models\Logout;

class DefaultController extends Controller
{
	private $mid;
    public function mainAction(Request $request)
    {
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:Client');
		
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
			
			$con=pg_connect("host=sbazy user=s175519 dbname=s175519 password=s160596");
			$q="Select login from client where login='$username'";
			$r=pg_exec($con,$q);
			if (pg_num_rows($r)>0)
			{
				echo "<script type='text/javascript'>alert('Login name already exist!');</script>";
					return $this->render('RentMovieBundle:Default:registration.html.twig');
			}
			else{
			/*$q="insert into client values('$username','$password','$name','$surname','$email','$pesel')";
			$r=pg_exec($con,$q);*/
			
			$user = new Client();
			$user->setLogin($username);
			$user->setPassword($password);
			$user->setName($name);
			$user->setSurname($surname);
			$user->setEmail($email);
			$user->setPesel($pesel);
			
			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($user);
			$em->flush();
			return $this->render('RentMovieBundle:Default:index.html.twig');}
		}
		else {
			return $this->render('RentMovieBundle:Default:registration.html.twig');
		}
	}
	public function logoutAction(Request $request){
		$session=$this->getRequest()->getSession();
		$session->clear();
		return $this->render('RentMovieBundle:Default:index.html.twig');
	}
	public function borrowAction(){
		$a=$_SERVER['HTTP_REFERER'];
			$tokens = explode('/', $a);
			$this->mid = $tokens[sizeof($tokens)-1];
			
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:Client');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				$session->set('idd',$this->mid);
				if($userr){
					return $this->render('RentMovieBundle:Default:form.html.twig', array('name'=>$userr->getName()));
				}
			}
		else{
		return $this->render('RentMovieBundle:Default:cantBorrow.html.twig');
		}
	}
	public function mailAction(Request $request){
			$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:Client');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				
				$con=pg_connect("host=sbazy user=s175519 dbname=s175519 password=s160596");
				$q="Select email from client where login='$username'";
				$r=pg_exec($con,$q);
				$val = pg_fetch_result($r, 0, 0);
				
				$radio=$request->get('optionsRadios');
				$term=$request->get('term');
				$date=$request->get('date');
				$month=$request->get('month');
				$year=$request->get('year');
				
				
			if($radio=='option1')
				$rb='cash';
			else if($radio=='option2')
				$rb='credit card';
			$p1=$year."-".$month."-".$date;
			$pd=\DateTime::createFromFormat('Y-m-d', $p1);
				
			
				
				
				
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
			
			
			$repo = $em->getRepository('RentMovieBundle:Payment');
			
			$payment = new Payment();
			$payment->setForm($rb);
			$payment->setTerm($term);
			$payment->setPaymentdate($pd);
			if($pd<=date("Y-m-d"))
			$status='paid';
			
			else if($pd>date("Y-m-d"))
			$status='in progress';
			
			$payment->setStatus($status);
			
			$em->persist($payment);
			$em->flush();
			
			
			$pid = $payment->getPaymentid();
			
			
			
			$a=$_SERVER['HTTP_REFERER'];
			$tokens = explode('/', $a);
			$mid = $tokens[sizeof($tokens)-1];
			$m=(int)$mid;
				$q="Select clientID from client where login='$username'";
				$r=pg_exec($con,$q);
				$cid = pg_fetch_result($r, 0, 0);
				$c=(int)$cid;
			$con=pg_connect("host=sbazy user=s175519 dbname=s175519 password=s160596");
			$query = "INSERT INTO orders(clientID, movieID, paymentID) VALUES ($c, $m, $pid);";
			$r=pg_exec($con,$query);
			
			$url = 'https://mandrillapp.com/api/1.0/messages/send.json';
        	$params = [
            'message' => array(
                'subject' => 'Rent Movie: Information according payment',
                'text' => "Form of payment: ".$rb.". Term of payment: ".$term.". Date of payment: ".$p1."C: ".$c."M: ".$m."P: ".$pid,
                'html' => '<p>'."Form of payment: ".$rb.". Term of payment: ".$term.". Date of payment: ".$p1."C: ".$c."M: ".$m."P: ".$pid.'</p>',
                'from_email' => 'uek@no-replay.com',
                'to' => array(
						array(
							'email' => $val,
							'name' => 'Admin'
							)
						)
				)
			];

				$params['key'] = 'HEpZLrPrRBEa7W9fLAJKeQ';
				$params = json_encode($params);
				$ch = curl_init(); 

				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
				curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

				$head = curl_exec($ch); 
				$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
				curl_close($ch); 
				echo "<script type='text/javascript'>alert('Sending e-mail to address: $val. Form of payment: $rb Term of payment $term  Date of payment $p1 C:  $c M: $m P: $pid');</script>";
			
			return $this->render('RentMovieBundle:Default:index.html.twig', array('name'=>$userr->getName()));
		}
		else{
		return $this->render('RentMovieBundle:Default:index.html.twig');
		}
	}
	public function borrowedAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:Client');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:borrowed.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:borrowed.html.twig');
	}
	public function ordersAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:Client');
		if($session->has('login')){
				$login = $session->get('login');
				$username=$login->getUsername();
				$password=$login->getPassword();
				$userr = $repository->findOneBy(array('login'=>$username,'password'=>$password));
				if($userr){
					return $this->render('RentMovieBundle:Default:orders.html.twig', array('name'=>$userr->getName()));
				}
			}
		return $this->render('RentMovieBundle:Default:orders.html.twig');
	}
	public function prideAction(){
		$session=$this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RentMovieBundle:Client');
		
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
		$repository = $em->getRepository('RentMovieBundle:Client');
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
}
