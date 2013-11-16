<?php 
class Entity_User{
	public $email;
	public $name;
	public $display_name;
	private $password;
	private $token;
	private $timestamp;
	public $user_state;
	
	/**
	 * @return the $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $display_name
	 */
	public function getDisplay_name() {
		return $this->display_name;
	}

	/**
	 * @return the $password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param field_type $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param field_type $display_name
	 */
	public function setDisplay_name($display_name) {
		$this->display_name = $display_name;
	}

	/**
	 * @param field_type $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}
	/**
	 * @return the $token
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * @return the $timestamp
	 */
	public function getTimestamp() {
		return $this->timestamp;
	}

	/**
	 * @return the $user_state
	 */
	public function getUser_state() {
		return $this->user_state;
	}

	/**
	 * @param field_type $token
	 */
	public function setToken($token) {
		$this->token = $token;
	}

	/**
	 * @param field_type $timestamp
	 */
	public function setTimestamp($timestamp) {
		$this->timestamp = $timestamp;
	}

	/**
	 * @param field_type $user_state
	 */
	public function setUser_state($user_state) {
		$this->user_state = $user_state;
	}
}
?>