<?php

    namespace App\Models;

use Exception;
use MF\Model\Container;
    use MF\Model\DAO;

    Class Empregado extends DAO{
        public $perfil;
        public $nome;
        public $email;
        public $senha;
        public $pin;
        public $nascimento;
        public $telefone;
        public $perm;
        public $sessao;
        public $cargo;
        public $cod;
        public $empregador_id;

        public function autentication():array{
            if(!$this->haveAccount()){
                $msg = Container::getModel('Message');
                $msg->setMessage('Dados Inexistentes e/ou incoerentes','danger','back');
                
            }else{
                return $this->haveAccount();
            }

        }

        public function cadastrarEmpregado():bool{
            $query = "INSERT INTO `empregado`(`nome`, `email`, `senha`, `pin`, `nascimento`, `telefone`, `perfil`, `permissao`, `empregador_id`) VALUES (?,?,?,?,?,?,?,?,?)";
            $params = array(
                $this->__get('nome'),
                $this->__get('email'),
                $this->__get('senha'),
                $this->__get('pin'),
                $this->__get('nascimento'),
                $this->__get('telefone'),
                $this->__get('perfil'),
                $this->__get('perm'),
                $this->__get('empregador_id'),
            );

            try{
                if(!$this->rawQuery($query, $params)){
                    Message::setInstaMessage("Dados já existentes no banco", 'danger', 'back');
                }else{
                    return true;
                }
            }catch(Exception $e){
                Message::setInstaMessage("Dados já existentes no banco", 'danger', 'back');

            }
            
        }

        public function cadastrarCargo():void{
            $id = $this->getIdEmpregado()['id'];
            var_dump($id);
            if(!$this->haveCargoWithId($id)){
                $query = "INSERT INTO cargo_empregado (id_cargo, colaborador_id) VALUES (?,?)";
                $params = array(
                    $this->__get('cargo'),
                    $id
                );
                $this->query($query, $params);
            }
        }

        public function getAll():array{
            $query = "SELECT e.id, e.nome, e.pontos_registrados, e.data_registro, ce.id_cargo, c.`sessão`, c.nome_cargo FROM (empregado as e LEFT JOIN cargo_empregado as ce ON e.id = ce.colaborador_id) leFT JOIN cargo as c ON ce.id_cargo = c.id WHERE e.ativo = 1";
            return $this->selectAll($query);
        }

        private function haveAccount() :array{
            $query = "SELECT empregador.codigo_empregador, empregador.nome as tipo, empregador.contato, empregador.sessão, empregado.id, empregado.pin, empregado.nome, empregado.email, empregado.perfil, empregado.permissao FROM `empregado` LEFT JOIN empregador ON empregador.id = empregado.empregador_id WHERE pin = ? AND codigo_empregador = ?";
            return $this->select($query, array($this->__get('pin'),$this->__get('cod')));
        }

        private function getIdEmpregado():array{
            $query = "SELECT id FROM empregado WHERE email = ? AND senha = ? AND pin = ?";
            $params = array(
                $this->__get('email'),
                $this->__get('senha'),
                $this->__get('pin')

            );
            return $this->select($query, $params);
            
        }

        private function haveCargoWithId(Int $id):bool{
            $query = "SELECT * FROM cargo_empregado WHERE id_cargo = ? AND colaborador_id = ? AND ativo = 1";
            $params = array(
                $this->__get('cargo'),
                $id
            );
            if($this->select($query, $params)){
                return true;
            }else{
                return false;
            }
        }
        

        public function __set($attr, $value){
            $this->$attr = $value;
            return $this;
        }

        public function __get($attr){
            return $this->$attr;
        }
    }


?>