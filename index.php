<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
    require 'sys/DB.php';
    
    
    use App\sys\DB;

   
    $db = DB::getInstance();

    
    /*$db->query('INSERT INTO `users` (`id`, `nombre`, `passwd`) VALUES (NULL, 'Daniel', '123')
');
    */
    // $db->execute();

    $db->query('SELECT * FROM users WHERE nombre = :nom');
  
    $db->bind(':nom','Daniel');    
    
    $db->execute();
    echo '<h1>Var Dump de $db, que contiene el objeto PDO y la sentencia sin hacer bind()</h1>';
    var_dump($db);

    $rows = [];

    $rows = $db->ResultSet();
    echo '<h1>Resultado de la sentencia despues de hacer bind, donde :nom se convierte en "Daniel"</h1>';
    if($rows)
    {
        foreach($rows as $row)
        {
            echo "<p>".$row['nombre'] . " | " . $row['passwd'] . "</p>";       
        }
    }

    echo '<h1>Single</h1><p>' . $db->single() . '</p>';

    echo '<h1>Filas: </h1><p>'.$db->rowCount().'</p>';

?>
    
