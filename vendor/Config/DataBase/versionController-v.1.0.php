<?php 
    namespace Config;

    use MF\Model\Model;

    Class versionControllerV1 extends Model{
        public $query;
        private $createDataBase = "CREATE DATABASE pontoDigital;";

        private $insertDataCargos = "INSERT INTO `cargos` (`id`, `nome_cargo`, `nivel`, `ativo`, `sessão`) VALUES ('1', 'Estágiario', '1', '1', 'AB1-'), ('2', 'Funcionario', '2', '1', 'AB1-'),(NULL, 'Admininstrador', '3', '1', 'AB1-'), (NULL, 'Gestor', '4', '1', 'AB1-'), (NULL, 'Chamada', '3', '1', 'AB1-'), (NULL, 'Chefe da Sessão', '5', '1', 'AB1-'),(NULL, 'Estágiario', '1', '1', 'AB2-'), (NULL, 'Estágiario', '1', '1', 'AB3-')";

        private $insertDataEmpregadores = "INSERT INTO `empregador` (`id`, `nome`, `contato`, `codigo_empregador`, `data_registro`, `perfil`, `contribuidores_cadastrados`, `permissao`, `ativo`) VALUES (NULL, 'Cozinha', 'Cozinha.gestão.teste@gmail.com', 'aw7a4a5w6', CURRENT_TIMESTAMP, '', '1', '1', '1')";

        private $insertDataColaboradores = "INSERT INTO `colaborador` (`id`, `nome`, `email`, `senha`, `pin`, `nascimento`, `telefone`, `perfil`, `permissao`, `ativo`, `data_registro`, `pontos_registrados`, `empregador_id`) VALUES (NULL, 'Luiz', 'luiz.cozinha@gmail.com', '3392555', '12345678', '2004-03-06', '11 1234 - 5678', '', '1', '1', CURRENT_TIMESTAMP, '0', '1');";

        private $insertDataCargoColaboradores = "INSERT INTO `cargo_colaboradores` (`id`, `permissao`, `descricao`, `ativo`, `data_inicio`, `data_fim`, `id_cargo`, `colaborador_id`) VALUES (NULL, '1', 'Estágio na área de salgados da cozinha ', '1', CURRENT_TIMESTAMP, NULL, '1', '1');;";

        

        
        
        private function createDataBase(){
            $this->query = $this->createDataBase;
            $stmt = $this->db->prepare($this->query);
            if($stmt->execute()){
                return true;
            }else{
                return false;
                die("database Dont Create");

            }
        }

        private function insertDataCargos(){
            $this->query = $this->insertDataCargos;
            $stmt = $this->db->prepare($this->query);
            if($stmt->execute()){
                return true;
            }else{
                return false;
                die("database Dont Create");

            }
        }

        
    }
?>