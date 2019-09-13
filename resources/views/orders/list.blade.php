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
                
                <a href="{{route('trader.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Book Order</a>
              </div>

              @if($blotter!=null)
                <!-- DataTales Example -->
                <div class="card shadow mb-4" id="lead_div" >
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Summary {{date('m-d-y')}}</h6>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Buy Wgt Avg</th>
                            <th>Total USD Bought</th> 
                            <th>Total PHP Sold</th> 
                            <th>Total PHP Bought</th> 
                            <th>Total USD Sold</th>
                            <th>Sell Wgt Avg</th>                             
                            <th>FX Position</th> 
                             
                          </tr>
                        </thead> 
                        <tbody>
                          @foreach($blotter as $blotterDetails)
                          <tr>
                            <td>{{$blotterDetails->buy_war}}</td>
                            <td>{{$blotterDetails->dollar_bought}}</td>
                            <td>{{$blotterDetails->peso_sold}}</td>
                            <td>{{$blotterDetails->peso_bought}}</td>
                            <td>{{$blotterDetails->dollar_sold}}</td>
                            <td>{{$blotterDetails->sell_war}}</td>
                            <td>{{$blotterDetails->fx_position}}</td> 
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div><!--datatables-->
                @endif

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
                            <th>Bought Currency</th> 
                            <th>Amount</th> 
                            <th>Sold Currency</th> 
                            <th>Amount</th>
                            <th>Rate</th>                             
                            <th>Status</th>
                            <th>Date Added</th>
                             
                          </tr>
                        </thead> 
                        <tbody>
                          @foreach($orders as $orderDetails)
                          <tr>
                            <td>{{$orderDetails->client_id}}</td>
                            <td>{{$orderDetails->bought_currency}}</td>
                            <td>{{$orderDetails->bought_amount}}</td>
                            <td>{{$orderDetails->sold_currency}}</td>
                            <td>{{$orderDetails->sold_amount}}</td>
                            <td>{{$orderDetails->rate}}</td>
                            <td>{{$orderDetails->status}}</td>
                            <td>{{$orderDetails->created_at}}</td>
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