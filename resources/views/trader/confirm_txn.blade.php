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
                            <h6 class="m-0 font-weight-bold text-primary">Transaction Details</h6>
                        </div>
                        <div  id="cisForm">
                             <br/><br/>
                              <div class="row offset-1"><!-- Content Row -->
                                @csrf
                                <input type="hidden" name="trader_id" value="{{Session::get('id')}}"/>
                                <input type="hidden" name="status" value="1"/>
                                
                                @foreach($client as $clientDetails)
                                    @foreach($trade  as $tradeDetails)
                                    <div class="col-md-8">
                                        <div class="form-group"> 
                                            <label>Transaction Type: {{$tradeDetails->txn_type}}</label><br/>
                                            <label>Transaction Date: {{$tradeDetails->created_at}}</label><br/>
                                            <label>Dollar Rate: {{$tradeDetails->rate}}</label>
                                        </div>
                                    </div>  
                                    <div class="col-md-5">
                                    <table class="table table-bordered"   cellspacing="0">
                                        <thead>
                                            <th>Type</th>
                                            <th>Currency</th>
                                            <th>Amount</th>
                                            </thead>
                                    <tr>
                                        <td>Bought</td>
                                        <td>USD</td>
                                        <td>{{number_format($tradeDetails->dollar_bought,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Sold</td>
                                        <td>PHP</td>
                                        <td>{{number_format($tradeDetails->peso_sold,2)}}</td>
                                    </tr>
                                    </table>
                                    </div>


                                    <div class="col-md-5">
                                    <table class="table table-bordered"   cellspacing="0">
                                        <thead>
                                            <th colspan="2">{{$clientDetails->first_name." ".$clientDetails->last_name}}</th>
                                            </thead>
                                    <tr>
                                        <td>Trader</td>
                                        <td>{{$trader}}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                    <td><select name="trade_status" class="form-control "><option value="">{{$tradeDetails->status}}</option><option value="approve">Approve</option></select></td>
                                    </tr>
                                    </table>
                                    </div>

                                    <div class="col-md-8">
                                        <h6 class="text-primary"><strong>Settlement (Receiving A/C)</strong></h6>
                                    </div>
                                    
                                    <div class="col-md-10">
                                        <h6 class="text-primary"><strong>Ours</strong></h6>
                                            <table class="table table-bordered" width="100%"   cellspacing="0">
                                                <thead>
                                                    <th>Code</th>
                                                    <th>Bank Acct No</th>
                                                    <th>Bank Name</th>
                                                    <th>Curr</th>
                                                    <th></th>
                                                    <th>Amount</th>
                                                    <th>Payment</th>
                                                </thead>
                                                <tr>
                                                    <td>BDO</td>
                                                    <td>105351681683</td>
                                                    <td>Banco de Oro</td>
                                                    <td>$</td>
                                                    <td>1</td>
                                                    <td>{{number_format($tradeDetails->dollar_bought,2)}}</td>
                                                    <td></td>
                                                </tr>                                            
                                            </table>
                                    </div>

                                    <div class="col-md-10">
                                            <h6 class="text-primary"><strong>Theirs</strong></h6>
                                                <table class="table table-bordered" width="100%"   cellspacing="0">
                                                    <thead>
                                                        <th>Code</th>
                                                        <th>Bank Acct No</th>
                                                        <th>Bank Name</th>
                                                        <th>Curr</th>
                                                        <th></th>
                                                        <th>Amount</th>
                                                        <th>Payment</th>
                                                    </thead>
                                                    <tr>
                                                        <td>BDO</td>
                                                        <td>105351145383</td>
                                                        <td>Banco De Oro</td>
                                                        <td>PHP</td>
                                                        <td>1</td>
                                                        <td>{{number_format($tradeDetails->peso_sold,2)}}</td>
                                                        <td></td>
                                                    </tr>                                            
                                                </table>
                                        </div>

                                        <div class="col-md-10">
                                            <button class="btn btn-primary">Print Instruction Memo</button>
                                            <button class="btn btn-primary">Print Advice Entry / DM</button>
                                            <button class="btn btn-primary">New</button>
                                            <button class="btn btn-primary">Credit Entry</button><br/><br/>
                                            <a href="/trader/approve/{{$tradeDetails->id}}" class="btn btn-success">Save </a>                                        
                                            <button class="btn btn-danger">Close</button><br/><br/>
                                        </div>
                                    @endforeach
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