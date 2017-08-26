
<?php  
// Open mysql Connection
$con = @mysqli_connect('localhost', 'root', '', 'sample_test');

if (!$con) {
    echo "Error: " . mysqli_connect_error();
	exit();
}


$sale_date = DateTime::createFromFormat('d/m/Y', $_POST ['sale_date']);
$sale_date_start = $sale_date->format('Y-m-d'); 

$sale_date_end = DateTime::createFromFormat('d/m/Y', $_POST ['sale_date_end']);
$sale_date_ends = $sale_date_end->format('Y-m-d'); 


	$sql = "SELECT C.customer_id, C.firstname, C.lastname, C.gender, COUNT(S1.sale_id) as sales_count_s1, SUM(S1.sale_amount) as sale_amount_s1, MAX(S1.sale_date) as sale_date_s1, COUNT(S2.sale_id) as sales_count_s2, SUM(S2.sale_amount) as sale_amount_s2, MAX(S2.sale_date) as sale_date_s2 FROM CUSTOMER AS C JOIN sales1 AS S1 ON S1.customer_id = C.customer_id JOIN sales2 AS S2 ON S2.customer_id = C.customer_id WHERE (S1.sale_date >= '$sale_date_start' AND S1.sale_date <= '$sale_date_ends') OR (S2.sale_date >= '$sale_date_start' AND S2.sale_date <= '$sale_date_ends') GROUP BY C.customer_id	
    ";
	
	$query 	= mysqli_query($con, $sql);
    
	while ($row = mysqli_fetch_array($query))
	{
			 $result[] = $row;
	}
   
    if (isset($result)) {
	foreach($result as $row) {
   
		if($row['gender'] == 'Male') {
			$salute = 'Mr. ';
		}
		else if ($row['gender'] == 'Female') {
			$salute = 'Ms. ';
		}
		else {
			$salute = null;
		}

		$customer_id = $row['customer_id'];

		if ($salute) {
			$name = $salute . $row['firstname'] . ' ' . $row['lastname'];
		}
		else {
			$name = $row['firstname'] . ' ' . $row['lastname'];
		}
		
		$total_sale_count = ($row['sales_count_s1']) + ($row['sales_count_s2']);
		$total_sale_amount = ($row['sale_amount_s1']) + ($row['sale_amount_s2']);
		$latest_sales_date = ($row['sale_date_s1'] > $row['sale_date_s2']) ? $row['sale_date_s1'] : $row['sale_date_s2'];

		$data_array = [
			"customer_id" => $customer_id,
			"customer_name" => $name,
			"sales_count" => $total_sale_count,
			"sales_sum" => $total_sale_amount,
			"sales_date" => $latest_sales_date
		];

		$csv_array[] = $data_array;
		
        convert_to_csv($csv_array, '.csv', ',');
	}
	}else{
		echo "NO data Found !!!";
		echo "<br />";
		echo " <a href='home.php'>Select valid date</a>";
		

	}
	


//function CSV export 
function convert_to_csv($csv_array, $output_file_name, $delimiter)
{
    // opens raw memory as file
    $f = fopen('php://memory', 'w');
    
    foreach ($csv_array as $line) {
        // default php csv handler 
        fputcsv($f, $line, $delimiter);
    }
    // rewrinds the "file" with the csv lines 
    fseek($f, 0);
    // modifies header to be downloadable csv file
    header('Content-Type: application/csv');
    header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
    //Send file to browser for download
    fpassthru($f);
}



?>
