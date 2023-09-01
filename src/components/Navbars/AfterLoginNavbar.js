import React, { useContext } from "react";
import { apiCall, apiOption, LoginUserInfo, language } from "../../actions/api";

function AfterLoginNavbar(props) {
  const [userInfo, setUserInfo] = React.useState(LoginUserInfo());

  function menuShowPermision(pMenuKey) {
    let isShow = 0;

    // console.log(LoginUserInfo().UserAllowdMenuList);
    let menuList = LoginUserInfo().UserAllowdMenuList;
    // console.log("menuList: ", menuList);

    menuList.forEach((menu, i) => {
      // console.log('menu: ', menu.MenuKey);
      if (menu.MenuKey === pMenuKey) {
        isShow = 1;
        return;
      }
    });

    return isShow;
  }

  return (
    <>
      {/* <!-- NAV BAR --> */}
      <nav class="navbar">
        {/* <!-- LOGO --> */}
        <div class="logo">
          <img alt="..." src={require("assets/img/ngpl_logo.png")}></img>
        </div>

        {/* <!-- MENUE LIST  BAR --> */}
        <div class="menuBar">
          <div class="menuListBar">
            <ul>
              <li class="dropdownMenu">
                {" "}
                <a
                  class="parentMenu"
                  href="javascript:void(0)"
                  onClick={() => props.history.push("home")}
                >
                  Home
                </a>
              </li>

              {menuShowPermision("dashboard") === 1 && (
                <li class="dropdownMenu">
                  {" "}
                  <a
                    class="parentMenu"
                    href="javascript:void(0)"
                    onClick={() => props.history.push("dashboard")}
                  >
                    Dashboard
                  </a>
                </li>
              )}

              {menuShowPermision("reports") === 1 && (
                <li class="dropdownMenu">
                  {" "}
                  Reports
                  <ul class="dropdownList">
                    {menuShowPermision("stockstatus") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("stockstatus")}
                        >
                          Stock Status
                        </a>
                      </li>
                    )}

                    {menuShowPermision("report2") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("report2")}
                        >
                          Report 2
                        </a>
                      </li>
                    )}
                  </ul>
                </li>
              )}

              {menuShowPermision("settings") === 1 && (
                <li class="dropdownMenu">
                  {" "}
                  Settings
                  <ul class="dropdownList">

                  {menuShowPermision("datatype") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("datatype")}
                        >
                          Data Type
                        </a>
                      </li>
                    )}

                    {menuShowPermision("productgroup") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("productgroup")}
                        >
                          Product Group
                        </a>
                      </li>
                    )}

                    {menuShowPermision("productcategory") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("productcategory")}
                        >
                          Product Category
                        </a>
                      </li>
                    )}

                    {menuShowPermision("productgeneric") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("productgeneric")}
                        >
                          Product Generic
                        </a>
                      </li>
                    )}

                    {menuShowPermision("strength") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("strength")}
                        >
                          Strength
                        </a>
                      </li>
                    )}

                    {menuShowPermision("manufacturer") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("manufacturer")}
                        >
                          Manufacturer
                        </a>
                      </li>
                    )}

                    {menuShowPermision("supplier") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("supplier")}
                        >
                          Supplier
                        </a>
                      </li>
                    )}

                    {menuShowPermision("customer") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("customer")}
                        >
                          Customer
                        </a>
                      </li>
                    )}

{menuShowPermision("userrole") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("userrole")}
                        >
                          User Role
                        </a>
                      </li>
                    )}
                  </ul>
                </li>
              )}



              {menuShowPermision("products") === 1 && (
                <li class="dropdownMenu">
                  {" "}
                  Product
                  <ul class="dropdownList">
                    {menuShowPermision("product") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("product")}
                        >
                          Product
                        </a>
                      </li>
                    )}

                    {menuShowPermision("receive") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("receive")}
                        >
                          Receive
                        </a>
                      </li>
                    )}

                    {menuShowPermision("sales") === 1 && (
                      <li>
                        <a
                          href="javascript:void(0)"
                          onClick={() => props.history.push("sales")}
                        >
                          Sales
                        </a>
                      </li>
                    )}
                  </ul>
                </li>
              )}
            </ul>
          </div>

          {/* <!-- ICON BAR --> */}
          <div class="menuIconBar">
            <a href="./Customer.html">
              <img src={require("assets/ico/customer.png")} alt="Customer" />
            </a>
            <a href="./receive.html">
              <img src={require("assets/ico/receive.png")} alt="Receive" />
            </a>
            <a href="./receive.html">
              <img src={require("assets/ico/sales.png")} alt="Sales" />
            </a>
            <a href="./receive.html">
              <img src={require("assets/ico/return.png")} alt="Return" />
            </a>
            <a href="./receive.html">
              <img src={require("assets/ico/stock.png")} alt="Stock" />
            </a>
            <a href="./receive.html">
              <img src={require("assets/ico/payment.png")} alt="Payment" />
            </a>
            <a href="./receive.html">
              <img src={require("assets/ico/expense.png")} alt="Expense" />
            </a>
          </div>
        </div>

        {/* <!-- USER PANEL --> */}
        <div class="userPanel">
          <div>
            <label>{userInfo.ClientName}</label>
          </div>
          <div>
            <label>{userInfo.BranchName}</label>
          </div>

          <div class="user">
            {/* <img src="./img/user.jpg" alt=""/> */}
            <ul>
              <li class="dropdownMenu">
                {" "}
                {userInfo.UserName} &nabla;
                <ul class="dropdownList">
                  <li>
                    <a href="#">User Profile</a>
                  </li>
                  <li>
                    <a href="#">Change Password</a>
                  </li>
                  {/* <li><a href="./index.html">Log Out</a></li> */}
                  <li>
                    <a
                      href="javascript:void(0)"
                      onClick={(e) => {
                        e.preventDefault();
                        sessionStorage.clear();
                        setTimeout(() => {
                          props.history.push("/login");
                        }, 1000);
                      }}
                    >
                      {"Logout"}
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
            <img
              src={require("assets/img/user/" + userInfo.PhotoUrl)}
              alt="User"
            />
          </div>
        </div>
      </nav>

      {/* {collapseOpen ? (
        <div
          id="bodyClick"
          onClick={() => {
            document.documentElement.classList.toggle("nav-open");
            setCollapseOpen(false);
          }}
        />
      ) : null} */}

      {/*============================*/}

      {/* <div id="sticky-header" className={"header-menu " + navbarColor}>
        <div className="container-fluid">
          <div className="row">

            <div className="col-lg-8">
              <div className="tp-mega-full">
                <div className="tp-menu align-self-center">
                  <nav className="desktop_menu">
                    <ul>

                      {menu.map((row, i) => {
                        return (
                          <li>
                            <a href="javascript:void(0)" onClick={() => props.history.push(row.url)} >
                              {DispensingLanguage[lan][menukey][row.title]}
                              {row.submenu.length > 0 ? (
                                <span class="tp-angle pull-right">
                                  <i class="fa fa-angle-down"></i>
                                </span>
                              ) : (
                                <></>
                              )}
                            </a>

                            {row.submenu.length > 0 ? (
                              <ul className={"submenu " + row.position}>
                                {row.submenu.map((row1, i1) => {
                                  return (
                                    <li>
                                      <a href="javascript:void(0)" onClick={() => props.history.push(row1.url) } >
                                        {DispensingLanguage[lan][menukey][row1.title]}
                                        {row1.submenu.length > 0 ? (<span class="tp-angle pull-right"><i class="fa fa-angle-right"></i></span>) : (<></>)}
                                      </a>

                                      {row1.submenu.length > 0 ? (
                                        <ul className={"submenu " + row1.position}>
                                          {row1.submenu.map((row2, i2) => {
                                            return (
                                              <li>
                                                <a href="javascript:void(0)" onClick={() => props.history.push(row2.url) } >
                                                  {DispensingLanguage[lan][menukey][row2.title]}
                                                </a>
                                              </li>
                                            );
                                          })}
                                        </ul>
                                      ) : (
                                        <></>
                                      )}
                                    </li>
                                  );
                                })}
                              </ul>
                            ) : (
                              <></>
                            )}
                          </li>
                        );
                      })}
                      

                      <li>
                        <a href="#">{ DispensingLanguage[lan][menukey]['Profile'] }
                          <span class="tp-angle pull-right">
                            <i class="fa fa-angle-down"></i>
                          </span>
                        </a>
                        <ul className="submenu left_position">

                          <li>
                              <Link href="javascript:void(0)" onClick={(e) => {
                              e.preventDefault();
                              props.history.push("/my-profile");
                              }}>{DispensingLanguage[lan][menukey]["My Profile"]}</Link>
                          </li>

                          <li>
                            <a
                              href="javascript:void(0)"
                              onClick={(e) => {
                                e.preventDefault();
                                sessionStorage.clear();
                                setTimeout(() => {props.history.push("/login");}, 1000);
                              }}
                            >
                                {DispensingLanguage[lan][menukey]['Logout']}
                            </a>
                          </li>
                        </ul>
                      </li>

                    </ul>




                  </nav>


                </div>
              </div>
            </div>

            <div className="col-lg-4">
              <div class="logo">
                <div className="logoFormate">
                    <div className="logo_item">
                      <a href="#">eDISP</a> 
                        <span class="sw_sub_title">
                        {" "}
                        {localStorage.getItem("FacilityName")}
                      </span>
                    </div>

                    <div className="imge_section">
                        <ImageList sx={{ width: 45, height: 50}} cols={1} rowHeight="auto" gap={2}>
                          {itemData.map((item) => (
                            <ImageListItem key={item.img}>
                              <img
                                src={`${item.img}?w=50&h=55&fit=crop&auto=format`}
                                alt={item.title}
                                loading="logo"
                              />
                            </ImageListItem>
                          ))}
                        </ImageList>
                    </div> 
                </div>
              </div>
              <button
                onClick={() => onMobileMenuOpen()}
                className="mobile_menu_bars_icon"
                type="button"
              >
                <i class="fas fa-bars"></i>
              </button>
            </div>

          </div>
        </div>
      </div> */}
    </>
  );
}

export default AfterLoginNavbar;
