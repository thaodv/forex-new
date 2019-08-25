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
                    <h1 class="h3 mb-0 text-gray-800">Create Forex User</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-md-8 offset-2">
                        <form-create-forex-user></form-create-forex-user>
                        <!-- <form action="{{route('forex.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name='employee_id' class="form-control form-control-user" id="userEmployeeId" aria-describedby="employeeIdHelp" placeholder="Employee ID">
                        </div>

                        <div class="form-group">
                            <input type="text" name='first_name' class="form-control form-control-user" id="userFirstName" aria-describedby="firstNameHelp" placeholder="First Name">
                        </div>

                        <div class="form-group">
                            <input type="text" name='last_name' class="form-control form-control-user" id="userLastName" aria-describedby="lastNameHelp" placeholder="Last Name">
                        </div>

                        <div class="form-group">
                            <input type="text" name='department' class="form-control form-control-user" id="userDepartment" aria-describedby="departmentHelp" placeholder="Department">
                        </div>

                        <div class="form-group">
                            <input type="text" name='user_type' class="form-control form-control-user" id="userType" aria-describedby="userTypelHelp" placeholder="User Type">
                        </div>

                        <div class="form-group">
                            <input type="email" name='email' class="form-control form-control-user" id="userEmail" aria-describedby="emailHelp" placeholder="Email Address">
                        </div> 
                                <input type="hidden" name='password' value="12345" class="form-control form-control-user" id="userPassword" aria-describedby="passwordHelp" placeholder="Password">
                                <input type="hidden" name='is_logged_in' value="false" class="form-control form-control-user" id="useris_logged_in" aria-describedby="isLoggedInHelp" placeholder="Is Logged In">
                        <button class="btn btn-primary btn-user btn-block" >
                            Submit
                        </button>
                        </form> -->
                    </div>
                </div><!-- end of content row -->

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
