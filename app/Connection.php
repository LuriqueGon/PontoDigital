<?php 

    namespace App;
    use PDO;
    use PDOException;

    class Connection{
        public static function getDB(){
            try{
                $conn = new PDO(
                    "mysql:host=localhost;". 
                    "dbname=pontodigitalteste;". 
                    "charset=utf8", 
                    "root", 
                    "root" 
                );
                return $conn;
                
            }catch(PDOException $e){
                // Tratativa de Erros

                // Enviar para uma tabela todos os erros
            }
            
            
        }
    }

?>