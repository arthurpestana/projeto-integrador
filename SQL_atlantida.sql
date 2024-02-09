-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema atlantida_system
-- -----------------------------------------------------
DROP DATABASE atlantida_system;
CREATE SCHEMA IF NOT EXISTS atlantida_system DEFAULT CHARACTER SET utf8 ;
USE atlantida_system ;

-- -----------------------------------------------------
-- Table atlantida_system.cadastro_geral
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS atlantida_system.cadastro_geral (
  id_cadastro_geral INT(11) NOT NULL AUTO_INCREMENT,
  cod_tipo_cadastro INT(11) NOT NULL,
  titulo VARCHAR(90) NOT NULL,
  autores VARCHAR(300) NOT NULL,
  cod_editora INT(11) NOT NULL,
  edicao INT(3) NOT NULL,
  ano INT(4) NOT NULL,
  codigo_barras INT(11) NOT NULL,
  num_isbn BIGINT(20) NOT NULL,
  cod_cidade INT(11) NOT NULL,
  idioma VARCHAR(45) NOT NULL,
  aquisicao SMALLINT(6) NOT NULL,
  cod_categoria INT(11) NOT NULL,
  assunto VARCHAR(80) NOT NULL,
  classificacao VARCHAR(45) NOT NULL,
  colecao_volume VARCHAR(45) NOT NULL,
  extra VARCHAR(45) NOT NULL,
  resenha TEXT NOT NULL,
  comentario TEXT NOT NULL,
  imagens TEXT NOT NULL,
  usuario_id_user INT(11) NOT NULL,
  PRIMARY KEY (id_cadastro_geral, usuario_id_user),
  INDEX fk_cadastro_geral_usuario1_idx (usuario_id_user ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table atlantida_system.categoria
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS atlantida_system.categoria (
  id_categoria INT(11) NOT NULL AUTO_INCREMENT,
  descricao VARCHAR(45) NOT NULL,
  tipo_cadastro_id_tipo_cadastro INT(11) NOT NULL,
  cadastro_geral_id_cadastro_geral INT(11) NOT NULL,
  editora_id_editora INT(11) NOT NULL,
  PRIMARY KEY (id_categoria),
  INDEX fk_categoria_tipo_cadastro1_idx (tipo_cadastro_id_tipo_cadastro ASC) ,
  INDEX fk_categoria_cadastro_geral1_idx (cadastro_geral_id_cadastro_geral ASC) ,
  INDEX fk_categoria_editora1_idx (editora_id_editora ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table atlantida_system.cidade
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS atlantida_system.cidade (
  id_cidade INT(11) NOT NULL AUTO_INCREMENT,
  cod_estado INT(11) NOT NULL,
  nome VARCHAR(45) NOT NULL,
  PRIMARY KEY (id_cidade))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table atlantida_system.cliente
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS atlantida_system.cliente (
  id_cliente INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(80) NOT NULL,
  endereco VARCHAR(200) NOT NULL,
  bairro VARCHAR(50) NOT NULL,
  cep VARCHAR(9) NOT NULL,
  cod_cidade INT(4) UNSIGNED ZEROFILL NOT NULL DEFAULT '0000',
  telefone_res VARCHAR(20) NOT NULL,
  telefone_cel VARCHAR(20) NOT NULL,
  email VARCHAR(120) NOT NULL,
  cidade_id_cidade INT(11) NOT NULL,
  cadastro_geral_id_cadastro_geral INT(11) NOT NULL,
  tipo_cadastro_id_tipo_cadastro INT(11) NOT NULL,
  PRIMARY KEY (id_cliente),
  INDEX fk_cliente_cidade1_idx (cidade_id_cidade ASC) ,
  INDEX fk_cliente_cadastro_geral1_idx (cadastro_geral_id_cadastro_geral ASC) ,
  INDEX fk_cliente_tipo_cadastro1_idx (tipo_cadastro_id_tipo_cadastro ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table atlantida_system.editora
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS atlantida_system.editora (
  id_editora INT(11) NOT NULL AUTO_INCREMENT,
  descricao VARCHAR(45) NOT NULL,
  tipo_cadastro_id_tipo_cadastro INT(11) NOT NULL,
  PRIMARY KEY (id_editora),
  INDEX fk_editora_tipo_cadastro1_idx (tipo_cadastro_id_tipo_cadastro ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table atlantida_system.estado
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS atlantida_system.estado (
  id_estado INT(11) NOT NULL AUTO_INCREMENT,
  uf VARCHAR(2) NOT NULL,
  nome_estado VARCHAR(30) NOT NULL,
  PRIMARY KEY (id_estado))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table atlantida_system.tipo_cadastro
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS atlantida_system.tipo_cadastro (
  id_tipo_cadastro INT(11) NOT NULL AUTO_INCREMENT,
  descricao VARCHAR(45) NOT NULL,
  PRIMARY KEY (id_tipo_cadastro))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table atlantida_system.usuario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS atlantida_system.usuario (
  id_user INT(11) NOT NULL AUTO_INCREMENT,
  user_nome VARCHAR(80) NOT NULL,
  user_login VARCHAR(80) NOT NULL,
  user_senha VARCHAR(90) NOT NULL,
  email VARCHAR(90) NOT NULL,
  tipo INT(1) NOT NULL,
  ativo_inativo INT(1) NOT NULL,
  cliente_id_cliente INT(11) NOT NULL,
  PRIMARY KEY (id_user),
  INDEX fk_usuario_cliente1_idx (cliente_id_cliente ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table atlantida_system.comentarios
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS atlantida_system.comentarios (
  idcomentarios INT NOT NULL,
  cadastro_geral_id_cadastro_geral INT(11) NOT NULL,
  comentario_id_titulo VARCHAR(45) NULL,
  comentario_id_user INT(11) NOT NULL,
  comentarios_usuario VARCHAR(500) NULL,
  PRIMARY KEY (idcomentarios, cadastro_geral_id_cadastro_geral, comentario_id_user),
  INDEX fk_comentarios_cadastro_geral_idx (cadastro_geral_id_cadastro_geral ASC) ,
  INDEX fk_comentarios_usuario1_idx (comentario_id_user ASC) ,
  CONSTRAINT fk_comentarios_cadastro_geral
    FOREIGN KEY (cadastro_geral_id_cadastro_geral)
    REFERENCES atlantida_system.cadastro_geral (id_cadastro_geral)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_comentarios_usuario1
    FOREIGN KEY (comentario_id_user)
    REFERENCES atlantida_system.usuario (id_user)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table atlantida_system.avaliacao
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS atlantida_system.avaliacao (
  idavaliacao INT NOT NULL,
  usuario_id_user INT(11) NOT NULL,
  avaliacao_id_cadastro_geral INT(11) NOT NULL,
  avaliacao_estrelas VARCHAR(500) NULL,
  PRIMARY KEY (idavaliacao),
  INDEX fk_avaliacao_usuario1_idx (usuario_id_user ASC) ,
  INDEX fk_avaliacao_cadastro_geral1_idx (avaliacao_id_cadastro_geral ASC) ,
  CONSTRAINT fk_avaliacao_usuario1
    FOREIGN KEY (usuario_id_user)
    REFERENCES atlantida_system.usuario (id_user)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_avaliacao_cadastro_geral1
    FOREIGN KEY (avaliacao_id_cadastro_geral)
    REFERENCES atlantida_system.cadastro_geral (id_cadastro_geral)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- Inserção de Dados na Tabela estado

insert into estado (`id_estado`, `nome_estado`,`uf`)  values
(1, 'Acre', 'AC'),
(2, 'Alagoas', 'AL'),
(3, 'Amazonas', 'AM'),
(4, 'Amapá', 'AP'),
(5, 'Bahia', 'BA'),
(6, 'Ceará', 'CE'),
(7, 'Distrito Federal', 'DF'),
(8, 'Espírito Santo', 'ES'),
(9, 'Goiás', 'GO'),
(10, 'Maranhão', 'MA'),
(11, 'Minas Gerais', 'MG'),
(12, 'Mato Grosso do Sul', 'MS'),
(13, 'Mato Grosso', 'MT'),
(14, 'Pará', 'PA'),
(15, 'Paraíba', 'PB'),
(16, 'Pernambuco', 'PE'),
(17, 'Piauí', 'PI'),
(18, 'Paraná', 'PR'),
(19, 'Rio de Janeiro', 'RJ'),
(20, 'Rio Grande do Norte', 'RN'),
(21, 'Rondônia', 'RO'),
(22, 'Roraima', 'RR'),
(23, 'Rio Grande do Sul', 'RS'),
(24, 'Santa Catarina', 'SC'),
(25, 'Sergipe', 'SE'),
(26, 'São Paulo', 'SP'),
(27, 'Tocantins', 'TO');

	
-- Inserção de Dados na Tabela cidade

insert into cidade (`id_cidade`,`nome`,`cod_estado`) values 

(1, 'Rio Branco', '1'),
(2, 'Maceió', '2'),
(3, 'Manaus', '3'),
(4, 'Macapá', '4'),
(5, 'Salvador', '5'),
(6, 'Fortaleza', '6'),
(7, 'Brasília', '7'),
(8, 'Vitória', '8'),
(9, 'Goiânia', '9'),
(10, 'São Luiz', '10'),
(11, 'Belo Horizonte', '11'),
(12, 'Campo Grande', '12'),
(13, 'Cuiabá', '13'),
(14, 'Belém', '14'),
(15, 'João Pessoa', '15'),
(16, 'Recife', '16'),
(17, 'Teresina', '17'),
(18, 'Curitiba', '18'),
(19, 'Rio de Janeiro', '19'),
(20, 'Natal', '20'),
(21, 'Porto Velho', '21'),
(22, 'Boa Vista', '22'),
(23, 'Porto Alegre', '23'),
(24, 'Florianópolis', '24'),
(25, 'Aracaju', '25'),
(26, 'São Paulo', '26'),
(27, 'Palmas', '27');

-- Inserção de Dados na Tabela tipo_cadastro

insert into tipo_cadastro (`id_tipo_cadastro`, `descricao`) values 
(1, 'Livro'),
(2, 'Revistas'),
(3, 'Manuais'),
(4, 'Videos');

-- Inserção de Dados na Tabela editora

insert into editora ( `id_editora`,`descricao`,`tipo_cadastro_id_tipo_cadastro`) values 
(1, 'Érica', '0'),
(2, 'Masterbooks', '0'),
(3, 'BookOn', '0'),
(4, 'Atica', '0'),
(5,  'Saraiva',  '0'),
(6,  'FacMais', '0'),
(7, 'Paulus','0'),
(8,'OnLine','0');

-- Inserção de Dados na Tabela categoria

insert into categoria ( `id_categoria`,`descricao`,`tipo_cadastro_id_tipo_cadastro`,`cadastro_geral_id_cadastro_geral`,`editora_id_editora` ) values
(1, 'Científico', '0', '0', '0'),
(2, 'Estatística', '0', '0', '0'),
(3, 'Juridico', '0', '0', '0'),
(4, 'História', '0', '0', '0'),
(5, 'Esportes', '0', '0', '0'),
(6, 'Cultura e Artes', '0', '0', '0'),
(7, 'Literatura', '0', '0', '0');

insert into cadastro_geral (`id_cadastro_geral`,`cod_tipo_cadastro`,`titulo`,`autores`,`cod_editora`,`edicao`,`ano`,`codigo_barras`,`num_isbn`,`cod_cidade`, `idioma`,`aquisicao`,
`cod_categoria`,`assunto`,`classificacao`,`colecao_volume`,`extra`,`resenha`,`comentario`,`imagens`,`usuario_id_user`) values 

(1, 1, 'Fundamentos de Radiologia', 'Marcelo Felisberto', 1, '1', '2014', '1185007', '970631', '23', 'Português', '0', '1', 'Especialidades Médicas', 'Radiologia Médica', 'Volume único', '0', 'Como pesquisador e profissional da área de radiologia, o autor reuniu neste guia um grande número de imagens anatômicas e posições radiográficas, explicando-as em linguagem clara e acessível, além de demonstrar passo a passo a execução de todos os procedimentos, com objetivo de auxiliar estudantes e professores.
Aborda a estrutura do esqueleto apendicular dividido em membros superiores (posições e partes anatômicas: mão, punho, antebraço, úmero) e membros inferiores (pé, tornozelo, perna, joelho). Apresenta os cíngulos escapular e pélvico, como também o esqueleto axial, constituído pelas posições de crânio, ossos da face, coluna vertebral, tronco pulmonar e abdome.', 'Com a aplicação metódica e didática de imagens, ensina posicionamentos, técnicas em pacientes politraumatizados, e radiologia em pediatria e de emergência. Apresenta técnicas radiológicas para diversas patologias, como enfisema, tuberculose e pneumonia, bem como para fraturas em diversas regiões. Aborda os posicionamentos do esqueleto apendicular separados em membros superiores (mão, punho, antebraço, cotovelo, úmero), membros inferiores (pé, tornozelo, perna, joelho e fêmur), cíngulo escapular e pélvico, e esqueleto axial (crânio, ossos da face, coluna vertebral, tronco pulmonar e abdome). Em pediatria, expõe as técnicas de imobilização com toalhas e lençóis, ataduras e fitas e sacos de areia, necessárias para facilitar obtenção de resultados com boa qualidade técnica. O conteúdo pode ser aplicado para o curso técnico em Radiologia, entre outros. ','images/fundamentos-de-radiologia.jpg', '0'),

(2, 1, 'Estudo Dirigido: Estatística Descritiva', 'Carlos Takeo Akanime; Roberto Katsuhiro Yamamoto', '2', '3', ' 2009 ', '857571', '978289', '17', 'Português', '0', '2', 'Ciências Exatas', 'Estatística descritiva ', ' Coleção - Pd', '0', 'Este livro descreve vários métodos de apresentação, organização, análise e síntese de dados experimentais. Os leitores terão contato com os métodos de apresentação de dados, como a tabela de freqüência e o histograma, cálculos das medidas de uma distribuição, análise das relações entre variáveis, entre outros assuntos.
O livro utiliza vários exemplos e exercícios resolvidos para a explicação de conceitos e está dividido em vários capítulos, de acordo com a dificuldade do assunto.
Faz parte do livro um programa de computador, que poderá ser utilizado como complemento na compreensão dos conceitos apresentados no livro, sendo uma iniciação no uso de programa de computador que trabalha com métodos estatísticos de dados.','Livro para fins de estudo acadêmico dirigido.','images/estatista-descritiva.jpg', '0'),

(3, 1, 'Direito Tributário - 11ª Edição 2022', ' Luís Eduardo Schoueri', '5', '11', '2022', '152778', '66414', '11', 'Português ', '0', '3', 'Ciências Jurídicas', 'Direito', 'Volume único', '0', 'Uma nova proposta de estudo do Direito Tributário: é assim que o autor descreve este livro. O texto é apresentado em duas fontes tipográficas diferentes: uma delas oferece considerações mais gerais, ideal para um primeiro contato com a matéria; a outra indica estudos mais aprofundados e é, portanto, recomendada a pós-graduandos, profissionais e estudantes da graduação que desejam ir além do conhecimento elementar. O caráter didático do livro fica evidente já no índice sistemático, que cobre integralmente o conteúdo programático da parte geral do Direito Tributário. A dupla graduação do autor (bacharel em Direito pela USP e em Administração Pública pela FGV-SP) reflete-se na obra, que prima pela interdisciplinaridade, mas nem por isso deixa de lado os temas tradicionais, apresentados com o rigor do enfoque científico. Tabelas e gráficos facilitam a assimilação do conteúdo e a fixação dos conceitos. O resultado é um livro diferenciado, organizado de forma a convidar o leitor a uma reflexão sobre os temas tratados.', 'Em 2016, a obra foi eleita Melhor Livro de Direito Tributário 2015/2016 em pesquisa promovida pela Associação Paulista de Estudos Tributários (APET).','images/direito-tributario.jpg', '0'),

(4, 2, 'Revista Científica FacMais', 'Robervaldo Linhares, Clarice Paulon, Gilson Batista, Epaminondas Rodrigues, Nelson Batista,Diogo Fagundes, Renata Magalhães, Isabella Ribeiro', '6', '2', '2020', '263418', '45982', '5', 'Português ', '0', '1', 'Especialidades Médicas e Biologia', 'Revista Científica', 'Volume XVII, Número II', '0', 'No artigo intitulado “Síndrome de Burnout uma correlação com o ambiente de trabalho: uma revisão da literatura”, os autores discorrem sobre a relação do ambiente de trabalho com a síndrome de Burnout e reforçam a necessidade da detecção precoce dos sinais e sintomas desta síndrome para o tratamento oportuno, bem como sobre as medidas de prevenção. No segundo artigo intitulado “Competência profissional na saúde: uma
revisão integrativa”, os autores investigaram a concepção de competência
profissional na área da saúde. 
No terceiro artigo, cujo título é “Atuação da enfermagem na educação
em saúde com grupos de hipertensos e diabéticos segundo o Arco de Charles
Maguerez”, que trata-se de um artigo de reflexão, os autores discorreram sobre a
experiência de acadêmicos de enfermagem na condução de uma prática do estágio
em uma Unidade Básica de Saúde.
No quarto artigo, intitulado “Adesão à higiene de mãos entre
acadêmicos de enfermagem”, objetivou-se avaliar a adesão à técnica correta de
higienização de mãos entre os alunos de graduação do curso de Enfermagem. O
estudo tratou-se de uma pesquisa do tipo transversal, que por meio de observação,
identificou importantes resultados, que podem contribuir para a segurança do paciente, no que tange às ações do profissional para a prevenção de infecção relacionadas à assistência à saúde.
No artigo “Identificação de alimentos alergênicos e tóxicos em lactentes: revisão de literatura” os autores realizaram uma revisão da literatura para verificar os principais alimentos tóxicos e alergênicos para lactentes. 
No sexto artigo, intitulado “Avaliação do Acolhimento com Classificação de Risco realizado em uma Unidade de Pronto Atendimento”, os autores objetivaram avaliar o acolhimento com classificação de risco (ACCR) realizado pelos enfermeiros que atuam em Unidade de Pronto Atendimento (UPA) na cidade de Rio Verde e descrever o perfil destes profissionais, bem como caracterizar a estrutura, processo e resultado do procedimento. 
 O sétimo artigo, cujo título é “Diagnósticos e Intervenções de Enfermagem em acometidos por Traumatismo Cranioencefálico em um Hospital Universitário”, trata-se também um estudo transversal, descritivo, com levantamento de informações a partir de prontuários de pessoas que sofreram Traumatismo Cranioencefálico (TCE) e foram atendidas em um hospital público universitário. 
O oitavo artigo, “Análise de Bioinformática da relação entre a proteína P53 e a endometriose aplicada à área de enfermagem: alternativas para o diagnóstico e tratamento”, trata de uma abordagem de bioinformática, cujo foco foi demonstrar por meio de simulação de computador alterações polimórficas no gene p53. O trabalho aponta para a possibilidade de usar a p53 como um possível marcador molecular no diagnóstico da endometriose como alternativa menos invasiva. 
O artigo “Infertilidade masculina e cromossomos autossômicos”, trata-se de uma revisão da literatura que discorre sobre os aspectos genéticos relacionados à infertilidade masculina. O estudo pretende iniciar uma discussão, alicerce futuros estudos. 
O décimo artigo, intitulado “Associação entre Medicina Psicossomática e asma: uma revisão narrativa da literatura” constitui uma revisão da literatura, na qual os autores discorrem sobre os aspectos psicossomáticos que acarreta piora diagnóstica e terapêutica em pessoas com asma, evidenciadas nas publicações incluídas na revisão. 
O décimo primeiro artigo, cujo título é “A qualidade de vida dos pacientes após a cicatrização da Síndrome de Fournier associada ao tratamento Hiperbárico”, tratou-se de uma pesquisa do tipo transversal, descritiva, por meio da qual foi avaliada a qualidade de vida dos pacientes acometidos pela Síndrome de Fournier submetidos ao tratamento hiperbárico por meio do instrumento WHOQOL– ABREVIADO. 
O décimo segundo artigo, intitulado “Brasil Sorridente e a sua abrangência, reabilitando sorrisos”, acampado na área da Odontologia, discorre sobre um importante programa de saúde pública/coletiva, nomeado Brasil sorridente, suas finalidades e funcionamento. Esse estudo foi realizado na cidade de Itajaí, Santa Catarina.
 O décimo terceiro artigo, último desta edição, intitula-se “Segurança do paciente no centro cirúrgico a partir da implantação do checklist de cirurgia segura: uma revisão da literatura”. Esse artigo constitui uma revisão da literatura e trata de um assunto muito atual e relevante, a segurança do paciente no contexto do centro cirúrgico.', 'Há seis anos a Revista Científica da FacMais vem contribuindo para a sociabilização do conhecimento, articulando pesquisa, ensino e extensão. A revista publica trabalhos de docentes e pesquisadores. E possui qualis nas seguintes áreas: Educação, Ensino, Saúde e História','images/revista-FacMais-2020.png', '0'),

(5, 1, 'Geoatlas', 'Maria Elena Ramos Simielli ', '4', '35', '2019', '853300', '855601', '6', 'Português ', '0', '1', 'Ciências Geográficas', 'Geografia', 'Volume único', '0', 'O mais tradicional atlas escolar do mercado chega à 35ª edição, atualizada com mapas temáticos que acompanham as mudanças ambientais, socioeconômicas, geopolíticas, nacionais e internacionais. Diferentes representações gráficas estimulam a localização, a comparação e a análise dos mais variados temas geográficos. Com o habitual rigor bibliográfico e de representações cartográficas, além da presença dos temas pertinentes à compreensão da distribuição e estruturação espacial dos fenômenos geográficos, a obra mantém sua metodologia de trabalho com diferentes temas nas mais variadas escalas.', 'Fotos e imagens de satélites complementam as informações cartográficas.','images/GEOATLAS-atica.jpg', '0'),

('6', '1', 'Culturas e Artes do Pós-humano: da Cultura das Mídias à Cibercultura','Lucia Santaella','7','1','2003','97838715','95283557','20','Português','0','6','Cibercultura','Arte','Comunicação','0','Lucia Santaella apresenta nesta obra o fruto de suas reflexões desde que a passagem da cultura de massas para a cultura das mídias fertilizou gradativamente o terreno sociocultural para o surgimento da cultura digital, ora em curso. Ela deseja com este livro contribuir com sugestões de respostas às questões que estão no centro da atenção daqueles que têm sido movidos pelo desejo da pesquisa sobre os temas do ciberespaço,
 cibercultura e ciberarte: O que está acontecendo à interface ser humano-máquina e o que isso está significando para a comunicação e a cultura do início do século 21? As respostas para essas questões, sempre tentativas em tempos de incerteza, pretendem repensar o humano neste alvorecer do vir-a-ser tecnológico do mundo. Os meios para esse repensamento vêm da história das novas tecnologias, da filosofia, da psicanálise, da comunicação e semiótica e, sobretudo, da arte.','Santaella reconhece que o título do livro (referindo-se ao pós-humano) é perturbador, pois pode sugerir que o humano já se foi, perdeu-se no golpe dos acontecimentos. “Insisto em mantê-lo, apesar desses perigos interpretativos, porque pretendo chamar a atenção para a necessidade de se repensar o humano até o limite de sua essência molecular”, afirma a autora.','images/cibercultura.jpg','0'),

('7','2','Bakhtiniana: Revista de Estudos do Discurso','LAEL-PUCSP e CNPq','3','4','2022','2343536','645366','15','Português e Inglês','0','1','Discurso Linguístico','Estudo Científico Linguístico','17','0','Bakhtiniana: Revista de Estudos do Discurso, criada em 2008 pelo Programa de Estudos Pós-Graduados em Linguística Aplicada e Estudos da Linguagem/LAEL-PUCSP e pelo Grupo de Pesquisa/CNPq Linguagem, Identidade e Memória, certificado pela PUC-SP, tem como missão promover e divulgar pesquisas produzidas no campo dos estudos do discurso, com destaque para os estudos dialógicos. Em formato eletrônico, reúne trimestralmente artigos originais e resenhas. Em sintonia com as atuais e boas práticas de comunicação científica nacionais e internacionais, Bakhtiniana. A Revista de Estudos do Discurso iniciou, em 2020, o seu processo de adesão a Ciência Aberta. A Ciência Aberta é um novo modo de formatar, projetar, gerir, comunicar e avaliar a pesquisa e sua comunicação, primando pela transparência dos processos e pela disponibilização dos elementos que fundamentam sua comunicação, tais como métodos, dados e programas de computador.
Este é o único periódico que contempla os estudos bakhtinianos no Brasil e no estrangeiro, de forma específica e em seu diálogo com outras áreas do conhecimento. Os artigos podem ser enviados em português ou inglês, devendo ser inéditos e seguir as normas de publicação presentes no site http://revistas.pucsp.br/index.php/bakhtiniana','Bakhtiniana. Revista de Estudos do Discurso encoraja seus autores a disponibilizar todos os conteúdos (dados, códigos de programa e outros materiais) subjacentes ao texto do manuscrito anteriormente ou no momento da publicação. Exceções são permitidas em casos de questões legais e éticas. O objetivo é facilitar a avaliação do manuscrito e, se aprovado, contribuir para a preservação e reuso dos conteúdos e das pesquisas.','images/bakhtiniana-revista.jpg','0'),

('8','3','Manual dos Doentes','CNBB','7','1','1997','98324','283725',7,'Português','0','6','Pastoral da saúde','Liturgia','Subsídios da CNBB','0','Um livro destinado aos doentes, a seus parentes, a todos aqueles que trabalham nos hospitais. Aponta as diversas maneiras de o doente encontrar-se com Deus, fonte de vida','Livro de ajuda e direção a quem deseja alinhar-se com Deus nos momentos de tristeza.','images/manual-doentes.png','0'),

(9,1,'D. Pedro: a história não contada','Paulo Rezzuti','5','1','2015','569234','572087','10','Português','0','4','Biografia detalhada de Dom Pedro I','História de vida (relações familiares)','Único','0','Ao morrer, d. Pedro deixou para as futuras gerações de brasileiros uma difícil tarefa: entender as muitas contradições da sua vida e extrair das suas memórias uma imagem fiel de sua personalidade, suas ideias, angústias e ambições. Até hoje, esta tarefa não havia sido bem cumprida. Em meio a um emaranhado de especulações e distorções históricas, restava ainda a interrogação:quem foi o primeiro imperador do Brasil? Foi para responder a essa pergunta que Paulo Rezzutti recorreu a uma ampla gama de fontes primárias e documentos originais que revelam uma miríade de facetas desconhecidas de d. Pedro, e que lhe deram acesso à história não contada do nosso primeiro monarca – esta que agora você tem em mãos. Em lugar da caricatura que tomou conta do imaginário nacional, o autor nos apresenta o homem por trás do imperador, com todas as contradições e riqueza de personalidade que o transformam em um dos personagens mais interessantes da nossa história – um homem que, para além das muitas amantes, dos filhos ilegítimos e da fama de turrão, nos deixou como legado uma história de sacrifícios em prol da unidade nacional; um homem repleto de defeitos morais e contradições políticas, mas que esteve ligado a grandes passagens da história do liberalismo mundial, e que, acima de tudo, viveu uma vida intensa e repleta de humanidade.', 'A obra imerge nas conversas do monarca com a sua amada, por meio de cartas escritas entre 1823 e 1828. Estima-se que este arquivo tenha ficado escondido por muitos anos, até ser revelado em Nova York. Este livro realiza, ainda, uma análise histórica do circuito individual das relações amorosas entre os personagens, ao mesmo tempo que, ilumina aspectos da vida nacional, a partir do recorte. Por meio de trechos retirados das cartas originais, Rezzutti destaca características que poderiam ser próprias de qualquer pessoa, mas que são manifestadas pelo imperador. Além das demonstrações de libido e ciúmes, por exemplo, há trechos de descontração hilariantes e reclamações mundanas que trazem uma perspectiva diferente do caso amoroso mais famoso de nossa História.','images/dom-pedro.jpg',0),

(10,1,'Estatística básica', 'Pedro Morettin e Wilton de O. Bussab','5','9','2017','5667553','2356547',5,'Português',0,2,'Ciências Exatas','Conceitos básicos de estatística','Use o R',0,'Completo e didático, Estatística Básica é o livro mais adequado para alunos e profissionais de diversas áreas do conhecimento e se destaca por ser a única obra com uma seção em todos os capítulos que ensina a aplicar a teoria por meio dos pacotes computacionais Minitab®, Excel®, Splus® e o pacote do Repositório livre R®. No final do livro, os autores apresentam vários conjuntos de dados que poderão ser utilizados pelos leitores e que estão disponíveis no site.','Livro mais vendido da área, a 9ª edição de Estatística Básica confirma seu grande sucesso com um extenso trabalho de revisão, atualização e ampliação, que contou com sugestões de professores e leitores enriquecendo ainda mais o conteúdo por meio de discussões sobre roteiros apropriados para cursos de diferentes níveis. O livro é dividido em três partes. A primeira trata da análise de dados unidimensionais e bidimensionais, com atenção especial para métodos gráficos. A segunda parte traz os conceitos básicos de probabilidades e variáveis aleatórias. Por fim, a terceira parte estuda os tópicos principais da inferência estatística, além de alguns temas especiais, como regressão linear simples.','images/estatistica-basica.jpg','0'),

(11,2,'Show de Bola Magazine Super Pôster - Flamengo Tricampeão da Libertadores','On Line Editora','8','77','2022','234586','546778','19','Português','0','5','Tricampeonato do Flamengo na Libertadores','Campeonato de Futebol','Show de Bola','0','Eternize este momento histórico com este superpôster do Flamengo, Tricampeão da Libertadores.','Recomendado para torcedores fanáticos do Flamengo, que agora é Tricampeão da Libertadores em 2022.','images/mengo-tricampeao.jpg', '0'),

(12,3,'Manual de Direito Penal','Junqueira, Gustavo, Vanzolini, Patrícia','5','7','2021','784566','688979','25','Português','0','3','Ciências Jurídicas','Direito Penal','Parte Geral','0','Em volume único, o Manual de direito penal, de Patrícia Vanzolini e Gustavo Junqueira, reúne o conhecimento e a experiência dos es, cada um com mais de quinze anos de vida docente em cursos de graduação e pós graduação, além de cursos preparatórios para concursos.O leitor encontrará no Manual de Direito Penal uma análise detida sobre a parte geral do Código. Princípios penais, teoria da lei penal, teoria do crime e teoria da pena serão abordados de forma profunda e atualizada.A obra tem o perfil didático próprio dos cursos de graduação. Permite introduzir o aluno na ciência penal por meio de uma leitura global e contextualizada com o cenário histórico e político. ','Traz exemplos e acompanha a organização dos cursos preparatórios, o que facilita compreender e fixar a matéria. A nova edição cuidou especialmente da objetividade da escrita e linguagem simples.Inclui pesquisa de doutrina estrangeira, o que agrada também ao estudante de pós graduação.Serve também ao estudante de cursos preparatórios, pois a nova face dos concursos públicos, marcada pela super concorrência exige diferenciais como o conhecimento das mais variadas posições e a capacidade para desenvolver raciocínios críticos.','images/direito-penal.jpg',0),

(13, 1,'Antologia De Poesia Brasileira Romantismo','Valentim Facioli','4','1','1999','895678','234578','8','Português','0','7','Poesia Brasileira','Poesia','Série Bom Livro','0','Dúvida existencial, amor impossível, desejo de morte - estes são os temas mais conhecidos da poesia romântica. Mas há nesse movimento artístico outras facetas: o ímpeto revolucionário, a luta pela liberdade, o louvor à pátria e aos índios, o humor e o grotesco. Esta coletânea reúne a diversidade que o romantismo adquiriu em solo brasileiro. Mais do que ajudar a fundar uma literatura própria, esses poetas celebraram ideais estéticos e políticos que ressoam nos tempos atuais.','Leitura recomendada para amantes da literatura e do romantismo.','images/antologia-romantismo.jpg','0');



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


