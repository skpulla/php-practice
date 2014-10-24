<?php
	require ('application/model/dal.php');

	$dal = new DAL();

	echo '<table>';
	foreach ($dal->getProducts() as $product) {
		echo '<tr>';
		echo '<td>'.$product->getName().'</td>';
		echo '<td>'.$product->getPrice().'</td>';
		echo '</tr>';
	}
	echo '</table>';
?>