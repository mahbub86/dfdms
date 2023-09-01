import React, { forwardRef, useRef } from "react";
import { Button } from "../../../components/CustomControl/Button";

import CustomTable from "components/CustomTable/CustomTable";
import {
  apiCall,
  apiOption,
  LoginUserInfo,
  language,
} from "../../../actions/api";
import ExecuteQueryHook from "../../../components/hooks/ExecuteQueryHook";

import { Typography, TextField } from "@material-ui/core";
import Autocomplete from "@material-ui/lab/Autocomplete";

const StockStatus = (props) => {
  const serverpage = "stockstatus"; // this is .php server page

  const { useState } = React;
  const [bFirst, setBFirst] = useState(true);
  const [productGroupList, setProductGroupList] = useState(null);
  const [selectedProductGroupId, setSelectedProductGroupId] = useState(0); //for export

  const { isLoading, data: dataList, error, ExecuteQuery } = ExecuteQueryHook(); //Fetch data
  const UserInfo = LoginUserInfo();

  /* =====Start of Excel Export Code==== */
  // const EXCEL_EXPORT_URL = process.env.REACT_APP_API_URL;

  // const PrintPDFExcelExportFunction = (reportType) => {
  //   let finalUrl = EXCEL_EXPORT_URL + "report/print_pdf_excel_server.php";

  //   window.open(
  //     finalUrl +
  //       "?action=StrengthExport" +
  //       "&reportType=" +
  //       reportType +
  //       "&TimeStamp=" +
  //       Date.now()
  //   );
  // };
  /* =====End of Excel Export Code==== */

  function getProductGroup() {
    let params = {
      action: "ProductGroupList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
    };

    apiCall.post("combo_generic", { params }, apiOption()).then((res) => {
      setProductGroupList([{ id: 0, name: "All" }].concat(res.data.datalist));
      getDataList(0);
    });
  }

  const handleChangeChoosenMany = (name, value) => {
    setSelectedProductGroupId(value);
    getDataList(value);
  };

  const columnList = [
    { field: "rownumber", label: "SL", align: "center", width: "4%" },
    // { field: 'SL', label: 'SL',width:'10%',align:'center',visible:true,sort:false,filter:false },
    {
      field: "GroupName",
      label: "Product Group",
      width: "8%",
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    // {
    //   field: "SystemBarcode",
    //   label: "System Barcode",
    //   // width: "10%",
    //   align: "left",
    //   visible: true,
    //   sort: true,
    //   filter: true,
    // },

    {
      field: "ProductName",
      label: "Product",
      // width: "10%",
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "CategoryName",
      label: "Category",
      width: "7%",
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "GenericName",
      label: "Generic",
      // width: "10%",
      align: "left",
      visible: true,
      sort: true,
      filter: true,
    },
    {
      field: "Quantity",
      label: "Quantity",
      width: "8%",
      align: "right",
      visible: true,
      sort: true,
      filter: true,
    },

    {
      field: "TradePrice",
      label: "Trade Price",
      width: "7%",
      align: "right",
      visible: true,
      sort: true,
      filter: true,
    },

    {
      field: "MRP",
      label: "MRP",
      width: "4%",
      align: "right",
      visible: true,
      sort: true,
      filter: true,
    },
    // {
    //   field: "custom",
    //   label: "Action",
    //   width: "7%",
    //   align: "center",
    //   visible: true,
    //   sort: false,
    //   filter: false,
    // },
  ];

  if (bFirst) {
    /**First time call for datalist */
    getProductGroup();
    setBFirst(false);
  }

  /**Get data for table list */
  function getDataList(currentProductGroupId) {
    // const [productGroupList, setProductGroupList] = useState(null);
    // const [currentProductGroupId, setCurrentProductGroupId] = useState("");

    let params = {
      action: "getDataList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
      ProductGroupId: currentProductGroupId,
    };
    // console.log('LoginUserInfo params: ', params);

    ExecuteQuery(serverpage, params);
  }

  return (
    <>
      <div class="bodyContainer">
        {/* <!-- ######-----TOP HEADER-----####### --> */}
        <div class="topHeader">
          <h4>
            <a href="#">Home</a> ❯ Reports ❯ Stock Status
          </h4>
        </div>

        {/* <!-- TABLE SEARCH AND GROUP ADD --> */}
        <div class="searchAdd">
          {/* <input type="text" placeholder="Search Product Group"/> */}
          {/* <button
            onClick={() => {
              addData();
            }}
            className="btnAdd"
          >
            ADD
          </button> */}

          <div class="header-item">
            <div>
              <label>Product Group</label>
            </div>
            {/* <div class="plusGroup"> */}
            <div class="">
              <Autocomplete
                autoHighlight
                // freeSolo
                disableClearable
                className="chosen_dropdown"
                id="ProductGroupId"
                name="ProductGroupId"
                autoComplete
                options={productGroupList ? productGroupList : []}
                getOptionLabel={(option) => option.name}
                defaultValue={{ id: 0, name: "All" }}
                // value={selectedSupplier}
                // value={
                //   productGroupList
                //     ? productGroupList[
                //       productGroupList.findIndex(
                //           (list) => list.id === selectedProductGroupId
                //         )
                //       ]
                //     : null
                // }
                onChange={(event, valueobj) =>
                  handleChangeChoosenMany(
                    "ProductGroupId",
                    valueobj ? valueobj.id : ""
                  )
                }
                renderOption={(option) => (
                  <Typography className="chosen_dropdown_font">
                    {option.name}
                  </Typography>
                )}
                renderInput={(params) => (
                  <TextField {...params} variant="standard" fullWidth />
                )}
              />
            </div>
          </div>

          {/* <Button label={"ADD"} class={"btnAdd"} onClick={addData} /> */}
        </div>

        {/* <!-- ####---THIS CLASS IS USE FOR TABLE GRID PRODUCT INFORMATION---####s --> */}
        <div class="subContainer">
          <div className="App">
            <CustomTable
              columns={columnList}
              rows={dataList ? dataList : {}}
              // actioncontrol={""}
            />
          </div>
        </div>
      </div>
      {/* <!-- BODY CONTAINER END --> */}
    </>
  );
};

export default StockStatus;
