-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2026 a las 07:46:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `start_week_day` varchar(50) NOT NULL,
  `view_preference` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calendar`
--

INSERT INTO `calendar` (`id`, `start_week_day`, `view_preference`, `Username`) VALUES
(1, 'Sunday', 'Month', 'user'),
(2, 'Monday', 'Day', 'user1'),
(3, 'Monday', 'Week', 'admin'),
(4, 'Sunday', 'Month', 'a'),
(5, 'Tuesday', 'Week', 'po');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lists`
--

INSERT INTO `lists` (`id`, `Username`, `icon`, `notes`, `name`) VALUES
(1, 'default', 'list.png', 'Lista general de tareas', 'General'),
(2, 'default', 'work.png', 'Pendientes relacionados al trabajo', 'Trabajo'),
(3, 'default', 'home.png', 'Tareas del hogar', 'Hogar'),
(4, 'default', 'study.png', 'Estudio y aprendizaje', 'Estudio'),
(5, 'default', 'shopping.png', 'Compras y mandados', 'Compras'),
(6, 'po', 'list.png', 'Lista general de tareas', 'General'),
(7, 'po', 'work.png', 'Pendientes relacionados al trabajo', 'Trabajo'),
(8, 'po', 'home.png', 'Tareas del hogar', 'Hogar'),
(9, 'po', 'study.png', 'Estudio y aprendizaje', 'Estudio'),
(10, 'po', 'shopping.png', 'Compras y mandados', 'Compras'),
(11, 'q', 'list.png', 'Lista general de tareas', 'General'),
(12, 'q', 'work.png', 'Pendientes relacionados al trabajo', 'Trabajo'),
(13, 'q', 'home.png', 'Tareas del hogar', 'Hogar'),
(14, 'q', 'study.png', 'Estudio y aprendizaje', 'Estudio'),
(15, 'q', 'shopping.png', 'Compras y mandados', 'Compras'),
(17, 'user', 'list.png', 'Lista general de tareas', 'General'),
(18, 'user', 'work.png', 'Pendientes relacionados al trabajo', 'Trabajo'),
(19, 'user', 'home.png', 'Tareas del hogar', 'Hogar'),
(20, 'user', 'study.png', 'Estudio y aprendizaje', 'Estudio'),
(21, 'user', 'shopping.png', 'Compras y mandados', 'Compras'),
(24, 'user1', 'list.png', 'Lista general de tareas', 'General'),
(25, 'user1', 'work.png', 'Pendientes relacionados al trabajo', 'Trabajo'),
(26, 'user1', 'home.png', 'Tareas del hogar', 'Hogar'),
(27, 'user1', 'study.png', 'Estudio y aprendizaje', 'Estudio'),
(28, 'user1', 'shopping.png', 'Compras y mandados', 'Compras'),
(29, 'admin', 'home.png', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `details` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `Username`, `color`, `details`, `name`) VALUES
(1, 'default', '#FF0000', 'Tareas urgentes o críticas', 'Urgente'),
(2, 'default', '#007BFF', 'Actividades relacionadas al trabajo', 'Trabajo'),
(3, 'default', '#28A745', 'Tareas personales o del hogar', 'Personal'),
(4, 'default', '#FFC107', 'Pendientes de estudio o aprendizaje', 'Estudio'),
(5, 'default', '#6F42C1', 'Recordatorios o tareas opcionales', 'Opcional'),
(6, 'po', '#FF0000', 'Tareas urgentes o críticas', 'Urgente'),
(7, 'po', '#007BFF', 'Actividades relacionadas al trabajo', 'Trabajo'),
(8, 'po', '#28A745', 'Tareas personales o del hogar', 'Personal'),
(9, 'po', '#FFC107', 'Pendientes de estudio o aprendizaje', 'Estudio'),
(10, 'po', '#6F42C1', 'Recordatorios o tareas opcionales', 'Opcional'),
(11, 'q', '#FF0000', 'Tareas urgentes o críticas', 'Urgente'),
(12, 'q', '#007BFF', 'Actividades relacionadas al trabajo', 'Trabajo'),
(13, 'q', '#28A745', 'Tareas personales o del hogar', 'Personal'),
(14, 'q', '#FFC107', 'Pendientes de estudio o aprendizaje', 'Estudio'),
(15, 'q', '#6F42C1', 'Recordatorios o tareas opcionales', 'Opcional'),
(19, 'po', '#ff4f8b', '', 'r'),
(20, 'user', '#FF0000', 'Tareas urgentes o críticas', 'Urgente'),
(21, 'user', '#007BFF', 'Actividades relacionadas al trabajo', 'Trabajo'),
(22, 'user', '#28A745', 'Tareas personales o del hogar', 'Personal'),
(23, 'user', '#FFC107', 'Pendientes de estudio o aprendizaje', 'Estudio'),
(24, 'user', '#6F42C1', 'Recordatorios o tareas opcionales', 'Opcional'),
(27, 'user1', '#FF0000', 'Tareas urgentes o críticas', 'Urgente'),
(28, 'user1', '#007BFF', 'Actividades relacionadas al trabajo', 'Trabajo'),
(29, 'user1', '#28A745', 'Tareas personales o del hogar', 'Personal'),
(30, 'user1', '#FFC107', 'Pendientes de estudio o aprendizaje', 'Estudio'),
(31, 'user1', '#6F42C1', 'Recordatorios o tareas opcionales', 'Opcional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `due_date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `is_checked` int(11) NOT NULL,
  `tittle` varchar(50) NOT NULL,
  `list` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `Username`, `due_date`, `description`, `tag`, `is_checked`, `tittle`, `list`) VALUES
(1, 'po', '2026-05-10', 'Preparar presentación trimestral', 'Urgente', 1, 'Reunión de equipo', 'Trabajo'),
(2, 'po', '2026-05-05', 'Leche, huevos, fruta y verduras', 'Personal', 0, 'Comprar despensa', 'Compras'),
(3, 'po', '2026-05-08', 'Libro de algoritmos', 'Estudio', 0, 'Leer capítulo 3', 'Estudio'),
(4, 'po', '2026-05-06', 'Incluir horno y refrigerador', 'Personal', 0, 'Limpiar cocina', 'Hogar'),
(5, 'po', '2026-05-07', 'Reporte mensual de ventas', 'Urgente', 0, 'Entregar reporte', 'Trabajo'),
(6, 'po', '2026-05-09', 'Luz, agua e internet', 'Opcional', 0, 'Pagar servicios', 'General'),
(7, 'po', '2026-05-12', 'Matemáticas discretas unidad 2', 'Estudio', 0, 'Estudiar para examen', 'Estudio'),
(8, 'po', '2026-05-05', 'Fuga en el baño principal', 'Urgente', 0, 'Llamar al plomero', 'Hogar'),
(9, 'po', '2026-05-11', 'Cuaderno y plumas para el curso', 'Estudio', 0, 'Comprar útiles', 'Compras'),
(10, 'po', '2026-05-04', 'Responder pendientes de la semana', 'Trabajo', 0, 'Revisar correos', 'General'),
(11, 'po', '2025-07-28', 'sisi', 'r', 0, 'sissi', 'Estudio'),
(13, 'po', '0000-00-00', '2', 'r', 0, '2', 'Estudio'),
(14, 'po', '0000-00-00', '2', 'Urgente', 0, '2', 'General'),
(15, 'admin', '0000-00-00', '2', '', 0, '2', ''),
(16, 'po', '0004-07-28', 's', 'Estudio', 0, 'd', 'Trabajo'),
(17, 'po', '0000-00-00', 'swsw', 'Estudio', 0, 'sw2s', 'Trabajo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `Name` varchar(50) NOT NULL,
  `Second_Name` varchar(50) NOT NULL,
  `First_Last_Name` varchar(50) NOT NULL,
  `Second_Last_Name` varchar(50) NOT NULL,
  `Birthday` date NOT NULL,
  `Color` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Style` varchar(50) NOT NULL,
  `Default_list` int(11) NOT NULL,
  `Default_tag` int(11) NOT NULL,
  `Motivational_phrase` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`Name`, `Second_Name`, `First_Last_Name`, `Second_Last_Name`, `Birthday`, `Color`, `Gender`, `Username`, `Password`, `Style`, `Default_list`, `Default_tag`, `Motivational_phrase`) VALUES
('p', 'p', 'p', 'p', '2004-07-28', '#6d8d69', 'MALE', 'po', '$argon2id$v=19$m=65536,t=4,p=1$RDl3dmJjQmx3MWF5UjdXRA$Ge9YdU3Mg3gvR+AcvCYyZCvRHGn/N+JnZ8bnOV7OCX0', 'Light', 1, 1, 'd'),
('q', 'w', 'w', 'w', '2004-07-28', '#000000', 'MALE', 'q', '$argon2id$v=19$m=65536,t=4,p=1$SjkuZ01HM2tDc3NRdDNYRw$FEqhk6b6dHIFlD03UGW3oP113tXXGfDn7/xM8cigsiU', 'Light', 1, 1, 'wiwiwi'),
('', '', '', '', '0000-00-00', '#000000', 'MALE', '', '$argon2id$v=19$m=65536,t=4,p=1$OFZLc3pNOTBDcWVMOEwxbg$Zfg97jBkJjCP2QA5gR+wAvn556RidSd8FtWURH6/klI', 'Light', 0, 0, ''),
('', '', '', '', '0000-00-00', '#000000', 'MALE', '', '$argon2id$v=19$m=65536,t=4,p=1$VTRVbFhUbW9ySFM2bjdDZw$69ovd7in8SBC7pNSsunynIrY2xjO1NcOwU8glAUWDVo', 'Light', 0, 0, ''),
('', '', '', '', '0000-00-00', '#000000', 'MALE', 'nwe', '$argon2id$v=19$m=65536,t=4,p=1$aW1icWF0S1FXRVhNVDVMcQ$qkJAS+p3FTvmm/4WPtUVGoUHQzwEdjw/FvhJLLSD/Dw', 'Light', 0, 0, ''),
('', '', '', '', '0000-00-00', '#000000', 'MALE', 'new', '$argon2id$v=19$m=65536,t=4,p=1$UVFZZW9jL0hhTDJhRm8xMA$LQVPrNJzPbGY7PbbHFQNNNEcJAavJVGai0vJU78Ulic', 'Light', 0, 0, ''),
('user', 'user', 'user', 'user', '2004-07-28', '#000000', 'FEMALE', 'user', '$argon2id$v=19$m=65536,t=4,p=1$YUxHNHA5TkFXWnVnUEtDeA$hWLqkkpMyYij1HQqCuKzmxj/aGjDDvdcrSYwcv5cyNo', 'Light', 1, 1, 'AJUA'),
('2', '2', '2', '2', '0004-02-28', '#000000', 'MALE', 'user1', '$argon2id$v=19$m=65536,t=4,p=1$bzJuRFVKTkRraVY2LnBMbg$ueVo9+nmeKef752mqdr9MZYJNW4LJ6Zt3ML3vLnyL0w', 'Light', 1, 1, 'aa'),
('a', 'a', 'a', 'a', '0000-00-00', '#000000', 'MALE', 'a', '$argon2id$v=19$m=65536,t=4,p=1$NVo1LnllTlJjMjdYUEZDOA$zg1jnf4n8OSwUh63GJfbj7m6IYtgr95CIdRJNqOHbbc', 'Light', 0, 0, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
