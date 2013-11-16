<?php

class Controllers_Author
{

	public $content;
	public $request;
	public $config;
	private $seed;
	private $time;
	private $timeout;

	public function __construct($request)
	{
		$this->request=$request;
		require_once ($_SERVER['DOCUMENT_ROOT']."/../application/model/generalModel.php");
		$config_file="../application/configs/config.ini";
		$this->config=readConfigFile($config_file, APPLICATION_ENV);
		$this->seed = $this->config['verify.signature'];
		$this->timeout = $this->config['verify.timeout'];
		$this->time = time();
	}

	public function loginAction($viewparams)
	{
		$viewparams = array();
		$request = $this->request;
		$authors = new Model_Authors();

		$recaptcha = new Zend_Service_ReCaptcha($_SESSION['register']['key.public'],
												$_SESSION['register']['key.private']);
		$viewparams['captcha']=$recaptcha->getHTML();
		
		if($_POST)
		{
			$result = $recaptcha->verify(
					$_POST['recaptcha_challenge_field'],
					$_POST['recaptcha_response_field']
			);
			if (!$result->isValid()) {
				$viewparams['message'] = "Captcha Fail!!!";				
			}
			else
			{
				$author=$authors->login($_POST['email'],$_POST['password']);
				if (is_null($author))
				{
					$viewparams['message'] = "Error de autenticación";
				}
				else
				{
					$_SESSION['user'] = $author; 
					header("Location: /backend");
				}
			}
		}
		
		$this->content=renderView($this->request,$viewparams);
	}
	
	
	public function logoutAction()
	{
		unset($_SESSION['user']);
		header("Location: /index");
	}
	
	public function verifyAction()
	{
		foreach($this->request['params'] as $key => $value)
		{
			$email = $key;
			$token = $value;
		}
		$users = new Model_Users();
		$result = $users->verifyUser($email,$token);
		
		if(count($result)==0)
		header("Location: /author/register");
		
		if(($this->time - $result->timestamp)>$this->timeout)
		{
			//deleteUser
			$users->deleteUser($result->idusers);
			header("Location: /author/register");
		}
		else
		{
			//update token and this things
			//TODO Well done with an associative array
			header("Location: /backend");
		}
	}
					
	public function registerAction()
	{
		$viewparams=array();
		if($_POST){
			$user = new Entity_User();
			$user->setDisplay_name($_POST['display_name']);
			$user->setEmail($_POST['email']);
			$user->setName($_POST['name']);
			$user->setPassword($_POST['password']);
			$user->setTimestamp($this->time);
			$user->setToken($this->setToken($_POST['email']));
			$users = new Model_Users();
			$users->insertUser($user);
			$this->sendEmail($user);
// 			header("Location: /users");
		}
		$this->content=renderView($this->request,$viewparams);
	}


	public function logingmailAction($viewparams)
	{
		$config = array(				
				'callbackUrl' => 'http://anguilaperro.org/author/gmailCallback',									
				'consumerKey' => '78200168710.apps.googleusercontent.com',
				'consumerSecret' => 'Sa2FTOg6cmtGkfiqba8MUf44',					
				 'siteUrl'      => 'https://www.google.com/accounts/',
  				'authorizeUrl'    => 'https://www.google.com/accounts/OAuthAuthorizeToken',
  				'requestTokenUrl'   => 'https://www.google.com/accounts/OAuthGetRequestToken',
  				'accessTokenUrl'  => 'https://www.google.com/accounts/OAuthGetAccessToken'
		);

		$consumer = new Zend_Oauth_Consumer($config);		
		$token = null;		
		if($_SESSION['GOOGLE_ACCESS_TOKEN']){		
			$token = unserialize($_SESSION['GOOGLE_ACCESS_TOKEN']);		
		} else			
			if(isset($_GET['oauth_token'])){				
				$token = $consumer->getAccessToken( $_GET, unserialize($_SESSION['GOOGLE_REQUEST_TOKEN']) );
				$_SESSION['GOOGLE_ACCESS_TOKEN'] = serialize($token);
			}
		if(!$token){
			$token = $consumer->getRequestToken(array( 'scope' => 'https://www.googleapis.com/auth/userinfo#email'));
			$_SESSION['GOOGLE_REQUEST_TOKEN'] = serialize($token);
			$consumer->redirect();		
		} 
	}
	
	public function gmailCallbackAction($viewparams)
	{

		$config = array(
				'callbackUrl' => 'http://anguilaperro.org/author/gmailCallback',
				'siteUrl'      => 'https://accounts.google.com/o/oauth2/auth',							
				'consumerKey' => '78200168710.apps.googleusercontent.com',
				'consumerSecret' => 'Sa2FTOg6cmtGkfiqba8MUf44'
		);
		$consumer = new Zend_Oauth_Consumer($config);
		 
		if (!empty($_GET) && isset($_SESSION['GMAIL_REQUEST_TOKEN'])) {
		    $token = $consumer->getAccessToken(
		                 $_GET,
		                 unserialize($_SESSION['GMAIL_REQUEST_TOKEN'])
		             );
		    $_SESSION['GMAIL_REQUEST_TOKEN'] = serialize($token);
		 
		    // Now that we have an Access Token, we can discard the Request Token
		    $_SESSION['GMAIL_REQUEST_TOKEN'] = null;
		} else {
		    // Mistaken request? Some malfeasant trying something?
		    echo ('Invalid callback request. Oops. Sorry.');

	
		}

		//"HE LLEGADO AQUI FALTA AUTORIZACION"		

	}

	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content, 'request'=>$this->request);
		echo renderLayout('login', $layoutparams);
	}
	
	private function setToken($email){
		return $token = md5($email.$this->time.$this->seed);
	}
	
	private function sendEmail($user){
		$config['server']=$this->config['smtp.server'];
		$config['ssl']=$this->config['smtp.ssl'];
		$config['port']=$this->config['smtp.port'];
		$config['auth']=$this->config['smtp.auth'];
		$config['username']=$this->config['smtp.username'];
		$config['password']=$this->config['smtp.password'];
		$config['urlActivate']= 'http://anguilaperro.local/author/verify/'.$user->getEmail().'/'.$user->getToken();
		$transport = new Zend_Mail_Transport_Smtp($config['server'], $config);
		
		
		$mail = new Zend_Mail();
		$mail->addTo($user->getEmail(), 'Test');
		
		$mail->setSubject('Activate your account');
		$mail->setBodyText("Activate your account ".$config['urlActivate']);
		$mail->send($transport);
	}
}
