import React, { Suspense } from "react";
import ReactDOM from "react-dom";
import { BrowserRouter, Route, Switch, Redirect } from "react-router-dom";


import "assets/css/main.css";
import "assets/css/modal.css";
import "assets/css/header.css";

import "assets/js/include.js";
import "assets/js/modal.js";


// pages for this kit
import Index from "views/Index.js";
import LoginPage from "views/screens/LoginPage.js";
// import SignUpPage from "views/screens/SignUp.js";
// import ResetPassword from "views/screens/ResetPasswordPage";
// import DashboardPage from "views/screens/DashboardPage";
// import MyProfile from "views/screens/myprofile/index.js";
import CheckPermission from "views/screens/CheckPermission.js";

import StockStatus from "views/screens/stockstatus/index.js";


import ProductGroup from "views/screens/productgroup/index.js";
import ProductCategory from "views/screens/productcategory/index.js";
import ProductGeneric from "views/screens/productgeneric/index.js";
import Strength from "views/screens/strength/index.js";
import Manufacturer from "views/screens/manufacturer/index.js";
import Supplier from "views/screens/supplier/index.js";
import Customer from "views/screens/customer/index.js";
import UserRole from "views/screens/userrole/index.js";

import Product from "views/screens/product/index.js";
import Receive from "views/screens/receive/index.js";
import Sales from "views/screens/product/index.js";

import UserContextProvider from './context/user-info-context';

//import { QueryClient, QueryClientProvider, useQuery } from 'react-query';

//const queryClient = new QueryClient()

const loading = (
  <div className="pt-3 text-center">
    <div className="sk-spinner sk-spinner-pulse"></div>
  </div>
);

let userInfo = null;

userInfo = {
  FacilityId: 0,
  FacilityName: 'CHUZ-SURU-LERE',
  LangId: 'fr_FR'
};

ReactDOM.render(
  <UserContextProvider userInfo={userInfo}>
    {/* <QueryClientProvider client={queryClient}> */}
      <BrowserRouter basename={process.env.REACT_APP_BASE_NAME}>
        <Suspense>
          <Switch>

            <Route path="/home" render={(props) => <Index {...props} />} />
            <Route path="/login" render={(props) => <LoginPage {...props} />} />
            {/* <Route path="/signup" render={(props) => <SignUpPage {...props} />} /> */}
            {/* <Route path="/reset-password" render={(props) => <ResetPassword {...props} />} /> */}
            {/* <Route path="/dashboard" render={(props) => <DashboardPage {...props} />} /> */}
      			{/* <Route path="/my-profile" render={(props) => <MyProfile {...props} />} /> */}
            <Route path="/check-permission" render={(props) => <CheckPermission {...props} />} />

            <Route path="/stockstatus" render={(props) => <StockStatus {...props} />} />

            <Route path="/productgroup" render={(props) => <ProductGroup {...props} />} />
            <Route path="/productcategory" render={(props) => <ProductCategory {...props} />} />
            <Route path="/productgeneric" render={(props) => <ProductGeneric {...props} />} />
            <Route path="/strength" render={(props) => <Strength {...props} />} />
            <Route path="/manufacturer" render={(props) => <Manufacturer {...props} />} />
            <Route path="/supplier" render={(props) => <Supplier {...props} />} />
            <Route path="/customer" render={(props) => <Customer {...props} />} />
            <Route path="/userrole" render={(props) => <UserRole {...props} />} />

            <Route path="/product" render={(props) => <Product {...props} />} />
            <Route path="/receive" render={(props) => <Receive {...props} />} />
            <Route path="/sales" render={(props) => <Sales {...props} />} />


            {/* <Route path="/error-log" render={(props) => <Errorlog {...props} />} />
            <Route path="/audit-log" render={(props) => <Auditlog {...props} />}/> */}

            <Route path="/" render={(props) => <Index {...props} />} />

          </Switch>
        </Suspense>
      </BrowserRouter>
   {/*  </QueryClientProvider> */}
  </UserContextProvider>,
  document.getElementById("root")
);
