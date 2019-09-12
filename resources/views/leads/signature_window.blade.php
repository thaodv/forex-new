<!doctype html>
<html>
  <head>
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>


  </head>
  <body>
 <input type="hidden" name="_token" value="{{csrf_token()}}">
<p>Signatory Name</p>
<input type="text" id="trader_name"/><br/>
<p>FAO ID</p>
<input type="text" name="signatureId" id="forex_id"/><br/>
<p>Signatory Level</p>
<select name="signature" id="signatory_level">
<option value="001">First Trader</option>
<option value="002">Second Trader</option>
<option value="003">Client</option>
</select><br/>
<input type="hidden" id="signature_id" value="">
 <button onclick="Capture()">Sign</button>
    </form>
 <p id='sigDataTrader1'></p> 
<img id='imgSignature' width="300"  height="200"  />
<object id="sigCtl1" style="width:60mm;height:35mm;display:none;"  type="application/x-florentis-signature"></object>
<textarea style="display:none;"  id="txtDisplay"></textarea>
  </body></html>
<script type="text/javascript">
     
	
	function GetHash(hash) {
        hash.Clear();
        hash.Type=1; // MD5
        hash.add(document.getElementById('trader_name').value);
      }
      
    //    function Captured(){
    //     var url = "http://forex.test/client/savesignature";
    //     var sigId = "51688410861";
    //     var imgSrcData = "024uiojsef9u029r-2ifweifjseifjs";
        
    //     var data = {
    //             signatureId : sigId,
    //             signature: imgSrcData,
    //             _token: '{{csrf_token()}}'
    //     };    

    //         $.ajax({ //Process the form using $.ajax()
    //             type      : 'POST', //Method type
    //             url       : url,  
    //             data      : data, 
    //             dataType  : 'json',
    //             success: function(msg) {
    //                     document.getElementById('sigDataTrader1').innerHTML =
    //     "Signature ID: "+msg+"<br/>";
        
    //                 }
    // });
    //    }
      function Capture() {
        try {
          print("Capturing signature...");
          var sigCtl = document.getElementById("sigCtl1");
		  
		  sigCtl.SetProperty("Licence","eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJMTVMiLCJleHAiOjE1NzUzNDQ1MzYsImlhdCI6MTU2NzQ4MjEzNiwicmlnaHRzIjpbIlNJR19TREtfQ09SRSIsIlRPVUNIX1NJR05BVFVSRV9FTkFCTEVEIiwiU0lHQ0FQVFhfQUNDRVNTIiwiU0lHX1NES19JU08iLCJTSUdfU0RLX0VOQ1JZUFRJT04iXSwiZGV2aWNlcyI6W10sInR5cGUiOiJldmFsIiwibGljX25hbWUiOiJXSUxMX1NES19mb3Jfc2lnbmF0dXJlIiwid2Fjb21faWQiOiIzNTFjNWVlMDgzOTE0NWVjYmFhMzgxMWFkMzRiNWVlOCIsImxpY191aWQiOiJkNTJhYWU2MS01ODExLTQyZjUtYmE4Yy0xYTgwZDczOWY4NzQiLCJhcHBzX3dpbmRvd3MiOltdLCJhcHBzX2lvcyI6W10sImFwcHNfYW5kcm9pZCI6W10sIm1hY2hpbmVfaWRzIjpbXX0.UnD61QZQeSvjJplL81_F1D8qD-pzCkmdkZbCalfx2dt3qXKK11W6IyAuGFE2044eL4VnYoqTvmncuOIWR20hJVNKut1lS9MFeZpQlmU0eA6A0jP9LiDUXU1CiGUL4CXfUfTHB_PEY-60XC3nl8dYIjvGIHTKwuImmlXnCTRehZrNOUTP63pAyb1Scl1GWjIUHYsiNixk1YH-EoKz_XeuM2ovzKfItdHFIjs7_5RIpzLJETp5vLOPJbPGdkKiGvTr290KzXrztFsVkh5V0RXXCeTsSoHeCqgJ-5VRA1Xt7-BPodhrpKAvPjqd0sJNugXN2-C73tQgxman4TB2HUOUEQ");
          var hash = new ActiveXObject('Florentis.Hash'); 
          GetHash(hash);
		  
		  var dc = new ActiveXObject("Florentis.DynamicCapture");
		  var signatory ="Consignee: "+ document.getElementById('trader_name').value;
           


           var rc = dc.Capture(sigCtl, signatory, "Client On-boarding for PETNET WUBS");
          if(rc != 0 )
            print("Capture returned: " + rc);
          switch( rc ) {
            case 0: // CaptureOK
              print("Signature captured successfully");
              DisplaySignatureDetails();
              break;
            case 1: // CaptureCancel
              print("Signature capture cancelled");
              break;
            case 100: // CapturePadError
              print("No capture service available");
              break;
            case 101: // CaptureError
              print("Tablet Error");
              break;
            case 102: // CaptureIntegrityKeyInvalid
              print("The integrity key parameter is invalid (obsolete)");
              break;
            case 103: // CaptureNotLicensed
              print("No valid Signature Capture licence found");
              break;
            case 200: // CaptureAbort
              print("Error - unable to parse document contents");
              break;
            default: 
              print("Capture Error " + rc);
              break;
          }
        }
        catch(ex) {
          Exception("Capture() error: " + ex.message);
        }
      }

      function DisplaySignatureDetails() {
        try {
          var sigCtl = document.getElementById("sigCtl1");
		  sigCtl.SetProperty("Licence","eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJMTVMiLCJleHAiOjE1NzUzNDQ1MzYsImlhdCI6MTU2NzQ4MjEzNiwicmlnaHRzIjpbIlNJR19TREtfQ09SRSIsIlRPVUNIX1NJR05BVFVSRV9FTkFCTEVEIiwiU0lHQ0FQVFhfQUNDRVNTIiwiU0lHX1NES19JU08iLCJTSUdfU0RLX0VOQ1JZUFRJT04iXSwiZGV2aWNlcyI6W10sInR5cGUiOiJldmFsIiwibGljX25hbWUiOiJXSUxMX1NES19mb3Jfc2lnbmF0dXJlIiwid2Fjb21faWQiOiIzNTFjNWVlMDgzOTE0NWVjYmFhMzgxMWFkMzRiNWVlOCIsImxpY191aWQiOiJkNTJhYWU2MS01ODExLTQyZjUtYmE4Yy0xYTgwZDczOWY4NzQiLCJhcHBzX3dpbmRvd3MiOltdLCJhcHBzX2lvcyI6W10sImFwcHNfYW5kcm9pZCI6W10sIm1hY2hpbmVfaWRzIjpbXX0.UnD61QZQeSvjJplL81_F1D8qD-pzCkmdkZbCalfx2dt3qXKK11W6IyAuGFE2044eL4VnYoqTvmncuOIWR20hJVNKut1lS9MFeZpQlmU0eA6A0jP9LiDUXU1CiGUL4CXfUfTHB_PEY-60XC3nl8dYIjvGIHTKwuImmlXnCTRehZrNOUTP63pAyb1Scl1GWjIUHYsiNixk1YH-EoKz_XeuM2ovzKfItdHFIjs7_5RIpzLJETp5vLOPJbPGdkKiGvTr290KzXrztFsVkh5V0RXXCeTsSoHeCqgJ-5VRA1Xt7-BPodhrpKAvPjqd0sJNugXN2-C73tQgxman4TB2HUOUEQ");
          if (sigCtl.Signature.IsCaptured) {
			var objSig = new ActiveXObject("Florentis.SigObj");	
			objSig = sigCtl.Signature;
			var digiType = objSig.AdditionalData(26);
			var digiDriver = objSig.AdditionalData(27);
			var opSys = objSig.AdditionalData(28);
			var nic = objSig.AdditionalData(29);
           
            var sigId = document.getElementById('forex_id').value+document.getElementById('signatory_level').value+Date.now();
            document.getElementById('signature_id').value=sigId;
            
            

            var sigDetails = 
            sigCtl.Signature.Who+"|"+
            "Date and Time: "+sigCtl.Signature.When+"|"+
            "Purpose of Signature: "+sigCtl.Signature.Why+"|"+
            "Digital Type: "+digiType+"|"+
            "Digital Driver: "+digiDriver+"|"+
            "Operating System: "+opSys+"|"+
            "Network Interface Card: "+nic;

              flags = 0x2000 + 0x80000 + 0x400000; //SigObj.outputBase64 | SigObj.color32BPP | SigObj.encodeData
              b64 = sigCtl.Signature.RenderBitmap("", 300, 150, "image/png", 0.5, 0xff0000, 0xffffff, 0.0, 0.0, flags );
              var imgSrcData = "data:image/png;base64,"+b64;
              document.getElementById("imgSignature").src=imgSrcData;
              $('#imgSignature').show();


              var url = "http://forex.test/client/savesignature";

                var data = {
                        signatureId : sigId,
                        signature: imgSrcData,
                        _token: '{{csrf_token()}}'
                };    

                    $.ajax({ //Process the form using $.ajax()
                        type      : 'POST', //Method type
                        url       : url,  
                        data      : data, 
                        dataType  : 'json',
                        success: function(msg) {
                            document.getElementById('sigDataTrader1').innerHTML =
            "Kindly copy and paste the Signature ID on the CIS Form:<br/> "+msg.signature+"<br/>";
             
                                    }
                    });

          }
		  else
		  {
		     print("No signature captured");
		  }
        }
        catch(ex) {
          Exception("DisplaySignatureDetails() error: " + ex.message);
        }
      }

      function AboutBox() {
        try {
          var sigCtl = document.getElementById("sigCtl1");
		  sigCtl.SetProperty("Licence","eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJMTVMiLCJleHAiOjE1NzUzNDQ1MzYsImlhdCI6MTU2NzQ4MjEzNiwicmlnaHRzIjpbIlNJR19TREtfQ09SRSIsIlRPVUNIX1NJR05BVFVSRV9FTkFCTEVEIiwiU0lHQ0FQVFhfQUNDRVNTIiwiU0lHX1NES19JU08iLCJTSUdfU0RLX0VOQ1JZUFRJT04iXSwiZGV2aWNlcyI6W10sInR5cGUiOiJldmFsIiwibGljX25hbWUiOiJXSUxMX1NES19mb3Jfc2lnbmF0dXJlIiwid2Fjb21faWQiOiIzNTFjNWVlMDgzOTE0NWVjYmFhMzgxMWFkMzRiNWVlOCIsImxpY191aWQiOiJkNTJhYWU2MS01ODExLTQyZjUtYmE4Yy0xYTgwZDczOWY4NzQiLCJhcHBzX3dpbmRvd3MiOltdLCJhcHBzX2lvcyI6W10sImFwcHNfYW5kcm9pZCI6W10sIm1hY2hpbmVfaWRzIjpbXX0.UnD61QZQeSvjJplL81_F1D8qD-pzCkmdkZbCalfx2dt3qXKK11W6IyAuGFE2044eL4VnYoqTvmncuOIWR20hJVNKut1lS9MFeZpQlmU0eA6A0jP9LiDUXU1CiGUL4CXfUfTHB_PEY-60XC3nl8dYIjvGIHTKwuImmlXnCTRehZrNOUTP63pAyb1Scl1GWjIUHYsiNixk1YH-EoKz_XeuM2ovzKfItdHFIjs7_5RIpzLJETp5vLOPJbPGdkKiGvTr290KzXrztFsVkh5V0RXXCeTsSoHeCqgJ-5VRA1Xt7-BPodhrpKAvPjqd0sJNugXN2-C73tQgxman4TB2HUOUEQ");
          sigCtl.AboutBox();
        }
        catch(ex) {
          Exception("About() error: " + ex.message);
        }
      }

      function Exception(txt) {
        print("Exception: " + txt);
      }
      function print(txt) {
        var txtDisplay = document.getElementById("txtDisplay");
        if(txt == "CLEAR" )
          txtDisplay.value = "";
        else {
          txtDisplay.value += txt + "\n";
          txtDisplay.scrollTop = txtDisplay.scrollHeight; // scroll to end
        }
      }

      function OnLoad() {
        try {
		  if( !("ActiveXObject" in window) ) {
            document.getElementById("not_ie_warning").style.display="block";
  		    return;
          }
          print("CLEAR");
          var sigCtl = document.getElementById("sigCtl1");
		  sigCtl.SetProperty("Licence","eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJMTVMiLCJleHAiOjE1NzUzNDQ1MzYsImlhdCI6MTU2NzQ4MjEzNiwicmlnaHRzIjpbIlNJR19TREtfQ09SRSIsIlRPVUNIX1NJR05BVFVSRV9FTkFCTEVEIiwiU0lHQ0FQVFhfQUNDRVNTIiwiU0lHX1NES19JU08iLCJTSUdfU0RLX0VOQ1JZUFRJT04iXSwiZGV2aWNlcyI6W10sInR5cGUiOiJldmFsIiwibGljX25hbWUiOiJXSUxMX1NES19mb3Jfc2lnbmF0dXJlIiwid2Fjb21faWQiOiIzNTFjNWVlMDgzOTE0NWVjYmFhMzgxMWFkMzRiNWVlOCIsImxpY191aWQiOiJkNTJhYWU2MS01ODExLTQyZjUtYmE4Yy0xYTgwZDczOWY4NzQiLCJhcHBzX3dpbmRvd3MiOltdLCJhcHBzX2lvcyI6W10sImFwcHNfYW5kcm9pZCI6W10sIm1hY2hpbmVfaWRzIjpbXX0.UnD61QZQeSvjJplL81_F1D8qD-pzCkmdkZbCalfx2dt3qXKK11W6IyAuGFE2044eL4VnYoqTvmncuOIWR20hJVNKut1lS9MFeZpQlmU0eA6A0jP9LiDUXU1CiGUL4CXfUfTHB_PEY-60XC3nl8dYIjvGIHTKwuImmlXnCTRehZrNOUTP63pAyb1Scl1GWjIUHYsiNixk1YH-EoKz_XeuM2ovzKfItdHFIjs7_5RIpzLJETp5vLOPJbPGdkKiGvTr290KzXrztFsVkh5V0RXXCeTsSoHeCqgJ-5VRA1Xt7-BPodhrpKAvPjqd0sJNugXN2-C73tQgxman4TB2HUOUEQ");
          sigCtl.BackStyle = 1;
          sigCtl.DisplayMode=0; // fit signature to control
          print("Checking components...");
          var sigcapt = new ActiveXObject('Florentis.DynamicCapture');  // force 'can't create object' error if components not yet installed
          var lic = new ActiveXObject("Wacom.Signature.Licence");
		   

          print("DLL: Licence.dll   v" + lic.GetProperty("Component_FileVersion"));
          print("DLL: flSigCOM.dll  v" +   sigCtl.GetProperty("Component_FileVersion"));
          print("DLL: flSigCapt.dll v" + sigcapt.GetProperty("Component_FileVersion"));
          print("Test application ready.");
          print("Press 'Start' to capture a signature.");
        }
        catch(ex) {
          Exception("OnLoad() error: " + ex.message);
        }
      }
    
    </script>