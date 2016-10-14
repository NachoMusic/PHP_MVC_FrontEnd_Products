<?php
$path=$_SERVER['DOCUMENT_ROOT'].'/nacho_framework2DAW/';
define('SITE_ROOT', $path);
define('MODEL_PATH',SITE_ROOT.'model/');

class Conf {
  private $_userdb;
  private $_passdb;
  private $_hostdb;
  private $_db;
  static $_instance;

  private function __construct() {
    $cnfg = parse_ini_file(MODEL_PATH."bd.ini");
    $this->_userdb = $cnfg['user'];
    $this->_passdb = $cnfg['password'];
    $this->_hostdb = $cnfg['host'];
    $this->_db = $cnfg['db'];
  }

  private function __clone() {

  }

  public static function getInstance() {
    if (!(self::$_instance instanceof self))
    self::$_instance = new self();
    return self::$_instance;
  }

  // Improvement
  public function __get($property) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }
  /*
  public function getUserDB() {
  $var = $this->_userdb;
  return $var;
}

public function getHostDB() {
$var = $this->_hostdb;
return $var;
}

public function getPassDB() {
$var = $this->_passdb;
return $var;
}

public function getDB() {
$var = $this->_db;
return $var;
}
*/
}
