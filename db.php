<?php
class Database {

    private $dbname = "rest";

    public function __construct() {
        if (!is_dir(__DIR__.'/'.$this->dbname)) {
            mkdir(__DIR__.'/'.$this->dbname);
        }
    }

    public function _insertData($tablename, $arrdata) {
        if (is_array($arrdata)) {
            $data = "";
            if (!$this->_if_one($tablename, $arrdata)) {
                if (file_exists(__DIR__.'/'.$this->dbname . "/" . $tablename . ".js")) {
                    $data = file_get_contents($this->dbname . "/" . $tablename . ".js");
                    $dataJson = json_decode($data, true);
                    array_push($dataJson, $arrdata);
                    $dataSave = json_encode($dataJson);
                    file_put_contents(__DIR__.'/'.$this->dbname . "/" . $tablename . ".js", $dataSave);
                } else {
                    $data = array();
                    array_push($data, $arrdata);
                    $dataSave = json_encode($data);
                    file_put_contents(__DIR__.'/'.$this->dbname . "/" . $tablename . ".js", $dataSave);
                }
            }
        }
    }

    public function _if_one($tablename, $arrdata) {
        if (is_array($arrdata)) {
            $data = "";
            if (file_exists(__DIR__.'/'.$this->dbname . "/" . $tablename . ".js")) {
                $data = file_get_contents(__DIR__.'/'.$this->dbname . "/" . $tablename . ".js");
                $dataJson = json_encode($arrdata);
                if (strpos($data, $dataJson) !== false) {
                    return true;
                }
            }
            return false;
        }
    }

    public function _search($tablename) {
        if (strlen($tablename) > 0) {
            $data = "";
            if (file_exists(__DIR__.'/'.$this->dbname . "/" . $tablename . ".js")) {
                $data = file_get_contents(__DIR__.'/'.$this->dbname . "/" . $tablename . ".js");
                $dataJson = json_decode($data, true);
                return $dataJson;
            }
            return array();
        }
    }

    public function _delete($tablename, $search, $nameid) {
        if (strlen($search) > 0 && strlen($nameid) > 0) {
            $data = "";
            if (file_exists(__DIR__.'/'.$this->dbname . "/" . $tablename . ".js")) {
                $data = file_get_contents(__DIR__.'/'.$this->dbname . "/" . $tablename . ".js");
                $dataJson = json_decode($data, true);
                $newarray = array();
                foreach ($dataJson as $dj) {
                    if (isset($dj[$search])) {
                        if ($dj[$search] != $nameid) {
                            array_push($newarray, $dj);
                        }
                    }
                }
                $dataSave = json_encode($newarray);
                file_put_contents(__DIR__.'/'.$this->dbname . "/" . $tablename . ".js", $dataSave);
            }
            return array();
        }
    }

}
