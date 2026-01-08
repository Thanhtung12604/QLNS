<?php

/**
 * Database Class - Xử lý kết nối database
 */
class Database
{
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $charset = DB_CHARSET;
    private $conn = null;

    /**
     * Kết nối database sử dụng PDO
     */
    public function connect()
    {
        if ($this->conn === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            } catch (PDOException $e) {
                die("Lỗi kết nối database: " . $e->getMessage());
            }
        }
        return $this->conn;
    }

    /**
     * Execute query and return results
     */
    public function query($sql, $params = [])
    {
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Execute query without fetch
     */
    public function execute($sql, $params = [])
    {
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute($params);
    }
}
