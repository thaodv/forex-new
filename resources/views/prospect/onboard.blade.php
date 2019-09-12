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
                    <h6 class="m-0 font-weight-bold text-primary">On Board Prospect Lead</h6>
                </div>
                <div  id="cisForm">
                  <form action="{{route('client.store')}}" method="post">
                    <br/><br/>
                      <div class="row offset-1"><!-- Content Row -->
                        @csrf
                        <div class="col-md-12">
                            <label>Please choose CIS form Type </label>
                            <div class="radio">
                                <label><input type="radio" name="cis_form" value="ind" checked> Individual</label>
                            &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input type="radio" name="cis_form" value="cor" > Corporate</label>
                            </div>
                        </div>
                        <input type="hidden" name="forex_id" value="{{Session::get('id')}}"/>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" name="first_name" id="first_name" type="text"   data-validation-required-message="Please enter your first name.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-3">  
                            <div class="form-group">
                            <label>Middle Name</label>
                            <input class="form-control" name="middle_name" id="middle_name" type="text"   data-validation-required-message="Please enter your middle name.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" name="last_name" id="last_name" type="text"   data-validation-required-message="Please enter your last name.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                      </div><!-- end of content row -->
                      <div class="row offset-1"><!-- Content Row -->
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Purpose of Transaction</label>
                            <input class="form-control" name="purpose_of_txn"  id="purpose_of_txn" type="text"   data-validation-required-message="Please enter the purpose of transaction">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Occupation</label>
                            <input class="form-control" name="occupation"  id="occupation" type="text"   data-validation-required-message="Please enter your occupation.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Issued ID Number</label>
                            <input class="form-control" name="issued_id_number"  id="issued_id_number" type="tel"   data-validation-required-message="Please enter your phone number.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>    
                      </div><!-- end of content row -->
                      <div class="row offset-1"><!-- Content Row --> 
                        <div class="col-md-9">
                            <div class="form-group">
                            <label>Present Address</label>
                            <input class="form-control" name="present_address"  id="present_address" type="tel"   data-validation-required-message="Please enter your present address.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>              
                        <div class="col-md-9">
                            <div class="form-group">
                            <label>Permanent Address</label>
                            <input class="form-control" name="permanent_address"  id="permanent_address" type="text"    data-validation-required-message="Please enter your permanent address.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                      </div><!-- end of content row -->
                      <div class="row offset-1"><!-- Content Row -->
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>Civil Status</label>
                            <input class="form-control" name="civil_status"  id="civil_status" type="text"   data-validation-required-message="Please enter your civil status.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>Nationality</label>
                            <input class="form-control" name="nationality"  id="nationality" type="text"   data-validation-required-message="Please enter your nationality.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>Birth date</label>
                            <input class="form-control" name="birthdate" id="birthdate" type="text"    data-validation-required-message="Please enter your birth date.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Place of birth</label>
                            <input class="form-control" name="birthplace"  id="birthplace" type="text"   data-validation-required-message="Please enter your place of birth.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                      </div><!-- end of content row -->
                      <div class="row offset-1"><!-- Content Row -->
                        <div class="col-md-3  ">
                            <div class="form-group">
                            <label>Source of Fund</label>
                            <input class="form-control" name="fund_source"  id="fund_source" type="text"   data-validation-required-message="Please enter the source of fund.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Bank name</label>
                            <input class="form-control" name="bank_name"  id="bank_name" type="text"  data-validation-required-message="Please enter bank name.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Bank account number</label>
                            <input class="form-control" name="bank_account_number"  id="bank_account_number" type="text"  data-validation-required-message="Please enter bank account number.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                      </div><!-- end of content row -->
                      <div class="row offset-1"><!-- Content Row -->
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Contact number</label>
                            <input class="form-control" name="contact_number"  id="contact_number" type="tel"  data-validation-required-message="Please enter your contact number.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Email address</label>
                            <input class="form-control" name="email_address"  id="email_address" type="text"  data-validation-required-message="Please enter your email address.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Website URL</label>
                            <input class="form-control" name="website"  id="website" type="text"  data-validation-required-message="Please enter your webiste URL.">
                            <p class="help-block text-danger"></p>
                            </div>
                        </div>
                      </div><!-- end of content row -->
                      <div class="row offset-1"><!-- Content Row -->
                        <div class="col-md-9">
                          <h3 class="section-heading ">Authorized Person</h3>
                          <label>The following is a list  of authorized individual/s to transact with PETNET, Inc. for foreign exchange requirements.</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Full name of trader</label>
                              <input class="form-control" name="auth_1_trader_name"  id="auth_1_trader_name" type="text"  data-validation-required-message="Please enter name of trader.">
                              <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                              <label>Position</label>
                              <input class="form-control"  name="auth_1_trader_position" id="auth_1_trader_position" type="text"  data-validation-required-message="Please enter position.">
                              <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                              <label>Nationality</label>
                              <input class="form-control" name="auth_1_trader_nationality"  id="auth_1_trader_nationality" type="text"   data-validation-required-message="Please enter nationality.">
                              <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                              <label>Contact Number</label>
                              <input class="form-control" name="auth_1_trader_contact_number"  id="auth_1_trader_contact_number" type="text"   data-validation-required-message="Please enter contact.">
                              <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group" style="display: none;" id="auth_1_trader_sig_div">
                                <label>Signature ID</label>
                                <input class="form-control" name="auth_1_trader_signature_id"  id="auth_1_trader_signature_id" type="text"   data-validation-required-message="Please enter Signature ID.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                              <button class="btn btn-primary" type="button" id="btnSignatureTrader1"  onclick="signature('trader1')">Signature</button><br/><hr/>
                              <img id='trader1signature' style="display: none;" width="300"  height="200"   />
                            </div>
                            <div class="form-group">
                              <p id="sigDataTrader1"></p>
                            </div>
                          </div>
                        <div class="col-md-4 offset-1">
                            <div class="form-group">
                              <label>Full name of trader</label><br/>
                              <input class="form-control" name="auth_2_trader_name"  id="auth_2_trader_name" type="text"   data-validation-required-message="Please enter name of trader.">
                              <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                              <label>Position</label><br/>
                              <input class="form-control"  name="auth_2_trader_position" id="auth_2_trader_position" type="text"   data-validation-required-message="Please enter position.">
                              <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                              <label>Nationality</label>
                              <input class="form-control"  name="auth_2_trader_nationality" id="auth_2_trader_nationality" type="text"   data-validation-required-message="Please enter nationality.">
                              <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                              <label>Contact Number</label><br/>
                              <input class="form-control" name="auth_2_trader_contact_number" id="auth_2_trader_contact_number" type="text"   data-validation-required-message="Please enter contact.">
                              <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group" style="display: none;" id="auth_2_trader_sig_div">
                                <label>Signature ID</label>
                                <input class="form-control" name="auth_2_trader_signature_id"  id="auth_2_trader_signature_id" type="text"   data-validation-required-message="Please enter Signature ID.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                              <button class="btn btn-primary" name="first_name" type="button"  id="btnSignatureTrader2"   onclick="signature('trader2')">Signature</button><br/><hr/>                        
                              <img id='trader2signature' width="300" style="display:none;"  height="200"   />
                            </div>
                          </div>
                      </div>  <!-- end of content row -->
                      <div class="row offset-1"><!-- Content Row -->
                        <div class="col-md-9">
                            <h3 class="section-heading ">Documents</h3>
                            <label>Please upload the screenshots /photo of the following documents</label>
                        </div>
                      </div>  <!-- end of content row -->
                      <div class="row offset-1"><!-- Content Row -->
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Government ID<br/>(e.g. SSS, TIN, Passport)</label><br/>
                            <a href="" id="btnCertCompany"  type="submit">Upload</a>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Company ID/ DTI/ GIS/<br/>Employment Certificate</label><br/>
                            <a href="" id="btnCertCompany" type="submit">Upload</a>
                          </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Proof of Address <br/>(billing statement)</label><br/>
                            <a href="" id="btnCertCompany"  type="submit">Upload</a>
                            </div>
                        </div>
                      </div>  <!-- end of content row -->
                      <div class="row offset-1"><!-- Content Row -->   
                        <div class="col-md-9 text-center">
                            <br/><br/>
                            <div id="success"></div>
                            <button id="submitForm" class="btn btn-primary btn-xl text-uppercase" type="submit">Submit</button>
                            <br/><br/>
                        </div>
                      </div><!-- end of content row -->
                  </form>
                </div>
                <div class="row offset-1"><!-- Content Row -->
                  <div class="col-md-3" id="signatureDiv" style="display:none;">
                    <p>Signature will be displayed here.</p>
                    <img id="signatureImage" /><br/><br/>
                    <input type="button" class='btn btn-success col-md-12'  id="signButton" value="Start Signing" onClick="javascript:initDemo()"/>

                    <br/><br/>
                    <input type="hidden" class="form-control" id="forex_id" name="forex_id" placeholder="FAO Id"/>
                    <input type="hidden" class="form-control" name="signatory_name" id="signatoryName"  />
                    @csrf
                    <textarea style="display:none;" cols=100 rows=40  name='signature' id="imgData"></textarea><br/>
                    <button onclick="saveSignature()" class='btn btn-primary col-md-12'>Save</button>
                    
                    <hr/>
                    <button onclick="cancelSignature()" class='btn btn-danger col-md-12'>Cancel</button>
                    <p style="display:none;">Use Shared Access: <input type="checkbox" value="true" id="chkSharedAccess" /></p>
                    <!-- <object id="wgssSTU" type="application/x-wgssSTU"></object> -->
                    <object id="sigCtl1" style="width:60mm;height:35mm" 
                        type="application/x-florentis-signature">
                    </object>
                    <textarea style="display:none;"   id="txtDisplay"></textarea>
                  </div>
                </div><!-- end of content row -->
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
        
      if(signatory=="trader1"){
          $('#auth_1_trader_sig_div').show();
          $('#btnSignatureTrader1').hide();
      }else{
          $('#auth_2_trader_sig_div').show();
          $('#btnSignatureTrader2').hide();
      }
      window.open('http://forex.test/signature/signatory');
      
        // switch(signatory){
        //     case "trader2":
        //         if($('#trader_2_name').val()!=""){
        //             document.getElementById('signatoryName').value = $('#trader_2_name').val();
        //             currentSignatory = signatory;
        //             initSignature();
        //         }else{
        //             alert("Trader Name is required");
        //             cancelSignature();
        //         }
        //         break;

        //     case "trader1":
        //         if($('#trader_1_name').val()!=""){
        //             document.getElementById('signatoryName').value = $('#trader_1_name').val();
        //             currentSignatory = signatory;
        //             initSignature(signatory);
        //         }else{
        //             alert("Trader Name is required");
        //             cancelSignature();
        //         }
        //         break;

        //     case "client":
        //     document.getElementById('signatoryName').value = $('#client_name').val();
        //         break;

        // }
        
    }
    function initSignature(signatory){
        
        //open new window

        window.open('http://forex.test/signature/');
        // $('#signatureDiv').show();
        // document.getElementById('signatureImage').src = "";
        // $('#cisForm').hide();
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
     
	
	function GetHash(hash) {
        hash.Clear();
        hash.Type=1; // MD5
        hash.add(document.getElementById('trader_1_name').value);
      }
      
      function Capture(signee) {
        try {
          print("Capturing signature...");
          var sigCtl = document.getElementById("sigCtl1");
		  
		  sigCtl.SetProperty("Licence","eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJMTVMiLCJleHAiOjE1NzUzNDQ1MzYsImlhdCI6MTU2NzQ4MjEzNiwicmlnaHRzIjpbIlNJR19TREtfQ09SRSIsIlRPVUNIX1NJR05BVFVSRV9FTkFCTEVEIiwiU0lHQ0FQVFhfQUNDRVNTIiwiU0lHX1NES19JU08iLCJTSUdfU0RLX0VOQ1JZUFRJT04iXSwiZGV2aWNlcyI6W10sInR5cGUiOiJldmFsIiwibGljX25hbWUiOiJXSUxMX1NES19mb3Jfc2lnbmF0dXJlIiwid2Fjb21faWQiOiIzNTFjNWVlMDgzOTE0NWVjYmFhMzgxMWFkMzRiNWVlOCIsImxpY191aWQiOiJkNTJhYWU2MS01ODExLTQyZjUtYmE4Yy0xYTgwZDczOWY4NzQiLCJhcHBzX3dpbmRvd3MiOltdLCJhcHBzX2lvcyI6W10sImFwcHNfYW5kcm9pZCI6W10sIm1hY2hpbmVfaWRzIjpbXX0.UnD61QZQeSvjJplL81_F1D8qD-pzCkmdkZbCalfx2dt3qXKK11W6IyAuGFE2044eL4VnYoqTvmncuOIWR20hJVNKut1lS9MFeZpQlmU0eA6A0jP9LiDUXU1CiGUL4CXfUfTHB_PEY-60XC3nl8dYIjvGIHTKwuImmlXnCTRehZrNOUTP63pAyb1Scl1GWjIUHYsiNixk1YH-EoKz_XeuM2ovzKfItdHFIjs7_5RIpzLJETp5vLOPJbPGdkKiGvTr290KzXrztFsVkh5V0RXXCeTsSoHeCqgJ-5VRA1Xt7-BPodhrpKAvPjqd0sJNugXN2-C73tQgxman4TB2HUOUEQ");
          var hash = new ActiveXObject('Florentis.Hash'); 
          GetHash(hash);
		  
		  var dc = new ActiveXObject("Florentis.DynamicCapture");
		  var signatory = "";
          switch(signee){

            case 1:
            signatory = document.getElementById('trader_1_name').value;
            break;

            case 2:
            signatory = document.getElementById('trader_2_name').value;
            break;

            case 3:
            signatory = "Client's Name";
            break;
          }


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
      $("#auth_1_trader_signature_id").on("input", function() {
          $('#trader1signature').show();
          var sigId1 = document.getElementById('auth_1_trader_signature_id').value;
           
          document.getElementById('trader1signature').src = "http://localhost/forex/storage/app/"+sigId1+".png";


          // var url = "http://forex.test/client/getsignature";
          // var data = {
          //         signatureId : sigId1,
          //         _token: '{{csrf_token()}}'
          // };    

          //     $.ajax({ //Process the form using $.ajax()
          //         type      : 'POST', //Method type
          //         url       : url,  
          //         data      : data, 
          //         dataType  : 'json',
          //         success: function(msg) {
          //   document.getElementById('trader1signature').src = msg.signature;
          //         }
          //     });
          
      });

      $("#auth_2_trader_signature_id").on("input", function() {
          $('#trader2signature').show();
          var sigId2 = document.getElementById('auth_2_trader_signature_id').value;
           
          var url = "http://forex.test/client/getsignature";
          var data = {
                  signatureId : sigId2,
                  _token: '{{csrf_token()}}'
          };    

              $.ajax({ //Process the form using $.ajax()
                  type      : 'POST', //Method type
                  url       : url,  
                  data      : data, 
                  dataType  : 'json',
                  success: function(msg) {
                    document.getElementById('trader2signature').src = msg.signature;
                  }
              });
          
      });
    </script>