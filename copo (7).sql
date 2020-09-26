-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2020 at 12:12 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `copo`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `prospect_id` int(11) NOT NULL,
  `client_active` tinyint(1) NOT NULL DEFAULT 1,
  `client_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `c_persons`
--

CREATE TABLE `c_persons` (
  `person_id` varchar(40) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `person_name` varchar(20) NOT NULL,
  `person_lastname_paterno` varchar(30) NOT NULL,
  `person_lastname_materno` varchar(30) NOT NULL,
  `person_mail` varchar(100) NOT NULL,
  `person_phone` varchar(30) DEFAULT NULL,
  `person_birthday` datetime DEFAULT NULL,
  `person_smoker` tinyint(1) DEFAULT NULL,
  `person_ocupation` varchar(50) DEFAULT NULL,
  `person_civil_state` varchar(10) DEFAULT NULL,
  `person_spouse` varchar(30) DEFAULT '0',
  `person_sons` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `person_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `person_asma` tinyint(1) DEFAULT NULL,
  `person_motociclismo` tinyint(1) DEFAULT NULL,
  `person_diabetes` tinyint(1) DEFAULT NULL,
  `person_hipertencion` tinyint(1) DEFAULT NULL,
  `person_tiroides` tinyint(1) DEFAULT NULL,
  `person_investment` varchar(40) DEFAULT NULL,
  `person_references` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`person_references`)),
  `person_deleted` tinyint(1) DEFAULT NULL,
  `person_recomended_by` varchar(30) DEFAULT NULL,
  `person_data` longtext DEFAULT NULL,
  `person_history` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`person_history`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `c_persons`
--

INSERT INTO `c_persons` (`person_id`, `user_id`, `person_name`, `person_lastname_paterno`, `person_lastname_materno`, `person_mail`, `person_phone`, `person_birthday`, `person_smoker`, `person_ocupation`, `person_civil_state`, `person_spouse`, `person_sons`, `person_type`, `person_asma`, `person_motociclismo`, `person_diabetes`, `person_hipertencion`, `person_tiroides`, `person_investment`, `person_references`, `person_deleted`, `person_recomended_by`, `person_data`, `person_history`) VALUES
('5f432bd9ab2b1', 0, 'Eduardo', 'Peralta', 'Popoca', 'aeadsa@sdaas.com', '876567653', '1966-01-04 04:51:58', 0, 'Ingeniero', '1', '5f432bd9ab2b5', '[\"5f432bd9ab2b7\",\"5f432bd9abea2\"]', 'PROSPECTO', 0, 0, 0, 0, 0, 'mensual', '[\"5f432bd9ac942\",\"5f432bd9ace12\",\"5f432bd9ad32c\",\"5f432bd9ad7ba\"]', 0, NULL, '{\"name\":\"Eduardo\",\"lastname_materno\":\"Popoca\",\"lastname_paterno\":\"Peralta\",\"mail\":\"aeadsa@sdaas.com\",\"phone\":\"876567653\",\"birthday\":\"1966-01-04T03:51:58.155Z\",\"smoker\":false,\"ocupation\":\"Ingeniero\",\"civil_state\":true,\"spouse\":{\"name\":\"Carolina\",\"lastname_materno\":\"Romero\",\"lastname_paterno\":\"Fernandez\",\"mail\":\"sada@sdasd\",\"phone\":\"5554645645\",\"birthday\":\"\"},\"is_father\":true,\"sons\":[{\"name\":\"Frank\",\"lastname_materno\":\"Gomez\",\"lastname_paterno\":\"Serdan\",\"mail\":\"sdasd@asda.com\",\"phone\":\"4353535\",\"$$hashKey\":\"object:84\"},{\"name\":\"Frank\",\"lastname_materno\":\"Gomez\",\"lastname_paterno\":\"Serdan\",\"mail\":\"sdasd@asda.com\",\"phone\":\"4353535\",\"$$hashKey\":\"object:86\"}],\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false,\"investment\":\"mensual\",\"references\":[{\"name\":\"Edgardo\",\"lastname_materno\":\"asdasda\",\"lastname_paterno\":\"asdasda\",\"mail\":\"Refe@asda.com\",\"phone\":\"655645645\",\"$$hashKey\":\"object:88\"},{\"name\":\"Edgardo\",\"lastname_materno\":\"asdasda\",\"lastname_paterno\":\"asdasda\",\"mail\":\"Refe@asda.com\",\"phone\":\"655645645\",\"$$hashKey\":\"object:90\"},{\"name\":\"Edgardo\",\"lastname_materno\":\"asdasda\",\"lastname_paterno\":\"asdasda\",\"mail\":\"Refe@asda.com\",\"phone\":\"655645645\",\"$$hashKey\":\"object:92\"},{\"name\":\"Edgardo\",\"lastname_materno\":\"asdasda\",\"lastname_paterno\":\"asdasda\",\"mail\":\"Refe@asda.com\",\"phone\":\"655645645\",\"$$hashKey\":\"object:94\"}]}', NULL),
('5f432bd9ab2b5', 0, 'Carolina', 'Fernandez', 'Romero', 'sada@sdasd', '5554645645', NULL, NULL, NULL, '1', '5f432bd9ab2b1', NULL, 'CONYUGE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f432bd9ab2b1', NULL, NULL),
('5f432bd9ab2b7', 0, 'Frank', 'Serdan', 'Gomez', 'sdasd@asda.com', '4353535', NULL, NULL, NULL, NULL, '0', NULL, 'HIJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f432bd9ab2b1', NULL, NULL),
('5f432bd9ab2f9', 0, 'Eduardo', 'Peralta', 'Popoca', 'aeadsa@sdaas.com', '876567653', '1966-01-04 04:51:58', 0, 'Ingeniero', '1', '5f432bd9ab2b5', '[\"5f432bd9ab2b7\",\"5f432bd9abea2\"]', 'PROSPECTO', 0, 0, 0, 0, 0, 'mensual', '[\"5f432bd9ac942\",\"5f432bd9ace12\",\"5f432bd9ad32c\",\"5f432bd9ad7ba\"]', 0, NULL, '{\"name\":\"Eduardo\",\"lastname_materno\":\"Popoca\",\"lastname_paterno\":\"Peralta\",\"mail\":\"aeadsa@sdaas.com\",\"phone\":\"876567653\",\"birthday\":\"1966-01-04T03:51:58.155Z\",\"smoker\":false,\"ocupation\":\"Ingeniero\",\"civil_state\":true,\"spouse\":{\"name\":\"Carolina\",\"lastname_materno\":\"Romero\",\"lastname_paterno\":\"Fernandez\",\"mail\":\"sada@sdasd\",\"phone\":\"5554645645\",\"birthday\":\"\"},\"is_father\":true,\"sons\":[{\"name\":\"Frank\",\"lastname_materno\":\"Gomez\",\"lastname_paterno\":\"Serdan\",\"mail\":\"sdasd@asda.com\",\"phone\":\"4353535\",\"$$hashKey\":\"object:84\"},{\"name\":\"Frank\",\"lastname_materno\":\"Gomez\",\"lastname_paterno\":\"Serdan\",\"mail\":\"sdasd@asda.com\",\"phone\":\"4353535\",\"$$hashKey\":\"object:86\"}],\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false,\"investment\":\"mensual\",\"references\":[{\"name\":\"Edgardo\",\"lastname_materno\":\"asdasda\",\"lastname_paterno\":\"asdasda\",\"mail\":\"Refe@asda.com\",\"phone\":\"655645645\",\"$$hashKey\":\"object:88\"},{\"name\":\"Edgardo\",\"lastname_materno\":\"asdasda\",\"lastname_paterno\":\"asdasda\",\"mail\":\"Refe@asda.com\",\"phone\":\"655645645\",\"$$hashKey\":\"object:90\"},{\"name\":\"Edgardo\",\"lastname_materno\":\"asdasda\",\"lastname_paterno\":\"asdasda\",\"mail\":\"Refe@asda.com\",\"phone\":\"655645645\",\"$$hashKey\":\"object:92\"},{\"name\":\"Edgardo\",\"lastname_materno\":\"asdasda\",\"lastname_paterno\":\"asdasda\",\"mail\":\"Refe@asda.com\",\"phone\":\"655645645\",\"$$hashKey\":\"object:94\"}]}', NULL),
('5f432bd9abea2', 0, 'Frank', 'Serdan', 'Gomez', 'sdasd@asda.com', '4353535', NULL, NULL, NULL, NULL, '0', NULL, 'HIJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f432bd9ab2b1', NULL, NULL),
('5f432bd9ac942', 0, 'Edgardo', 'asdasda', 'asdasda', 'Refe@asda.com', '655645645', NULL, NULL, NULL, NULL, '0', NULL, 'REFERENCIA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f432bd9ab2b1', NULL, NULL),
('5f432bd9ace12', 0, 'Edgardo', 'asdasda', 'asdasda', 'Refe@asda.com', '655645645', NULL, NULL, NULL, NULL, '0', NULL, 'REFERENCIA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f432bd9ab2b1', NULL, NULL),
('5f432bd9ad32c', 0, 'Edgardo', 'asdasda', 'asdasda', 'Refe@asda.com', '655645645', NULL, NULL, NULL, NULL, '0', NULL, 'REFERENCIA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f432bd9ab2b1', NULL, NULL),
('5f432bd9ad7ba', 0, 'Edgardo', 'asdasda', 'asdasda', 'Refe@asda.com', '655645645', NULL, NULL, NULL, NULL, '0', NULL, 'REFERENCIA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f432bd9ab2b1', NULL, NULL),
('5f432c1ac7099', 0, 'werw', 'sdas', '', '', '', '2020-08-24 04:55:07', 0, '', '0', '0', '[]', 'PROSPECTO', 0, 0, 0, 0, 0, '', '[]', 0, NULL, '{\"name\":\"werw\",\"lastname_materno\":\"\",\"lastname_paterno\":\"sdas\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"2020-08-24T02:55:07.714Z\",\"smoker\":false,\"ocupation\":\"\",\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"is_father\":false,\"sons\":[],\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false,\"investment\":\"\",\"references\":[]}', NULL),
('5f4344d52b2e3', 0, 'Julio', 'Mendoza', 'García', 'mg@asdas.com', '5675467567', '1983-04-15 07:33:53', 0, 'Maestro', '1', '5f4344d52b2e9', '[\"5f4344d52b2ed\",\"5f4344d52d977\",\"5f4344d52e6e8\"]', 'PROSPECTO', 0, 1, 1, 0, 1, 'anual', '[\"5f4344d52fd5b\",\"5f4344d530831\",\"5f4344d531308\"]', 0, NULL, '{\"name\":\"Julio\",\"lastname_materno\":\"García\",\"lastname_paterno\":\"Mendoza\",\"mail\":\"mg@asdas.com\",\"phone\":\"5675467567\",\"birthday\":\"1983-04-15T05:33:53.597Z\",\"smoker\":false,\"ocupation\":\"Maestro\",\"civil_state\":true,\"spouse\":{\"name\":\"Elena\",\"lastname_materno\":\"Quesada\",\"lastname_paterno\":\"Flores\",\"mail\":\"asasdasda@asda.com\",\"phone\":\"565754756\",\"birthday\":\"\"},\"is_father\":true,\"sons\":[{\"name\":\"Earth\",\"lastname_materno\":\"Wind\",\"lastname_paterno\":\"Fire\",\"mail\":\"ew&f@adasd.com\",\"phone\":\"345674356\",\"$$hashKey\":\"object:75\"},{\"name\":\"Earth\",\"lastname_materno\":\"Wind\",\"lastname_paterno\":\"Fire\",\"mail\":\"ew&f@adasd.com\",\"phone\":\"345674356\",\"$$hashKey\":\"object:77\"},{\"name\":\"Earth\",\"lastname_materno\":\"Wind\",\"lastname_paterno\":\"Fire\",\"mail\":\"ew&f@adasd.com\",\"phone\":\"345674356\",\"$$hashKey\":\"object:79\"}],\"asma\":false,\"motociclismo\":true,\"diabetes\":true,\"hipertencion\":false,\"tiroides\":true,\"investment\":\"anual\",\"references\":[{\"name\":\"Alan\",\"lastname_materno\":\"Parsons\",\"lastname_paterno\":\"Parsons\",\"mail\":\"APP@asea.com\",\"phone\":\"2345643\",\"$$hashKey\":\"object:81\"},{\"name\":\"Alan\",\"lastname_materno\":\"Parsons\",\"lastname_paterno\":\"Parsons\",\"mail\":\"APP@asea.com\",\"phone\":\"2345643\",\"$$hashKey\":\"object:83\"},{\"name\":\"Alan\",\"lastname_materno\":\"Parsons\",\"lastname_paterno\":\"Parsons\",\"mail\":\"APP@asea.com\",\"phone\":\"2345643\",\"$$hashKey\":\"object:85\"}]}', NULL),
('5f4344d52b2e9', 0, 'Elena', 'Flores', 'Quesada', 'asasdasda@asda.com', '565754756', NULL, NULL, NULL, '1', '5f4344d52b2e3', NULL, 'CONYUGE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f4344d52b2e3', NULL, NULL),
('5f4344d52b2ed', 0, 'Earth', 'Fire', 'Wind', 'ew&f@adasd.com', '345674356', NULL, NULL, NULL, NULL, '0', NULL, 'HIJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f4344d52b2e3', NULL, NULL),
('5f4344d52d977', 0, 'Earth', 'Fire', 'Wind', 'ew&f@adasd.com', '345674356', NULL, NULL, NULL, NULL, '0', NULL, 'HIJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f4344d52b2e3', NULL, NULL),
('5f4344d52e6e8', 0, 'Earth', 'Fire', 'Wind', 'ew&f@adasd.com', '345674356', NULL, NULL, NULL, NULL, '0', NULL, 'HIJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f4344d52b2e3', NULL, NULL),
('5f4344d52fd5b', 0, 'Alan', 'Parsons', 'Parsons', 'APP@asea.com', '2345643', NULL, NULL, NULL, NULL, '0', NULL, 'REFERENCIA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f4344d52b2e3', NULL, NULL),
('5f4344d530831', 0, 'Alan', 'Parsons', 'Parsons', 'APP@asea.com', '2345643', NULL, NULL, NULL, NULL, '0', NULL, 'REFERENCIA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f4344d52b2e3', NULL, NULL),
('5f4344d531308', 0, 'Alan', 'Parsons', 'Parsons', 'APP@asea.com', '2345643', NULL, NULL, NULL, NULL, '0', NULL, 'REFERENCIA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '5f4344d52b2e3', NULL, NULL),
('5f51abbc6d4dc', 0, 'aadsfasd', 'bhnjkmk', 'bhjnkml,', '', 'hjnkmkl,b', '2020-09-04 04:51:15', 0, 'hbjnkmkl,', '0', '0', '[]', 'PROSPECTO', 0, 0, 0, 0, 0, 'anual', '[]', NULL, NULL, '{\"name\":\"aadsfasd\",\"lastname_materno\":\"bhjnkml,\",\"lastname_paterno\":\"bhnjkmk\",\"phone\":\"hjnkmkl,b\",\"investment\":\"anual\",\"birthday\":\"2020-09-04T02:51:15.142Z\",\"ocupation\":\"hbjnkmkl,\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"health_data\":{\"smoker\":false,\"asma\":true,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":true},\"sons\":[],\"references\":[]}', NULL),
('5f51abd754c51', 0, 'hola', 'asdsfddaf', 'sdsfd', '', '', '2020-09-04 04:51:58', 0, '', '0', '0', '[]', 'PROSPECTO', 0, 0, 0, 0, 0, '', '[]', NULL, NULL, '{\"name\":\"hola\",\"lastname_materno\":\"sdsfd\",\"lastname_paterno\":\"asdsfddaf\",\"mail\":\"\",\"phone\":\"\",\"investment\":\"\",\"birthday\":\"2020-09-04T02:51:58.933Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[]}', NULL),
('5f51abee50027', 0, 'asdasd', '', '', '', '', '2020-09-04 04:52:22', 0, '', '0', '0', '[]', 'PROSPECTO', 0, 0, 0, 0, 0, '', '[]', NULL, NULL, '{\"name\":\"asdasd\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"investment\":\"\",\"birthday\":\"2020-09-04T02:52:22.839Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[]}', NULL),
('5f51ac628dea0', 0, 'Hola', 'Mundo', '', '', '', '2020-09-04 04:54:15', 0, '', '0', '0', '[]', 'PROSPECTO', 0, 0, 0, 0, 0, '', '[]', NULL, NULL, '{\"name\":\"Hola\",\"lastname_materno\":\"\",\"lastname_paterno\":\"Mundo\",\"mail\":\"\",\"phone\":\"\",\"investment\":\"\",\"birthday\":\"2020-09-04T02:54:15.586Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[]}', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `c_persons_beta`
--

CREATE TABLE `c_persons_beta` (
  `person_id` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `person_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`person_data`)),
  `person_history` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`person_history`)),
  `person_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `c_persons_beta`
--

INSERT INTO `c_persons_beta` (`person_id`, `user_id`, `person_data`, `person_history`, `person_deleted`) VALUES
('5f597ea6af2a9', 1, '{\"name\":\"Octavio\",\"lastname_materno\":\"Romero\",\"lastname_paterno\":\"Peralta\",\"mail\":\"oc@gmail.com\",\"phone\":\"23456435\",\"investment\":\"\",\"birthday\":\"1996-09-10T01:03:43.415Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f597ea6af2a9\",\"referenced_by\":\"5f597ea6af2a2\"}', '[{\"activity\":\"created\",\"date\":\"2020-09-10 03:17:26\"}]', 0),
('5f597ea6b6327', 1, '{\"name\":\"Ramiro\",\"lastname_materno\":\"Romero\",\"lastname_paterno\":\"Peralta\",\"mail\":\"asdasd@gmail.com\",\"phone\":\"2345464353\",\"investment\":\"\",\"birthday\":\"2022-03-10T02:09:54.257Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f597ea6b6327\",\"referenced_by\":\"5f597ea6af2a2\"}', '[{\"activity\":\"created\",\"date\":\"2020-09-10 03:17:26\"}]', 0),
('5f597ea6af2a6', 1, '{\"name\":\"Hola\",\"lastname_materno\":\"asdasda\",\"lastname_paterno\":\"Mundo\",\"mail\":\"oc@gmail.com\",\"phone\":\"23456435\",\"investment\":\"\",\"birthday\":\"1996-09-10T01:03:43.415Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f597ea6af2a6\",\"referenced_by\":\"5f597ea6af2a2\"}', '[{\"activity\":\"created\",\"date\":\"2020-09-10 03:17:26\"}]', 0),
('5f597ea6b774f', 1, '{\"name\":\"Estuardo\",\"lastname_materno\":\"Bert\",\"lastname_paterno\":\"ASDas\",\"mail\":\"asdas@gmail.com\",\"phone\":\"456435\",\"investment\":\"\",\"birthday\":\"2020-09-10T01:03:43.415Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f597ea6b774f\",\"referenced_by\":\"5f597ea6af2a2\"}', '[{\"activity\":\"created\",\"date\":\"2020-09-10 03:17:26\"}]', 0),
('5f597ea6af2a2', 1, '{\"name\":\"Ruben\",\"lastname_materno\":\"Popoca\",\"lastname_paterno\":\"Peralta\",\"mail\":\"rb@gmail.com\",\"phone\":\"234554245\",\"investment\":\"anual\",\"birthday\":\"1977-10-20T02:03:43.415Z\",\"ocupation\":\"Dentista\",\"is_father\":true,\"civil_state\":true,\"spouse\":{\"name\":\"Hola\",\"lastname_materno\":\"asdasda\",\"lastname_paterno\":\"Mundo\",\"mail\":\"oc@gmail.com\",\"phone\":\"23456435\",\"investment\":\"\",\"birthday\":\"1996-09-10T01:03:43.415Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f597ea6af2a6\",\"referenced_by\":\"5f597ea6af2a2\"},\"retirement\":false,\"education\":true,\"temporary\":true,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":true,\"motociclismo\":true,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":true},\"notes\":\"Sin comentarios\",\"sons\":[{\"name\":\"Octavio\",\"lastname_materno\":\"Romero\",\"lastname_paterno\":\"Peralta\",\"mail\":\"oc@gmail.com\",\"phone\":\"23456435\",\"investment\":\"\",\"birthday\":\"1996-09-10T01:03:43.415Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f597ea6af2a9\",\"referenced_by\":\"5f597ea6af2a2\"},{\"name\":\"Ramiro\",\"lastname_materno\":\"Romero\",\"lastname_paterno\":\"Peralta\",\"mail\":\"asdasd@gmail.com\",\"phone\":\"2345464353\",\"investment\":\"\",\"birthday\":\"2022-03-10T02:09:54.257Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f597ea6b6327\",\"referenced_by\":\"5f597ea6af2a2\"}],\"references\":[{\"name\":\"Estuardo\",\"lastname_materno\":\"Bert\",\"lastname_paterno\":\"ASDas\",\"mail\":\"asdas@gmail.com\",\"phone\":\"456435\",\"investment\":\"\",\"birthday\":\"2020-09-10T01:03:43.415Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f597ea6b774f\",\"referenced_by\":\"5f597ea6af2a2\"}],\"type\":\"PROSPECTO\",\"referenced_by\":\"\"}', '[{\"activity\":\"created\",\"date\":\"2020-09-10 03:17:26\"}]', 0),
('5f5998134ebd0', 1, '{\"name\":\"Luis\",\"lastname_materno\":\"Flores\",\"lastname_paterno\":\"Perez\",\"mail\":\"asda@gmail.com\",\"phone\":\"12345324\",\"investment\":\"\",\"birthday\":\"2002-02-13T04:01:55.578Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f5998134ebd0\",\"referenced_by\":\"5f5998134ebc0\"}', '[{\"activity\":\"created\",\"date\":\"2020-09-10 05:05:55\"}]', 0),
('5f5998134ebca', 1, '{\"name\":\"Laura\",\"lastname_materno\":\"Hernandez\",\"lastname_paterno\":\"Flores\",\"mail\":\"fla@gmail.com\",\"phone\":\"34564353\",\"investment\":\"\",\"birthday\":\"1981-03-12T04:01:55.578Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f5998134ebca\",\"referenced_by\":\"5f5998134ebc0\"}', '[{\"activity\":\"created\",\"date\":\"2020-09-10 05:05:55\"}]', 0),
('5f599813506cc', 1, '{\"name\":\"Refe\",\"lastname_materno\":\"Mat\",\"lastname_paterno\":\"PAt\",\"mail\":\"adsa@gmail.com\",\"phone\":\"23454\",\"investment\":\"\",\"birthday\":\"2020-09-10T03:01:55.578Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f599813506cc\",\"referenced_by\":\"5f5998134ebc0\"}', '[{\"activity\":\"created\",\"date\":\"2020-09-10 05:05:55\"}]', 0),
('5f5998134ebc0', 1, '{\"name\":\"Ricardo\",\"lastname_materno\":\"Muu00f1oz\",\"lastname_paterno\":\"Perez\",\"mail\":\"asdas@gmail.com\",\"phone\":\"234535\",\"investment\":\"anual\",\"birthday\":\"1988-05-14T04:01:55.578Z\",\"ocupation\":\"Empleado\",\"is_father\":true,\"civil_state\":true,\"spouse\":{\"name\":\"Laura\",\"lastname_materno\":\"Hernandez\",\"lastname_paterno\":\"Flores\",\"mail\":\"fla@gmail.com\",\"phone\":\"34564353\",\"investment\":\"\",\"birthday\":\"1981-03-12T04:01:55.578Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f5998134ebca\",\"referenced_by\":\"5f5998134ebc0\"},\"retirement\":false,\"education\":true,\"temporary\":false,\"orvi\":true,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":true,\"hipertencion\":false,\"tiroides\":false,\"hpertencion\":true},\"notes\":\"Sin comentarios\",\"sons\":[{\"name\":\"Luis\",\"lastname_materno\":\"Flores\",\"lastname_paterno\":\"Perez\",\"mail\":\"asda@gmail.com\",\"phone\":\"12345324\",\"investment\":\"\",\"birthday\":\"2002-02-13T04:01:55.578Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f5998134ebd0\",\"referenced_by\":\"5f5998134ebc0\"}],\"references\":[{\"name\":\"Refe\",\"lastname_materno\":\"Mat\",\"lastname_paterno\":\"PAt\",\"mail\":\"adsa@gmail.com\",\"phone\":\"23454\",\"investment\":\"\",\"birthday\":\"2020-09-10T03:01:55.578Z\",\"ocupation\":\"\",\"is_father\":false,\"civil_state\":false,\"spouse\":{\"name\":\"\",\"lastname_materno\":\"\",\"lastname_paterno\":\"\",\"mail\":\"\",\"phone\":\"\",\"birthday\":\"\"},\"retirement\":false,\"education\":false,\"temporary\":false,\"orvi\":false,\"health_data\":{\"smoker\":false,\"asma\":false,\"motociclismo\":false,\"diabetes\":false,\"hipertencion\":false,\"tiroides\":false},\"sons\":[],\"references\":[],\"type\":\"REFERENCIA\",\"refereced_by\":\"\",\"smoker\":true,\"tiroides\":true,\"person_id\":\"5f599813506cc\",\"referenced_by\":\"5f5998134ebc0\"}],\"type\":\"PROSPECTO\",\"referenced_by\":\"\"}', '[{\"activity\":\"created\",\"date\":\"2020-09-10 05:05:55\"}]', 0);

-- --------------------------------------------------------

--
-- Table structure for table `c_prospects`
--

CREATE TABLE `c_prospects` (
  `prospect_id` int(11) NOT NULL,
  `prospect_name` varchar(100) DEFAULT NULL,
  `prospect_address` text DEFAULT NULL,
  `prospect_phone` varchar(50) DEFAULT NULL,
  `prospect_mail` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `c_prospects`
--

INSERT INTO `c_prospects` (`prospect_id`, `prospect_name`, `prospect_address`, `prospect_phone`, `prospect_mail`) VALUES
(1, 'Edu Peralta', 'sefsfd', 'daedq', 'asdasd@correo.mx'),
(3, 'EL vic', 'asdadsasda', '55555', 'correo@michile.com');

-- --------------------------------------------------------

--
-- Table structure for table `mvc`
--

CREATE TABLE `mvc` (
  `mvc_id` int(11) NOT NULL,
  `mvc_name` varchar(40) DEFAULT NULL,
  `mvc_parent` int(11) DEFAULT NULL,
  `mvc_view` varchar(40) DEFAULT NULL,
  `mvc_class` varchar(40) DEFAULT NULL,
  `mvc_roll` varchar(40) DEFAULT NULL,
  `mvc_icon` varchar(100) DEFAULT NULL,
  `mvc_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mvc`
--

INSERT INTO `mvc` (`mvc_id`, `mvc_name`, `mvc_parent`, `mvc_view`, `mvc_class`, `mvc_roll`, `mvc_icon`, `mvc_order`) VALUES
(1, 'mvc', 0, 'mvcs', 'main', '1', 'icon', 0),
(2, 'Usuarios', 0, 'users', 'main', '2', '', 0),
(3, 'Prospectos', 0, 'prospects', 'main', '3', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_lastname_paterno` varchar(30) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `user_mail` varchar(100) NOT NULL,
  `user_username` varchar(30) NOT NULL,
  `user_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_active` tinyint(1) NOT NULL,
  `user_level` int(11) NOT NULL DEFAULT 2,
  `user_lastname_materno` varchar(50) NOT NULL,
  `user_history` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_lastname_paterno`, `user_password`, `user_mail`, `user_username`, `user_created`, `user_updated`, `user_active`, `user_level`, `user_lastname_materno`, `user_history`) VALUES
(1, 'Edu', 'Peralta', 'password', 'edupepo_28@hotmail.com', 'laloper', '2020-05-24 00:54:18', '2020-05-25 03:09:33', 1, 1, '', '\'[]\''),
(2, 'nuevo1', 'usuario', '12345', 'asas@wewe.com', 'newuser', '2020-05-25 00:35:23', '2020-05-25 23:45:47', 1, 3, '', '\'[]\''),
(3, 'Victor', 'Ramos', 'passw0rd', 'victor.armando@hotmail.com', 'vramos', '2020-05-24 00:54:18', '2020-05-25 23:56:45', 1, 2, '', '\'[]\'');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `c_persons`
--
ALTER TABLE `c_persons`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `c_prospects`
--
ALTER TABLE `c_prospects`
  ADD PRIMARY KEY (`prospect_id`);

--
-- Indexes for table `mvc`
--
ALTER TABLE `mvc`
  ADD PRIMARY KEY (`mvc_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_prospects`
--
ALTER TABLE `c_prospects`
  MODIFY `prospect_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mvc`
--
ALTER TABLE `mvc`
  MODIFY `mvc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
