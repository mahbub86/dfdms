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
		
	case "getAuditLogList":
		$returnData = getAuditLogList($data);
		break;

    case "getDataBaseInfo" :
		$returnData = getDataBaseInfo($data);
		break;

    case "getTableInfo" :
		$returnData = getTableInfo($data);
		break;	
		
	case "getSqlLogSingle" :
		$returnData = getSqlLogSingle($data);
		break;	
		
		
	default :
		echo "{failure:true}";
		break;
}

function getDataList($data) {

	try{

		$dbh = new Db();
		
		//$FacilityId = trim($data->FacilityId);
		
		$RequestType = isset($data->RequestType) ? $data->RequestType : 0;
		if ($RequestType!='0'){
			$QueryTypeCond = "AND QueryType= '$RequestType'";
		}else{
			$QueryTypeCond = '';
		}	
		
		$UserList = isset($data->UserList) ? $data->UserList : 0;
		
		if ($UserList !='0'){
			$UserNameCond = "AND userName= '$UserList'";
		}else{
			$UserNameCond = '';
		}
		
		$cboDatabaseTables = isset($data->cboDatabaseTables) ? $data->cboDatabaseTables: 0;	
		if ($cboDatabaseTables !='0'){
			$TableNameCond = "AND TableName= '$cboDatabaseTables'";
		}else{
			$TableNameCond = '';
		}
		
		
		$Start_Date=date_create(trim($data->logStartDate));
		$logStartDate = date_format($Start_Date,"d/m/Y");	
		if ($logStartDate != ''){
				$hold = explode('/', $logStartDate);
				$startDateMonth = $hold[2] . "-" . $hold[1] . "-" . $hold[0];
				$startDateMonth = $startDateMonth." 00:00:01";
					
				$LogstartDateMonth = "AND CAST(LogDate AS DATETIME) >= CAST('$startDateMonth' AS DATETIME)";
			
		}else{
			$LogstartDateMonth = '';
		}
		
		$End_Date=date_create(trim($data->logEndDate));
		$logEndDate = date_format($End_Date,"d/m/Y");
			
		if ($logEndDate != ''){
				
				$holdend = explode('/', $logEndDate);
				$endDateMonth = $holdend[2] . "-" . $holdend[1] . "-" . $holdend[0];
				$endDateMonth = $endDateMonth." 23:59:59"; 
				
				$LogendDateMonth = "AND CAST(LogDate AS DATETIME) <= CAST('$endDateMonth' AS DATETIME) ";
		}else{
			$LogendDateMonth = '';
		}
		
		

		$query = "SELECT logId id, LogDate, userName, RemoteIP, QueryType, TableName, SqlText,SqlParams
					FROM t_sqllog 
			WHERE 1 = 1
			$LogstartDateMonth
			$LogendDateMonth			
			$QueryTypeCond
			$UserNameCond
			$TableNameCond
			ORDER BY LogDate DESC";

	
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


function getAuditLogList($data) {

	try{

		$dbh = new Db();
		$log_id = trim($data->log_id);

		$query = "SELECT SQL_CALC_FOUND_ROWS `jsonText` FROM t_sqllog WHERE logId = $log_id";

		$resultdata = $dbh->query($query);
		
		
		$output = array();
		$output1 = array(); 
		// $serial = $_POST['iDisplayStart'] + 1;
		
		foreach($resultdata as $rdata){
			$datas = json_decode($rdata['jsonText']);
			foreach($datas as $d){
				
				unset($output1);
				// $sl = $serial++;
				// $sOutput .= ',';
				// $output1['SL'] = $sl;
				$output1['FieldName'] = $d[0];
				$output1['OldValue'] = $d[1];
				$output1['NewValue'] = $d[2];
				$output[] = $output1;
			}
		}

		$returnData = [
			"success" => 1,
			"status" => 200,
			"message" => "",
			"datalist" => $output
		];

	}catch(PDOException $e){
		$returnData = msg(0,500,$e->getMessage());
	}
	
	return $returnData;
}



function getSqlLogSingle($data) {

	try{

		$dbh = new Db();
		$log_id = trim($data->log_id);

		$query = "SELECT logId as id, LogDate, userName, RemoteIP, QueryType, TableName, SqlText,SqlParams
				FROM t_sqllog 
		WHERE 
		logId=5
		ORDER BY LogDate DESC";
			
		

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






function getDataBaseInfo($data) {
	
	
	try{

	$dbh = new Db();
	$dataBaseInfo = array('DBName' => DB_NAME);
		
		$returnData = [
			"success" => 1,
			"status" => 200,
			"message" => "",
			"datalist" => $dataBaseInfo
		];

	}catch(PDOException $e){
		$returnData = msg(0,500,$e->getMessage());
	}
	
	return $returnData;
	
}


function getTableInfo($data) {

	try{

		$dbh = new Db();
		
		$DataBaseName = trim($data->DataBaseName);

		$query = "SELECT DISTINCT TABLE_NAME id ,TABLE_NAME name
		FROM INFORMATION_SCHEMA.COLUMNS
		WHERE TABLE_SCHEMA = '".$DataBaseName."' AND TABLE_NAME LIKE 't_%'
		ORDER BY TABLE_NAME;";
		
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