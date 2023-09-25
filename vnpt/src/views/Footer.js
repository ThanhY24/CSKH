import React from "react";
import axios from "axios";
import { Link } from "react-router-dom";
class Footer extends React.Component {
  render() {
    return (
      <div className="footer">
        <div className="footer-container row justify-content-between">
          <div className="col-6">
            <div className="row">
              <b>VNPT VinaPhone © 2019</b>
            </div>
            <div className="row">Tập đoàn Bưu chính Viễn thông Việt Nam</div>
            <div className="row">
              <b>Hotline:</b>
            </div>
            <div className="row">18001091 - 18001166 - 18001260</div>
            <div className="row">
              <b>Trụ sở:</b> Tòa nhà VNPT, số 57 Phố Huỳnh Thúc Kháng, Phường
              Láng Hạ, Quận Đống Đa, Thành phố Hà Nội, Việt Nam
            </div>
            <div className="row">
              <b>Mã số doanh nghiệp:</b>Số 0100684378 do Sở Kế hoạch và Đầu tư
              TP.Hà Nội cấp ngày 22/10/2018
            </div>
          </div>
          <div className="col-4">
            <div className="footer-contact-item row justify-content-left align-items-center">
              <i className="fa-regular fa-envelope"></i>
              <Link to="">vnpt@gmail.com</Link>
            </div>
            <div className="footer-contact-item row justify-content-left align-items-center">
              <i className="fa-solid fa-quote-right"></i>
              <Link to="">Q&Link</Link>
            </div>
            <div className="footer-contact-item row justify-content-left align-items-center">
              <i className="fa-regular fa-circle-question"></i>
              <Link to="">Điều khoản</Link>
            </div>
            <div className="footer-contact-item row justify-content-left align-items-center">
              <i className="fa-solid fa-book-open"></i>
              <Link to="">Chính sách bảo vệ dữ liệu cá nhân</Link>
            </div>
          </div>
          <div className="col-1">
            <div className="payment-method-item row">
              <Link to="">
                <img
                  src="https://congdoan.vnpt.vn/Uploads/image/News/Thumbnails/2022/1/Thumbnails13552022095504unnamed.png"
                  alt=""
                />
              </Link>
            </div>
          </div>
          <div className="col-1">
            <div className="payment-method-item row">
              <Link to="">
                <img
                  src="https://play-lh.googleusercontent.com/3MogLfX3cy7IYA9nAc3-IueOX6Mv26OgoGQuNb2I-KPp9ZOVB_XQvIvGP0zwJ3fN2A"
                  alt=""
                />
              </Link>
            </div>
          </div>
        </div>
      </div>
    );
  }
}
export default Footer;
