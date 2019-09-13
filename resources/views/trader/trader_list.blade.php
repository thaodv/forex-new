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
                <div class="card shadow mb-4" id="clientList" >
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Clients</h6>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Contact Number</th>  
                            <th>Date Added</th>
                            <th>Action</th>
                          </tr>
                        </thead> 
                        <tbody>
                          @foreach($list as $listDetails)
                          <tr>
                            <td>{{$listDetails->first_name}} {{$listDetails->last_name}}</td>
                            <td>{{$listDetails->contact_number}}</td>
                            <td>{{$listDetails->created_at}}</td>
                            <td><button onclick="bookOrder({{$listDetails->id}})" class="btn btn-primary">Book Order</button></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div><!--datatables-->

                <div class="card shadow mb-4" id="orderform" style="display:none;" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Book Order</h6>
                        </div>
                        <div  id="cisForm">
                          <form action="{{route('order.store')}}" method="post">
                            <br/><br/>
                              <div class="row offset-1"><!-- Content Row -->
                                @csrf
                                <input type="hidden" name="trader_id" value="{{Session::get('id')}}"/>
                                <input type="hidden" name="status" value="New"/>
                                @foreach($list as $clientDetails)
                                <input type="hidden" name="forex_id" value="{{$clientDetails->forex_id}}"/>
                                <input type="hidden" name="client_id" value="{{$clientDetails->id}}"/>
                                @endforeach

                                <div class="col-md-8">
                                  <div class="form-group">
                                    <label>Beginning Balance</label>
                                    <input class="form-control" name="beginning_balance" readonly  id="beginning_balance" type="text" value="{{Session::get('beginning_balance')}}"  >
                                  </div>
                              </div>


                                <div class="col-md-8">
                                    <div class="form-group">
                                      <label>Counter Party</label>
                                      <select class="form-control" name="counter_party">
                                        @foreach($list as $nameList)
                                        <option value="{{$nameList->id}}">{{$nameList->first_name}}</option>
                                        @endforeach
                                      </select>
                                      <input class="form-control" name="name" id="name" type="hidden"  >
                                      <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                        <div class="form-group">
                                          <label>Dealer</label>
                                          <input class="form-control" name="dealer" readonly  id="dealer" type="text" value="{{Session::get('name')}}"  >

                                        </div>
                                    </div>
                              </div><!-- end of content row -->
                              <div class="row offset-1"><!-- Content Row -->
                                <div class="col-md-2">
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                      <label>Currency</label>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                      <label>Amount</label>
                                    </div>
                                </div> 
                              </div><!-- end of content row -->
                              <div class="row offset-1"><!-- Content Row -->
                                <div class="col-md-2">
                                    <div class="form-group"> 
                                        <label>Bought</label>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                                <div class="radio">
                                                    <label><input type="radio" id="currency1Btn" onclick="setSoldCurrency(this.value)" name="bought_currency" value="USD" checked> $ USD </label>
                                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                                    <label><input type="radio" id="currency2Btn" onclick="setSoldCurrency(this.value)" name="bought_currency" value="PHP" > &#8369; PHP</label>
                                                </div>
                                      <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                      <input class="form-control"  name="bought_amount" onkeyup="calculateSoldAmount()" id="bought_amount" type="number" step="any" placeholder="0.00" required="required" data-validation-required-message="Please enter the purpose of transaction">
                                      <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                              </div><!-- end of content row -->
                              <div class="row offset-1"><!-- Content Row -->
                                <div class="col-md-2">
                                    <div class="form-group"> 
                                        <label>Rate</label>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                      <input class="form-control" name="rate"  id="rate" type="number" step="any" onkeyup="calculateSoldAmount()" placeholder="0.00" required="required" data-validation-required-message="Please enter the purpose of transaction">
                                      <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                     
                                </div>
                              </div><!-- end of content row -->
                              <div class="row offset-1"><!-- Content Row -->
                                <div class="col-md-2">
                                    <div class="form-group"> 
                                        <label>Sold</label>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                      <input class="form-control" name="sold_currency" readonly  id="currency_selected" type="text"  >
                                      <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                      <input class="form-control"  name="sold_amount" readonly id="sold_amount" type="text" >
                                      <input class="form-control"  name="total_amount"  type="hidden" >
                                      <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                              </div><!-- end of content row -->
                              <div class="row offset-1"><!-- Content Row -->
                                <div class="col-md-8">
                                        <div class="form-group"> 
                                            <label>Settlement (Receiving A/C)</label>
                                        </div>
                                    </div> 
                                </div><!-- end of content row -->
                                <div class="row offset-1"><!-- Content Row -->
                                  <div class="col-md-2">
                                          <div class="form-group"> 
                                              <label>Ours</label>
                                          </div>
                                      </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <input class="form-control" name="their_bank"  id="their_bank" type="text" required="required" placeholder="Bank" data-validation-required-message="Please enter bank name.">
                                    <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                </div><!-- end of content row -->
                                <div class="row offset-1"><!-- Content Row -->
                                <div class="col-md-2">
                                    <div class="form-group"> 
                                        <label>Theirs</label>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <input class="form-control" name="our_bank"  id="our_bank" type="text" placeholder="Bank" required="required" data-validation-required-message="Please enter bank account number.">
                                    <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                              </div><!-- end of content row -->
                              <div class="row offset-1"><!-- Content Row -->
                                <div class="col-md-8">
                                    <div class="form-group"> 
                                        <label>Other Instructions</label>
                                    </div>
                                </div> 
                              </div><!-- end of content row -->
                              <div class="row offset-1"><!-- Content Row -->
                                <div class="col-md-2">
                                        <div class="form-group"> 
                                            <label>(Paying A/C)</label>
                                        </div>
                                    </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <input class="form-control" name="other_instructions"  id="other_instructions" type="text"   data-validation-required-message="Please enter bank account number.">
                                    <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                              </div><!-- end of content row -->
                              
                              <div class="row offset-1"><!-- Content Row -->   
                                <div class="col-md-8 text-center">
                                    <br/><br/>
                                    <div id="success"></div>
                                    <button id="submitForm" class="btn btn-primary btn-xl text-uppercase" type="submit">Submit</button>
                                    <br/><br/>
                                    <button id="cancelBtn" class="btn btn-danger btn-xl text-uppercase" onclick="showList()" type="button">Cancel</button>
                                    <br/><br/>
                                </div>
                              </div><!-- end of content row -->
                          </form>
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

function bookOrder(client_id){

    $('#clientList').hide();
    $('#orderform').show();
}
function showList(){
    $('#clientList').show();
    $('#orderform').hide();
}

function  setSoldCurrency(selectedCurrency){
    if(selectedCurrency=="PHP"){
        document.getElementById('currency_selected').value = "USD";
    }else{
        document.getElementById('currency_selected').value = "PHP";
    }
}
$('#currency1Btn').change(function(){
  calculateSoldAmount();
});
$('#currency2Btn').change(function(){
  calculateSoldAmount();
});

function calculateSoldAmount(){

    var balance = {{Session::get('beginning_balance')}};    
    var amount = document.getElementById('bought_amount').value;
    var rate = document.getElementById('rate').value;
    var total = "";

    if(document.getElementById('currency1Btn').checked){
        document.getElementById('currency_selected').value = "PHP";
        total = amount * rate;
        total = parseFloat(total,2);
    }else{
        document.getElementById('currency_selected').value = "USD";
        total= amount / rate;
        total = parseFloat(total,2);
    }
    console.log(total);
    var ending_balance = balance - total; 
    document.getElementById('beginning_balance').value = ending_balance.toFixed(2);
    document.getElementById('sold_amount').value = total.toFixed(2);
    //document.getElementById('total_amount').value = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

}
</script>