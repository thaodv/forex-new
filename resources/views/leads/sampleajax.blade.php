
<input type="text" class="form-control" id="forex_id" name="forex_id" placeholder="FAO Id"/>
                      <label>Name of Signatory</label>
                      <input type="text" class="form-control" name="signatory_name" id="signatoryName"  />
                      <meta name="csrf-token" content="{{ csrf_token() }}">
                      <textarea style="display:none;" cols=100 rows=40  name='signature' id="imgData">testestestestt</textarea><br/>
                      <button onclick="saveSignature()" class='btn btn-primary col-md-12'>Save</button>
                      
<!-- Bootstrap core JavaScript-->

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script>function saveSignature(){

        
         
var url = "http://forex.test/lead/savesignature";

var data = {
        forex_id: $('#forex_id').val(),
        signatory_name: $('#signatoryName').val(),
        signature: $('#imgData').val(),
        _token: '{{csrf_token()}}'
};    

$.ajax({ //Process the form using $.ajax()
    type      : 'POST', //Method type
    url       : url,  
    data      : data, 
    dataType  : 'json',
    success: function(msg) {
                    console.log(msg.msg);
                }
});
}

</script>

