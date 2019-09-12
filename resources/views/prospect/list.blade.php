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
                            <th>Client Name</th>
                            <th>Location</th>
                            <th>Industry</th>
                            <th>Contact Person</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Source Lead</th>
                            <th>Appointment Date</th>
                            <th>Outcome of Call</th>
                            <th>Follow Up Activity</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                         
                        <tbody>
                          @foreach($prospects as $prospect)
                          <tr>
                            <td>{{$prospect->client_name}}</td>
                            <td>{{$prospect->location}}</td>
                            <td>{{$prospect->industry}}</td>
                            <td>{{$prospect->contact_person}}</td>
                            <td>{{$prospect->contact_number}}</td>
                            <td>{{$prospect->email}}</td>
                            <td>{{$prospect->source_lead}}</td>
                            <td>{{$prospect->appointment_date}}</td>
                            <td>{{$prospect->outcome_of_call}}</td>
                            <td>{{$prospect->follow_up_activity}}</td>
                            <td>@if(empty($prospect->outcome_of_call))
                                <button class="btn btn-primary btn-user btn-block" onclick="showCallDiv('{{$prospect}}')">Call</button>
                                @elseif($prospect->outcome_of_call=="Unanswered")
                                <button class="btn btn-warning btn-user btn-block" onclick="showCallDiv('{{$prospect}}')">Call Again</button>
                                @elseif($prospect->outcome_of_call=="Appointment")
                                <button class="btn btn-success btn-user btn-block" onclick="showAppointment('{{$prospect}}')">Meetup Details</button>
                                @else
                                <p class="btn btn-danger btn-user btn-block" onclick="showCallDiv('{{$prospect}}')">{{$prospect->outcome_of_call}}</p>
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
                         <option value="">Select New Status of the Lead</option>
                          <option value="Appointment">For Appointment</option>
                          <option value="Uninterested">Not Interested</option>
                          <option value="Unanswered">No Answer</option>
                        </select>
                        <br/>

                         
                        <div id="appointment_div" style="display:none;" >
                                <div class="form-group">
                                    <input type="text" name='appointment_date' class="form-control form-control-user" id="appointment_date" aria-describedby="appointmentDateHelp" placeholder="Appointment Date">
                                </div>
                            </div>
                        <button id="btnSubmit"  class="btn btn-primary btn-user btn-block" >
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

  function showCallDiv(prospect){
    var prospect = JSON.parse(prospect);
    document.getElementById('prospectClientName').value = prospect.client_name;
    document.getElementById('prospectClientContactNumber').value = prospect.contact_number;
    document.getElementById('prospectClientContactPerson').value = prospect.contact_person;
    document.getElementById('prospectId').value = prospect.id;

    $('#call_div').show();
    $('#lead_div').hide();
    $('#calloutcome_div').show();
  }

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

  function showAppointment(prospect){
    var prospect = JSON.parse(prospect);    
    var details = "Appointment Date: "+prospect.appointment_date+"\n"+"Contact Person: "+prospect.contact_person;
    alert(details);
  }

  </script>