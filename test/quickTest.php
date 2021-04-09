<?php
class activeUsr {
  public $usrName;
  public $usrType;

  function set_name($name){
    $this->usrName = $name;
  }
  function set_type($type){
    $this->usrType = $type;
  }
  function get_name(){
    return $this->$usrName;
  }
  function get_type(){
    return $this->$usrType;
  }
}

?>
