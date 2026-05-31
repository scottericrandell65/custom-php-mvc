<?php

 class Database
 {
     /**
      * PDO connection instance
      * Kept private so it cannot be accessed directly from outside
      */
     private PDO $pdo;

     public function __construct()
     {
         // Load database credentials from config file
	 $config = require __DIR__ . '/../../config/database.php';

	// Build DSN (Data Source Name)
	// This tells PDO how to connect to MySQL/MariaDB
	$dsn = sprintf(
	     'mysql:host=%s; dbname=%s; charset=utf8mb4',
	     $config['host'],
	     $config['dbname']
	);

	try {
	    // Create PDO connection
	    $this->pdo = new PDO(
	        $dsn,
	        $config['username'],
		$config['password']
	    );

	    // Throw exceptions instead of silent failures
	    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	   // Automatically return results as associative arrays
	   $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
	    // Stop execution if DB connection fails
	    die("DB Connection failed: " . $e->getMessage());
	}
    }

    /*
     * Core query method using prepared statements
     * This prevents SQL injection attacks
     */
    public function query(string $sql, array $params = []): PDOStatement
    {
	    // Safty check (helps catch bugs early)
	    if (!is_string($sql)) {
		var_dump($sql);
	        die("SQL is not a string - bug detected above");
	    }

	   // Prepare SQL statement (safe against injection)
	   $stmt = $this->pdo->prepare($sql);
	   $stmt->execute($params);

	   return $stmt;
    }

    /**
     * Fetch all matching records
     */
    public function fetchAll(string $sql, array $params = []): array
   {
	   return $this->query($sql, $params)->fetchAll();
   }

   /**
    * Fetch a single record
    * Used when you expect only ONE row *e.g. post by ID)
    */
   public function fetch(string $sql, array $params = []): array|false
   {
	   return $this->query($sql, $params)->fetch();
   }

   /**
    * Execute INSERT / UPDATE / DELETE queries
    * Returns true if query executed successfully
    */
    public function execute(string $sql, array $params = []): bool
    {
	   $stmt = $this->pdo->prepare($sql);
	   return $stmt->execute($params);
    }
}
