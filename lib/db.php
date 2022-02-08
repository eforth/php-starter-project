<?php

    function connect(): PDO {
        try {
            $dsn = "mysql:host=" . DB_HOST. ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";";
            return new PDO($dsn,DB_USER, DB_PASS,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location:' . APP_HOST . '?page=error');
            exit;
        }
    }

    function tableExist($connection, $tableName) {
        $statement = $connection->prepare("SELECT to_regclass(:table)");
        $statement->bindParam('table', $tableName);
        return $statement->fetchColumn(0);
    }