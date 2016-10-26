<?php
define('MODEL_PATH', SITE_ROOT . 'model/');
require (MODEL_PATH . "Db.class.singleton.php");
require(SITE_ROOT . "modules/products_frontend/model/DAO/products_dao.class.singleton.php");

class products_bll {

    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = products_dao::getInstance();
        $this->db = Db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function list_products_BLL() {
        return $this->dao->list_products_DAO($this->db);
    }

    public function details_products_BLL($id) {
        return $this->dao->details_products_DAO($this->db,$id);
    }

    public function page_products_BLL($arrArgument) {
        return $this->dao->page_products_DAO($this->db,$arrArgument);
    }

    public function total_products_BLL() {
        return $this->dao->total_products_DAO($this->db);
    }

}
