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
				'siteUrl'      => 'https://accounts.google.com/o/oauth2/auth',							
				'consumerKey' => '78200168710.apps.googleusercontent.com',
				'consumerSecret' => 'Sa2FTOg6cmtGkfiqba8MUf44'
		);
		$consumer = new Zend_Oauth_Consumer($config);
		
		$token = $consumer->getRequestToken();		
		$_SESSION['GMAIL_REQUEST_TOKEN'] = serialize($token);
		$consumer->redirect();
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
	}

	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content);
		echo renderLayout('login', $layoutparams);
	}
}
