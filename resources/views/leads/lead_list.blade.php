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

               
                <!-- DataTales Example -->
                <div class="card shadow mb-4" id="lead_div" >
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Prospect Leads</h6>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Company Name</th>
                            <th>Phone Number</th>
                            <th>Telephone Number</th>
                            <th>Contact Person</th>
                            <th>URL Website</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                         
                        <tbody>
                          @foreach($leads as $lead)
                          <tr>
                            <td>{{$lead->company_name}}</td>
                            <td>{{$lead->phone_number}}</td>
                            <td>{{$lead->telephone_number}}</td>
                            <td>{{$lead->contact_person}}</td>
                            <td>{{$lead->website}}</td>
                            <td>@if(empty($lead->call_status))
                                <button class="btn btn-primary btn-user btn-block" onclick="showCallDiv('{{$lead}}')">Call</button>
                                @elseif($lead->call_status=="Unanswered")
                                <button class="btn btn-warning btn-user btn-block" onclick="showCallDiv('{{$lead}}')">Call Again</button>
                                @elseif($lead->call_status=="Appointment")
                                <button class="btn btn-success btn-user btn-block" onclick="showAppointment('{{$lead}}')">For Appointment</button>
                                @else
                                <p class="btn btn-danger btn-user btn-block">{{$lead->call_status}}</p>
                                @endif
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
                    <h6 class="m-0 font-weight-bold text-primary">Making a call</h6>
                  </div>
                  
                  <div class="row" >
                    <div class="col-lg-4 offset-1">
                          <br/>                        
                          
                          <div class="form-group">
                              <input type="text" readonly name='company_name' class="form-control form-control-user" id="leadCompanyName" aria-describedby="companyNameHelp" placeholder="Company Name">
                          </div>
                    </div>
                    <div class="col-lg-4 offset-1">
                          <br/> 
                          <div class="form-group">
                              <input type="text" readonly name='phone_number' class="form-control form-control-user" id="leadPhoneNumber" aria-describedby="phoneNUmberHelp" placeholder="Cellular Number">
                          </div>
                          </div>
                    <div class="col-lg-4 offset-1">
                          <br/> 
                          <div class="form-group">
                              <input type="text" readonly name='telephone_number' class="form-control form-control-user" id="leadTelephoneNumber" aria-describedby="telephoneNumberHelp" placeholder="Telephone Number">
                          </div>
                    </div>

                    <div class="col-lg-4 offset-1">
                          <br/> 
                          <div class="form-group">
                              <input type="text" readonly name='contact_person' class="form-control form-control-user" id="leadContactPerson" aria-describedby="contactPersonHelp" placeholder="Contact Person">
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
                        <form action="{{route('lead.callsummary')}}" method="post">
                        @csrf
                        <input type="hidden" name='status' value="Called" class="form-control form-control-user" id="leadStatus" aria-describedby="statusHelp" placeholder="Status">
                        <input type="hidden" name='id'  class="form-control form-control-user" id="leadId" aria-describedby="idHelp" placeholder="ID">
                        <br/>
                         <select name="call_status" id="call_status" class='form-control'>
                         <option value="">Select New Status of the Lead</option>
                          <option value="Appointment">For Appointment</option>
                          <option value="Uninterested">Not Interested</option>
                          <option value="Unanswered">No Answer</option>
                        </select>
                        <br/>

                        <div id="appointment_div" style="display:none;">
                            <div class="form-group">
                                <input type="text" name='appointment_date' class="form-control form-control-user" id="leadAppointmentDate" aria-describedby="appointmentDateHelp" placeholder="Appointment Date">
                            </div>

                            <div class="form-group">
                                <input type="text" name='appointment_person' class="form-control form-control-user" id="leadContactMeeting" aria-describedby="contactMeetingHelp" placeholder="Name of the person to meet">
                            </div>

                            <div class="form-group">
                                <input type="text" name='appointment_address' class="form-control form-control-user" id="leadAddress" aria-describedby="addressHelp" placeholder="Address of the meet up">
                            </div>

                            <div class="form-group">
                                <input type="text" name='appointment_remarks' class="form-control form-control-user" id="leadRemarks" aria-describedby="remarksHelp" placeholder="Remarks">
                            </div>
                        </div>
                        <button id="btnSubmit" style="display:none;" class="btn btn-primary btn-user btn-block" >
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

  function showCallDiv(lead){
    var lead = JSON.parse(lead);
    document.getElementById('leadCompanyName').value = lead.company_name;
    document.getElementById('leadTelephoneNumber').value = lead.telephone_number;
    document.getElementById('leadPhoneNumber').value = lead.phone_number;
    document.getElementById('leadContactPerson').value = lead.contact_person;
    document.getElementById('leadId').value = lead.id;

    $('#call_div').show();
    $('#lead_div').hide();
    $('#calloutcome_div').show();
  }

  function showLeadList(){
    $('#call_div').hide();
    $('#lead_div').show();
    $('#calloutcome_div').hide();
  
  }

  $('#call_status').change(function(){
    var outcome = $('#call_status').val();
 
    switch(outcome){
      case "Appointment":
          $('#btnSubmit').show();
          $('#appointment_div').show();
          $('#reminder_div').show();
      break;
      case "":
      $('#btnSubmit').hide();
      break;
      default:
          $('#btnSubmit').show();
          $('#appointment_div').hide();
          $('#reminder_div').hide();
      break;  
      
    }
  });

  function showAppointment(lead){
    var lead = JSON.parse(lead);
    alert(lead.appointment_date);
  }

  </script>