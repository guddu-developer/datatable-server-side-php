<?php 

require("db.php");


// $sql="SELECT id,name,url FROM your_table_name";

// $result=mysqli_query($conn,$sql);
//    //////error in php of data require line 10
//     // printf("Error: %s\n", mysqli_error($conn));
// $row = mysqli_fetch_all($result,MYSQLI_ASSOC);

// // print_r($row);
// echo json_encode($row,JSON_PRETTY_PRINT);

//////////////////////////by guddu

//////// initilize all variable
	$params = $columns = $totalRecords = $data = array();

	$params = $_REQUEST;

	//define index of column
	$columns = array( 
		0 =>'id',
		1 =>'name', 
		2 => 'url',
	);

	$where = $sqlTot = $sqlRec = "";

	// check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( name LIKE '".$params['search']['value']."%' ";    
		$where .=" OR url LIKE '".$params['search']['value']."%' )";
	}

	// getting total number records without any search
	$sql = "SELECT id,name,url FROM your_table_name";
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}


 	$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

	$queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));


	$totalRecords = mysqli_num_rows($queryTot);

	$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");

	//iterate on results row and create new index array of data
	while( $row = mysqli_fetch_row($queryRecords) ) { 
		$data[] = $row;
	}	

	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);  // send data as json format
