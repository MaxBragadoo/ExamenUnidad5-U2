<?php
require_once('ORM/orm.php');

class Cliente extends ORM {
    public function __construct($conn) {
        parent::__construct($conn, 'Clientes');
    }
}
?>
