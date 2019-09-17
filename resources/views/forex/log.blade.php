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
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Activity Log</h6>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Activity</th>
                            <th>Description</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                      
                        <tbody>
                          @foreach($log as $logDetails)
                          <tr>
                            <td>{{$logDetails->activity}}</td>
                            <td>{{$logDetails->description}}</td>
                            <td>{{$logDetails->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
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

  @include('layout.footer')
  <!-- Page level plugins -->
  <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>