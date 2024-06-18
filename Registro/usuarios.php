
<?php
class usuarios extends Usuario{
    function __construct(PDO $connection){
        parent::__construct('id', 'usuarios',$connection);
    }
}
?>