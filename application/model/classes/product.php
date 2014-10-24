<?php
	/**
	 * Product class holds information about each product in the store.
	 *
	 * @author Sudhi Pulla
	 */
	class Product {
		public $id;
		public $name;
		public $price;

		public function getName() {
			return $this->name;
		}

		public function getPrice() {
		  	return $this->price;
		}
	}
?>