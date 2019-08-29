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
                    <h1 class="h3 mb-0 text-gray-800">Forex Prospect Leads</h1>
                    <a href="{{route('lead.new')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Lead</a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4" id="lead_div" style="display:none;">
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
                        <tfoot>
                          <tr>
                              <th>Company Name</th>
                            <th>Phone Number</th>
                            <th>Telephone Number</th>
                            <th>Contact Person</th>
                            <th>URL Website</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          @foreach($leads as $lead)
                          <tr>
                            <td>{{$lead->company_name}}</td>
                            <td>{{$lead->phone_number}}</td>
                            <td>{{$lead->telephone_number}}</td>
                            <td>{{$lead->contact_person}}</td>
                            <td>{{$lead->website}}</td>
                            <td><button class="btn btn-primary btn-user btn-block" onclick="showCallDiv('{{$lead}}')">Call</button></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div><!--datatables-->

                <form  action="{{route('lead.store')}}" method="post">
                <!-- Calling Div -->
                <div class="card shadow mb-4" id="call_div" >
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Making a call</h6>
                  </div>
                  
                  <div class="row" >
                    <div class="col-lg-5 offset-1">
                          <br/>                        
                          @csrf
                          <div class="form-group">
                              <input type="text" readonly name='company_name' class="form-control form-control-user" id="leadCompanyName" aria-describedby="companyNameHelp" placeholder="Company Name">
                          </div>

                          <div class="form-group">
                              <input type="text" readonly name='phone_number' class="form-control form-control-user" id="leadPhoneNumber" aria-describedby="phoneNUmberHelp" placeholder="Cellular Number">
                          </div>

                          <div class="form-group">
                              <input type="text" readonly name='telephone_number' class="form-control form-control-user" id="leadTelephoneNumber" aria-describedby="telephoneNumberHelp" placeholder="Telephone Number">
                          </div>
                          <div class="form-group">
                              <input type="text"  name='telephone_number' class="form-control form-control-user" id="leadTelephoneNumber" aria-describedby="telephoneNumberHelp" placeholder="Telephone Number">
                          </div>
                            
                          <input type="hidden" name='status' value="Called" class="form-control form-control-user" id="leadStatus" aria-describedby="statusHelp" placeholder="Status">
                        
                     </div>
                    <div class="col-lg-5">
                        <br/>
                        <textarea name="call_summary" class="form-control" rows=7 cols=10 placeholder="Type here the summary of the call"></textarea>
                    </div>
                  </div><!--row-->
                </div>


                <div class="card shadow mb-4" id="calloutcome_div" >
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Outcome of the Call</h6>
                  </div>

                  <div class="row" >
                    <div class="col-lg-5 offset-1">

                        <br/>
                         <select name="status" id="call_status" class='form-control'>
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
                                <input type="text" name='contact_meeting' class="form-control form-control-user" id="leadContactMeeting" aria-describedby="contactMeetingHelp" placeholder="Name of the person to meet">
                            </div>

                            <div class="form-group">
                                <input type="text" name='appointment_address' class="form-control form-control-user" id="leadAddress" aria-describedby="addressHelp" placeholder="Address of the meet up">
                            </div>

                            <div class="form-group">
                                <input type="text" name='appointment_remarks' class="form-control form-control-user" id="leadRemark" aria-describedby="remarksHelp" placeholder="Remarks">
                            </div>

                        </div>
                        <button class="btn btn-primary btn-user btn-block" >
                                Submit
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
    console.log(lead);
    var lead = JSON.parse(lead);
    document.getElementById('leadCompanyName').value = lead.company_name;
    document.getElementById('leadTelephoneNumber').value = lead.telephone_number;
    document.getElementById('leadPhoneNumber').value = lead.phone_number;
    $('#call_div').show();
    $('#lead_div').hide();
  }

  $('#call_status').change(function(){
    var outcome = $('#call_status').val();

    switch(outcome){
      case "Appointment":
          $('#appointment_div').show();
          $('#reminder_div').show();
      break;

      default:
          $('#appointment_div').hide();
          $('#reminder_div').hide();
      break;  
      
    }
  });

  </script>