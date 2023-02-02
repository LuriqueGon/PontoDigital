<?php 

    namespace MF\Model;
    use MF\Model\Model;

    abstract class DAO extends Model{
        
        // QUERY {
        public function query($rawQuery, $params = array()){
            $stmt = $this->db->prepare($rawQuery);
            $this->setParams($stmt, $params);
            $stmt->execute();
            return $stmt;
        }

        private function setParams($stmt, $params = array()){
            foreach($params as $key => $value){
                $this->setParam($stmt, $key+1, $value);
            }
        }

        private function setParam($stmt, $key, $value){
            $stmt->bindValue($key, $value);
        }
        // }

        public function select($rawQuery, $params = array()){
            $stmt = $this->query($rawQuery, $params);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function selectAll($rawQuery, $params = array()):array{
            $stmt = $this->query($rawQuery, $params);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        
        
    }

?>