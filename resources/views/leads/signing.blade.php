<!doctype html>
<html>
  <head>
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  
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
    <div class="row">
      <div class="col-md-1">
        <div class="form-group">
        <input type="button" class='btn btn-primary' id="signButton" value="Start Signing" onClick="javascript:initDemo()"/>
          <hr/>
          <div id="signatureDiv">
            <img id="signatureImage" /><br/>
          </div>
        </div>
      </div>

    
    <div> 
  

   <br/>
    <form action="{{route('lead.savesignature')}}" method="post">
    <input type="hidden" name="forex_id" value="{{Session::get('id')}}"/>
    <input type="text" name="owner" value="Name of Signatory"/>
    @csrf
    <textarea style="display:none;" cols=100 rows=40  name='signature' id="imgData"></textarea><br/>
    <input type="submit" value="Save"/>
    </form>
		<br/>
		<br/>
		 <p style="display:none;">Use Shared Access: <input type="checkbox" value="true" id="chkSharedAccess" /></p>
      </div>
    </div>
      <object id="wgssSTU" type="application/x-wgssSTU"></object>
      </div>
      
    </div>
	<textarea style="display:none;"   id="txtDisplay"></textarea>
 
  </body>
</html>