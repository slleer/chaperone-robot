<?php
class activeUsr {
  public $usrName;

  function set_name($name){
    $this->usrName = $name;
  }
  function get_name(){
    return $this->$usrName;
  }
?>
