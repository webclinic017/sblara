<?php 
class Dse{
	//constants
	 const BASE_URI = "http://dsebd.org";
	 protected $instrument;
	 private $html;
	 private $companyInfoUrl;

	 function __construct()
	 {
	 	$this->getShareHoldings("KPCL");
	 }

	 /**
	  * Get share holdings
	  *
	  * @return stdClass
	  **/
	 public function getShareHoldings($instrument = false)
	 {
	 	if($instrument){
	 		$this->setInstrument($instrument);
	 	}
	 	$html = $this->getHtml();
	 }

    /**
     * @param mixed $instrument
     *
     * @return self
     */
    public function setInstrument($instrument)
    {
        $this->instrument = $instrument;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInstrument()
    {
        return $this->instrument;
    }



    /**
     * @return mixed
     */
    public function getHtml()
    {
    	if(!$this->html){
    		$this->fileGetContent($this->getCompanyInfoUrl()); 
    	}
        return $this->html;
    }

    /**
     * @param mixed $html
     *
     * @return self
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompanyInfoUrl()
    {
    	if(!$this->companyInfoUrl){
    		$this->companyInfoUrl = self::BASE_URI."/displayCompany.php?name=".$this->getInstrument();
    	}
        return $this->companyInfoUrl;
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    private function fileGetContent($url)
    {
    	return file_get_contents($url);
    }
}