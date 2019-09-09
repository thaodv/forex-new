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
                    <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Client</th>
                            <th>From Currency</th> 
                            <th>Amount</th> 
                            <th>To Currency</th> 
                            <th>Amount</th>
                            <th>Exchange Value</th> 
                            <th>Fee</th>
                            <th>Total Amount</th>                             
                            <th>Status</th>
                            <th>Details</th>
                          </tr>
                        </thead> 
                        <tbody>
                          @foreach($oders as $oderDetails)
                          <tr>
                            <td>{{$oderDetails->client_id}}</td>
                            <td>{{$oderDetails->from_currency}}</td>
                            <td>{{$oderDetails->from_amount}}</td>
                            <td>{{$oderDetails->to_currency}}</td>
                            <td>{{$oderDetails->to_amount}}</td>
                            <td>{{$oderDetails->exchange_value}}</td>
                            <td>{{$oderDetails->fee}}</td>
                            <td>{{$oderDetails->total_amount}}</td>
                            <td>{{$oderDetails->status}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div><!--datatables-->

                
 

                

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