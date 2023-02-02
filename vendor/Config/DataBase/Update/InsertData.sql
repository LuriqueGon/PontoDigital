INSERT INTO `cargo` (`id`, `nome_cargo`, `nivel`, `ativo`, `sessão`, `duração`) VALUES ('1', 'Estágiario', '1', '1', 'CozinhaA1','180'),(NULL, 'Estágiario', '1', '1', 'Sistemas e Hardware','180'), (NULL, 'Estágiario', '1', '1', 'Administração','180');

INSERT INTO `cargo` (`id`, `nome_cargo`, `nivel`, `ativo`, `sessão`) VALUES (NULL, 'Funcionario', '2', '1', 'CozinhaA1'),(NULL, 'Admininstrador', '3', '1', 'CozinhaA1'), (NULL, 'Gestor', '4', '1', 'CozinhaA1'), (NULL, 'Chamada', '3', '1', 'CozinhaA1'), (NULL, 'Chefe da Sessão', '5', '1', 'CozinhaA1');

INSERT INTO `empregador` (`id`, `nome`, `contato`, `codigo_empregador`, `data_registro`, `perfil`, `empregados`, `permissao`, `ativo`) VALUES (NULL, 'Cozinha', 'Cozinha.gestão.teste@gmail.com', 'aw7a4a5w6', CURRENT_TIMESTAMP, '', '1', '1', '1');

INSERT INTO `empregado` (`id`, `nome`, `email`, `senha`, `pin`, `nascimento`, `telefone`, `perfil`, `permissao`, `ativo`, `data_registro`, `pontos_registrados`, `empregador_id`) VALUES (NULL, 'Luiz', 'luiz.cozinha@gmail.com', '3392555', '12345678', '2004-03-06', '11 1234 - 5678', '', '1', '1', CURRENT_TIMESTAMP, '0', '1');

INSERT INTO `cargo_empregado` (`id`, `permissao`, `descricao`, `ativo`, `data_inicio`, `data_fim`, `id_cargo`, `colaborador_id`) VALUES (NULL, '1', 'Estágio na área de salgados da cozinha ', '1', CURRENT_TIMESTAMP, NULL, '1', '1');

INSERT INTO `empregado` (`id`, `nome`, `email`, `senha`, `pin`, `nascimento`, `telefone`, `perfil`, `permissao`, `ativo`, `data_registro`, `pontos_registrados`, `empregador_id`) VALUES (NULL, 'Luccas', 'Luccas.cozinha@gmail.com', 'cozinha123', '', '2002-11-04', '81 94582-1025', '', '5', '1', CURRENT_TIMESTAMP, '0', '1');