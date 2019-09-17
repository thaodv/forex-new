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

                
               


                   

                            <div class="card shadow mb-4"  >
                                <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Buy Summary {{date('m-d-y')}}</h6>
                                </div>
                                
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered"  id="dataTable"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Seq No</th>
                                        <th>Counter Party </th> 
                                        <th>Trader</th> 
                                        <th>Time</th> 
                                        <th>Status</th>
                                        <th>Value</th>                             
                                        <th>Rate</th> 
                                        <th>Amt Sold in $</th> 
                                        <th>&#8369; Amount</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @foreach($buy as $buyD)
                                            <tr>
                                                <td>{{$buyD->id}}</td>
                                                {{-- <td id="clientName_{{$sellD->client_id}}" onload="getClientName({{$sellD->client_id}})"></td>
                                                <td id="traderName_{{$sellD->trader_id}}" onload="getTraderName({{$sellD->trader_id}})"></td> --}}
                                                <td>Janet Yabis</td>
                                                <td>Rose Marie</td>
                                                <td>{{str_replace(date('Y-m-d')." ","",$buyD->created_at)}}</td>
                                                <td>{{$buyD->status}}</td>
                                                <td>TOD</td>
                                                <td>{{$buyD->rate}}</td> 
                                                <td>{{number_format($buyD->dollar_bought,2)}}</td> 
                                                <td>{{number_format($buyD->peso_sold,2)}}</td>  
                                                <td>@if($buyD->status!="Approved")<a href="/trader/confirm/{{$buyD->id}}">Confirm</a>@endif</td>
                                            </tr>   
                                        @endforeach
                                            <tr>
                                                <td colspan="8" style='text-align:right;'>Totals</td> 
                                                <td>{{number_format($totalDollarBought,2)}}</td> 
                                                <td>{{number_format($totalPesoSold,2)}}</td> 
                                            </tr>
                                            <tr>
                                                <td colspan="8" style='text-align:right;'>Weight Avg</td> 
                                                <td colspan="2" style='text-align:left;'>{{number_format($buyWar,2)}}</td>   
                                            </tr>
                                    </tbody>
                                    </table>
                                </div>
                                </div>
                            </div><!--datatables-->

                        <div class="card shadow mb-4"  >
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Sell Summary {{date('m-d-y')}}</h6>
                        </div>
                        
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-bordered"  id="dataTable1"   width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Seq No</th>
                                  <th>Counter Party </th> 
                                  <th>Trader</th> 
                                  <th>Time</th> 
                                  <th>Status</th>
                                  <th>Value</th>                             
                                  <th>Rate</th> 
                                  <th>Amt Sold in $</th> 
                                  <th>&#8369; Amount</th>
                                  <th>Action</th>
                                </tr>
                              </thead> 
                              <tbody>
                                  @foreach($sell as $sellD)
                                    <tr>
                                        <td>{{$sellD->id}}</td>
                                        {{-- <td id="clientName_{{$sellD->client_id}}" onload="getClientName({{$sellD->client_id}})"></td>
                                        <td id="traderName_{{$sellD->trader_id}}" onload="getTraderName({{$sellD->trader_id}})"></td> --}}
                                        <td>Janet Yabis</td>
                                        <td>Rose Marie</td>
                                        <td>{{str_replace(date('Y-m-d')." ","",$sellD->created_at)}}</td>
                                        <td>{{$sellD->status}}</td>
                                        <td>TOD</td>
                                        <td>{{$sellD->rate}}</td> 
                                        <td>{{number_format($sellD->dollar_sold,2)}}</td> 
                                        <td>{{number_format($sellD->peso_bought,2)}}</td> 
                                        <td>@if($sellD->status!="Approved")<a href="/trader/confirm/{{$sellD->id}}">Confirm</a>@endif</td>

                                    </tr>   
                                  @endforeach
                                    <tr>
                                        <td colspan="8" style='text-align:right;'>Totals</td> 
                                        <td>{{number_format($totalDollarSold,2)}}</td> 
                                        <td>{{number_format($totalPesoBought,2)}}</td> 
                                    </tr>
                                    <tr>
                                        <td colspan="8" style='text-align:right;'>Weight Avg</td> 
                                        <td colspan="2" style='text-align:left;'>{{number_format($sellWar,2)}}</td>   
                                    </tr>
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
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

  <!-- Page level custom scripts -->
 
<script>
// Call the dataTables jQuery plugin

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
        document.getElementById('buy_type').value = "Buy";
        document.getElementById('currency_selected').value = "USD";
    }else{
        document.getElementById('buy_type').value = "Sell";
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
    document.getElementById('sold_amount').value = total.toFixed(2);

}

function getClientName(clientId){
    
    var url = "http://forex.test/client/";

        var data = {   
                client_id : clientId,                    
                _token: '{{csrf_token()}}'
        };    
        
            $.ajax({ //Process the form using $.ajax()
                type      : 'POST', //Method type
                url       : url,  
                data      : data, 
                dataType  : 'json',
                success: function(msg) {   
                    alert(msg.msg);                                  
                }
            }); 
}

function getTraderName(traderId){
    document.getElementById('traderName_'+traderId).value = "Marie Rose";   
    var url = "http://forex.test/tradername";
    console.log(traderId);

                var data = {
                    trader_id: traderId,                         
                        _token: '{{csrf_token()}}'
                };    
                 
                     $.ajax({ //Process the form using $.ajax()
                        type      : 'POST', //Method type
                        url       : url,  
                        data      : data, 
                        dataType  : 'json',
                        success: function(msg) {
                             document.getElementById('traderName_'+traderId).value = msg.name;                                 
                        }
                    }); 
}
</script>