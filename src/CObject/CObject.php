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
}