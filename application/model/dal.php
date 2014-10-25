<?php
	/**
	 * Data Access Layer - holds all the DB connections and queries in one location.
	 * Quick and dirty implementation; not very scalable per se.
	 * @author Sudhi Pulla
	 */

	include (__DIR__.'/../config/config.php');
	include ('classes/product.php');

	class DAL {
		private $conn;

		/**
		 * Constructor for Data Access Layer.
		 * Establishes a connection to the DB and keeps it open.
		 */
		public function __construct() {
			try {
			    $this->conn = new PDO('mysql:host='.Config::dbHost.';dbname='.Config::dbName, Config::dbUsername, Config::dbPassword);
	    		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	     
			} catch(PDOException $e) {
	    		echo 'ERROR: ' . $e->getMessage();
			}
		}

		/**
		 * Destructor for Data Access Layer.
		 * Closes the DB connection.
		 */
		function __destruct() {
			if(!is_null($this->conn)) {
				$this->conn = null;
			}
		}

		/**
		 * Check if the DB connection is still active.
		 */
		public function isConnected() {
			return is_null($this->conn);
		}

		/**
		 * Get all products in the DB as an array of Product objects.
		 */
		public function getAllProducts() {
		    $stmt = $this->conn->prepare('SELECT * FROM products');
		    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
		    $stmt->execute();
		    return $stmt->fetchAll();
		}

		/**
		 * Get one product in the DB based on its id.
		 * Return value is still an array containing exactly one element.
		 */
		public function getProductById($id) {
		    $stmt = $this->conn->prepare('SELECT * FROM products WHERE id = :id');
		    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
		    $stmt->bindParam(':id', $id);
		    $stmt->execute();
		    return $stmt->fetchAll();
		}

		/**
		 * Add one product to the DB.
		 * Return value of '1' indicates a success as exactly one row gets added.
		 */
		public function addProduct($product) {
		    $stmt = $this->conn->prepare('INSERT INTO products VALUES(:name, :price)');
		    $stmt->bindParam(':name', $product->name);
		    $stmt->bindParam(':price', $product->price);
		    $stmt->execute();
		    return $stmt->rowCount();
		}

		/**
		 * Update a product in the DB.
		 * Return value of '1' indicates a success as exactly one row gets updated.
		 */
		public function updateProduct($product) {
		    $stmt = $this->conn->prepare('UPDATE products SET name = :name, price = :price WHERE id = :id');
		    $stmt->bindParam(':id', $product->id);
		    $stmt->bindParam(':name', $product->name);
		    $stmt->bindParam(':price', $product->price);
		    $stmt->execute();
		    return $stmt->rowCount();
		}

		/**
		 * Delete a product in the DB.
		 * Return value of '1' indicates a success as exactly one row gets deleted.
		 */
		public function deleteProduct($product) {
			$stmt = $pdo->prepare('DELETE FROM products WHERE id = :id');
			$stmt->bindParam(':id', $product->id);
			$stmt->execute();
		    return $stmt->rowCount();
		}

		/**
		 * Delete a product in the DB.
		 * Return value of '1' indicates a success as exactly one row gets deleted.
		 */
		public function deleteProductById($id) {
			$stmt = $pdo->prepare('DELETE FROM products WHERE id = :id');
			$stmt->bindParam(':id', $id);
			$stmt->execute();
		    return $stmt->rowCount();
		}
	}
?>