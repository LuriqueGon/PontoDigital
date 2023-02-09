<?php 

    namespace MF\Model;
    use MF\Model\Model;

    abstract class DAO extends Model{
        
        // QUERY {
        public function query(String $rawQuery, Array $params = array()){
            $stmt = $this->db->prepare($rawQuery);
            $this->setParams($stmt, $params);
            $stmt->execute();
            return $stmt;
        }

        public function rawQuery(String $rawQuery, Array $params = array()){
            $stmt = $this->db->prepare($rawQuery);
            $this->setParams($stmt, $params);
            return $stmt->execute();
        }

        

        private function setParams($stmt, Array $params = array()):void{
            foreach($params as $key => $value){
                $this->setParam($stmt, $key+1, $value);
            }
        }

        private function setParam($stmt, $key, $value):void{
            $stmt->bindValue($key, $value);
        }
        // }

        public function select(String $rawQuery, Array $params = array()):array|String{
            $stmt = $this->query($rawQuery, $params);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function selectAll(String $rawQuery, Array $params = array()):array{
            $stmt = $this->query($rawQuery, $params);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        
        
    }

?>