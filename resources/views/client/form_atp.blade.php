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
                    <h6 class="m-0 font-weight-bold text-primary">Application To Purchase</h6>
                  </div>

                    <form action="{{route('client.saveatp')}}" method="post">
                    <div class="row offset-1">
                        
                        
                        
                        <input type="hidden" name="forex_id" value="{{Session::get('id')}}"/>
                        @csrf

                        <div class="col-md-7">
                                <br/><br/>
                            <div class="form-group"> 
                                <select name='residency' required class="form-control form-control-user" id="residency" >
                                    <option value="">Select Residency</option>
                                    <option value="resident">Resident</option>
                                    <option value="non-resident">Non-Resident</option>
                                </select>
                            </div>
                        </div> 

                        <div class="col-md-7">
                               
                            <div class="form-group"> 
                                <input type="text" required name='name' class="form-control form-control-user" id="client_name" aria-describedby="clientNameHelp" placeholder="Name">
                            </div>
                        </div> 

                        <div class="col-md-7">
                            <div class="form-group"> 
                                <input type="text" required name='address' class="form-control form-control-user" id="address" aria-describedby="clientNameHelp" placeholder="Address">
                            </div>
                        </div> 
                        <div class="col-md-7">
                            <div class="form-group"> 
                                <input type="text" required name='telephone_number' class="form-control form-control-user" id="telephone_number" aria-describedby="clientNameHelp" placeholder="Telephone Number">
                            </div>
                        </div> 
                        <div class="col-md-7">
                            <div class="form-group"> 
                                <input type="text" required name='mobile_number' class="form-control form-control-user" id="mobile_number" aria-describedby="clientNameHelp" placeholder="Mobile Number">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group"> 
                                <input type="text" required name='gov_id' class="form-control form-control-user" id="gov_id" aria-describedby="clientNameHelp" placeholder="Government Issued ID (e.g. SSS)">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group"> 
                                <input type="text" required name='usd_amount_figures' class="form-control form-control-user" id="usd_amount" aria-describedby="clientNameHelp" placeholder="USD Amount to Purchase (in Figures)">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group"> 
                                    <input type="text" required name='usd_amount_words' class="form-control form-control-user" id="usd_amount" aria-describedby="clientNameHelp" placeholder="USD Amount to Purchase (in Words)">                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group"> 
                                <input type="text" required name='estimated_purchase' class="form-control form-control-user" id="estimated_purchase" aria-describedby="clientNameHelp" placeholder="Estimated Purchase within a year (USD)">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group"> 
                                <input type="text" required name='exchange_rate' class="form-control form-control-user" id="exchange_rate" aria-describedby="clientNameHelp" placeholder="Exchange Rate  ">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group"> 
                                <input type="text" required name='purpose_of_transaction' class="form-control form-control-user" id="purpose_of_transaction" aria-describedby="clientNameHelp" placeholder="Purpose of Transaction">
                            </div>
                        </div>
                        <div class="col-md-7">
                             <div class="form-group"> 
                                <select name='forex_disposition' required class="form-control form-control-user" id="forex_disposition" >
                                    <option value="">Select Foreign Exchange Disposition</option>
                                    <option value="direct">For Direct Remittance</option>
                                    <option value="credit">For Credit To FCDU Account</option>
                                </select>
                            </div>
                        </div> 

                        <div class="col-md-7 row"  style="display: none;" id="directDisposition">
                            <div class="col-md-5">
                                <div class="form-group"> 
                                        <select name='direct_amount_option' required class="form-control form-control-user" id="amount_disposition" >
                                                <option value="">Select</option>
                                                <option value="full">Full Amount</option>
                                                <option value="partial">Partial Amount</option>
                                            </select>
                                </div>
                            </div>  
                        </div>

                        <div class="col-md-7 row"  style="display: none;" id="creditDisposition">
                                <div class="col-md-5">
                                        <div class="form-group"> 
                                            <input type="text" required name='credit_amount' class="form-control form-control-user" id="beneficiary_address" aria-describedby="clientNameHelp" placeholder="Amount">
                                        </div>
                                    </div>  
                                <div class="col-md-5">
                                    <div class="form-group"> 
                                            <select name='credit_amount_option' required class="form-control form-control-user" id="amount_disposition" >
                                                    <option value="">Select</option>
                                                    <option value="full">Full Amount</option>
                                                    <option value="partial">Partial Amount</option>
                                                </select>
                                    </div>
                                </div>  
                               
                            </div>

                        <div class="col-md-7">
                            <div class="form-group"> 
                                <input type="text" required name='beneficiary_name' class="form-control form-control-user" id="beneficiary_name" aria-describedby="clientNameHelp" placeholder="Beneficiary Name">
                            </div>
                        </div>  
                        <div class="col-md-7">
                                <div class="form-group"> 
                                    <input type="text" required name='beneficiary_address' class="form-control form-control-user" id="beneficiary_address" aria-describedby="clientNameHelp" placeholder="Beneficiary Address">
                                </div>
                        </div>  
                        <div class="col-md-7">
                            <div class="form-group"> 
                                    <a href="" id="btnSignature"  type="submit">Upload Signature</a>
                            </div>
                        </div>
                        
                        <div class="col-md-7">
                            <div class="form-group"> 
                                    <button type="submit" class="btn btn-primary  btn-user btn-block">Create</button>
                            </div>
                        </div> 
                        
                        
                    </div>
                    </form>



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
       $('#forex_disposition').change(function(){

        if(document.getElementById('forex_disposition').value=="direct"){
            $('#directDisposition').show();
            $('#creditDisposition').hide();
        }else if(document.getElementById('forex_disposition').value=="credit"){
            $('#directDisposition').hide();
            $('#creditDisposition').show();
        }else{
            $('#directDisposition').hide();
            $('#creditDisposition').hide();
        }
       });

       </script>