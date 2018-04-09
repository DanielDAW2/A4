<?php

    require 'sys/DB.php';
    
    
    use App\sys\DB;

   
    $db = DB::getInstance();
    
    //$db->query("INSERT INTO `blog`.`Users` (`idusers`, `UserName`, `Pwd`, `Role`, `userscol`) VALUES ('4', 'ddsa', '123', '1', '1')");
    
    $db->query('SELECT * FROM Users;');
    
    if($db->execute())
    {
        $rows = $db->ResultSet();
        
        foreach($rows as $row)
        {
            print $row['UserName'] . ' | ' . $row[Pwd] . '<br>';
        }
    }
            
    
    $db->ResultSet();

    