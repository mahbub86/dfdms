<?php
/*
$task = '';
if(isset($data->action)) {
	$task = trim($data->action);
}

switch($task){
	
	case "getDataList":
		$returnData = getDataList($data);
		break;
		
				
		
	default :
		echo "{failure:true}";
		break;
}

function getDataList($data) {

	try{

		$dbh = new Db();
		
		
		
		
		

		$query = "SELECT `logId` id,`logDate`,`RemoteIP`, userName,`queryType`,
			CONCAT ('<b>SQL:</b> ', `query`, '</br><b>Parameter(s):</b> ', SqlParams) query , `errorNo`,`errorMsg` 
					FROM t_errorlog
					
			WHERE 1 = 1 
			ORDER BY logDate DESC";
			
		

		$resultdata = $dbh->query($query);

		$returnData = [
			"success" => 1,
			"status" => 200,
			"message" => "",
			"datalist" => $resultdata
		];

	}catch(PDOException $e){
		$returnData = msg(0,500,$e->getMessage());
	}
	
	return $returnData;
}




	*/
?>