@include('layout.header')

    <link rel="stylesheet" type="text/css" href="{{asset('css/sb-admin-2.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/signature.css')}}" />
    <script type="text/javascript" src="{{asset('js/BigInt.js')}}"></script>
    <!-- <script type="text/javascript" src="{{asset('sjcl.js')}}"></script> -->
    <script type="text/javascript" src="{{asset('js/wacom_encryption.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/wacom.js')}}"></script>
    <script type="text/javascript">
      function initDemo() {
        var signatureForm = new SignatureForm(document.getElementById("signatureImage"));
        signatureForm.connect(chkSharedAccess.checked);
      }
    </script>    

<!-- Page Wrapper -->
<div id="wrapper">

    @include('layout.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            @include('layout.nav')

            <!-- Begin Page Content -->
            <div class="container-fluid" id="app">
              <div class="card shadow mb-4" id="lead_div" >
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Book Order</h6>
                </div>
                <div  id="cisForm">
                  <form action="{{route('client.store')}}" method="post">
                    <br/><br/>
                      <div class="row offset-1"><!-- Content Row -->
                        @csrf
                        <input type="hidden" name="forex_id" value="{{Session::get('id')}}"/>
                        <div class="col-md-8">
                            <div class="form-group">
                              <label>Client Name</label>
                              <input class="form-control" name="name" id="name" type="text"  required="required" data-validation-required-message="Please enter your first name.">
                              <p class="help-block text-danger"></p>
                            </div>
                        </div>
                      </div><!-- end of content row -->
                      <div class="row offset-1"><!-- Content Row -->
                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Bloomberg Value</label>
                              <input class="form-control" readonly name="bloomberg_value" value="52.10"  id="exchange_value" type="tel"  required="required" data-validation-required-message="Please enter exchange value.">
                              <p class="help-block text-danger"></p>
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Offer Value</label>
                              <input class="form-control" name="offer_value"  id="exchange_value" type="tel"  required="required" data-validation-required-message="Please enter exchange value.">
                              <p class="help-block text-danger"></p>
                            </div>
                        </div> 
                      </div><!-- end of content row -->
                      <div class="row offset-1"><!-- Content Row -->
                        <div class="col-md-4">
                            <div class="form-group">
                              <label>USD ($)</label>
                              <input class="form-control" name="from_currency"  id="from_amount" type="text" value="100.00" required="required" data-validation-required-message="Please enter the purpose of transaction">
                              <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <label>PHP (&#8369;) </label>
                              <input class="form-control" readonly name="to_amount"  id="from_currency" type="text" value="" required="required" data-validation-required-message="Please enter the purpose of transaction">
                              <p class="help-block text-danger"></p>
                            </div>
                        </div>
                      </div><!-- end of content row -->
                      <div class="row offset-1"><!-- Content Row -->
                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Fee</label>
                              <input class="form-control" name="fee"  id="fee" type="text"  required="required" data-validation-required-message="Please enter amount.">
                              <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Total</label>
                              <input class="form-control" readonly name="total_amount"  id="total_amount" type="text"  required="required" data-validation-required-message="Please enter amount.">
                              <p class="help-block text-danger"></p>
                            </div>
                        </div>
                           
                      </div><!-- end of content row -->
                      <div class="row offset-1"><!-- Content Row -->
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Bank name</label>
                            <input class="form-control" name="bank_name"  id="bank_name" type="text" required="required" data-validation-required-message="Please enter bank name.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Bank account number</label>
                            <input class="form-control" name="bank_account_number"  id="bank_account_number" type="text" required="required" data-validation-required-message="Please enter bank account number.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                      </div><!-- end of content row -->
                      
                      <div class="row offset-1"><!-- Content Row -->   
                        <div class="col-md-8 text-center">
                            <br/><br/>
                            <div id="success"></div>
                            <button id="submitForm" class="btn btn-primary btn-xl text-uppercase" type="submit">Submit</button>
                            <br/><br/>
                        </div>
                      </div><!-- end of content row -->
                  </form>
                </div>
                
              </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Forex 2019</span>
            </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <script type="text/javascript">
    function initDemo() {
      var signatureForm = new SignatureForm(document.getElementById("signatureImage"));
      signatureForm.connect(chkSharedAccess.checked);
    }
  </script>
  @include('layout.footer')
  <script>

  var trader1Image = "";
  var trader2Image = "";
  var currentSignatory = "";
    function signature(signatory){
        
        switch(signatory){
            case "trader2":
                if($('#trader_2_name').val()!=""){
                    document.getElementById('signatoryName').value = $('#trader_2_name').val();
                    currentSignatory = signatory;
                    initSignature();
                }else{
                    alert("Trader Name is required");
                    cancelSignature();
                }
                break;

            case "trader1":
                if($('#trader_1_name').val()!=""){
                    document.getElementById('signatoryName').value = $('#trader_1_name').val();
                    currentSignatory = signatory;
                    initSignature(signatory);
                }else{
                    alert("Trader Name is required");
                    cancelSignature();
                }
                break;

            case "client":
            document.getElementById('signatoryName').value = $('#client_name').val();
                break;

        }
        
    }
    function initSignature(signatory){
        
        $('#signatureDiv').show();
        document.getElementById('signatureImage').src = "";
        $('#cisForm').hide();
    }
    function cancelSignature(){
        $('#signatureDiv').hide();
        $('#cisForm').show();
    }


    function saveSignature(){
        var url = "http://forex.test/lead/savesignature";

        var data = {
                forex_id: $('#forex_id').val(),
                signatory_name: $('#signatoryName').val(),
                signature: $('#imgData').val(),
                _token: '{{csrf_token()}}'
        };    

            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : url,  
                data      : data, 
                dataType  : 'json',
                success: function(msg) {
                                
                                if(currentSignatory=="trader1"){
                                    trader1Image = msg.signature;
                                    document.getElementById('trader1signature').src = msg.signature;
                                }else{
                                    trader2Image = msg.signature;
                                    document.getElementById('trader2signature').src = msg.signature;
                                }            

                                cancelSignature();
                            }
            });
        }
  </script>
<script type="text/javascript">
    <!--
	
	function GetHash(hash) {
        print("Creating document hash:");
        hash.Clear();
        hash.Type=1; // MD5
        hash.add("elizavel");
        hash.add("rosario");
        print("hash.add: " + "elizave");
        print("hash.add: " + "rosario");
      }
      
      function Capture() {
        try {
          print("Capturing signature...");
          var sigCtl = document.getElementById("sigCtl1");
		  
		  sigCtl.SetProperty("Licence","eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJMTVMiLCJleHAiOjE1NzUzNDQ1MzYsImlhdCI6MTU2NzQ4MjEzNiwicmlnaHRzIjpbIlNJR19TREtfQ09SRSIsIlRPVUNIX1NJR05BVFVSRV9FTkFCTEVEIiwiU0lHQ0FQVFhfQUNDRVNTIiwiU0lHX1NES19JU08iLCJTSUdfU0RLX0VOQ1JZUFRJT04iXSwiZGV2aWNlcyI6W10sInR5cGUiOiJldmFsIiwibGljX25hbWUiOiJXSUxMX1NES19mb3Jfc2lnbmF0dXJlIiwid2Fjb21faWQiOiIzNTFjNWVlMDgzOTE0NWVjYmFhMzgxMWFkMzRiNWVlOCIsImxpY191aWQiOiJkNTJhYWU2MS01ODExLTQyZjUtYmE4Yy0xYTgwZDczOWY4NzQiLCJhcHBzX3dpbmRvd3MiOltdLCJhcHBzX2lvcyI6W10sImFwcHNfYW5kcm9pZCI6W10sIm1hY2hpbmVfaWRzIjpbXX0.UnD61QZQeSvjJplL81_F1D8qD-pzCkmdkZbCalfx2dt3qXKK11W6IyAuGFE2044eL4VnYoqTvmncuOIWR20hJVNKut1lS9MFeZpQlmU0eA6A0jP9LiDUXU1CiGUL4CXfUfTHB_PEY-60XC3nl8dYIjvGIHTKwuImmlXnCTRehZrNOUTP63pAyb1Scl1GWjIUHYsiNixk1YH-EoKz_XeuM2ovzKfItdHFIjs7_5RIpzLJETp5vLOPJbPGdkKiGvTr290KzXrztFsVkh5V0RXXCeTsSoHeCqgJ-5VRA1Xt7-BPodhrpKAvPjqd0sJNugXN2-C73tQgxman4TB2HUOUEQ");
          var hash = new ActiveXObject('Florentis.Hash'); 
          GetHash(hash);
		  
		  var dc = new ActiveXObject("Florentis.DynamicCapture");
		  
           var rc = dc.Capture(sigCtl, "Eliza Vel", "Testing");
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
            print("Signature Information:");
            print("  Signatory Name:   " + sigCtl.Signature.Who);
            print("  Date and time signed:   " + sigCtl.Signature.When);
            print("  Reason of Signing:   " + sigCtl.Signature.Why);
            print("  Digitizer Type:   " + digiType);
            print("  Digitizer Driver:   " + digiDriver);
            print("  Operating System:   " + opSys);
            print("  Network Interface Card:   " + nic);
            document.getElementById('sigDataTrader1').innerHTML = sigCtl.Signature.Who+"\n\n"+
            sigCtl.Signature.Who+"<br/>"+
            sigCtl.Signature.When+"<br/>"+
            sigCtl.Signature.Why+"<br/>"+
            digiType+"<br/>"+
            digiDriver+"<br/>"+
            opSys+"<br/>"+
            nic;

            flags = 0x2000 + 0x80000 + 0x400000; //SigObj.outputBase64 | SigObj.color32BPP | SigObj.encodeData
              b64 = sigCtl.Signature.RenderBitmap("", 300, 150, "image/png", 0.5, 0xff0000, 0xffffff, 0.0, 0.0, flags );
              var imgSrcData = "data:image/png;base64,"+b64;
              document.getElementById("trader1signature").src=imgSrcData;

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
    -->
    </script>