<?php
require_once "./app/config/config.php";
class DbHelper
{

  public static function connect_db()
  {
    try {
      $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
      return $conn;
    } catch (PDOException $e) {
      $conn = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
      // set the PDO error mode to exception
      $sql = "CREATE DATABASE " . DB_NAME;
      $conn->exec($sql);

      $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "", DB_USER, DB_PASS);

      $sql = "CREATE TABLE `directores` (
        `id` int(11) NOT NULL,
        `nombre` varchar(255) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
      ALTER TABLE `directores`
      ADD PRIMARY KEY (`id`); 
      
      ALTER TABLE `directores`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;";
      $conn->exec($sql);

      $sql = "INSERT INTO `directores` (`id`, `nombre`) VALUES
      (4, 'Martin Scorsese'),
      (5, 'James Wan'),
      (6, 'Guillermo Del Toro'),
      (7, 'Greta Gerwig');
      ";
      $conn->exec($sql);

      $sql = "CREATE TABLE `peliculas` (
        `id` int(11) NOT NULL,
        `titulo` varchar(255) NOT NULL,
        `genero` varchar(255) NOT NULL,
        `year` int(11) NOT NULL,
        `director` int(11) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
      ALTER TABLE `peliculas`

      ADD PRIMARY KEY (`id`),
      ADD KEY `id_director` (`director`);

      ALTER TABLE `peliculas`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

      ALTER TABLE `peliculas`
      ADD CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`director`) REFERENCES `directores` (`id`); ";
      $conn->exec($sql);

      $sql = "INSERT INTO `peliculas` (`id`, `titulo`, `genero`, `year`, `director`) VALUES
      (4, 'The Irishman', 'Drama', 2020, 4),
      (5, 'Ladybird', 'Drama, Coming of age', 2014, 7),
      (6, 'Barbie', 'Drama, Comedia', 2023, 7),
      (7, 'Taxi Driver', 'Drama', 1976, 4),
      (8, 'The Conjuring', 'Terror', 2013, 5),
      (9, 'Saw', 'Terror, Gore', 2004, 5),
      (10, 'Laberinto del fauno', 'Drama, Fantasia', 2006, 6),
      (11, 'Crimson Peak', 'Terror, Horror', 2015, 6);";
      $conn->exec($sql);


      $sql = "CREATE TABLE `usuarios` (
        `id` int(11) NOT NULL,
        `email` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
      
      ALTER TABLE `usuarios`
      ADD PRIMARY KEY (`id`);
      
      ALTER TABLE `usuarios`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;";
      $conn->exec($sql);


      $sql = "INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
      (2, 'webadmin', '$2y$10$0eO.03LGBqLFKdzAoTMaRO7Kf9NQueTKpx2Vm.MltexAL75qs6qKO');";
      $conn->exec($sql);


      return $conn;
    }
  }
}
