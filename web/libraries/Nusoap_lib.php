<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Nusoap_lib{
	function Nusoap_lib1(){
	    require_once(str_replace("\\","/",APPPATH).'libraries/lib/nusoap'.EXT); //Por si estamos ejecutando este script en un servidor Windows
	}
}
?>