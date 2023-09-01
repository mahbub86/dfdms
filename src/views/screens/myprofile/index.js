import React from "react";
import { makeStyles } from "@material-ui/core/styles";
import { Switch, Route, useRouteMatch } from "react-router-dom";
import AfterLoginNavbar from "components/Navbars/AfterLoginNavbar";
import {checkLogin, checkUserPermission} from "../../../services/CheckUserAccess";

import swal from "sweetalert";
import Notification from "../../../services/Notification"; 
// UserEntry screen

import Myprofile from "./EditMyprofile";

const Index = (props) => {
  const classes = useStyles();
  const { path } = useRouteMatch();
  const menukey = "my-profile";

  const [RedirectLogin, setRedirectLogin] = React.useState(true);
/*   const checkLogin = () => {  
    let token = sessionStorage.getItem("token");
    if (!token) {
      swal({
        title: "Oops!",
        text: 'token expired. Please login again',
        icon: "warning",
        buttons: ["No", "Yes"],
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) { 
          window.location.href = process.env.REACT_APP_BASE_NAME+`/login`;
          sessionStorage.clear();
        }
      });
    }
  }; */
  
  const [hasUserPermission, setHasUserPermission] = React.useState(false);

  if(RedirectLogin){
    setHasUserPermission(checkUserPermission(menukey));// To check user has permission in this page
    checkLogin();
    setRedirectLogin(false);
  }

  React.useEffect(() => {
    // checkLogin();
    // checkAccess();
  }, []);

  const [msgObj, setMsgObj] = React.useState({
    isOpen: false,
  });
  const openNoticeModal = (obj) => {
    setMsgObj(obj);
  };
  const closeNoticeModal = (event, reason) => { 
      if (reason === 'clickaway') {
        return;
      } 
    setMsgObj({ isOpen: false });
  };

  return (
    hasUserPermission && (
    <div>
      <AfterLoginNavbar {...props} />
      <div className={`section signup-top-padding ${classes.userentryContainer}`}>
        <Switch>

          <Route
            path={`${path}/`}
            render={(props) => (
              <Myprofile {...props} openNoticeModal={openNoticeModal} />
            )}
          ></Route>
          
        </Switch>
        <Notification
          closeNoticeModal={closeNoticeModal}
          msgObj={msgObj}
          {...props}
        ></Notification>
      </div>
    </div>)
  );
};

export default Index;

const useStyles = makeStyles({
  userentryContainer: {
    backgroundImage: "url(" + require("assets/img/bg8.jpg") + ")",
    backgroundSize: "cover",
    backgroundPosition: "top center",
    minHeight: "753px",
  },
});
