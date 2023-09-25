import React, { useRef } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
class Header extends React.Component {
  state = {
    dataSerGr: [],
  };
  componentDidMount() {
    this.getData();
  }
  getData = () => {
    axios
      .get("http://127.0.0.1:8000/api/v1/services-group-and-services")
      .then((response) => {
        this.setState(
          {
            dataSerGr: response.data,
          },
          () => {
            console.log(this.state.dataSerGr);
          }
        );
      });
  };
  // Cuộn khi click
  scroll = () => {
    const elementToScrollTo = document.getElementById("product-list-title");
    if (elementToScrollTo) {
      elementToScrollTo.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    } else {
      console.log("KHông có");
    }
  };
  render() {
    return (
      <div className="header container-fluid border border-black">
        <div className="header-top row">
          <div className="col-2 header-top-logo">
            <Link to={"/home"}>
              <img
                src="https://vnpt.com.vn/design/images/logo-vnpt.jpg"
                alt=""
              />
            </Link>
          </div>
          <div className="col-4 header-top-category">
            <Link className="header-top-category-item header-top-category-item-active">
              Cá Nhân
            </Link>
            <Link to="#" className="header-top-category-item">
              Doanh Nghiệp
            </Link>
            <Link to="#" className="header-top-category-item">
              Về VNPT
            </Link>
          </div>
          <form className="col-3 header-top-search">
            <input
              type="text"
              className="header-top-search-input"
              placeholder="Tìm kiếm"
            />
            <label htmlFor="" className="header-top-search-label">
              <i className="fa-solid fa-magnifying-glass"></i>
            </label>
          </form>
          <div className="col-3 header-top-other">
            <Link to="" className="header-top-other-item">
              <i className="fa-solid fa-cart-shopping"></i>
            </Link>
            <Link to="" className="header-top-other-item">
              <i className="fa-solid fa-headset"></i>
            </Link>
            <Link to="" className="header-top-other-item">
              <i className="fa-solid fa-check-to-slot"></i>
            </Link>
            <Link to="" className="header-top-other-item">
              <i className="fa-solid fa-user"></i>
            </Link>
          </div>
        </div>
        <div className="header-menu">
          <ul className="header-menu-container">
            {this.state.dataSerGr ? (
              this.state.dataSerGr.map((item, index) => (
                <li className="header-menu-item" key={index}>
                  {item.ser_gr_name} &nbsp;
                  {item.services.length > 0 > 0 && ( // Kiểm tra xem services có dữ liệu hay không
                    <>
                      <i className="fa-solid fa-caret-down"></i>
                      <ul className="header-submenu-container">
                        {item.services.map((service, subIndex) => (
                          <li className="header-submenu-item" key={subIndex}>
                            <Link
                              to={
                                "http://localhost:7000/services/" +
                                service.ser_id
                              }
                              onClick={() => {
                                this.scroll();
                              }}
                            >
                              {service.ser_name}
                            </Link>
                          </li>
                        ))}
                      </ul>
                    </>
                  )}
                </li>
              ))
            ) : (
              // Xử lý khi this.state.dataSerGr là undefined hoặc không có dữ liệu
              <li>Không có dữ liệu.</li>
            )}
          </ul>
        </div>
      </div>
    );
  }
}
export default Header;
