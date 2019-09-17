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
                    <h6 class="m-0 font-weight-bold text-primary">Clients</h6>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Contact Number</th> 
                            <th>Trader</th>
                            <th>Date Added</th>
                            <th>Action</th>
                          </tr>
                        </thead> 
                        <tbody>
                          @foreach($list as $listDetails)
                          <tr>
                            <td>{{$listDetails->first_name}} {{$listDetails->last_name}}</td>
                            <td>{{$listDetails->contact_number}}</td>
                            <td>@foreach($trader as $tr)
                              @if($tr->id==$listDetails->trader_id)
                                {{$tr->first_name." ".$tr->last_name}}
                              @endif
                              @endforeach</td>
                            <td>{{$listDetails->created_at}}</td>
                            <td><a href="/client/profile/{{$listDetails->id}}" >View Profile</a></td>
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

  function getTraderName(client_id,trader_id){

      var url = "http://forex.test/tradername";

                var data = {
                        trader_id: trader_id,
                        _token: '{{csrf_token()}}'
                };    
                 
                 console.log(data);
                    $.ajax({ //Process the form using $.ajax()
                        type      : 'POST', //Method type
                        url       : url,  
                        data      : data, 
                        dataType  : 'json',
                        success: function(msg) {   
                            console.log(msg.name);
                            return msg.name;
                          //  showActionBtns();                                     
                        }
                    }); 
  }

  </script>