import React from "react";
import avt1 from "../assets/images/avt.jpg";
import avt2 from "../assets/images/av1.jpg";
import icon from "../assets/images/VNPT.png";
class ChatBot extends React.Component {
  // Đóng mở Chatbot
  openChatBot = () => {
    document.getElementById("chatbot").classList.remove("fadeOut");
    document.getElementById("chatbot").classList.add("fadeIn");
    document.getElementById("chatbot").style.display = "block";
    document.getElementById("chatbot-icon").style.display = "none";
  };
  closeChatBot = () => {
    document.getElementById("chatbot").classList.remove("fadeIn");
    document.getElementById("chatbot").classList.add("fadeOut");
    setTimeout(function () {
      document.getElementById("chatbot").style.display = "none";
    }, 500);
    document.getElementById("chatbot-icon").style.display = "block";
  };
  render() {
    return (
      <>
        <div className="chatbot-icon" id="chatbot-icon">
          <img src={icon} alt="" onClick={this.openChatBot} />
        </div>
        <div className="chatbot" id="chatbot">
          <div className="chatbot-header row justify-content-between">
            <div className="chatbot-header-title">
              <p>Trợ lý ảo VNPT - Ami</p>
            </div>
            <p className="chatbot-header-button">
              <i
                className="fa-solid fa-x"
                id="chatbot-close"
                onClick={this.closeChatBot}
              ></i>
            </p>
          </div>
          <div className="chatbot-content">
            <div className="chatbot-message row">
              <img src={avt1} alt="" />
              <div className="chatbot-message-item col-10">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum
                explicabo quas omnis! Dolorum praesentium repudiandae ab!
                Suscipit voluptates quod vero ipsa, ad quas neque, quae earum
                sint, reiciendis natus fugiat?
              </div>
            </div>
            <div className="chatbot-message chatbot-message-reverse row">
              <img src={avt2} alt="" />
              <div className="chatbot-message-item col-10">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum
                explicabo quas omnis! Dolorum praesentium repudiandae ab!
                Suscipit voluptates quod vero ipsa, ad quas neque, quae earum
                sint, reiciendis natus fugiat?
              </div>
            </div>
            <div className="chatbot-message row">
              <img src={avt1} alt="" />
              <div className="chatbot-message-item col-10">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum
                explicabo quas omnis! Dolorum praesentium repudiandae ab!
                Suscipit voluptates quod vero ipsa, ad quas neque, quae earum
                sint, reiciendis natus fugiat?
              </div>
            </div>
            <div className="chatbot-message chatbot-message-reverse row">
              <img className="" src={avt2} alt="" />
              <div className="chatbot-message-item col-10">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum
                explicabo quas omnis! Dolorum praesentium repudiandae ab!
                Suscipit voluptates quod vero ipsa, ad quas neque, quae earum
                sint, reiciendis natus fugiat?
              </div>
            </div>
          </div>
          <div className="chatbot-footer row justify-content-between">
            <input type="text" className="col-10" placeholder="Soạn tin nhắn" />
            <p className="col-1">
              <i className="fa-solid fa-paper-plane"></i>
            </p>
          </div>
        </div>
      </>
    );
  }
}
export default ChatBot;
