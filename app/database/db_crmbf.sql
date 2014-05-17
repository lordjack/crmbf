# Host: localhost  (Version: 5.0.45-community-nt)
# Date: 2014-05-15 19:24:36
# Generator: MySQL-Front 5.3  (Build 4.95)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "administradores"
#

DROP TABLE IF EXISTS `administradores`;
CREATE TABLE `administradores` (
  `id` int(11) NOT NULL auto_increment,
  `Nome` varchar(125) character set utf8 NOT NULL,
  `imgPerfil` varchar(30) character set utf8 default NULL,
  `Email` varchar(125) character set utf8 NOT NULL,
  `Usuario` varchar(10) character set utf8 NOT NULL,
  `Senha` varchar(128) character set utf8 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "administradores"
#

INSERT INTO `administradores` VALUES (1,'Janio Alexandre','janio.png','janioalexandre@gmail.com','janio','699328d6430b4fc4b43248c1ec6aa45480d8606513a8d8ef934d67a35d998fabdc1388688ec2cfc984f448dfc357d570aaa144bc5d9ac5c2c566a625b1313b04');

#
# Structure for table "categoria"
#

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`,`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "categoria"
#

INSERT INTO `categoria` VALUES (1,'BF Software'),(2,'Tecnologia'),(3,'Seguranca'),(4,'Games'),(5,'Teste de categoria ');

#
# Structure for table "cidade"
#

DROP TABLE IF EXISTS `cidade`;
CREATE TABLE `cidade` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "cidade"
#

INSERT INTO `cidade` VALUES (1,'BaÃƒÂ­a Formosa'),(2,'Natal'),(3,'Recife');

#
# Structure for table "cliente"
#

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `skype` varchar(50) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade_id` int(11) NOT NULL,
  `uf` char(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `imgPerfil` varchar(30) NOT NULL,
  `senha` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cidade_id` (`cidade_id`),
  CONSTRAINT `clientes_fk1` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Data for table "cliente"
#

INSERT INTO `cliente` VALUES (1,'BF Software','janioalexandre@gmail.com','(84) 20102010','(84) 9141-7565','janioalexandre','Rua Jatoba','Nova Parnamirim',2,'RN','59144000','bfsoftware.jpg',''),(2,'Megabrindes','megabrindes@gmail.com','(81) 9141-7565','(81) 9141-7565','megabrindes','Rua','Centro',2,'PE','','megabrindes.jpg','4ec8344271c22551c938a73194818967aecc01145b461c4444206d1887320bd1f221d1fd73bd82e5ff58af27cc5c21e3acc316bc9644ccde2f2fe2c08c41438c'),(4,'Espaço Vida','espaco@gmail.com','(84) 9141-7565','(84) 9141-7565','espacovida','Shopping','Capim Macio',2,'RN','','espaovida.jpg','51bf80a8efb3b6d66455a8f82a4339380e7729b76e138e7d644d35db7e97d39fc3aa9cfd498373aed0da3ca0c6258de087def412db0b599795e36c2e8f976703'),(5,'Legistrab','luizantoniomedeiros@gmail.com','','(84) 9969-5429','naotem','','',1,'RN','','Legistrab.png','fb879f39e326fd64b19a2e7a91762175763aeabbf6b8303afaba721235e009eec0269dead5d5210f2b9d625ba5e4062b5c6ba478a26ffbc777ca1c991c12ccf6'),(6,'Aquastore Natal','barbosajx@globo.com','','(84) 9952-2317','NULL','Rua Adail Pamplona de Menezes, 487','Nova Parnamirim',2,'RN','','default.png','344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f');

#
# Structure for table "comentarios"
#

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL auto_increment,
  `id_leitorcom` int(11) default NULL,
  `id_noticiacom` int(11) default NULL,
  `comentario` text,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`id_comentario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "comentarios"
#

INSERT INTO `comentarios` VALUES (1,1,1,' - OrganizaÃƒÂ§ÃƒÂ£o dos arquivos.\r\n - O portal sera desenvolvido com base no curso: Mini curso PHP - Criando portal de Noticias dinÃƒÂ¢mico, do site webvisualedinamica.com.\r\n ',1),(2,1,1,' - Aula 01 - IntroduÃƒÂ§ÃƒÂ£o - Montagem do Layout no Photoshop.<br>\r\n - Aula 01 ConcluÃƒÂ­da.',1),(3,2,13,'Noticia massa',1),(4,3,13,'Teste de site',1);

#
# Structure for table "contatos"
#

DROP TABLE IF EXISTS `contatos`;
CREATE TABLE `contatos` (
  `id` int(5) NOT NULL auto_increment,
  `nome` varchar(20) NOT NULL,
  `sobrenome` varchar(30) NOT NULL,
  `ddd` int(2) default NULL,
  `telefone` varchar(9) NOT NULL,
  `data_nasc` date default NULL,
  `email` varchar(30) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "contatos"
#

/*!40000 ALTER TABLE `contatos` DISABLE KEYS */;
INSERT INTO `contatos` VALUES (1,'test','teste2',867,'234234234','2014-05-07','testes'),(2,'teste123','teset123',234,'234234234','2014-05-05','testeset');
/*!40000 ALTER TABLE `contatos` ENABLE KEYS */;

#
# Structure for table "crm_prioridade"
#

DROP TABLE IF EXISTS `crm_prioridade`;
CREATE TABLE `crm_prioridade` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "crm_prioridade"
#

INSERT INTO `crm_prioridade` VALUES (1,'Urgente'),(2,'Alta'),(3,'MÃƒÂ©dia'),(4,'Baixa'),(5,'Canigando');

#
# Structure for table "crm_registro_tipo"
#

DROP TABLE IF EXISTS `crm_registro_tipo`;
CREATE TABLE `crm_registro_tipo` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Data for table "crm_registro_tipo"
#

INSERT INTO `crm_registro_tipo` VALUES (1,'Atendimento'),(2,'Analise'),(3,'Desenvolvimento'),(4,'ReuniÃƒÂ£o'),(5,'Visita TÃƒÂ©cnica'),(6,'Treinamento'),(7,'Tutoriais'),(8,'Consultoria'),(9,'DocumentaÃƒÂ§ÃƒÂ£o'),(10,'ImplantaÃƒÂ§ÃƒÂ£o'),(11,'Estudo - ProgramaÃƒÂ§ÃƒÂ£o');

#
# Structure for table "crm_sistema_modulo"
#

DROP TABLE IF EXISTS `crm_sistema_modulo`;
CREATE TABLE `crm_sistema_modulo` (
  `id_sistema_modulo` int(11) NOT NULL auto_increment,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_sistema_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Data for table "crm_sistema_modulo"
#

INSERT INTO `crm_sistema_modulo` VALUES (1,'BF Vendas'),(2,'BF Igreja'),(3,'BF Escola'),(4,'BF ClÃƒÂ­nica '),(5,'BF CRM'),(6,'Outros');

#
# Structure for table "crm_status"
#

DROP TABLE IF EXISTS `crm_status`;
CREATE TABLE `crm_status` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

#
# Data for table "crm_status"
#

INSERT INTO `crm_status` VALUES (1,'Aberto'),(2,'ConcluÃƒÂ­do'),(3,'Aguardando Cliente'),(4,'Cancelado'),(5,'ConcluÃƒÂ­do por falta de retorno'),(6,'Suporte - Aguardando atendimento'),(7,'ImplantaÃƒÂ§ÃƒÂ£o - Aguardando atendimento'),(8,'Suporte - Atendimento nÃƒÂ­vel 1'),(9,'Suporte - Atendimento nÃƒÂ­vel 2');

#
# Structure for table "crm_tipo"
#

DROP TABLE IF EXISTS `crm_tipo`;
CREATE TABLE `crm_tipo` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

#
# Data for table "crm_tipo"
#

INSERT INTO `crm_tipo` VALUES (1,'Elogio'),(2,'DÃƒÂºvida'),(3,'SugestÃƒÂ£o'),(4,'CrÃƒÂ­tica'),(5,'Erro'),(6,'CustomizaÃƒÂ§ÃƒÂ£o'),(7,'Outros'),(8,'Suporte - Atendimento'),(9,'ImplantaÃƒÂ§ÃƒÂ£o'),(10,'ImplantaÃƒÂ§ÃƒÂ£o - Atendimento'),(11,'Consultoria'),(12,'DocumentaÃƒÂ§ÃƒÂ£o'),(13,'Visita tecnica'),(14,'ReuniÃƒÂ£o'),(15,'Tutoriais'),(16,'Video Aula'),(17,'OrÃƒÂ§amento'),(18,'ImplantaÃƒÂ§ÃƒÂ£o - Treinamento'),(19,'Desenvolvimento '),(20,'Analise de Sistemas - CriaÃƒÂ§ÃƒÂ£o'),(21,'Desenvolvimento - CriaÃƒÂ§ÃƒÂ£o'),(22,'Estudo'),(23,'ComercializaÃƒÂ§ÃƒÂ£o - Site');

#
# Structure for table "leitores"
#

DROP TABLE IF EXISTS `leitores`;
CREATE TABLE `leitores` (
  `id_leitor` int(11) NOT NULL auto_increment,
  `nome` varchar(125) default NULL,
  `email` varchar(125) default NULL,
  `senha` char(128) default NULL,
  PRIMARY KEY  (`id_leitor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "leitores"
#

INSERT INTO `leitores` VALUES (1,'Janio Alexandre','atendimento@bfsoftware.com.br','eab3607b203c18db70967a12a487edbc31de53b62e527a89bee41068a65d7259a5a8026d05030e250186081626382bd157dc8668877475dc38838b6322c671ee'),(2,'jackson@teste.com','jackson@teste.com','344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f'),(3,'teste','teste@gmail.com','344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f');

#
# Structure for table "noticias"
#

DROP TABLE IF EXISTS `noticias`;
CREATE TABLE `noticias` (
  `id_noticia` int(11) NOT NULL auto_increment,
  `titulo` varchar(125) NOT NULL,
  `conteudo` text NOT NULL,
  `dataPub` date default NULL,
  `autorPub` varchar(50) NOT NULL,
  `id_autor` int(11) default NULL,
  `tags` text,
  `categoria` int(11) NOT NULL,
  `imagem` varchar(125) default NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY  (`id_noticia`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

#
# Data for table "noticias"
#

INSERT INTO `noticias` VALUES (1,'A importÃƒÂ¢ncia do profissional de TI','<h1 class=\"titulo\" style=\"font-family: Arial; font-size: 36px; color: #444444; font-weight: bold; margin: 0px; padding: 0px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\"><span style=\"font-size: large;\">Voc&ecirc; sabe o que um profissional de TI faz?</span></h1>\r\n<p style=\"color: #333333; font-family: Tahoma, Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" dir=\"ltr\">A &aacute;rea de tecnologia da informa&ccedil;&atilde;o n&atilde;o sai do notici&aacute;rio, ainda mais agora que a categoria<a style=\"text-decoration: none; color: #1c8109;\" href=\"http://olhardigital.uol.com.br/pro/noticia/40461/40461\" target=\"_blank\">est&aacute; em greve</a><span class=\"Apple-converted-space\">&nbsp;</span>no estado de S&atilde;o Paulo. Mas voc&ecirc; sabe quem &eacute; e o que faz o profissional que atua neste setor? Essas quest&otilde;es foram trazidas ao<span class=\"Apple-converted-space\">&nbsp;</span><strong>Olhar Digital</strong><span class=\"Apple-converted-space\">&nbsp;</span>pelo leitor Douglas Fonseca e n&oacute;s procuramos especialistas para ajudar a respond&ecirc;-las.</p>\r\n<p style=\"color: #333333; font-family: Tahoma, Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" dir=\"ltr\">Quem trabalha com TI est&aacute; diretamente ligado ao progresso e &agrave; organiza&ccedil;&atilde;o de empresas, &oacute;rg&atilde;os p&uacute;blicos, entidades, escolas&hellip; onde h&aacute; algum tipo de infraestrutura tecnol&oacute;gica, n&atilde;o importando o tamanho do lugar, l&aacute; est&aacute; o \"menino do computador\" - que, &eacute; bom ressaltar, n&atilde;o gosta de ser chamado assim.</p>\r\n<p style=\"color: #333333; font-family: Tahoma, Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" dir=\"ltr\">O setor de TI se divide basicamente em tr&ecirc;s &aacute;reas de atua&ccedil;&atilde;o: infraestrutura, software e banco de dados. Na primeira est&atilde;o analistas de suporte t&eacute;cnico e administradores de redes; na segunda, programadores e desenvolvedores; na terceira, administradores de banco de dados (conhecidos como ADBs) e especialistas em servidores.<br /><br />H&aacute; mais subdivis&otilde;es, e cada uma depende da outra para operar.&nbsp;Cria&ccedil;&atilde;o de aplicativos m&oacute;veis, desenvolvimeto e implanta&ccedil;&atilde;o de sistemas de seguran&ccedil;a, administra&ccedil;&atilde;o de informa&ccedil;&otilde;es, para citar algumas, tamb&eacute;m est&atilde;o sob tutela do pessoal de TI.</p>\r\n<p style=\"color: #333333; font-family: Tahoma, Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" dir=\"ltr\"><strong>COMO ENTRAR</strong></p>\r\n<p style=\"color: #333333; font-family: Tahoma, Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" dir=\"ltr\">Para ganhar um dos t&iacute;tulos acima a pessoa tem de investir em si mesma, conforme explicado ao<span class=\"Apple-converted-space\">&nbsp;</span><strong>Olhar Digital</strong><span class=\"Apple-converted-space\">&nbsp;</span>pelo diretor de neg&oacute;cios do Grupo Impacta, institui&ccedil;&atilde;o que abrange faculdade, cursos t&eacute;cnicos e col&eacute;gio relacionados a TI. \"Precisa ter forma&ccedil;&atilde;o s&oacute;lida, dom&iacute;nio daquilo que vai desenvolver na carreira\", disse Marcelo Moura.</p>\r\n<p style=\"color: #333333; font-family: Tahoma, Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" dir=\"ltr\">Existe uma vasta gama de cursos, nos mais diversos n&iacute;veis, para quem aspira entrar no setor. Mas a tecnologia da informa&ccedil;&atilde;o tamb&eacute;m &eacute; terreno f&eacute;rtil para autodidatas e costuma receb&ecirc;-los bem. \"O importante &eacute; ter dom&iacute;nio, uma condi&ccedil;&atilde;o avan&ccedil;ada daquele conhecimento\", comentou Moura. \"Independentemente de se ele conseguiu o conhecimento sozinho, numa universidade ou num curso t&eacute;cnico.\"</p>\r\n<p style=\"color: #333333; font-family: Tahoma, Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" dir=\"ltr\">A dedica&ccedil;&atilde;o pessoal, de qualquer forma, &eacute; importante arma neste mercado. O profissional de TI &eacute; um sujeito de perfil anal&iacute;tico, com racioc&iacute;nio l&oacute;gico e dilig&ecirc;ncia, segundo o diretor da Impacta. Mais que isso, o ingl&ecirc;s &eacute; obrigat&oacute;rio e, se a pessoa quiser chegar aos cargos mais altos, a p&oacute;s-gradua&ccedil;&atilde;o &eacute; necess&aacute;ria para que se forme um perfil voltado a estrat&eacute;gias de neg&oacute;cios.</p>\r\n<p style=\"color: #333333; font-family: Tahoma, Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" dir=\"ltr\"><strong>RECOMPENSAS</strong></p>\r\n<p style=\"color: #333333; font-family: Tahoma, Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" dir=\"ltr\">H&aacute; uma car&ecirc;ncia grande de pessoas qualificadas em TI no Brasil, onde faltar&aacute; 45 mil profissionais somente neste ano,<span class=\"Apple-converted-space\">&nbsp;</span><a style=\"text-decoration: none; color: #1c8109;\" href=\"http://olhardigital.uol.com.br/pro/noticia/39543/39543\" target=\"_blank\">de acordo com proje&ccedil;&atilde;o</a><span class=\"Apple-converted-space\">&nbsp;</span>feita pela Brasscom (Associa&ccedil;&atilde;o Brasileira de Empresas de Tecnologia da Informa&ccedil;&atilde;o e Comunica&ccedil;&atilde;o).<br /><br />Aqui o mercado cresce r&aacute;pido demais; para se ter uma ideia, no ano passado houve uma alta 2,5 vezes superior &agrave; m&eacute;dia global, de acordo com Moura. S&oacute; que as escolas n&atilde;o conseguem acompanhar tal ritmo, ent&atilde;o o bom trabalhador &eacute; disputado a tapas.</p>\r\n<p style=\"color: #333333; font-family: Tahoma, Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" dir=\"ltr\">Esse cen&aacute;rio transformou a TI em uma &aacute;rea de super sal&aacute;rios, em que a m&eacute;dia de pagamentos est&aacute; em torno de R$ 6 mil. Um funcion&aacute;rio junior pode come&ccedil;ar a carreira ganhando R$ 3 mil e chegar a R$ 12 mil quando for s&ecirc;nior, e os valores podem ser ainda mais altos, gra&ccedil;as &agrave; falta de regulamenta&ccedil;&atilde;o da profiss&atilde;o, que n&atilde;o possui teto salarial.</p>\r\n<p style=\"color: #333333; font-family: Tahoma, Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" dir=\"ltr\">Claro que nem todo mundo ganha t&atilde;o bem, por isso a base da categoria em S&atilde;o Paulo entrou em greve h&aacute; alguns dias. Sem contar a informalidade, que tira muita gente das estat&iacute;sticas oficiais.</p>\r\n<p style=\"color: #333333; font-family: Tahoma, Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" dir=\"ltr\">&nbsp;</p>\r\n<p style=\"color: #333333; font-family: Tahoma, Arial; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" dir=\"ltr\"><span style=\"font-size: small;\">Fonte:&nbsp;http://olhardigital.uol.com.br</span></p>\r\n<p>&nbsp;</p>','2014-03-15','Administrador Janio',3,'A importÃƒÂ¢ncia do profissional de TI',2,'noticia01.png',1),(2,'Setor de TI terÃƒÂ¡ 78 mil vagas em 2014, prevÃƒÂª Brasscom','<p>O mercado brasileiro de TI vai abrir 78 mil vagas em 2014, das quais apenas 33 mil ser&atilde;o preenchidas por profissionais formados em cursos superiores. O d&eacute;ficit de 45 mil pessoas &eacute; projetado no levantamento mais recente da&nbsp;<span class=\"st\">Brasscom (Associa&ccedil;&atilde;o Brasileira de Empresas de Tecnologia da Informa&ccedil;&atilde;o e Comunica&ccedil;&atilde;o)&nbsp;feito em oito Estados e divulgado nesta segunda-feira ao&nbsp;<strong>Olhar Digital.</strong><br /></span></p>\r\n<p>As &aacute;reas de mobilidade, cloud, seguran&ccedil;a e big data dever&atilde;o estar em alta. As oportunidades aparecem especialmente para pagamentos m&oacute;veis, gamefica&ccedil;&atilde;o, design thinking (aplica&ccedil;&atilde;o de m&eacute;todos e processos para an&aacute;lise de informa&ccedil;&otilde;es e propostas de solu&ccedil;&otilde;es) e internet das coisas (conex&atilde;o plena entre dispositivos).</p>\r\n<p>Em vista do d&eacute;ficit de profissionais, o diretor de RH da Brasscom, Sergio Sgobbi, destaca a import&acirc;ncia da valoriza&ccedil;&atilde;o dos funcion&aacute;rios. &ldquo;Cada vez que um talento &eacute; trocado, ele leva consigo o conhecimento adquirido. Ent&atilde;o, est&atilde;o sendo usadas cada vez mais pol&iacute;ticas de incentivo, reten&ccedil;&atilde;o, remunera&ccedil;&atilde;o e outras formas para que os profissionais fiquem nas companhias&rdquo;, analisa.</p>\r\n<p>O crescimento do setor de TI em 2013 ser&aacute; menor que o estimado no in&iacute;cio do ano e dever&aacute; ficar entre 8% e 10% ante a previs&atilde;o de 10% a 14%. Para 2014, o presidente da Associa&ccedil;&atilde;o, Antonio Gil, acena com otimismo, embora n&atilde;o arrisque n&uacute;meros.&nbsp;&ldquo;Em vista do cen&aacute;rio que o setor vive atualmente, esperamos atingir uma marca significativa de crescimento&rdquo;, prev&ecirc;.</p>\r\n<p><strong>Como se preparar</strong></p>\r\n<p>A forte demanda do mercado eleva a competi&ccedil;&atilde;o por bons cargos. Esta semana, publicamos uma lista com 10 compet&ecirc;ncias essenciais para o profissional de TI que quiser avan&ccedil;ar na carreira.</p>\r\n<p>&nbsp;</p>\r\n<p>Fonte:&nbsp;http://olhardigital.uol.com.br/</p>','2014-03-15','Administrador Janio',3,'Setor de TI terÃƒÂ¡ 78 mil vagas em 2014',2,'noticia2.jpg',1),(3,'Confira 10 competÃƒÂªncias essenciais para o profissional de TI','<p><span>O setor de TI deve registrar crescimento de 8% no faturamento em 2013, segundo a Associa&ccedil;&atilde;o Brasileira de Empresas de Tecnologia da Informa&ccedil;&atilde;o e Comunica&ccedil;&atilde;o (Brasscom). A alta do mercado aumenta a exig&ecirc;ncia por profissionais qualificados para surprir a demanda que dever&aacute; continuar forte nos pr&oacute;ximos anos.&nbsp;Por isso o professor da Faculdade Bandtec&nbsp;Sandro Melo elaborou as 10 principais compet&ecirc;ncias do profissional que quiser obter &ecirc;xito na carreira. Confira:</span><br /><br /><strong>1. Cloud Computing e Virtualiza&ccedil;&atilde;o</strong><br /><span>A computa&ccedil;&atilde;o em nuvem possui um modelo de infraestrutura de TI que prov&ecirc; recursos de modo mais f&aacute;cil e econ&ocirc;mico. Dessa forma, as empresas podem pensar em ter mais aplica&ccedil;&otilde;es para aprimorar e alavancar neg&oacute;cios, o que, consequentemente, demanda que os profissionais de TI e os desenvolvedores de aplicativos tenham a habilidade de explorar os recursos da nuvem.&nbsp;</span><br /><br /><span>O primeiro passo para pensar em um cloud &eacute; ter a capacidade de virtualizar. Todavia, &eacute; poss&iacute;vel ter um ambiente baseado em virtualiza&ccedil;&atilde;o que n&atilde;o atenda todos os quesitos para ser classificado com uma infra-estrutura de Cloud. Por isso, cada vez mais, o mercado requer profissionais que conhe&ccedil;am virtualiza&ccedil;&atilde;o e que saibam trabalhar com o modelo novo de datacenter - desenhado para este fim. Apesar de muita tecnologia estar sendo virtualizada, ainda &ldquo;falta gente com compet&ecirc;ncia apurada nesse segmento&rdquo;, comenta o especialista.</span><br /><br /><strong>2. Programa&ccedil;&atilde;o e desenvolvimento de aplicativos</strong><br /><span>&ldquo;Saber programar &eacute; e sempre ser&aacute; um grande diferencial em qualquer fun&ccedil;&atilde;o de TI que o profissional deseja atuar&rdquo;, afirma Melo. Esta habilidade &eacute; importante, n&atilde;o s&oacute; para quem atua com programa&ccedil;&atilde;o, mas tamb&eacute;m em outras &aacute;reas, como, por exemplo, o profissional de Rede e Banco de Dados, em que a habilidade de programa&ccedil;&atilde;o passa ser um diferencial para prover automa&ccedil;&atilde;o e escalabilidade. &ldquo;As empresas querem funcion&aacute;rios que criem tecnologias com o objetivo de aprimorar processos por meio de programa&ccedil;&atilde;o e desenvolvimento de aplica&ccedil;&otilde;es&rdquo;, complementa.</span><br /><br /><strong>3. Armazenamento de Dados</strong><br /><span>Outra compet&ecirc;ncia em alta. &ldquo;As pessoas falam de computa&ccedil;&atilde;o em nuvem e se esquecem que esses arquivos t&ecirc;m que estar armazenados em algum lugar&rdquo;, explica Melo. Por isso, h&aacute; uma demanda crescente de profissionais com capacidade de criar, registrar, armazenar e gerenciar grande quantidade de estoque de dados.</span><br /><br /><strong>4. Business Inteligence</strong><br /><span>Felizmente, as empresas j&aacute; aprenderam que intelig&ecirc;ncia de dados &eacute; algo relevante. Apesar de ser uma compet&ecirc;ncia consolidada, as crescentes demandas motivam um campo f&eacute;rtil para expans&atilde;o.</span><br /><br /><strong>5. Big Data</strong><br /><span>&Eacute; preciso tratar dados n&atilde;o estruturados e torn&aacute;-los &uacute;teis. Isso demanda profissionais com conhecimentos arrojados, que tenham boa base educacional nas &aacute;reas exatas, como cientistas de dados. Big Data &eacute; uma das principais prioridades para muitas empresas, mas precisa de pessoas certas para analisar toda a informa&ccedil;&atilde;o,&nbsp;</span><br /><br /><strong>6. Mobilidade</strong><br /><span>Em um futuro pr&oacute;ximo, as pessoas deixar&atilde;o de comprar computadores e passar&atilde;o a utilizar apenas itens m&oacute;veis. E conforme h&aacute; o crescimento deste recurso, as empresas passam a precisar, cada vez mais, de profissionais que estejam aptos a lidar com as demandas relacionadas &agrave; prolifera&ccedil;&atilde;o de tais dispositivos.</span><br /><br /><strong>7. IPv6</strong><br /><span>A &ldquo;Internet das Coisas&rdquo; vai gerar um outro conceito computacional, por isso &eacute; necess&aacute;rio existir estrutura que permita isso. No entanto, infelizmente, o Brasil ainda &eacute; um dos pa&iacute;ses que pouco fizeram. Muito disso por conta da falta de profissionais capacitados em IPv6.</span><br /><br /><strong>8. Seguran&ccedil;a</strong><br /><span>Garantir seguran&ccedil;a nos ambientes atuais est&aacute; cada vez mais complexo. Por isso, o mercado tem procurado profissionais que tenham a capacidade n&atilde;o s&oacute; de construir modelos de seguran&ccedil;a, mas tamb&eacute;m de test&aacute;-los, al&eacute;m de serem capaz de atuar quando o problema ocorrer.</span><br /><br /><strong>9. Soft Skills</strong><br /><span>Al&eacute;m das compet&ecirc;ncias t&eacute;cnicas listadas acima, cada vez mais as empresas t&ecirc;m reconhecido a import&acirc;ncia dos fatores comportamentais no trabalho. Seja para o sucesso dos projetos e processos, ou ainda, para o pr&oacute;prio desenvolvimento profissional, compet&ecirc;ncias globais em gest&atilde;o t&ecirc;m tido o mesmo peso que os conhecimentos t&eacute;cnicos.&ldquo;O ideal &eacute; que um profissional tenha um bom equil&iacute;brio entre os hard e os &lsquo;soft skills&rdquo;, comenta Melo. Para trabalhar essas compet&ecirc;ncias com seus alunos, a BandTecoferece aos estudantes o Programa H, que integra forma&ccedil;&atilde;o humanista aos cursos de TI oferecidos pela institui&ccedil;&atilde;o.</span><br /><br /><strong>10. Ingl&ecirc;s</strong><br /><span>Falar ingl&ecirc;s na &aacute;rea de TI &eacute; essencial. Muitas das tecnologias s&atilde;o desenvolvidas nesse idioma, por isso, assim como uma boa forma&ccedil;&atilde;o, o idioma faz parte das compet&ecirc;ncias necess&aacute;rias do profissional que escolhe atuar em TI.&ldquo;&Eacute; importante mostrar novos horizontes aos estudantes, preparando-os para o dia a dia das corpora&ccedil;&otilde;es e para diversos desafios da carreira e TI&rdquo;, conclui Sandro Melo.<br /><br /></span></p>\r\n<p><span>Fonte:&nbsp;http://olhardigital.uol.com.br/</span></p>','2014-03-15','Administrador Janio',3,'Confira 10 competÃƒÂªncias essenciais para o profissional de TI',2,'noticia3.jpg',1),(4,'Kingston lanÃƒÂ§a pendrive para smartphones no Brasil','<p><span>A Kingston decidiu entrar na nova onda do mercado de mobilidade: os pendrives para celulares e tablets. A empresa anunciou nesta quinta-feira, 6, o lan&ccedil;amento da linha&nbsp;DataTraveler microDuo, com uma sa&iacute;da USB e outra micro-USB.</span><br /><br /><span>As duas sa&iacute;das permitem que os arquivos sejam transferidos do PC, com o USB tradicional, armazenados no aparelho, que ter&aacute; capacidades variadas, assim como o pre&ccedil;o, e repassada para o celular.</span><br /><br /><span>O&nbsp;DataTraveler microDuo ser&aacute; lan&ccedil;ado em quatro modelos. A vers&atilde;o de 8 GB tem pre&ccedil;o sugerido de R$ 37; a de 16 GB custar&aacute; R$ 60; o modelo de 32 GB sair&aacute; por R$ 112, enquanto a vers&atilde;o de 64 GB ainda n&atilde;o teve pre&ccedil;o definido.</span><br /><br /><span>A ideia &eacute; uma solu&ccedil;&atilde;o para a falta de espa&ccedil;o nos celulares, principalmente com a moda recente de lan&ccedil;ar aparelhos sem entrada para cart&otilde;es microSD, impossibilitando a expans&atilde;o de mem&oacute;ria de uma maneira mais simples.&nbsp;</span><br /><br /><span>Outras empresas tamb&eacute;m anunciaram recentemente pendrives para celulares.&nbsp;A SanDiskanunciou recentemente o seu modelo, enquanto a Sony tamb&eacute;m j&aacute; revelou o seu pr&oacute;prio dispositivo.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span>Fonte:&nbsp;olhardigital.uol.com.br/</span></p>','2014-03-15','Administrador Janio',3,'pendrive, smartphones',2,'noticia4.jpg',1),(5,'Crackers usam golpe de suporte tÃƒÂ©cnico para enganar usuÃƒÂ¡rios mÃƒÂ³veis','<p><span style=\"font-size: 15px; line-height: 1.45em; word-spacing: 0.125em;\">Pesquisadores da empresa de seguran&ccedil;a Malwarebytes recentemente identificaram um \"golpe do suporte t&eacute;cnico\" que tem como alvo usu&aacute;rios de smartphones e tablets. No in&iacute;cio do m&ecirc;s, a Comiss&atilde;o Federal do Com&eacute;rcio dos EUA tamb&eacute;m alertou consumidores sobre golpes que oferecem reembolso para suporte t&eacute;cnico.</span></p>\r\n<p><strong>Como o esquema funciona</strong></p>\r\n<p>Golpes de suporte t&eacute;cnico consiste em um cibercriminoso fazer uma chamada n&atilde;o solicitada para os usu&aacute;rios. Eles se apresentam como especialistas de suporte t&eacute;cnico que supostamente identificaram uma infec&ccedil;&atilde;o por malware ou outros problemas detectados nos computadores das v&iacute;timas.&nbsp;</p>\r\n<p>Este tipo de fraude tornou-se comum nos &uacute;ltimos anos, especialmente em pa&iacute;ses de l&iacute;ngua inglesa, e causou alertas de grupos de defesa do consumidor, ag&ecirc;ncias governamentais e empresas de seguran&ccedil;a.</p>\r\n<p>Os golpistas usam linguagem t&eacute;cnica e profissional para ganhar a confian&ccedil;a dos usu&aacute;rios e pedir para que as v&iacute;timas baixem e instalem programas de acesso remoto em seus computadores.</p>\r\n<p>Desse modo, os cibercriminosos podem se conectar &agrave;s m&aacute;quinas e abrir diversos utilit&aacute;rios do sistema como o visualizador de eventos do Windows ou o editor de registros para mostrar &agrave;s v&iacute;timas erros em uma tentativa de provar que seus computadores realmente est&atilde;o com problemas.</p>\r\n<p>O objetivo desses scammers &eacute; inscrever as v&iacute;timas em servi&ccedil;os de suporte t&eacute;cnico desnecess&aacute;rios, convenc&ecirc;-las a comprar softwares de seguran&ccedil;a in&uacute;teis, instalar malware em suas m&aacute;quinas ou mesmo roubar informa&ccedil;&otilde;es pessoais e financeiras.</p>\r\n<p><strong>Migrando para o m&oacute;vel</strong></p>\r\n<p>Golpes de suporte t&eacute;cnico tem atingido usu&aacute;rios do Windows e do Mac OS X, mas agora parece que eles est&atilde;o expandindo sua atua&ccedil;&atilde;o para o mercado m&oacute;vel.</p>\r\n<p>\"Empresas envolvidas nesse tipo de golpe podem usar um de dois m&eacute;todos dispon&iacute;ves (ou at&eacute; ambos) para atingir as potenciais v&iacute;timas: podem ligar e/ou usar propaganda online\", disse o pesquisador de seguran&ccedil;a s&ecirc;nior da Malwarebytes, Jerome Segura. \"Enquanto pagar por publicidade requer um determinado or&ccedil;amento, a propaganda tem a vantagem de canalizar as perspectivas com mais qualidade, porque as pessoas de fato est&atilde;o enfrentando um problema.\"</p>\r\n<p>Segura recentemente pesquisou por \"suporte t&eacute;cnico para Android\" no Bing a partir do seu tablet e os dois primeiros resultados de an&uacute;ncios pagos - patrocinados - levavam a sites de empresas que oferecem suporte t&eacute;cnico para tablets e smartphones.</p>\r\n<p>Ele ligou para o n&uacute;mero gratuito listado em uma das p&aacute;ginas e, de acordo com ele, o que se seguiu foi claramente um golpe de suporte t&eacute;cnico.</p>\r\n<p>O suposto t&eacute;cnico pediu que Segura conectasse o telefone ao seu computador e, em seguida, instalasse o software de acesso remoto no computador para que pudesse acessar o telefone. Depois de se conectar por meio do software e navegar por entre o armazenamento interno do telefone, o t&eacute;cnico alegou que uma infec&ccedil;&atilde;o por malware no PC estava causando problemas em toda a rede e afetando o telefone Android quando utilizava o Wi-Fi.</p>\r\n<p>O \"t&eacute;cnico\", ent&atilde;o, afirmou que um arquivo chamado rundll32.exe, que &eacute; na verdade um arquivo de sistema do Windows leg&iacute;timo, era o problema e afirmou que tamb&eacute;m tinha sido instalado no telefone.&nbsp;</p>\r\n<p>De um ponto de vista t&eacute;cnico, isso n&atilde;o faz sentido uma vez que arquivos execut&aacute;veis Ã¢â‚¬â€¹Ã¢â‚¬â€¹do Windows n&atilde;o pode ser executados no Android.</p>\r\n<p>\"&Eacute; muito dif&iacute;cil manter a compostura ao ouvir essas mentiras descaradas\", disse Segura. \"N&atilde;o &eacute; que o t&eacute;cnico &eacute; mal informado, mas ele est&aacute; plenamente consciente do que est&aacute; faz e ainda assim n&atilde;o tem qualquer problema com isso.\"</p>\r\n<p>O t&eacute;cnico ent&atilde;o excluiu alguns arquivos da pasta Windows Prefetch e depois os restaurou usando um atalho de teclado, afirmando que este era um sinal do reaparecimento da infec&ccedil;&atilde;o. Ele, ent&atilde;o, disse a Segura que ele precisaria comprar uma assinatura de suporte t&eacute;cnico de 12 meses, que custaria 299 d&oacute;lares.</p>\r\n<p>\"O mais assustador &eacute; que muitas pessoas que n&atilde;o possuem tanto conhecimento t&eacute;cnico assim acreditam nestas palavras e acabam pagando centenas de d&oacute;lares para servi&ccedil;os duvidosos de empresas de suporte t&eacute;cnico desonestas\", disse Segura.</p>\r\n<p>Embora, neste caso particular os scammers usaram an&uacute;ncios online para atingir os usu&aacute;rios de smartphones e tablets, Segura acredita que eles certamente v&atilde;o usar o m&eacute;todo de chamadas telef&ocirc;nicas n&atilde;o solicitadas tamb&eacute;m. Eles podem pedir aos usu&aacute;rios para instalarem o software de acesso remoto diretamente em seus dispositivos m&oacute;veis no futuro, disse Segura.</p>\r\n<p>&nbsp;</p>\r\n<p>Fonte: http://www.totalsecurity.com.br</p>','2014-03-22','Administrador Janio',3,'Crackers, golpe,  suporte tÃƒÂ©cnico',3,'noticia5.jpg',1),(6,'Golpe: \"WhatsApp\" gratuito para PCs ÃƒÂ© falso e rouba dados bancÃƒÂ¡rios','<p>Pesquisadores do Laborat&oacute;rio de Pesquisa da ESET Am&eacute;rica Latina acabam de identificar um golpe online voltado a usu&aacute;rios brasileiros.&nbsp;</p>\r\n<p>O golpe consiste no envio do e-mail que aparentemente veio do pr&oacute;prio aplicativo, oferecendo ao usu&aacute;rio uma vers&atilde;o gratuita do WhatsApp para PC.&nbsp;</p>\r\n<p>O e-mail cont&eacute;m um Cavalo de Troia anexado a um link malicioso, que est&aacute; disfar&ccedil;ado como sendo o instalador do aplicativo. Uma vez instalado, o malware rouba informa&ccedil;&otilde;es banc&aacute;rias da v&iacute;tima.</p>\r\n<p>Os pesquisadores da ESET identificaram o suposto arquivo execut&aacute;vel (chamado &ldquo;Whatsapp&rdquo;) como sendo o c&oacute;digo malicioso Win32/TrojanDownloader.Banload.</p>\r\n<p>Uma vez executado, o sistema descarrega outro c&oacute;digo arbitr&aacute;rio, o Win32/Spy.Banker.AALL, capaz de roubar informa&ccedil;&otilde;es pessoais relacionadas a dados banc&aacute;rios. Segundo os especialistas da ESET, os levantamentos demonstram que centenas de pessoas j&aacute; foram infectadas pelo malware.</p>\r\n<p>Para Raphael Labaca Castro, coordenador de Awareness &amp; Research da ESET Am&eacute;rica Latina, os usu&aacute;rios precisam ficar atentos para n&atilde;o cair nesse tipo de golpe.&nbsp;</p>\r\n<p>\"Se a proposta &eacute; muito boa, pouco usual ou duvidosa, &eacute; conveniente desconfiar antes de dar o clique e verificar se a informa&ccedil;&atilde;o &eacute; ver&iacute;dica\", alerta.&nbsp;</p>\r\n<p>Vale ressaltar que o aplicativo oficial do WhatsApp somente pode ser usado em smartphones iPhone, BlackBerry, Nokia, Android e Windows Phone, como consta em seu&nbsp;site oficial.</p>\r\n<p>Fonte: http://www.totalsecurity.com.br</p>','2014-03-22','Administrador Janio',3,'Golpe, WhatsApp, dados bancÃƒÂ¡rios',3,'noticia6.jpg',1),(7,'App para checar se carro foi roubado supera 400 mil downloads','<p>O Checkplaca, aplicativo para celular e computador lan&ccedil;ado pelo Minist&eacute;rio da Justi&ccedil;a, alcan&ccedil;ou mais de 400 mil&nbsp;downloads e tornou-se o mais baixado na loja da Apple no Brasil e o 14&ordm; lugar no mundo, conforme resultados divulgados pelo Governo.</p>\r\n<p>Com o Checkplaca, o cidad&atilde;o pode verificar se qualquer ve&iacute;culo &eacute; furtado ou roubado. Basta digitar a placa para o aplicativo informar o modelo, as caracter&iacute;sticas e situa&ccedil;&atilde;o do carro na base de dados do Departamento Nacional de Tr&acirc;nsito (Denatran) e do Sistema Nacional de Informa&ccedil;&otilde;es de Seguran&ccedil;a P&uacute;blica do Minist&eacute;rio da Justi&ccedil;a (Sinesp).</p>\r\n<p>Quando o aplicativo detecta algo irregular, o sistema avisa e d&aacute; a op&ccedil;&atilde;o de o usu&aacute;rio ligar, sem ter que se identificar, para a pol&iacute;cia, que manda uma equipe ao local para verificar a situa&ccedil;&atilde;o. O aplicativo tamb&eacute;m &eacute; utilizado pelas for&ccedil;as policiais. Gratuito, o programa est&aacute; dispon&iacute;vel para dispositivos como os sistemas operacionais&nbsp;<a href=\"http://goo.gl/rui7R5\">IOS (Apple)</a>&nbsp;e&nbsp;<a href=\"http://goo.gl/4uuhiN\">Android</a>.</p>\r\n<p>O Minist&eacute;rio da Justi&ccedil;a informou ainda que 50 ve&iacute;culos foram recuperados gra&ccedil;as ao aplicativo, com m&eacute;dia de um por dia. Mais de 5 milh&otilde;es de consultas j&aacute; foram feitas, com m&eacute;dia de 150 mil diariamente. Em 2012, foram furtados 248.755 e roubados 203.844 ve&iacute;culos. Segundo o minist&eacute;rio, os n&uacute;meros de 2013 ainda n&atilde;o est&atilde;o fechados.</p>\r\n<p>Fonte: http://www.totalsecurity.com.br</p>','2014-03-22','Administrador Janio',3,'App',3,'imagem7.jpg',1),(8,'Falha no WhatsApp permite que crackers leiam mensagens interceptadas ','<p>O popular aplicativo de mensagens m&oacute;veis WhatsApp Messenger tem uma grande falha de projeto na implementa&ccedil;&atilde;o de criptografia que pode permitir que invasores decifrem mensagens interceptadas, de acordo com um desenvolvedor holand&ecirc;s.</p>\r\n<p>O problema &eacute; que a mesma chave &eacute; usada para criptografar os fluxos de entrada e sa&iacute;da entre o cliente e o servidor do servi&ccedil;o, disse Thijs Alkemade, um estudante de ci&ecirc;ncia da computa&ccedil;&atilde;o e matem&aacute;tica da Universidade de Utrecht, na Holanda, e desenvolvedor chefe do cliente de mensagens instant&acirc;neas open-source Adium para o Mac OS X.</p>\r\n<p>\"RC4 &eacute; um PRNG [gerador de n&uacute;meros pseudo-aleat&oacute;rios] que gera um fluxo de bytes, no qual &eacute; feita uma opera&ccedil;&atilde;o de criptografia chamada de XOR com o texto que ser&aacute; criptografado. Ao usar o XOR no texto cifrado com o mesmo fluxo, o texto original &eacute; recuperado\", escreveu Alkemade na ter&ccedil;a-feira (8) em seu blog, em um post em que descreve o problema em detalhes.</p>\r\n<p>Por conta disso, se duas mensagens s&atilde;o criptografadas com a mesma chave e um intruso intercept&aacute;-las - como em uma rede Wi-Fi, ele pode analis&aacute;-las para cancelar a chave e eventualmente recuperar a informa&ccedil;&atilde;o do texto original.</p>\r\n<p>Reutilizar a chave dessa maneira &eacute; um erro b&aacute;sico de implementa&ccedil;&atilde;o de criptografia que os desenvolvedores do WhatsApp deveriam estar cientes, disse Alkemade nesta quarta-feira (9). &Eacute; um erro cometido pelos sovi&eacute;ticos na d&eacute;cada de 1950 e pela Microsoft em seu software VPN em 1995, disse ele.</p>\r\n<p>Alkemade liberou um c&oacute;digo de explora&ccedil;&atilde;o prova de conceito para a vulnerabilidade, mas inicialmente o testou na biblioteca open-source WhatsPoke, n&atilde;o no cliente oficial do WhatsApp. Desde ent&atilde;o, ele confirmou que o problema existe nos clientes WhatsApp para Nokia Series 40 e dispositivos Android.</p>\r\n<p>\"Eu n&atilde;o acho que a situa&ccedil;&atilde;o vai ser diferente com o cliente iOS\", disse ele.</p>\r\n<p>O WhatsApp tamb&eacute;m usa a mesma chave de criptografia RC4 para opera&ccedil;&otilde;es HMAC (c&oacute;digo de autentica&ccedil;&atilde;o de mensagens com base em hash) para autenticar mensagens.</p>\r\n<p>Isso permite que um invasor intercepte uma mensagem enviada por um usu&aacute;rio ao servidor e a envia de volta para o usu&aacute;rio como se ela tivesse vindo do servidor do WhatsApp, mas isso n&atilde;o &eacute; algo que pode ser facilmente explorado, disse Alkemade.</p>\r\n<p>O desenvolvedor holand&ecirc;s n&atilde;o tentou entrar em contato com a empresa antes de divulgar o assunto publicamente. \"Eu pensei ser importante que as pessoas saibam que o WhatsApp n&atilde;o &eacute; seguro e eu n&atilde;o esperava que o corrigissem rapidamente\", disse ele.</p>\r\n<p>O WhatsApp n&atilde;o respondeu imediatamente a um pedido para comentar o assunto na quarta-feira.</p>\r\n<p>Corrigir o problema n&atilde;o requer repensar a implementa&ccedil;&atilde;o de criptografia por inteiro, disse Alkemade. Se a empresa adicionar um m&eacute;todo para gerar chaves diferentes para criptografia em ambas as dire&ccedil;&otilde;es, bem como para autentica&ccedil;&atilde;o de mensagens, ent&atilde;o o problema est&aacute; resolvido, disse e especialista.</p>\r\n<p>De acordo com Alkemade, os usu&aacute;rios por agora devem assumir que qualquer pessoa que puder interceptar suas conex&otilde;es via WhatsApp tamb&eacute;m pode decodificar suas mensagens e devem considerar suas conversas anteriormente feitas servi&ccedil;o comprometidas.</p>\r\n<p>At&eacute; que o problema seja corrigido, a &uacute;nica coisa que os usu&aacute;rios podem fazer para se proteger &eacute; parar de usar o aplicativo, disse Alkemade.</p>\r\n<p>&nbsp;</p>\r\n<p>Fonte: http://www.totalsecurity.com.br</p>','2014-03-22','Administrador Janio',3,'Falha no WhatsApp, Crackers, mensagens interpretadas',3,'noticia8.jpg',1),(9,'Garoto de 8 anos faz sucesso apÃƒÂ³s criar app para Windows Phone','<p>J&aacute; deu pra perceber que o mundo da tecnologia muitas vezes &eacute; precoce, produzindo g&ecirc;nios e milion&aacute;rios cada vez mais jovens, mas o que dizer de um garoto de apenas oito anos de idade que j&aacute; est&aacute; fazendo fama entre desenvolvedores?</p>\r\n<p>Seu nome &eacute; Mohamed Tariq Jaffar Ali e ele criou um aplicativo para Windows Phone capaz de fazer listas com desenhos animados publicados no YouTube. O Kids Zone j&aacute; foi baixado mais de 1,2 mil vezes e tamb&eacute;m permite que se separe as anima&ccedil;&otilde;es por prefer&ecirc;ncia &ndash; Tariq criou um canal \"Mickey Mouse\" para a irm&atilde; de quatro anos, por exemplo.</p>\r\n<p>De acordo com o&nbsp;<a href=\"http://tecnologia.uol.com.br/noticias/redacao/2014/03/24/garoto-de-8-anos-cria-aplicativo-infantil-que-organiza-videos-do-youtube.htm\" target=\"_blank\">UOL</a>, o menino vive em Methuen, Massachusetts (nos EUA), e cursa o terceiro ano da Academia Isl&acirc;mica para a Paz. Foi seu pai, o engenheiro de software Jaffar Ali, que o fez ter contato com esse tipo de tecnologia.</p>\r\n<p>Os dois estiveram, no ano passado, no Nokia Developer Day, voltado a desenvolvedores m&oacute;veis, quando Tariq mostrou interesse pelo Windows Phone App Studio e j&aacute; saiu do evento com a base do Kids Zone pronta.</p>\r\n<p>A pr&oacute;xima aventura do garoto ser&aacute; um aplicativo sobre o sistema solar, pa&iacute;ses e capitais.</p>\r\n<p>&nbsp;</p>\r\n<p>Fonte: <a href=\"http://olhardigital.uol.com.br/\">http://olhardigital.uol.com.br</a>&nbsp;</p>','2014-03-25','Administrador Janio',3,'app, windows Phone',2,'notica9.jpg',1),(10,'Google passa a permitir que usuÃƒÂ¡rios de Android e iOS joguem juntos','<p>O Google est&aacute; atr&aacute;s de um futuro com barreiras menores entre o Android e o iOS, pelo menos em rela&ccedil;&atilde;o aos jogos. A empresa anunciou nesta segunda-feira, 17, algumas novidades no Google Play, que permitir&aacute; que os desenvolvedores de games criem mec&acirc;nicas multiplayer que permitam que usu&aacute;rios da Apple e do Google joguem juntos.</p>\r\n<p>Atualmente, usu&aacute;rios do Android podem jogar apenas com outros usu&aacute;rios do Android, enquanto os do iOS tamb&eacute;m se limitam a outros membros da &ldquo;fam&iacute;lia Apple&rdquo;. A ferramenta permitiria essa compatibilidade, para jogos em turno ou em tempo real, conforme anunciado pela empresa na Game Developer&rsquo;s Conference, que acontece em San Francisco.</p>\r\n<p>Para isso, a empresa anunciou que o plugin da Unity ser&aacute; atualizado para suportar o multiplayer. Tamb&eacute;m foi anunciado um novo kit de desenvolvimento em C++ que permitir&aacute; a cria&ccedil;&atilde;o de conquistas e rankings.</p>\r\n<p>Outras novidades incluem um espa&ccedil;o para desenvolvedores avaliarem o engajamento dos jogadores, conquistas e ranking, al&eacute;m do lan&ccedil;amento do &ldquo;game gifts&rdquo;, que permitir&aacute; que os jogadores enviem presentes aos seus amigos.</p>\r\n<p><a href=\"http://www.theverge.com/2014/3/17/5517508/google-play-game-services-cross-platform-gaming-ios\" target=\"_blank\">Via The Verge</a></p>\r\n<p>Fonte:&nbsp;<a href=\"http://olhardigital.uol.com.br/\">http://olhardigital.uol.com.br</a></p>','2014-03-25','Administrador Janio',3,'Androide e iOS ',4,'noticia10.jpg',1),(11,'Jogo oficial da Copa estÃƒÂ¡ em prÃƒÂ©-venda no Brasil por R$ 250','<p>Agora &eacute; oficial: o Brasil tem um novo patamar de pre&ccedil;os para jogos. O limite, que antes era de R$ 200 por game, saltou para R$ 250. &Eacute; o que indica o an&uacute;ncio feito pela Electronic Arts, que revelou que o game oficial da Copa do Mundo de 2014 ser&aacute; lan&ccedil;ado por este pre&ccedil;o.</p>\r\n<p>O valor &eacute; referente &agrave; pr&eacute;-venda do jogo de futebol, j&aacute; iniciada pelas grandes varejistas. O jogo ser&aacute; lan&ccedil;ado para Xbox 360 e Playstation 3.</p>\r\n<p>A EA j&aacute; havia surpreendido a todos ao lan&ccedil;ar Titanfall para o Xbox One custando estes mesmos R$ 250, mas na ocasi&atilde;o havia ao menos a desculpa de que o game era para a nova gera&ccedil;&atilde;o de consoles, &ldquo;justificando&rdquo; um pre&ccedil;o acima da m&eacute;dia. Neste caso, a mesma justificativa n&atilde;o cabe, j&aacute; que o jogo ser&aacute; restrito &agrave; gera&ccedil;&atilde;o antiga de consoles.</p>\r\n<p>Curiosamente, Gilliard Lopes, produtor do jogo afirmou em fevereiro deste ano que tentaria tornar a edi&ccedil;&atilde;o especial do Fifa a mais acess&iacute;vel j&aacute; lan&ccedil;ada, mas isso acabou n&atilde;o se confirmando quando o jogo come&ccedil;ou a chegar &agrave;s lojas.</p>\r\n<p>O game possui 203 sele&ccedil;&otilde;es, cerca de 7,5 mil jogadores, 19 treinadores e 21 est&aacute;dios, contando com todos os da Copa do Mundo. Basicamente, ser&aacute; poss&iacute;vel levar qualquer sele&ccedil;&atilde;o ao torneio, ou, se o jogador preferir, usar as chaves da competi&ccedil;&atilde;o real.</p>\r\n<p><a href=\"http://g1.globo.com/tecnologia/games/noticia/2014/03/game-oficial-da-copa-do-mundo-sera-lancado-por-r-250-no-brasil.html?fb_action_ids=10201692982118455&amp;fb_action_types=og.recommends\" target=\"_blank\">Via G1</a></p>','2014-03-25','Administrador Janio',3,'Jogo oficial da Copa',4,'noticia11.jpg',1),(12,'Brasil Game Show comeÃƒÂ§a a vender ingressos na quarta-feira','<p><span>A venda de ingressos para a 7&ordf; edi&ccedil;&atilde;o da Brasil Game Show (BGS) ter&aacute; in&iacute;cio nesta quarta-feira, 12 de mar&ccedil;o, &agrave; 0h, por meio do&nbsp;</span><a href=\"http://www.brasilgameshow.com.br/\" target=\"_blank\">site oficial</a><span>. A primeira semana de vendas ser&aacute; exclusiva para visitantes da edi&ccedil;&atilde;o de 2013 cadastrados no sistema da organiza&ccedil;&atilde;o.</span><br /><br /><span>Os interessados em garantir o \"Passaporte\", que d&aacute; direito a todos os dias de feira abertos ao p&uacute;blico, devem desembolsar R$ 117,00 pela meia-entrada, valor promocional at&eacute; o dia 18 de mar&ccedil;o.&nbsp;</span><br /><span>Os ingressos individuais estar&atilde;o dispon&iacute;veis com o valor de R$ 39,00, a meia-entrada, para cada dia de evento.&nbsp;A partir do dia 19, a venda estar&aacute; dispon&iacute;vel para todo o p&uacute;blico.</span><br /><br /><span>Assim como em 2013, o benef&iacute;cio da meia-entrada ser&aacute; concedido a todos os visitantes que doarem 1kg de alimento n&atilde;o perec&iacute;vel na entrada do evento. Al&eacute;m disso, tamb&eacute;m ter&atilde;o direito ao benef&iacute;cio estudantes, professores e idosos com idade a partir de 60 anos, mediante apresenta&ccedil;&atilde;o de comprova&ccedil;&atilde;o da condi&ccedil;&atilde;o.</span><br /><br /><span>A Brasil Game Show deste ano acontecer&aacute; entre 8 e 12 de outubro no Expo Center, em S&atilde;o Paulo.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span>Via&nbsp;<a href=\"http://olhardigital.uol.com.br/noticia/40728/40728\">http://olhardigital.uol.com.br/noticia/40728/40728</a></span></p>','2014-03-25','Administrador Janio',3,'Game',4,'noticia12.jpg',2),(13,'VÃƒÂªm aÃƒÂ­ cursos gratuitos de programaÃƒÂ§ÃƒÂ£o avanÃƒÂ§ada','<p><a href=\"http://olhardigital.uol.com.br/checar.php?materia=/noticia/codecademy-vai-oferecer-cursos-gratuitos-de-programacao-avancada/41572\">http://olhardigital.uol.com.br/checar.php?materia=/noticia/codecademy-vai-oferecer-cursos-gratuitos-de-programacao-avancada/41572</a></p>\r\n<p>&nbsp;</p>\r\n<p>Fonte: Olhardigital.com.br</p>','2014-04-23','Janio Alexandre',1,'Tecnologia',2,'10294333_792726130738338_4047180446824454686_n.jpg',1);

#
# Structure for table "projeto"
#

DROP TABLE IF EXISTS `projeto`;
CREATE TABLE `projeto` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(255) default NULL,
  `descricao` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 PACK_KEYS=0;

#
# Data for table "projeto"
#

INSERT INTO `projeto` VALUES (1,'CRM','Desenvolvimento CRM');

#
# Structure for table "role"
#

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL auto_increment,
  `description` text,
  `mnemonic` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 PACK_KEYS=0;

#
# Data for table "role"
#

INSERT INTO `role` VALUES (1,'Administrator','ADMINISTRATOR');

#
# Structure for table "sysuser"
#

DROP TABLE IF EXISTS `sysuser`;
CREATE TABLE `sysuser` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(50) default NULL,
  `name` varchar(50) default NULL,
  `password` varchar(20) default NULL,
  `id_role` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `sysuser_id` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 PACK_KEYS=0;

#
# Data for table "sysuser"
#

INSERT INTO `sysuser` VALUES (1,'admin','administrador','admin',1);

#
# Structure for table "crm"
#

DROP TABLE IF EXISTS `crm`;
CREATE TABLE `crm` (
  `id` int(5) NOT NULL auto_increment,
  `titulo` varchar(100) NOT NULL,
  `projeto_id` int(5) NOT NULL,
  `data_crm` timestamp NULL default '0000-00-00 00:00:00',
  `tempo` varchar(200) default NULL,
  `porcentagem` int(100) default NULL,
  `descricao` text,
  `solicitante` varchar(100) default NULL,
  `usuarioalteracao` varchar(100) default NULL,
  `responsavel_id` int(5) NOT NULL,
  `tipo_id` int(5) NOT NULL,
  `cliente_id` int(5) NOT NULL,
  `prioridade_id` int(5) NOT NULL,
  `status_id` int(5) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `projeto_id` (`projeto_id`),
  KEY `responsavel_id` (`responsavel_id`),
  KEY `tipo_id` (`tipo_id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `prioridade_id` (`prioridade_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `crm_fk6` FOREIGN KEY (`status_id`) REFERENCES `crm_status` (`id`),
  CONSTRAINT `crm_fk1` FOREIGN KEY (`projeto_id`) REFERENCES `projeto` (`id`),
  CONSTRAINT `crm_fk2` FOREIGN KEY (`responsavel_id`) REFERENCES `sysuser` (`id`),
  CONSTRAINT `crm_fk3` FOREIGN KEY (`tipo_id`) REFERENCES `crm_tipo` (`id`),
  CONSTRAINT `crm_fk4` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`),
  CONSTRAINT `crm_fk5` FOREIGN KEY (`prioridade_id`) REFERENCES `crm_prioridade` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 PACK_KEYS=0;

#
# Data for table "crm"
#

INSERT INTO `crm` VALUES (1,'teste1',1,'2014-05-05 00:00:00','12',10,'testeset','tsteset','admin',1,1,1,1,1),(2,'teste CRM',1,'0000-00-00 00:00:00','50',18,'teste','teset','admin',1,1,2,2,1);

#
# Structure for table "crm_registro"
#

DROP TABLE IF EXISTS `crm_registro`;
CREATE TABLE `crm_registro` (
  `id` int(11) NOT NULL auto_increment,
  `crm_id` int(11) NOT NULL,
  `usuarioalteracao` varchar(100) NOT NULL,
  `tiporegistro_id` int(11) NOT NULL,
  `registro` text NOT NULL,
  `tempo_registro` int(11) NOT NULL,
  `data_registro` date NOT NULL,
  `hora_registro` varchar(5) NOT NULL,
  `numero_registro` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `crm_id` (`crm_id`),
  KEY `tiporegistro_id` (`tiporegistro_id`),
  CONSTRAINT `crm_registro_crm_id` FOREIGN KEY (`crm_id`) REFERENCES `crm` (`id`),
  CONSTRAINT `crm_tiporegistro_id` FOREIGN KEY (`tiporegistro_id`) REFERENCES `crm_registro_tipo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "crm_registro"
#

INSERT INTO `crm_registro` VALUES (1,1,'admin',1,'teste',12,'2014-05-13','8:15',1);

#
# Structure for table "usuarios"
#

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL auto_increment,
  `nome` varchar(125) NOT NULL,
  `imgPerfil` varchar(30) NOT NULL,
  `email` varchar(125) NOT NULL,
  `usuario` varchar(125) NOT NULL,
  `senha` varchar(125) NOT NULL,
  `fk_cliente` int(11) NOT NULL,
  PRIMARY KEY  (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "usuarios"
#

INSERT INTO `usuarios` VALUES (1,'Janio Alexandre','logo.PNG','janioalexandre@gmail.com','janiobf','699328d6430b4fc4b43248c1ec6aa45480d8606513a8d8ef934d67a35d998fabdc1388688ec2cfc984f448dfc357d570aaa144bc5d9ac5c2c566a625b1313',1);
