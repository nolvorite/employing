<?php 
	class DbConnect {
		private $host = 'localhost';
		private $dbName = 'u398081410_leakchat_leakc';
		private $user = 'u398081410_leakchat_leakc';
		private $pass = 'L0o/8&smia^';

		public function connect() {
			try {
				$conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbName, $this->user, $this->pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch( PDOException $e) {
				echo 'Database Error: ' . $e->getMessage();
			}
		}
	}
 ?>