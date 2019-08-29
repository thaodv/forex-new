<template>
    <div>
        <p id="message"></p>
        <div class="form-group">
            <input type="text" name='company_name' class="form-control form-control-user" id="leadCompanyName" v-model="lead.company_name" aria-describedby="companyNameHelp" placeholder="Company Name">
        </div>

        <div class="form-group">
            <input type="text" name='phone_number' class="form-control form-control-user" id="leadPhoneNumber" v-model="lead.phone_number" aria-describedby="phoneNUmberHelp" placeholder="Cellular Number">
        </div>

        <div class="form-group">
            <input type="text" name='telephone_number' class="form-control form-control-user" id="leadTelephoneNumber" v-model="lead.telephone_number" aria-describedby="telephoneNumberHelp" placeholder="Telephone Number">
        </div>

        <div class="form-group">
            <input type="text" name='website' class="form-control form-control-user" id="leadWebsite" aria-describedby="websiteHelp" v-model="lead.website" placeholder="Website URL">
        </div>

        <div class="form-group">
            <input type="email" name='email' class="form-control form-control-user" id="leadEmail" aria-describedby="emailHelp" v-model="lead.email" placeholder="Email Address">
        </div>

        <div class="form-group">
            <input type="text" name='contact_person' class="form-control form-control-user" id="leadContactPerson" aria-describedby="contactPersonHelp" v-model="lead.contact_person" placeholder="Contact Person">
        </div> 
        <input type="hidden" name='status' value="New" class="form-control form-control-user" id="leadStatus" aria-describedby="statusHelp" v-model="lead.status" placeholder="Status">
        
        
        <button class="btn btn-primary btn-user btn-block" @click.prevent="create()">
            Submit
        </button>
        <hr>
    </div>        
</template>

<script>
  window.csrf_token = "{{ csrf_token() }}"
    export default {

        data: function(){
            return {
                lead:{
                company_name:"",
                phone_number:"",
                telephone_number:"",
                website:"",
                contact_person:"",
                email:"",
                status:"New"
                },
            }

        },
        methods: {
            create(){
                var app = this;
                var leadInfo = app.lead;
                var url = 'http://forex.test/lead/store';

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
