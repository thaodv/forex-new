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

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h1 class="h3 mb-0 text-gray-800">Prospect Leads</h1>
                  <a href="{{route('prospect.new')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Lead</a>
                </div>
               
                <!-- DataTales Example -->
                <div class="card shadow mb-4" id="lead_div" >
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List</h6>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Client Name</th> 
                            <th>Contact Person</th> 
                            <th>Outcome of Call</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                         
                        <tbody>
                          @foreach($prospects as $prospect)
                          <tr>
                            <td>{{$prospect->client_name}}</td> 
                            <td>{{$prospect->contact_person}}</td> 
                            <td>@if($prospect->status == "Called: For Appointment")
                                <button  onclick="executeAction('7',{{$prospect}})" class="btn text-success" >For Appointment</button>
                                @elseif($prospect->status == "Called: Unanswered")
                                <p class="btn text-primary"  >No Answer</p>
                                @elseif($prospect->status == "Called: Uninterested")
                                <p class="btn text-danger"  >Uninterested</p>
                                @else
                                <p class="btn text-primary"  >New</p>
                                @endif
                            </td>
                            <td>
                                <select name="action" id="action" onchange="executeAction(this.value,{{$prospect}})" class="form-control">
                                    <option value=0>Select Action</option>
                                    <option value=1>Call Lead</option>
                                    @if(!empty($prospect->appointment_date))<option value=2>View Appointment Details</option>@endif
                                    <option value=3>On-board Lead</option>
                                    <option value=4>Onboarding Status</option>
                                    <option value=5>Update Details</option>
                                    <option value=6>Delete</option>
                                </select>

                            </td>
                            
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div><!--datatables-->
               
                <!-- Calling Div -->
                <div class="card shadow mb-4" id="call_div" style="display:none;">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lead Details</h6>
                  </div>
                  
                  <div class="row" >
                    <div class="col-lg-4 offset-1">
                          <br/>                        
                          
                          <div class="form-group">
                              <input type="text" readonly name='client_name' class="form-control form-control-user" id="prospectClientName" aria-describedby="companyNameHelp" placeholder="Client Name">
                          </div>
                    </div>
                    <div class="col-lg-4 offset-1">
                          <br/> 
                          <div class="form-group">
                              <input type="text" readonly name='phone_number' class="form-control form-control-user" id="prospectClientContactNumber" aria-describedby="phoneNUmberHelp" placeholder="Contact Number">
                          </div>
                          </div>
                     

                    <div class="col-lg-4 offset-1">
                          <br/> 
                          <div class="form-group">
                              <input type="text" readonly name='contact_person' class="form-control form-control-user" id="prospectClientContactPerson" aria-describedby="contactPersonHelp" placeholder="Contact Person">
                          </div>
                    </div>             
                          
                        
                     
                   
                  </div><!--row-->
                </div>
               
                <div class="card shadow mb-4" id="calloutcome_div" style="display:none;">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Outcome of the Call</h6>
                  </div>

                  <div class="row" >
                    <div class="col-lg-5 offset-1">
                        <form action="{{route('prospect.callsummary')}}" method="post">
                        @csrf
                        <input type="hidden" name='status' value="Called" class="form-control form-control-user" id="leadStatus" aria-describedby="statusHelp" placeholder="Status">
                        <input type="hidden" name='id'  class="form-control form-control-user" id="prospectId" aria-describedby="idHelp" placeholder="ID">
                        <br/>
                         <select name="outcome_of_call" id="outcome_of_call" class='form-control'>
                         <option value="">Select call outcome</option>
                          <option value="For Appointment">For Appointment</option>
                          <option value="Uninterested">Not Interested</option>
                          <option value="Unanswered">No Answer</option>
                        </select>
                        <br/>

                        <div class="form-group" id="appointment_div" style="display:none;">
                            <input type="text" name='appointment_date' class="form-control form-control-user" id="appointment_date" aria-describedby="appointmentDateHelp" placeholder="Appointment Date">
                        </div>
                        <div class="form-group" id="outcome_div" style="display:none;">
                            <textarea  name='outcome_call' class="form-control form-control-user" id="outcome_call" aria-describedby="appointmentDateHelp" placeholder="Type here the outcome of the call."></textarea>
                        </div>
                         
                        <button id="btnSubmit" class="btn btn-primary btn-user btn-block" >
                                Submit
                        </button>
                        </form>
                        <hr/>
                        <button onclick="showLeadList()" class="btn btn-danger btn-user btn-block" >
                                Cancel
                        </button>
                        <br/>
                    </div>

                    <div class="col-lg-5 offset-1" id="reminder_div" style="display:none;">

                        <br/>
                        <p>Things to prepare</p>

                        <ul>
                          <li>Docs</li>
                          <li>Presentation</li>
                          <li>Signature Pad (for instance on-boarding)</li>
                        </ul>
                    </div>
                    
                  </div><!--row-->
                </div>

                <div class="card shadow mb-4" id="appointmentDetails_div" style="display:none;">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Appointment Details</h6>
                    </div>
  
                    <div class="row" >
                      <div class="col-lg-5 offset-1"> 
                          <br/><br/>

                          <table class="table table-bordered" width="100%" cellspacing="0">
                            <tr><td>Client Name</td><td id="clientName"></td></tr>
                            <tr><td>Contact Person</td><td id="contactPerson"></td></tr>
                            <tr><td>Contact Number</td><td id="contactNumber"></td></tr>
                            <tr><td>Appointment Date</td><td id="otherDetails"></td></tr>
                            <tr><td>Notes</td><td id="detailsOfCall"></td></tr>
                          </table>
                          <button id="btnOk" class="btn btn-primary btn-user btn-block" >OK</button><br/>
                          <br/><br/>
                      </div>
  
                      
                    </div><!--row-->
                </div>
            
                 <!-- Update Prospect -->
                 <div class="card shadow mb-4" id="updateLead_div" style="display:none;">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Update Lead</h6>
                    </div>
  
                    <form action="{{route('prospect.update')}}" method="post">
                    <div class="row offset-1">
                          <input type="hidden" name="forex_id" value="{{Session::get('id')}}"/>
                          <input type="hidden" name="prospect_id" id="prospect_id" />
                          @csrf
                          <div class="col-md-5">
                                  <br/><br/>
                              <div class="form-group"> 
                                  <input type="text" name='update_client_name' class="form-control form-control-user" id="update_client_name" aria-describedby="clientNameHelp" placeholder="Client Name">
                              </div>
                          </div>  
                          <div class="col-md-5">
                              <div class="form-group"> 
                                  <br/><br/>
                                  <input type="text" name='update_location' class="form-control form-control-user" id="update_location" aria-describedby="clientNameHelp" placeholder="Location">
                              </div>
                          </div> 
                          <div class="col-md-5">
                              <div class="form-group"> 
                                  <input type="text" name='update_industry' class="form-control form-control-user" id="update_industry" aria-describedby="clientNameHelp" placeholder="Industry">
                              </div>
                          </div> 
                          <div class="col-md-5">
                              <div class="form-group"> 
                                  <input type="text" name='update_contact_person' class="form-control form-control-user" id="update_contact_person" aria-describedby="clientNameHelp" placeholder="Contact Person">
                              </div>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group"> 
                                  <input type="text" name='update_contact_number' class="form-control form-control-user" id="update_contact_number" aria-describedby="clientNameHelp" placeholder="Contact Number">
                              </div>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group"> 
                                  <input type="text" name='update_position' class="form-control form-control-user" id="update_position" aria-describedby="clientNameHelp" placeholder="Position">
                              </div>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group"> 
                                  <input type="text" name='update_email' class="form-control form-control-user" id="update_email" aria-describedby="clientNameHelp" placeholder="Email">
                              </div>
                          </div>
                          <div class="col-md-5">
                              <div class="form-group"> 
                                  <input type="text" name='update_source_lead' class="form-control form-control-user" id="update_source_lead" aria-describedby="clientNameHelp" placeholder="Source of Lead">
                              </div>
                          </div>
                           
                          
                          <div class="col-md-5">
                              <div class="form-group">  
                                      <button type="button" id="btnCancelUpdate" class="btn btn-danger  btn-user btn-block">Cancel</button>
                              </div>
                          </div> 
                          <div class="col-md-5">
                              <div class="form-group"> 
                                      <button type="submit" class="btn btn-primary  btn-user btn-block">Update</button> 
                              </div>
                          </div> 
                      </div>
                      </form>
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
   <!-- Page level plugins -->
  

  @include('layout.footer')
  <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

  <script>

  function executeAction(choice,prospect){
    
    
      switch(choice){
        case "1":
           
          document.getElementById('prospectClientName').value = prospect.client_name;
          document.getElementById('prospectClientContactNumber').value = prospect.contact_number;
          document.getElementById('prospectClientContactPerson').value = prospect.contact_person;
          document.getElementById('prospectId').value = prospect.id;
          $('#call_div').show();
          $('#lead_div').hide();
          $('#calloutcome_div').show();
        break;

        case "2":
        var details = "Appointment Date: "+prospect.appointment_date+"\n"+"Contact Person: "+prospect.contact_person;
        alert(details);
        break;

        case "3":
          var url = "http://forex.test/prospect/onboardprospect/"+prospect.id;
            
          $.ajax({ //Process the form using $.ajax()
              type      : 'GET', //Method type
              url       : url,  
              data      : data, 
              dataType  : 'json',
              success: function(msg) {  
                  location.replace("{{route('prospect.onboard')}}");               
              }
          }); 
          
        break;

        case "4":
          //get onboarding status

        break;

        case "5":
          //update details form

          document.getElementById('prospect_id').value = prospect.id;
          document.getElementById('update_client_name').value = prospect.client_name;
          document.getElementById('update_industry').value = prospect.industry;
          document.getElementById('update_location').value = prospect.location;
          document.getElementById('update_contact_person').value = prospect.contact_person;
          document.getElementById('update_contact_number').value = prospect.contact_number;
          document.getElementById('update_email').value = prospect.email;
          document.getElementById('update_position').value = prospect.position
          document.getElementById('update_source_lead').value = prospect.source_lead;
          $('#updateLead_div').show();
          $('#lead_div').hide();
        break;

        case "6":
         //delete

        var deleteClient = confirm("Would you like to delete "+prospect.client_name+"?");
        if(deleteClient){
             

            var url = "http://forex.test/prospect/delete";

                var data = {
                        prospect_id: prospect.id,
                        _token: '{{csrf_token()}}'
                };    
                $.ajax({ //Process the form using $.ajax()
                    type      : 'POST', //Method type
                    url       : url,  
                    data      : data, 
                    dataType  : 'json',
                    success: function(msg) {  
                        
                          location.reload();

                    }
                }); 
        } 
        break;
        case "7":

        
          var callId = prospect.outcome_of_call;

          var url = "http://forex.test/prospect/call-outcome";

              var data = {
                      call_id: callId,
                      _token: '{{csrf_token()}}'
              };    
              $.ajax({ //Process the form using $.ajax()
                  type      : 'POST', //Method type
                  url       : url,  
                  data      : data, 
                  dataType  : 'json',
                  success: function(msg) {   
                      console.log(msg);     
                      document.getElementById('detailsOfCall').innerHTML = msg.call_outcome;
                      document.getElementById("clientName").innerHTML = prospect.client_name;
                      document.getElementById("contactPerson").innerHTML = prospect.contact_person;
                      document.getElementById("contactNumber").innerHTML = prospect.contact_number; 
                      document.getElementById("otherDetails").innerHTML = msg.other_details;
                      $('#lead_div').hide();
                      $('#appointmentDetails_div').show();
                  }
              }); 
        break;
      }
  }


  $('#btnOk').click(function(){
      $('#lead_div').show();
      $('#appointmentDetails_div').hide();
  })
  

  function showLeadList(){
    $('#call_div').hide();
    $('#lead_div').show();
    $('#calloutcome_div').hide();
  
  }

  $('#outcome_of_call').change(function(){
    var outcome = $('#outcome_of_call').val();
 
    switch(outcome){
      case "Appointment":
          $('#btnSubmit').show();
          $('#appointment_div').show();
          $('#outcome_div').show();
          $('#reminder_div').show();
      break;
      case "Unanswered":
      $('#outcome_div').hide();
      $('#btnSubmit').show();
      break;
      case "": 
      $('#btnSubmit').hide();
      break;
      default:
          $('#btnSubmit').show();
          $('#appointment_div').hide();
          $('#outcome_div').show();
          $('#reminder_div').hide();
      break;  
      
    }
  });

  $('#btnCancelUpdate').click(function(){
      $('#updateLead_div').hide();
      $('#lead_div').show();
  });
 
  </script>