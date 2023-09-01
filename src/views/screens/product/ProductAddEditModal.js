import React, { forwardRef, useRef, useEffect, useState } from "react";
import { Button } from "../../../components/CustomControl/Button";
import {
  apiCall,
  apiOption,
  LoginUserInfo,
  language,
} from "../../../actions/api";

const ProductAddEditModal = (props) => {
  const serverpage = "product"; // this is .php server page
  const [productGroupList, setProductGroupList] = useState(null);
  const [productCagegoryList, setProductCagegoryList] = useState(null);
  const [productGenericList, setProductGenericList] = useState(null);

  const [countryList, setCountryList] = useState(null);
  const [strengthList, setStrengthList] = useState(null);
  const [manufacturerList, setManufacturerList] = useState(null);

  const [currentRow, setCurrentRow] = useState(props.currentRow);
  const [errorObject, setErrorObject] = useState({});

  const [currProductGroupId, setCurrProductGroupId] = useState(null);
  const [currProductCategoryId, setCurrProductCategoryId] = useState(null);
  const [currProductGenericId, setCurrProductGenericId] = useState(null);
  // const [currManufacturerId, setCurrManufacturerId] = useState(null);
  // const [currStrengthId, setCurrStrengthId] = useState(null);
  // const [currCountryId, setCurrCountryId] = useState(null);
  const UserInfo = LoginUserInfo();
  // console.log('UserInfo: ', UserInfo);

  React.useEffect(() => {
    getProductGroup(
      props.currentRow.ProductGroupId,
      props.currentRow.ProductCategoryId,
      props.currentRow.ProductGenericId
    );

    getCountryList();
    getStrengthList();
    getManufacturerList();
  }, []);

  function getProductGroup(
    selectProductGroupId,
    SelectProductCategoryId,
    SelectProductGenericId
  ) {
    let params = {
      action: "ProductGroupList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
    };

    apiCall.post("combo_generic", { params }, apiOption()).then((res) => {
      setProductGroupList(
        [{ id: "", name: "Select product group" }].concat(res.data.datalist)
      );

      setCurrProductGroupId(selectProductGroupId);

      getProductCategory(
        selectProductGroupId,
        SelectProductCategoryId
      );

      getProductGeneric(
        selectProductGroupId,
        SelectProductGenericId
      );


    });
  }

  function getProductCategory(
    selectProductGroupId,
    SelectProductCategoryId
  ) {
    let params = {
      action: "ProductCategoryList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
      ProductGroupId: selectProductGroupId,
    };

    apiCall.post("combo_generic", { params }, apiOption()).then((res) => {
      setProductCagegoryList(
        [{ id: "", name: "Select product category" }].concat(res.data.datalist)
      );
      setErrorObject({ ...errorObject, ["ProductCategoryId"]: null });

      setCurrProductCategoryId(SelectProductCategoryId);
     
    });
  }

  // const [productGenericList, setProductGenericList] = useState(null);
  function getProductGeneric(
    selectProductGroupId,
    SelectProductGenericId
  ) {
    let params = {
      action: "ProductGenericList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
      ProductGroupId: selectProductGroupId,
      // ProductCategoryId: SelectProductCategoryId,
    };

    apiCall.post("combo_generic", { params }, apiOption()).then((res) => {
      setProductGenericList(
        [{ id: "", name: "Select product generic" }].concat(res.data.datalist)
      );
      setErrorObject({ ...errorObject, ["ProductGenericId"]: null });

      setCurrProductGenericId(SelectProductGenericId);
    });
  }

  function getStrengthList() {
    let params = {
      action: "StrengthList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
    };

    apiCall.post("combo_generic", { params }, apiOption()).then((res) => {
      setStrengthList(
        [{ id: "", name: "Select strength" }].concat(res.data.datalist)
      );

      // setCurrStrengthId(props.currentRow.StrengthId);
    });
  }

  function getManufacturerList() {
    let params = {
      action: "ManufacturerList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
    };

    apiCall.post("combo_generic", { params }, apiOption()).then((res) => {
      setManufacturerList(
        [{ id: "", name: "Select manufacturer" }].concat(res.data.datalist)
      );

      // setCurrManufacturerId(props.currentRow.ManufacturerId);
    });
  }

  function getCountryList() {
    let params = {
      action: "CountryList",
      lan: language(),
      UserId: UserInfo.UserId,
      ClientId: UserInfo.ClientId,
      BranchId: UserInfo.BranchId,
    };

    apiCall.post("combo_generic", { params }, apiOption()).then((res) => {
      setCountryList(
        [{ id: "", name: "Select origin" }].concat(res.data.datalist)
      );

      // setCurrCountryId(props.currentRow.CountryId);
    });
  }

  const handleChange = (e) => {
    const { name, value } = e.target;
    let data = { ...currentRow };
    data[name] = value;

    if (name === "ProductShortName") {
      let productName = generateProductName(value, data.StrengthId);
      data["ProductName"] = productName;
    }

    if (name === "StrengthId") {
      let productName = generateProductName(data.ProductShortName, value);
      data["ProductName"] = productName;
    }

    setCurrentRow(data);

    setErrorObject({ ...errorObject, [name]: null });

    //for dependancy
    if (name === "ProductGroupId") {
      setCurrProductGroupId(value);
      getProductCategory(value, "");
      getProductGeneric(value, "");

    } else if (name === "ProductCategoryId") {
      setCurrProductCategoryId(value);
      // getProductGeneric(currentRow.ProductGroupId, value, "");
    } else if (name === "ProductGenericId") {
      setCurrProductGenericId(value);
    }
  };

  function handleChangeCheck(e) {
    const { name, value } = e.target;

    let data = { ...currentRow };
    data[name] = e.target.checked;
    setCurrentRow(data);
  }

  function generateProductName(prodName, prodStrengthId) {
    // console.log("genericId: ", prodGenericId);
    // console.log("prodName: ", prodName);
    let productName = "";
    // let genericName = "NA";
    // console.log("productGenericList: ", productGenericList);

    var genObj = strengthList.filter((obj) => obj.id == prodStrengthId);
    // console.log("genObj: ", genObj);
    if (prodName && genObj.length > 0) {
      productName = prodName + " " + genObj[0].name;
    }
    // console.log("productName: ", productName);

    return productName;
  }

  const validateForm = () => {
    // let validateFields = ["GroupName", "DiscountAmount", "DiscountPercentage"]
    let validateFields = [
      "ProductGroupId",
      "ProductCategoryId",
      "ProductGenericId",
      "StrengthId",
      "ManufacturerId",
      "ProductShortName",
      "ProductName",
      "CountryId",
      "TradePrice",
      "MRP",
      "SystemBarcode",
    ];
    let errorData = {};
    let isValid = true;
    validateFields.map((field) => {
      if (!currentRow[field]) {
        errorData[field] = "validation-style";
        isValid = false;
      }
    });
    setErrorObject(errorData);
    // console.log('errorData validateForm: ', errorData);
    return isValid;
  };

  function addEditAPICall() {
    if (validateForm()) {
      let UserInfo = LoginUserInfo();
      let params = {
        action: "dataAddEdit",
        lan: language(),
        UserId: UserInfo.UserId,
        ClientId: UserInfo.ClientId,
        BranchId: UserInfo.BranchId,
        rowData: currentRow,
      };

      apiCall.post(serverpage, { params }, apiOption()).then((res) => {
        // console.log('res: ', res);

        props.masterProps.openNoticeModal({
          isOpen: true,
          msg: res.data.message,
          msgtype: res.data.success,
        });

        // console.log('props modal: ', props);
        if (res.data.success === 1) {
          props.modalCallback("addedit");
        }
      });
    }
  }

  function modalClose() {
    console.log("props modal: ", props);
    props.modalCallback("close");
  }

  return (
    <>
      {/* <!-- GROUP MODAL START --> */}
      <div id="productModal" class="modal">
        {/* <!-- Modal content --> */}
        <div class="product-content">
          <div class="modalHeader">
            <h4>Add/Edit Product</h4>
          </div>

          <div class="productmodalBody">
            {/* <!-- PRODUCT ENTRY PART --> */}
            <div class="productEntry">
              {/* <label>Group</label>
              <div>
                <select>
                  <option value="" disabled selected hidden>
                    Select Group
                  </option>
                  <option value="">Pharma</option>
                  <option value="">Non Pharma </option>
                </select>
                <button class="btnPlus">+</button>
              </div> */}

              <label>Group *</label>
              <div>
                <select
                  id="ProductGroupId"
                  name="ProductGroupId"
                  class={errorObject.ProductGroupId}
                  value={currProductGroupId}
                  onChange={(e) => handleChange(e)}
                >
                  {productGroupList &&
                    productGroupList.map((item, index) => {
                      return <option value={item.id}>{item.name}</option>;
                    })}
                </select>
                {/* <button class="btnPlus">+</button> */}
              </div>

              <label>Cetegory *</label>
              <div>
                <select
                  id="ProductCategoryId"
                  name="ProductCategoryId"
                  class={errorObject.ProductCategoryId}
                  value={currProductCategoryId}
                  onChange={(e) => handleChange(e)}
                >
                  {productCagegoryList &&
                    productCagegoryList.map((item, index) => {
                      return <option value={item.id}>{item.name}</option>;
                    })}
                </select>
              </div>

              <label>Generic *</label>
              <div>
                <select
                  id="ProductGenericId"
                  name="ProductGenericId"
                  class={errorObject.ProductGenericId}
                  value={currProductGenericId}
                  onChange={(e) => handleChange(e)}
                >
                  {productGenericList &&
                    productGenericList.map((item, index) => {
                      return <option value={item.id}>{item.name}</option>;
                    })}
                </select>
              </div>

              <label>Manufacturer *</label>
              <div>
                <select
                  id="ManufacturerId"
                  name="ManufacturerId"
                  class={errorObject.ManufacturerId}
                  value={currentRow.ManufacturerId}
                  onChange={(e) => handleChange(e)}
                >
                  {manufacturerList &&
                    manufacturerList.map((item, index) => {
                      return <option value={item.id}>{item.name}</option>;
                    })}
                </select>
              </div>

              <label>Product Name *</label>
              <input
                type="text"
                id="ProductShortName"
                name="ProductShortName"
                class={errorObject.ProductShortName}
                placeholder="Enter product short name"
                value={currentRow.ProductShortName}
                onChange={(e) => handleChange(e)}
              />

              {/* <label>Product Name *</label>
              <input
                  type="text"
                  id="ProductName"
                  name="ProductName"
                  // disabled
                  class={errorObject.ProductName}
                  // placeholder="Enter product name"
                  value={currentRow.ProductName}
                  onChange={(e) => handleChange(e)}
                /> */}

              <label>Strength/Size *</label>
              <div>
                <select
                  id="StrengthId"
                  name="StrengthId"
                  class={errorObject.StrengthId}
                  value={currentRow.StrengthId}
                  onChange={(e) => handleChange(e)}
                >
                  {strengthList &&
                    strengthList.map((item, index) => {
                      return <option value={item.id}>{item.name}</option>;
                    })}
                </select>
              </div>

              <label>Origin *</label>
              <div>
                <select
                  id="CountryId"
                  name="CountryId"
                  class={errorObject.CountryId}
                  value={currentRow.CountryId}
                  onChange={(e) => handleChange(e)}
                >
                  {countryList &&
                    countryList.map((item, index) => {
                      return <option value={item.id}>{item.name}</option>;
                    })}
                </select>
              </div>

              <label>Box Size</label>
              <input
                type="number"
                id="BoxSize"
                name="BoxSize"
                // class={errorObject.BoxSize}
                // placeholder="Enter value"
                value={currentRow.BoxSize}
                onChange={(e) => handleChange(e)}
              />

              <label>Trade Price *</label>
              <input
                type="number"
                id="TradePrice"
                name="TradePrice"
                class={errorObject.TradePrice}
                // placeholder="Enter value"
                value={currentRow.TradePrice}
                onChange={(e) => handleChange(e)}
              />

              <label>MRP *</label>
              <input
                type="number"
                id="MRP"
                name="MRP"
                class={errorObject.MRP}
                // placeholder="Enter value"
                value={currentRow.MRP}
                onChange={(e) => handleChange(e)}
              />

              <label>System Barcode *</label>
              <input
                type="text"
                id="SystemBarcode"
                name="SystemBarcode"
                disabled
                class={errorObject.SystemBarcode}
                // placeholder="Enter value"
                value={currentRow.SystemBarcode}
                onChange={(e) => handleChange(e)}
              />

              <label>Product Barcode</label>
              <input
                type="text"
                id="ProductBarcode"
                name="ProductBarcode"
                // class={errorObject.ProductBarcode}
                // placeholder="Enter value"
                value={currentRow.ProductBarcode}
                onChange={(e) => handleChange(e)}
              />
            </div>

            {/* <!-- PRODUCT SETTINGS PART --> */}
            <div class="productSettings">
              <h4>Settings</h4>

              <label>Vat on Sales (%)</label>
              <input
                type="number"
                id="VatonSales"
                name="VatonSales"
                // class={errorObject.VatonSales}
                // placeholder="Enter value"
                value={currentRow.VatonSales}
                onChange={(e) => handleChange(e)}
              />

              <label>Vat on Trade (%)</label>
              <input
                type="number"
                id="VatonTrade"
                name="VatonTrade"
                // class={errorObject.VatonTrade}
                // placeholder="Enter value"
                value={currentRow.VatonTrade}
                onChange={(e) => handleChange(e)}
              />

              <label>Sales Dis. (%)</label>
              <input
                type="number"
                id="SalesDiscountPercentage"
                name="SalesDiscountPercentage"
                // class={errorObject.SalesDiscountPercentage}
                // placeholder="Enter value"
                value={currentRow.SalesDiscountPercentage}
                onChange={(e) => handleChange(e)}
              />

              <label>Sales Dis. (Amt)</label>
              <input
                type="number"
                id="SalesDiscountAmount"
                name="SalesDiscountAmount"
                // class={errorObject.SalesDiscountAmount}
                // placeholder="Enter value"
                value={currentRow.SalesDiscountAmount}
                onChange={(e) => handleChange(e)}
              />

              <label>Order Lavel</label>
              <input
                type="number"
                id="OrderLevel"
                name="OrderLevel"
                // class={errorObject.OrderLevel}
                // placeholder="Enter value"
                value={currentRow.OrderLevel}
                onChange={(e) => handleChange(e)}
              />

              <label>Min. Oderd Qnty.</label>
              <input
                type="number"
                id="MinOderdQty"
                name="MinOderdQty"
                // class={errorObject.MinOderdQty}
                // placeholder="Enter value"
                value={currentRow.MinOderdQty}
                onChange={(e) => handleChange(e)}
              />

              <label>Max. Oderd Qnty.</label>
              <input
                type="number"
                id="MaxOderdQty"
                name="MaxOderdQty"
                // class={errorObject.MaxOderdQty}
                // placeholder="Enter value"
                value={currentRow.MaxOderdQty}
                onChange={(e) => handleChange(e)}
              />
            </div>
          </div>

          <div class="modalItem">
            <label> Is Active?</label>
            <input
              id="IsActive"
              name="IsActive"
              type="checkbox"
              checked={currentRow.IsActive}
              onChange={handleChangeCheck}
            />
          </div>

          <div class="modalItem">
            <Button label={"Close"} class={"btnClose"} onClick={modalClose} />
            {props.currentRow.id && (
              <Button
                label={"Update"}
                class={"btnUpdate"}
                onClick={addEditAPICall}
              />
            )}
            {!props.currentRow.id && (
              <Button
                label={"Save"}
                class={"btnSave"}
                onClick={addEditAPICall}
              />
            )}
          </div>
        </div>
      </div>
      {/* <!-- GROUP MODAL END --> */}
    </>
  );
};

export default ProductAddEditModal;
