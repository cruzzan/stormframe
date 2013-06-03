<?PHP
/**
 * Class model of an authenticated user.
 * 
 * @package StormFrame
 */
class CMUser extends CObject implements IHasSQL {
	
	function __construct() {
		parent::__construct();
	}
	
	/**
   	* Implementing interface IHasSQL. Encapsulate all SQL used by this class.
   	*
   	* @param string $key the string that is the key of the wanted SQL-entry in the array.
   	*/
  	public static function SQL($key=null) {
    	$queries = array(
      		'insert into user'   => 'INSERT INTO User (Username, FirstName, LastName, Created, LastLogin, Email, Password) VALUES (?,?,?,?,?,?,?);',
      		'check user password' => 'SELECT * FROM User WHERE Password=? AND (Username=? OR Email=?);',
     	);
    	if(!isset($queries[$key])) {
      		throw new Exception("No such SQL query, key '$key' was not found.");
    	}
    	return $queries[$key];
  	}
 

  	/**
   	* Login by autenticate the user and password. Store user information in session if success.
   	*
   	* @param string $akronymOrEmail the emailadress or user akronym.
   	* @param string $password the password that should match the akronym or emailadress.
   	* @returns booelan true if match else false.
   	*/
  	public function Login($usernameOrEmail, $password) {
    	$user = $this->dbh->ExecuteSelectQueryAndFetchAll(self::SQL('check user password'), array($password, $usernameOrEmail, $usernameOrEmail));
    	$user = (isset($user[0])) ? $user[0] : null;
    	unset($user['Password']);
    	if($user) {
      		$this->session->SetAuthenticatedUser($user);
      		$this->session->AddMessage('success', "Welcome '{$user['FirstName']}'.");
    	} else {
      		$this->session->AddMessage('notice', "Could not login, user does not exists or password did not match.");
    	}
    	return ($user != null);
  	}
 

  	/**
   	* Logout.
   	*/
  	public function Logout() {
    	$this->session->UnsetAuthenticatedUser();
    	$this->session->AddMessage('success', "You have logged out.");
  	}
 

  	/**
   	* Does the session contain an authenticated user?
   	*
   	* @returns boolen true or false.
   	*/
  	public function IsAuthenticated() {
    	return ($this->session->GetAuthenticatedUser() != false);
  	}
 
 
  	/**
   	* Get profile information on user.
   	*
   	* @returns array with user profile or null if anonymous user.
   	*/
  	public function GetUserProfile() {
    	return $this->session->GetAuthenticatedUser();
  	}
}
