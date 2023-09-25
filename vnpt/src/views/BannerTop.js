import React from "react";
import bn1 from "../assets/images/a.jpg";
import bn2 from "../assets/images/b.jpg";
import bn3 from "../assets/images/c.jpg";
class BannerTop extends React.Component {
  render() {
    return (
      <div className="bannertop" id="bannertop">
        <div className="bannertop-item">
          <img src={bn1} alt="" />
        </div>
        <div className="bannertop-item">
          <img src={bn2} alt="" />
        </div>
        <div className="bannertop-item">
          <img src={bn3} alt="" />
        </div>
      </div>
    );
  }
}
export default BannerTop;
