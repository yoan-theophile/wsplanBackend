<?php

// This file creates our student table and inserts some records in it for testing

require_once 'bootstrap.php';

$statement = <<<EOS
    SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
    SET time_zone = "+00:00";

    CREATE TABLE `student` (
        `id` int(11) NOT NULL,
        `fisrtname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
        `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
        `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
        `lastlog` date NOT NULL,
        `sex` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
        `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
        `class` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
        `active` tinyint(1) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    
    INSERT INTO `student` 
    (`id`, `fisrtname`, `lastname`, `email`, `lastlog`, `sex`, `password`, `class`, `active`) 
    VALUES (NULL, 'Jean', 'Marc', 'jeanmarc@student.com', '2022-07-23', 'M', 'jeanmarc@student.com', 'IRT3', '1');
    
    ALTER TABLE `student`
        ADD PRIMARY KEY (`id`);

    ALTER TABLE `student`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
    COMMIT;
EOS;

try {
    // $createTable = $dbConnection->exec($statement);
    \R::exec($statement);
    echo "Student table created successfully\n";
} catch (\Exception $e) {
    exit($e->getMessage());
}
