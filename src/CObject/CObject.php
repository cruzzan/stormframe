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
  	}
}