<?php
	require ('application/model/dal.php');

	$dal = new DAL();

	echo '<h2>Get product by ID</h2>';
	echo '<table>';
	foreach ($dal->getProductById(1) as $product) {
		echo '<tr>';
		echo '<td>'.$product->getName().'</td>';
		echo '<td>'.$product->getPrice().'</td>';
		echo '</tr>';
	}
	echo '</table>';

	echo '<hr/>';
	echo '<h2>Get all products</h2>';

	echo '<table>';
	foreach ($dal->getProducts() as $product) {
		echo '<tr>';
		echo '<td>'.$product->getName().'</td>';
		echo '<td>'.$product->getPrice().'</td>';
		echo '</tr>';
	}
	echo '</table>';
?>