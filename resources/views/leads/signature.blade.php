<!doctype html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  
    <link rel="stylesheet" type="text/css" href="{{asset('css/sb-admin-2.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/signature.css')}}" />
    <script type="text/javascript" src="{{asset('js/BigInt.js')}}"></script>
    <!-- <script type="text/javascript" src="{{asset('sjcl.js')}}"></script> -->
    <script type="text/javascript" src="{{asset('js/wacom_encryption.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/wacom.js')}}"></script>
    <script type="text/javascript">
      function initDemo() {
        var signatureForm = new SignatureForm(document.getElementById("signatureImage"));
        signatureForm.connect(chkSharedAccess.checked);
      }
    </script>
  </head>    
<body>
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid" id="app">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Signature</h1>
                </div>
                <hr/>
                <!-- Content Row -->
                
                <div class="row">
                  <div class="col-md-3" id="signatureDiv">
                    <p>Signature will be displayed here.</p>
                    <img id="signatureImage" /><br/><br/>
                    <input type="button" class='btn btn-success col-md-12'  id="signButton" value="Start Signing" onClick="javascript:initDemo()"/>

                    <br/><br/>
                    
                    <form action="{{route('lead.savesignature')}}" method="post">
                      <input type="hidden" name="forex_id" value="{{Session::get('id')}}"/>
                      <label>Name of Signatory</label>
                      <input type="text" class="form-control" name="owner" />
                      @csrf
                      <textarea style="display:none;" cols=100 rows=40  name='signature' id="imgData"></textarea><br/>
                      <input type="submit" class='btn btn-primary col-md-12' value="Save"/>
                    </form>
                    <p style="display:none;">Use Shared Access: <input type="checkbox" value="true" id="chkSharedAccess" /></p>
                    <object id="wgssSTU" type="application/x-wgssSTU"></object>
                    <textarea style="display:none;"   id="txtDisplay"></textarea>
                  </div>
                </div><!-- end of content row -->
                 

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
  
