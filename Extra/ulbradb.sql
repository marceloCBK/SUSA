-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2014 at 04:22 AM
-- Server version: 5.5.23
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ulbradb`
--
CREATE DATABASE IF NOT EXISTS `ulbradb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ulbradb`;

-- --------------------------------------------------------

--
-- Table structure for table `arquivos_arq`
--

CREATE TABLE IF NOT EXISTS `arquivos_arq` (
  `id_arq` int(11) NOT NULL AUTO_INCREMENT,
  `nome_arq` varchar(510) DEFAULT NULL,
  `estensao_arq` varchar(64) DEFAULT NULL,
  `id_fk_arq` int(11) DEFAULT NULL,
  `id_ars_arq` int(11) DEFAULT NULL,
  `caminho_arq` varchar(255) DEFAULT NULL,
  `extra1_arq` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_arq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `arquivos_arq`
--

INSERT INTO `arquivos_arq` (`id_arq`, `nome_arq`, `estensao_arq`, `id_fk_arq`, `id_ars_arq`, `caminho_arq`, `extra1_arq`) VALUES
(1, 'tituloDeTrabalho0.rar', NULL, 119, 2, '/uploads/2/119', NULL),
(2, 'tituloDeTrabalho1.rar', NULL, 119, 2, '/uploads/2/119', NULL),
(3, 'tituloDeTrabalho2.rar', NULL, 119, 2, '/uploads/2/119', NULL),
(4, 'tituloDeTrabalho.rar', NULL, 118, 2, '/uploads/2/118', NULL),
(5, 'tituloDeTrabalho1.rar', NULL, 118, 2, '/uploads/2/118', NULL),
(6, 'tituloDeTrabalho2.rar', NULL, 118, 2, '/uploads/2/118', NULL),
(7, 'oiComoVaiVc0.rar', NULL, 143, 2, '/uploads/2/143', NULL),
(8, 'esseEDoBom.rar', NULL, 120, 2, '/uploads/2/120', NULL),
(9, 'esseEDoBom.rar', NULL, 3, 2, '/uploads/2/3', NULL),
(10, 'esseEDoBom1.rar', NULL, 3, 2, '/uploads/2/3', NULL),
(11, 'esseEDoBom2.rar', NULL, 3, 2, '/uploads/2/3', NULL),
(12, 'tituloDeTrabalho.rar', NULL, 146, 2, '/uploads/2/146', NULL),
(13, 'tituloDeTrabalho1.rar', NULL, 146, 2, '/uploads/2/146', NULL),
(14, 'tituloDeTrabalho2.rar', NULL, 146, 2, '/uploads/2/146', NULL),
(15, 'esseEDoBom0.rar', NULL, 147, 2, '/uploads/2/147', NULL),
(16, 'tituloDeTrabalho3.png', NULL, 146, 2, '/uploads/2/146', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categorias_cat`
--

CREATE TABLE IF NOT EXISTS `categorias_cat` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `id_ars_cat` int(11) DEFAULT NULL,
  `nome_cat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categorias_cat`
--

INSERT INTO `categorias_cat` (`id_cat`, `id_ars_cat`, `nome_cat`) VALUES
(1, 2, 'Sistemas de Informação'),
(2, 2, 'Biologia'),
(3, 2, 'Fisioterapia');

-- --------------------------------------------------------

--
-- Table structure for table `conteudos_con`
--

CREATE TABLE IF NOT EXISTS `conteudos_con` (
  `id_con` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat_con` int(11) DEFAULT NULL,
  `id_usr_con` int(11) DEFAULT NULL,
  `titulo_con` varchar(255) DEFAULT NULL,
  `descricao_con` varchar(510) DEFAULT NULL,
  `status_con` tinyint(1) NOT NULL DEFAULT '1',
  `last_date_con` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_date_con` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_con`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=147 ;

--
-- Dumping data for table `conteudos_con`
--

INSERT INTO `conteudos_con` (`id_con`, `id_cat_con`, `id_usr_con`, `titulo_con`, `descricao_con`, `status_con`, `last_date_con`, `first_date_con`) VALUES
(1, NULL, NULL, 'Titulo de trabalho OK', 'Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho Titulo de trabalho ', 1, '2014-05-26 02:18:36', '2014-05-26 01:13:48'),
(2, NULL, NULL, 'Titulo de outro trabalho', 'Titulo de outro trabalho Titulo de outro trabalho Titulo de outro trabalho Titulo de outro trabalho', 1, '2014-05-26 02:20:03', '2014-05-26 01:14:39'),
(3, NULL, NULL, 'Esse é do Bom!!', 'It''s Good!!It''s Good!!It''s Good!!It''s Good!!', 1, '2014-05-26 02:27:11', '2014-05-26 01:16:41'),
(119, NULL, NULL, 'Titulo de trabalho', '', 1, '2014-06-01 00:01:12', '2014-06-01 00:01:12'),
(120, NULL, NULL, 'Esse é do Bom!!', '', 1, '2014-06-01 00:25:52', '2014-06-01 00:25:52'),
(145, NULL, NULL, 'Titulo de trabalho', '', 1, '2014-06-01 02:12:59', '2014-06-01 02:12:59'),
(146, NULL, NULL, 'Titulo de trabalho', 'qweqwe', 1, '2014-06-03 01:31:34', '2014-06-01 16:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `conteudos_usuarios_cus`
--

CREATE TABLE IF NOT EXISTS `conteudos_usuarios_cus` (
  `id_cus` int(11) NOT NULL AUTO_INCREMENT,
  `id_usr_cus` int(11) DEFAULT NULL,
  `id_con_cus` int(11) DEFAULT NULL,
  `nome_cus` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_cus`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `conteudos_usuarios_cus`
--

INSERT INTO `conteudos_usuarios_cus` (`id_cus`, `id_usr_cus`, `id_con_cus`, `nome_cus`) VALUES
(1, NULL, 10, 'Marcelo'),
(2, NULL, 10, 'Alisson'),
(80, NULL, 119, ''),
(81, NULL, 120, ''),
(104, NULL, 145, 'The Alis'),
(106, NULL, 145, 'Alisson'),
(107, NULL, 145, ''),
(108, NULL, 3, ''),
(110, NULL, 146, '');

-- --------------------------------------------------------

--
-- Table structure for table `cursos_cur`
--

CREATE TABLE IF NOT EXISTS `cursos_cur` (
  `id_cur` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cur` varchar(255) DEFAULT NULL,
  `descricao_cur` varchar(1024) DEFAULT NULL,
  `status_cur` tinyint(1) DEFAULT '1',
  `last_date_cur` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_date_cur` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cursos_cur`
--

INSERT INTO `cursos_cur` (`id_cur`, `nome_cur`, `descricao_cur`, `status_cur`, `last_date_cur`, `first_date_cur`) VALUES
(3, 'Sistemas de Informação ', 'Sistemas de Informação Sistemas de Informação Sistemas de Informação Sistemas de Informação Sistemas de Informação Sistemas de Informação Sistemas de Informação Sistemas de Informação Sistemas de Informação Sistemas de Informação Sistemas de Informação Sistemas de Informação ', 1, '2014-06-16 04:15:31', '2014-06-16 04:15:31'),
(4, 'Fisioterapia', 'Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia Fisioterapia ', 1, '2014-06-16 04:17:55', '2014-06-16 04:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `eventos_evt`
--

CREATE TABLE IF NOT EXISTS `eventos_evt` (
  `id_evt` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat_evt` int(11) DEFAULT NULL,
  `nome_evt` varchar(255) DEFAULT NULL,
  `descricao_evt` varchar(510) DEFAULT NULL,
  `status_evt` tinyint(4) DEFAULT '1',
  `data_ini_evt` timestamp NULL DEFAULT NULL,
  `data_fim_evt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_evt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `eventos_evt`
--

INSERT INTO `eventos_evt` (`id_evt`, `id_cat_evt`, `nome_evt`, `descricao_evt`, `status_evt`, `data_ini_evt`, `data_fim_evt`) VALUES
(1, NULL, 'Amostra de Software', 'Amostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de Software', 1, '2014-03-06 04:00:00', '2014-03-06 04:00:00'),
(2, NULL, 'Amostra de Software', 'Amostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de Software', 0, '2014-03-06 04:00:00', '2014-03-06 04:00:00'),
(4, NULL, 'Amostra de Software 2', 'Amostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de Software 3', 1, '2014-03-04 04:00:00', '2014-03-08 04:00:00'),
(5, NULL, 'Amostra de Software', 'Amostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de SoftwareAmostra de Software', 1, '2014-03-06 04:00:00', '2014-04-16 04:00:00'),
(6, NULL, 'Ulbra Interação Total', 'Ulbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação Total', 0, '2014-03-06 04:00:00', '2014-03-06 04:00:00'),
(7, NULL, 'Ulbra Interação Total', 'Ulbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação Total', 1, '2014-03-06 04:00:00', '2014-09-07 04:00:00'),
(8, NULL, 'Ulbra Interação Total', 'Ulbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação Total', 1, '2014-06-03 04:00:00', '2014-07-22 04:00:00'),
(9, NULL, 'Ulbra Interação Total', 'Ulbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação Total', 1, '2014-06-30 04:00:00', '2014-07-18 04:00:00'),
(10, NULL, 'Ulbra Interação Total', 'Ulbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação TotalUlbra Interação Total', 0, '2014-06-02 04:00:00', '2014-07-09 04:00:00'),
(11, NULL, 'Ulbra Interação Total', 'Ulbra Interação TotalUlbra Interação Total', 1, '2014-06-02 04:00:00', '2014-07-09 04:00:00'),
(12, NULL, 'Semana Acadêmica', 'Semana AcadêmicaSemana AcadêmicaSemana AcadêmicaSemana Acadêmica', 1, '2014-06-03 04:00:00', '2014-06-11 04:00:00'),
(13, NULL, 'Semana Acadêmica', 'Semana AcadêmicaSemana AcadêmicaSemana AcadêmicaSemana Acadêmica', 1, '2014-06-03 04:00:00', '2014-06-11 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `susa_areas_ars`
--

CREATE TABLE IF NOT EXISTS `susa_areas_ars` (
  `is_ars` int(11) NOT NULL AUTO_INCREMENT,
  `nome_ars` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`is_ars`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `susa_areas_ars`
--

INSERT INTO `susa_areas_ars` (`is_ars`, `nome_ars`) VALUES
(1, 'Usuários'),
(2, 'Submissões'),
(3, 'Eventos');

-- --------------------------------------------------------

--
-- Table structure for table `susa_areas_permisoes_arp`
--

CREATE TABLE IF NOT EXISTS `susa_areas_permisoes_arp` (
  `id_arp` int(11) NOT NULL,
  `id_ars_arp` int(11) NOT NULL,
  `id_per_arp` int(11) NOT NULL,
  `nivel_arp` varchar(4) NOT NULL,
  PRIMARY KEY (`id_arp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `susa_modulos_grupo_mog`
--

CREATE TABLE IF NOT EXISTS `susa_modulos_grupo_mog` (
  `id_mog` int(11) NOT NULL AUTO_INCREMENT,
  `nome_mog` varchar(255) DEFAULT NULL,
  `status_mog` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_mog`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `susa_modulos_grupo_mog`
--

INSERT INTO `susa_modulos_grupo_mog` (`id_mog`, `nome_mog`, `status_mog`) VALUES
(1, 'Usuários', 1),
(2, 'Submisões', 1),
(3, 'Eventos', 1);

-- --------------------------------------------------------

--
-- Table structure for table `susa_modulos_mod`
--

CREATE TABLE IF NOT EXISTS `susa_modulos_mod` (
  `id_mod` int(11) NOT NULL AUTO_INCREMENT,
  `nome_mod` varchar(255) NOT NULL,
  `id_fk_mod` int(11) DEFAULT NULL,
  `id_mog_mod` int(11) NOT NULL,
  `id_ars_mod` int(11) NOT NULL,
  `status_mod` tinyint(1) NOT NULL,
  `status_menu_mod` tinyint(1) NOT NULL,
  `rota_mod` varchar(255) NOT NULL,
  `icone_mod` varchar(255) NOT NULL,
  PRIMARY KEY (`id_mod`),
  KEY `id_mod` (`id_mod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `susa_modulos_mod`
--

INSERT INTO `susa_modulos_mod` (`id_mod`, `nome_mod`, `id_fk_mod`, `id_mog_mod`, `id_ars_mod`, `status_mod`, `status_menu_mod`, `rota_mod`, `icone_mod`) VALUES
(1, 'Usuários', NULL, 1, 1, 1, 1, '/usuarios', 'fa-users'),
(2, 'Submisões', NULL, 2, 2, 1, 1, '/submissoes', 'fa-paperclip'),
(3, 'Novo Usuário', 1, 1, 1, 1, 1, '/usuarios/inserir', 'fa-user'),
(4, 'Ver Usuários', 1, 1, 1, 1, 1, '/usuarios', 'fa-users'),
(5, 'Ver Trabalhos', 2, 2, 2, 1, 1, '/submissoes', ''),
(6, 'Nova Submissão', 2, 2, 2, 1, 1, '/submissoes/inserir', ''),
(7, 'Eventos', NULL, 3, 3, 1, 1, '/eventos', ''),
(8, 'Novo Evento', 7, 3, 3, 1, 1, '/eventos/inserir', ''),
(9, 'Ver Eventos', 7, 3, 3, 1, 1, '/eventos', ''),
(10, 'Cursos', NULL, 4, 4, 1, 1, '/cursos', 'fa-book'),
(11, 'Ver Cursos', 10, 4, 4, 1, 1, '/cursos', 'fa-book'),
(12, 'Novo Curso', 10, 4, 4, 1, 1, '/cursos/inserir', 'fa-book');

-- --------------------------------------------------------

--
-- Table structure for table `susa_perfis_per`
--

CREATE TABLE IF NOT EXISTS `susa_perfis_per` (
  `id_per` int(11) NOT NULL,
  `nome_per` varchar(255) NOT NULL,
  PRIMARY KEY (`id_per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `susa_usuarios_usr`
--

CREATE TABLE IF NOT EXISTS `susa_usuarios_usr` (
  `id_usr` int(11) NOT NULL AUTO_INCREMENT,
  `id_per_usr` int(11) DEFAULT NULL,
  `nome_usr` varchar(255) DEFAULT NULL,
  `login_usr` varchar(255) DEFAULT NULL,
  `email_usr` varchar(255) DEFAULT NULL,
  `senha_usr` varchar(255) DEFAULT NULL,
  `ra_usr` varchar(32) DEFAULT NULL,
  `cgu_usr` varchar(32) DEFAULT NULL,
  `status_usr` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `last_date_usr` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_date_usr` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_usr`),
  UNIQUE KEY `email_usr` (`email_usr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `susa_usuarios_usr`
--

INSERT INTO `susa_usuarios_usr` (`id_usr`, `id_per_usr`, `nome_usr`, `login_usr`, `email_usr`, `senha_usr`, `ra_usr`, `cgu_usr`, `status_usr`, `remember_token`, `last_date_usr`, `first_date_usr`) VALUES
(1, NULL, 'Superadmin', NULL, 'marcelo@cbkdigital.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '081002840-9', '75209610', 1, NULL, '2014-06-02 23:31:34', '2014-06-01 22:18:27'),
(3, NULL, 'Superadmin', NULL, 'marcelo1@cbkdigital.com.br', '123', '081002840-9', '75209610', 1, NULL, '2014-06-01 22:24:55', '2014-06-01 22:24:55');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
