<?php 

namespace App\Libs;

class DB {

    private $db_host;
    private $db_name;
    private $db_pass;
    private $db_port;
    private $db_user;
    private PDO $pdo;
    private Log $logger;

    public function __construct()
    {
        $db_host = $_ENV['DB_HOST'];
        $db_name = $_ENV['DB_NAME'];
        $db_pass = $_ENV['DB_PASS'];
        $db_port = $_ENV['DB_PORT'];
        $db_user = $_ENV['DB_USER'];

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        $dsn .= "mysql:host={$db_host};";
        $dsn .= "port={$db_port};dbname={$db_name};";

        // Initialize logger
        $this->logger = (new Log())->getLogger();

        try {

            // Initialize PDO connection
            $this->pdo = new PDO($dsn, $db_user, $db_pass, $options);

            $this->logger->info('PDO connection established');

        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            $this->pdo = null;
        }
    }
}