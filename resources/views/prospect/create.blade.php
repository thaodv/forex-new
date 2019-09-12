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
                    <h6 class="m-0 font-weight-bold text-primary">Create New Prospect</h6>
                  </div>

                    <form action="{{route('prospect.store')}}" method="post">
                    <div class="row offset-1">
                        
                        
                        
                        <input type="hidden" name="forex_id" value="{{Session::get('id')}}"/>
                        @csrf

                        <div class="col-md-10">
                                <br/><br/>
                            <div class="form-group"> 
                                <input type="text" name='client_name' class="form-control form-control-user" id="client_name" aria-describedby="clientNameHelp" placeholder="Client Name">
                            </div>
                        </div> 

                        <div class="col-md-10">
                            <div class="form-group"> 
                                <input type="text" name='location' class="form-control form-control-user" id="location" aria-describedby="clientNameHelp" placeholder="Location">
                            </div>
                        </div> 
                        <div class="col-md-10">
                            <div class="form-group"> 
                                <input type="text" name='industry' class="form-control form-control-user" id="industry" aria-describedby="clientNameHelp" placeholder="Industry">
                            </div>
                        </div> 
                        <div class="col-md-10">
                            <div class="form-group"> 
                                <input type="text" name='contact_person' class="form-control form-control-user" id="contact_person" aria-describedby="clientNameHelp" placeholder="Contact Person">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group"> 
                                <input type="text" name='contact_number' class="form-control form-control-user" id="contact_number" aria-describedby="clientNameHelp" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group"> 
                                <input type="text" name='position' class="form-control form-control-user" id="position" aria-describedby="clientNameHelp" placeholder="Position">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group"> 
                                <input type="text" name='email' class="form-control form-control-user" id="email" aria-describedby="clientNameHelp" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group"> 
                                <input type="text" name='source_lead' class="form-control form-control-user" id="source_lead" aria-describedby="clientNameHelp" placeholder="Source of Lead">
                            </div>
                        </div>
                        {{-- <div class="col-md-10">
                            <div class="form-group"> 
                                <input type="text" name='appointment_date' class="form-control form-control-user" id="appointment_date" aria-describedby="clientNameHelp" placeholder="Date of Appointment">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group"> 
                                <input type="text" name='outcome_of_call' class="form-control form-control-user" id="outcome_of_call" aria-describedby="clientNameHelp" placeholder="Outcome of Call">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group"> 
                                <input type="text" name='follow_up_activity' class="form-control form-control-user" id="follow_up_activity" aria-describedby="clientNameHelp" placeholder="Follow Up Activity">
                            </div>
                        </div> --}}
                        
                        <div class="col-md-10">
                            <div class="form-group"> 
                                    <button type="submit" class="btn btn-primary  btn-user btn-block">Create</button>
                            </div>
                        </div> 
                        
                        
                    </div>
                    </form>



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

   