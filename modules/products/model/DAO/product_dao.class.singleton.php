<?php
class productDAO {

    static $_instance;

    private function __construct() {

    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function create_product_DAO($db, $arrArgument) {
        $product_name = $arrArgument['product_name'];
        $product_description = $arrArgument['product_description'];
        $product_price = $arrArgument['product_price'];
        $product_id = $arrArgument['product_id'];
        $enter_date = $arrArgument['enter_date'];
        $obsolescence_date = $arrArgument['obsolescence_date'];
        $product_category = $arrArgument['product_category'];
        $availability = $arrArgument['availability'];
        $avatar = $_SESSION["nombre_fichero"];

        $web = 0;
        $warehouse = 0;
        $physical_store = 0;

        foreach ($availability as $indice) {
            if ($indice === 'Web')
                $web = 1;
            if ($indice === 'Warehouse')
                $warehouse = 1;
            if ($indice === 'Physical_store')
                $physical_store = 1;
        }

        $country = $arrArgument['country'];
        $province = $arrArgument['province'];
        $town = $arrArgument['town'];

        $sql = "INSERT INTO products (product_name, product_description, product_price, product_id, enter_date, obsolescence_date, product_category, Web, Warehouse, Physical_store, avatar, country, province, town) VALUES ('". $product_name
        ."', '". $product_description ."', '". $product_price ."', '". $product_id ."' , '". $enter_date ."', '". $obsolescence_date
        ."', '". $product_category ."', '". $web ."','". $warehouse ."', '". $physical_store ."' ,'". $avatar ."', '". $country ."', '". $province ."', '". $town ."')";

        return $db->ejecutar($sql);
    }

    public function obtain_countries_DAO($url) {
        // return json_encode($url);
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return ($file_contents) ? $file_contents : FALSE;
    }

    public function obtain_provinces_DAO() {
        $json = array();
        $tmp = array();

        $provincias = simplexml_load_file("../../../resources/provinciasypoblaciones.xml");
        $result = $provincias->xpath("/lista/provincia/nombre | /lista/provincia/@id");
        for ($i=0; $i<count($result); $i+=2) {
            $e=$i+1;
            $provincia=$result[$e];

            $tmp = array(
                'id' => (string) $result[$i], 'nombre' => (string) $provincia
            );
            array_push($json, $tmp);
        }
        return $json;
    }

    public function obtain_towns_DAO($arrArgument) {
        $json = array();
        $tmp = array();

        $filter = (string)$arrArgument;
        $xml = simplexml_load_file('../../../resources/provinciasypoblaciones.xml');
        $result = $xml->xpath("/lista/provincia[@id='$filter']/localidades");

        for ($i=0; $i<count($result[0]); $i++) {
            $tmp = array(
                'poblacion' => (string) $result[0]->localidad[$i]
            );
            array_push($json, $tmp);
        }
        return $json;
    }

    public function list_products_DAO($db){
          $sql = "SELECT * FROM products";
          $stmt = $db->ejecutar($sql);
          return $db->listar($stmt);
    }

    public function details_products_DAO($db,$id) {
        $sql = "SELECT * FROM products WHERE product_id='".$id."'";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }
}
