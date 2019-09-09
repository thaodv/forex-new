//
// demobuttons.js
//
// Displays a form with 3 buttons on the STU pad and on Windows allowing user to input a signature.
// The final signature is then reproduced on a second window on the PC screen
// Please note that sjcl.js is a third-party library which we cannot redistribute.
// It can be obtained from the SJCL project on Github here:  https://github.com/bitwiseshiftleft/sjcl/
// Copyright (c) 2015 Wacom GmbH. All rights reserved.
//

            // enumerations copied from SDK\COM\doc with reformatted syntax
            enumEncodingFlag = {                // encodingFlag reports what the STU device is capable of:
              EncodingFlag_Zlib : 0x01, 
              EncodingFlag_1bit : 0x02,         // mono
              EncodingFlag_16bit : 0x04,        // 16bit colour (520/530)
              EncodingFlag_24bit : 0x08         // 24bit colour (530/540)
            }
            
            enumEncodingMode = {                // selects image transformation
              EncodingMode_1bit : 0x00,         // mono display STU300/430/500
              EncodingMode_1bit_Zlib : 0x01,    // use zlib compression (not automated by the SDK – the application code has to compress the data)
              EncodingMode_16bit : 0x02,        // colour stu-520 & 530
              EncodingMode_24bit : 0x04,        // colour STU 530, 540
                                                // tablet.supportsWrite() is true if the bulk driver is installed and available
              EncodingMode_1bit_Bulk : 0x10,    // use bulk driver (520/530/540) 
              EncodingMode_16bit_Bulk : 0x12, 
              EncodingMode_24bit_Bulk : 0x14, 
            
              EncodingMode_Raw : 0x00, 
              EncodingMode_Zlib : 0x01, 
              EncodingMode_Bulk : 0x10, 
              EncodingMode_16bit_565 : 0x02 
            }
            
            enumScale = {
              Scale_Stretch : 0, 
              Scale_Fit : 1, 
              Scale_Clip : 2 
            }
            enumProductId = {
              STU_500 :  0xa1,
              STU_300 :  0xa2,
              STU_520 :  0xa3,
              STU_430 :  0xa4,
              STU_530 :  0xa5,
              STU_540 :  0xa8
            }
            enumPenDataOptionMode =
            {
                PenDataOptionMode_None : 0,
                PenDataOptionMode_TimeCount : 1,
                PenDataOptionMode_SequenceNumber : 2,
                PenDataOptionMode_TimeCountSequence : 3
            };
            
            var m_Debug = 0;
            
            function print(txt) {
              if (m_Debug == 1)
              {
              var txtDisplay = document.getElementById("txtDisplay");
              txtDisplay.value += txt + "\n";
              txtDisplay.scrollTop = txtDisplay.scrollHeight; // scroll to end
              }
            }
            
            function SignatureForm(preview) {
            
              // Member variables
              var wgssSTU; //netscape plugin.
              var m_protocolHelper;
              var m_tablet;
              var m_capability;
              var m_information;
              var m_inkThreshold;
              var m_usingEncryption;
            
              // The isDown flag is used like this:
              // 0 = up
              // +ve = down, pressed on button number
              // -1 = down, inking
              // -2 = down, ignoring
              var m_isDown;
            
              var m_penData; // Array of data being stored. This can be subsequently used as desired. 
              var m_penTimeData;  // Array of pen data for use with pads which support penDataTimeCountSequence
              var m_btns; // The array of buttons that we are emulating.
              var m_bitmap; // This bitmap that we display on the screen.
              var m_encodingMode; // How we send the bitmap to the device.
              var m_bitmapData; // This is the flattened data of the bitmap that we send to the device.
              var m_penDataOptionMode;  // The pen data option mode flag - basic or with time and sequence counts
            
              // Detect the browser.
              var useActiveX;
              try {
                var test = new ActiveXObject("WacomGSS.STU.UsbDevices");
                // If the above hasn't thrown, browser is IE and components are installed
                useActiveX = true;
              }
              catch (ex) {
                // Browser isn't IE or components are not installed, either way we can't use ActiveX
                useActiveX = false;
              }
            
            
              var modalBackground;
              var formDiv;
              var canvas;
              var ctx;
              var canvasImage;
            
              
            
              function Rectangle(x, y, width, height) {
                this.x = x;
                this.y = y;
                this.width = width;
                this.height = height;
            
                this.Contains = function (pt) {
                  if (((pt.x >= this.x) && (pt.x <= (this.x + this.width))) &&
                    ((pt.y >= this.y) && (pt.y <= (this.y + this.height)))) {
                    return true;
                  } else {
                    return false;
                  }
                }
              }
            
              // In order to simulate buttons, we have our own Button class that stores the bounds and event handler.
              // Using an array of these makes it easy to add or remove buttons as desired.
              //  delegate void ButtonClick();
              function Button() {
                this.Bounds; // in Screen coordinates
                this.Text;
                this.Click;
              };
            
              function Point(x, y) {
                this.x = x;
                this.y = y;
              }
            
              // Create an object maintaining the compatibility beetween browsers.
              function createObject(objectName) {
                var object;
                if (useActiveX) {
                  object = new ActiveXObject(objectName);
                } else {
                  if (!wgssSTU) {
                    wgssSTU = document.getElementById("wgssSTU");
                  }
                  object = wgssSTU.createObject(objectName);
            
                }
            
                return object;
              }
            
              function tabletToScreen(penData) {
                // Screen means LCD screen of the tablet.
                return new Point(penData.x * m_capability.screenWidth / m_capability.tabletMaxX, penData.y * m_capability.screenHeight / m_capability.tabletMaxY);
              }
            
              function createModalWindow(width, height) {
            
                modalBackground = document.createElement('div');
                modalBackground.id = "modal-background";
                modalBackground.className = "active";
                modalBackground.style.width = window.innerWidth;
                modalBackground.style.height = window.innerHeight;
                document.getElementsByTagName('body')[0].appendChild(modalBackground);
            
                formDiv = document.createElement('div');
                formDiv.id = "signatureWindow";
                formDiv.className = "active";
                formDiv.style.top = (window.innerHeight / 2) - (height / 2) + "px";
                formDiv.style.left = (window.innerWidth / 2) - (width / 2) + "px";
                formDiv.style.width = width + "px";
                formDiv.style.height = height + "px";
                document.getElementsByTagName('body')[0].appendChild(formDiv);
            
                canvas = document.createElement("canvas");
                canvas.height = formDiv.offsetHeight;
                canvas.width = formDiv.offsetWidth;
                formDiv.appendChild(canvas);
            
                if (canvas.addEventListener) {
                  canvas.addEventListener("click", onCanvasClick, false);
                } else if (canvas.attachEvent) {
                  canvas.attachEvent("onClick", onCanvasClick);
                } else {
                  canvas["onClick"] = onCanvasClick;
                }
              }
            
              function stringToByteArray(imageString) {
                if (imageString.indexOf("data:image/") != 0)
                  return null;
            
                var base64Position = imageString.indexOf("base64");
                if (base64Position == -1)
                  return null;
            
                var imageData = imageString.substring(base64Position + 7);
            
                // window.atob is only available in mozilla browsers and IE 10 and above.
                // if you want to use IE 9 there are differents library
                // for doing the same functionality.
                var raw;
                if (window.atob) {
                  raw = window.atob(imageData);
                } else {
                  //if there is an exception the browser does not support the atob function
                  raw = decode64(imageData);
                }
            
                var rawLength = raw.length;
                var imageArray = new Array(rawLength);
            
                for (i = 0; i < rawLength; i++) {
                  imageArray[i] = raw.charCodeAt(i);
                }
            
                var js = new ActiveXObject("WacomGSS.STU.JScript");
                return js.toVBArray(imageArray);
              }
            
              
              // Connect to the first device
              this.connect = function (sharedAccess) {
            
                //alert("Connecting...");
                var usbDevices = createObject("WacomGSS.STU.UsbDevices");
                
                if (usbDevices.Count > 0) {
            
                var currentPenDataOptionMode;
                  m_penDataOptionMode = -1;
                
                  //alert("Connecting to tablet");
                  m_penData = new Array();
                  m_penTimeData = new Array();
                
                  m_tablet = createObject("WacomGSS.STU.Tablet");
            
                  // A more sophisticated applications should cycle for a few times as the connection may only be
                  // temporarily unavailable for a second or so. 
                  // For example, if a background process such as Wacom STU Display
                  // is running, this periodically updates a slideshow of images to the device.
            
            
                  if (typeof(encryptionHandler) != "undefined")
                  {
                    if (useActiveX) {
                      var js = new ActiveXObject("WacomGSS.STU.JScript");
                      m_tablet.encryptionHandler  = js.toTabletEncryptionHandler(encryptionHandler());
                      m_tablet.encryptionHandler2 = js.toTabletEncryptionHandler2(encryptionHandler2());
                    }
                  }
            
                  m_protocolHelper = createObject("WacomGSS.STU.ProtocolHelper");
            
                  var usbDevice = usbDevices.Item(0);
                
                if( !sharedAccess )
                    var ec = m_tablet.usbConnect(usbDevice, true);
                  else
                    var ec = m_tablet.usbConnect(usbDevice, false); // shared USB access mode selected
            
                  if (ec.value == 0) {
                    m_capability = m_tablet.getCapability();
                    m_information = m_tablet.getInformation();
                    m_inkThreshold = m_tablet.getInkThreshold();
                    m_usingEncryption = false;
            
                //alert("Calculating pen option mode");
                  // Find out if the pad supports the pen data option mode (the 300 doesn't)
                    currentPenDataOptionMode = getPenDataOptionMode();
            
                    // Set up the tablet to return time stamp with the pen data or just basic data
                    setPenDataOptionMode(currentPenDataOptionMode);
                print("Checking for encryption support");
                    if (m_tablet.isSupported(0x50) ||     // v2 encryption
                        m_protocolHelper.supportsEncryption_DHprime(m_tablet.getDHprime())) // v1 encryption
                  {
                        m_usingEncryption = true;
                  print("Using encryption");
                }
                else
                    print("Encryption not supported");	 
            
                  } else {
                    alert(ec.message);
                    return;
                  }
                  // Create the signature window.
                  createModalWindow(m_capability.screenWidth, m_capability.screenHeight);
            
                  m_btns = new Array(3);
                  m_btns[0] = new Button();
                  m_btns[1] = new Button();
                  m_btns[2] = new Button();
            
                  if (usbDevice.idProduct != enumProductId.STU_300) {
                    // Place the buttons across the bottom of the screen.
                    var w2 = m_capability.screenWidth / 3;
                    var w3 = m_capability.screenWidth / 3;
                    var w1 = m_capability.screenWidth - w2 - w3;
                    var y = m_capability.screenHeight * 6 / 7;
                    var h = m_capability.screenHeight - y;
            
                    m_btns[0].Bounds = new Rectangle(0, y, w1, h);
                    m_btns[1].Bounds = new Rectangle(w1, y, w2, h);
                    m_btns[2].Bounds = new Rectangle(w1 + w2, y, w3, h);
                  } else {
                    // The STU-300 is very shallow, so it is better to utilise
                    // the buttons to the side of the display instead.
            
                    var x = m_capability.screenWidth * 3 / 4;
                    var w = m_capability.screenWidth - x;
            
                    var h2 = m_capability.screenHeight / 3;
                    var h3 = m_capability.screenHeight / 3;
                    var h1 = m_capability.screenHeight - h2 - h3;
            
                    m_btns[0].Bounds = new Rectangle(x, 0, w, h1);
                    m_btns[1].Bounds = new Rectangle(x, h1, w, h2);
                    m_btns[2].Bounds = new Rectangle(x, h1 + h2, w, h3);
                  }
            
                  m_btns[0].Text = "OK";
                  m_btns[1].Text = "Clear";
                  m_btns[2].Text = "Cancel";
                  m_btns[0].Click = btnOk_Click;
                  m_btns[1].Click = btnClear_Click;
                  m_btns[2].Click = btnCancel_Click;
            
                  var encodingFlag = m_protocolHelper.simulateEncodingFlag(m_tablet.getProductId(), m_capability.encodingFlag);
                  // Disable color if the bulk driver isn't installed (supportsWrite())
                  if ((encodingFlag & enumEncodingFlag.EncodingFlag_24bit) != 0)
                  {
                    m_encodingMode = m_tablet.supportsWrite() ? enumEncodingMode.EncodingMode_24bit_Bulk : enumEncodingMode.EncodingMode_24bit; 
                  }
                  else if ((encodingFlag & enumEncodingFlag.EncodingFlag_16bit) != 0)
                  {
                    m_encodingMode = m_tablet.supportsWrite() ? enumEncodingMode.EncodingMode_16bit_Bulk : enumEncodingMode.EncodingMode_16bit; 
                  }
                  else
                  {
                    // assumes 1bit is available
                    m_encodingMode = enumEncodingMode.EncodingMode_1bit; 
                  }
                  var useColor = false;
                  if((m_encodingMode & (enumEncodingMode.EncodingMode_16bit_Bulk | enumEncodingMode.EncodingMode_24bit_Bulk)) != 0)
                    useColor = true;
            
                  // This application uses the same bitmap for both the screen and client (window).
            
                  ctx = canvas.getContext("2d");
            
                  ctx.lineWidth = 1;
                  ctx.strokeStyle = 'black';
                  ctx.font = "30px Arial";
            
                  ctx.fillStyle = "white";
                  ctx.fillRect(0, 0, canvas.width, canvas.height);
            
                  // Draw the buttons
                  for (var i = 0; i < m_btns.length; ++i) {
                    if (useColor) {
                      ctx.fillStyle = "lightgrey";
                      ctx.fillRect(m_btns[i].Bounds.x, m_btns[i].Bounds.y, m_btns[i].Bounds.width, m_btns[i].Bounds.height);
                    }
            
                    ctx.fillStyle = "black";
                    ctx.rect(m_btns[i].Bounds.x, m_btns[i].Bounds.y, m_btns[i].Bounds.width, m_btns[i].Bounds.height);
                    var xPos = m_btns[i].Bounds.x + ((m_btns[i].Bounds.width / 2) - (ctx.measureText(m_btns[i].Text).width / 2));
                    var yOffset;
                    if (usbDevice.idProduct == enumProductId.STU_300)
                      yOffset = 28;
                    else if (usbDevice.idProduct == enumProductId.STU_430)
                      yOffset = 26;
                    else
                      yOffset = 40;
                    ctx.fillText(m_btns[i].Text, xPos, m_btns[i].Bounds.y + yOffset);
                  }
                
                if (m_usingEncryption)
                {
                // If encryption is enabled on the tablet then add a padlock
                ctx.fillStyle = "black";
            
                switch (usbDevice.idProduct)
                {
                    case enumProductId.STU_300:
                        ctx.fillText("\uD83D\uDD12", 5, 20);
                      break;
                    case enumProductId.STU_430:
                        ctx.fillText("\uD83D\uDD12", 5, 30);
                      break;
                    case enumProductId.STU_500:
                        ctx.fillText("\uD83D\uDD12", 10, 40);
                      break;
                    case enumProductId.STU_520:
                      ctx.fillText("\uD83D\uDD12", 20, 50);
                      break;
                    case enumProductId.STU_530:
                      ctx.fillText("\uD83D\uDD12", 20, 50);
                      break;
                    case enumProductId.STU_540:
                      ctx.fillText("\uD83D\uDD12", 20, 50);
                      break;
                }
                }
                
                  ctx.stroke();
            
                  // Now the bitmap has been created, it needs to be converted to device-native
                  // format.
                
                  canvasImage = canvas.toDataURL("image/jpeg");

                  var imageData = stringToByteArray(canvasImage);
                  m_bitmapData = m_protocolHelper.resizeAndFlatten(imageData, 0, 0, 0, 0, m_capability.screenWidth, m_capability.screenHeight, m_encodingMode, 1, false, 0);
            
                  // Add the delagate that receives pen data and error.
                  if (useActiveX) {
                if (m_penDataOptionMode == enumPenDataOptionMode.PenDataOptionMode_TimeCountSequence)
                {
                        eval("function m_tablet::onPenDataTimeCountSequence(data) {return onPenDataTimeCountSequence(data);}");
                        eval("function m_tablet::onPenDataTimeCountSequenceEncrypted(data) {return onPenDataTimeCountSequenceEncrypted(data);}");
                        eval("function m_tablet::onGetReportException(exception) {return onGetReportException(exception);}");
                }
                else
                {
                    eval("function m_tablet::onPenData(data) {return onPenData(data);}");
                        eval("function m_tablet::onPenDataEncrypted(data) {return onPenDataEncrypted(data);}");
                        eval("function m_tablet::onGetReportException(exception) {return onGetReportException(exception);}");
                }
                  } else {
                    m_tablet.onPenData = onPenData;
                    m_tablet.onPenDataEncrypted = onPenDataEncrypted;
                    m_tablet.onGetReportException = onGetReportException;
                  }
            
                  // Initialize the screen
                  clearScreen();
            
                  try
                  {
                    if (m_usingEncryption)
                    {
                      m_tablet.startCapture(0xc0ffee);
                    }
                  }
                  catch (e)
                  {
                    m_usingEncryption = false;
                  }
                  // Enable the pen data on the screen (if not already)
                  m_tablet.setInkingMode(0x01);
                
                } else {
                  alert("There is no tablet present");
                }
              }
            
              function getPenDataOptionMode()
              {
                  var penDataOptionMode;
            
                  try
                  {
                      penDataOptionMode = m_tablet.getPenDataOptionMode();
                  }
                  catch (optionModeException)
                  {
                      penDataOptionMode = -1;
                  }
                  return penDataOptionMode;
              }
              
              function setPenDataOptionMode(currentPenDataOptionMode)
              {
                  // If the current option mode is TimeCount then this is a 520 so we must reset the mode
                  // to basic data only as there is no handler for TimeCount
            
                  switch (currentPenDataOptionMode)
                  {
                      case -1:
                          // THis must be the 300 which doesn't support getPenDataOptionMode at all so only basic data
                          m_penDataOptionMode = enumPenDataOptionMode.PenDataOptionMode_None;
                          break;
            
                      case enumPenDataOptionMode.PenDataOptionMode_None:
                          // If the current option mode is "none" then it could be any pad so try setting the full option
                          // and if it fails or ends up as TimeCount then set it to none
                          try
                          {
                              m_tablet.setPenDataOptionMode(enumPenDataOptionMode.PenDataOptionMode_TimeCountSequence);
                              m_penDataOptionMode = m_tablet.getPenDataOptionMode();
                              if (m_penDataOptionMode == enumPenDataOptionMode.PenDataOptionMode_TimeCount)
                              {
                                  m_tablet.setPenDataOptionMode(enumPenDataOptionMode.PenDataOptionMode_None);
                                  m_penDataOptionMode = enumPenDataOptionMode.PenDataOptionMode_None;
                              }
                              else
                              {
                                  m_penDataOptionMode = enumPenDataOptionMode.PenDataOptionMode_TimeCountSequence;
                              }
                          }
                          catch (ex)
                          {
                              // THis shouldn't happen but just in case...
                              m_penDataOptionMode = enumPenDataOptionMode.PenDataOptionMode_None;
                          }
                          break;
            
                      case enumPenDataOptionMode.PenDataOptionMode_TimeCount:
                          m_tablet.setPenDataOptionMode(enumPenDataOptionMode.PenDataOptionMode_None);
                          m_penDataOptionMode = enumPenDataOptionMode.PenDataOptionMode_None;
                          break;
            
                      case enumPenDataOptionMode.PenDataOptionMode_TimeCountSequence:
                          // If the current mode is timecountsequence then leave it at that
                          m_penDataOptionMode = currentPenDataOptionMode;
                          break;
                  }       
            
                  switch (m_penDataOptionMode)
                  {
                      case enumPenDataOptionMode.PenDataOptionMode_None:
                          m_penData = new Array();
                          print("None");
                          break;
                      case enumPenDataOptionMode.PenDataOptionMode_TimeCount:
                          m_penData = new Array();
                          print("Time count");
                          break;
                      case enumPenDataOptionMode.PenDataOptionMode_SequenceNumber:
                          m_penData = new Array();
                          print("Seq number");
                          break;
                      case enumPenDataOptionMode.PenDataOptionMode_TimeCountSequence:
                          m_penTimeData = new Array();
                          print("Time count + seq");
                          break;
                      default:
                          m_penData = new Array();
                          break;
                  }
              }
            
              
              function clearScreen() {
                // note: There is no need to clear the tablet screen prior to writing an image.
                m_tablet.writeImage(m_encodingMode, m_bitmapData);
            
              if (m_penDataOptionMode == enumPenDataOptionMode.PenDataOptionMode_TimeCountSequence)
                {
                    m_penTimeData = new Array();
              }
                else
                {
                    m_penData = new Array();
                }  
              
                m_isDown = 0;
              
                // repaint the background image on the screen.
                var image = new Image();
                image.onload = function () 
              {
                  ctx.drawImage(image, 0, 0);
                }
                  image.src = canvasImage;
              }
            
              function onPenDataEncrypted(penData) { // Process incoming pen data
                //print("Encrypted pen data");
                onPenData(penData.penData1);
                onPenData(penData.penData2);
              }
            
              function onPenDataTimeCountSequenceEncrypted(penData) { // Process incoming pen data
                //print("Encrypted pen time data");
                onPenDataTimeCountSequence(penData);
                //onPenDataTimeCountSequence(penData.penData2);
              }
              
              function onPenData(penData) { // Process incoming pen data
                if (!penData.rdy)
                  return;
            
                console.log("Checking pen point in onPenData");
              
                var pt = tabletToScreen(penData);
            
                var btn = 0; // will be +ve if the pen is over a button.
                for (var i = 0; i < m_btns.length; ++i) {
                  if (m_btns[i].Bounds.Contains(pt)) {
                    btn = i + 1;
                    break;
                  }
                }
            
                if (m_isDown == 0)
                {
                  var isDown = (penData.pressure > m_inkThreshold.onPressureMark);
            
                  if (isDown)
                  {
                    // transition to down
                    if (btn > 0) 
                    {
                      // We have put the pen down on a button.
                      // Track the pen without inking on the client.
            
                      m_isDown = btn;
                    }
                    else
                    {
                      // We have put the pen down somewhere else.
                      // Treat it as part of the signature.
            
                      m_isDown = -1;
                    }
                  }
            
                  if (m_isDown == -1)
                    m_penData.push(penData);
                }
                else
                {
                  var isDown = !(penData.pressure <= m_inkThreshold.offPressureMark);
              
                  // draw
                  if (m_isDown == -1) 
                  {
                    // Draw a line from the previous down point to this down point.
                    // This is the simplist thing you can do; a more sophisticated program
                    // can perform higher quality rendering than this!
            
                    var prev = tabletToScreen(m_penData[m_penData.length - 1]);
            
                    ctx.beginPath();
                    ctx.moveTo(prev.x, prev.y);
                    ctx.lineTo(pt.x, pt.y);
                    ctx.closePath();
                    ctx.stroke();
            
                    m_penData.push(penData);
                  }
                  
                  if (!isDown)
                  {
                    // transition to up
                    if (btn > 0) {
                      // The pen is over a button
            
                      if (btn == m_isDown) {
                        // The pen was pressed down over the same button as is was lifted now. 
                        // Consider that as a click!
                        m_btns[btn-1].Click();
                      }
                    }
                    m_isDown = 0;
                  }
                }
              }
              
              function onPenDataTimeCountSequence(penTimeData) { // Process incoming pen data
                if (!penTimeData.rdy)
                  return;
              
            
                var pt = tabletToScreen(penTimeData);
            
                var btn = 0; // will be +ve if the pen is over a button.
                for (var i = 0; i < m_btns.length; ++i) {
                  if (m_btns[i].Bounds.Contains(pt)) {
                    btn = i + 1;
                    break;
                  }
                }
            
                if (m_isDown == 0)
                {
                  var isDown = (penTimeData.pressure > m_inkThreshold.onPressureMark);
            
                  if (isDown)
                  {
                    // transition to down
                    if (btn > 0) 
                    {
                      // We have put the pen down on a button.
                      // Track the pen without inking on the client.
            
                      m_isDown = btn;
                    }
                    else
                    {
                      // We have put the pen down somewhere else.
                      // Treat it as part of the signature.
            
                      m_isDown = -1;
                    }
                  }
            
                  if (m_isDown == -1)
                    m_penTimeData.push(penTimeData);
                }
                else
                {
                  var isDown = !(penTimeData.pressure <= m_inkThreshold.offPressureMark);
              
                  // draw
                  if (m_isDown == -1) 
                  {
                    // Draw a line from the previous down point to this down point.
                    // This is the simplist thing you can do; a more sophisticated program
                    // can perform higher quality rendering than this!
            
                    var prev = tabletToScreen(m_penTimeData[m_penTimeData.length - 1]);
            
                    ctx.beginPath();
                    ctx.moveTo(prev.x, prev.y);
                    ctx.lineTo(pt.x, pt.y);
                    ctx.closePath();
                    ctx.stroke();
            
                    m_penTimeData.push(penTimeData);
                  }
                  
                  if (!isDown)
                  {
                    // transition to up
                    if (btn > 0) {
                      // The pen is over a button
            
                      if (btn == m_isDown) {
                        // The pen was pressed down over the same button as is was lifted now. 
                        // Consider that as a click!
                        m_btns[btn-1].Click();
                      }
                    }
                    m_isDown = 0;
                  }
                }
              }
              
              // Capture any report exception.
              function onGetReportException(exception) {
                try {
                  exception.getException();
                } catch (e) {
                  alert(e);
                }
              }
            
              // Generate the signature image
              function generateImage(penData) {
            
                var saveImageCanvas = document.createElement("canvas");
                saveImageCanvas.width = canvas.width;
                saveImageCanvas.height = canvas.height;
            
                var ctx = saveImageCanvas.getContext("2d");
                ctx.lineWidth = 3;
                ctx.strokeStyle = 'black';
                ctx.font = "30px Arial";
            
                ctx.fillStyle = "white";
                ctx.fillRect(0, 0, canvas.width, canvas.height);
            
              //alert("Length of penData is " + penData.length);
              
                if (penData.length > 1)
                {
                  ctx.beginPath();
                  var isDown = false;
                  var prev;
            
                  for (var i = 0; i < penData.length; i++) {
                    // Draw a line from the previous down point to this down point.
                    // This is the simplist thing you can do; a more sophisticated program
                    // can perform higher quality rendering than this!
            
                    if (!isDown)
                    {
                      if (penData[i].pressure > m_inkThreshold.onPressureMark)
                      {
                        isDown = true;
                        prev = tabletToScreen(penData[i]);
                        ctx.moveTo(prev.x, prev.y);
                      }
                    }
                    else 
                    {
                      var pd = tabletToScreen(penData[i]);
                      ctx.lineTo(pd.x, pd.y);
                      prev = pd;
            
                      if (penData[i].pressure <= m_inkThreshold.offPressureMark)
                      {
                        ctx.stroke();
                        isDown = false;
                      }
                    }
                  }
                }
              
                if (isDown)
                  ctx.stroke();
            
                //EVR Image file
                preview.src = saveImageCanvas.toDataURL();

                
                document.getElementById('imgData').innerHTML = saveImageCanvas.toDataURL();



                
              }
            
              function close() {
                document.getElementsByTagName('body')[0].removeChild(modalBackground);
                document.getElementsByTagName('body')[0].removeChild(formDiv);
            
                // Ensure that you correctly disconnect from the tablet, otherwise you are 
                // likely to get errors when wanting to connect a second time.
                if (m_tablet != null) {
                  m_tablet.setInkingMode(0x00);
                  m_tablet.setClearScreen();
                  m_tablet.disconnect();
                }
              }
            
              function btnOk_Click() {
                // You probably want to add additional processing here.
              
              if (m_penDataOptionMode == enumPenDataOptionMode.PenDataOptionMode_TimeCountSequence)
              {
                    generateImage(m_penTimeData);
              }
              else
              {
                generateImage(m_penData);
              }
                setTimeout(function(){close();}, 1);
              }
            
              function btnCancel_Click() {
                // You probably want to add additional processing here.
                setTimeout(function(){close();}, 1);
              }
            
              function btnClear_Click() {
                // You probably want to add additional processing here.
              
              if (m_penDataOptionMode == enumPenDataOptionMode.PenDataOptionMode_TimeCountSequence)
              {
                  if (m_penTimeData.length > 0) 
                  {
                      clearScreen();
                    }
              }
              else
              {
                    if (m_penData.length > 0) 
                  {
                      clearScreen();
                    }
              }
              }
            
              function onCanvasClick(event) {
                // Enable the mouse to click on the simulated buttons that we have displayed.
            
                // Note that this can add some tricky logic into processing pen data
                // if the pen was down at the time of this click, especially if the pen was logically
                // also 'pressing' a button! This demo however ignores any that.
            
                var posX = event.pageX - formDiv.offsetLeft;
                var posY = event.pageY - formDiv.offsetTop;
            
                for (var i = 0; i < m_btns.length; i++) {
                  if (m_btns[i].Bounds.Contains(new Point(posX, posY))) {
                    m_btns[i].Click();
                    break;
                  }
                }
              }
            
              // Only necesary for IE9
              function decode64(input) {
            
                var keyStr = "ABCDEFGHIJKLMNOP" +
                              "QRSTUVWXYZabcdef" +
                              "ghijklmnopqrstuv" +
                              "wxyz0123456789+/" +
                              "=";
            
                var output = "";
                var chr1, chr2, chr3 = "";
                var enc1, enc2, enc3, enc4 = "";
                var i = 0;
            
                // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
                var base64test = /[^A-Za-z0-9\+\/\=]/g;
            
                if (base64test.exec(input)) {
                  alert("There were invalid base64 characters in the input text.\n" +
                        "Valid base64 characters are A-Z, a-z, 0-9, '+', '/',and '='\n" +
                        "Expect errors in decoding.");
                }
            
                input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
            
                do {
                  enc1 = keyStr.indexOf(input.charAt(i++));
                  enc2 = keyStr.indexOf(input.charAt(i++));
                  enc3 = keyStr.indexOf(input.charAt(i++));
                  enc4 = keyStr.indexOf(input.charAt(i++));
            
                  chr1 = (enc1 << 2) | (enc2 >> 4);
                  chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                  chr3 = ((enc3 & 3) << 6) | enc4;
            
                  output = output + String.fromCharCode(chr1);
            
                  if (enc3 != 64) {
                    output = output + String.fromCharCode(chr2);
                  }
            
                  if (enc4 != 64) {
                    output = output + String.fromCharCode(chr3);
                  }
            
                  chr1 = chr2 = chr3 = "";
                  enc1 = enc2 = enc3 = enc4 = "";
            
                } while (i < input.length);
            
                return unescape(output);
              
                function checkConnection(){
            
                }
            
              }
            
            }
            