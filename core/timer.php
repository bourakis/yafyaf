<?php
/**
 * -----------------------------------------------------------------------------
 * yaf :: index.php 
 * @version: 2.0 - (11/05/2012)
 * @requires 
 * @author Konstantinos Apazidis (konapaz@gmail.com)
 * @Description: Main page
 * -----------------------------------------------------------------------------
 * This is a project of mclab.gr
 * -----------------------------------------------------------------------------
 * Licensed under MIT licence:
 *   http://www.opensource.org/licenses/mit-license.php
 * =============================================================================
 *  TODO:
 *  
 * -----------------------------------------------------------------------------
**/

class execTimer {
	private $starttime="",$endtime="",$timeparts="";

	public function reStart(){
		$this->timeparts = explode(' ',microtime());
		$this->starttime = $this->timeparts[1].substr($this->timeparts[0],1);
	}

	public function catchTime(){
		$this->timeparts = explode(' ',microtime());
		$this->endtime = $this->timeparts[1].substr($this->timeparts[0],1);
	}

	public function theTime(){
		$this->catchTime();
		return bcsub($this->endtime,$this->starttime,6);
	}

}


?>