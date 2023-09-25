<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- GG FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <!-- FONT AWESOME -->
    <script
      src="https://kit.fontawesome.com/352ae1e694.js"
      crossorigin="anonymous"
    ></script>
    <!-- BOOSTRAP -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <!-- JQuery -->
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://cdn.stringee.com/sdk/web/latest/stringee-web-sdk.min.js"
    ></script>
    <!-- STYLE -->
    <style>
        @keyframes myAnim {
          0% {
            animation-timing-function: ease-out;
            transform: scale(1);
            transform-origin: center center;
          }

          10% {
            animation-timing-function: ease-in;
            transform: scale(0.91);
          }

          17% {
            animation-timing-function: ease-out;
            transform: scale(0.98);
          }

          33% {
            animation-timing-function: ease-in;
            transform: scale(0.87);
          }

          45% {
            animation-timing-function: ease-out;
            transform: scale(1);
          }
        }
        .call-model {
        width: 100%;
        height: 100vh;
        margin: 0;
        }
        .call-container {
        margin: 0 auto;
        width: 330px;
        height: 550px;
        padding: 20px;
        box-sizing: border-box;
        margin-top:20px;
        background: linear-gradient(
          0deg,
          rgba(0, 106, 253, 1) 0%,
          rgba(0, 170, 242, 1) 100%
        );
        }
        .call-item-container {
        width: 100%;
        }
        .call-avatar {
        margin-top: 10px;
        }
        .call-avatar > img {
        width: 150px;
        border-radius: 50%;
        background-color:white;
        }
        .call-number {
        margin-top: 20px;
        }
        .call-number-item {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin-top: 20px;
        }
        .call-number-item-status {
        width: 100%;
        }
        .call-status {
        font-size: 14px;
        font-weight: 500;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        color:white;
        }
        .call-name {
        font-size: 20px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        color:white;
        }
        .call-number-item > label {
        display: flex;
        align-items: center;
        font-size: 13px;
        font-weight: 500;
        width: 20%;
        height: 35px;
        margin: 0;
        padding: 0;
        color:white;
        }
        .call-number-item > input {
        width: 75%;
        height: 35px;
        margin: 0;
        border: 1px solid rgba(0, 0, 0, 0.21);
        padding-left: 5px;
        box-sizing: border-box;
        color: black;

        outline: none;
        font-size: 13px;
        background-color: white;
        }
        .call-numer-button-container {
        width: 100%;
        margin-top: 30px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        }
        .call-enable {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin: 0;
        margin: 0 10;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        cursor: pointer;
        }
        .call-enable > i {
        font-size: 15px;
        font-weight: 600;
        }
        .call-disable {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin: 0;
        margin: 0 10;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        cursor: pointer;
        }
        .call-disable > i {
        font-size: 15px;
        font-weight: 600;
        }
    </style>
    <title>CSKH</title>
  </head>
  <body>
    <script type="text/javascript">
      var stringeeClient;
      var call;
      var authenticatedWithUserId = "";

      var fromNumber = "FROM_NUMBER";
      var accessToken = "YOUR_ACCESS_TOKEN";

      $(document).ready(function () {
        //check isWebRTCSupported
        console.log(
          "StringeeUtil.isWebRTCSupported: " + StringeeUtil.isWebRTCSupported()
        );

        $("#loginBtn").on("click", function () {
          $("#loggedUserId").html("Connecting...");

          var accessToken = $("#accessTokenArea").val();
          console.log("accessToken...: " + accessToken);

          stringeeClient = new StringeeClient();
          settingClientEvents(stringeeClient);
          stringeeClient.connect(accessToken);
        });
      });

      function testMakeCall() {
        document.getElementById("call-avatar").style.animation =
          "myAnim 3s ease 0s 300 normal none";
        var callTo = $("#callTo").val();
        if (callTo.length === 0) {
          return;
        }
        //fromNumber
        fromNumber = $("#fromNumber").val();
        if (fromNumber.length === 0) {
          fromNumber = authenticatedWithUserId;
        }
        call = new StringeeCall(stringeeClient, fromNumber, callTo);

        settingCallEvents(call);

        call.makeCall(function (res) {
          console.log("make call callback: " + JSON.stringify(res));
          if (res.r !== 0) {
            $("#callStatus").html(res.message);
          } else {
            //call type
            if (res.toType === "internal") {
              $("#callType").html("App-to-App call");
            } else {
              $("#callType").html("App-to-Phone call");
            }
          }
        });
      }

      function settingClientEvents(client) {
        client.on("connect", function () {
          console.log("connected to StringeeServer");
        });

        client.on("authen", function (res) {
          console.log("on authen: ", res);
          if (res.r === 0) {
            authenticatedWithUserId = res.userId;
            $("#callBtn").removeAttr("disabled");

            $("#loggedUserId").html(authenticatedWithUserId);
            $("#loggedUserId").css("color", "blue");
          } else {
            $("#loggedUserId").html(res.message);
          }
        });

        client.on("disconnect", function () {
          console.log("disconnected");
          $("#callBtn").attr("disabled", "disabled");
        });

        client.on("incomingcall", function (incomingcall) {
          call = incomingcall;
          settingCallEvents(incomingcall);

          $("#incoming-call-div").show();
          $("#incoming_call_from").html(call.fromNumber);

          console.log("incomingcall: ", incomingcall);
          //fromInternal: false
          if (incomingcall.fromInternal) {
            $("#callType").html("App-to-App call");
          } else {
            $("#callType").html("Phone-to-App call");
          }
        });

        client.on("requestnewtoken", function () {
          console.log(
            "request new token; please get new access_token from YourServer and call client.connect(new_access_token)"
          );
          //please get new access_token from YourServer and call:
          //client.connect(new_access_token);
        });

        client.on("otherdeviceauthen", function (data) {
          console.log("otherdeviceauthen: ", data);
        });
      }

      function settingCallEvents(call1) {
        $("#hangupBtn").removeAttr("disabled");

        call1.on("error", function (info) {
          console.log("on error: " + JSON.stringify(info));
        });

        call1.on("addlocalstream", function (stream) {
          console.log("on addlocalstream", stream);
        });

        call1.on("addremotestream", function (stream) {
          console.log("on addremotestream", stream);
          // reset srcObject to work around minor bugs in Chrome and Edge.
          remoteVideo.srcObject = null;
          remoteVideo.srcObject = stream;
        });

        call1.on("signalingstate", function (state) {
          console.log("signalingstate", state);

          if (state.code == 6) {
            //call ended
            $("#incoming-call-div").hide();
            callStopped();
          }

          if (state.code == 5) {
            //busy here
            callStopped();
          }

          var reason = state.reason;
          $("#callStatus").html(reason);
        });

        call1.on("mediastate", function (state) {
          console.log("mediastate ", state);
        });

        call1.on("info", function (info) {
          console.log("on info", info);
        });

        call1.on("otherdevice", function (data) {
          console.log("on otherdevice:" + JSON.stringify(data));

          if (
            (data.type === "CALL_STATE" && data.code >= 200) ||
            data.type === "CALL_END"
          ) {
            $("#incoming-call-div").hide();
          }
        });
      }

      function testAnswerCall() {
        call.answer(function (res) {
          console.log("answer res", res);
          $("#incoming-call-div").hide();
        });
      }

      function testRejectCall() {
        callStopped();
        call.reject(function (res) {
          console.log("reject res", res);
          $("#incoming-call-div").hide();
        });
      }

      function testHangupCall() {
        document.getElementById("call-avatar").style.animation =
          "";
        remoteVideo.srcObject = null;
        callStopped();

        call.hangup(function (res) {
          setTimeout(function() {
                window.close();
              }, 1000);
            console.log("hangup res", res);             
        }); 
      }
      function callStopped() {
        $("#hangupBtn").attr("disabled", "disabled");

        setTimeout(function () {
          $("#callStatus").html("Call ended");
        }, 1500);
      }
    </script>
    <div class="conainter-fluid call-model">
      <div class="call-container bg-primary">
        <div
          class="call-avatar call-item-container d-flex justify-content-center align-items-center" id="call-avatar"
        >
          <img src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg" alt="" />
        </div>
        <div class="call-number call-item-container">
          <div class="call-number-item-status">
            <p class="call-name">{{$name}}</p>
            <p class="call-status" id="callStatus"></p>
          </div>
          <div class="call-number-item">
            <label for="">Token: </label>
            <input
              id="accessTokenArea"
              type="text"
              value="eyJjdHkiOiJzdHJpbmdlZS1hcGk7dj0xIiwidHlwIjoiSldUIiwiYWxnIjoiSFMyNTYifQ.eyJqdGkiOiJTSy4wLlpnVmxvSkhLaTlGdUpsdDhReTlQOFBQa0VramVKR1otMTY5NTM0NTc0NiIsImlzcyI6IlNLLjAuWmdWbG9KSEtpOUZ1Smx0OFF5OVA4UFBrRWtqZUpHWiIsImV4cCI6MTY5NzkzNzc0NiwidXNlcklkIjoiMTAifQ.X-gyBtAs6RNwuegVBRZGxBWr6SQsDo-KeZDT7-A1SIM"
              disabled
            />
          </div>
          <div class="call-number-item">
            <label for="">Gọi từ: </label>
            <input
              type="text"
              value="842871008898"
              id="fromNumber"
              name="fromNumber"
              disabled
            />
          </div>
          <div class="call-number-item">
            <label for="">Gọi đến: </label>
            <input
              type="text"
              value="{{$phone}}"
              id="callTo"
              name="toUsername"
              disabled
            />
          </div>
          <div class="call-numer-button-container">
            <p class="call-enable bg-white" id="loginBtn" style="color:black;">
              <i class="fa-solid fa-plug"></i>
            </p>
            <p
              class="call-enable bg-success"
              id="callBtn"
              onclick="testMakeCall()"
            >
              <i class="fa-solid fa-phone"></i>
            </p>
            <p
              class="call-disable bg-danger"
              id="hangupBtn"
              onclick="testHangupCall();"
            >
              <i class="fa-solid fa-phone-slash"></i>
            </p>
          </div>
          <div>
            <video
              id="remoteVideo"
              playsinline
              autoplay
              style="width: 350px"
            ></video>
          </div>
        </div>
      </div>
    </div>
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
