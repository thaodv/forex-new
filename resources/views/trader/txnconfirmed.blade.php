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

                <div class="card shadow mb-4" id="orderform"  >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">FX Transaction Confirmation</h6>
                        </div>


                        <div class="row offset-1"><!-- Content Row -->

                           <div class='col-md-11'>
                                    <br/><br/>
                                <h4 class="text-center"> This is to confirm our FX Deal with the following details:</h4>
                            </div>

                            @foreach($client  as $clientDetails)
                                {{$clientDetails->peso_bought}}
                            @endforeach


                        </div>
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
 
</script>