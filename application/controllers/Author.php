<?php

class Controllers_Author
{

	public $content;
	public $request;

	public function __construct($request)
	{
		$this->request=$request;
	}

	public function loginAction($viewparams)
	{
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function logoutAction($viewparams)
	{
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function registerAction($viewparams)
	{
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
		//"HE LLEGADO AQUI FALTA AUTORIZACION"		
	}

	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content);
		echo renderLayout('login', $layoutparams);
	}
}
