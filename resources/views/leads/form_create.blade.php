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
                        <h6 class="m-0 font-weight-bold text-primary">Create New Lead</h6>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-8 offset-2">
                            <form-create-lead></form-create-lead>

                            <!-- <form  action="{{route('lead.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" name='company_name' class="form-control form-control-user" id="leadCompanyName" aria-describedby="companyNameHelp" placeholder="Company Name">
                            </div>

                            <div class="form-group">
                                <input type="text" name='phone_number' class="form-control form-control-user" id="leadPhoneNumber" aria-describedby="phoneNUmberHelp" placeholder="Cellular Number">
                            </div>

                            <div class="form-group">
                                <input type="text" name='telephone_number' class="form-control form-control-user" id="leadTelephoneNumber" aria-describedby="telephoneNumberHelp" placeholder="Telephone Number">
                            </div>

                            <div class="form-group">
                                <input type="text" name='website' class="form-control form-control-user" id="leadWebsite" aria-describedby="websiteHelp" placeholder="Website URL">
                            </div>

                            <div class="form-group">
                                <input type="email" name='email' class="form-control form-control-user" id="leadEmail" aria-describedby="emailHelp" placeholder="Email Address">
                            </div>

                            <div class="form-group">
                                <input type="text" name='contact_person' class="form-control form-control-user" id="leadContactPerson" aria-describedby="contactPersonHelp" placeholder="Contact Person">
                            </div> 
                                    <input type="hidden" name='status' value="New" class="form-control form-control-user" id="leadStatus" aria-describedby="statusHelp" placeholder="Status">
                            <button class="btn btn-primary btn-user btn-block" >
                                Submit
                            </button>
                            </form> -->
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

  @include('layout.footer')
