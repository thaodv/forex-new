

 <template>
    <div>
        <p id="message"></p>
         
                      <input type="hidden" v-model="signature.forex_id" name="forex_id" />
                      <label>Name of Signatory</label>
                      <input type="text" v-model="signature.signatory_name" class="form-control" name="signatory_name" id="signatoryName"  />
                      
                      <textarea style="display:none;" v-model="signature.signature" cols=100 rows=40  name='signature' id="imgData"></textarea><br/>
                      <button  @click.prevent="create()" class='btn btn-primary col-md-12'>Save</button>
                      
        <hr>
    </div>        
</template>

<script>
  window.csrf_token = "{{ csrf_token() }}"
    export default {

        data: function(){
            return {
                signature:{
                forex_id:"",
                signatory_name:"",
                signature:""
                },
            }

        },
        methods: {
            create(){
                var app = this;
                var leadInfo = app.lead;
                var url = 'http://forex.test/lead/savesignature';

                axios.defaults.headers.common = {
				    'X-Requested-With': 'XMLHttpRequest',
    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				};
                
				axios.post(url, leadInfo).then(function (response) {
                    document.getElementById('message').innerHTML = response.data;
                    console.log(response.data);
                });
               
            }
        },
        mounted() {
               
            console.log('Component mounted.')
        }
    }
</script>
