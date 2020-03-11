<?php
include dirname(__FILE__) . '/HTTPSocket.php';
class DAClass{

	public $socket;
	
	function __construct(){
		 
		$sock = new HTTPSocket;
		$sock->connect('server ip / domain',2222);
		$sock->set_login('admin username', 'admin password');
		$this->socket = $sock;
	}
	function CMD_API_ACCOUNT_USER($username, $email, $password, $domain, $package){
		$sock = $this->socket;
		$array = array(
			'action' => 'create',
			'add' => 'Submit',
			'username' => $username,
			'email' => $email,
			'passwd' => $password,
			'passwd2' => $password,
			'domain' => $domain,
			'package' => $package,
			'ip' => 'server ip',
			'notify' => 'no');
		$sock->query('/CMD_API_ACCOUNT_USER', $array);
		$result = $sock->fetch_parsed_body();
		return print_r($result);
	}
	function CMD_API_ACCOUNT_RESELLER($username, $email, $password, $domain, $package){
		$sock = $this->socket;
		$array = array(
			'action' => 'create',
			'add' => 'Submit',
			'username' => $username,
			'email' => $email,
			'passwd' => $password,
			'passwd2' => $password,
			'domain' => $domain,
			'package' => $package,
			'ip' => 'shared',
			'notify' => 'no');
		$sock->query('/CMD_API_ACCOUNT_RESELLER', $array);
		$result = $sock->fetch_parsed_body();
		return print_r($result);
	}
	function userUsedQuota($user) {
		$sock = $this->socket;
		$arr = Array('user' => $user);
		$sock->query('/CMD_API_SHOW_USER_USAGE', $arr);
		$result = $sock->fetch_parsed_body();
		return print_r($result['quota']);
	}
	function userMaxQuota($user) {
		$sock = $this->socket;
		$arr = Array('user' => $user);
		$sock->query('/CMD_API_SHOW_USER_CONFIG', $arr);
		$result = $sock->fetch_parsed_body();
		return print_r($result['quota']);
	}
	function userUsedBandwidth($user) {
		$sock = $this->socket;
		$arr = Array('user' => $user);
		$sock->query('/CMD_API_SHOW_USER_USAGE', $arr);
		$result = $sock->fetch_parsed_body();
		return print_r($result['bandwidth']);
	}
	function userMaxBandwidth($user) {
		$sock = $this->socket;
		$arr = Array('user' => $user);
		$sock->query('/CMD_API_SHOW_USER_CONFIG', $arr);
		$result = $sock->fetch_parsed_body();
		return print_r($result['bandwidth']);
	}
	function userDomain($user) {
		$sock = $this->socket;
		$arr = Array('user' => $user);
		$sock->query('/CMD_API_SHOW_USER_CONFIG', $arr);
		$result = $sock->fetch_parsed_body();
		return print_r($result['domain']);
	}
	function userPackage($user) {
		$sock = $this->socket;
		$sock->set_method("GET");
		$arr = Array('user' => $user);
		$sock->query('/CMD_API_SHOW_USER_CONFIG', $arr);
		$result = $sock->fetch_parsed_body();
		return print_r($result['package']);
	}
	function resendPassword($user, $password) {
		$sock = $this->socket;
		$sock->set_method("POST");
		$arr = Array(
					'username' => $user,
					'passwd' => $password,
					'passwd2' => $password
				);
 		$sock->query('/CMD_API_USER_PASSWD', $arr);
		//$result = $sock->fetch_parsed_body();
		//return print_r($result);
	}
	function deleteUser($user) {
		$sock = $this->socket;
		$sock->set_method("POST");
		$arr = Array(
					'confirmed' => 'Confirm',
					'delete' => 'yes',
					'select0' => $user 
					
				);
 		$sock->query('/CMD_API_SELECT_USERS', $arr);
		//$result = $sock->fetch_parsed_body();
		//return print_r($result);
	}
	function updateUserPackage($user, $package) {
		$sock = $this->socket;
		$sock->set_method("POST");
		$arr = Array(
					'action' => 'package',
					'user' => $user,
					'package' => $package 
					
				);
 		$sock->query('/CMD_API_MODIFY_USER', $arr);
		//$result = $sock->fetch_parsed_body();
		//return print_r($result);
	}
	function suspendUser($user) {
		$sock = $this->socket;
		$sock->set_method("POST");
		$arr = Array(
					'location' => 'CMD_ADMIN_SHOW',
					'suspend' => 'suspend',
					'select0' => $user 
					
				);
 		$sock->query('/CMD_API_SELECT_USERS', $arr);
		//$result = $sock->fetch_parsed_body();
		//return print_r($result);
	}
	function unSuspendUser($user) {
		$sock = $this->socket;
		$sock->set_method("POST");
		$arr = Array(
					'location' => 'CMD_ADMIN_SHOW',
					'suspend' => 'unsuspend',
					'select0' => $user 
					
				);
 		$sock->query('/CMD_API_SELECT_USERS', $arr);
		//$result = $sock->fetch_parsed_body();
		//return print_r($result);
	}
	function createUserPackage($package_name, $package_quota) {
		$sock = $this->socket;
		$sock->set_method("POST");
		$arr = array(
					'action' => 'create',
					'add' => 'Save',
					'packagename' => $package_name,
					'aftp' => 'OFF',
					'dnscontrol'=> 'ON',
					'bandwidth' => 'unlimited',
					'domainptr' => 'unlimited',
					'ftp' => 'unlimited',
					'mysql' => 'unlimited',
					'nemailf' => 'unlimited',
					'nemailml' => 'unlimited',
					'nemailr' => 'unlimited',
					'nemails'=> 'unlimited',
					'nsubdomains' => 'unlimited',
					'quota' => $package_quota,
					'skin' => 'Enhanced',
					'ssh' => 'OFF',
					'ssl'=> 'ON',
					'cgi' => 'OFF',
					'php' => 'ON',
					'spam' => 'ON',
					'catchall' => 'OFF',
					'cron' => 'ON',
					'sysinfo' => 'ON',
					'login_keys' => 'OFF',
					'vdomains' => 'unlimited',
					'suspend_at_limit' => 'ON'
				);			
 		$sock->query('/CMD_API_MANAGE_USER_PACKAGES', $arr);
		//$result = $sock->fetch_parsed_body();
		//return print_r($result);
	}
	function createResellerPackage($package_name, $package_quota) {
		$sock = $this->socket;
		$sock->set_method("POST");
		$arr = array(
					'action' => 'create',
					'add' => 'Save',
					'packagename' => $package_name,
					'aftp' => 'OFF',
					'dnscontrol'=> 'ON',
					'bandwidth' => 'unlimited',
					'domainptr' => 'unlimited',
					'ftp' => 'unlimited',
					'mysql' => 'unlimited',
					'nemailf' => 'unlimited',
					'nemailml' => 'unlimited',
					'nemailr' => 'unlimited',
					'nemails'=> 'unlimited',
					'nsubdomains' => 'unlimited',
					'quota' => $package_quota,
					'skin' => 'Enhanced',
					'ssh' => 'OFF',
					'ssl'=> 'ON',
					'cgi' => 'OFF',
					'php' => 'ON',
					'spam' => 'ON',
					'catchall' => 'OFF',
					'cron' => 'ON',
					'sysinfo' => 'ON',
					'login_keys' => 'OFF',
					'vdomains' => 'unlimited',
					'suspend_at_limit' => 'ON'
				);			
 		$sock->query('/CMD_API_MANAGE_RESELLER_PACKAGES', $arr);
		//$result = $sock->fetch_parsed_body();
		//return print_r($result);
	}
	function getUserPackages() {
		$sock = $this->socket;
		$sock->set_method("GET");
		$sock->query('/CMD_API_PACKAGES_USER'); 
		$result = $sock->fetch_parsed_body();
		return $result['list'];
		
	}
	function changeUserPackages($package_name) {
		$sock = $this->socket;
		$sock->set_method("GET");
		$arr = Array(
					'package' => $package_name
				);
 		$sock->query('/CMD_API_PACKAGES_USER', $arr);
		$result = $sock->fetch_parsed_body();
		return print_r($result['quota']);
	}
	function changeResellerPackages($package_name) {
		$sock = $this->socket;
		$sock->set_method("GET");
		$arr = Array(
					'package' => $package_name,
					'quota' =>  '',
				);
 		$sock->query('/CMD_API_PACKAGES_RESELLER', $arr);
		$result = $sock->fetch_parsed_body();
		return $result;
	}
}
$da = new DAClass();
?>
