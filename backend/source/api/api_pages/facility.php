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
		
	case "dataInsert":
		$returnData = dataInsert($data);
		break;
		
	case "dataUpdate":
		$returnData = dataUpdate($data);
		break;
		
	case "getFacilitySingleView":
		$returnData = getFacilitySingleView($data);
		break;
		
	case "UpdateFacility":
		$returnData = UpdateFacility($data);
		break;
		
	case "getFacilityCode":
		$returnData = getFacilityCode($data);
		break;
		
	case "deleteaFacility":
		$returnData = deleteaFacility($data);
		break;

	case "getProductGroupMapPopup" :
		$returnData = getProductGroupMapPopup($data);
		break;

	case "insertUpdateFacilityGroupMapPopup":
		$returnData = insertUpdateFacilityGroupMapPopup($data);
		break;
	
	default :
		echo "{failure:true}";
		break;
}


function getDataList($data) {

	try{

		$dbh = new Db();

		$RegionId =  empty(trim($data->RegionId)) ?  0:$data->RegionId;
		$ZoneId =  empty(trim($data->ZoneId)) ?  0:$data->ZoneId;
		$CommuneId =  empty(trim($data->CommuneId)) ?  0:$data->CommuneId;
		$OwnerTypeId =  empty(trim($data->OwnerTypeId)) ?  0:$data->OwnerTypeId;
		$ServiceAreaId =  empty(trim($data->ServiceAreaId)) ?  0:$data->ServiceAreaId;
		$FTypeId =  empty(trim($data->FTypeId)) ?  0:$data->FTypeId;
		$bDispensingValue = isset($data->bDispensingValue) ? $data->bDispensingValue : "true";

		if($bDispensingValue == 1){
			$bDispenseFilter = "AND a.`bDispense` = 1";
		}else{
			$bDispenseFilter = "";
		}

		$query = "SELECT 
			a.`FacilityId` id, a.`CountryId`, a.`RegionId`, a.`ZoneId`, a.`FTypeId`, a.`FLevelId`,
			a.`FacilityCode`, a.`FacilityName`,`FLevelName`, `FTypeName`, a.`FacilityAddress`, a.`FacilityPhone`, a.`FacilityEmail`, a.`Latitude`, a.`Longitude`,
			a.`DistrictId`, a.`ServiceAreaId`, a.`OwnerTypeId`, a.`ExternalFacilityId`, a.`FacilityInCharge`,
			a.`bDispense`, a.`SOBAPSCode`, `RegionName`, e.`DistrictName` ,m.`ZoneName`,f.`OwnerTypeName`, 
	        g.`ServiceAreaName`, `FacilityInCharge`,CONCAT(a.`Latitude`,',', a.`Longitude`) as location
			
			FROM `t_facility` a
			
			INNER JOIN t_facility_level b ON a.FLevelId = b.FLevelId
			INNER JOIN t_facility_type c ON a.FTypeId = c.FTypeId		
			INNER JOIN t_owner_type f ON a.OwnerTypeId = f.OwnerTypeId
			INNER JOIN t_service_area g ON a.ServiceAreaId = g.ServiceAreaId
			
			LEFT JOIN t_region d ON a.RegionId = d.RegionId
			LEFT JOIN t_districts e ON a.DistrictId = e.DistrictId
			LEFT JOIN t_zone m ON a.ZoneId = m.ZoneId
				
			WHERE
			 (a.RegionId = " . $RegionId . " OR " . $RegionId . " = 0) 
		 AND (a.ZoneId = " . $ZoneId . " OR " . $ZoneId . " = 0)  
		 AND (a.DistrictId = " . $CommuneId . " OR " . $CommuneId . " = 0) 			 
		 AND (a.OwnerTypeId = " . $OwnerTypeId . " OR " . $OwnerTypeId . " = 0) 			 
		 AND (a.FTypeId = " . $FTypeId . " OR " . $FTypeId . " = 0) 			 
		 AND (a.ServiceAreaId = " . $ServiceAreaId . " OR " . $ServiceAreaId . " = 0)
		 $bDispenseFilter	
			ORDER BY a.FacilityCode, a.FacilityName;";

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

function dataInsert($data) {

	if($_SERVER["REQUEST_METHOD"] != "POST"){
		return $returnData = msg(0,404,'Page Not Found!');
	}
	// CHECKING EMPTY FIELDS
	elseif(!isset($data->FacilityCode)|| !isset($data->FacilityName) 
	|| !isset($data->FTypeId) || !isset($data->FLevelId) || !isset($data->ServiceAreaId)
	|| !isset($data->RegionId)
	|| !isset($data->ZoneId)
	|| !isset($data->DistrictId)
	|| !isset($data->OwnerTypeId)
	){
		$fields = ['fields' => ['FacilityCode','FacilityName', 'RegionId', 'ZoneId', 'DistrictId', 'FTypeId', 'FLevelId', 'ServiceAreaId', 'OwnerTypeId']];
		return $returnData = msg(0,422,'Please Fill in all Required Fields!', $fields);
	
	}else{
		$CountryId = 1;
		$FacilityCode = trim($data->FacilityCode);
		$FacilityName = trim($data->FacilityName);
		$RegionId = empty(trim($data->RegionId)) ? NULL : trim($data->RegionId);
		$FTypeId = trim($data->FTypeId);
		$FLevelId = trim($data->FLevelId);
		$FacilityAddress = empty(trim($data->FacilityAddress)) ? "" : trim($data->FacilityAddress);
		$FacilityPhone = empty(trim($data->FacilityPhone)) ? "" : trim($data->FacilityPhone);
		$FacilityEmail = empty(trim($data->FacilityEmail)) ? "" : trim($data->FacilityEmail);
		
		
		$latlang = empty(trim($data->location)) ? "" : trim($data->location); 
		$latlngarray = explode(",", $latlang);
		$lat = $latlngarray[0];
		$lng = isset($latlngarray[1]) ? $latlngarray[1] : '';
		
		$ServiceAreaId = trim($data->ServiceAreaId);
		$OwnerTypeId = trim($data->OwnerTypeId);
		$DistrictId = empty(trim($data->DistrictId)) ? NULL : trim($data->DistrictId); //trim($data->DistrictId);
		
			
		$ExternalFacilityId = empty(trim($data->ExternalFacilityId)) ? NULL : trim($data->ExternalFacilityId);
		$FacilityInCharge = empty(trim($data->FacilityInCharge)) ? NULL : trim($data->FacilityInCharge);
		$ZoneId = empty(trim($data->ZoneId)) ? NULL : trim($data->ZoneId); //trim($data->ZoneId);
		$SOBAPSCode = empty(trim($data->SOBAPSCode)) ? NULL : trim($data->SOBAPSCode);
		$bDispense = empty(trim($data->bDispense)) ? 0 : trim($data->bDispense);
		
		$lan = trim($data->lan); 
		$UserName = trim($data->UserName);		
		
		try{

			$dbh = new Db();
			$aQuerys = array();

			$q = new insertq();
            $q->table = 't_facility';
            $q->columns = ['CountryId', 'RegionId', 'FTypeId', 'FLevelId', 'FacilityCode', 
			'FacilityName', 'FacilityAddress', 'FacilityPhone', 'FacilityEmail', 
			'Latitude', 'Longitude', 'ServiceAreaId', 'OwnerTypeId',
			'DistrictId', 'ExternalFacilityId', 'FacilityInCharge', 'ZoneId',  'SOBAPSCode', 'bDispense'];
            $q->values = [$CountryId, $RegionId, $FTypeId, $FLevelId, $FacilityCode, 
			$FacilityName, $FacilityAddress, $FacilityPhone, $FacilityEmail, 
			$lat, $lng, $ServiceAreaId, $OwnerTypeId, 
			$DistrictId, $ExternalFacilityId, $FacilityInCharge, $ZoneId, $SOBAPSCode, $bDispense];
            $q->pks = ['FacilityId'];
            $q->bUseInsetId = true;
            $q->build_query();
			//print_r($q);
            $aQuerys = array($q);
			
	
			$res = exec_query($aQuerys, $UserName, $lan);  
			$success=($res['msgType']=='success')?1:0;
			$status=($res['msgType']=='success')?200:500;
			
			
			
			// Insert t_facility_group_map  Start
			
			$FacilityId = isset($res['FacilityId']) ? $res['FacilityId'] : '';
			 
			
			$returnData = [
				"success" => $success ,
				"status" => $status,
				"UserName"=> $UserName,
				"FacilityId" => $FacilityId,
				"message" => $res['msg']
			];

		}catch(PDOException $e){
			$returnData = msg(0,500,$e->getMessage());
		}
		
		return $returnData;
	}
}

function UpdateFacility($data) {

	if($_SERVER["REQUEST_METHOD"] != "PUT"){
		return $returnData = msg(0,404,'Page Not Found!');
	}
	// CHECKING EMPTY FIELDS
	elseif(!isset($data->FacilityCode)|| !isset($data->FacilityName) 
	|| !isset($data->FTypeId) || !isset($data->FLevelId) || !isset($data->ServiceAreaId)
	|| !isset($data->OwnerTypeId) || !isset($data->FacilityId)
	){
		$fields = ['fields' => ['FacilityId','FacilityCode','FacilityName', 'FTypeId', 'FLevelId', 'ServiceAreaId', 'OwnerTypeId']];
		return $returnData = msg(0,422,'Please Fill in all Required Fields!', $fields);
	
	}else{
		
		$FacilityId = trim($data->FacilityId);
		$RecordId = trim($data->FacilityId);
		
		
		$FacilityCode = trim($data->FacilityCode);
		$FacilityName = trim($data->FacilityName);
		$RegionId = empty(trim($data->RegionId)) ? NULL : trim($data->RegionId);
		$FTypeId = trim($data->FTypeId);
		$FLevelId = trim($data->FLevelId);
		$FacilityAddress = empty(trim($data->FacilityAddress)) ? "" : trim($data->FacilityAddress);
		$FacilityPhone = empty(trim($data->FacilityPhone)) ? "" : trim($data->FacilityPhone);
		$FacilityEmail = empty(trim($data->FacilityEmail)) ? "" : trim($data->FacilityEmail);
		
		
		$latlang = empty(trim($data->location)) ? "" : trim($data->location); 
		$latlngarray = explode(",", $latlang);
		$lat = $latlngarray[0];
		$lng = isset($latlngarray[1]) ? $latlngarray[1] : '';
		
		$ServiceAreaId = trim($data->ServiceAreaId);
		$OwnerTypeId = trim($data->OwnerTypeId);
		$DistrictId = empty(trim($data->DistrictId)) ? NULL : trim($data->DistrictId); //trim($data->DistrictId);
		
			
		$ExternalFacilityId = empty(trim($data->ExternalFacilityId)) ? NULL : trim($data->ExternalFacilityId);
		$FacilityInCharge = empty(trim($data->FacilityInCharge)) ? NULL : trim($data->FacilityInCharge);
		$ZoneId = empty(trim($data->ZoneId)) ? NULL : trim($data->ZoneId); //trim($data->ZoneId);
		$SOBAPSCode = empty(trim($data->SOBAPSCode)) ? NULL : trim($data->SOBAPSCode);
		$bDispense = empty(trim($data->bDispense)) ? 0 : trim($data->bDispense);

		$lan = trim($data->lan); 
		$UserName = trim($data->UserName);		
		
		try{

			$dbh = new Db();
			$aQuerys = array();
			
			
			$sql="SELECT RegionId, FLevelId  FROM `t_facility`  WHERE FacilityId=$RecordId";
			$result3=$dbh->query($sql);	 
			$OldRegionId=$result3[0]['RegionId'];
			$OldFLevelId=$result3[0]['FLevelId'];
					
			if ($bDispense == 0){
				
					$d4 = new deleteq();
					$d4->table = 't_transaction_items';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4; 

					$d4 = new deleteq();
					$d4->table = 't_transaction';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4; 

					$d4 = new deleteq();
					$d4->table = 't_orderbookitems';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4; 

					$d4 = new deleteq();
					$d4->table = 't_orderbook';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4;

					$d4 = new deleteq();
					$d4->table = 't_stocktakeitems';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4;

					$d5 = new deleteq();
					$d5->table = 't_stocktakemaster';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;
					
					
					
					$d5 = new deleteq();
					$d5->table = 'mv_cfm_stock';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d5 = new deleteq();
					$d5->table = 'mv_patients';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d5 = new deleteq();
					$d5->table = 'mv_tld_tle_mmd_patients';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d5 = new deleteq();
					$d5->table = 'mv_protocolpatients';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d5 = new deleteq();
					$d5->table = 't_patient_status_change';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;
					
					$d5 = new deleteq();
					$d5->table = 't_patient_by_month';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;
					
					$d5 = new deleteq();
					$d5->table = 'mv_patients_status';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d5 = new deleteq();
					$d5->table = 'mv_master';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;
					

				$sql = "SELECT PrescriptionId FROM t_prescription WHERE DemanderId=$FacilityId;";
				$Res = $dbh->query($sql);
				for($i=0;$i<count($Res);$i++ )  {
					$PrescriptionId=$Res[$i]['PrescriptionId'];					
					
					$d5 = new deleteq();
					$d5->table = 't_prescription_details';
					$d5->pks = ['PrescriptionId'];
					$d5->pk_values = [$PrescriptionId];
					$d5->build_query();
					$aQuerys[] = $d5;

				}

					$d5 = new deleteq();
					$d5->table = 't_prescription';
					$d5->pks = ['DemanderId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;


					$sql = "SELECT PatientId FROM t_patient WHERE FacilityId=$FacilityId;";
					$Res = $dbh->query($sql);
					for($i=0;$i<count($Res);$i++ )  {
						$PatientId=$Res[$i]['PatientId'];
						
						$d5 = new deleteq();
						$d5->table = 't_allergies';
						$d5->pks = ['PatientId'];
						$d5->pk_values = [$PatientId];
						$d5->build_query();
						$aQuerys[] = $d5;
						
						$d5 = new deleteq();
						$d5->table = 't_anthropometrics';
						$d5->pks = ['PatientId'];
						$d5->pk_values = [$PatientId];
						$d5->build_query();
						$aQuerys[] = $d5;
						
						$d5 = new deleteq();
						$d5->table = 't_labtestdetail';
						$d5->pks = ['PatientId'];
						$d5->pk_values = [$PatientId];
						$d5->build_query();
						$aQuerys[] = $d5;
	
					}


					$d5 = new deleteq();
					$d5->table = 't_patient';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					
					
					
					$d4 = new deleteq();
					$d4->table = 't_facility_product_lot';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4;

					$d5 = new deleteq();
					$d5->table = 't_facility_product';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;
					
					
	 
									


			}


			$u = new updateq();
            $u->table = 't_facility';
            $u->columns = ['RegionId', 'FTypeId', 'FLevelId', 'FacilityCode', 
			'FacilityName', 'FacilityAddress', 'FacilityPhone', 'FacilityEmail', 
			'Latitude', 'Longitude', 'ServiceAreaId', 'OwnerTypeId',
			'DistrictId', 'ExternalFacilityId', 'FacilityInCharge', 'ZoneId',  'SOBAPSCode', 'bDispense'];
            $u->values = [$RegionId, $FTypeId, $FLevelId, $FacilityCode, 
			$FacilityName, $FacilityAddress, $FacilityPhone, $FacilityEmail, 
			$lat, $lng, $ServiceAreaId, $OwnerTypeId, 
			$DistrictId, $ExternalFacilityId, $FacilityInCharge, $ZoneId, $SOBAPSCode, $bDispense];
            $u->pks = ['FacilityId'];
            $u->pk_values = [$FacilityId];
            $u->build_query();
            //$aQuerys = array($u);
            $aQuerys[] = $u;


			$res = exec_query($aQuerys, $UserName, $lan);  
			$success=($res['msgType']=='success')?1:0;
			$status=($res['msgType']=='success')?200:500;
			
			
			 
						
			// Insert t_facility_group_map  End
			
			
			$returnData = [
				"success" => $success ,
				"status" => $status,
				"UserName"=> $UserName,
				"message" => $res['msg']
			];

		}catch(PDOException $e){
			$returnData = msg(0,500,$e->getMessage());
		}
		
		return $returnData;
	}
}


function getFacilitySingleView($data) {
	
	$dbh = new Db();
	$FacilityId = trim($data->FacilityId);
	$query = "SELECT a.`FacilityId` id, a.`CountryId`, a.`RegionId`, a.`ZoneId`, a.`FTypeId`, a.`FLevelId`,
			a.`FacilityCode`, a.`FacilityName`, a.`FacilityAddress`, a.`FacilityPhone`, a.`FacilityEmail`, a.`Latitude`, a.`Longitude`,
			a.`DistrictId`, a.`ServiceAreaId`, a.`OwnerTypeId`, a.`ExternalFacilityId`, a.`FacilityInCharge`,
			a.`bDispense`, a.`SOBAPSCode`,  
	     `FacilityInCharge`,CONCAT(a.`Latitude`,',', a.`Longitude`) as location FROM `t_facility` a WHERE a.FacilityId = $FacilityId;"; 
	$returnData = $dbh->query($query);
	return $returnData[0];
}

function dataUpdate($data) {
	
	if($_SERVER["REQUEST_METHOD"] != "PUT"){
		return $returnData = msg(0,404,'Page Not Found!');
	}
	// CHECKING EMPTY FIELDS
	elseif(!isset($data->FacilityId)
		
	){
		$fields = ['fields' => ['FacilityId']];
		return $returnData = msg(0,422,'Please Fill in all Required Fields!', $fields);
	
	}else{

		$FacilityId = trim($data->FacilityId);
		$bDispense = trim($data->bDispense);
		$lan = trim($data->lan); 
		$UserName = trim($data->UserName);

		try{
 
			$dbh = new Db();

			if ($bDispense == true){
				$bDispenseVal = 1;
			}else{
				$bDispenseVal = 0;
 
					$d4 = new deleteq();
					$d4->table = 't_transaction_items';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4; 

					$d4 = new deleteq();
					$d4->table = 't_transaction';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4; 

					$d4 = new deleteq();
					$d4->table = 't_orderbookitems';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4; 

					$d4 = new deleteq();
					$d4->table = 't_orderbook';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4;


					$d4 = new deleteq();
					$d4->table = 't_stocktakeitems';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4;

					$d5 = new deleteq();
					$d5->table = 't_stocktakemaster';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;
					
					
					
					$d5 = new deleteq();
					$d5->table = 'mv_cfm_stock';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d5 = new deleteq();
					$d5->table = 'mv_patients';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d5 = new deleteq();
					$d5->table = 'mv_tld_tle_mmd_patients';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d5 = new deleteq();
					$d5->table = 'mv_protocolpatients';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					
					$d5 = new deleteq();
					$d5->table = 't_patient_status_change';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					
					$d5 = new deleteq();
					$d5->table = 't_patient_by_month';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d5 = new deleteq();
					$d5->table = 'mv_patients_status';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d5 = new deleteq();
					$d5->table = 'mv_master';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

				$sql = "SELECT PrescriptionId FROM t_prescription WHERE DemanderId=$FacilityId;";
				$Res = $dbh->query($sql);
				for($i=0;$i<count($Res);$i++ )  {
					$PrescriptionId=$Res[$i]['PrescriptionId'];					
					
					$d5 = new deleteq();
					$d5->table = 't_prescription_details';
					$d5->pks = ['PrescriptionId'];
					$d5->pk_values = [$PrescriptionId];
					$d5->build_query();
					$aQuerys[] = $d5;

				}

					$d5 = new deleteq();
					$d5->table = 't_prescription';
					$d5->pks = ['DemanderId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;


					$sql = "SELECT PatientId FROM t_patient WHERE FacilityId=$FacilityId;";
					$Res = $dbh->query($sql);
					for($i=0;$i<count($Res);$i++ )  {
						$PatientId=$Res[$i]['PatientId'];
						
						$d5 = new deleteq();
						$d5->table = 't_allergies';
						$d5->pks = ['PatientId'];
						$d5->pk_values = [$PatientId];
						$d5->build_query();
						$aQuerys[] = $d5;
						
						$d5 = new deleteq();
						$d5->table = 't_anthropometrics';
						$d5->pks = ['PatientId'];
						$d5->pk_values = [$PatientId];
						$d5->build_query();
						$aQuerys[] = $d5;
						
						$d5 = new deleteq();
						$d5->table = 't_labtestdetail';
						$d5->pks = ['PatientId'];
						$d5->pk_values = [$PatientId];
						$d5->build_query();
						$aQuerys[] = $d5;
	
					}


					$d5 = new deleteq();
					$d5->table = 't_patient';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d4 = new deleteq();
					$d4->table = 't_facility_product_lot';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4;

					$d5 = new deleteq();
					$d5->table = 't_facility_product';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;
					
					$d5 = new deleteq();
					$d5->table = 't_facility_group_map';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;


			}
			
			$q = new updateq();
			$q->table = 't_facility'; 
			$q->columns = ['bDispense'];
			$q->values = [$bDispenseVal];
			$q->pks = ['FacilityId'];
			$q->pk_values = [$FacilityId];
			$q->bUseInsetId = false;
			$q->build_query();
			$aQuerys[] = $q;

		

			//$res = exec_query($aQuerys, "admin", 'en_GB',false);  
 
			if($res['msgType']=='error'){			
				$res['msg']="Facility has relevant transaction records"; 
				return $res; 
			}


			// $returnData = [
			// 	"success" => 1 ,
			// 	"status" => 200,
			// 	"message" => $res['msg']
			// ];

			$res = exec_query($aQuerys, $UserName, $lan);  
			$success=($res['msgType']=='success')?1:0;
			$status=($res['msgType']=='success')?200:500;

			$returnData = [
				"success" => $success ,
				"status" => $status,
				"UserName"=> $UserName,
				"message" => $res['msg']
			];

		}catch(PDOException $e){
			$returnData = msg(0,500,$e->getMessage());
		}
		return $returnData;
		
	}

}


function deleteaFacility($data) {

	if($_SERVER["REQUEST_METHOD"] != "POST"){
		return $returnData = msg(0,404,'Page Not Found!');
	}
	// CHECKING EMPTY FIELDS
	elseif(!isset($data->FacilityId)){
		
		$fields = ['fields' => ['FacilityId']];
		return $returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);
		
	}else{
		
		$FacilityId = trim($data->FacilityId);
		$lan = trim($data->lan); 
		$UserName = trim($data->UserName);
		
		dataUpdate($data,1);

		try{

			$dbh = new Db();

			//start delete facility data

			$d4 = new deleteq();
					$d4->table = 't_transaction_items';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4; 

					$d4 = new deleteq();
					$d4->table = 't_transaction';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4; 

					$d4 = new deleteq();
					$d4->table = 't_orderbookitems';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4; 

					$d4 = new deleteq();
					$d4->table = 't_orderbook';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4;

					$d4 = new deleteq();
					$d4->table = 't_stocktakeitems';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4;

					$d5 = new deleteq();
					$d5->table = 't_stocktakemaster';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;
					
					
					
					$d5 = new deleteq();
					$d5->table = 'mv_cfm_stock';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d5 = new deleteq();
					$d5->table = 'mv_patients';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d5 = new deleteq();
					$d5->table = 'mv_tld_tle_mmd_patients';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

					$d5 = new deleteq();
					$d5->table = 'mv_protocolpatients';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

				

					$d5 = new deleteq();
					$d5->table = 't_patient_status_change';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;
					
					$d5 = new deleteq();
					$d5->table = 't_patient_by_month';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;
					

					$d5 = new deleteq();
					$d5->table = 'mv_patients_status';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;
					

					$d5 = new deleteq();
					$d5->table = 'mv_master';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;


				$sql = "SELECT PrescriptionId FROM t_prescription WHERE DemanderId=$FacilityId;";
				$Res = $dbh->query($sql);
				for($i=0;$i<count($Res);$i++ )  {
					$PrescriptionId=$Res[$i]['PrescriptionId'];					
					
					$d5 = new deleteq();
					$d5->table = 't_prescription_details';
					$d5->pks = ['PrescriptionId'];
					$d5->pk_values = [$PrescriptionId];
					$d5->build_query();
					$aQuerys[] = $d5;

				}

					$d5 = new deleteq();
					$d5->table = 't_prescription';
					$d5->pks = ['DemanderId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;


					$sql = "SELECT PatientId FROM t_patient WHERE FacilityId=$FacilityId;";
					$Res = $dbh->query($sql);
					for($i=0;$i<count($Res);$i++ )  {
						$PatientId=$Res[$i]['PatientId'];
						
						$d5 = new deleteq();
						$d5->table = 't_allergies';
						$d5->pks = ['PatientId'];
						$d5->pk_values = [$PatientId];
						$d5->build_query();
						$aQuerys[] = $d5;
						
						$d5 = new deleteq();
						$d5->table = 't_anthropometrics';
						$d5->pks = ['PatientId'];
						$d5->pk_values = [$PatientId];
						$d5->build_query();
						$aQuerys[] = $d5;
						
						$d5 = new deleteq();
						$d5->table = 't_labtestdetail';
						$d5->pks = ['PatientId'];
						$d5->pk_values = [$PatientId];
						$d5->build_query();
						$aQuerys[] = $d5;
	
					}


					$d5 = new deleteq();
					$d5->table = 't_patient';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;
					
					$d4 = new deleteq();
					$d4->table = 't_facility_product_lot';
					$d4->pks = ['FacilityId'];
					$d4->pk_values = [$FacilityId];
					$d4->build_query();
					$aQuerys[] = $d4;

					$d5 = new deleteq();
					$d5->table = 't_facility_product';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;
					
					$d5 = new deleteq();
					$d5->table = 't_facility_group_map';
					$d5->pks = ['FacilityId'];
					$d5->pk_values = [$FacilityId];
					$d5->build_query();
					$aQuerys[] = $d5;

			//end delete facility data
			
            $d = new deleteq();
            $d->table = 't_facility';
            $d->pks = ['FacilityId'];
            $d->pk_values = [$FacilityId];
            $d->build_query();
            //$aQuerys = array($d);
            $aQuerys[] = $d;

			

			$res = exec_query($aQuerys, $UserName, $lan);  
			$success=($res['msgType']=='success')?1:0;
			$status=($res['msgType']=='success')?200:500;

			$returnData = [
				"success" => $success ,
				"status" => $status,
				"UserName"=> $UserName,
				"message" => $res['msg']
			];
			
		}catch(PDOException $e){
			$returnData = msg(0,500,$e->getMessage());
		}
		
		return $returnData;
	}
}



function getFacilityCode($data) {
	
	try{
		$dbh = new Db();
		$CountryId = 1;
		
		$Query3 = "SELECT ISO3 AS ISO FROM `t_country` WHERE CountryId = '".$CountryId."'";
		$data1 = $dbh->query($Query3);
		$ISO = $data1[0]['ISO'];

		$Query2 = "SELECT MAX(CONVERT(SUBSTR(FacilityCode,4,8),UNSIGNED INTEGER))+1 AS M FROM t_facility WHERE CountryId = '" . $CountryId . "' ";
		$data2 = $dbh->query($Query2);
		$ItemCode = $data2[0]['M'];

		$padding = str_pad($ItemCode, 5, '0', STR_PAD_LEFT);
		$newItemCode = $ISO . $padding;

		$returnData = [
			"success" => 1,
			"status" => 200,
			"message" => "",
			"datalist" => $newItemCode
		];

	}catch(PDOException $e){
		$returnData = msg(0,500,$e->getMessage());
	}
	
	return $returnData;
	
}



function getProductGroupMapPopup($data) {

	try{

		$dbh = new Db(); 
		$userId =  empty(trim($data->userId)) ?  0:$data->userId;
		$FacilityId =  empty(trim($data->FacilityId)) ?  0:$data->FacilityId;  
 

	$query = "SELECT p.ItemGroupId `id`, p.GroupName `name`
	FROM t_itemgroup p	
	ORDER BY p.GroupName;";
 
		

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


function insertUpdateFacilityGroupMapPopup($data) {
	 
	 

	try{

		$dbh = new Db();

		$jUserId =  empty(trim($data->jUserId)) ?  0:$data->jUserId;
		$lan =  empty(trim($data->lan)) ?  0:$data->lan;
		$FacilityId =  empty(trim($data->FacilityId)) ?  0:$data->FacilityId;
		$StartMonthId =  empty(trim($data->MonthId)) ?  0:$data->MonthId;
		$StartYearId =  empty(trim($data->YearID)) ?  0:$data->YearID;
		$Supply_From =  empty(trim($data->Supply_From)) ?  0:$data->Supply_From;
		$GroupList = $data->GroupList;
		
		 

		if ($Supply_From == '' || $Supply_From == 'NULL') {
			$SupplyFrom = NULL;
		}else{
			$SupplyFrom = $Supply_From;
		}

		$msgType = 'All Product Group already entered';
		$msgType2 = 'Please, Select Product Group';		
		

		if ($Supply_From == '' || $Supply_From == 'NULL') {
			$SupplyFrom = NULL;
		}else{
			$SupplyFrom = $Supply_From;
		}
		
		 
		
		 

		$aQuerys = array();
		foreach ($GroupList as $keyItemGroupId => $ItemGroupId) { 
		$q = new insertq();
		$q->table = 't_facility_group_map';
		$q->columns = ['FacilityId', 'ItemGroupId', 'StartMonthId', 'StartYearId', 'SupplyFrom'];
		$q->values = [$FacilityId, $ItemGroupId, $StartMonthId, $StartYearId, $SupplyFrom];
		$q->pks = ['FacilityId'];
		$q->bUseInsetId = true;
		$q->build_query();
		// $aQuerys = array($q);
		$aQuerys[] = $q;
	    }
		 
        $res = exec_query($aQuerys, $jUserId, $lan);  
		$success=($res['msgType']=='success')?1:0;
		$status=($res['msgType']=='success')?200:500;
		$message=($res['msg']='New Data Added Successfully');
		$returnData = [
			"success" => 1,
			"status" => 200,
			"message" => $res['msg'],
			"datalist" => $resultdata
		];

	}catch(PDOException $e){
		$returnData = msg(0,500,$e->getMessage());
	}
	
	return $returnData;
	
	
        $bindings = array();

        $dbh = new Db();
		
        $jUserId = $data['params']['jUserId'];
        $language = $data['params']['lan'];
		$FacilityId = $data['params']['facilityId'];
		$StartMonthId = $data['params']['StartMonthIdPopup'];
		$StartYearId = $data['params']['StartYearIdPopup'];
		$Supply_From = $data['params']['SupplyFromPopup'];
		$multiselectPGroup = $data['params']['multiselectPGroup'];

		if ($Supply_From == '' || $Supply_From == 'NULL') {
			$SupplyFrom = NULL;
		}else{
			$SupplyFrom = $Supply_From;
		}

		$msgType = 'All Product Group already entered';
		$msgType2 = 'Please, Select Product Group';		
		
		if ($multiselectPGroup == '') {

			$sqls = "SELECT SQL_CALC_FOUND_ROWS a.ItemGroupId, GroupName, 1 bPatientInfo 
						FROM  t_itemgroup a
						INNER JOIN t_user_itemgroup_map b ON a.ItemGroupId = b.ItemGroupId
						 WHERE  t_facility_group_map.`FacilityId`= $FacilityId
						ORDER BY GroupName;";

			$result = $dbh->query($sqls);
			
			$resTotalLength = $dbh->query("SELECT FOUND_ROWS() TotalRows");
			$total = $resTotalLength[0]['TotalRows'];
			if ($total > 0) {
				$error = array("msgType" => "error", "msg" => $msgType2);	
				echo $_GET['callback'] . '(' . json_encode($error) . ')';
				return;
			}
			else {

				$error = array("msgType" => "error", "msg" => $msgType);	
				echo $_GET['callback'] . '(' . json_encode($error) . ')';
				return;
			}
		}
		
	 
    }
	*/
?>