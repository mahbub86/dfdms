<?php

include_once ('../env.php');
include_once ('../source/api/pdolibs/pdo_lib.php');

$tableProperties = array("header_list" => array(), "query_field" => array(), "table_header" => array(), "align" => array(), "width_print_pdf" => array(), "width_excel" => array(), "precision" => array(), "total" => array(), "report_save_name" => "");

$menukey = $_REQUEST['menukey'];
$lan = $_REQUEST['lan'];
include_once ('../source/api/languages/lang_switcher_custom.php');

if ($lan == 'en_GB') {
    $siteTitle = reportsitetitleeng;
} else if ($lan == 'fr_FR') {
    $siteTitle = reportsitetitlefr;
} 


$task = '';

if (isset($_POST['action'])) {
	$task = $_POST['action'];
} else if (isset($_GET['action'])) {
	$task = $_GET['action'];
}

switch($task){
	case "UnitOfMeasureExcelExport":
		UnitOfMeasureExcelExport();
		break;
		
	case "getExportOrdersBook":
		getExportOrdersBook();
		break;
		
	case "getExportOrdersBookApproval":
		getExportOrdersBookApproval();
		break;	
			
	case "getReceipts":
		getReceipts();
		break;
		
	case "getIssueData":
		getIssueData();
		break;
			
	case "getDispense":
		getDispense();
		break;
		
	case "getProtocole":
		getProtocole();
		break;
		
	case "getAdjustment":
		getAdjustment();
		break;
		
	case "getRepacking":
		getRepacking();
		break;
	
	case "getStockTake":
		getStockTake();
		break;
    
    case "PatientExcelExport":
        PatientExcelExport();
        break;
	case "getdirectionlist":
			getdirectionlist();
		break;
	case "getprescriberList":
			getprescriberList();
		break;	
	case "getdispenserList":
			getdispenserList();
		break;
	
    case "StockMasterExcelExport":
        StockMasterExcelExport();
        break;
		
    case "ProductsListExport":
        ProductsListExport();
        break;
		
	case "getIntervalList":
        getIntervalList();
        break;
		
	case "LebTestExport":
        LebTestExport();
        break;	
		
	case "LebTestListExport":
        LebTestListExport();
        break;
		
	case "RouteOfAdminExport":
        RouteOfAdminExport();
        break;
		
	case "OrderTypeExport":
        OrderTypeExport();
        break;
		
	case "PatientcoinfectionExport":
        PatientcoinfectionExport();
        break;
		
	case "KeypopulationtypeExport":
        KeypopulationtypeExport();
        break;
		
	case "TitleListExport":
        TitleListExport();
        break;

	case "CohortTypeExport":
		CohortTypeExport();
		break;	
		
	case "MaritalStatusExport":
        MaritalStatusExport();
        break;
		
	case "AbcExport":
        AbcExport();
        break;
		
	case "PostExport":
        PostExport();
        break;
		
	case "SpecialisationExport":
        SpecialisationExport();
        break;
		
   case "AdjustTypeExport":
        AdjustTypeExport();
        break;
		
	case "LanguageExport":
        LanguageExport();
        break;
		
	case "PacksizeExport":
        PacksizeExport();
        break;
		
	case "formExport":
        formExport();
        break;
		
	case "StrengthExport":
        StrengthExport();
        break;
		
	case "FacilityExport":
        FacilityExport();
        break;	
				
	case "RoleExport":
        RoleExport();
        break;
		
	case "getUserList":
        getUserList();
        break;	
		
	case "GenericsExport":
        GenericsExport();
        break;

	case "MOSRangeExport":
		MOSRangeExport();
		break;
		
	case "LocationExport":
        LocationExport();
        break;
			
	case "ATCExport":
		ATCExport();
		break;

	case "FacilityEntryExport":
		FacilityEntryExport();
		break;
		
	case "SourceExport":
		SourceExport();
		break;
		
		
	case "getPrescriptionWithPatient":
		getPrescriptionWithPatient();
		break;
		
		
	case "AvailabilityOfCommodities":
		AvailabilityOfCommodities();
		break;
		
	case "MmdCoverageBysite":
		MmdCoverageBysite();
		break;
		
	case "StockSummaryExcelExport":
		StockSummaryExcelExport();
		break;
		
	case "LMISReportExcelExport":
		LMISReportExcelExport();
		break;

	case "LabLMISReportExcelExport":
		LabLMISReportExcelExport();
		break;
		
	case "ProductsNearingExpiryReportExcelExport":
		ProductsNearingExpiryReportExcelExport();
		break;
		
	case "LtfuBackReportExcelExport":
		LtfuBackReportExcelExport();
		break;
		
	case "PreEPPatientsReportExcelExport":
		PreEPPatientsReportExcelExport();
		break;
		
	case "PatientReportUnderIOExcelExport":
		PatientReportUnderIOExcelExport();
		break;
		
	case "LTFULosttoSightReportExport":
		LTFULosttoSightReportExport();
		break;
		
	case "MissedAppointmentswithDaysPrecisionReportExport":
		MissedAppointmentswithDaysPrecisionReportExport();
		break;
		
		
	case "KeyPopulationsActiveQueueReportExport":
		KeyPopulationsActiveQueueReportExport();
		break;
		
	case "InformationSheetForPLHIVPatientsOnINHProphylaxisExport":
		InformationSheetForPLHIVPatientsOnINHProphylaxisExport();
		break;
		
	case "RegimenExport":
		RegimenExport();
		break;	
		
	case "AgeGroupExport":
        AgeGroupExport();
        break;
		
	case 'getYearEntryData':
		getYearEntryData();
		break;
		
	case "LabStockSummaryExcelExport":
		LabStockSummaryExcelExport();
		break;
				
	case "AvailabilityOfLabCommodities":
		AvailabilityOfLabCommodities();
		break;
		
				
	case "LabLMISReportExport":
		LabLMISReportExport();
		break;
		
	default :
		echo "{failure:true}";
		break;
}

function AvailabilityOfCommodities() {

	global $sql, $tableProperties, $TEXT, $siteTitle;
	
	$FacilityId = $_REQUEST['FacilityId'];
	$Month = $_REQUEST['Month'];
	$Year = $_REQUEST['Year'];

	$sql = "select ProductSubGroupId itemgroupserial, ItemCode, ItemName itemgroupname, 
		count(case when total<=0 then 1 end)*100/count(total) totalzero, 
		count(case when total>0 then 1 end)*100/count(total) totalnonzero, 
		'Not Available' ZERO, 'Available' NONZERO,
		(CASE WHEN IFNULL(total,0)>0 THEN 'Available' ELSE 'Not Available' END) Availability,
		x.total
		
		from (
			
			 


		SELECT b.SortOrder ProductSubGroupId, SUM(a.`Stock`) total , ItemCode, ItemName, FacilityId
		FROM `mv_cfm_stock` a 
		INNER JOIN t_itemlist_master b ON a.ItemNo=b.ItemNo
		WHERE 
		(a.FacilityId = $FacilityId OR $FacilityId=0) AND
		(a.Year = $Year OR $Year=0) AND
		(a.MonthId = $Month OR $Month=0)
		GROUP BY  ItemCode,ItemName,FacilityId 

		) x
		group by itemgroupserial, itemgroupname ORDER BY itemgroupname"; 
	
    $tableProperties["query_field"] = array("ItemCode","itemgroupname","Availability","total");
    $tableProperties["table_header"] = array($TEXT['Product Code'],$TEXT['Product Name'],$TEXT['Availability'],$TEXT['Total Balance']);
    $tableProperties["align"] = array("left","left","left","right");
    $tableProperties["width_print_pdf"] = array("20%","40%","20%","15%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("20","60","30","20");
    $tableProperties["precision"] = array("string","string","string",0); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Availability of commodities'];
	
	$db = new Db();
	$n_sql = "SELECT MonthNameFrench, (SELECT FacilityName FROM t_facility WHERE `FacilityId` = $FacilityId) FacilityName FROM `t_month` WHERE `MonthId` = $Month";
	
	$header_title = $db->query($n_sql);
	
	if($FacilityId==0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName	= $header_title[count($header_title)-1]["FacilityName"];
	}
	
	$MonthNameFrench	= $header_title[count($header_title)-1]["MonthNameFrench"];
	
	$tableProperties["header_list"][2] = $MonthNameFrench.", ".$Year;
	$tableProperties["header_list"][3] = $FacilityName;
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Availability_of_commodities_';
}

function AvailabilityOfLabCommodities() {

	global $sql, $tableProperties, $TEXT, $siteTitle;
	
	$FacilityId = $_REQUEST['FacilityId'];
	$Month = $_REQUEST['Month'];
	$Year = $_REQUEST['Year'];

	 $sql = "select ProductSubGroupId itemgroupserial, ItemCode, ItemName itemgroupname, 
	count(case when total<=0 then 1 end)*100/count(total) totalzero, 
	count(case when total>0 then 1 end)*100/count(total) totalnonzero, 
	'Not Available' ZERO, 'Available' NONZERO,
	(CASE WHEN IFNULL(total,0)>0 THEN 'Available' ELSE 'Not Available' END) Availability,
	x.total
	from (SELECT b.SortOrder ProductSubGroupId, SUM(a.`Stock`) total , ItemCode, ItemName, FacilityId
	FROM `mv_quarter_cfm_stock` a 
	INNER JOIN t_itemlist_master b ON a.ItemNo=b.ItemNo
	WHERE 
	(a.FacilityId = $FacilityId OR $FacilityId=0) AND
	(a.Year = $Year OR $Year=0) AND
	(a.MonthId = $Month OR $Month=0)
	GROUP BY  ItemCode,ItemName,FacilityId 

	) x
	group by itemgroupserial, itemgroupname ORDER BY itemgroupname"; 
	
    $tableProperties["query_field"] = array("ItemCode","itemgroupname","Availability","total");
    $tableProperties["table_header"] = array($TEXT['Product Code'],$TEXT['Product Name'],$TEXT['Availability'],$TEXT['Total Balance']);
    $tableProperties["align"] = array("left","left","left","right");
    $tableProperties["width_print_pdf"] = array("10%","65%","10%","10%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("15","33","22","10");
    $tableProperties["precision"] = array("string","string","string",0); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Availability of Lab commodities'];
	
	$db = new Db();
	$n_sql = "SELECT MonthName, (SELECT FacilityName FROM t_facility WHERE `FacilityId` = $FacilityId) FacilityName FROM `t_quarter` WHERE `MonthId` = $Month";
	
	$header_title = $db->query($n_sql);
	
	if($FacilityId==0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName	= $header_title[count($header_title)-1]["FacilityName"];
	}
	
	$MonthName	= $header_title[count($header_title)-1]["MonthName"];
	
	$tableProperties["header_list"][2] = $MonthName.", ".$Year;
	$tableProperties["header_list"][3] = $FacilityName;
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Availability_of_Lab_commodities_';
}


function LabLMISReportExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;
	
	$FacilityId = empty($_REQUEST['FacilityId']) ?  0 : $_REQUEST['FacilityId'];
	$startDate = date('Y-m-d', strtotime($_REQUEST['StartDate']));
	$endDate = date('Y-m-d', strtotime($_REQUEST['EndDate']));
	$LabTestId = $_REQUEST['LabTestId'];
	

		$sql = "SELECT 
		 a.`FacilityId`,
		 d.`FacilityName`,
		 b.`TestId`,
		 c.`TestName`,
		 COUNT(b.`TransactionItemId`) AS TestCount
		
	   FROM
		 `t_test_lab_master` a
		 INNER JOIN `t_test_lab_items` b ON a.`TransactionId` = b.`TransactionId` AND a.`FacilityId` = b.`FacilityId`
		 INNER JOIN `t_test` c ON b.`TestId` = c.`TestId`
		 INNER JOIN `t_facility` d ON a.`FacilityId` = d.`FacilityId`
		 WHERE (a.FacilityId = $FacilityId OR $FacilityId=0) 
		 AND DATE(a.`TransactionDate`) BETWEEN '$startDate' AND '$endDate'
		 AND (b.TestId = $LabTestId OR $LabTestId=0)
		 GROUP BY  a.`FacilityId`, d.`FacilityName`, b.`TestId`, c.`TestName`
		 ORDER BY d.`FacilityName`, c.`TestName` ASC"; 
	

    $tableProperties["query_field"] = array("FacilityName","TestName","TestCount");
    $tableProperties["table_header"] = array($TEXT['Facility'],$TEXT['Test Name'],$TEXT['Test Count']);
   
	$tableProperties["align"] = array("left","left","right");
    $tableProperties["width_print_pdf"] = array("35%","35%","20%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("45","50","40");
    $tableProperties["precision"] = array("string","string",0); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	$db = new Db();
	$n_sql = "SELECT TestName, (SELECT FacilityName FROM t_facility WHERE `FacilityId` = $FacilityId) FacilityName FROM `t_test` WHERE `TestId` = $LabTestId";
	
	$header_title = $db->query($n_sql);
	
	if($FacilityId==0){
		$FacilityName = $TEXT['All'];
	}else{
	   $FacilityName	= $header_title[count($header_title)-1]["FacilityName"];
	}

		
	if($LabTestId==0){
		$TestName = $TEXT['All'];
	}else{
	   $TestName	= $header_title[count($header_title)-1]["TestName"];
	}
	

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Laboratory Activity Report'];
	$tableProperties["header_list"][2] = $TEXT['From'].": ".date('d/m/Y', strtotime($_REQUEST['StartDate'])).", ".$TEXT['To'].": ".date('d/m/Y', strtotime($_REQUEST['EndDate']));
	$tableProperties["header_list"][3] = $TEXT['Facility'].": ".$FacilityName.", ".$TEXT['Lab Test'].": ".$TestName;

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = "Laboratory_Activity_Report";
}


function MmdCoverageBysite() {

	global $sql, $tableProperties, $TEXT, $siteTitle;
	
	$FacilityId = $_REQUEST['FacilityId'];
	$MonthId = $_REQUEST['MonthId'];
	$YearId = $_REQUEST['YearId'];


	$sql = "SELECT b.FacilityName,a.FacilityId, 

	IFNULL(a.`ThreeMonthMMD`,0) AS ThreeMonthMMD,
	IFNULL(a.`FiveMonthMMD`,0) AS FiveMonthMMD,
	IFNULL(a.`SixMonthMMD`,0) AS SixMonthMMD
	
	FROM `mv_tld_tle_mmd_patients` a
	INNER JOIN t_facility b ON a.FacilityId=b.FacilityId
	WHERE a.YearId = '$YearId'
	AND a.MonthId = $MonthId
	AND (a.FacilityId = $FacilityId OR $FacilityId=0)
	ORDER BY b.FacilityName, a.FacilityId;";

    $tableProperties["query_field"] = array("FacilityName","ThreeMonthMMD","FiveMonthMMD","SixMonthMMD");
    $tableProperties["table_header"] = array($TEXT['Facility'],$TEXT['Less 3 months'],$TEXT['3-5 months'],$TEXT['6 plus months']);
    $tableProperties["align"] = array("left","right","right","right");
    $tableProperties["width_print_pdf"] = array("40%","20%","20%","20%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60","20","20","20");
    $tableProperties["precision"] = array("string",0,0,0); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = 'MMD Coverage by site';
	
	$db = new Db();
	$n_sql = "SELECT MonthNameFrench, (SELECT FacilityName FROM t_facility WHERE `FacilityId` = $FacilityId) FacilityName FROM `t_month` WHERE `MonthId` = $MonthId";
	
	$header_title = $db->query($n_sql);
	
	if($FacilityId==0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName	= $header_title[count($header_title)-1]["FacilityName"];
	}
	
	$MonthNameFrench	= $header_title[count($header_title)-1]["MonthNameFrench"];
	
	$tableProperties["header_list"][2] = $MonthNameFrench.", ".$YearId;
	$tableProperties["header_list"][3] = $FacilityName;
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'MMD_Coverage_by_site_';
}


function getPrescriptionWithPatient() {

	global $sql, $tableProperties, $TEXT, $siteTitle;
	

	$FacilityId = empty($_REQUEST['FacilityId']) ?  0 : $_REQUEST['FacilityId'];
	$isDefaulterPrescription = $_REQUEST['isDefaulterPrescription'];
	$ToggleButtonValue = $_REQUEST['toggleButtonValue'];
	$CurrDate = $_REQUEST['currDate'];

	  
	  $PatientId = 0;
	  $dateFilter="";
	  	if($ToggleButtonValue == 1){
			// $CurrDate = date('Y-m-d');
			$CurrDate = date('Y-m-d', strtotime(trim($CurrDate)));
			$dateFilter=" and ((a.`PrescriptionDate` = '$CurrDate') OR (a.`AppointmentDate` = '$CurrDate') OR (a.`PostDate` = '$CurrDate')) ";
			
			// $dateFilter=" and a.`AppointmentDate` = '$CurrDate' ";
			$PatientId = 0; //when select Today patient Tab then show all patients prescription of today
		}
		else if($ToggleButtonValue == 2){
			/* if(isset($_REQUEST['StartDate']) && isset($_REQUEST['EndDate'])){
				$fromDate = date('Y-m-d', strtotime(trim($_REQUEST['StartDate'])));
				$toDate = date('Y-m-d', strtotime(trim($_REQUEST['EndDate'])));

				if($isDefaulterPrescription=='true'){
					$dateFilter=" and (a.`AppointmentDate` between '$fromDate' and '$toDate') ";
				}else{
					$dateFilter=" and ((a.`PrescriptionDate` between '$fromDate' and '$toDate') OR (a.`AppointmentDate` between '$fromDate' and '$toDate') OR (a.`PostDate` between '$fromDate' and '$toDate')) ";
				}
			} */
			$PatientId = isset($_REQUEST['PatientId']) ? $_REQUEST['PatientId'] : -1; //when pratient null then no need prescription
		}
		else if($ToggleButtonValue == 3){
			if(isset($_REQUEST['StartDate']) && isset($_REQUEST['EndDate'])){
				$fromDate = date('Y-m-d', strtotime(trim($_REQUEST['StartDate'])));
				$toDate = date('Y-m-d', strtotime(trim($_REQUEST['EndDate'])));
				if($isDefaulterPrescription=='true'){
					$dateFilter=" and (a.`AppointmentDate` between '$fromDate' and '$toDate') ";
				}else{
					$dateFilter=" and ((a.`PrescriptionDate` between '$fromDate' and '$toDate') OR (a.`AppointmentDate` between '$fromDate' and '$toDate') OR (a.`PostDate` between '$fromDate' and '$toDate')) ";
				}
				
			}
			$PatientId = 0; //when select Prescription by date Tab then show all patients prescription of date range
		}

	  

		$defaulterFilter = "";
		if($isDefaulterPrescription=='true'){
			$defaulterFilter = " and a.StatusId = -1 ";
		}
		if($isDefaulterPrescription=='true'){
			$defaulter =", ".$TEXT['Defaulter'];
		}

		//For Appointment Date Desc and Blank Appointment Date ASC
		$AppointmentDateForOrderBy = date("Y-m-d", strtotime("+10 years"));

	
	   $sql = "SELECT a.`PrescriptionId`, a.`PrescriptionNumbar`, a.`PatientId`, a.`DemanderId`, 
		a.`PrescriberId`, CONCAT(aa.firstName,' ',aa.lastName) AS prescriberName, 
		a.`ClinicId`, a.`DispenserId`, a.`PrescriptionDate`,a.AppointmentDate, 
		a.`bReferred`, a.`bNew`, a.`bPregnant`, a.`StatusId`,

		CASE
		WHEN RepeatFromPrescriptionId > 0 THEN CONCAT('".$TEXT['Repeated']."','-',s.StatusName)
		ELSE s.StatusName
		END StatusName, 

		a.`Repeats`, a.`TotalAmount` ,aaa.pass AS pass, CONCAT(aaa.firstName,' ',aaa.lastName) AS patientName,
		 aaa.contactNumber AS patientContactNumber, 
		 a.RepeatFromPrescriptionId, aaa.idNumber, aaa.ipn,a.PostDate
		FROM `t_prescription` a 
		INNER JOIN t_prescriber aa ON a.PrescriberId = aa.PrescriberId 
		INNER JOIN t_patient aaa ON a.PatientId = aaa.PatientId 
		INNER JOIN t_status s ON a.StatusId = s.StatusId
		where (a.`PatientId` = $PatientId OR $PatientId=0)
		and a.`DemanderId` = '$FacilityId'
		$dateFilter $defaulterFilter
		ORDER BY ifnull (a.AppointmentDate, '$AppointmentDateForOrderBy') desc, a.`PrescriptionId` desc;";	  

	$db = new Db();
	$sqlFaci = "SELECT `FacilityName` FROM `t_facility` WHERE FacilityId = $FacilityId";
	$header_title = $db->query($sqlFaci);
	$FacilityName	= $header_title[count($header_title)-1]["FacilityName"];

    $tableProperties["query_field"] = array("AppointmentDate","PrescriptionNumbar","idNumber","pass","ipn","patientName","patientContactNumber","prescriberName","StatusName","Repeats","PrescriptionDate","PostDate");
    $tableProperties["table_header"] = array($TEXT['Appointment Date'],$TEXT['Prescription#'],$TEXT['Register'],$TEXT['PAS#'],$TEXT['IPN#'],$TEXT['Patient Name'],$TEXT['Contact#'],$TEXT['Prescriber'],$TEXT['Status'],$TEXT['Rep'],$TEXT['Prescription Date'],$TEXT['Post Date']);
    $tableProperties["align"] = array("left","left","left","left","left","left","left","left","left","right","left","left");
    $tableProperties["width_print_pdf"] = array("8%","8%","8%","7%","7%","8%","8%","12%","10%","4%","8%","8%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("20","20","12","12","12","18","18","18","20","12","20","15");
    $tableProperties["precision"] = array("date","string","string","string","string","string","string","string","string",0,"date","date"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Prescription'];
	if($ToggleButtonValue == 3){
		$tableProperties["header_list"][2] = $TEXT['From'].": ".date('d/m/Y', strtotime($_REQUEST['StartDate'])).", ".$TEXT['To'].": ".date('d/m/Y', strtotime($_REQUEST['EndDate'])).$defaulter;
		$tableProperties["header_list"][3] = $TEXT['Facility'].": ".$FacilityName;
	}else{
		$tableProperties["header_list"][2] = $TEXT['Facility'].": ".$FacilityName;
	}

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = $TEXT['Prescription'];
}

function RoleExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT a.`id`, a.`role`, a.`defaultredirect`, a.`ItemGroupId`, b.`GroupName` FROM roles a
	INNER JOIN `t_itemgroup` b ON a.`ItemGroupId` = b.`ItemGroupId`
	ORDER BY role ASC;"; 
	
    $tableProperties["query_field"] = array("role","defaultredirect","GroupName");
    $tableProperties["table_header"] = array($TEXT['Role Name'],$TEXT['Default Redirect'],$TEXT['Product Group']);
    $tableProperties["align"] = array("left","left","left");
    $tableProperties["width_print_pdf"] = array("35%","35%","30%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("40","40","40");
    $tableProperties["precision"] = array("string","string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Role List'];
	// $tableProperties["header_list"][2] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Role_Entry_Form_';
}

function UnitOfMeasureExcelExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT UnitName FROM t_unitofmeas ORDER BY UnitName;"; 
	
    $tableProperties["query_field"] = array("UnitName");
    $tableProperties["table_header"] = array($TEXT['Unit Name']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Unit Of Measure List'];
	// $tableProperties["header_list"][2] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Unit_Of_Measure_Entry_Form';
}

function getAdjustment() {

	global $sql, $tableProperties, $TEXT, $siteTitle;
	
	$FacilityId = $_REQUEST['FacilityId'];
	$startDate = date('Y-m-d', strtotime($_REQUEST['StartDate']));
	$endDate = date('Y-m-d', strtotime($_REQUEST['EndDate']));
	$ItemGroupId = $_REQUEST['ItemGroupId'];

	$sql = "SELECT DATE(`TransactionDate`) TransactionDate,`TransactionNo`,`SupplierInvNo`,
         DATE(`SupplierInvDate`) SupplierInvDate,TransactionId id,a.FacilityId,OrderNo,OrderDate
         ,CASE WHEN bStockUpdated=0 THEN 'Draft' ELSE 'Posted' END bStockUpdated, c.AdjType,
         (SELECT SUM(LineTotalPrice) FROM t_transaction_items WHERE t_transaction_items.FacilityId=a.FacilityId
          AND t_transaction_items.TransactionId=a.TransactionId) Amount,
          d.FacilityName to_from,e.FacilityName receive_from,
		  (CASE WHEN g.IssuedToName IS NOT NULL THEN g.IssuedToName WHEN d.FacilityName IS NOT NULL THEN d.FacilityName ELSE s.SupplierName END) Recipient
         FROM t_transaction a LEFT JOIN t_orderbook b ON a.OrderId=b.OrderId 
         LEFT JOIN t_adj_type c ON a.AdjTypeId = c.AdjTypeId
         LEFT JOIN t_facility d ON a.IssuedToFacility=d.FacilityId
         LEFT JOIN t_facility e ON a.ReceiveFrom=d.FacilityId
		 LEFT JOIN t_issuedto g ON a.IssuedTo = g.IssuedToId 
		 LEFT JOIN t_supplier s ON a.SupplierId = s.SupplierId
         
         WHERE  a.TransactionTypeId = 3 
		 AND a.FacilityId = '$FacilityId'
         AND DATE(`TransactionDate`) BETWEEN '$startDate' AND '$endDate'
		 AND a.AdjTypeId <> 7
		 AND a.ItemGroupId = $ItemGroupId
         ORDER BY DATE(a.TransactionDate) DESC,TransactionNo DESC"; 
	
   /*  $tableProperties["query_field"] = array("TransactionDate","TransactionNo","AdjType","Recipient","Amount","bStockUpdated");
    $tableProperties["table_header"] = array($TEXT['Adj. Date'],$TEXT['Adj. Invoice No'],$TEXT['Adj. Type'],$TEXT['To_From'],$TEXT['Amount (CFA)'], $TEXT['Status']);
    */
    $tableProperties["query_field"] = array("TransactionDate","TransactionNo","AdjType","Recipient","bStockUpdated");
    $tableProperties["table_header"] = array($TEXT['Adj. Date'],$TEXT['Adj. Invoice No'],$TEXT['Adj. Type'],$TEXT['To_From'], $TEXT['Status']);
   
	$tableProperties["align"] = array("left","left","left","left","left");
    $tableProperties["width_print_pdf"] = array("10%","15%","25%","20%","10%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("16","25","45","25","16");
    $tableProperties["precision"] = array("date","string","string","string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	$db = new Db();
	$n_sql2 = "SELECT `GroupName` FROM `t_itemgroup` WHERE `ItemGroupId` = $ItemGroupId";
	$header_title2 = $db->query($n_sql2);
	$GroupName	=  $TEXT['Product Group'].': '.$header_title2[count($header_title2)-1]["GroupName"];


	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Adjustment'];
	$tableProperties["header_list"][2] = $TEXT['From'].": ".date('d/m/Y', strtotime($_REQUEST['StartDate'])).", ".$TEXT['To'].": ".date('d/m/Y', strtotime($_REQUEST['EndDate']));
	$tableProperties["header_list"][3] = $TEXT['Facility'].": ".$_REQUEST['FacilityName'].", ".$GroupName;

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = $TEXT['Adjustment'];
}

function getRepacking() {

	global $sql, $tableProperties, $TEXT, $siteTitle;
	
	$FacilityId = $_REQUEST['FacilityId'];
	$startDate = date('Y-m-d', strtotime($_REQUEST['StartDate']));
	$endDate = date('Y-m-d', strtotime($_REQUEST['EndDate']));
	$ItemGroupId = $_REQUEST['ItemGroupId'];

	$sql = "SELECT DATE(`TransactionDate`) TransactionDate,`TransactionNo`,`SupplierInvNo`,
         DATE(`SupplierInvDate`) SupplierInvDate,TransactionId id,a.FacilityId,OrderNo,OrderDate
         ,CASE WHEN bStockUpdated=0 THEN 'Draft' ELSE 'Posted' END bStockUpdated, c.AdjType,
         (SELECT SUM(LineTotalPrice) FROM t_transaction_items WHERE t_transaction_items.FacilityId=a.FacilityId
          AND t_transaction_items.TransactionId=a.TransactionId) Amount,
          d.FacilityName to_from,e.FacilityName receive_from,
		  (CASE WHEN g.IssuedToName IS NOT NULL THEN g.IssuedToName WHEN d.FacilityName IS NOT NULL THEN d.FacilityName ELSE s.SupplierName END) Recipient
         FROM t_transaction a LEFT JOIN t_orderbook b ON a.OrderId=b.OrderId 
         LEFT JOIN t_adj_type c ON a.AdjTypeId = c.AdjTypeId
         LEFT JOIN t_facility d ON a.IssuedToFacility=d.FacilityId
         LEFT JOIN t_facility e ON a.ReceiveFrom=d.FacilityId
		 LEFT JOIN t_issuedto g ON a.IssuedTo = g.IssuedToId 
		 LEFT JOIN t_supplier s ON a.SupplierId = s.SupplierId
         
         WHERE  a.TransactionTypeId = 3 
		 AND a.FacilityId = '$FacilityId'
         AND DATE(`TransactionDate`) BETWEEN '$startDate' AND '$endDate'
		 AND a.AdjTypeId = 7
		 AND a.ItemGroupId = $ItemGroupId
         ORDER BY DATE(a.TransactionDate) DESC,TransactionNo DESC"; 
	
   /*  $tableProperties["query_field"] = array("TransactionDate","TransactionNo","AdjType","Recipient","Amount","bStockUpdated");
    $tableProperties["table_header"] = array($TEXT['Adj. Date'],$TEXT['Adj. Invoice No'],$TEXT['Adj. Type'],$TEXT['To_From'],$TEXT['Amount (CFA)'], $TEXT['Status']);
    */
    $tableProperties["query_field"] = array("TransactionDate","TransactionNo","AdjType","Recipient","bStockUpdated");
    $tableProperties["table_header"] = array($TEXT['Adj. Date'],$TEXT['Adj. Invoice No'],$TEXT['Adj. Type'],$TEXT['To_From'], $TEXT['Status']);
   
	$tableProperties["align"] = array("left","left","left","left","left");
    $tableProperties["width_print_pdf"] = array("10%","15%","25%","20%","10%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("16","25","45","25","16");
    $tableProperties["precision"] = array("date","string","string","string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	//Report header list

	$db = new Db();
	$n_sql2 = "SELECT `GroupName` FROM `t_itemgroup` WHERE `ItemGroupId` = $ItemGroupId";
	$header_title2 = $db->query($n_sql2);
	$GroupName	=  $TEXT['Product Group'].': '.$header_title2[count($header_title2)-1]["GroupName"];


	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Repacking'];
	$tableProperties["header_list"][2] = $TEXT['From'].": ".date('d/m/Y', strtotime($_REQUEST['StartDate'])).", ".$TEXT['To'].": ".date('d/m/Y', strtotime($_REQUEST['EndDate']));
	$tableProperties["header_list"][3] = $TEXT['Facility'].": ".$_REQUEST['FacilityName'].", ".$GroupName;

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Repacking';
}

function getProtocole() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	 $sql = "SELECT a.`id`, a.`ProtocolId`, `ItemNo`, `ItemShortName`, a.`AdministrationUnit`, `formulationQty`, 
	 a.`IntervalId`, `Duration`, `CalcQty`, `productQty`, a.`DirectionId`, `packs`, `ICDCode`,
	 `bp`, `instructions`, `instructionsDesc`, `warnings`, b.code, b.protocolName,c.DoseInterval,
	 e.UnitName, d.DirectionName, b.protocolShortName,
	 (CASE WHEN b.protocolType = 'None' THEN '".$TEXT['None']."' ELSE b.protocolType END) protocolType,
	 f.RegimenName
	 
	FROM 
	`t_protocol_items` a
	INNER JOIN t_protocol b ON a.ProtocolId=b.ProtocolId
	INNER JOIN t_doseinterval c ON a.IntervalId=c.IntervalId
	INNER JOIN t_direction d ON a.DirectionId=d.DirectionId
	INNER JOIN t_unitofmeas e ON a.AdministrationUnit=e.UnitId
	INNER JOIN t_regimen f ON b.RegimenId =  f.RegimenId
	 ORDER BY b.code, b.protocolName"; 

	
    $tableProperties["query_field"] = array("code","RegimenName","protocolName","protocolShortName","ItemShortName","protocolType","formulationQty","UnitName","DoseInterval","Duration","CalcQty","DirectionName");
    $tableProperties["table_header"] = array($TEXT['Code'],$TEXT['Regimen'],$TEXT['Protocol Name'],$TEXT['Protocol Short Name'],$TEXT['Product Description'],$TEXT['ProtocolType'],$TEXT['Qty'],$TEXT['UoM'],$TEXT['Int'],$TEXT['Dur'],$TEXT['Calc'],$TEXT['Dir']);
    $tableProperties["align"] = array("left","left","left","left","left","left","right","left","left","right","right","left");
    $tableProperties["width_print_pdf"] = array("10%","10%","10%","10%","5%","15%","10%","5%","5%","5%","5%","5%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("12","15","25","20","77","15","10","13","10","10","10","20");
    $tableProperties["precision"] = array("string","string","string","string","string","string",0,"string","string",0,0,"string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Protocol'];

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Regimen_';
}

function getReceipts() {

	global $sql, $tableProperties, $TEXT, $siteTitle;
	
	$FacilityId = $_REQUEST['FacilityId'];
	$startDate = date('Y-m-d', strtotime($_REQUEST['StartDate']));
	$endDate = date('Y-m-d', strtotime($_REQUEST['EndDate']));
	$ItemGroupId = $_REQUEST['ItemGroupId'];

	$sql = "SELECT DATE(`TransactionDate`) TransactionDate,`TransactionNo`,`SupplierInvNo`,
         DATE(`SupplierInvDate`) SupplierInvDate,TransactionId id,a.FacilityId,OrderNo,DATE(`OrderDate`) OrderDate,CASE WHEN bStockUpdated=0 THEN 'Draft' ELSE 'Posted' END bStockUpdated 
         FROM t_transaction a LEFT JOIN t_orderbook b ON a.OrderId=b.OrderId 
		 WHERE 1=1 AND a.TransactionTypeId = 1 
		 AND a.FacilityId = $FacilityId 
         AND DATE(`TransactionDate`) BETWEEN '$startDate' AND '$endDate'
		 AND a.ItemGroupId = $ItemGroupId
        ORDER BY DATE(a.TransactionDate) DESC"; 
	
    $tableProperties["query_field"] = array("TransactionDate","TransactionNo","OrderNo","OrderDate","SupplierInvDate", "SupplierInvNo","bStockUpdated");
    $tableProperties["table_header"] = array($TEXT['Receive Date'],$TEXT['Receive Invoice No'],$TEXT['Order No'],$TEXT['Order Date'], $TEXT['Supplier Date'], $TEXT['Supplier Invoice No'],$TEXT['Status']);
    $tableProperties["align"] = array("left","left","left","left","left","left","left");
    $tableProperties["width_print_pdf"] = array("10%","15%","20%","10%","10%","15%","10%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("16","25","25","16","16","25","16");
    $tableProperties["precision"] = array("date","string","string","date","date","string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    $db = new Db();
	$n_sql2 = "SELECT `GroupName` FROM `t_itemgroup` WHERE `ItemGroupId` = $ItemGroupId";
	$header_title2 = $db->query($n_sql2);
	$GroupName	=  $TEXT['Product Group'].': '.$header_title2[count($header_title2)-1]["GroupName"];


	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Receive'];
	$tableProperties["header_list"][2] = $TEXT['From'].": ".date('d/m/Y', strtotime($_REQUEST['StartDate'])).", ".$TEXT['To'].": ".date('d/m/Y', strtotime($_REQUEST['EndDate']));
	$tableProperties["header_list"][3] = $TEXT['Facility'].": ".$_REQUEST['FacilityName'].", ".$GroupName;

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = $TEXT['Receive'];
}

function getIssueData() {

	global $sql, $tableProperties, $TEXT, $siteTitle;
	
	$FacilityId = $_REQUEST['FacilityId'];
	$TransactionTypeId = $_REQUEST['TransactionTypeId'];
	$startDate = date('Y-m-d', strtotime($_REQUEST['StartDate']));
	$endDate = date('Y-m-d', strtotime($_REQUEST['EndDate']));
	$ItemGroupId = $_REQUEST['ItemGroupId'];

	 $sql = "SELECT DATE(`TransactionDate`) TransactionDate,`TransactionNo`,`SupplierInvNo`,
         DATE(`SupplierInvDate`) SupplierInvDate,TransactionId id,a.FacilityId,OrderNo,OrderDate
         ,bStockUpdated, 
         (SELECT SUM(LineTotalPrice) FROM t_transaction_items WHERE t_transaction_items.FacilityId=a.FacilityId
          AND t_transaction_items.TransactionId=a.TransactionId) Amount,
          d.FacilityName to_from, a.DeliveredBy
         FROM t_transaction a 
		 LEFT JOIN t_orderbook b ON a.OrderId=b.OrderId 
         LEFT JOIN t_facility d ON a.IssuedToFacility=d.FacilityId
         
         WHERE a.TransactionTypeId = ".$TransactionTypeId." 
		 AND a.FacilityId = '$FacilityId' 
         AND DATE(`TransactionDate`) BETWEEN '$startDate' AND '$endDate'
         AND a.ItemGroupId = $ItemGroupId
         ORDER BY DATE(a.TransactionDate) DESC,TransactionNo ;"; 
	
    $tableProperties["query_field"] = array("TransactionDate","TransactionNo","to_from","OrderNo","OrderDate", "bStockUpdated");
    $tableProperties["table_header"] = array($TEXT['Issue Date'],$TEXT['Issue Invoice No'],$TEXT['Recipient'],$TEXT['Order No'], $TEXT['Order Date'], $TEXT['Status']);
    $tableProperties["align"] = array("left","left","left","left","left","center");
    $tableProperties["width_print_pdf"] = array("10%","20%","20%","20%","12%","8%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("16","25","25","16","16","25");
    $tableProperties["precision"] = array("date","string","string","date","date","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    $db = new Db();
	$n_sql2 = "SELECT `GroupName` FROM `t_itemgroup` WHERE `ItemGroupId` = $ItemGroupId";
	$header_title2 = $db->query($n_sql2);
	$GroupName	=  $TEXT['Product Group'].': '.$header_title2[count($header_title2)-1]["GroupName"];


	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Issue'];
	$tableProperties["header_list"][2] = $TEXT['From'].": ".date('d/m/Y', strtotime($_REQUEST['StartDate'])).", ".$TEXT['To'].": ".date('d/m/Y', strtotime($_REQUEST['EndDate']));
	$tableProperties["header_list"][3] = $TEXT['Facility'].": ".$_REQUEST['FacilityName'].", ".$GroupName;

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = $TEXT['Issue'];
}

function getDispense() {

	global $sql, $tableProperties, $TEXT, $siteTitle;
	
	$FacilityId = $_REQUEST['FacilityId'];
	$startDate = date('Y-m-d', strtotime($_REQUEST['StartDate']));
	$endDate = date('Y-m-d', strtotime($_REQUEST['EndDate']));
	$ItemGroupId = $_REQUEST['ItemGroupId'];

	$sql = "SELECT DATE(`TransactionDate`) TransactionDate,`TransactionNo`,`SupplierInvNo`,
         DATE(`SupplierInvDate`) SupplierInvDate,TransactionId id,a.FacilityId,OrderNo,DATE(`OrderDate`) OrderDate,CASE WHEN bStockUpdated=0 THEN 'Draft' ELSE 'Posted' END bStockUpdated 
         , e.name AS PreparedBy, f.name AS ApprovedBy
		 ,(SELECT SUM(LineTotalPrice) FROM t_transaction_items WHERE t_transaction_items.FacilityId=a.FacilityId
          AND t_transaction_items.TransactionId=a.TransactionId) Amount
		 FROM t_transaction a 
		 LEFT JOIN t_orderbook b ON a.OrderId=b.OrderId 
		 LEFT JOIN `users` e ON a.`PreparedBy`=e.id
         LEFT JOIN `users` f ON a.`ApprovedBy`=f.id
		 WHERE 1=1 AND a.TransactionTypeId = 4 
		 AND a.FacilityId = $FacilityId 
         AND DATE(`TransactionDate`) BETWEEN '$startDate' AND '$endDate'
		 AND a.ItemGroupId = $ItemGroupId
        ORDER BY DATE(a.TransactionDate) DESC"; 
	
    $tableProperties["query_field"] = array("TransactionDate","TransactionNo","Amount","PreparedBy","ApprovedBy", "bStockUpdated");
    $tableProperties["table_header"] = array($TEXT['Dispense Date'],$TEXT['Dispense Invoice No'],$TEXT['Amount'],$TEXT['Prepared By'], $TEXT['Approved By'], $TEXT['Status']);
    $tableProperties["align"] = array("left","left","right","left","left","left");
    $tableProperties["width_print_pdf"] = array("10%","15%","10%","10%","10%","10%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("16","25","16","16","16","16");
    $tableProperties["precision"] = array("date","string",1,"string","string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    $db = new Db();
	$n_sql2 = "SELECT `GroupName` FROM `t_itemgroup` WHERE `ItemGroupId` = $ItemGroupId";
	$header_title2 = $db->query($n_sql2);
	$GroupName	=  $TEXT['Product Group'].': '.$header_title2[count($header_title2)-1]["GroupName"];


	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Dispense'];
	$tableProperties["header_list"][2] = $TEXT['From'].": ".date('d/m/Y', strtotime($_REQUEST['StartDate'])).", ".$TEXT['To'].": ".date('d/m/Y', strtotime($_REQUEST['EndDate']));
	$tableProperties["header_list"][3] = $TEXT['Facility'].": ".$_REQUEST['FacilityName'].", ".$GroupName;

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = $TEXT['Dispense'];
}

function getStockTake() {

	global $sql, $tableProperties, $TEXT, $siteTitle;
	
	$FacilityId = $_REQUEST['FacilityId'];
	$ItemGroupId = $_REQUEST['ItemGroupId'];
	$startDate = date('Y-m-d', strtotime($_REQUEST['StartDate']));
	$endDate = date('Y-m-d', strtotime($_REQUEST['EndDate']));

	$sql = "SELECT 
		a.StockTakeId id,
		a.FacilityId,
		DATE(a.StockTakeDate) StockTakeDate,
		DATE(a.CompleteDate) CompleteDate,		
		CASE WHEN IsCompleted=0 THEN 'Draft' ELSE 'Posted' END IsCompleted, 
		a.StoreId
		FROM t_stocktakemaster a
		WHERE (a.FacilityId = '$FacilityId' )               
		AND DATE(a.StockTakeDate) BETWEEN '" . $startDate . "' AND  '" . $endDate . "'
		AND a.ItemGroupId = $ItemGroupId
		ORDER BY DATE(a.StockTakeDate) DESC;"; 
	
    $tableProperties["query_field"] = array("StockTakeDate","CompleteDate","IsCompleted");
    $tableProperties["table_header"] = array($TEXT['Start Date'],$TEXT['End Date'],$TEXT['Status']);
    $tableProperties["align"] = array("left","left","left");
    $tableProperties["width_print_pdf"] = array("35%","35%","25%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("25","25","16");
    $tableProperties["precision"] = array("date","date","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
	$db = new Db();
	$n_sql2 = "SELECT `GroupName` FROM `t_itemgroup` WHERE `ItemGroupId` = $ItemGroupId";
	$header_title2 = $db->query($n_sql2);
	$GroupName	=  $TEXT['Product Group'].': '.$header_title2[count($header_title2)-1]["GroupName"];

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Stock Take'];
	$tableProperties["header_list"][2] = $TEXT['From'].": ".date('d/m/Y', strtotime($_REQUEST['StartDate'])).", ".$TEXT['To'].": ".date('d/m/Y', strtotime($_REQUEST['EndDate']));
	$tableProperties["header_list"][3] = $TEXT['Facility'].": ".$_REQUEST['FacilityName'].", ".$GroupName;

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = $TEXT['Stock Take'];
}

function getExportOrdersBook() {

	global $sql, $tableProperties, $TEXT, $siteTitle;
	
	$FacilityId = $_REQUEST['FacilityId'];
	$startDate = date('Y-m-d', strtotime($_REQUEST['StartDate']));
	$endDate = date('Y-m-d', strtotime($_REQUEST['EndDate']));
	$ItemGroupId = $_REQUEST['ItemGroupId'];

	$Receive =  $TEXT['Receive'];
	$Draft =  $TEXT['Draft'];
	$Approve =  $TEXT['Approve'];
	$Complete =  $TEXT['Complete'];

	/* CASE WHEN bCompleted=-1 THEN 'Draft' WHEN bCompleted=0 THEN 'Submitted' ELSE 'Complete' END bCompleted,
  	`OrderNo`, `OrderBy`, `ApprovedBy`, `bReceived`, `OrderingFrom`, `Remarks`, `SupplierId` ,
   	b.FacilityName AS OrderTo */

	$sql = "SELECT `OrderId` id, a.`FacilityId`, `OrderTypeId`, DATE(`OrderDate`) OrderDate, 
         CASE WHEN bReceived=1 THEN '$Receive' 
			WHEN bCompleted=-1 THEN '$Draft' 
			WHEN bCompleted=0 THEN '$Complete' 
			ELSE '$Approve' END bCompleted, 
		`OrderNo`, `OrderBy`, `ApprovedBy`, `bReceived`, `OrderingFrom`, 
        `Remarks`, `SupplierId` , b.FacilityName as OrderTo
        FROM t_orderbook a 
        INNER JOIN t_facility b ON a.OrderingFrom=b.FacilityId
        WHERE a.FacilityId = $FacilityId 
        AND DATE(a.`OrderDate`) BETWEEN '$startDate' AND '$endDate'
		AND a.ItemGroupId = $ItemGroupId
		ORDER BY DATE(a.OrderDate) DESC"; 
	
    $tableProperties["query_field"] = array("OrderDate","OrderNo","OrderTo","bCompleted");
    $tableProperties["table_header"] = array($TEXT['Order Date'],$TEXT['Order No'],$TEXT['Order To'],$TEXT['Status']);
    $tableProperties["align"] = array("left","left","left","left");
    $tableProperties["width_print_pdf"] = array("10%","20%","20%","10%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("16","25","30","10");
    $tableProperties["precision"] = array("date","string","string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	//Report header list

	$db = new Db();
	$n_sql2 = "SELECT `GroupName` FROM `t_itemgroup` WHERE `ItemGroupId` = $ItemGroupId";
	$header_title2 = $db->query($n_sql2);
	$GroupName	=  $TEXT['Product Group'].': '.$header_title2[count($header_title2)-1]["GroupName"];

	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Order'];
	$tableProperties["header_list"][2] = $TEXT['From'].": ".date('d/m/Y', strtotime($_REQUEST['StartDate'])).", ".$TEXT['To'].": ".date('d/m/Y', strtotime($_REQUEST['EndDate']));
	$tableProperties["header_list"][3] = $TEXT['Facility'].": ".$_REQUEST['FacilityName'].", ".$GroupName;

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = $TEXT['Order'];
}


function getExportOrdersBookApproval() {

	global $sql, $tableProperties, $TEXT, $siteTitle;
	
	$FacilityId = empty($_REQUEST['FacilityId']) ?  0 : $_REQUEST['FacilityId'];
	$startDate = date('Y-m-d', strtotime($_REQUEST['StartDate']));
	$endDate = date('Y-m-d', strtotime($_REQUEST['EndDate']));
	$C_Id = $_REQUEST['CompletedOrders'];
	if($C_Id=='true'){
	$CompletedOrders = " AND (bCompleted=0) ";
	}elseif($C_Id=='false'){
		$CompletedOrders = " AND (bCompleted=0 OR bCompleted=1) ";
	}
	$ItemGroupId = $_REQUEST['ItemGroupId'];

	$Receive =  $TEXT['Receive'];
	$Approve =  $TEXT['Approve'];
	$Complete =  $TEXT['Complete'];

		
	//$CompletedOrders =1 ? " AND (bCompleted=0) " :" AND (bCompleted=0 OR bCompleted=1) ";

	/* $sql = "SELECT `OrderId` id, a.`FacilityId`, `OrderTypeId`, DATE(`OrderDate`) OrderDate, 
        CASE WHEN bCompleted=-1 THEN 'Draft' WHEN bCompleted=0 THEN 'Submitted' ELSE 'Complete' END bCompleted, `OrderNo`, `OrderBy`, `ApprovedBy`, `bReceived`, `OrderingFrom`, 
        `Remarks`, `SupplierId` , b.FacilityName as OrderTo
        FROM t_orderbook a 
        INNER JOIN t_facility b ON a.OrderingFrom=b.FacilityId
        WHERE 
		(a.FacilityId = $FacilityId OR $FacilityId = 0) 
         AND DATE(a.`OrderDate`) BETWEEN '$startDate' AND '$endDate'
		 $CompletedOrders
		 ORDER BY DATE(a.OrderDate) DESC";  */



	$sql = "SELECT n.FacilityName AS OrderFromFacility,`OrderId` id, a.`FacilityId`, `OrderTypeId`, DATE(`OrderDate`) OrderDate, 
        CASE WHEN bReceived=1 THEN '$Receive' 
		 WHEN bCompleted=-1 THEN '$Draft' 
		 WHEN bCompleted=0 THEN '$Complete' 
		 ELSE '$Approve' END bCompleted, 
		`OrderNo`, `OrderBy`, `ApprovedBy`, `bReceived`, `OrderingFrom`, 
        `Remarks`, `SupplierId` , b.FacilityName as OrderTo
        FROM t_orderbook a 
        INNER JOIN t_facility b ON a.OrderingFrom=b.FacilityId
		INNER JOIN t_facility n ON a.FacilityId=n.FacilityId
        WHERE (a.FacilityId = $FacilityId OR $FacilityId = 0)
		AND DATE(a.`OrderDate`) BETWEEN '$startDate' AND '$endDate'
		 $CompletedOrders
		 AND a.ItemGroupId = $ItemGroupId
		 ORDER BY n.`FacilityName`, DATE(a.OrderDate) DESC"; 


    $tableProperties["query_field"] = array("OrderDate","OrderNo","OrderFromFacility","OrderTo","bCompleted");
    $tableProperties["table_header"] = array($TEXT['Order Date'],$TEXT['Order No'],$TEXT['Facility'],$TEXT['Order To'],$TEXT['Status']);
    $tableProperties["align"] = array("left","left","left","left","left");
    $tableProperties["width_print_pdf"] = array("10%","20%","20%","20%","10%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("16","25","30","30","10");
    $tableProperties["precision"] = array("date","string","string","string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	//Report header list

	$db = new Db();
	$n_sql2 = "SELECT `GroupName` FROM `t_itemgroup` WHERE `ItemGroupId` = $ItemGroupId";
	$header_title2 = $db->query($n_sql2);
	$GroupName	=  $TEXT['Product Group'].': '.$header_title2[count($header_title2)-1]["GroupName"];

	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Order'];
	$tableProperties["header_list"][2] = $TEXT['From'].": ".date('d/m/Y', strtotime($_REQUEST['StartDate'])).", ".$TEXT['To'].": ".date('d/m/Y', strtotime($_REQUEST['EndDate']));
	$tableProperties["header_list"][3] = $TEXT['Facility'].": ".$_REQUEST['FacilityName'].", ".$GroupName;

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = $TEXT['Order'];
}

function PatientExcelExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$FacilityId = empty($_REQUEST['FacilityId']) ?  0 : $_REQUEST['FacilityId'];
	$FacilityName = $_REQUEST['FacilityName'];
	
	$sql = "SELECT `idNumber`,`lastName`,`firstName`,`knownName`,`GenderType`,`registered`,`pass`,`deceased`,`ipn`,`transfferedIn`,`dob`,`transferredOut`,
            `MaritalStatus`,`active`,`temporaryPatient`,`LanguageName`,`defaulter`,`stopped`, `contactNumber`,`email`,`address`,e.protocolName AS FirstprotocolName,f.protocolName AS CurrentprotocolName,g.MmdName
			,h.FacilityName AS TransferFromFacility, i.FacilityName AS TransferToFacility, j.PatientcoinfectionName, k.KeypopulationType, a.PreEP
			,InhIsPrevious, InhStartDate, InhEndDate, NextAppointmentDate, nn.CohortType
		FROM `t_patient` a 
		INNER JOIN `t_gendertype` b  ON a.GenderTypeId = b.GenderTypeId 
		LEFT JOIN `t_marital_status` c  ON a.MaritalStatusId = c.`MaritalStatusId`
		LEFT JOIN `t_language_preference` d  ON a.languagePreference = d.Id
		LEFT JOIN t_protocol e ON a.FirstProtocolId=e.ProtocolId 
		LEFT JOIN t_protocol f ON a.ProtocolId=f.ProtocolId 
		LEFT JOIN t_mmd_status g ON a.MmdId=g.MmdId 
		LEFT JOIN t_facility h ON a.TransferFromFacilityId=h.FacilityId
		LEFT JOIN t_facility i ON a.TransferToFacilityId=i.FacilityId
		LEFT JOIN t_patientcoinfection j ON a.PatientcoinfectionId=j.PatientcoinfectionId
		LEFT JOIN t_keypopulationtype k ON a.KeypopulationTypeId=k.KeypopulationTypeId
		LEFT JOIN t_cohorttype nn ON a.CohortId=nn.CohortId
		WHERE a.FacilityId = '$FacilityId' 
		ORDER BY idNumber, `pass`, `ipn`;"; 
	
    $tableProperties["query_field"] = array("idNumber", "pass", "ipn", "lastName","firstName","knownName","GenderType", "registered", "deceased", "transfferedIn","TransferFromFacility","dob", "transferredOut", "TransferToFacility", "MaritalStatus", "active", "temporaryPatient","LanguageName","defaulter","stopped","contactNumber","email","address","FirstprotocolName","CurrentprotocolName","MmdName","PreEP","PatientcoinfectionName", "KeypopulationType", "InhIsPrevious", "InhStartDate", "InhEndDate", "NextAppointmentDate", "CohortType");
    $tableProperties["table_header"] = array($TEXT['ID Number'], $TEXT['PAS#'], $TEXT['IPN'], $TEXT['Last Name'], $TEXT['First Name'], $TEXT['Known Name'], $TEXT['Gender'], $TEXT['Registered'], $TEXT['deceased'], $TEXT['Transffered In'],$TEXT['Transfer From'], $TEXT['DoB'], $TEXT['Transferred Out'], $TEXT['Transfer To'],$TEXT['Marital Status'], $TEXT['Active'],$TEXT['Temporary Patient'],$TEXT['Language Preference'],$TEXT['Defaulter'],$TEXT['Stopped'],$TEXT['Contact#'],$TEXT['E-mail'],$TEXT['Address'],$TEXT['First Protocol'],$TEXT['Current Regimen'],$TEXT['MMD Status'],$TEXT['PreEP'],$TEXT['Patient Co-infection'],$TEXT['Key Population Type'],$TEXT['previously received INH'],$TEXT['INH Start Date'],$TEXT['INH End Date'],$TEXT['Last Appointment Date'],$TEXT['Cohort']);
    $tableProperties["align"] = array("left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","center","left","left","left","left");
    $tableProperties["width_print_pdf"] = array("10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","15%","10%","10%","15%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("20","25","10","30", "30","30","9","13","13","13","30","10","13","30","13","17","15","20","15","10","15","17","15","17","17","10","10","20","30","15","30","30","30","15");
    $tableProperties["precision"] = array("string","string","string","string","string","string","string", "date","date","date","string","date","date", "string", "string","string","string","string", "date","date","string","string","string","string","string","string","string","string","string","string","date","date","date","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    //Report header list
    $tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Patient'];
	$tableProperties["header_list"][2] = $FacilityName;
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'patient_data';
}

function getdispenserList() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `lastName`,`firstName`,rxLevel,`number`,`professional`,`staff`,b.PostName,`initial`,c.TitleName,
	e.FacilityName,`active`,`address1`,`contactNumber`,`emailWork`,`city`,`contactNumberEmergency`,
	`emailPersonal`,g.name,f.`CountryName`
	FROM `t_dispenser` a 
	INNER JOIN t_facility e ON a.demander =e.`FacilityId`
	LEFT JOIN t_post b ON a.`post`= b.`PostId`
	LEFT JOIN t_title c ON a.title = c.`TitleId`
	LEFT JOIN t_country f ON a.`country` = f.`CountryId`
	LEFT JOIN users g ON a.`UserId` = g.`id`
	ORDER BY `firstName`, `lastName`;"; 
	
    $tableProperties["query_field"] = array("lastName","firstName","rxLevel","number","professional","staff",
	"PostName","initial","TitleName","FacilityName","active","address1","contactNumber","emailWork","city","CountryName",
	"contactNumberEmergency","emailPersonal","name");
    $tableProperties["table_header"] = array($TEXT['Last Name'],$TEXT['First Name'],$TEXT['Rx Level'],$TEXT['Number'],$TEXT['Professional'],
	$TEXT['Staff#'],$TEXT['Post'],$TEXT['Initial'],$TEXT['Title'],$TEXT['Demander'],$TEXT['Active'],$TEXT['Address'],$TEXT['Contact#'],$TEXT['E-mail (Work)'],$TEXT['City'],
	$TEXT['Country'],$TEXT['Cell (Emergency)'],$TEXT['E-mail (Personal)'],$TEXT['User']);
    $tableProperties["align"] = array("left","left","left","right","left","left","left","left","left","left","left",
	"left","left","left","left","left","left","left","left");
    $tableProperties["width_print_pdf"] = array("5%","10%","10%","5%","5%","4%","4%","8%","10%","13%",
	"17%","4%","4%","4%","4%","4%","4%","8%","8%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("10","10","10","10","10","10","10","10","10","10","10","10","10",
	"10","10","10","10","10","10");
    $tableProperties["precision"] = array("string","string","string","string","string","string","string","string",
	"string","string","string","string","string","string","string","string","string","string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Dispenser List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Dispenser_list_';
}

function getprescriberList() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `lastName`,`firstName`,rxLevel,`number`,`professional`,`staff`,b.PostName,`initial`,c.TitleName,
	d.SpecialisationName,e.FacilityName,`active`,`address1`,`contactNumber`,`emailWork`,`city`,`contactNumberEmergency`,
	`emailPersonal`,g.name,f.`CountryName`
	FROM `t_prescriber` a 
	INNER JOIN t_facility e ON a.demander =e.`FacilityId`
	LEFT JOIN t_post b ON a.`post`= b.`PostId`
	LEFT JOIN t_title c ON a.title = c.`TitleId`
	LEFT JOIN t_specialisation d ON a.specialisation =d.`SpecialisationId`
	LEFT JOIN t_country f ON a.`country` = f.`CountryId`
	LEFT JOIN users g ON a.`UserId` = g.`id`
	ORDER BY `firstName`, `lastName`;"; 
	
    $tableProperties["query_field"] = array("lastName","firstName","rxLevel","number","professional","staff",
	"PostName","initial","TitleName","SpecialisationName","FacilityName","active","address1","contactNumber","emailWork","city","CountryName",
	"contactNumberEmergency","emailPersonal","name");
    $tableProperties["table_header"] = array($TEXT['Last Name'],$TEXT['First Name'],$TEXT['Rx Level'],$TEXT['Number'],$TEXT['Professional#'],
	$TEXT['Staff#'],$TEXT['Post'],$TEXT['Initial'],$TEXT['Title'],$TEXT['Specialisation'],$TEXT['Demander'],$TEXT['Active'],$TEXT['Address'],$TEXT['Contact#'],$TEXT['E-mail (Work)'],$TEXT['City'],
	$TEXT['Country'],$TEXT['Cell (Emergency)'],$TEXT['E-mail (Personal)'],$TEXT['User']);
    $tableProperties["align"] = array("left","left","left","right","left","left","left","left","left","left","left","left",
	"left","left","left","left","left","left","left","left");
    $tableProperties["width_print_pdf"] = array("5%","10%","10%","5%","5%","4%","4%","8%","10%","13%","4%",
	"17%","4%","4%","4%","4%","4%","4%","8%","8%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("10","10","10","10","10","10","10","10","10","10","10","10","10","10",
	"10","10","10","10","10","10");
    $tableProperties["precision"] = array("string","string","string","string","string","string","string","string","string",
	"string","string","string","string","string","string","string","string","string","string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Prescriber List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Prescriber_list_';
}

function getdirectionlist() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `DirectionName`FROM t_direction ORDER BY `DirectionName`;"; 
	
	
    $tableProperties["query_field"] = array("DirectionName");
    $tableProperties["table_header"] = array($TEXT['Direction']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Direction List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'direction_Entry_Form';
}

function StockMasterExcelExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

    //$sCurrentDate = date('Y-m-d', strtotime($_REQUEST['StartDate']));
	$sCurrentDate =date('Y-m-d', strtotime(trim($_REQUEST['StartDate'])));
	//echo $sCurrentDate;

    $isStock = $_REQUEST['RadioValue'];
    $StoreId = 3;
    $sFacilityId = $_REQUEST['FacilityId'];
    //$sProductGroup = 3;
    //$sProductGroup = $_REQUEST['RoleItemGroupId'];
    $sProductGroup = $_REQUEST['ItemGroupId'];
   
    $StockQty = "";
    $StockQtyDateWise = "";

    if($isStock == 0) {
        $StockQty = "";
        $StockQtyDateWise = "";
		$isStockText = "";
    }else if ($isStock == 1) {
        $StockQty = " and a.StockQty = 0 ";
        $StockQtyDateWise = " having SUM(b.Quantity) = 0 ";
		$isStockText = ", ".$TEXT['ZERO'];
    }else if ($isStock == 2) {
        $StockQty = " and a.StockQty > 0 ";
        $StockQtyDateWise = " having SUM(b.Quantity) > 0 ";
		$isStockText = ", ".$TEXT['NONE-ZERO'];
    }
	
	if($sFacilityId == '' || $sFacilityId == 0){
		$pFacilityId = 0;
	}else{
		$pFacilityId = $sFacilityId;
	}

	$FacilityIdDateWise = " AND e.FacilityId = " . $pFacilityId . " ";
	$FacilityId = " AND a.FacilityId = " . $pFacilityId. " ";
		
    if ($sProductGroup == '' || $sProductGroup == 0){
        $ItemGroupId = "";
        $ItemGroupIdDateWise = "";
    }else{
        $ItemGroupId = " AND (b.ItemGroupId = $sProductGroup OR $sProductGroup = 0) ";
        $ItemGroupIdDateWise = " AND (c.ItemGroupId = $sProductGroup OR $sProductGroup = 0) ";
    }

	$dateNew=date_create($sCurrentDate);
	$ndate= date_format($dateNew,"d/m/Y");

	$CurrentDate = date('Y-m-d'); 
	if($sCurrentDate >= $CurrentDate){
		$sql = "SELECT 
			b.ItemGroupId AS GroupCode, 
			c.GroupName, 
			b.ItemCode AS ProductCode, 
			b.ItemName ProductName,
			a.StockQty AS Quantity, 
			0.0 AS UnusableQty, 
			b.UnitId AS UnitName, 
			a.ItemNo,
			a.PurchasePrice UnitPrice, 
			a.SalesPrice,
			a.AMC,
			case when a.StockQty>0 and a.AMC=0 then -1 else
				round(a.StockQty/a.AMC, 1) end MOS,

			(IFNULL(a.StockQty,0)*IFNULL(a.SalesPrice,0)) AS LineTotal,
			(IFNULL(a.AMC,0)*(SELECT MinMos FROM t_mostype_facility INNER JOIN `t_facility` ON t_mostype_facility.FLevelId = t_facility.FLevelId AND t_mostype_facility.FTypeId = t_facility.FTypeId WHERE bSatisfactory=1 AND t_facility.FacilityId = $sFacilityId)) AS MinimumQuantity,
			(IFNULL(a.AMC,0)*(SELECT MaxMos FROM t_mostype_facility INNER JOIN `t_facility` ON t_mostype_facility.FLevelId = t_facility.FLevelId AND t_mostype_facility.FTypeId = t_facility.FTypeId WHERE bSatisfactory=1 AND t_facility.FacilityId = $sFacilityId)) AS MaximumQuantity,
			(select MinMos from t_mostype_facility INNER JOIN `t_facility` ON t_mostype_facility.FLevelId = t_facility.FLevelId AND t_mostype_facility.FTypeId = t_facility.FTypeId WHERE bSatisfactory=1 AND t_facility.FacilityId = '".$sFacilityId."') AS MinimumQuantity_,
			(select MaxMos from t_mostype_facility INNER JOIN `t_facility` ON t_mostype_facility.FLevelId = t_facility.FLevelId AND t_mostype_facility.FTypeId = t_facility.FTypeId WHERE bSatisfactory=1 AND t_facility.FacilityId = '".$sFacilityId."') AS MaximumQuantity_
			
		from t_facility_product a
		INNER JOIN t_itemlist_master b ON a.ItemNo=b.ItemNo
		INNER JOIN t_itemgroup c ON b.ItemGroupId = c.ItemGroupId
		INNER JOIN `t_facility`  f ON a.FacilityId = f.FacilityId 	
		WHERE 1=1 $FacilityId $ItemGroupId $StockQty
		AND a.StoreId = $StoreId
		ORDER BY c.GroupName, b.ItemName ASC";
		
	}else{

		$sql = "SELECT 
			c.ItemGroupId AS GroupCode,
			d.GroupName,
			c.ItemCode AS ProductCode, 
			c.ItemName ProductName, 
			CAST(SUM(b.Quantity*b.IsPositive) AS DECIMAL(12,2)) AS Quantity, 
			0.0 as UnusableQty,
			1 AS UnitName, 
			b.ItemNo,
			MAX(e.AMC) AS AMC, 
			
			case when round(CAST(SUM(b.Quantity*b.IsPositive) AS DECIMAL(12,2)))>0 and MAX(e.AMC)=0 then -1 else
				round(CAST(SUM(b.Quantity*b.IsPositive) AS DECIMAL(12,2)) / e.AMC, 1) end MOS,


			MAX(IFNULL(e.PurchasePrice,0)) AS UnitPrice,
			MAX(IFNULL(e.SalesPrice,0)) AS SalesPrice,
			(MAX(IFNULL(e.SalesPrice,0)) * SUM(IFNULL(b.Quantity*b.IsPositive,0))) AS LineTotal,

			(IFNULL(MAX(e.AMC),0)*(select MinMos from t_mostype_facility INNER JOIN `t_facility` ON t_mostype_facility.FLevelId = t_facility.FLevelId AND t_mostype_facility.FTypeId = t_facility.FTypeId WHERE bSatisfactory=1 AND t_facility.FacilityId = '".$sFacilityId."')) AS MinimumQuantity,
			(IFNULL(MAX(e.AMC),0)*(select MaxMos from t_mostype_facility INNER JOIN `t_facility` ON t_mostype_facility.FLevelId = t_facility.FLevelId AND t_mostype_facility.FTypeId = t_facility.FTypeId WHERE bSatisfactory=1 AND t_facility.FacilityId = '".$sFacilityId."')) AS MaximumQuantity,
			(select MinMos from t_mostype_facility INNER JOIN `t_facility` ON t_mostype_facility.FLevelId = t_facility.FLevelId AND t_mostype_facility.FTypeId = t_facility.FTypeId WHERE bSatisfactory=1 AND t_facility.FacilityId = '".$sFacilityId."') AS MinimumQuantity_,
			(select MaxMos from t_mostype_facility INNER JOIN `t_facility` ON t_mostype_facility.FLevelId = t_facility.FLevelId AND t_mostype_facility.FTypeId = t_facility.FTypeId WHERE bSatisfactory=1 AND t_facility.FacilityId = '".$sFacilityId."') AS MaximumQuantity_

		from t_transaction a
		INNER JOIN t_transaction_items b ON a.FacilityId=b.FacilityId AND a.TransactionId=b.TransactionId 
		INNER JOIN t_itemlist_master c on b.ItemNo = c.ItemNo
		INNER JOIN t_itemgroup d on c.ItemGroupId=d.ItemGroupId 
		INNER JOIN t_facility_product e ON a.FacilityId=e.FacilityId AND a.StoreId=e.StoreId and b.ItemNo=e.ItemNo
		INNER JOIN `t_facility`  f ON e.FacilityId = f.FacilityId
		WHERE a.bStockUpdated =1 and a.StoreId = $StoreId
		and a.TransactionDate <= '".$sCurrentDate."' 
		$FacilityIdDateWise $ItemGroupIdDateWise  
		GROUP BY d.GroupName, ItemName, c.ItemGroupId, c.CameCode, b.ItemNo, c.ItemCode ";
	}


    
	/* $tableProperties["query_field"] = array("ProductCode","ProductName","AMC","MinimumQuantity","MaximumQuantity","Quantity","MOS",
	"UnitPrice","LineTotal"); 
	$tableProperties["table_header"] = array($TEXT['Product Code'], $TEXT['Product Name'], $TEXT['AMC'],$TEXT['Minimum Quantity'],
	$TEXT['Maximum Quantity'],$TEXT['Quantity'],$TEXT['MOS'],$TEXT['Unit Price'],$TEXT['Line Total']);
	
	*/

    $tableProperties["query_field"] = array("ProductCode","ProductName","AMC","MinimumQuantity","MaximumQuantity","Quantity","MOS");
    $tableProperties["table_header"] = array($TEXT['Product Code'], $TEXT['Product Name'], $TEXT['AMC'],$TEXT['Minimum Quantity'],
	$TEXT['Maximum Quantity'],$TEXT['Quantity'],$TEXT['MOS']);
    $tableProperties["align"] = array("left","left","right","right","right","right","right","right","right");
    $tableProperties["width_print_pdf"] = array("5%","30%","5%","5%","5%","5%","5%","10%","10%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("20","50","10","20","20","20","8","17","17");
    $tableProperties["precision"] = array("string","string",0,0,0,0,1,2,02); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	//Report header list

	$db = new Db();
	$n_sql2 = "SELECT `GroupName` FROM `t_itemgroup` WHERE `ItemGroupId` = $sProductGroup";
	$header_title2 = $db->query($n_sql2);
	$GroupName	=  $TEXT['Product Group'].': '.$header_title2[count($header_title2)-1]["GroupName"];
	
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Stock Status'];
	$tableProperties["header_list"][2] = $TEXT['Stock Date'].': '. $ndate.$isStockText;
	$tableProperties["header_list"][3] = $TEXT['Facility'].": ".$_REQUEST['FacilityName'].", ".$GroupName;
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Stock_Status';
}

function ProductsListExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;


	$sProductGroup = isset($_REQUEST['ItemGroupId']) ? $_REQUEST['ItemGroupId'] : '0';
	
	if ($sProductGroup == '' || $sProductGroup == 0){
		$ItemGroupId = "";
	}else{
		$ItemGroupId = " WHERE (a.ItemGroupId = $sProductGroup OR $sProductGroup = 0) ";
	}


	$Drug = $TEXT['Drug'];
	$MedicalSupply = $TEXT['Medical Supply'];
	$Others = $TEXT['Others'];
	$OIMedicine = $TEXT['OI Medicine'];
	$DrugNonARV = $TEXT['Drug Non ARV'];

	 $sql = "SELECT 
	  ff.GroupName,
	  a.ItemCode,
	  a.ItemName,
	  a.ShortName,
	  b.GenericName,
	  a.TradeName,
	  e.StrengthName,
	  f.DosageFormName,
	  g.PacksizeName,
	  c.UnitName,
	  d.RouteName,
	  i.UnitName AdministrationUnit,
	  a.Price,
	  j.ProductType,
	  a.icn,
	  a.ecn,
	  a.nsn,
	  a.fin,
	  h.RxLevel,
	  k.VenName,
	  l.AbcName,
	  a.ATC,
	  a.BinLocation,
	  a.ShippingPack,
	  a.Markup,
	  a.SellingPrice,
	  a.bPediatric,
	  a.bInjectable,
	  a.bIncludeTrade,
	  a.bExcludeGeneric,
	  a.bKeyItem,
	  a.productType,
	  CASE a.ProductTypeId
			WHEN 1 THEN '$DrugNonARV'
			WHEN 2 THEN '$MedicalSupply'
			WHEN 3 THEN '$Others'
			WHEN 4 THEN '$OIMedicine'
			ELSE '$Drug'
		END AS ProductTypeName
	FROM t_itemlist_master a
	INNER JOIN t_generics b ON a.GenericId =  b.GenericId
	INNER JOIN t_unitofmeas c ON a.UnitId = c.UnitId
	INNER JOIN t_route_of_admin d ON a.RouteId = d.RouteId
	INNER JOIN t_strength e ON a.strengthSize = e.StrengthId
	INNER JOIN t_dosageform f ON a.DosageFormId = f.DosageFormId
	INNER JOIN t_packsize g ON a.PackSize = g.PacksizeId
	LEFT JOIN t_rxlevel h ON a.RxLevelId = h.RxLevelId
	INNER JOIN t_unitofmeas i ON a.AdministrationUnit = i.UnitId
	LEFT JOIN t_producttype j ON a.ProductTypeId = j.ProductTypeId
	LEFT JOIN t_ven k ON a.VenId = k.VenId
	LEFT JOIN t_abc l ON a.AbcId = l.AbcId
	INNER JOIN t_itemgroup ff ON a.ItemGroupId=ff.ItemGroupId
	$ItemGroupId
	ORDER BY ff.GroupName DESC, a.ItemName;"; 


    $tableProperties["query_field"] = array("GroupName","ItemCode","ItemName","ShortName","GenericName","TradeName","StrengthName","DosageFormName", "PacksizeName", "UnitName", "RouteName","AdministrationUnit","Price", "ProductTypeName", "icn", "ecn", "nsn","fin","RxLevel","VenName","AbcName","ATC","BinLocation","ShippingPack","Markup","SellingPrice","bPediatric","bInjectable","bIncludeTrade","bExcludeGeneric","bKeyItem","productType");
    $tableProperties["table_header"] = array($TEXT['Product Group'], $TEXT['Product Code'], $TEXT['Product Name'], $TEXT['Product Short Name'], $TEXT['Generic Name'], $TEXT['Trade Name or Other Name'], $TEXT['Strength/Size'], $TEXT['Form'], $TEXT['Pack Size'], $TEXT['Unit'], $TEXT['Route of Admin'], $TEXT['Administration Unit'], $TEXT['Price (CFA)'], $TEXT['Product Type'], $TEXT['ICN'], $TEXT['ECN'],$TEXT['NSN'],$TEXT['FIN'],$TEXT['Rx Level'],$TEXT['VEN'],$TEXT['ABC'],$TEXT['ATC'],$TEXT['Bin Location'],$TEXT['Shipping Pack'],$TEXT['Markup%'],$TEXT['Selling Price (CFA)'],$TEXT['Pediatric'],$TEXT['Injectable'],$TEXT['Include Trade name in Description'],$TEXT['Exclude Generic name from Description'],$TEXT['Key Product'],$TEXT['Type']);
    $tableProperties["align"] = array("left","left","left","left","left","left","left","left","left","left","left","left","right","left","left","left","left","left","left","left","left","left","left","left","left","right","left","left","left","left","center","left");
    $tableProperties["width_print_pdf"] = array("10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%","10%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("20","20","50","25","25","20","9","13","13","13","10","13","13","17","15","10","10","20","15","10","15","17","15","15","15","15","15","15","15","15","15","15");
    $tableProperties["precision"] = array("string","string","string","string","string","string","string","string","string","string","string","string",2,"string","string","string","string","string","string","string","string","string","string", "string", "string", 2, "string", "string", "string", "string", "string", "string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
    $tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    //Report header list

	if($ItemGroupId ==""){
		$GroupName	= $TEXT['Product Group'].': '.$TEXT['All'];

	}else{
		$db = new Db();
		$n_sql2 = "SELECT a.GroupName FROM `t_itemgroup` a $ItemGroupId ";
	
		$header_title2 = $db->query($n_sql2);
		$GroupName	=  $TEXT['Product Group'].': '.$header_title2[count($header_title2)-1]["GroupName"];

	}
	

    $tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Product'].", ".$GroupName;;
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Product';
}

function StrengthExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `StrengthName` FROM t_strength ORDER BY `StrengthName`;";
	
    $tableProperties["query_field"] = array("StrengthName");
    $tableProperties["table_header"] = array($TEXT['Strength']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Strength List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Strength_Entry_Form_';
}

function formExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `DosageFormId`,`DosageFormName`FROM `t_dosageform` ORDER BY `DosageFormName`;"; 
	
	
    $tableProperties["query_field"] = array("DosageFormId","DosageFormName");
    $tableProperties["table_header"] = array($TEXT['Form Id'],$TEXT['Form']);
    $tableProperties["align"] = array("left","left");
    $tableProperties["width_print_pdf"] = array("15%","80%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("10","30");
    $tableProperties["precision"] = array("string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Form List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'form_Entry_Form_';
}

function PacksizeExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `PacksizeName` FROM t_packsize ORDER BY `PacksizeName`;";
	
    $tableProperties["query_field"] = array("PacksizeName");
    $tableProperties["table_header"] = array($TEXT['Pack Size']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Pack Size List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Packsize_Entry_Form_';
}

function LanguageExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `LanguageName` FROM t_language_preference ORDER BY `LanguageName`;"; 
	
    $tableProperties["query_field"] = array("LanguageName");
    $tableProperties["table_header"] = array($TEXT['Language Preference Name']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Language Preference List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Languagepreference_Entry_Form_';
}

function AdjustTypeExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	 $sql = "SELECT `AdjType`,`IsPositive` FROM `t_adj_type` ORDER BY `AdjType`;"; 
	 

    $tableProperties["query_field"] = array("AdjType","IsPositive");
    $tableProperties["table_header"] = array($TEXT['Adjustment Type'],$TEXT['Plus/Minus']);
    $tableProperties["align"] = array("left","left");
    $tableProperties["width_print_pdf"] = array("50%","45%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("50","13");
    $tableProperties["precision"] = array("string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Adjustment Type List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Adjustmenttype_Entry_Form_';
}

function SpecialisationExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `SpecialisationName` FROM t_specialisation ORDER BY `SpecialisationId`;"; 
	
    $tableProperties["query_field"] = array("SpecialisationName");
    $tableProperties["table_header"] = array($TEXT['Specialisation']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Specialisation List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Specialisation_Entry_Form_';
}

function PostExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `PostName` FROM t_post ORDER BY `PostName`;"; 
	
    $tableProperties["query_field"] = array("PostName");
    $tableProperties["table_header"] = array($TEXT['Post Name']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Post List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Post_Entry_Form_';
}

function AbcExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `AbcName` FROM t_abc ORDER BY `AbcName`;"; 
	
    $tableProperties["query_field"] = array("AbcName");
    $tableProperties["table_header"] = array($TEXT['ABC Name']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['ABC List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Abc_Entry_Form_';
}

function MaritalStatusExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `MaritalStatusId`,`MaritalStatus` FROM t_marital_status ORDER BY `MaritalStatus`;"; 
	
	
    $tableProperties["query_field"] = array("MaritalStatusId","MaritalStatus");
    $tableProperties["table_header"] = array($TEXT['MaritalStatus Code'],$TEXT['MaritalStatus Name']);
    $tableProperties["align"] = array("right","left");
    $tableProperties["width_print_pdf"] = array("10%","85%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("20","40");
    $tableProperties["precision"] = array(0,"string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Marital Status List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Maritalstatus_Entry_Form_';
}

function TitleListExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `TitleName` FROM t_title ORDER BY `TitleName`;"; 
	
	
    $tableProperties["query_field"] = array("TitleName");
    $tableProperties["table_header"] = array($TEXT['Title list']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Title list'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Titlelist_Entry_Form_';
}

function CohortTypeExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `CohortType` FROM t_cohorttype ORDER BY `CohortType`;"; 
	
	
    $tableProperties["query_field"] = array("CohortType");
    $tableProperties["table_header"] = array($TEXT['Cohort Type']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Cohort Type'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Cohort_Type_';
}

function OrderTypeExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `OrderType` FROM t_ordertype ORDER BY `OrderType`;"; 
	
	
    $tableProperties["query_field"] = array("OrderType");
    $tableProperties["table_header"] = array($TEXT['Order Type Name']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Order Type List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Ordertype_Entry_Form_';
}

function PatientcoinfectionExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `PatientcoinfectionName` FROM t_patientcoinfection ORDER BY `PatientcoinfectionName`;"; 
	
    $tableProperties["query_field"] = array("PatientcoinfectionName");
    $tableProperties["table_header"] = array($TEXT['Patient Co-infection Name']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Patient Co-infection List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Patient_Co_infection_List';
}

function KeypopulationtypeExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `KeypopulationType`, KeypopulationTypeFull  FROM t_keypopulationtype ORDER BY `KeypopulationType`;"; 
	
    $tableProperties["query_field"] = array("KeypopulationType", "KeypopulationTypeFull");
    $tableProperties["table_header"] = array($TEXT['Key Population Type (Short)'], $TEXT['Key Population Type (Full)']);
    $tableProperties["align"] = array("left","left");
    $tableProperties["width_print_pdf"] = array("40%","60%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("40", "90");
    $tableProperties["precision"] = array("string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Key Population Type List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Key_Population_Type_List';
}

function RouteOfAdminExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `RouteName`,`Instruction` FROM t_route_of_admin ORDER BY `RouteName`;"; 
	
	
    $tableProperties["query_field"] = array("RouteName","Instruction");
    $tableProperties["table_header"] = array($TEXT['Route Of Admin'],$TEXT['Instruction']);
    $tableProperties["align"] = array("left","left");
    $tableProperties["width_print_pdf"] = array("20%","75%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("20","30");
    $tableProperties["precision"] = array("string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Route Of Admin List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'RouteOfAdmin_Entry_Form_';
}

function LebTestExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `LabTestId`,`LabTest` FROM `t_labtest` ORDER BY `LabTest`;"; 
	
	
    $tableProperties["query_field"] = array("LabTestId","LabTest");
    $tableProperties["table_header"] = array($TEXT['Labtest Code'],$TEXT['Labtest Name']);
    $tableProperties["align"] = array("left","left");
    $tableProperties["width_print_pdf"] = array("10%","85%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("30","30");
    $tableProperties["precision"] = array("string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Labtest List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Labtest_Entry_Form_';
}

function LebTestListExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT
	t.`TestId` AS `id`,
	t.`FTypeIds`,
	t.`TestName`,
	t.`IsCD4`,
	t.`IsVirale`,
	GROUP_CONCAT(ft.`FTypeName` ORDER BY FIND_IN_SET(ft.`FTypeId`, t.`FTypeIds`)) AS `FTypeNames`
	FROM `t_test` AS t
	LEFT JOIN `t_facility_type` AS ft ON FIND_IN_SET(ft.`FTypeId`, t.`FTypeIds`)
	GROUP BY t.`TestId`, t.`FTypeIds`, t.`TestName`, t.`IsCD4`, t.`IsVirale`
	ORDER BY t.`TestName`;"; 
	
	
    $tableProperties["query_field"] = array("TestName","IsCD4","IsVirale","FTypeNames");
    $tableProperties["table_header"] = array($TEXT['Lab Test Name'],$TEXT['Is CD4'],$TEXT['Is Charge Virale'],$TEXT['Facility Type']);
    $tableProperties["align"] = array("left","right","right","left");
    $tableProperties["width_print_pdf"] = array("25%","5%","10%","60%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("40","9","16","70");
    $tableProperties["precision"] = array("string",0,0,"string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Lab Test List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Lab_Test_List_';
}

function getIntervalList() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `DoseInterval`,`IsValue`, `Instruction` FROM t_doseinterval ORDER BY `DoseInterval`;"; 
	
	
    $tableProperties["query_field"] = array("DoseInterval","IsValue","Instruction");
    $tableProperties["table_header"] = array($TEXT['Interval'],$TEXT['Value'],$TEXT['Instruction']);
    $tableProperties["align"] = array("left","right","left");
    $tableProperties["width_print_pdf"] = array("10%","6%","65%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("10","9","30");
    $tableProperties["precision"] = array("string",0,"string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Interval List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Interval_Entry_Form_';
}

function FacilityExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$bDispensingValue = $_REQUEST['bDispensingValue'];

	if ($bDispensingValue == "true"){
		
		$sql = "SELECT `FacilityCode`,`FacilityName`,b.FLevelName,c.FTypeName,d.RegionName,e.ZoneName,f.DistrictName,`bDispense`
		FROM t_facility AS a
		INNER JOIN t_facility_level AS b ON a.FLevelId = b.FLevelId
		INNER JOIN t_facility_type AS c  ON a.FTypeId = c.FTypeId
		INNER JOIN t_region AS d ON a.RegionId = d.RegionId
		INNER JOIN t_zone AS e ON a.ZoneId = e.ZoneId
		INNER JOIN t_districts AS f ON a.DistrictId = f.DistrictId
		WHERE a.`bDispense` = 1
		ORDER BY `FacilityCode`,`FacilityName`;"; 
	}else {
		$sql = "SELECT `FacilityCode`,`FacilityName`,b.FLevelName,c.FTypeName,d.RegionName,e.ZoneName,f.DistrictName,`bDispense`
		FROM t_facility AS a
		INNER JOIN t_facility_level AS b ON a.FLevelId = b.FLevelId
		INNER JOIN t_facility_type AS c  ON a.FTypeId = c.FTypeId
		INNER JOIN t_region AS d ON a.RegionId = d.RegionId
		INNER JOIN t_zone AS e ON a.ZoneId = e.ZoneId
		INNER JOIN t_districts AS f ON a.DistrictId = f.DistrictId
		ORDER BY `FacilityCode`,`FacilityName`;"; 
	}

	
	
    $tableProperties["query_field"] = array("FacilityCode","FacilityName","FLevelName","FTypeName","RegionName",
	"ZoneName","DistrictName","bDispense");
    $tableProperties["table_header"] = array($TEXT['Facility Code'],$TEXT['Facility Name'],$TEXT['Facility Level'],$TEXT['Facility Type'],
	$TEXT['Department Name'],$TEXT['ZS Name'],$TEXT['Commune Name'],$TEXT['bDispensing']);
    $tableProperties["align"] = array("left","left","left","left","left","left","left","right");
    $tableProperties["width_print_pdf"] = array("8%","18%","12%","12%","12%","12%","12%","9%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("20","40","20","20","20","20","20","20");
    $tableProperties["precision"] = array("string","string","string","string","string","string","string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = 'Facility Entry Form';
	// $tableProperties["header_list"][2] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Facility_Entry_Form_';
}

function getUserList() {
     
	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT a.id, a.`name`, a.`email`, a.`password`, a.`designation`, a.`LangCode`, 
		c.role, LangName, b.role_id, b.user_id, a.loginname,e.FacilityName 
		FROM `users` a 
		LEFT JOIN user_role b ON a.id=b.user_id 
		LEFT JOIN roles c ON b.role_id=c.id
		INNER JOIN t_languages d ON a.`LangCode`=d.`LangCode`
		LEFT JOIN t_facility e ON a.`FacilityId`=e.`FacilityId`
		ORDER BY a.`name`;"; 
	
    $tableProperties["query_field"] = array("name", "email", "designation", "role","FacilityName", "LangName");
    $tableProperties["table_header"] = array($TEXT['Name'], $TEXT['Email'], $TEXT['Designation'], $TEXT['Role'], $TEXT['Facility Name'], $TEXT['Language']);
    $tableProperties["align"] = array("left","left","left","left","left","left");
    $tableProperties["width_print_pdf"] = array("15%","15%","15%","10%","30%","10%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("20","40","20","20","30","20");
    $tableProperties["precision"] = array("string","string","string","string","string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['User'];
	// $tableProperties["header_list"][2] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'User';
}

function GenericsExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `GenericName` FROM t_generics ORDER BY `GenericName`;";
	
    $tableProperties["query_field"] = array("GenericName");
    $tableProperties["table_header"] = array($TEXT['Generic Name']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Generic List']; 
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Generic_Entry_Form_';
}

function MOSRangeExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `MosTypeName`,`MinMos`,`MaxMos`,`ColorCode`,`MosLabel` FROM t_mostype ORDER BY `MosTypeId`;";
	
    $tableProperties["query_field"] = array("MosTypeName","MinMos","MaxMos","ColorCode","MosLabel");
    $tableProperties["table_header"] = array($TEXT['MOS Type'],$TEXT['Minimum MOS'],$TEXT['Maximum MOS'],$TEXT['Color Code'],$TEXT['MOS Label']);
    $tableProperties["align"] = array("left","center","center","left","left");
    $tableProperties["width_print_pdf"] = array("50%","10%","10%","10%","15%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("40","20","20","20","20");
    $tableProperties["precision"] = array("string",0,0,"string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,1,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['MOS Range List']; 
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'MOS_Range_List_';
}

function LocationExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `LocationId` id,`LocationName`,`ContactName`,`ContactNo`,`Email`,`LocationsAddress`
FROM t_location 
ORDER BY `LocationName` ASC;"; 
	
    $tableProperties["query_field"] = array("LocationName","ContactName","ContactNo","Email","LocationsAddress");
    $tableProperties["table_header"] = array($TEXT['Location Name'],$TEXT['Contact Name'],$TEXT['Contact No'],$TEXT['Email'],$TEXT['Location Address'],);
    $tableProperties["align"] = array("left","left","left","left","left");
    $tableProperties["width_print_pdf"] = array("20%","20%","20%","10%","25%",); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("30","30","30","30","50");
    $tableProperties["precision"] = array("string","string","string","string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Location List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Location_Entry_Form_';
}

function ATCExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `ATC`,`ATC_NAME` FROM t_atc ORDER BY `ATC_NAME`;"; 
	
	
    $tableProperties["query_field"] = array("ATC","ATC_NAME");
    $tableProperties["table_header"] = array($TEXT['Atc Code'],$TEXT['Atc Name']);
    $tableProperties["align"] = array("left","left");
    $tableProperties["width_print_pdf"] = array("10%","85%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("30","40");
    $tableProperties["precision"] = array("string","string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Atc List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Atc_Entry_Form_';
}

function FacilityEntryExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$bDispensingValue = $_REQUEST['bDispensingValue'];
	
	$RegionId =  $_REQUEST['RegionId'];
	$ZoneId =  $_REQUEST['ZoneId']; 
	$CommuneId =  $_REQUEST['CommuneId'];
	$OwnerTypeId =  $_REQUEST['OwnerTypeId'];
	$ServiceAreaId = $_REQUEST['ServiceAreaId']; 
	$FTypeId =  $_REQUEST['FTypeId']; 

	if ($bDispensingValue == "true"){
		$bDispenseFilter = "AND a.`bDispense` = 1";
		$bDispenseText = " - ".$TEXT['bDispensing'];
	}else{
		$bDispenseFilter = "";
		$bDispenseText = "";
	}

	$sql = "SELECT 
			a.`FacilityId` id, a.`CountryId`, a.`RegionId`, a.`ZoneId`, a.`FTypeId`, a.`FLevelId`,
			a.`FacilityCode`, a.`FacilityName`,`FLevelName`, `FTypeName`, a.`FacilityAddress`, a.`FacilityPhone`, a.`FacilityEmail`, a.`Latitude`, a.`Longitude`,
			a.`DistrictId`, a.`ServiceAreaId`, a.`OwnerTypeId`, a.`ExternalFacilityId`, a.`FacilityInCharge`,
			IFNULL(a.`bDispense`, 0) bDispense, a.`SOBAPSCode`, `RegionName`, e.`DistrictName` ,m.`ZoneName`,f.`OwnerTypeName`, 
	        g.`ServiceAreaName`, `FacilityInCharge`,CONCAT(a.`Latitude`,',', a.`Longitude`) as location,b.FLevelName
			
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
		

	$db = new Db();
	$header_title = $db->query($sql);
	
	if($RegionId==0){
		$RegionName = $TEXT['All Department'];
	}else{
	   $RegionName	= $header_title[count($header_title)-1]["RegionName"];
	}
	
	if($ZoneId==0){
		$ZoneName = $TEXT['All ZS'];
	}else{
	   $ZoneName	= $header_title[count($header_title)-1]["ZoneName"];
	}
	
	if($CommuneId==0){
		$DistrictName = $TEXT['All ZS'];
	}else{
	   $DistrictName	= $header_title[count($header_title)-1]["DistrictName"];
	}
	
	
	if($OwnerTypeId==0){
		$OwnerTypeName = $TEXT['All Owner Type'];
	}else{
	   $OwnerTypeName	= $header_title[count($header_title)-1]["OwnerTypeName"];
	}
	
	if($ServiceAreaId==0){
		$ServiceAreaName = $TEXT['All Service Area'];
	}else{
	   $ServiceAreaName	= $header_title[count($header_title)-1]["ServiceAreaName"];
	}
	
	if($FTypeId==0){
		$FTypeName = $TEXT['All Facility Type'];
	}else{
	   $FTypeName	= $header_title[count($header_title)-1]["FTypeName"];
	}
	
	
    $tableProperties["query_field"] = array("FacilityCode","FacilityName","FLevelName","FTypeName","RegionName",
	"ZoneName","DistrictName","OwnerTypeName","ServiceAreaName","FacilityAddress","Latitude","Longitude","FacilityInCharge","FacilityPhone",
	"FacilityEmail","ExternalFacilityId","SOBAPSCode", "bDispense");
    $tableProperties["table_header"] = array($TEXT['Facility Code'],$TEXT['Facility Name'],$TEXT['Facility Level'],$TEXT['Facility Type'],
	$TEXT['Department Name'],$TEXT['ZS Name'],$TEXT['Commune Name'],$TEXT['Owner Type'], 
	$TEXT['Service Area'],$TEXT['Facility Address'],$TEXT['Latitude'],
	$TEXT['Longitude'],$TEXT['Facility In-Charge'],$TEXT['Facility Phone'],$TEXT['Facility Email'],
	$TEXT['DHIS2 Facility Uid'],$TEXT['SOBAPS Client Code'],$TEXT['bDispensing']);
    $tableProperties["align"] = array("left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","left","center");
    $tableProperties["width_print_pdf"] = array("8%","18%","12%","12%","12%","12%","12%","12%","12%","12%","12%","12%","12%","12%","12%","12%","12%","12%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("20","40","20","20","20","20","20","20","20","20","20","20","20","20","20","20","20","20");
    $tableProperties["precision"] = array("string","string","string","string","string","string","string","string","string","string","string","string","string","string","string","string","string",0); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = 'Facility List';
	$tableProperties["header_list"][2] = $RegionName ." - ". $ZoneName." - ".$DistrictName;
	$tableProperties["header_list"][3] = $FTypeName." - ".$OwnerTypeName ." - ". $ServiceAreaName. $bDispenseText;
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Facility_List';
}

function SourceExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `SourceName` FROM t_source ORDER BY SourceName ASC;"; 
	
	
    $tableProperties["query_field"] = array("SourceName");
    $tableProperties["table_header"] = array($TEXT['Source Name']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Source List'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Source_Entry_Form_';
}

function StockSummaryExcelExport() {
     
	global $sql, $tableProperties, $TEXT, $siteTitle;

	$Year = isset($_REQUEST['Year']) ? $_REQUEST['Year'] : 0;
	$Month = isset($_REQUEST['Month']) ? $_REQUEST['Month'] : 0;
	$FacilityId = isset($_REQUEST['FacilityId']) ? $_REQUEST['FacilityId'] : 0;
	
	$sql = "SELECT ItemCode, ItemName, SUM(a.Stock) ClosingStock, SUM(AMC) AMC, 
	(CASE WHEN AMC>0 THEN (SUM(a.Stock) / SUM(AMC)) ELSE 0 END) MOS
	FROM `mv_cfm_stock` a 
	INNER JOIN t_itemlist_master b ON a.ItemNo=b.ItemNo
	WHERE (a.FacilityId = $FacilityId OR $FacilityId=0) 
	AND (a.Year = $Year OR $Year=0) 
	AND (a.MonthId = $Month OR $Month=0)
	GROUP BY ItemCode, a.ItemNo, ItemName
	ORDER BY ItemName;";
		
    $tableProperties["query_field"] = array("ItemCode", "ItemName", "ClosingStock", "AMC","MOS");
    $tableProperties["table_header"] = array($TEXT['Product Code'], $TEXT['Product Name'], $TEXT['Closing Balance'], $TEXT['AMC'], $TEXT['MOS']);
    $tableProperties["align"] = array("left","left","right","right","right");
    $tableProperties["width_print_pdf"] = array("15%","35%","15%","15%","15%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("20","60","20","20","20");
    $tableProperties["precision"] = array("string","string",0,0,2); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Stock Summary'];
	
	$db = new Db();
	$n_sql = "SELECT MonthNameFrench, (SELECT FacilityName FROM t_facility WHERE `FacilityId` = $FacilityId) FacilityName FROM `t_month` WHERE `MonthId` = $Month";
	
	$header_title = $db->query($n_sql);
	
	if($FacilityId==0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName	= $header_title[count($header_title)-1]["FacilityName"];
	}
	
	$MonthNameFrench	= $header_title[count($header_title)-1]["MonthNameFrench"];
	
	$tableProperties["header_list"][2] = $MonthNameFrench.", ".$Year;
	$tableProperties["header_list"][3] = $FacilityName;

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Stock_Summary';
}
function LabStockSummaryExcelExport() {
     
	global $sql, $tableProperties, $TEXT, $siteTitle;

	$Year = isset($_REQUEST['Year']) ? $_REQUEST['Year'] : 0;
	$Month = isset($_REQUEST['Month']) ? $_REQUEST['Month'] : 0;
	$FacilityId = isset($_REQUEST['FacilityId']) ? $_REQUEST['FacilityId'] : 0;
	
	
	$sql = "SELECT ItemCode, ItemName, SUM(a.Stock) ClosingStock, SUM(AMC) AMC, 
	(CASE WHEN AMC>0 THEN (SUM(a.Stock) / SUM(AMC)) ELSE 0 END) MOS
	FROM `mv_quarter_cfm_stock` a 
	INNER JOIN t_itemlist_master b ON a.ItemNo=b.ItemNo
	WHERE (a.FacilityId = $FacilityId OR $FacilityId=0) 
	AND (a.Year = $Year OR $Year=0) 
	AND (a.MonthId = $Month OR $Month=0)
	GROUP BY ItemCode, a.ItemNo, ItemName
	ORDER BY ItemName;";
		
    $tableProperties["query_field"] = array("ItemCode", "ItemName", "ClosingStock", "AMC","MOS");
    $tableProperties["table_header"] = array($TEXT['Product Code'], $TEXT['Product Name'], $TEXT['Closing Balance'], $TEXT['AMC'], $TEXT['MOS']);
    $tableProperties["align"] = array("left","left","right","right","right");
    $tableProperties["width_print_pdf"] = array("15%","45%","15%","10%","10%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("17","34","17","12","12");
    $tableProperties["precision"] = array("string","string",0,0,2); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0,0,0,0,0); //not total=0, total=1
    $tableProperties["color_code"] = array(0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Stock Summary'];
	
	$db = new Db();
	 $n_sql = "SELECT MonthName , (SELECT FacilityName FROM t_facility WHERE `FacilityId` = $FacilityId) FacilityName FROM `t_quarter` WHERE `MonthId` = $Month";
	
	$header_title = $db->query($n_sql);
	
	if($FacilityId==0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName	= $header_title[count($header_title)-1]["FacilityName"];
	}
	
	$MonthName	= $header_title[count($header_title)-1]["MonthName"];
	
	$tableProperties["header_list"][2] = $MonthName.", ".$Year;
	$tableProperties["header_list"][3] = $FacilityName;

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Lab_Stock_Summary';
}


function LMISReportExcelExport() {
     
	global $sql, $tableProperties, $TEXT, $siteTitle;

	$Year = isset($_REQUEST['Year']) ? $_REQUEST['Year'] : 0;
	$Month = isset($_REQUEST['Month']) ? $_REQUEST['Month'] : 0;
	$FacilityId = isset($_REQUEST['FacilityId']) ? $_REQUEST['FacilityId'] : 0;
	
	/* $sql = "SELECT ItemCode, ItemName, SUM(a.Stock) ClosingStock, SUM(AMC) AMC, 
	(CASE WHEN AMC>0 THEN (SUM(a.Stock) / SUM(AMC)) ELSE 0 END) MOS
	FROM `mv_cfm_stock` a 
	INNER JOIN t_itemlist_master b ON a.ItemNo=b.ItemNo
	WHERE (a.FacilityId = $FacilityId OR $FacilityId=0) 
	AND (a.Year = $Year OR $Year=0) 
	AND (a.MonthId = $Month OR $Month=0)
	GROUP BY ItemCode, a.ItemNo, ItemName
	ORDER BY ItemName;"; */

	
		
	$sql = "SELECT ItemCode, c.GroupName, b.ItemName, d.UnitName, 
	COALESCE(NULLIF(a.OpB,''), 'OpB') OpB, 
	COALESCE(NULLIF(a.RecB,''), 'RecB') RecB, 
	COALESCE(NULLIF(a.Consumption,''), 'Consumption') Consumption, 
	COALESCE(NULLIF(a.AdjB,''), 'AdjB') AdjB, 
	a.Stock, a.AMC, 
	case when a.StockMin = 0 then '' else a.StockMin end as StockMin,
	case when a.StockMax = 0 then '' else a.StockMax end as StockMax, 
	case when a.StockoutDays = 0 then '' else a.StockoutDays end as StockoutDays, a.MOS
	FROM `mv_cfm_stock` a 
	INNER JOIN t_itemlist_master b ON a.ItemNo=b.ItemNo
	INNER JOIN t_itemgroup c ON b.ItemGroupId=c.ItemGroupId
	INNER JOIN t_unitofmeas d ON b.UnitId=d.UnitId
	WHERE (a.FacilityId = $FacilityId OR $FacilityId=0) 
	AND (a.Year = $Year OR $Year=0) 
	AND (a.MonthId = $Month OR $Month=0)
	GROUP BY ItemCode, a.ItemNo, ItemName
	ORDER BY ItemName;";

	$tableProperties["query_field"] = array("ItemCode","GroupName", "ItemName", "UnitName", "OpB","RecB","Consumption","AdjB","Stock","AMC","StockMin","StockMax","StockoutDays","MOS");
	$tableProperties["table_header"] = array($TEXT['Product Code'], $TEXT['Groupe'], $TEXT['Designation'], $TEXT['Unit'], $TEXT['Opening Stock'], $TEXT['Receive'], $TEXT['Quantity Dispensed'], $TEXT['Adjustment'], $TEXT['Closing Balance'], $TEXT['AMC'], $TEXT['Stock minimum'], $TEXT['Stock maximum'], $TEXT['Stockout Days'], $TEXT['MOS']);
	$tableProperties["align"] = array("left","left","left","left","right","right","right","right","right","right","right","right","right","right");
	$tableProperties["width_print_pdf"] = array("15%","15%","35%","15%","15%","15%","15%","15%","15%","15%","15%","15%","15%","15%"); //when exist serial then here total 95% and 5% use for serial
	$tableProperties["width_excel"] = array("17","17","60","17","17","17","17","17","17","17","17","17","17","17");
	$tableProperties["precision"] = array("string","string","string","string",0,0,0,0,0,0,0,0,0,1); //string,date,datetime,0,1,2,3,4
	$tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
	$tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['LMIS Report'];
	
	$db = new Db();
	$n_sql = "SELECT MonthNameFrench, (SELECT FacilityName FROM t_facility WHERE `FacilityId` = $FacilityId) FacilityName FROM `t_month` WHERE `MonthId` = $Month";
	
	$header_title = $db->query($n_sql);
	
	if($FacilityId==0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName	= $header_title[count($header_title)-1]["FacilityName"];
	}
	
	$MonthNameFrench	= $header_title[count($header_title)-1]["MonthNameFrench"];
	
	$tableProperties["header_list"][2] = $MonthNameFrench.", ".$Year;
	$tableProperties["header_list"][3] = $FacilityName;

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'LMIS_Report';
}


function LabLMISReportExcelExport() {
     
	global $sql, $tableProperties, $TEXT, $siteTitle;

	$Year = isset($_REQUEST['Year']) ? $_REQUEST['Year'] : 0;
	$Month = isset($_REQUEST['Month']) ? $_REQUEST['Month'] : 0;
	$FacilityId = isset($_REQUEST['FacilityId']) ? $_REQUEST['FacilityId'] : 0;
	
	$sql = "SELECT ItemCode, c.GroupName, b.ItemName, d.UnitName, 
	COALESCE(NULLIF(a.OpB,''), 'OpB') OpB, 
	COALESCE(NULLIF(a.RecB,''), 'RecB') RecB, 
	COALESCE(NULLIF(a.Consumption,''), 'Consumption') Consumption, 
	COALESCE(NULLIF(a.AdjB,''), 'AdjB') AdjB, 
	a.Stock, a.AMC, 
	case when a.StockMin = 0 then '' else a.StockMin end as StockMin,
	case when a.StockMax = 0 then '' else a.StockMax end as StockMax, 
	case when a.StockoutDays = 0 then '' else a.StockoutDays end as StockoutDays, a.MOS
	FROM `mv_quarter_cfm_stock` a 
	INNER JOIN t_itemlist_master b ON a.ItemNo=b.ItemNo
	INNER JOIN t_itemgroup c ON b.ItemGroupId=c.ItemGroupId
	INNER JOIN t_unitofmeas d ON b.UnitId=d.UnitId
	WHERE (a.FacilityId = $FacilityId OR $FacilityId=0) 
	AND (a.Year = $Year OR $Year=0) 
	AND (a.MonthId = $Month OR $Month=0)
	GROUP BY ItemCode, a.ItemNo, ItemName
	ORDER BY ItemName;";

	/* $tableProperties["query_field"] = array("ItemCode","GroupName", "ItemName", "UnitName", "OpB","RecB","Consumption","AdjB","Stock","AMC","StockMin","StockMax","StockoutDays","MOS");
	$tableProperties["table_header"] = array($TEXT['Product Code'], $TEXT['Groupe'], $TEXT['Designation'], $TEXT['Unit'], $TEXT['Opening Stock'], $TEXT['Receive'], $TEXT['Quantity Dispensed'], $TEXT['Adjustment'], $TEXT['Closing Balance'], $TEXT['DMM'], $TEXT['Stock minimum'], $TEXT['Stock maximum'], $TEXT['Stockout Days'], $TEXT['MOS']);
	$tableProperties["align"] = array("left","left","left","left","right","right","right","right","right","right","right","right","right","right");
	$tableProperties["width_print_pdf"] = array("15%","15%","35%","15%","15%","15%","15%","15%","15%","15%","15%","15%","15%","15%"); //when exist serial then here total 95% and 5% use for serial
	$tableProperties["width_excel"] = array("17","17","60","17","17","17","17","17","17","17","17","17","17","17");
	$tableProperties["precision"] = array("string","string","string","string",0,0,0,0,0,0,0,0,0,1); //string,date,datetime,0,1,2,3,4
	$tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
	$tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
	$tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	*/

	$tableProperties["query_field"] = array("ItemCode","GroupName", "ItemName", "OpB","RecB","Consumption","AdjB","Stock","AMC","MOS");
	$tableProperties["table_header"] = array($TEXT['Product Code'], $TEXT['Groupe'], $TEXT['Designation'], $TEXT['Opening Stock'], $TEXT['Receive'], $TEXT['Quantity Dispensed'], $TEXT['Adjustment'], $TEXT['Closing Balance'], $TEXT['DMM'],$TEXT['MOS']);
	$tableProperties["align"] = array("left","left","left","right","right","right","right","right","right","right");
	$tableProperties["width_print_pdf"] = array("15%","15%","30%","15%","15%","20%","20%","20%","15%","15%"); //when exist serial then here total 95% and 5% use for serial
	$tableProperties["width_excel"] = array("17","17","60","17","17","20","20","20","17","17");
	$tableProperties["precision"] = array("string","string","string",0,0,0,0,0,0,1); //string,date,datetime,0,1,2,3,4
	$tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
	$tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Lab LMIS Report'];
	
	$db = new Db();
	$n_sql = "SELECT MonthNameFrench, (SELECT FacilityName FROM t_facility WHERE `FacilityId` = $FacilityId) FacilityName FROM `t_month` WHERE `MonthId` = $Month";
	
	$header_title = $db->query($n_sql);
	
	if($FacilityId==0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName	= $header_title[count($header_title)-1]["FacilityName"];
	}
	
	$MonthNameFrench	= $header_title[count($header_title)-1]["MonthNameFrench"];
	
	$tableProperties["header_list"][2] = $MonthNameFrench.", ".$Year;
	$tableProperties["header_list"][3] = $FacilityName;

	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Lab_LMIS_Report';
}


function ProductsNearingExpiryReportExcelExport() {
     
	global $sql, $tableProperties, $TEXT, $siteTitle;

	$RegionId = isset($_REQUEST['RegionId']) ? $_REQUEST['RegionId'] : 0;
	$ZoneId = isset($_REQUEST['ZoneId']) ? $_REQUEST['ZoneId'] : 0;
	$CommuneId = isset($_REQUEST['CommuneId']) ? $_REQUEST['CommuneId'] : 0;
	$FacilityId = isset($_REQUEST['FacilityId']) ? $_REQUEST['FacilityId'] : 0;
	$ItemNo = isset($_REQUEST['ItemNo']) ? $_REQUEST['ItemNo'] : 0;

	/* $startDate = date('Y-m-d', strtotime($_REQUEST['StartDate']));
	$endDate = date('Y-m-d', strtotime($_REQUEST['EndDate'])); */

	
	$startDate = $_REQUEST['StartDate'];
	$endDate = $_REQUEST['EndDate'];
	
	
	$sql = "SELECT `RegionName` `DepartmentName`,`ZoneName`,DistrictName CommuneName, v.FLevelName, FacilityName, b.ItemCode, b.CameCode, b.ItemName, a.BatchNo, a.ExpiryDate, 
		IFNULL(a.LotQty,0) LotQty, IFNULL(n.StockQty,0) StockQty, e.GroupName 
		FROM t_facility_product_lot a 
		INNER JOIN t_facility_product n ON a.FacilityId = n.FacilityId AND a.ItemNo=n.ItemNo 
		INNER JOIN t_itemlist_master b ON n.ItemNo = b.ItemNo 
		INNER JOIN t_itemgroup e ON b.ItemGroupId = e.ItemGroupId 
		INNER JOIN t_facility f ON a.FacilityId = f.FacilityId 
		INNER JOIN `t_facility_level` v ON f.FLevelId= v.FLevelId 
		INNER JOIN t_region d ON f.RegionId = d.RegionId 
		INNER JOIN t_districts k ON f.DistrictId = k.DistrictId 
		INNER JOIN t_zone m ON f.ZoneId = m.ZoneId 
		WHERE (f.RegionId = $RegionId OR $RegionId = 0)
		AND (f.ZoneId = $ZoneId OR $ZoneId = 0)
		AND (f.DistrictId = $CommuneId  OR $CommuneId  = 0)
		AND (f.FacilityId = $FacilityId OR $FacilityId = 0)
		AND (b.ItemNo = $ItemNo OR $ItemNo = 0)
		AND LotQty > 0 AND n.StockQty>0
		AND DATE(a.`ExpiryDate`) BETWEEN '$startDate' AND '$endDate' 
		ORDER BY FacilityName, b.ItemName, e.GroupName, a.ExpiryDate ASC ;";

	$tableProperties["query_field"] = array("FacilityName","DepartmentName", "ZoneName", "CommuneName", "ItemCode","ItemName","BatchNo","ExpiryDate","LotQty");
	$tableProperties["table_header"] = array($TEXT['Facility'], $TEXT['Department'], $TEXT['ZS'], $TEXT['Commune'], $TEXT['Product Code'], $TEXT['Product'], $TEXT['Lot No'], $TEXT['Expiry Date'], $TEXT['Quantity']);
	$tableProperties["align"] = array("left","left","left","left","left","left","left","left","right");
	$tableProperties["width_print_pdf"] = array("12%","7%","15%","10%","8%","25%","6%","7%","10%"); //when exist serial then here total 95% and 5% use for serial
	$tableProperties["width_excel"] = array("25","15","30","17","12","50","10","17","10");
	$tableProperties["precision"] = array("string","string","string","string","string","string","string","date",0); //string,date,datetime,0,1,2,3,4
	$tableProperties["total"] = array(0,0,0,0,0,0,0,0,0); //not total=0, total=1
	$tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1
	

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Products Nearing Expiry Report'];
	
	$db = new Db();

	$header_title = $db->query($sql);
	
	if($FacilityId == 0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName = $header_title[count($header_title)-1]["FacilityName"];
	}
	if($RegionId == 0){
		$DepartmentName = $TEXT['All Department'];
	}else{
	   $DepartmentName = $header_title[count($header_title)-1]["DepartmentName"];
	}
	if($ZoneId == 0){
		$ZoneName = $TEXT['All ZS'];
	}else{
	   $ZoneName = $header_title[count($header_title)-1]["ZoneName"];
	}
	
	if($CommuneId == 0){
		$CommuneName = $TEXT['All ZS'];
	}else{
	   $CommuneName = $header_title[count($header_title)-1]["CommuneName"];
	}
	
	if($ItemNo == 0){
		$ItemName = $TEXT['All Product'];
	}else{
	   $ItemName = $header_title[count($header_title)-1]["ItemName"];
	}
	
	//$tableProperties["header_list"][2] = $MonthNameFrench.", ".$Year;
	$tableProperties["header_list"][2] = $DepartmentName.", ".$ZoneName.", ".$CommuneName.", ".$FacilityName;
	$tableProperties["header_list"][3] = $ItemName;
	$tableProperties["header_list"][4] = $TEXT['From'].": ".date('d/m/Y', strtotime($_REQUEST['StartDate'])).", ".$TEXT['To'].": ".date('d/m/Y', strtotime($_REQUEST['EndDate']));
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Products_Nearing_Expiry_Report';
}

function LtfuBackReportExcelExport() {
     
	global $sql, $tableProperties, $TEXT, $siteTitle;

	$FacilityId = isset($_REQUEST['FacilityId']) ? $_REQUEST['FacilityId'] : 0;
	$Year = isset($_REQUEST['Year']) ? $_REQUEST['Year'] : 0;
	$Month = isset($_REQUEST['Month']) ? $_REQUEST['Month'] : 0;

	$startDate = $_REQUEST['StartDate'];
	$endDate = $_REQUEST['EndDate'];
	

	$sql = "SELECT 
		a.`Id`,
		a.`FacilityId`,
		a.`PatientId`,
		a.`ChangeType`,
		a.`YearID`,
		a.`MonthId`,
		a.`ChangeDate`,
		a.`PreChangeDate`,
		a.`PreProtocolId`,
		a.`PreRegimenId`,
		a.`ProtocolId`,
		a.`RegimenId`,
		f.FacilityName,
		g.registered, g.`idNumber`, g.`pass`, g.`ipn`, g.dob, b.GenderType gender,
		DATEDIFF(a.`ChangeDate`, a.`PreChangeDate`) AS ltfuDays, c.PrescriptionNumbar
	  FROM `t_patient_status_change` a
	  INNER JOIN t_facility f ON a.FacilityId = f.FacilityId
	  INNER JOIN `t_patient` g ON a.`PatientId` = g.PatientId
	  INNER JOIN t_gendertype b ON g.GenderTypeId=b.GenderTypeId
	  INNER JOIN t_prescription c ON a.PrescriptionId=c.PrescriptionId
	  WHERE ChangeType = 'LTFU Back'
	  AND (f.FacilityId = $FacilityId OR $FacilityId = 0)
	  AND MONTH(a.`ChangeDate`) = $Month AND YEAR(a.`ChangeDate`) = $Year
	  ORDER BY FacilityName ;";

	$tableProperties["query_field"] = array("FacilityName", "idNumber", "pass", "gender","dob","registered","PreChangeDate","ChangeDate","ltfuDays", "PrescriptionNumbar");
	$tableProperties["table_header"] = array($TEXT['Facility'], $TEXT['Register'], $TEXT['PAS'], $TEXT['Gender'], $TEXT['DoB'], $TEXT['Registered'], $TEXT['LTFU Date'], $TEXT['LTFU Back Date'],  $TEXT['LTFU Days'], $TEXT['LTFU Back Prescription No']);
	$tableProperties["align"] = array("left","left","left","left","left","left","left","left","right","left");
	$tableProperties["width_print_pdf"] = array("15%","7%","7%","7%","7%","7%","7%","7%","7%", "10%"); //when exist serial then here total 95% and 5% use for serial
	$tableProperties["width_excel"] = array("30","15","15","15","15","15","15","17","15","25");
	$tableProperties["precision"] = array("string","string","string","string","date","date","date","date",0,"string"); //string,date,datetime,0,1,2,3,4
	$tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
	$tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['LTFU Back Report'];
	
	$db = new Db();

	$n_sql = "SELECT MonthNameFrench, (SELECT FacilityName FROM t_facility WHERE `FacilityId` = $FacilityId) FacilityName FROM `t_month` WHERE `MonthId` = $Month";
	
	$header_title2 = $db->query($n_sql);
	
	if($FacilityId==0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName	= $header_title2[count($header_title2)-1]["FacilityName"];
	}
	
	$MonthNameFrench	= $header_title2[count($header_title2)-1]["MonthNameFrench"];
	
	$tableProperties["header_list"][2] = $MonthNameFrench.", ".$Year;
	$tableProperties["header_list"][3] = $FacilityName;

	$header_title = $db->query($sql);
	


	$tableProperties["report_save_name"] = 'LTFU_Back_Report';
}


function PreEPPatientsReportExcelExport() {
     
	global $sql, $tableProperties, $TEXT, $siteTitle;

	$FacilityId = isset($_REQUEST['FacilityId']) ? $_REQUEST['FacilityId'] : 0;
	$Year = isset($_REQUEST['Year']) ? $_REQUEST['Year'] : 0;
	$Month = isset($_REQUEST['Month']) ? $_REQUEST['Month'] : 0;

	$startDate = $_REQUEST['StartDate'];
	$endDate = $_REQUEST['EndDate'];
	

	$sql = "SELECT 
		f.FacilityName,
		DATE(g.registered) registered, g.`idNumber`, g.`pass`, g.`ipn`, DATE(g.dob) dob, b.GenderType gender, 
		IFNULL(DATE(g.defaulter), '') defaulter,
		d.MaritalStatus,
		'' `AppointmentDate`,
		'' `PostDate`,
		'' PrescriptionNumbar, '' ltfuDays
	FROM `t_patient_by_month` g
	INNER JOIN t_facility f ON g.FacilityId = f.FacilityId
	INNER JOIN t_gendertype b ON g.GenderTypeId=b.GenderTypeId
	LEFT JOIN t_marital_status d ON g.MaritalStatusId=d.MaritalStatusId
	WHERE (g.FacilityId = $FacilityId OR $FacilityId = 0)
	AND g.YearID= $Year
	AND g.MonthId= $Month
	AND g.PreEP = 1
	ORDER BY FacilityName, g.`idNumber`;";

	
	$tableProperties["query_field"] = array("FacilityName", "idNumber", "pass", "gender","dob","registered","MaritalStatus");
	$tableProperties["table_header"] = array($TEXT['Facility'], $TEXT['Register'], $TEXT['PAS'], $TEXT['Gender'], $TEXT['DoB'], $TEXT['Registered'], $TEXT['Marital Status']);
	$tableProperties["align"] = array("left","left","left","left","left","left","left");
	$tableProperties["width_print_pdf"] = array("15%","7%","7%","7%","7%","7%","7%"); //when exist serial then here total 95% and 5% use for serial
	$tableProperties["width_excel"] = array("30","25","15","15","15","15","8");
	$tableProperties["precision"] = array("string","string","string","string","date","date","string"); //string,date,datetime,0,1,2,3,4
	$tableProperties["total"] = array(0,0,0,0,0,0,0,0,); //not total=0, total=1
	$tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['PreEP Patients Report'];
	
	$db = new Db();

	$db = new Db();
	$n_sql = "SELECT MonthNameFrench, (SELECT FacilityName FROM t_facility WHERE `FacilityId` = $FacilityId) FacilityName FROM `t_month` WHERE `MonthId` = $Month";
	
	$header_title2 = $db->query($n_sql);
	
	if($FacilityId==0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName	= $header_title2[count($header_title2)-1]["FacilityName"];
	}
	
	$MonthNameFrench	= $header_title2[count($header_title2)-1]["MonthNameFrench"];
	
	$tableProperties["header_list"][2] = $MonthNameFrench.", ".$Year;
	$tableProperties["header_list"][3] = $FacilityName;

	$header_title = $db->query($sql);
	
	$tableProperties["report_save_name"] = 'PreEP_Patients_Report';
}


function PatientReportUnderIOExcelExport() {
     
	global $sql, $tableProperties, $TEXT, $siteTitle;

	$FacilityId = isset($_REQUEST['FacilityId']) ? $_REQUEST['FacilityId'] : 0;
	$Year = isset($_REQUEST['Year']) ? $_REQUEST['Year'] : 0;
	$Month = isset($_REQUEST['Month']) ? $_REQUEST['Month'] : 0;

	$startDate = $_REQUEST['StartDate'];
	$endDate = $_REQUEST['EndDate'];
	

	$sql = "SELECT 
	k.ItemName,
	a.`AppointmentDate`,
	a.`PostDate`,
	f.FacilityName,
	DATE(g.registered) registered, g.`idNumber`, g.`pass`, g.`ipn`, DATE(g.dob) dob, b.GenderType gender, IFNULL(DATE(g.defaulter), '') defaulter,
	a.PrescriptionNumbar, DATEDIFF(NOW(), a.AppointmentDate) AS ltfuDays
FROM `t_prescription` a
INNER JOIN `t_prescription_details` j ON a.PrescriptionId = j.PrescriptionId
INNER JOIN `t_itemlist_master` k ON j.`ItemNo` = k.ItemNo
INNER JOIN `t_patient` g ON a.`PatientId` = g.PatientId
INNER JOIN t_facility f ON g.FacilityId = f.FacilityId
INNER JOIN t_gendertype b ON g.GenderTypeId=b.GenderTypeId
WHERE (g.FacilityId = $FacilityId OR $FacilityId = 0)
AND MONTH(a.`PostDate`) = $Month AND YEAR(a.`PostDate`) = $Year
AND a.StatusId = 1
AND k.`ProductTypeId` = 4
ORDER BY FacilityName;";

	
	$tableProperties["query_field"] = array("FacilityName", "ItemName", "idNumber", "pass", "gender","dob","registered","AppointmentDate", "PrescriptionNumbar", "PostDate");
	$tableProperties["table_header"] = array($TEXT['Facility'], $TEXT['Product Name'],  $TEXT['Register'], $TEXT['PAS'], $TEXT['Gender'], $TEXT['DoB'], $TEXT['Registered'], $TEXT['Appointment Date'], $TEXT['Prescription No'], $TEXT['Prescription Post Date'] );
	$tableProperties["align"] = array("left","left","left","left","left","left","left","left","left","left");
	$tableProperties["width_print_pdf"] = array("15%","15%","7%","7%","7%","7%","7%","7%","9%","10%"); //when exist serial then here total 95% and 5% use for serial
	$tableProperties["width_excel"] = array("30","30","15","15","15","15","15","15","18","20");
	$tableProperties["precision"] = array("string","string","string","string","string","date","date","date","string","date"); //string,date,datetime,0,1,2,3,4
	$tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
	$tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Patient Report under IO'];
	
	$db = new Db();

	$db = new Db();
	$n_sql = "SELECT MonthNameFrench, (SELECT FacilityName FROM t_facility WHERE `FacilityId` = $FacilityId) FacilityName FROM `t_month` WHERE `MonthId` = $Month";
	
	$header_title2 = $db->query($n_sql);
	
	if($FacilityId==0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName	= $header_title2[count($header_title2)-1]["FacilityName"];
	}
	
	$MonthNameFrench	= $header_title2[count($header_title2)-1]["MonthNameFrench"];
	
	$tableProperties["header_list"][2] = $MonthNameFrench.", ".$Year;
	$tableProperties["header_list"][3] = $FacilityName;

	$header_title = $db->query($sql);
	
	$tableProperties["report_save_name"] = 'Patient_Report_under_IO';
}


function LTFULosttoSightReportExport() {
     
	global $sql, $tableProperties, $TEXT, $siteTitle;

	$FacilityId = isset($_REQUEST['FacilityId']) ? $_REQUEST['FacilityId'] : 0;
	$startDate = $_REQUEST['StartDate'];

	$sql = "SELECT f.FacilityName, a.registered, a.`idNumber`, a.`pass`, a.`ipn`, 
	a.dob, b.GenderType gender, a.defaulter,  DATEDIFF(NOW(), a.defaulter) AS ltfuDays
	FROM `t_patient` a
	INNER JOIN t_facility f ON a.FacilityId = f.FacilityId
	INNER JOIN t_gendertype b ON a.GenderTypeId=b.GenderTypeId
	WHERE (f.FacilityId = $FacilityId OR $FacilityId = 0)
	AND a.ltfu = 1 and a.defaulter is not null
	ORDER BY FacilityName ;";

	$tableProperties["query_field"] = array("FacilityName", "idNumber", "pass", "gender","dob","registered","defaulter","ltfuDays");
	$tableProperties["table_header"] = array($TEXT['Facility'], $TEXT['Register'], $TEXT['PAS'], $TEXT['Gender'], $TEXT['DoB'], $TEXT['Registered'], $TEXT['LTFU Date'], $TEXT['LTFU Days']);
	$tableProperties["align"] = array("left","left","left","left","left","left","left","right");
	$tableProperties["width_print_pdf"] = array("15%","7%","7%","7%","7%","7%","7%","7%"); //when exist serial then here total 95% and 5% use for serial
	$tableProperties["width_excel"] = array("30","15","15","15","15","15","15","15");
	$tableProperties["precision"] = array("string","string","string","string","date","date","date",0); //string,date,datetime,0,1,2,3,4
	$tableProperties["total"] = array(0,0,0,0,0,0,0,0); //not total=0, total=1
	$tableProperties["color_code"] = array(0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['LTFU Lost to Sight Report'];
	
	$db = new Db();

	$header_title = $db->query($sql);
	
	if($FacilityId == 0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName = $header_title[count($header_title)-1]["FacilityName"];
	}

	$tableProperties["header_list"][2] = $FacilityName.', '.$TEXT['Date'].': '.$startDate;
	//$tableProperties["header_list"][3] = $TEXT['From'].": ".date('d/m/Y', strtotime($_REQUEST['StartDate'])).", ".$TEXT['To'].": ".date('d/m/Y', strtotime($_REQUEST['EndDate']));
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'LTFU_Lost_to_Sight_Report';
}


function MissedAppointmentswithDaysPrecisionReportExport() {
     
	global $sql, $tableProperties, $TEXT, $siteTitle;

	$FacilityId = isset($_REQUEST['FacilityId']) ? $_REQUEST['FacilityId'] : 0;
	$startDate = $_REQUEST['StartDate'];

	$sql = "SELECT g.`NextAppointmentDate` AS `AppointmentDate`,f.FacilityName,DATE(g.registered) registered, g.`idNumber`, g.`pass`, g.`ipn`, 
		DATE(g.dob) dob, b.GenderType gender, IFNULL(DATE(g.defaulter), '') defaulter,
		(SELECT p.PrescriptionNumbar FROM t_prescription p WHERE p.PrescriptionId=g.`LastPrescriptionId` AND p.`DemanderId`=g.FacilityId ) PrescriptionNumbar, 
		DATEDIFF(NOW(), g.NextAppointmentDate) AS ltfuDays, g.`LastPrescriptionId`
		
		FROM `t_patient` g
		INNER JOIN t_facility f ON g.FacilityId = f.FacilityId
		INNER JOIN t_gendertype b ON g.GenderTypeId=b.GenderTypeId
		WHERE (g.FacilityId = $FacilityId OR $FacilityId = 0)
		AND g.`active` = 1
		AND g.`NextAppointmentDate` < CURDATE()
		ORDER BY FacilityName;";


	/* $sql = "SELECT 
			a.`AppointmentDate`,
			f.FacilityName,
			DATE(g.registered) registered, g.`idNumber`, g.`pass`, g.`ipn`, DATE(g.dob) dob, b.GenderType gender, IFNULL(DATE(g.defaulter), '') defaulter
			,a.PrescriptionNumbar, DATEDIFF(NOW(), a.AppointmentDate) AS ltfuDays
		FROM `t_prescription` a
		INNER JOIN `t_patient` g ON a.`PatientId` = g.PatientId
		INNER JOIN t_facility f ON g.FacilityId = f.FacilityId
		INNER JOIN t_gendertype b ON g.GenderTypeId=b.GenderTypeId
		WHERE (g.FacilityId = $FacilityId OR $FacilityId = 0)
		AND a.StatusId = -1
		AND a.`AppointmentDate` < CURDATE()
		ORDER BY FacilityName;"; */

	$tableProperties["query_field"] = array("FacilityName", "idNumber", "pass", "gender","dob","registered","AppointmentDate","ltfuDays","PrescriptionNumbar");
	$tableProperties["table_header"] = array($TEXT['Facility'], $TEXT['Register'], $TEXT['PAS'],$TEXT['Gender'], $TEXT['DoB'], $TEXT['Registered'], $TEXT['Appointment Date'], $TEXT['Appointment Missed Days'], $TEXT['Prescription No']);
	$tableProperties["align"] = array("left","left","left","left","left","left","left","right","left");
	$tableProperties["width_print_pdf"] = array("15%","7%","7%","7%","7%","7%","10%","12%","10%"); //when exist serial then here total 95% and 5% use for serial
	$tableProperties["width_excel"] = array("30","15","15","15","15","15","18","20","20");
	$tableProperties["precision"] = array("string","string","string","string","date","date","date",0,"string"); //string,date,datetime,0,1,2,3,4
	$tableProperties["total"] = array(0,0,0,0,0,0,0,0,0); //not total=0, total=1
	$tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Missed Appointments with Days Precision Report'];
	
	$db = new Db();

	$header_title = $db->query($sql);
	
	if($FacilityId == 0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName = $header_title[count($header_title)-1]["FacilityName"];
	}

	$tableProperties["header_list"][2] = $FacilityName.', '.$TEXT['Date'].': '.$startDate;
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Missed_Appointments_with_Days_Precision_Report';
}


function KeyPopulationsActiveQueueReportExport() {
     
	global $sql, $tableProperties, $TEXT, $siteTitle;

	$FacilityId = isset($_REQUEST['FacilityId']) ? $_REQUEST['FacilityId'] : 0;
	$KeypopulationTypeId = isset($_REQUEST['KeypopulationTypeId']) ? $_REQUEST['KeypopulationTypeId'] : 0;
	$startDate = $_REQUEST['StartDate'];

	$sql = "SELECT 
			f.FacilityName,
			DATE(a.registered) registered, a.`idNumber`, a.`pass`, a.`ipn`, DATE(a.dob) dob, b.GenderType gender, IFNULL(DATE(a.defaulter), '') defaulter
		,c.`KeypopulationType`,c.`KeypopulationTypeFull`, CONCAT(c.`KeypopulationType`,': ',c.`KeypopulationTypeFull`) AS KeypopulationTypeName
		,d.MaritalStatus, g.protocolName AS currentProtocolName, h.MmdName, a.active
		FROM `t_patient` a
		INNER JOIN t_facility f ON a.FacilityId = f.FacilityId
		INNER JOIN t_gendertype b ON a.GenderTypeId=b.GenderTypeId
		INNER JOIN t_keypopulationtype c ON a.KeypopulationTypeId=c.KeypopulationTypeId
		LEFT JOIN t_marital_status d ON a.MaritalStatusId=d.MaritalStatusId
		LEFT JOIN t_protocol g ON a.ProtocolId=g.ProtocolId 
		LEFT JOIN t_mmd_status h ON a.MmdId=h.MmdId
		WHERE (a.FacilityId = $FacilityId OR $FacilityId = 0)
		AND a.KeypopulationTypeId IS NOT NULL
		AND (a.KeypopulationTypeId = $KeypopulationTypeId OR $KeypopulationTypeId = 0)
		ORDER BY FacilityName, c.`KeypopulationType` ASC;";

	$tableProperties["query_field"] = array("FacilityName", "KeypopulationType", "idNumber", "pass", "dob","gender","MaritalStatus","MmdName","currentProtocolName","registered","active");
	$tableProperties["table_header"] = array($TEXT['Facility'], $TEXT['Key Population Type'], $TEXT['Register'], $TEXT['PAS'], $TEXT['DoB'], $TEXT['Gender'], $TEXT['Marital Status'], $TEXT['MMD Status'], $TEXT['Current Regimen'], $TEXT['Registered'],$TEXT['Active']);
	$tableProperties["align"] = array("left","left","left","left","left","left","left","left","left","left","center");
	$tableProperties["width_print_pdf"] = array("15%","7%","7%","7%","7%","7%","7%","7%","7%","7%","7%"); //when exist serial then here total 95% and 5% use for serial
	$tableProperties["width_excel"] = array("30","18","15","15","15","15","15","18","18","15","8","8");
	$tableProperties["precision"] = array("string","string","string","string","date","string","string","string","string","date",0); //string,date,datetime,0,1,2,3,4
	$tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
	$tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Key Populations Active Queue report'];
	
	$db = new Db();

	$n_sql = "SELECT FacilityName FROM t_facility WHERE `FacilityId` = $FacilityId";
	
	$header_title2 = $db->query($n_sql);

	$header_title = $db->query($sql);
	
	if($FacilityId == 0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName = $header_title2[count($header_title2)-1]["FacilityName"];
	}

	$tableProperties["header_list"][2] = $FacilityName.', '.$TEXT['Date'].': '.$startDate;;
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Key_Populations_Active_Queue_Report';
}

function InformationSheetForPLHIVPatientsOnINHProphylaxisExport() {
     
	global $sql, $tableProperties, $TEXT, $siteTitle;

	$FacilityId = isset($_REQUEST['FacilityId']) ? $_REQUEST['FacilityId'] : 0;
	$startDate = $_REQUEST['StartDate'];
	$PreviouslyReceivedINHYes = $TEXT['Yes'];
	$PreviouslyReceivedINHNo = $TEXT['No'];
	$currDate = date("Y-m-d");

	$sql = "SELECT 
	f.FacilityName, DATE(a.registered) registered, a.`idNumber`, DATE(a.dob) dob, b.GenderType gender, a.active,
	(CASE WHEN (DATEDIFF('$currDate', a.`dob`)/365) < 15 THEN 1 ELSE '' END) AS `LessThan15`,
	(CASE WHEN (DATEDIFF('$currDate', a.`dob`)/365) BETWEEN 15 AND 24.99 THEN 1 ELSE '' END) AS `15to24`,
	(CASE WHEN (DATEDIFF('$currDate', a.`dob`)/365) BETWEEN 25 AND 49.99 THEN 1 ELSE '' END) AS `25to49`,
	(CASE WHEN (DATEDIFF('$currDate', a.`dob`)/365) >= 50 THEN 1 ELSE '' END) AS `50Plus`,
	CASE WHEN a.InhIsPrevious = 0 THEN '$PreviouslyReceivedINHNo' ELSE '$PreviouslyReceivedINHYes' END InhIsPrevious, 
	DATE(a.InhStartDate) InhStartDate, DATE(a.InhEndDate) InhEndDate
	FROM `t_patient` a
	INNER JOIN t_facility f ON a.FacilityId = f.FacilityId
	INNER JOIN t_gendertype b ON a.GenderTypeId=b.GenderTypeId
	WHERE (a.FacilityId = $FacilityId OR $FacilityId = 0)
	AND (a.InhIsPrevious = 1 OR a.InhStartDate IS NOT NULL OR a.InhEndDate IS NOT NULL)
	ORDER BY FacilityName ASC, a.`idNumber` ASC;";

	$tableProperties["query_field"] = array("FacilityName", "registered", "idNumber", "gender", "LessThan15","15to24","25to49","50Plus","InhIsPrevious","InhStartDate","InhEndDate");
	$tableProperties["table_header"] = array($TEXT['Facility'], $TEXT['Date'], $TEXT['Patient Code'], $TEXT['Gender (M/F)'], $TEXT['Age'].' <15', $TEXT['Age'].' 15-24', $TEXT['Age'].' 25-49', $TEXT['Age'].' 50+', $TEXT['Has the patient previously received INH treatment?'], $TEXT['Start date of current preventive therapy with INHagainst tuberculosis'],$TEXT['End date of current preventive therapy with INHagainst tuberculosis']);
	$tableProperties["align"] = array("left","left","left","left","center","center","center","center","center","left","center");
	$tableProperties["width_print_pdf"] = array("15%","7%","7%","7%","7%","7%","7%","7%","7%","7%","7%"); //when exist serial then here total 95% and 5% use for serial
	$tableProperties["width_excel"] = array("30","18","15","15","15","15","15","18","18","15","10");
	$tableProperties["precision"] = array("string","date","string","string",0,0,0,0,"string","date","date"); //string,date,datetime,0,1,2,3,4
	$tableProperties["total"] = array(0,0,0,0,0,0,0,0,0,0,0); //not total=0, total=1
	$tableProperties["color_code"] = array(0,0,0,0,0,0,0,0,0,0,0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 1; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 1; //include footer signatory. 0 or 1

	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Information sheet for PLHIV patients on INH prophylaxis'];
	
	$db = new Db();

	$n_sql = "SELECT FacilityName FROM t_facility WHERE `FacilityId` = $FacilityId";
	
	$header_title2 = $db->query($n_sql);

	$header_title = $db->query($sql);
	
	if($FacilityId == 0){
		$FacilityName = $TEXT['All Facility'];
	}else{
	   $FacilityName = $header_title2[count($header_title2)-1]["FacilityName"];
	}

	$tableProperties["header_list"][2] = $FacilityName.', '.$TEXT['Date'].': '.$startDate;;
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Information_sheet_for_plhiv_patients_on_inh_prophylaxis';
}


function RegimenExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `RegimenName` FROM t_regimen ORDER BY `RegimenName`;"; 
	
    $tableProperties["query_field"] = array("RegimenName");
    $tableProperties["table_header"] = array($TEXT['Regimen Name']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Regimen'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'Protocol_';
}
function AgeGroupExport() {

	global $sql, $tableProperties, $TEXT, $siteTitle;

	$sql = "SELECT `AgeGroupName` FROM t_age_group ORDER BY `AgeGroupName`;"; 
	
    $tableProperties["query_field"] = array("AgeGroupName");
    $tableProperties["table_header"] = array($TEXT['Age Group']);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("60");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1
    
	//Report header list
	$tableProperties["header_list"][0] = $siteTitle;
	$tableProperties["header_list"][1] = $TEXT['Age Group'];
	// $tableProperties["header_list"][1] = 'Heading 2';
	
	//Report save name. Not allow any type of special character
	$tableProperties["report_save_name"] = 'AgeGroup_Entry_Form_';
}


function getYearEntryData() {
	global $sql, $tableProperties, $TEXT, $siteTitle;

    $sql = "SELECT YearName FROM t_year ORDER BY YearName";

    $tableProperties["query_field"] = array("YearName");
    $tableProperties["table_header"] = array($TEXT["Year"]);
    $tableProperties["align"] = array("left");
    $tableProperties["width_print_pdf"] = array("95%"); //when exist serial then here total 95% and 5% use for serial
    $tableProperties["width_excel"] = array("30");
    $tableProperties["precision"] = array("string"); //string,date,datetime,0,1,2,3,4
    $tableProperties["total"] = array(0); //not total=0, total=1
    $tableProperties["color_code"] = array(0); //colorcode field = 1 not color code field = 0
	$tableProperties["header_logo"] = 0; //include header left and right logo. 0 or 1
    $tableProperties["footer_signatory"] = 0; //include footer signatory. 0 or 1

	
//Report header list
$tableProperties["header_list"][0] = $siteTitle;
$tableProperties["header_list"][1] = $TEXT['Year List'];
//Report save name. Not allow any type of special character
$tableProperties["report_save_name"] = $TEXT['Year List'];

}

//==================================================================================
//=================Dynamic Export Print, Excel, Pdf, CSV============================
//==================================================================================


	$db = new Db();

	//Execute sql command
	$result = $db->query($sql);

	

	$serial = 0;
	$useSl = 1;
	$columnTotalList = array();
	$reportHeaderList = $tableProperties["header_list"];

	$reportType = $_REQUEST['reportType'];
	$reportSaveName = str_replace(' ', '_', $tableProperties["report_save_name"]);


	//Table Header Start
	if ($reportType == 'print' || $reportType == 'pdf') {

		echo '<!DOCTYPE html>
		<html>
			 <head>
				<meta name="viewport" content="width=device-width, initial-scale=1.0" />	
				<meta http-equiv="content-type" content="text/html; charset=utf-8" />
				<link href="css/bootstrap.min.css" rel="stylesheet"/>
				<link href="css/font-awesome.min.css" rel="stylesheet"/>
				<link href="css/custom.css" rel="stylesheet"/>
				<link href="css/base.css" rel="stylesheet"/>
				<link href="css/exportstyle.css" rel="stylesheet"/>
			<style>
				body {
					color:#727272;
				}
				table.display tr.even.row_selected td {
    				background-color: #4DD4FD;
			    }    
			    table.display tr.odd.row_selected td {
			    	background-color: #4DD4FD;
			    }
			    .SL{
			        text-align: center !important;
			    }
				.right-aln{
					text-align: right !important;
				}
				.left-aln{
					text-align: left !important;
				}
				.center-aln {
					text-align: center !important;
				}
			    td.Countries{cursor: pointer;}
			    th, td {
					border: 1px solid #e4e4e4 !important;
				}
				.margin-bottom {
					margin-bottom: 40px;
				}


				.BottomDiv{
					width:30%;
					text-align:center;
					display: block;
				}
				.content_area {
						text-align: center;
						font-size: 14px;
						font-weight: bold;
					}
	
					.margin_top{
						margin-top: 10px;
					}
					.margin_button{
						margin-bottom:120px;
					}
					.footer_Padding{
						border: 1px solid #ccc;
						min-height: 130px;
						padding-top: 10px;
					}
					.marginTop0{
						margin-top: 0px;
					}
			</style>
			</head>
			<body><div class="container-fluid margin-bottom">
			<div class="row"> 
			<div class="col-md-12">
          	<div class="table-responsive">
           	<div class="panel-heading" style="text-align:center;">';
			
			$reportHeaderListCount = count($reportHeaderList);
			
			//Report Header
			 for($i=0; $i<$reportHeaderListCount; $i++){
				if($i==0){
					if($tableProperties["header_logo"] == 1){
						echo '<div class="row margin_top">

						<div class="col-md-4 col-sm-4 col-lg-4">
							<div class="content-body" style="text-align:left;">
							<img src="images/logo.png" alt="National health family logo" style="width: 90px;height: auto;">
							</div>
						</div>

						<div class="col-md-4 col-sm-4 col-lg-4">
							<div class="content-body_text">
								<div class="content_area">
								
									<h4>'.$reportHeaderList[$i].'</h4>
									
								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-4 col-lg-4">
							<div class="content-body">
							<img src="images/benin_logo.png" alt="National health family logo" style="float: right;width: 65px;height: auto;">
							</div>
						</div>
					</div>';
					}else{
						echo '<div class="row margin_top">

						<div class="col-md-12 col-sm-12 col-lg-12">
							<div class="content-body_text">
								<div class="content_area">
								
									<h4>'.$reportHeaderList[$i].'</h4>
									
								</div>
							</div>
						</div>

					</div>';
					}
				}


					//echo '<h2>'.$reportHeaderList[$i].'</h2>';
				else if($i==1)
					echo '<h5 class="marginTop0">'.$reportHeaderList[$i].'</h5>';
				else
					echo '<h5>'.$reportHeaderList[$i].'</h5>';
			}
			
			echo '</div>';
			
			
		$fontsize = "";
		if ($reportType == 'pdf') {
			$fontsize = "font-size:10px;";
		}
		echo '<table class="table table-striped table-bordered display" cellspacing="0" cellpadding="5" width="100%" border="0.5" style="margin:0 auto; ' . $fontsize . '">    	
				<tbody><tr>';

		if ($useSl > 0) {
			echo '<th style="width:5%; text-align:center;"><strong>SL.</strong></th>';
		}

		foreach ($tableProperties["table_header"] as $index => $header) {
			echo '<th style="width:' . $tableProperties["width_print_pdf"][$index] . '; text-align:' . $tableProperties["align"][$index] . ';"><strong>' . $header . '</strong></th>';
		}
		echo '</tr>';


		
		
	} else if ($reportType == 'excel') {

		//include xlsxwriter
		set_include_path( get_include_path().PATH_SEPARATOR);
		include_once("xlsxwriter/xlsxwriter.class.php");
		
		///////////for logo left and right header 29/03/2023
		require_once("xlsxwriter/xlsxwriterplus.class.php");
		///////////for logo left and right header 29/03/2023
		
		
		$sheetName = "Data";
		$rowStyle = array('border' => 'left,right,top,bottom', 'border-style' => 'thin');

		///////////for logo left and right header 29/03/2023. off first line and add 2nd line
		// $writer = new XLSXWriter();
		$writer = new XLSWriterPlus();
		///////////for logo left and right header 29/03/2023

		$tableHeaderList = array();

		if ($useSl > 0) {
			$tableHeaderList["SL."] = '0';
			array_unshift($tableProperties["width_excel"], 8);
		}

		foreach ($tableProperties["table_header"] as $index => $header) {
			
			$header = remove_html_tag($header);
			
			if (is_numeric($tableProperties["precision"][$index])) {
				// $tableHeaderList[$fieldLabelList[getActualFieldName($val)]] = '0.0';
				$precision = $tableProperties["precision"][$index];
				$format = "#,##0";
				if ($precision > 0) {
					$decimalPoint = ".";
					$decimalPoint = str_pad($decimalPoint, ($precision + 1), "0", STR_PAD_RIGHT);
					$format = "#,##0" . $decimalPoint;
				}
				// $tableHeaderList[$fieldLabelList[getActualFieldName($val)]] = '#,##0.0';
				$tableHeaderList[$header] = $format;
			} else {
				$tableHeaderList[$header] = '@';
			}
		}

		//For multiline report title 13/11/2022
		$reporttitle = $reportHeaderList[0];
		$reporttitlelist = explode('<br/>',$reporttitle);
		if(count($reporttitlelist) > 1){
			$reportHeaderList[0] = $reporttitlelist[count($reporttitlelist)-1];
			for($h=(count($reporttitlelist)-2); $h>=0; $h-- ){
				array_unshift($reportHeaderList, $reporttitlelist[$h]);
			}
		}
		//For multiline report title 13/11/2022
	

		////////last column width max 8 because of logo width 29/03/2023
		if($tableProperties["header_logo"] == 1){
			$lastcolw = $tableProperties["width_excel"][count($tableProperties["width_excel"])-1];
			if($lastcolw>8){
				$tableProperties["width_excel"][count($tableProperties["width_excel"])-1] = 10;
			}
		}
		////////last column width max 8 because of logo width 29/03/2023


		$writer->writeSheetHeader(
				$sheetName, $tableHeaderList, array(
			// 'widths'=>array(5,20,20,20,20,20,15,15,15,15,15,10,10),
			'widths' => $tableProperties["width_excel"],
			'font-style' => 'bold',
			'font-size' => 11,
			'fill' => '#b4c6e7',
			'border' => 'left,right,top,bottom',
			'border-style' => 'thin',
			'halign' => 'left',
			'fitToWidth' => '1',
			// 'report_headers'=>array('Health Comodity Mangement','Stock status data', 'Year: 2018, Month: January')
			'report_headers' => $reportHeaderList
				)
		);
		//Report Header and table header end
	} else if ($reportType == 'csv') {

		$writer = WriterFactory::create(Type::CSV);
		$writer->openToFile("media/$reportSaveName.csv");
	
		//Report Header start
		foreach ($reportHeaderList as $val) {
			$writer->addRow([$val]);
		}
		//Report Header end
		//Table Header start
		$tableHeaderList = array();
		if ($useSl > 0) {
			$tableHeaderList[] = "SL.";
		}

		foreach ($tableProperties["table_header"] as $index => $header) {
			$tableHeaderList[] = $header;
		}
		$writer->addRow($tableHeaderList); //$writer->addRow(['A','B']);
		//Table Header end
	}
	//Table Header End
	//Data list start
	foreach ($result as $row) {
		if ($reportType == 'print' || $reportType == 'pdf') {
			echo '<tr>';

			if ($useSl > 0) {
				echo '<td style="width:5%; text-align:center;">' . ++$serial . '</td>';
			}

			foreach ($tableProperties["query_field"] as $index => $fieldName) {

				if ($tableProperties["color_code"][$index] == 1) {
					echo '<td style="width:' . $tableProperties["width_print_pdf"][$index] . '; background-color:' . $row[$fieldName] . ';"></td>';
				} else {
					echo '<td style="width:' . $tableProperties["width_print_pdf"][$index] . '; text-align:' . $tableProperties["align"][$index] . ';">' . getValueFormat($row[$fieldName], $tableProperties["precision"][$index], $reportType) . '</td>';
				}

				if ($tableProperties["total"][$index] == 1) {
					if (array_key_exists($index, $columnTotalList)) {
						$columnTotalList[$index] += $row[$fieldName];
					} else {
						$columnTotalList[$index] = $row[$fieldName];
					}
				} else {
					$columnTotalList[$index] = "";
				}
			}
			echo '</tr>';
			
		} else if ($reportType == 'excel') {

			$isColorCode = false;
			if (in_array(1, $tableProperties["color_code"])) {
				$isColorCode = true;
			}

			$rowStyleModify = array();
			$rowStyleModify = $rowStyle;

			$rowdata = array();
			if ($useSl > 0) {
				$rowdata[] = ++$serial;

				if ($isColorCode) {
					$rowStyleModify[] = ['fill' => ''];
				}
			}

			foreach ($tableProperties["query_field"] as $index => $fieldName) {

				if ($tableProperties["color_code"][$index] == 1) {
					$rowStyleModify[] = ['fill' => $row[$fieldName]];
					$rowdata[] = "";
				} else {
					if ($isColorCode) {
						$rowStyleModify[] = ['fill' => ''];
					}
					$rowdata[] = getValueFormat(remove_html_tag($row[$fieldName]), $tableProperties["precision"][$index], $reportType);
				}


				if ($tableProperties["total"][$index] == 1) {
					if (array_key_exists($index, $columnTotalList)) {
						$columnTotalList[$index] += $row[$fieldName];
					} else {
						$columnTotalList[$index] = $row[$fieldName];
					}
				} else {
					$columnTotalList[$index] = "";
				}
			}

			$writer->writeSheetRow($sheetName, $rowdata, $rowStyleModify);
		} else if ($reportType == 'csv') {
			$rowdata = array();
			if ($useSl > 0) {
				$rowdata[] = ++$serial;
			}

			foreach ($tableProperties["query_field"] as $index => $fieldName) {
				$rowdata[] = getValueFormat($row[$fieldName], $tableProperties["precision"][$index], $reportType);

				if ($tableProperties["total"][$index] == 1) {
					if (array_key_exists($index, $columnTotalList)) {
						$columnTotalList[$index] += $row[$fieldName];
					} else {
						$columnTotalList[$index] = $row[$fieldName];
					}
				} else {
					$columnTotalList[$index] = "";
				}
			}
			$writer->addRow($rowdata);
		}
	}
	//Data list end

	if ($reportType == 'print' || $reportType == 'pdf') {

		if (in_array(1, $tableProperties["total"])) {
			echo '<tr>';

			if ($useSl > 0) {
				echo '<td></td>';
			}

			foreach ($columnTotalList as $index => $totalValue) {
				echo '<td style="width:' . $tableProperties["width_print_pdf"][$index] . '; text-align:' . $tableProperties["align"][$index] . ';">' . getValueFormat($totalValue, $tableProperties["precision"][$index], $reportType) . '</td>';
			}
			echo '</tr>';
		}

		echo'</tbody></table>';

			if($tableProperties["footer_signatory"] == 1){
				echo	'<div class="row margin_top">
						<div class="col-md-12 col-lg-12">
							<div class="footer_Padding">
						
								<div class="col-md-6 col-lg-6">
									<div class="footer_section">
										<p> '.$TEXT["Nom et signature du gestionnaire"].' </p>
									</div>
								</div>	
								<div class="col-md-6 col-lg-6">
									<div class="footer_section text-right">
										<p> '.$TEXT["Nom et signature du responsable du site de PEC"].' </p>
									</div>
								</div> 
							</div>
						</div>
					</div>';
				
				}


		echo '	</div>
				</div>   
				</div>  
			 </div>
		 </body></html>';	
		 
	} else if ($reportType == 'excel') {

		if (in_array(1, $tableProperties["total"])) {
			$rowTotalStyle = array('font-style' => 'bold', 'border' => 'left,right,top,bottom', 'border-style' => 'thin');
			$rowdata = array();

			if ($useSl > 0) {
				$rowdata[] = "";
			}

			foreach ($columnTotalList as $index => $totalValue) {
				$rowdata[] = getValueFormat($totalValue, $tableProperties["precision"][$index], $reportType);
			}
			$writer->writeSheetRow($sheetName, $rowdata, $rowTotalStyle);
		}

		/* Report header merge */
		$end_col = count($tableProperties["query_field"]) - 1; //column count - 1
		if ($useSl > 0) {
			$end_col++;
		}

		foreach ($reportHeaderList as $start_row => $val) {
			$writer->markMergedCell($sheetName, $start_row, $start_col = 0, $end_row = $start_row, $end_col);
			// $writer->markMergedCell($sheetName, $start_row=0, $start_col=0, $end_row=0, $end_col=12);
			// $writer->markMergedCell($sheetName, $start_row=1, $start_col=0, $end_row=1, $end_col=12);
		}



///////////for logo left and right header 29/03/2023
		if($tableProperties["header_logo"] == 1){
			$writer->addImage($sheetName,realpath('./images/logo.png'),'logo.png', 1, [
				'startColNum' => 0,
				'endColNum' => 1,
				'startRowNum' => 0,
				'endRowNum' => 3,
			]);
			// $columnTotalCount = count($columnTotalList);
			$columnTotalCount = count($tableProperties["query_field"]);
	
			$writer->addImage($sheetName,realpath('./images/benin_logo.png'),'benin_logo.png', 2, [
				'startColNum' => $columnTotalCount,
				'endColNum' => ($columnTotalCount + 1),
				'startRowNum' => 0,
				'endRowNum' => 3,
			]);
		}
///////////for logo left and right header 29/03/2023



/////////////////for footer signator//////////////////////// 29/03/2023/////////////////
		if($tableProperties["footer_signatory"] == 1){
			// $writer->writeSheetRow($sheetName, [], []);/// for a blank row

			// $rowdata = array();
			// $rowdata[] = 'Nom et signature du gestionnaire';
			// // $rowdata[3] = 'Nom et signature du responsable du site de PEC';

			// $rowTypeOverwrite = array();
			$middleColIdx = (int)(count($tableProperties["table_header"])/2);
			// for($f=0; $f<count($tableProperties["table_header"]); $f++){
			// 	$rowTypeOverwrite[] = 'string';

			// 	if($f == $middleColIdx){
			// 		$rowdata[] = 'Nom et signature du responsable du site de PEC';
			// 	}
			// 	else{
			// 		$rowdata[] = '';
			// 	}

			// }
			// $writer->setSheetColumnTypes($sheetName,['string','string','string','string','string']);
			// $writer->setSheetColumnTypes($sheetName,$rowTypeOverwrite);

			// $rowTotalStyle = array('font-style' => 'normal', 'border' => 'left,right,top,bottom', 'border-style' => 'thin','height'=>'80','valign'=>'top');
			// $writer->writeSheetRow($sheetName, $rowdata, $rowTotalStyle);

			// echo 'Rubel:';
			$footerrowposition = 0;
			if (in_array(1, $tableProperties["total"])) {
				//when total available
				$footerrowposition = count($reportHeaderList) + ($tableHearC=1) + count($result)+ ($tableTotalC=1) + ($gaprowC=1) ;
			}else{
				//when total not available
				$footerrowposition = count($reportHeaderList) + ($tableHearC=1)+ count($result) + ($gaprowC=1) ;
			}


			// $rowTotalStyle = array('font-style' => 'normal', 'border' => 'left,right,top,bottom', 'border-style' => 'thin','height'=>'80','valign'=>'top','halign'=>'left');
			$rowTotalStyle = array('height'=>'80','valign'=>'top','halign'=>'left');
			$writer->writeCellextra($sheetName,$footerrowposition, 0, $TEXT["Nom et signature du gestionnaire"], $rowTotalStyle);

			$rowTotalStyle = array('height'=>'80','valign'=>'top','halign'=>'right');
			$writer->writeCellextra($sheetName,$footerrowposition, ($middleColIdx+1), $TEXT["Nom et signature du responsable du site de PEC"],$rowTotalStyle);

			$writer->markMergedCell($sheetName, $footerrowposition, $start_col = 0, $end_row = $footerrowposition, ($middleColIdx));
			$writer->markMergedCell($sheetName, $footerrowposition, $start_col = ($middleColIdx+1), $end_row = $footerrowposition, count($tableProperties["table_header"]));


			///////// $writer->writeCellextra($sheetName,75, 0, 'Rubel');
			///////// $writer->writeCellextra($sheetName,75, 5, 'Softworks');
		}



/////////////////for footer signator//////////////////////// 29/03/2023/////////////////



		$exportTime = date("Y_m_d_H_i_s", time());
		$exportFilePath = $reportSaveName .'_'.$exportTime. ".xlsx";
		$writer->writeToFile("media/$exportFilePath");
		header('Location:media/' . $exportFilePath); //File open location	
	
	} else if ($reportType == 'csv') {

		if (in_array(1, $tableProperties["total"])) {
			$rowdata = array();

			if ($useSl > 0) {
				$rowdata[] = "";
			}

			foreach ($columnTotalList as $index => $totalValue) {
				$rowdata[] = getValueFormat($totalValue, $tableProperties["precision"][$index], $reportType);
			}
			$writer->addRow($rowdata);
		}

		$writer->close();
		// header('Location:../media/' . $reportSaveName . ".csv"); //File open location
		
		$exportTime = date("Y_m_d_H_i_s", time());
		$exportFilePath = $reportSaveName .'_'.$exportTime. ".xlsx";
		$writer->writeToFile("media/$exportFilePath");
		header('Location:media/' . $exportFilePath); //File open location			
	}
	

function getValueFormat($value, $precision, $reportType) {
    $retVal = "";

    if ($precision === 'date') {
        if (validateDate($value, 'Y-m-d')) {
            $retVal = date('d-m-Y', strtotime($value));
        } else {
            $retVal = $value;
        }
    } else if ($precision === 'datetime') {
        if (validateDate($value, 'Y-m-d H:i:s')) {
            $retVal = date('d-m-Y', strtotime($value));
        } else {
            $retVal = $value;
        }
    } else if ($precision === 'string') {
        $retVal = $value;
    } else if (is_numeric($precision)) {
        // $retVal = getNumberFormat($value, $precision);
        $retVal = number_format($value, $precision);
        //when Excel then no need to COMA it is will auto format
        if ($reportType === 'excel') {
            $retVal = str_replace(",", "", $retVal);
        }
    } else {
        $retVal = $value;
    }

    return $retVal;
}

function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function remove_html_tag($text){
	$text = str_replace( '<', ' < ',$text );
	return trim(strip_tags($text));
}

?>