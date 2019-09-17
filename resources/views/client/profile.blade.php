@include('layout.header')

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
                        <h6 class="m-0 font-weight-bold text-primary">Client's Profile</h6>
                    </div>


                    <div class="row offset-1">
                    
                    @foreach($data as $clientDetails)

                    @if($clientDetails->cis_form=="ind")
                        <div class="form-group col-md-12">
                            <br/><h6 class="m-0 font-weight-bold text-primary">Individual</h6>
                        </div>
                        <div class="form-group col-md-6">
                            Name: <strong>{{$clientDetails->first_name}} {{$clientDetails->last_name}}</strong> | <span id="clientStatus" class="m-0 font-weight-bold text-primary">{{$clientDetails->status}}</span>
                            <br/>Purpose of Transaction: <strong>{{$clientDetails->purpose_of_txn}}</strong>
                            <br/>Occupation: <strong>{{$clientDetails->occupation}}</strong>
                            <br/>Issued ID Number: <strong>{{$clientDetails->issued_id_number}}</strong>
                            <br/>Source of Fund: <strong>{{$clientDetails->fund_source}}</strong>
                            <br/>Bank Name: <strong>{{$clientDetails->bank_name}}</strong>
                            <br/>Bank Account Number: <strong>{{$clientDetails->bank_account_number}}</strong>
                        </div>
                        <div class="form-group col-md-6">
                            Civil Status: <strong>{{$clientDetails->civil_status}}</strong>
                            <br/>Nationality: <strong>{{$clientDetails->nationality}}</strong>
                            <br/>Birth Date: <strong>{{$clientDetails->birthdate}}</strong>
                            <br/>Birth Place: <strong>{{$clientDetails->birthplace}}</strong>
                            <br/>Contact Number: <strong>{{$clientDetails->contact_number}}</strong>
                            <br/>Email Address: <strong>{{$clientDetails->email_address}}</strong>
                            <br/>Website URL: <strong>{{$clientDetails->website}}</strong>
                        </div>

                        <div class="form-group col-md-12">
                            Present Address: <strong>{{$clientDetails->present_address}}</strong>
                            <br/>Permanent Address: <strong>{{$clientDetails->permanent_address}}</strong>
                        </div>

                        <div class="form-group col-md-12">
                            <br/><h6 class="m-0 font-weight-bold text-primary">Authorized Traders</h6>
                        </div>
                        <div class="form-group col-md-6">
                            Name: <strong>{{$clientDetails->auth_1_trader_name}}</strong>
                            <br/>Position: <strong>{{$clientDetails->auth_1_trader_position}}</strong>
                            <br/>Nationality: <strong>{{$clientDetails->auth_1_trader_nationality}}</strong>
                            <br/>Contact Number: <strong>{{$clientDetails->auth_1_trader_contact_number}}</strong>
                            <br/>Signature:<br/> 
                        <img src="http://localhost/forex/storage/app/{{$clientDetails->auth_1_trader_signature}}.png" width="300" height="200"/>
                        </div>
                        <div class="form-group col-md-6">
                            Name: <strong>{{$clientDetails->auth_2_trader_name}}</strong>
                            <br/>Position: <strong>{{$clientDetails->auth_2_trader_position}}</strong>
                            <br/>Nationality: <strong>{{$clientDetails->auth_2_trader_nationality}}</strong>
                            <br/>Contact Number: <strong>{{$clientDetails->auth_2_trader_contact_number}}</strong>
                            <br/>Signature:<br/>
                            <img src="http://localhost/forex/storage/app/{{$clientDetails->auth_2_trader_signature}}.png" width="300" height="200"/>
                        </div>

                        <div class="form-group col-md-12">
                            <br/><h6 class="m-0 font-weight-bold text-primary">Client's Signature</h6> 
                            Image of Picture<br/>
                        </div>
                        <div class="form-group col-md-12">
                        <br/><h6 class="m-0 font-weight-bold text-primary">Supporting Documents</h6>
                            Governemnt ID<br/>
                            Company ID<br/>
                            Proof of Billing 
                        </div>
                        <div class="form-group col-md-12">
                            <br/><h6 class="m-0 font-weight-bold text-primary">Checklist</h6>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" name="list_gis" value="gis"> GIS
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" name="list_cis" value="cis"> CIS
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" name="list_articles_of_inc" value="articles_of_inc"> Articles of Inc
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" name="valid_ids" value="valid_ids"> Valid IDs
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" name="by_laws" value="by_laws"> By Laws
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" name="list_cis" value="cis"> Notarized Sec. Cert
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" name="list_articles_of_inc" value="articles_of_inc"> Source of Funds
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" name="valid_ids" value="valid_ids"> AMLA Cert
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" name="by_laws" value="by_laws"> Proof Of Billing
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" name="valid_ids" value="valid_ids"> DTI Cert
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" name="by_laws" value="by_laws"> Business Permit
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" name="by_laws" value="by_laws"> BSP Cert
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" name="by_laws" value="by_laws"> DPA Consent
                        </div>


                         
                    @endif 
                        @if($clientDetails->status == "New")
                        
                        <div class="form-group col-md-12">
                            <br/><h6 class="m-0 font-weight-bold text-primary">Risk Tool</h6>
                        </div>
                        <div class="form-group col-md-9">
                            <label>Date of Scoring</label>
                        <input type="text" class="form-control-user form-control" readonly name="scoring" value="{{date('d/m/Y')}}"/>
                        </div>
                        <div class="form-group col-md-9">
                            <label>Location</label>
                            <select class="form-control-user form-control" name="location"><option value="">Philippines</option></select>         
                        </div>
                        <div class="form-group col-md-9">
                            <label>Origin of Headquarters or place of incorporation</label>
                            <select class="form-control-user form-control" name="headquarter"><option value="">Philippines</option></select>                       
                        </div>
                        <div class="form-group col-md-9">
                            <label>Method of Acquisition</label>
                            <select class="form-control-user form-control" name="acquisition"><option value="">Referral</option></select>                       
                        </div>
                        <div class="form-group col-md-9">
                            <label>Organization Type</label>
                            <select class="form-control-user form-control" name="organization_type"><option value="">Individual</option></select>                       
                        </div>
                        <div class="form-group col-md-9">
                            <label>Date Customer Founded / Incorporated</label>
                            <input type="text" class="form-control-user form-control" name="headquarter" value="16 September 1992"/>
                        </div>
                        <div class="form-group col-md-9">
                            <label>Date Began as Customer</label>
                            <input type="text" class="form-control-user form-control" name="headquarter" value="16 September 2012"/>
                        </div>
                        <div class="form-group col-md-9">
                            <label>Industry</label>
                            <select class="form-control-user form-control" name="industry"><option value="">Individual</option></select>                       
                        </div>

                        <div class="form-group  col-md-9">
                                <label>Mandatory High Risk Categories</label>
                                <select class="form-control-user form-control" name="risk_category"><option value="">Not Applicable</option></select>
                        </div>

                        <div class="form-group col-md-12">
                            <h6 class="m-0 font-weight-bold text-primary">Weighted Risk Rating</h6>
                            <h6 class="m-0 font-weight-bold text-danger">7.7</h6>
                            <h6 class="m-0 font-weight-bold text-danger">High Risk: Please re-accredit this client annually</h6>
                            <h6 class="m-0 font-weight-bold ">Next Accreditation is due: <span class="text-danger">September 2020</span></h6>

                        </div>
                        












                        <div class="form-group col-md-12" id="actionBtns">
                            <button class="btn btn-success" onclick="action(1,{{$clientDetails->id}})">Approve</button> 
                            <button class="btn btn-warning" onclick="action(2,{{$clientDetails->id}})">Incomplete</button>
                            <button class="btn btn-danger" onclick="action(3,{{$clientDetails->id}})">Decline</button>
                        </div>
                        <hr/>

                        @endif
                        <div class="form-group col-md-8" style="display: none;" id="divReason">
                            <h6 class="m-0 font-weight-bold text-primary">Details</h6><br/>
                            <textarea name="reason" id="reason" class="form-control" rows=10 cols=25 placeholder="Please indicate the reason of rejection or marking the client's onboarding incomplete"></textarea><br/>
                            <button class="btn btn-primary" onclick="saveReason()">Submit</button><br/><br/>
                            <button class="btn btn-danger" onclick="showActionBtns()">Cancel</button><br/>
                        </div>
                    @endforeach
                    

                    
                    
                   
                    
                    
                     

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

    <script>
    var statusAction = "";
    var clientId = "";
        function action(action, id){
            clientId = id;
            switch(action){
                case 1:
                statusAction = "Approved";
                     saveReason();
                break;

                case 2:
                statusAction = "Incomplete";
                    $('#divReason').show();
                    $('#actionBtns').hide();
                break;

                case 3:
                statusAction = "Declined";
                    $('#divReason').show();
                    $('#actionBtns').hide();
                break;
            }


            
        }

        function saveReason(){
            //save to database 

                var url = "http://forex.test/client/update";

                var data = {
                        client_id: clientId,
                        compliance: {{Session::get('id')}},
                        reason: document.getElementById('reason').value,
                        status: statusAction,
                        _token: '{{csrf_token()}}'
                };    
                 
                 console.log(data);
                    $.ajax({ //Process the form using $.ajax()
                        type      : 'POST', //Method type
                        url       : url,  
                        data      : data, 
                        dataType  : 'json',
                        success: function(msg) {   
                            console.log(msg.msg);
                            document.getElementById("clientStatus").innerHTML = statusAction;   

                            location.reload();
                            $('#divReason').hide();                            
                        }
                    }); 
        }
        function showActionBtns(){
            $('#divReason').hide();
            $('#actionBtns').show();
        }
    </script>
  @include('layout.footer')
