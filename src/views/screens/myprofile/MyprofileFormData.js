import React from "react";
import { makeStyles} from "@material-ui/core/styles";
import {
  Grid,
  TextField,
  Button,
  FormControl,
  InputLabel,
  Select,
  MenuItem,
  Card,
  CardContent,
  FormHelperText,
} from "@material-ui/core";
// import { useTranslation } from "react-i18next";


//get DispensingLanguage
const DispensingLanguage = JSON.parse(
  localStorage.getItem("DispensingLanguage")
);
const lan = localStorage.getItem("LangCode");
const menukey = "my-profile";


const UserInfo = sessionStorage.getItem("User_info")
  ? JSON.parse(sessionStorage.getItem("User_info"))
  : 0;  
const userId = UserInfo==0?'': UserInfo[0].id;
 
const DispenserFormData = ({
  errorObject,
  addProductForm,
  formData,
  handleChange,
  handleCheck,
  handleReset,
  handleSubmit,
  handleUpdate,
  ...props
}) => {
  const classes = useStyles();

  // const { t, i18n } = useTranslation();

  const LanguageList = JSON.parse(localStorage.getItem("LanguageList"));
  return (
    <div className={classes.productPageTitle}>
      <div className="sw_makeStyles_tableContainer">
        <div className="d-flex justify-product mb-3">
          <Grid item xs={12} sm={12}>
            <div className="sw_page_heading">
              <div className="sw_heading_title">
                {DispensingLanguage[lan][menukey]["My Profile"]}
              </div>

              <div className="float-right sw_btn_control">
                {addProductForm ? (
                  <Grid item xs={12} className="mt-4 text-center">
                    <div className="float-right sw_btn_control">
                      <Button
                        className="mr-2"
                        variant="contained"
                        type="reset"
                        onClick={() => handleReset()}
                      >
                        {DispensingLanguage[lan][menukey]["Reset"]}
                      </Button>
                      <Button
                        className="mr-2"
                        variant="contained"
                        color="primary"
                        onClick={() => handleSubmit()}
                      >
                        {DispensingLanguage[lan][menukey]["Save"]}
                      </Button>
                 
                    </div>
                  </Grid>
                ) : (
                  <Grid item xs={12} className="mt-2 text-center">
                    <Button
                      className="mr-2"
                      variant="contained"
                      color="primary"
                      onClick={() => handleUpdate()}
                      
                    >
                      {DispensingLanguage[lan][menukey]["update"]}
                    </Button>
                  </Grid>
                )}
              </div>
            </div>
          </Grid>
        </div>

        {/* New row */}
        <Grid container spacing={3}>
          {/* New row */}
          <Grid item xs={12} sm={12}>
            <Card className="sw_card">
              <CardContent>
                <Grid container spacing={3}>
                  <Grid item xs={4} sm={4}>
                    <TextField
                      error={errorObject.name}
                      helperText={errorObject.name}
                      required
                      id="name"
                      name="name"
                      label={DispensingLanguage[lan][menukey]["User Name"]}
                      value={formData.name}
                      fullWidth
                      autoComplete="family-name"
                      onChange={(e) => handleChange(e)}
                    />
                  </Grid>

                  <Grid item xs={4} sm={4}>
                    <TextField
                      error={errorObject.email}
                      helperText={errorObject.email}
                      required
                      id="email"
                      name="email"
                      label={DispensingLanguage[lan][menukey]["User Email"]}
                      value={formData.email}
                      fullWidth
                      autoComplete="family-name"
                      onChange={(e) => handleChange(e)}
                    />
                  </Grid>
                  <Grid item xs={4} sm={4}>
                    <TextField
                      error={errorObject.loginname}
                      helperText={errorObject.loginname}
                      required
                      id="loginname"
                      name="loginname"
                      label={DispensingLanguage[lan][menukey]["User Login"]}
                      value={formData.loginname}
                      fullWidth
                      autoComplete="family-name"
                      onChange={(e) => handleChange(e)}
                    />
                  </Grid>
                  <Grid item xs={12} sm={4}>
                    <Grid container spacing={1}>
                          <Grid item xs={12} sm={6}>
                            <TextField
                              error={errorObject.password}
                              helperText={errorObject.password}
                              required
                              id="password"
                              name="password"
                              type="password"
                              label={DispensingLanguage[lan][menukey]["Change Password"]}
                              fullWidth
                              autoComplete="family-name"
                              onChange={(e) => handleChange(e)}
                            />
                          </Grid>

                          <Grid item xs={12} sm={6}>
                            <TextField
                              error={errorObject.confirmChangePassword}
                              helperText={errorObject.confirmChangePassword}
                              id="confirmChangePassword"
                              name="confirmChangePassword"
                              type="password"
                              label={DispensingLanguage[lan][menukey]["Confirm Change Password"]}
                              //value={formData.confirmChangePassword}
                              fullWidth
                              autoComplete="family-name"
                              onChange={(e) => handleChange(e)}
                            />
                          </Grid>
                      </Grid>

                  </Grid>
                 
                  <Grid item xs={4} sm={4}>
                    <TextField
                      error={errorObject.designation}
                      helperText={errorObject.designation}
                      required
                      id="designation"
                      name="designation"
                      label={DispensingLanguage[lan][menukey]["User Designation"]}
                      value={formData.designation}
                      fullWidth
                      autoComplete="family-name"
                      onChange={(e) => handleChange(e)}
                    />
                  </Grid>
                  <Grid item xs={4} sm={4}>
                    <FormControl className={classes.fullWidth}>
                      <InputLabel id="demo-simple-select-helper-label">
                        {DispensingLanguage[lan][menukey]["Language"]}*
                      </InputLabel>
                      <Select
                        error={errorObject.LangCode}
                        labelId="demo-simple-select-helper-label"
                        id="LangCode"
                        name="LangCode"
                        value={formData.LangCode||'fr_FR' }
                        fullWidth
                        onChange={(e) => handleChange(e)}
                      >
                        {LanguageList.map((item, index) => {
                          return (
                            <MenuItem value={item.id}>{item.name}</MenuItem>
                          );
                        })}
                      </Select>
                      <FormHelperText error={errorObject.LangCode}>
                        {errorObject.LangCode}
                      </FormHelperText>
                    </FormControl>
                  </Grid>

                </Grid>

                {/* New Row */}
              </CardContent>
            </Card>
          </Grid>
        </Grid>
      </div>
    </div>
  );
};

export default DispenserFormData;

const useStyles = makeStyles({
  productPageTitle: {
    marginTop: "60px",
    color: "white",
    padding: "10px",
  },
  tableContainer: {
    backgroundColor: "whitesmoke",
    borderRadius: "10px",
    padding: "2rem",
    color: "black",
  },
  fullWidth: {
    width: "100%",
  },
});