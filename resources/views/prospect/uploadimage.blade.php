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
                    <h1 class="h3 mb-0 text-gray-800">Prospect Leads</h1>
                    <a href="{{route('prospect.list')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Go to List</a>
                </div>
               
                <!-- DataTales Example -->
                <div class="card shadow mb-4" id="lead_div" >
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create</h6>
                  </div>

                   
                    <input class="btn-primary" type="file" multiple accept="image/jpeg, image/png" style="display:none" id="upload-file"/>
                    <br/>
                    <button id="choose-button" type="button">Choose Image</button><br/>
                    <img src="#" id="myImg"/>
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
document.querySelector('#choose-button').addEventListener('click', function() {
	document.querySelector('#upload-file').click();
});
document.querySelector('#upload-file').addEventListener('change', function() {
	// This is the file user has chosen
	var file = this.files[0];
    // Max 2 Mb allowed
	if(file.size > 2*1024*1024) {
		alert('Error : Exceeded size 2MB');
		return;
	}

	// Validation is successful
	// This is the name of the file
    document.getElementById('myImg').src = file.name;
	//alert('You have chosen the file ' + file.name);
 
});

</script>