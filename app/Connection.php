<?php 

    namespace App;
    use PDO;
    use PDOException;

    class Connection{


        public static function getDB(){
            $dbType = 'public';
            if($dbType == 'public'){
                try{
                    $conn = new PDO(
                        "mysql:host=localhost;". 
                        "dbname=id20221668_pontodigital	;". 
                        "charset=utf8", 
                        "id20221668_lurique", 
                        "v/wou6-K=/]^3!rC" 
                        
                    );
                    return $conn;
                    
                }catch(PDOException $e){
                    // Tratativa de Erros
    
                    // Enviar para uma tabela todos os erros
                }
            }else{
                try{
                    $conn = new PDO(
                        "mysql:host=localhost;". 
                        "dbname=pontodigital;". 
                        "charset=utf8", 
                        "root", 
                        "" 
                    );
                    return $conn;
                    
                }catch(PDOException $e){
                    // Tratativa de Erros
    
                    // Enviar para uma tabela todos os erros
                }
            }
            
        }
    }

?>