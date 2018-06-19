-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema u432556926_blog
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema u432556926_blog
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `u432556926_blog` DEFAULT CHARACTER SET utf8 ;
USE `u432556926_blog` ;

-- -----------------------------------------------------
-- Table `u432556926_blog`.`blog_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u432556926_blog`.`blog_usuario` (
  `usuarioid` INT NOT NULL AUTO_INCREMENT,
  `usuariouser` VARCHAR(45) NOT NULL,
  `usuariopass` VARCHAR(150) NOT NULL,
  `usuarionome` VARCHAR(45) NULL,
  PRIMARY KEY (`usuarioid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u432556926_blog`.`blog_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u432556926_blog`.`blog_categoria` (
  `categoriaid` INT NOT NULL AUTO_INCREMENT,
  `categoriatitulo` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`categoriaid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u432556926_blog`.`blog_post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u432556926_blog`.`blog_post` (
  `postid` INT NOT NULL AUTO_INCREMENT,
  `posttitulo` VARCHAR(45) NOT NULL,
  `posttexto` TEXT NULL,
  `postbloqueado` INT(1) NOT NULL DEFAULT 0 COMMENT '1 - bloqueado\n0 - desbloqueado\n',
  `postdata` DATETIME NOT NULL,
  `posturlamigavel` VARCHAR(120) NOT NULL,
  `postcriadoem` DATETIME NOT NULL,
  `blog_categoria_categoriaid` INT NOT NULL,
  `blog_usuario_usuarioid` INT NOT NULL,
  PRIMARY KEY (`postid`),
  INDEX `fk_blog_post_blog_categoria1_idx` (`blog_categoria_categoriaid` ASC),
  INDEX `fk_blog_post_blog_usuario1_idx` (`blog_usuario_usuarioid` ASC),
  CONSTRAINT `fk_blog_post_blog_categoria1`
    FOREIGN KEY (`blog_categoria_categoriaid`)
    REFERENCES `u432556926_blog`.`blog_categoria` (`categoriaid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_blog_post_blog_usuario1`
    FOREIGN KEY (`blog_usuario_usuarioid`)
    REFERENCES `u432556926_blog`.`blog_usuario` (`usuarioid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u432556926_blog`.`blog_imagem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u432556926_blog`.`blog_imagem` (
  `imagemid` INT NOT NULL AUTO_INCREMENT,
  `imagemlegenda` VARCHAR(45) NULL,
  `imagemarquivo` VARCHAR(120) NOT NULL,
  `imagemdestaque` INT(1) NOT NULL DEFAULT 0 COMMENT '0 - não é destaque\n1 - destaque\n',
  `blog_post_postid` INT NOT NULL,
  PRIMARY KEY (`imagemid`),
  INDEX `fk_blog_imagem_blog_post_idx` (`blog_post_postid` ASC),
  CONSTRAINT `fk_blog_imagem_blog_post`
    FOREIGN KEY (`blog_post_postid`)
    REFERENCES `u432556926_blog`.`blog_post` (`postid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
