-- MySQL Workbench Forward Engineering

-- -----------------------------------------------------
-- Schema gestaoescolar
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `Pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Pessoa` (
  `idPessoa` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `sexo` VARCHAR(1) NOT NULL DEFAULT 'M',
  `dataNascimento` DATE NOT NULL,
  `email` VARCHAR(60) NOT NULL,
  `telefoneFixo` INT NULL,
  `telefoneCelular` INT NULL,
  `status` ENUM('A', 'I') NOT NULL DEFAULT 'A',
  `endereco` VARCHAR(80) NULL,
  PRIMARY KEY (`idPessoa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Funcao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Funcao` (
  `idFuncao` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idFuncao`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Funcionario` (
  `idFuncionario` INT NOT NULL AUTO_INCREMENT,
  `pis` INT NOT NULL,
  `Funcao_idFuncao` INT NOT NULL,
  `Pessoa_idPessoa` INT NOT NULL,
  PRIMARY KEY (`idFuncionario`),
  INDEX `fk_Funcionario_Funcao_idx` (`Funcao_idFuncao` ASC),
  INDEX `fk_Funcionario_Pessoa1_idx` (`Pessoa_idPessoa` ASC),
  CONSTRAINT `fk_Funcionario_Funcao`
    FOREIGN KEY (`Funcao_idFuncao`)
    REFERENCES `Funcao` (`idFuncao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Funcionario_Pessoa1`
    FOREIGN KEY (`Pessoa_idPessoa`)
    REFERENCES `Pessoa` (`idPessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Professores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Professores` (
  `idProfessores` INT NOT NULL AUTO_INCREMENT,
  `pis` INT NOT NULL,
  `Pessoa_idPessoa` INT NOT NULL,
  PRIMARY KEY (`idProfessores`),
  INDEX `fk_Professores_Pessoa1_idx` (`Pessoa_idPessoa` ASC),
  CONSTRAINT `fk_Professores_Pessoa1`
    FOREIGN KEY (`Pessoa_idPessoa`)
    REFERENCES `Pessoa` (`idPessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Responsavel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Responsavel` (
  `idResponsavel` INT NOT NULL AUTO_INCREMENT,
  `empresa` VARCHAR(45) NOT NULL,
  `funcao` VARCHAR(45) NOT NULL,
  `Pessoa_idPessoa` INT NOT NULL,
  PRIMARY KEY (`idResponsavel`),
  INDEX `fk_Responsavel_Pessoa1_idx` (`Pessoa_idPessoa` ASC),
  CONSTRAINT `fk_Responsavel_Pessoa1`
    FOREIGN KEY (`Pessoa_idPessoa`)
    REFERENCES `Pessoa` (`idPessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Sala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sala` (
  `idSala` INT NOT NULL AUTO_INCREMENT,
  `numero` INT NOT NULL,
  `capacidade` INT NOT NULL,
  PRIMARY KEY (`idSala`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Turma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Turma` (
  `idTurma` INT NOT NULL AUTO_INCREMENT,
  `turno` ENUM('M', 'T', 'N') NOT NULL DEFAULT 'M',
  `serie` VARCHAR(5) NULL,
  `vagas` INT NOT NULL,
  `Sala_idSala` INT NOT NULL,
  PRIMARY KEY (`idTurma`),
  INDEX `fk_Turma_Sala1_idx` (`Sala_idSala` ASC),
  CONSTRAINT `fk_Turma_Sala1`
    FOREIGN KEY (`Sala_idSala`)
    REFERENCES `Sala` (`idSala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TipoPagamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TipoPagamento` (
  `idTipoPagamento` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipoPagamento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Matricula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Matricula` (
  `numeroMatricula` INT NOT NULL AUTO_INCREMENT,
  `TipoPagamento_idTipoPagamento` INT NOT NULL,
  `status` VARCHAR(1) NULL,
  PRIMARY KEY (`numeroMatricula`),
  INDEX `fk_Matricula_TipoPagamento1_idx` (`TipoPagamento_idTipoPagamento` ASC),
  CONSTRAINT `fk_Matricula_TipoPagamento1`
    FOREIGN KEY (`TipoPagamento_idTipoPagamento`)
    REFERENCES `TipoPagamento` (`idTipoPagamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Alunos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Alunos` (
  `idAlunos` INT NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(45) NULL,
  `Pessoa_idPessoa` INT NOT NULL,
  `Turma_idTurma` INT NOT NULL,
  `Matricula_numeroMatricula` INT NOT NULL,
  PRIMARY KEY (`idAlunos`),
  INDEX `fk_Alunos_Pessoa1_idx` (`Pessoa_idPessoa` ASC),
  INDEX `fk_Alunos_Turma1_idx` (`Turma_idTurma` ASC),
  INDEX `fk_Alunos_Matricula1_idx` (`Matricula_numeroMatricula` ASC),
  CONSTRAINT `fk_Alunos_Pessoa1`
    FOREIGN KEY (`Pessoa_idPessoa`)
    REFERENCES `Pessoa` (`idPessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Alunos_Turma1`
    FOREIGN KEY (`Turma_idTurma`)
    REFERENCES `Turma` (`idTurma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Alunos_Matricula1`
    FOREIGN KEY (`Matricula_numeroMatricula`)
    REFERENCES `Matricula` (`numeroMatricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Parcelas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Parcelas` (
  `idParcelas` INT NOT NULL AUTO_INCREMENT,
  `data_pagamento` DATE NULL,
  `valor` FLOAT NOT NULL,
  `mes` INT NOT NULL,
  `ano` INT NOT NULL,
  `Matricula_numeroMatricula` INT NOT NULL,
  PRIMARY KEY (`idParcelas`),
  INDEX `fk_Parcelas_Matricula1_idx` (`Matricula_numeroMatricula` ASC),
  CONSTRAINT `fk_Parcelas_Matricula1`
    FOREIGN KEY (`Matricula_numeroMatricula`)
    REFERENCES `Matricula` (`numeroMatricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Autor` (
  `idAutor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idAutor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Livros` (
  `idLivros` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `ano` INT NOT NULL,
  PRIMARY KEY (`idLivros`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TipoExemplar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TipoExemplar` (
  `idTipoExemplar` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipoExemplar`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Exemplar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Exemplar` (
  `CodExemplar` INT NOT NULL AUTO_INCREMENT,
  `estante` INT NOT NULL,
  `prateleira` INT NOT NULL,
  `status` VARCHAR(1) NOT NULL,
  `danificado` TINYINT(1) NOT NULL DEFAULT 0,
  `Livros_idLivros` INT NOT NULL,
  `TipoExemplar_idTipoExemplar` INT NOT NULL,
  PRIMARY KEY (`CodExemplar`),
  INDEX `fk_Exemplar_Livros1_idx` (`Livros_idLivros` ASC),
  INDEX `fk_Exemplar_TipoExemplar1_idx` (`TipoExemplar_idTipoExemplar` ASC),
  CONSTRAINT `fk_Exemplar_Livros1`
    FOREIGN KEY (`Livros_idLivros`)
    REFERENCES `Livros` (`idLivros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Exemplar_TipoExemplar1`
    FOREIGN KEY (`TipoExemplar_idTipoExemplar`)
    REFERENCES `TipoExemplar` (`idTipoExemplar`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Reserva` (
  `idReserva` INT NOT NULL AUTO_INCREMENT,
  `dataReserva` DATE NOT NULL,
  `dataAgenda` DATE NOT NULL,
  `Alunos_idAlunos` INT NOT NULL,
  PRIMARY KEY (`idReserva`),
  INDEX `fk_Reserva_Alunos1_idx` (`Alunos_idAlunos` ASC),
  CONSTRAINT `fk_Reserva_Alunos1`
    FOREIGN KEY (`Alunos_idAlunos`)
    REFERENCES `Alunos` (`idAlunos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TipoMulta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TipoMulta` (
  `idTipoMulta` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipoMulta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Multa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Multa` (
  `idMulta` INT NOT NULL AUTO_INCREMENT,
  `valor` FLOAT NULL,
  `dataPagamento` DATE NULL,
  `status` ENUM('P', 'N') NULL DEFAULT 'N',
  `TipoMulta_idTipoMulta` INT NOT NULL,
  PRIMARY KEY (`idMulta`),
  INDEX `fk_Multa_TipoMulta1_idx` (`TipoMulta_idTipoMulta` ASC),
  CONSTRAINT `fk_Multa_TipoMulta1`
    FOREIGN KEY (`TipoMulta_idTipoMulta`)
    REFERENCES `TipoMulta` (`idTipoMulta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Retirada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Retirada` (
  `idRetirada` INT NOT NULL AUTO_INCREMENT,
  `dataRetirada` DATE NOT NULL,
  `dataDevolucao` DATE NOT NULL,
  `renovacao` INT NULL,
  `valorMulta` FLOAT NULL,
  `Multa_idMulta` INT NOT NULL,
  `Alunos_idAlunos` INT NOT NULL,
  PRIMARY KEY (`idRetirada`),
  INDEX `fk_Retirada_Multa1_idx` (`Multa_idMulta` ASC),
  INDEX `fk_Retirada_Alunos1_idx` (`Alunos_idAlunos` ASC),
  CONSTRAINT `fk_Retirada_Multa1`
    FOREIGN KEY (`Multa_idMulta`)
    REFERENCES `Multa` (`idMulta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Retirada_Alunos1`
    FOREIGN KEY (`Alunos_idAlunos`)
    REFERENCES `Alunos` (`idAlunos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Advertencias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Advertencias` (
  `idAdvertencias` INT NOT NULL AUTO_INCREMENT,
  `motivo` VARCHAR(500) NOT NULL,
  `data` DATE NOT NULL,
  `Alunos_idAlunos` INT NOT NULL,
  PRIMARY KEY (`idAdvertencias`),
  INDEX `fk_Advertencias_Alunos1_idx` (`Alunos_idAlunos` ASC),
  CONSTRAINT `fk_Advertencias_Alunos1`
    FOREIGN KEY (`Alunos_idAlunos`)
    REFERENCES `Alunos` (`idAlunos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TipoMaterais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TipoMaterais` (
  `idTipoMaterais` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipoMaterais`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MateriaisTurma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MateriaisTurma` (
  `idMateriaisTurma` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `TipoMaterais_idTipoMaterais` INT NOT NULL,
  `Turma_idTurma` INT NOT NULL,
  PRIMARY KEY (`idMateriaisTurma`),
  INDEX `fk_MateriaisTurma_TipoMaterais1_idx` (`TipoMaterais_idTipoMaterais` ASC),
  INDEX `fk_MateriaisTurma_Turma1_idx` (`Turma_idTurma` ASC),
  CONSTRAINT `fk_MateriaisTurma_TipoMaterais1`
    FOREIGN KEY (`TipoMaterais_idTipoMaterais`)
    REFERENCES `TipoMaterais` (`idTipoMaterais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MateriaisTurma_Turma1`
    FOREIGN KEY (`Turma_idTurma`)
    REFERENCES `Turma` (`idTurma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Feriados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Feriados` (
  `idFeriados` INT NOT NULL AUTO_INCREMENT,
  `dia` INT NOT NULL,
  `mes` INT NOT NULL,
  `ano` INT NULL,
  `tipo` ENUM('M', 'E') NULL,
  PRIMARY KEY (`idFeriados`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Responsavel_has_Alunos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Responsavel_has_Alunos` (
  `Responsavel_idResponsavel` INT NOT NULL,
  `Alunos_idAlunos` INT NOT NULL,
  PRIMARY KEY (`Responsavel_idResponsavel`, `Alunos_idAlunos`),
  INDEX `fk_Responsavel_has_Alunos_Alunos1_idx` (`Alunos_idAlunos` ASC),
  INDEX `fk_Responsavel_has_Alunos_Responsavel1_idx` (`Responsavel_idResponsavel` ASC),
  CONSTRAINT `fk_Responsavel_has_Alunos_Responsavel1`
    FOREIGN KEY (`Responsavel_idResponsavel`)
    REFERENCES `Responsavel` (`idResponsavel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Responsavel_has_Alunos_Alunos1`
    FOREIGN KEY (`Alunos_idAlunos`)
    REFERENCES `Alunos` (`idAlunos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Autor_has_Livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Autor_has_Livros` (
  `Autor_idAutor` INT NOT NULL,
  `Livros_idLivros` INT NOT NULL,
  PRIMARY KEY (`Autor_idAutor`, `Livros_idLivros`),
  INDEX `fk_Autor_has_Livros_Livros1_idx` (`Livros_idLivros` ASC),
  INDEX `fk_Autor_has_Livros_Autor1_idx` (`Autor_idAutor` ASC),
  CONSTRAINT `fk_Autor_has_Livros_Autor1`
    FOREIGN KEY (`Autor_idAutor`)
    REFERENCES `Autor` (`idAutor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Autor_has_Livros_Livros1`
    FOREIGN KEY (`Livros_idLivros`)
    REFERENCES `Livros` (`idLivros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Trimestre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trimestre` (
  `idTrimestre` INT NOT NULL AUTO_INCREMENT,
  `ano` INT NOT NULL,
  `periodo` INT NOT NULL,
  `trimestre` INT NOT NULL,
  PRIMARY KEY (`idTrimestre`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Materia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Materia` (
  `idMateria` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idMateria`, `nome`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Professores_has_Materia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Professores_has_Materia` (
  `Professores_idProfessores` INT NOT NULL,
  `Materia_idMateria` INT NOT NULL,
  PRIMARY KEY (`Professores_idProfessores`, `Materia_idMateria`),
  INDEX `fk_Professores_has_Materia_Materia1_idx` (`Materia_idMateria` ASC),
  INDEX `fk_Professores_has_Materia_Professores1_idx` (`Professores_idProfessores` ASC),
  CONSTRAINT `fk_Professores_has_Materia_Professores1`
    FOREIGN KEY (`Professores_idProfessores`)
    REFERENCES `Professores` (`idProfessores`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Professores_has_Materia_Materia1`
    FOREIGN KEY (`Materia_idMateria`)
    REFERENCES `Materia` (`idMateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Faltas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Faltas` (
  `idFaltas` INT NOT NULL,
  `quantidade` INT NOT NULL,
  `Trimestre_idTrimestre` INT NOT NULL,
  `Professores_has_Materia_Professores_idProfessores` INT NOT NULL,
  `Professores_has_Materia_Materia_idMateria` INT NOT NULL,
  PRIMARY KEY (`idFaltas`),
  INDEX `fk_Faltas_Trimestre1_idx` (`Trimestre_idTrimestre` ASC),
  INDEX `fk_Faltas_Professores_has_Materia1_idx` (`Professores_has_Materia_Professores_idProfessores` ASC, `Professores_has_Materia_Materia_idMateria` ASC),
  CONSTRAINT `fk_Faltas_Trimestre1`
    FOREIGN KEY (`Trimestre_idTrimestre`)
    REFERENCES `Trimestre` (`idTrimestre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Faltas_Professores_has_Materia1`
    FOREIGN KEY (`Professores_has_Materia_Professores_idProfessores` , `Professores_has_Materia_Materia_idMateria`)
    REFERENCES `Professores_has_Materia` (`Professores_idProfessores` , `Materia_idMateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Alunos_has_Faltas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Alunos_has_Faltas` (
  `Alunos_idAlunos` INT NOT NULL,
  `Faltas_idFaltas` INT NOT NULL,
  PRIMARY KEY (`Alunos_idAlunos`, `Faltas_idFaltas`),
  INDEX `fk_Alunos_has_Faltas_Faltas1_idx` (`Faltas_idFaltas` ASC),
  INDEX `fk_Alunos_has_Faltas_Alunos1_idx` (`Alunos_idAlunos` ASC),
  CONSTRAINT `fk_Alunos_has_Faltas_Alunos1`
    FOREIGN KEY (`Alunos_idAlunos`)
    REFERENCES `Alunos` (`idAlunos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Alunos_has_Faltas_Faltas1`
    FOREIGN KEY (`Faltas_idFaltas`)
    REFERENCES `Faltas` (`idFaltas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Avaliacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Avaliacao` (
  `idAvaliacao` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `peso` FLOAT NOT NULL,
  `tipo` VARCHAR(20) NULL,
  `Professores_has_Materia_Professores_idProfessores` INT NOT NULL,
  `Professores_has_Materia_Materia_idMateria` INT NOT NULL,
  `Trimestre_idTrimestre` INT NOT NULL,
  PRIMARY KEY (`idAvaliacao`),
  INDEX `fk_Avaliacao_Professores_has_Materia1_idx` (`Professores_has_Materia_Professores_idProfessores` ASC, `Professores_has_Materia_Materia_idMateria` ASC),
  INDEX `fk_Avaliacao_Trimestre1_idx` (`Trimestre_idTrimestre` ASC),
  CONSTRAINT `fk_Avaliacao_Professores_has_Materia1`
    FOREIGN KEY (`Professores_has_Materia_Professores_idProfessores` , `Professores_has_Materia_Materia_idMateria`)
    REFERENCES `Professores_has_Materia` (`Professores_idProfessores` , `Materia_idMateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Avaliacao_Trimestre1`
    FOREIGN KEY (`Trimestre_idTrimestre`)
    REFERENCES `Trimestre` (`idTrimestre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Notas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Notas` (
  `idNotas` INT NOT NULL AUTO_INCREMENT,
  `nota` FLOAT NOT NULL,
  `Alunos_idAlunos` INT NOT NULL,
  `Avaliacao_idAvaliacao` INT NOT NULL,
  PRIMARY KEY (`idNotas`),
  INDEX `fk_Notas_Alunos1_idx` (`Alunos_idAlunos` ASC),
  INDEX `fk_Notas_Avaliacao1_idx` (`Avaliacao_idAvaliacao` ASC),
  CONSTRAINT `fk_Notas_Alunos1`
    FOREIGN KEY (`Alunos_idAlunos`)
    REFERENCES `Alunos` (`idAlunos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Notas_Avaliacao1`
    FOREIGN KEY (`Avaliacao_idAvaliacao`)
    REFERENCES `Avaliacao` (`idAvaliacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Reserva_has_Exemplar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Reserva_has_Exemplar` (
  `Reserva_idReserva` INT NOT NULL,
  `Exemplar_CodExemplar` INT NOT NULL,
  PRIMARY KEY (`Reserva_idReserva`, `Exemplar_CodExemplar`),
  INDEX `fk_Reserva_has_Exemplar_Exemplar1_idx` (`Exemplar_CodExemplar` ASC),
  INDEX `fk_Reserva_has_Exemplar_Reserva1_idx` (`Reserva_idReserva` ASC),
  CONSTRAINT `fk_Reserva_has_Exemplar_Reserva1`
    FOREIGN KEY (`Reserva_idReserva`)
    REFERENCES `Reserva` (`idReserva`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reserva_has_Exemplar_Exemplar1`
    FOREIGN KEY (`Exemplar_CodExemplar`)
    REFERENCES `Exemplar` (`CodExemplar`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ListaEspera`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ListaEspera` (
  `idListaEspera` INT NOT NULL AUTO_INCREMENT,
  `Alunos_idAlunos` INT NOT NULL,
  `Turma_idTurma` INT NOT NULL,
  PRIMARY KEY (`idListaEspera`),
  INDEX `fk_ListaEspera_Alunos1_idx` (`Alunos_idAlunos` ASC),
  INDEX `fk_ListaEspera_Turma1_idx` (`Turma_idTurma` ASC),
  CONSTRAINT `fk_ListaEspera_Alunos1`
    FOREIGN KEY (`Alunos_idAlunos`)
    REFERENCES `Alunos` (`idAlunos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ListaEspera_Turma1`
    FOREIGN KEY (`Turma_idTurma`)
    REFERENCES `Turma` (`idTurma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Retirada_has_Exemplar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Retirada_has_Exemplar` (
  `Retirada_idRetirada` INT NOT NULL,
  `Exemplar_CodExemplar` INT NOT NULL,
  PRIMARY KEY (`Retirada_idRetirada`, `Exemplar_CodExemplar`),
  INDEX `fk_Retirada_has_Exemplar_Exemplar1_idx` (`Exemplar_CodExemplar` ASC),
  INDEX `fk_Retirada_has_Exemplar_Retirada1_idx` (`Retirada_idRetirada` ASC),
  CONSTRAINT `fk_Retirada_has_Exemplar_Retirada1`
    FOREIGN KEY (`Retirada_idRetirada`)
    REFERENCES `Retirada` (`idRetirada`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Retirada_has_Exemplar_Exemplar1`
    FOREIGN KEY (`Exemplar_CodExemplar`)
    REFERENCES `Exemplar` (`CodExemplar`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
