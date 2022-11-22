--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `telefone` varchar(30) NOT NULL,
  `cargo` varchar(80) NOT NULL,
  `setor` varchar(80) NOT NULL,
  `unidade` varchar(50) NOT NULL,
  `acesso` tinyint(1) NOT NULL,
  `path_img` varchar(100) NOT NULL, 
  `pergunta` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estrutura da tabela `viagens`
--

CREATE TABLE `viagens` (
  `viagem_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `titulo` varchar(120) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `data_viagem` date NOT NULL,
  `motivo_viagem` text NOT NULL,
  `valor_diaria` varchar(15) NOT NULL,
  `cidade_destino` varchar(80) NOT NULL,
  `locomocao` varchar(15) NOT NULL,
  `nome_hotel` varchar(100) NOT NULL,
  `endereco_hotel` varchar(100) NOT NULL,
  `data_checkin` date NOT NULL,
  `data_checkout` date NOT NULL,
  `status_viagem` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estrutura da tabela `usuario_viagem`
--

CREATE TABLE `usuario_viagem` ( 
  `id_usuario_viagem` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  `fk_id_usuario` int(11) NOT NULL, 
  `fk_id_viagem` int(11) NOT NULL,
  FOREIGN KEY (fk_id_usuario) REFERENCES usuarios(id),
  FOREIGN KEY (fk_id_viagem) REFERENCES viagens(viagem_id) 
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estrutura da tabela `notas`
--

CREATE TABLE `notas` (
  `id_notas` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  `fk_viagem_id` int(11) NOT NULL, 
  `fk_usuario_id` int(11) NOT NULL, 
  `titulo_notas` varchar(100) NOT NULL, 
  `categoria_notas` varchar(100) NOT NULL, 
  `data_notas` date NOT NULL, 
  `valor_notas` float NOT NULL, 
  `path_notas` varchar(200) NOT NULL, 
  FOREIGN KEY (fk_usuario_id) REFERENCES usuarios(id), 
  FOREIGN KEY (fk_viagem_id) REFERENCES viagens(viagem_id)) 
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
    `id_comentario` INT NOT NULL AUTO_INCREMENT ,
    `texto_comentario` TEXT NOT NULL ,
    `user_id_fk` INT NOT NULL ,
    `viagem_id_fk` INT NOT NULL,
    `titulo_comentario` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id_comentario`),  
    FOREIGN KEY (user_id_fk) REFERENCES usuarios(id),
    FOREIGN KEY (viagem_id_fk) REFERENCES viagens(viagem_id)
    ) ENGINE = InnoDB;

-- Adicionar usuário
    INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `acesso`, `cpf`, `telefone`, `cargo`, `setor`, `unidade`) VALUES 
    (NULL, 'Alec Fernando Rodrigues', ' alec.oliveira@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '508.267.860-49', '41 8897-4730', 'Desenvolvedor Full-Stack', 'Desenvolvimento', 'Curitiba'), 
    (NULL, 'Ana Carolina Dos Santos', 'ana.santos@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '493.065.010-05', '41 8897-4730', 'Designer & Front-End', 'Design', 'Curitiba'), 
    (NULL, 'Arthur Paulo Cardoso', 'arthur.cardoso@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '746.276.960-35', '(46) 3113-2753', 'Desenvolvedor Full-Stack', 'Desenvolvimento', 'Curitiba'), 
    (NULL, 'Camila Moret', 'camila.nunes@hipe.cc ', '202cb962ac59075b964b07152d234b70', '1', '506.730.130-90', '(42) 2721-7447', 'Desenvolvedor Front-End', 'Desenvolvimento', 'Curitiba'), 
    (NULL, 'Diego Alves da Costa', 'diego.costa@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '154.082.650-30', '(45) 2522-5427', 'Desenvolvedor Full-Stack', 'Desenvolvimento', 'Curitiba'), 
    (NULL, 'Eduardo Cardozo Huszcz', 'eduardo.huszcz@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '495.500.840-27', '(43) 2594-8063', 'Desenvolvedor Back-end', 'Desenvolvimento', 'Curitiba'), 
    (NULL, 'Fabio Henrique Prestes', 'fabio.preste@hipe.cc ', '202cb962ac59075b964b07152d234b70', '1', '286.514.780-03', '(43) 3024-4209', 'Designer & Front-End', 'Design', 'Curitiba'), 
    (NULL, 'Fernanda Carolina A.', 'fernanda.andrigueto@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '036.281.560-76', '(42) 2651-1757', 'Desenvolvedor Front-End', 'Desenvolvimento', 'Curitiba'), 
    (NULL, 'Guilherme H. de Meira', 'guilherme.henrique@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '598.362.900-01', '(43) 3884-9006', 'Desenvolvedor Full-Stack', 'Desenvolvimento', 'Curitiba'), 
    (NULL, 'Kauan Zaziscki', 'kauan.zaziscki@hipe.cc ', '202cb962ac59075b964b07152d234b70', '1', '493.065.010-05', '41 8897-4730', 'Desenvolvedor Back-End', 'Desenvolvimento', 'Curitiba'), 
    (NULL, 'Kauê Oliveira', 'kaue.oliveira@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '454.379.930-56', '(42) 3961-2381', 'Desenvolvedor Full-Stack', 'Desenvolvimento', 'Curitiba'), 
    (NULL, 'Layla Cristini', 'layla.correia@hipe.cc ', '202cb962ac59075b964b07152d234b70', '1', '420.796.640-42', '(41) 2167-9036', 'Analista de Suporte', 'Operações', 'Curitiba'), 
    (NULL, 'Lucas Carvalho', 'lucas.carvalho@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '202.539.160-97', '(43) 2258-9158', 'Gerente', 'Operações', 'Mariópolis'), 
    (NULL, 'Lucas Siqueira', 'lucas.siqueira@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '207.177.180-00', '(41) 2998-8131', 'Desenvolvedor Full-Stack', 'Desenvolvimento', 'Mariópolis'), 
    (NULL, 'Luis Kryzozun', 'luis.correa@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '615.617.360-90', '(46) 2655-1339', 'Diretor', 'Diretoria', 'Mariópolis'),
    (NULL, 'Luiz Saraceni', 'luiz.santos@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '491.493.700-06', '(46) 2273-2254', 'Desenvolvedor Back-End', 'Desenvolvimento', 'Mariópolis'),
    (NULL, 'Mathes Robles', 'mateus.paiva@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '852.354.890-47', '(41) 2846-5171', 'Desenvolvedor Full-Stack', 'Desenvolvimento', 'Mariópolis'),
    (NULL, 'Phablo França', 'phaplo.david@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '207.177.180-00', '(41) 2998-8131', 'Desenvolvedor Full-Stack', 'Desenvolvimento', 'Mariópolis'), 
    (NULL, 'Raquel Souza', 'racquel.souza@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '387.774.140-12', '(43) 2533-6719', 'Gerente', 'Operações', 'Mariópolis'), 
    (NULL, 'Samuel Leal', 'samuel.abreu@hipe.cc', '202cb962ac59075b964b07152d234b70', '1', '207.177.180-00', '(41) 2998-8131', 'Diretor', 'Jurídico', 'Mariópolis');



INSERT INTO `viagens` (`viagem_id`, `titulo`, `nome_cliente`, `data_viagem`, `motivo_viagem`, `valor_diaria`, `cidade_destino`, `locomocao`, `nome_hotel`, `endereco_hotel`, `data_checkin`, `data_checkout`, `status_viagem`) VALUES
  (1, 'Teste', 'Condor', '2022-03-12', 'Sei lá\r\n            ', 'R$ 50,00', 'Curitiba', 'aviao', 'Copacabana Pallace', 'Rua dos curiosos', '2022-11-01', '2023-11-05', 'Ativo'),
  (2, 'Teste', 'Condor', '0000-00-00', 's', 'R$ 50,00', '12313', 'onibus', 'Copacabana Pallace', 'Rua dos curiosos', '0000-00-00', '0000-00-00', 'Ativo'),
  (3, 'Teste', 'Condor', '2022-10-19', '3131\r\n            ', 'R$ 50,00', 'Araucária', 'onibus', 'Copacabana Pallace', 'Rua dos curiosos', '2022-03-26', '2022-03-20', 'Ativo'),
  (4, 'Teste', 'Condor', '2022-10-19', '3131\r\n            ', 'R$ 50,00', 'Araucária', 'onibus', 'Copacabana Pallace', 'Rua dos curiosos', '2022-03-26', '2022-03-20', 'Ativo'),
  (5, 'Teste', 'Condor', '2022-10-19', '3131\r\n            ', 'R$ 50,00', 'Araucária', 'onibus', 'Copacabana Pallace', 'Rua dos curiosos', '2022-03-26', '2022-03-20', 'Ativo'),
  (6, 'Teste', 'Condor', '2022-10-19', '3131\r\n            ', 'R$ 50,00', 'Araucária', 'onibus', 'Copacabana Pallace', 'Rua dos curiosos', '2022-03-26', '2022-03-20', 'Ativo'),
  (7, 'Teste com usuario', 'Condor Hipermercados', '2022-10-27', 'Sei láa', 'R$ 123,00', 'São Paulo', 'onibus', 'Copacabana Pallace', 'Rua dos curiosos', '2022-10-27', '2022-10-30', 'Ativo'),
  (8, 'Teste com usuario', 'Condor Hipermercados', '2022-10-22', 'asdada\r\n            ', 'R$ 184,00', 'Araucária', 'onibus', 'Copacabana Pallace', 'Rua dos curiosos', '2022-10-29', '2022-10-26', 'Ativo'),
  (9, 'Teste com usuario', 'Condor Hipermercados', '2022-10-27', 'ad\r\n            ', 'R$ 141,00', 'São Paulo', 'onibus', 'Copacabana Pallace', 'Rua dos curiosos', '2022-10-11', '2022-11-04', 'Ativo'),
  (10, 'Irineu', 'Lasyfuisa', '2022-03-12', '\r\n            asfsafsafsa', 'R$ 500,00', 'ssafsafasfsa', 'aviao', 'asfas', '213123213', '2003-03-21', '2005-02-04', 'Ativo'),
  (11, 'Teste com usuario', 'Condor', '2022-10-13', '\r\n            dad', 'R$ 176,00', 'Araucária', 'aviao', 'Copacabana Pallace', 'Rua dos curiosos', '2022-10-22', '2022-10-25', NULL),
  (12, 'Viagem Teste', 'Harger Supermercados', '2022-10-20', 'Sei lá\r\n            ', 'R$ 209,00', 'São Paulo', 'carro', 'Copacabana Pallace', 'Rua dos curiosos', '2022-10-15', '2022-10-20', NULL),
  (13, 'Viagem 2', 'Condor Hipermercados', '2022-10-13', 'Ta tudo bugado', 'R$ 70,00', 'São Paulo', 'aviao', 'Copacabana Pallace', 'Rua dos curiosos', '2022-10-08', '2022-10-19', NULL),
  (14, 'Viagem 3', 'Condor Hipermercados', '2022-10-22', '            addad', 'R$ 129,00', 'São Paulo', 'aviao', 'Copacabana Pallace', 'Rua dos curiosos', '2022-10-24', '2022-10-11', NULL),
  (15, 'Irineu2', '12312', '2004-04-22', '2131', 'R$ 96,00', '2131', 'carro', '21321', '213213', '2003-03-22', '2005-03-21', NULL);

