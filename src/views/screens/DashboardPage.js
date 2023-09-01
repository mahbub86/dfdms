// import React, { useState, useEffect,useContext } from "react";
// import swal from "sweetalert";
// import { useQuery } from "react-query";
// import * as api from "../../actions/api";
// // material components
// import "react-date-range/dist/styles.css"; // main css file
// import "react-date-range/dist/theme/default.css"; // theme css file
// import { makeStyles } from "@material-ui/core/styles";

// import {
//   Typography,
//   TextField,
//   Select,
//   FormControl,
//   Grid,
//   Card,
//   CardHeader,
//   CardContent,
//   MenuItem,
// } from "@material-ui/core";

// import ToggleButton from "@material-ui/lab/ToggleButton";
// import ToggleButtonGroup from "@material-ui/lab/ToggleButtonGroup";

// import Autocomplete from '@material-ui/lab/Autocomplete';

// import {
//   Link,
//   AddToHomeScreen,
//   Launch
//  } from "@material-ui/icons";

// import { ReactTabulator } from "react-tabulator";
// // core components
// import AfterLoginNavbar from "components/Navbars/AfterLoginNavbar.js";

// // Highcharts component
// import Highcharts from "highcharts/highstock";
// import exporting from "highcharts/modules/exporting.js";
// import HighchartsReact from "highcharts-react-official";

// import { useTranslation } from "react-i18next";
// import * as Service from "../../services/Service.js";
// import Constants from "services/Constants.js";

// import { UserContext } from "../../context/user-info-context";
// import { getDefaultMonthYear } from "../../services/Common";
// import {checkLogin, checkUserPermission} from "../../services/CheckUserAccess";

// const useStyles = makeStyles({
//   root: {
//     // minWidth: 275,
//     width: "20%",
//     margin: "0 1rem",
//   },
//   bullet: {
//     display: "inline-block",
//     margin: "0 2px",
//     transform: "scale(0.8)",
//   },
//   title: {
//     fontSize: 14,
//   },
//   pos: {
//     marginBottom: 12,
//   },
//   cardDiv: {
//     display: "flex",
//   },
//   fullWidth: {
//     width: "100%",
//   },

//   'tabulator-cell': {
//     padding: '1px'
// }


// });

// const DashboardPage = (props) => {

// const lan = localStorage.getItem("LangCode");
// const { t, i18n } = useTranslation();

//   //get DispensingLanguage
// const DispensingLanguage = JSON.parse(
//   localStorage.getItem("DispensingLanguage")
// );

// const menukey = "dashboard";
// const YearList = JSON.parse(localStorage.getItem("YearList"));
// const MonthList = JSON.parse(localStorage.getItem("MonthList"));

// const TLDsItemlist = JSON.parse(localStorage.getItem("TLDsItemlist"));
// const TLDZeroIndexItem = JSON.parse(localStorage.getItem("TLDZeroIndexItem"));

// const Facility_List = JSON.parse(localStorage.getItem("FacilityList"));

// let All_Facility_label = {id:"0", name: t(DispensingLanguage[lan][menukey]["All Facility"])};
// const FacilityList = [All_Facility_label].concat(Facility_List); 

// const MosTypelist = JSON.parse(localStorage.getItem("MosTypelist"));
// const bFacilitySelected = localStorage.getItem("bFacilitySelected");
// const FacilityId = localStorage.getItem("FacilityId");

//   exporting(Highcharts); 
//   const classes = useStyles();
//   const userCtx = useContext(UserContext);
//   // const lan = userCtx.userInfo.LangId; //"fr_FR";
  
//   // const lan = "fr_FR";
  
//   // const [pickerData, setPickerData] = useState([
//   //   {
//   //     startDate: subDays(new Date(), 29),
//   //     endDate: new Date(),
//   //     key: "selection",
//   //   },
//   // ]);

  
//   const [currYearId, setCurrYearId] = useState(getDefaultMonthYear().defaultYear);
//   const [currMonthId, setCurrMonthId] = useState(getDefaultMonthYear().defaultMonthId);
  
//   //const [currFacilityId, setCurrFacilityId] = useState(0);
//   const [currFacilityId, setCurrFacilityId] = useState(bFacilitySelected == 1? FacilityId: 0);

//   const [TLDUptakePatientsTrendData, setTLDUptakePatientsTrendData] = useState([]);
//   const [TLDTransitionPatientsTrendData, setTLDTransitionPatientsTrendData] =   useState([]);
//   const [ MMDAmongAdultPatientsTrendData, setMMDAmongAdultPatientsTrendData] = useState([]);
//   const [ MMDAmongAdultPatientsTrendLess15YearsData, setMMDAmongAdultPatientsTrendLess15YearsData] = useState([]);
//   const [ MMDCoveragePatientsTrendData, setMMDCoveragePatientsTrendData] = useState([]);

//   const [ columnsStockStatusTable, setColumnsStockStatusTable] = useState([]);
//   const [ stockStatusTableData, setStockStatusTableData] = useState([]);
  
//   const goToTLDUptake = () => {
//     window.open(
//       process.env.REACT_APP_BASE_NAME +`/tld-uptake`
//     );
//   }

//   const goToTLDTransitionTrend = () => {
//     window.open(
//       process.env.REACT_APP_BASE_NAME +`/tld-transition-trend`
//     );
//   }

//   const goToMMDAmoungAdults = () => {
//     window.open(
//       process.env.REACT_APP_BASE_NAME +`/mmd-among-adults`
//     );
//   }

//   const goToMMDAmoungPaediatric = () => {
//     window.open(
//       process.env.REACT_APP_BASE_NAME +`/mmd-among-paediatrics`
//     );
//   }

//   const goToMMDCoverageBySite = () => {
//     window.open(
//       process.env.REACT_APP_BASE_NAME +`/mmd-coverage-by-site`
//     );
//   }

//   const goToTLDStockStatusDetails = () => {
//     window.open(
//       process.env.REACT_APP_BASE_NAME +`/tld-stock-status`
//     );
//   }

//   const [gItemNo, setToggleButton] = React.useState(TLDZeroIndexItem);

//   const handleChangeToggle = (event, tmpToggleButtonValue) => {
//     if (tmpToggleButtonValue !== null) {
//       setToggleButton(tmpToggleButtonValue);
//     }
//   };

//   const handleYearChange = (event) => {
//     setCurrYearId(event.target.value);
//     // setLoading(true);
//   };

//   const handleMonthChange = (event) => {
//     setCurrMonthId(event.target.value);
//     // setLoading(true);
//   };

//   const handleFacilityChange = (event, newValue) => {
//     let rowId = '';
//     if(newValue == null){
//       rowId = '';
//     }else{
//       rowId = newValue.id;
//     }

//     setCurrFacilityId(rowId);
//  };

// //TLD Uptake Patients Trend
//   const getTLDUptakePatientsTrend = useQuery(
//     ["dashboardTLDUptakePatientsTrend"],
//     () => api.getTLDUptakePatientsTrend(currYearId, currMonthId, currFacilityId),
//     {
//       onSuccess: (data) => {
//         // console.log('getTLDUptakePatientsTrend Data: ', data);
//         setTLDUptakePatientsTrendData({
//           chart: {
//             type: "spline",
//           },
//           title: { 
//             //text: t(DispensingLanguage[lan][menukey]["TLD Uptake"]) + " - " + data.duration,
//             text: (DispensingLanguage?t(DispensingLanguage[lan][menukey]["TLD Uptake"]):"") + " - " + (data?data.duration:""),
//             style: {
//               fontSize: '16px'
//             }
//           },
//           yAxis: {
//             title: {
//               text: "",
//             },
//           },
//           xAxis: {
//             //categories: data.category
//             categories: data?data.category:[],
//           },
//           credits: {
//             enabled: false,
//           },
//           series: [
//             {
//               name: "TLD",
//               //data: data.seriesdata,
//               data: data?data.seriesdata:[],
//               color: "#002f6c",
//             },
//           ],
//         });

//       },
//       refetchOnWindowFocus: false,
//       refetchOnmount: false,
//       refetchOnReconnect: false,
//       retry: false,
//       staleTime: 0,//1000 * 60 * 60 * 24,
//     }
//   );


// //TLD Transition Patients Trend
//   const getTLDTransitionPatientsTrend = useQuery(
//     ["dashboardTLDTransitionPatientsTrend"],
//     () => api.getTLDTransitionPatientsTrend(currYearId, currMonthId, currFacilityId),
//     {
//       onSuccess: (data) => {
//         // console.log('getTLDTransitionPatientsTrend Data: ', data);
//         setTLDTransitionPatientsTrendData({
//           chart: {
//             type: "spline",
//           },
//           title: { 
//             //text: t(DispensingLanguage[lan][menukey]["TLD Transition Trend"]) + " - " + data.duration,
//             text: (DispensingLanguage?t(DispensingLanguage[lan][menukey]["TLD Transition Trend"]):"") + " - " + (data?data.duration:""),
//             style: {
//               fontSize: '16px'
//             }
//           },
//           yAxis: {
//             title: {
//               text: "",
//             },
//           },
//           xAxis: {
//             //categories: data.category
//             categories: data?data.category:[],
//           },
//           tooltip: {
//             shared: true
//           },
//           credits: {
//             enabled: false,
//           },
//           //series: data.seriesdata
//           series: data?data.seriesdata:[]
//         });

//       },
//       refetchOnWindowFocus: false,
//       refetchOnmount: false,
//       refetchOnReconnect: false,
//       retry: false,
//       staleTime: 0,//1000 * 60 * 60 * 24,
//     }
//   );


// // MMD Among Adults
// const getMMDAmongAdultPatientsTrend = useQuery(
//   ["dashboardMMDAmongAdultPatientsTrend"],
//   () => api.getMMDAmongAdultPatientsTrend(currYearId, currMonthId, currFacilityId),
//   {
//     onSuccess: (data) => {
//       // console.log('getMMDAmongAdultPatientsTrend Data: ', data);
//       setMMDAmongAdultPatientsTrendData({
//         title: {
//           //text: t(DispensingLanguage[lan][menukey]["MMD Among Adults"]) + " - " + data.duration,
//           text: (DispensingLanguage?t(DispensingLanguage[lan][menukey]["MMD Among Adults"]):"") + " - " + (data?data.duration:""),
//           style: {
//             fontSize: '16px'
//           }
//         },
//         xAxis: {
//           //categories: data.category
//           categories: data?data.category:[],
//         },
//         /* yAxis: {
//           title: {
//             text: ""
//           }
//         }, */

//         yAxis: [
//           {
//             // Primary yAxis
//             labels: {
//               style: {
//                 color: Highcharts.getOptions().colors[1],
//               },
//             },
//             title: {
//               text: t(
//                 DispensingLanguage[lan][menukey]["MMD Status"]
//               ),
//               style: {
//                 color: Highcharts.getOptions().colors[1],
//               },
//             },
//           },
//           {
//             // Secondary yAxis
//             min: 0,
//             max: 100,
//             title: {
//               text: t(
//                 DispensingLanguage[lan][menukey]["% MMD"]
//               ),
//               style: {
//                 color: Highcharts.getOptions().colors[1],
//               },
//             },
//             labels: {
//               style: {
//                 color: Highcharts.getOptions().colors[1],
//               },
//             },
//             opposite: true,
//           },
//         ],
        
//         credits: {
//           enabled: false
//         }, 
//         tooltip: {
//           shared: true,
//         },
//         //series: data.seriesdata
//         series: data?data.seriesdata:[],
//       });

//     },
//       refetchOnWindowFocus: false,
//       refetchOnmount: false,
//       refetchOnReconnect: false,
//       retry: false,
//       staleTime: 0,//1000 * 60 * 60 * 24,
//   }
// );
 



// // MMD Among Paediatrics (Less than 15 years)
// const getMMDAmongPaediatricsPatientsTrendLess15Years = useQuery(
//   ["dashboardMMDAmongPaediatricsPatientsTrendLess15Years"],
//   () => api.getMMDAmongPaediatricsPatientsTrendLess15Years(currYearId, currMonthId, currFacilityId),
//   {
//     onSuccess: (data) => {
//       // console.log('getMMDAmongPaediatricsPatientsTrendLess15Years Data: ', data);
//       setMMDAmongAdultPatientsTrendLess15YearsData({
//         title: {
//          // text: t(DispensingLanguage[lan][menukey]["MMD Among Paediatric"]) + " - " + data.duration,
//          text: (DispensingLanguage?t(DispensingLanguage[lan][menukey]["MMD Among Paediatric"]):"") + " - " + (data?data.duration:""),
//           style: {
//             fontSize: '16px'
//           }
//         },
//         xAxis: {
//           //categories: data.category
//           categories: data?data.category:[],
//         },
//         /* yAxis: {
//           title: {
//             text: ""
//           }
//         }, */

//         yAxis: [
//           {
//             // Primary yAxis
//             labels: {
//               style: {
//                 color: Highcharts.getOptions().colors[1],
//               },
//             },
//             title: {
//               text: t(
//                 DispensingLanguage[lan][menukey]["MMD Status"]
//               ),
//               style: {
//                 color: Highcharts.getOptions().colors[1],
//               },
//             },
//           },
//           {
//             // Secondary yAxis
//             min: 0,
//             max: 100,
//             title: {
//               text: t(
//                 DispensingLanguage[lan][menukey]["% MMD"]
//               ),
//               style: {
//                 color: Highcharts.getOptions().colors[1],
//               },
//             },
//             labels: {
//               style: {
//                 color: Highcharts.getOptions().colors[1],
//               },
//             },
//             opposite: true,
//           },
//         ],
        
//         credits: {
//           enabled: false
//         }, 
//         tooltip: {
//           shared: true,
//         },
//         //series: data.seriesdata
//         series: data?data.seriesdata:[],
        
//       });

//     },
//       refetchOnWindowFocus: false,
//       refetchOnmount: false,
//       refetchOnReconnect: false,
//       retry: false,
//       staleTime: 0,//1000 * 60 * 60 * 24,
//   }
// );
 
 


// // MMD Coverage by site
// const getMMDCoveragePatientsTrend = useQuery(
//   ["dashboardMMDCoveragePatientsTrend"],
//   () => api.getMMDCoveragePatientsTrend(currYearId, currMonthId, currFacilityId),
//   {
//     onSuccess: (data) => {
//       // console.log('getMMDCoveragePatientsTrend Data: ', data);
//       setMMDCoveragePatientsTrendData({
//         chart: {
//           type: "column",
//         },
//         title: {
//          // text: "MMD Coverage by site in Aug 2021",
//           //text: t(DispensingLanguage[lan][menukey]["MMD Coverage by site"]) + " - " + data.duration,
//           text: (DispensingLanguage?t(DispensingLanguage[lan][menukey]["MMD Coverage by site"]):"") + " - " + (data?data.duration:""),
//           style: {
//             fontSize: '16px'
//           }
//         },
//         xAxis: {
//           //categories: data.category
//           categories: data?data.category:[],
//         },
//         yAxis: {
//           min: 0,
//           title: {
//             text: "",
//           },
//         },
//         tooltip: {
//           pointFormat:
//             '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
//           shared: true,
//         },
//         plotOptions: {
//           column: {
//             stacking: "percent",
//           },
//         },
//         credits: {
//           enabled: false,
//         },
//         //series: data.seriesdata
//         series: data?data.seriesdata:[],
//       });

//     },
//     refetchOnWindowFocus: false,
//     refetchOnmount: false,
//     refetchOnReconnect: false,
//     retry: false,
//     staleTime: 0,//1000 * 60 * 60 * 24,
//   }
// );



// // const columnsStockStatusTable = [
// //   {
// //     title: "SDP",
// //     // width: 85,
// //     field: "FacilityName",
// //     headerSort: false,
// //   },
// //   {
// //     title:"Feb 21", field:"Month1", width:150, formatter:function(cell, formatterParams){
// //       var value = cell.getValue();
// //       return "<div style='background:"+getStockStatusTableCellBackcolor(value)+"; color:white;  width:100%; height:100%; padding:3px'>" + value + "</div>";
  
// //   },hozAlign: "right",
// //   headerHozAlign: "right",
// //   headerSort: false,
// // },
// //   {
// //     title:"Mar 21", field:"Month2", width:150, formatter:function(cell, formatterParams){
// //       var value = cell.getValue();
// //       return "<div style='background:"+getStockStatusTableCellBackcolor(value)+"; color:white;  width:100%; height:100%; padding:3px'>" + value + "</div>";
  
// //   },hozAlign: "right",
// //   headerHozAlign: "right",
// //   headerSort: false,
// //   },
// //   {
// //     title:"Apr 21", field:"Month3", width:150, formatter:function(cell, formatterParams){
// //       var value = cell.getValue();
// //       return "<div style='background:"+getStockStatusTableCellBackcolor(value)+"; color:white;  width:100%; height:100%; padding:3px'>" + value + "</div>";
  
// //   },hozAlign: "right",
// //   headerHozAlign: "right",
// //   headerSort: false,
// //   },
// //   {
// //     title:"May 21", field:"Month4", width:150, formatter:function(cell, formatterParams){
// //       var value = cell.getValue();
// //       return "<div style='background:"+getStockStatusTableCellBackcolor(value)+"; color:white; width:100%; height:100%; padding:3px'>" + value + "</div>";
  
// //   },hozAlign: "right",
// //   headerHozAlign: "right",
// //   headerSort: false,
// //   },
// //   {
// //     title:"Jun 21", field:"Month5", width:150, formatter:function(cell, formatterParams){
// //       var value = cell.getValue();
// //       return "<div style='background:"+getStockStatusTableCellBackcolor(value)+"; color:white; width:100%; height:100%; padding:3px'>" + value + "</div>";
  
// //   },hozAlign: "right",
// //   headerHozAlign: "right",
// //   headerSort: false,
// //   },
// //   {
// //     title:"Jul 21", field:"Month6", width:150, formatter:function(cell, formatterParams){
// //       var value = cell.getValue();
// //       return "<div style='background:"+getStockStatusTableCellBackcolor(value)+"; color:white;  width:100%; height:100%; padding:3px'>" + value + "</div>";
// //   },hozAlign: "right",
// //   headerHozAlign: "right",
// //   headerSort: false,
// //   }
// // ];


// function getStockStatusTableCellBackcolor(value){
//   let bColor="";

//     MosTypelist.forEach(row => {
//       if(value>row.MinMos && value<=row.MaxMos){
//         bColor = row.ColorCode;
//       }
//       // console.log('row: ', row);
//     });

//     // console.log('bColor: ', bColor);
//     // console.log('value: ', value);

//   return bColor;
// }

// const { refetch: fetchDashboardStockStatusTableData} = useQuery(
//   ["dashboardStockStatusTableDataList"],
//   () => api.getDashboardStockStatusTableData(currYearId, currMonthId, currFacilityId, gItemNo),
//   {
//     onSuccess: (data) => {

// setColumnsStockStatusTable([
//   {
//     title: t(DispensingLanguage[lan][menukey]["Facility"]),
//     // width: 85,
//     field: "FacilityName",
//     headerSort: false,
//   },
//   {
//     //title:data.category['Month1'], field:"Month1", width:150, formatter:function(cell, formatterParams){
//     title:data?data.category['Month1']:[], field:"Month1", width:150, formatter:function(cell, formatterParams){
//       var value = cell.getValue();
//       if (value || (value == 0)) {
//           return "<div style='background:"+getStockStatusTableCellBackcolor(value)+"; color:white;  width:100%; height:100%; padding:3px'>" + value.toFixed(1) + "</div>";
//       }else{
//         return "";
//       }
    
//   },hozAlign: "right",
//   headerHozAlign: "right",
//   headerSort: false,
// },
//   {
//     title:data?data.category['Month2']:[], field:"Month2", width:150, formatter:function(cell, formatterParams){
//       var value = cell.getValue();
//       if (value || (value == 0)) {
//           return "<div style='background:"+getStockStatusTableCellBackcolor(value)+"; color:white;  width:100%; height:100%; padding:3px'>" + value.toFixed(1) + "</div>";
//       }else{
//         return "";
//       }
//   },hozAlign: "right",
//   headerHozAlign: "right",
//   headerSort: false,
//   },
//   {
//     title:data?data.category['Month3']:[], field:"Month3", width:150, formatter:function(cell, formatterParams){
//       var value = cell.getValue();
//       if (value || (value == 0)) {
//           return "<div style='background:"+getStockStatusTableCellBackcolor(value)+"; color:white;  width:100%; height:100%; padding:3px'>" + value.toFixed(1) + "</div>";
//       }else{
//         return "";
//       }
//   },hozAlign: "right",
//   headerHozAlign: "right",
//   headerSort: false,
//   },
//   {
//     title:data?data.category['Month4']:[], field:"Month4", width:150, formatter:function(cell, formatterParams){
//       var value = cell.getValue();
//       if (value || (value == 0)) {
//           return "<div style='background:"+getStockStatusTableCellBackcolor(value)+"; color:white;  width:100%; height:100%; padding:3px'>" + value.toFixed(1) + "</div>";
//       }else{
//         return "";
//       }
//   },hozAlign: "right",
//   headerHozAlign: "right",
//   headerSort: false,
//   },
//   {
//     title:data?data.category['Month5']:[], field:"Month5", width:150, formatter:function(cell, formatterParams){
//       var value = cell.getValue();
//       if (value || (value == 0)) {
//           return "<div style='background:"+getStockStatusTableCellBackcolor(value)+"; color:white;  width:100%; height:100%; padding:3px'>" + value.toFixed(1) + "</div>";
//       }else{
//         return "";
//       }
//   },hozAlign: "right",
//   headerHozAlign: "right",
//   headerSort: false,
//   },
//   {
//     title:data?data.category['Month6']:[], field:"Month6", width:150, formatter:function(cell, formatterParams){
//       var value = cell.getValue();
//       if (value || (value == 0)) {
//           return "<div style='background:"+getStockStatusTableCellBackcolor(value)+"; color:white;  width:100%; height:100%; padding:3px'>" + value.toFixed(1) + "</div>";
//       }else{
//         return "";
//       }
//     },hozAlign: "right",
//   headerHozAlign: "right",
//   headerSort: false,
//   }
// ]);

//   //setStockStatusTableData(data.data);
//   setStockStatusTableData(data?data.data:[]);

//     },
//     refetchOnWindowFocus: false,
//     refetchOnmount: false,
//     refetchOnReconnect: false,
//     retry: false,
//     staleTime: 0,//1000 * 60 * 60 * 24,
//   }
// );


//   useEffect(() => {

//     if (currYearId > 0 && currMonthId > 0) {
//       getTLDUptakePatientsTrend.refetch();
//       getTLDTransitionPatientsTrend.refetch();
//       getMMDCoveragePatientsTrend.refetch();
//       getMMDAmongPaediatricsPatientsTrendLess15Years.refetch();
//       getMMDAmongAdultPatientsTrend.refetch();
//       fetchDashboardStockStatusTableData();
//     }
//   }, [currYearId, currMonthId, currFacilityId, gItemNo]);
  
//   const [RedirectLogin, setRedirectLogin] = React.useState(true);
//   const [hasUserPermission, setHasUserPermission] = React.useState(false);

//   /* const checkLogin = () => {  
//     let token = sessionStorage.getItem("token");
//     if (!token) {
//       swal({
//         title: "Oops!",
//         text: 'token expired. Please login again',
//         icon: "warning",
//         buttons: ["No", "Yes"],
//         dangerMode: true,
//       }).then((willDelete) => {
//         if (willDelete) { 
//           window.location.href = process.env.REACT_APP_BASE_NAME+`/login`;
//           sessionStorage.clear();
//         }
//       });
//     }
//   }; */

//   if(RedirectLogin){
//     setHasUserPermission(checkUserPermission(menukey));// To check user has permission in this page
//     checkLogin();
//     setRedirectLogin(false);
//   }
  
//   React.useEffect(() => {
//     // checkLogin();
//     // checkAccess();
//   }, []);

//   return (
//     hasUserPermission && (
//         <>
//           <AfterLoginNavbar {...props} />

//           <div
//             className="section signup-top-padding"
//             style={{
//               backgroundImage: "url(" + require("assets/img/bg8.jpg") + ")",
//               backgroundSize: "cover",
//               backgroundPosition: "top center",
//               minHeight: "753px",
//             }}
//           >
//             <div className="dashboard-pannel">
//               <div className="d-flex justify-product mb-1">
//                 <div className="sw_page_heading">
//                   <div className="sw_heading_title">{t(DispensingLanguage[lan][menukey]["Dashboard"])}</div>
//                 </div>
//               </div>

              
//               {/* start of filter */}
//               <Card className="sw_card sw_filter_card">
//                 <CardContent className="sw_filterCardContent">
//                   <Grid container spacing={1}>

//                     <Grid item xs={1} sm={1}>
//                       <FormControl className={classes.fullWidth}>
//                         <Select
//                           labelId="demo-simple-select-helper-label"
//                           id="YearList"
//                           name="YearList"
//                           value={currYearId}
//                           onChange={handleYearChange}
//                           fullWidth
//                         >
//                           {YearList.map((item, index) => {
//                             return <MenuItem value={item.id}>{item.name}</MenuItem>;
//                           })}
//                         </Select>
//                       </FormControl>
//                     </Grid>
//                     <Grid item xs={2} sm={2}>
//                       <FormControl className={classes.fullWidth}>
//                         <Select
//                           labelId="demo-simple-select-helper-label"
//                           id="MonthList"
//                           name="MonthList"
//                           value={currMonthId}
//                           onChange={handleMonthChange}
//                           fullWidth
//                         >
//                           {MonthList.map((item, index) => {
//                             return <MenuItem value={item.id}>{item.name}</MenuItem>;
//                           })}
//                         </Select>
//                       </FormControl>
//                     </Grid>
//                     <Grid item xs={3} sm={3}>
//                       <FormControl className={classes.fullWidth}>
//                         <Autocomplete
//                           autoHighlight
//                           className="sw_chosen_filter"
//                           id="FacilityList"
//                           disableClearable
//                           options={FacilityList}
//                           onChange={(event, newValue) => handleFacilityChange(event, newValue)}
//                           getOptionLabel={(option) => option.name}
//                           defaultValue={FacilityList[FacilityList.findIndex(facilitylist => facilitylist.id == currFacilityId)]}
//                           renderOption={(option) => (
//                             <Typography className="sw_fontSize">{option.name}</Typography>
//                           )}
                          
//                           renderInput={(params) => (
//                           <TextField
//                             {...params}
//                             // label={DispensingLanguage[lan][menukey]["All Facility"]}
//                             variant="standard"
//                             hiddenLabel
//                           />
//                           )}
//                         />
//                       </FormControl>
//                     </Grid>
//                     <Grid item xs={6} sm={6}></Grid>
//                   </Grid>
//                 </CardContent>
//               </Card>
//               {/* end of filter */}

//               {/* new row */}
//               <div className="row">
//                 <div className="col-md-6 mb-4">

//                 <Card className="sw_card">
                    
//                       <CardHeader
//                         title={t(
//                           DispensingLanguage[lan][menukey]["TLD Uptake"]
//                         )}
//                         action={
//                           <a href="javascript:void(0);" className="HyColor float-right" onClick={goToTLDUptake}><Launch/></a>
//                         }
//                       />

//                     <CardContent>
//                       <div className="row">
//                         <div className="col-md-12">
                      
//                           <HighchartsReact
//                             highcharts={Highcharts}
//                             options={TLDUptakePatientsTrendData}
//                           />

//                         </div>
//                       </div>
//                     </CardContent>


//                   </Card>
//                 </div>






//                 <div className="col-md-6 mb-4">

//                 <Card className="sw_card">
                                
      
//                       <CardHeader
//                         title={t(
//                           DispensingLanguage[lan][menukey]["TLD Transition Trend"]
//                         )}
//                         action={
//                           <a href="javascript:void(0);" className="HyColor float-right" onClick={goToTLDTransitionTrend}><Launch/></a>
//                         }
//                       />
      
                    

//                     <CardContent>
//                       <div className="row">
//                         <div className="col-md-12">
                          


                
                    
//                   <HighchartsReact
//                     highcharts={Highcharts}
//                     options={TLDTransitionPatientsTrendData}
//                   />
//                         </div>
//                       </div>

//                       </CardContent>
//                   </Card>

//                 </div>
//               </div>

//               {/* new row */}
//               <div className="row">
//                 <div className="col-md-6 mb-4">
//                 <Card className="sw_card">
                    
      
//                     <CardHeader
//                       title={t(
//                         DispensingLanguage[lan][menukey]["MMD Among Paediatric"]
//                       )}
//                       action={
//                         <a href="javascript:void(0);" className="HyColor float-right" onClick={goToMMDAmoungPaediatric}><Launch/></a>
//                       }
//                     />


//                     <CardContent>
//                       <div className="row">
//                         <div className="col-md-12">

                    
//                 <HighchartsReact
//                   highcharts={Highcharts}
//                   options={MMDAmongAdultPatientsTrendLess15YearsData}
//                 />
//                 </div>
//                     </div>
//                     </CardContent>
//                 </Card>

//                 </div>

//                 <div className="col-md-6 mb-4">

//                 <Card className="sw_card">
                    

//                       <CardHeader
//                         title={t(
//                           DispensingLanguage[lan][menukey]["MMD Among Adults"]
//                         )}
//                         action={
//                           <a href="javascript:void(0);" className="HyColor float-right" onClick={goToMMDAmoungAdults}><Launch/></a>
//                         }
//                       />


//                       <CardContent>
//                         <div className="row">
//                           <div className="col-md-12">

                      
//                   <HighchartsReact
//                     highcharts={Highcharts}
//                     options={MMDAmongAdultPatientsTrendData}
//                   />
//                   </div>
//                       </div>
//                       </CardContent>
//                   </Card>
//                 </div>

//               </div>


//               {/* new row */}
//               <div className="row">
                

//                 <div className="col-md-12 mb-4">
//                 <Card className="sw_card">
//                       <CardHeader
//                         title={t(
//                           DispensingLanguage[lan][menukey]["MMD Coverage by site"]
//                         )}
//                         action={
//                           <a href="javascript:void(0);" className="HyColor float-right" onClick={goToMMDCoverageBySite}><Launch/></a>
//                         }
//                       />
      
      
//                       <CardContent>
//                         <div className="row">
//                           <div className="col-md-12">           
                
//                           <HighchartsReact
//                             highcharts={Highcharts}
//                             options={MMDCoveragePatientsTrendData}
//                           />
//                           </div>
//                         </div>
//                       </CardContent>

//                 </Card>

//                 </div>
//               </div>


//               <div className="row">
//                 <div className="col-md-12">
//                   <Card className="sw_card">

//                     {/* <CardHeader title={"TLD" + " " + t(DispensingLanguage[lan][menukey]["Stock status"])} 
//                     action={

//                       <a href="javascript:void(0);" className="HyColor float-right" onClick={goToTLDStockStatusDetails}><Launch/></a>
//                     }/> */}

//                     <CardHeader 
//                     title={t(DispensingLanguage[lan][menukey]["Stock status"])}
//                     // title={"TLD" + " " + t(DispensingLanguage[lan][menukey]["Stock status"])}
//                     action={
//                       <a href="javascript:void(0);" className="HyColor float-right" onClick={goToTLDStockStatusDetails}><Launch/></a>
//                     }/>

//                     <CardContent>
//                     <div className="row marginBottom10">
//                       <div className="col-md-12">
//                           <ToggleButtonGroup
//                             className="sw_ToggleButtonGroup sw_tld"
//                             color="primary"
//                             value={gItemNo}
//                             exclusive
//                             onChange={handleChangeToggle}
//                           >
//                             {TLDsItemlist.map((item, index) => {
//                               return <ToggleButton value={item.ItemNo}>{item.ItemName}</ToggleButton>;
//                             })}
//                           </ToggleButtonGroup>
//                       </div>
//                     </div>

//                     <div className="row">
//                         <div className="col-md-12">
//                           <div className="mylegend_area">
//                             {MosTypelist.map((item, index) => {
//                               return (
//                                 <div className="my_legend">
//                                   <div
//                                     className="mylegend_color"
//                                     style={{ background: item.ColorCode }}
//                                   ></div>
//                                   <div className="mylegend_label">{item.name}</div>
//                                   <div className="mylegend_val">
//                                     {item.MosLabel}
//                                   </div>
//                                 </div>
//                               );
//                             })}
//                           </div>
//                         </div>
//                       </div>
                      
//                     <div className="sw_relative">
//                             {/* {isLoadingPatient && <LoadingSpinnerOpaque />} */}

//                             <div className="uniqueName">
//                               <ReactTabulator
//                                 height="400px"
//                                 layout={"fitColumns"}
//                                 columns={columnsStockStatusTable}
//                                 data={stockStatusTableData?stockStatusTableData:[]}
//                               /> 

//                             </div> 
//                           </div>





//     {/* 

//                       <Table className={classes.table} aria-label="simple table">
//                         <TableHead>
//                           <TableRow>
//                             <TableCell>SDP</TableCell>
//                             <TableCell align="right">Feb 21</TableCell>
//                             <TableCell align="right">Mar 21</TableCell>
//                             <TableCell align="right">Apr 21</TableCell>
//                             <TableCell align="right">May 21</TableCell>
//                             <TableCell align="right">Jun 21</TableCell>
//                             <TableCell align="right">Jul 21</TableCell>
//                             <TableCell align="right">Aug 21</TableCell>
//                           </TableRow>
//                         </TableHead>
//                         <TableBody>
//                           <TableRow>
//                             <TableCell component="th" scope="row">
//                               Abbraccio
//                             </TableCell>
//                             <TableCell className="understocked" align="right">
//                               0.81
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               3.86
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               4.0
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               4.2
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               2.0
//                             </TableCell>
//                             <TableCell className="understocked" align="right">
//                               0.9
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               2.52
//                             </TableCell>
//                           </TableRow>

//                           <TableRow>
//                             <TableCell component="th" scope="row">
//                               BEKAKOUA
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               3.63
//                             </TableCell>
//                             <TableCell className="understocked" align="right">
//                               0.96
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               4.2
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               3.7
//                             </TableCell>
//                             <TableCell className="understocked" align="right">
//                               0.4
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               3.5
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               4.2
//                             </TableCell>
//                           </TableRow>

//                           <TableRow>
//                             <TableCell component="th" scope="row">
//                               Bouyanyindi
//                             </TableCell>
//                             <TableCell className="understocked" align="right">
//                               0.81
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               2.29
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               1.6
//                             </TableCell>
//                             <TableCell className="understocked" align="right">
//                               0.7
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               1.6
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               1.0
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               2.2
//                             </TableCell>
//                           </TableRow>

//                           <TableRow>
//                             <TableCell component="th" scope="row">
//                               Cab Soins Bon secours
//                             </TableCell>
//                             <TableCell className="understocked" align="right">
//                               0.17
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               2.29
//                             </TableCell>
//                             <TableCell className="understocked" align="right">
//                               0.5
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               1.3
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               2.6
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               3.1
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               3.4
//                             </TableCell>
//                           </TableRow>

//                           <TableRow>
//                             <TableCell component="th" scope="row">
//                               CS Adja Ouere
//                             </TableCell>
//                             <TableCell className="overstocked" align="right">
//                               6.3
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               3.6
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               3.6
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               1.3
//                             </TableCell>
//                             <TableCell className="understocked" align="right">
//                               0.6
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               1.5
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               2.6
//                             </TableCell>
//                           </TableRow>

//                           <TableRow>
//                             <TableCell component="th" scope="row">
//                               Cab Soins St Gaèl
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               1.5
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               3.1
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               3.6
//                             </TableCell>
//                             <TableCell className="overstocked" align="right">
//                               6.2
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               1.3
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               2.5
//                             </TableCell>
//                             <TableCell className="understocked" align="right">
//                               0.5
//                             </TableCell>
//                           </TableRow>

//                           <TableRow>
//                             <TableCell component="th" scope="row">
//                               Cab. Méd. Salam
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               2.5
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               1.1
//                             </TableCell>
//                             <TableCell className="overstocked" align="right">
//                               6.6
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               1.5
//                             </TableCell>
//                             <TableCell className="understocked" align="right">
//                               0.2
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               2.5
//                             </TableCell>
//                             <TableCell className="stock" align="right">
//                               1.5
//                             </TableCell>
//                           </TableRow>
//                         </TableBody>
//                       </Table>
//     */}





//                     </CardContent>
//                   </Card>
//                 </div>
//               </div>
//             </div>
//           </div>
//         </>)
//   );
// };

// export default DashboardPage;
