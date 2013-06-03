<?PHP
/**
* Holding an instance of CStormFrame to enable use of $this in subclasses.
*
* @package StormFrame
*/
class CObject {

   	public $config;
   	public $request;
   	public $data;
   	public $dbh;
	public $views;
	public $session;

   	/**
    * Constructor
    */
   	protected function __construct() {
    	$sf = CStormFrame::Instance();
    	$this->config   = &$sf->config;
    	$this->request  = &$sf->request;
    	$this->data     = &$sf->data;
		$this->dbh     	= &$sf->dbh;
		$this->views	= &$sf->views;
		$this->session  = &$sf->session;
  	}
	
	/**
	* Redirect to another url and store the session
	*/
	protected function RedirectTo($url) {
    	$sf = CStormFrame::Instance();
    	if(isset($sf->config['debug']['showDBNumQuerys']) && $sf->config['debug']['showDBNumQuerys'] && isset($sf->dbh)) {
      		$this->session->SetFlash('showDBNumQuerys', $this->dbh->GetNumQueries());
    	}
    	if(isset($sf->config['debug']['showDBQuerys']) && $sf->config['debug']['showDBQuerys'] && isset($sf->dbh)) {
      		$this->session->SetFlash('showDBQuerys', $this->dbh->GetQueries());
    	}
    	if(isset($sf->config['debug']['timer']) && $sf->config['debug']['timer']) {
			$this->session->SetFlash('timer', $sf->timer);
    	}
    	$this->session->StoreInSession();
    	header('Location: ' . $this->request->CreateUrl($url));
  	}
	/**
	* Redirect to a method within the current controller. Defaults to index-method. Uses RedirectTo().
	*
	* @param string method name the method, default is index method.
	*/
	protected function RedirectToController($method=null) {
    	$this->RedirectTo($this->request->controller, $method);
  	}
	
	/**
	* Redirect to a controller and method. Uses RedirectTo().
	*
	* @param string controller name the controller or null for current controller.
	* @param string method name the method, default is current method.
	*/
	protected function RedirectToControllerMethod($controller=null, $method=null) {
		$controller = is_null($controller) ? $this->request->controller : null;
		$method = is_null($method) ? $this->request->method : null;	
	    $this->RedirectTo($this->request->CreateUrl($controller, $method));
  	}
}