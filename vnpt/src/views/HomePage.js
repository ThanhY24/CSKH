import React, { Fragment } from "react";
import FormatCurrency from "../include/FormatCurrency";
import axios from "axios";
class HomePage extends React.Component {
  state = {
    dataProduct: [],
    dataSer: [],
  };
  componentDidMount() {
    this.getData();
  }
  getData = () => {
    axios.get("http://127.0.0.1:8000/api/v1/products").then((response) => {
      this.setState({
        dataProduct: response.data.data,
      });
    });
    axios.get("http://127.0.0.1:8000/api/v1/services").then((response) => {
      this.setState({
        dataSer: response.data,
      });
    });
  };
  render() {
    return (
      <div className="content p-0">
        {this.state.dataSer.map((item, index) => {
          const productsInCategory = this.state.dataProduct.filter(
            (itemProduct) => itemProduct.ser_id === item.ser_id
          );
          if (productsInCategory.length === 0) {
            return (
              <Fragment key={index}>
                <p className="product-list-title text-center">
                  {item.ser_name.toUpperCase()}
                </p>
                <p className="text-center">Danh Mục Này Chưa Có Sản Phẩm Nào</p>
              </Fragment>
            );
          }
          return (
            <Fragment>
              <p className="product-list-title text-center">
                {item.ser_name.toUpperCase()}
              </p>
              <div className="product-list row justify-content-between">
                {this.state.dataProduct.map((itemProduct, indexProduct) => {
                  return itemProduct.ser_id === item.ser_id ? (
                    <div
                      className="product-list-item col-auto"
                      key={indexProduct}
                    >
                      <img
                        src="https://vnpt.com.vn/Media/Images/25072023/VD120M_%20646x490.jpg?w=315&mode=crop"
                        alt=""
                      />
                      <p className="product-list-item-name">
                        {itemProduct.products_name}
                      </p>
                      <p className="product-list-item-des">
                        {itemProduct.products_des}
                      </p>
                      <p className="product-list-item-cost">
                        {FormatCurrency(Number(item.products_cost))}
                        <span style={{ color: "black" }}>
                          /{item.products_duration}
                        </span>
                      </p>
                      <div className="product-list-button row justify-content-around">
                        <p className="product-list-button-item bg-danger">
                          <i className="fa-regular fa-heart"></i>Yêu thích
                        </p>
                        <p className="product-list-button-item bg-primary">
                          <i className="fa-solid fa-circle-info"></i>Chi Tiết
                        </p>
                      </div>
                    </div>
                  ) : null;
                })}
              </div>
            </Fragment>
          );
        })}
      </div>
    );
  }
}
export default HomePage;
