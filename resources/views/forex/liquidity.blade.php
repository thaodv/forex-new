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
                    <h1 class="h3 mb-0 text-gray-800">Set Liquidity</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-md-8 offset-2">
                       <!-- <form-create-forex-user></form-create-forex-user>-->
                         <form action="{{route('forex.saveliquidity')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name='beginning_balance' class="form-control form-control-user" id="beginning_balance" aria-describedby="employeeIdHelp" placeholder="Beginning Balance">
                        </div>

                        <div class="form-group">
                            <input type="text" name='weighted_average' class="form-control form-control-user" id="weighted_average" aria-describedby="firstNameHelp" placeholder="Weighted Average">
                        </div>

                        <div class="form-group">
                            <input type="text" name='average_margin' class="form-control form-control-user" id="average_margin" aria-describedby="lastNameHelp" placeholder="Average Margin">
                        </div>
                        <button class="btn btn-primary btn-user btn-block" >
                            Submit
                        </button>
                        </form> 
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
