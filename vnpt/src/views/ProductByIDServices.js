import React, { useEffect, useState } from "react";
import FormatCurrency from "../include/FormatCurrency";
import { useParams } from "react-router-dom";
import axios from "axios";

function ProductByIDServices() {
  const [dataProducts, setDataProducts] = useState([]);
  const [dataSer, setDataSer] = useState([]);
  const { id } = useParams();
  useEffect(() => {
    getData(id);
  }, [id]);

  const getData = (id) => {
    axios
      .get(`http://127.0.0.1:8000/api/v1/services/${id}`)
      .then((response) => {
        setDataSer(response.data.data[0]);
      });
    axios
      .get(`http://127.0.0.1:8000/api/v1/products-in-services/${id}`)
      .then((response) => {
        setDataProducts(response.data.dataProducts);
      });
  };

  return (
    <div className="content p-0">
      <div>
        <p className="product-list-title text-center" id="product-list-title">
          {dataSer.ser_name
            ? dataSer.ser_name.toUpperCase()
            : "Không Có".toUpperCase()}
        </p>
        <div className="product-list row justify-content-between">
          {dataProducts.map((item, index) => {
            return (
              <div className="product-list-item col-auto" key={index}>
                <img
                  src="https://vnpt.com.vn/Media/Images/25072023/VD120M_%20646x490.jpg?w=315&mode=crop"
                  alt=""
                />
                <p className="product-list-item-name">{item.products_name}</p>
                <p className="product-list-item-des">{item.products_des}</p>
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
            );
          })}
        </div>
      </div>
    </div>
  );
}

export default ProductByIDServices;
