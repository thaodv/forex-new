<template>
    <div>
        <p id="message"></p>
        <div class="form-group">
            <input type="text" name='employee_id' class="form-control form-control-user"  v-model="user.employee_id" aria-describedby="employeeIdHelp" placeholder="Employee ID">
        </div>

        <div class="form-group">
            <input type="text" name='first_name' class="form-control form-control-user"  v-model="user.first_name" aria-describedby="firstNameHelp" placeholder="First Name">
        </div>

        <div class="form-group">
            <input type="text" name='last_name' class="form-control form-control-user"  v-model="user.last_name" aria-describedby="lastNameHelp" placeholder="Last Name">
        </div>

        <div class="form-group">
            <input type="text" name='department' class="form-control form-control-user"  v-model="user.department" aria-describedby="departmentHelp" placeholder="Department">
        </div>

        <div class="form-group">
            <input type="text" name='user_type' class="form-control form-control-user"  v-model="user.user_type" aria-describedby="userTypelHelp" placeholder="User Type">
        </div>

        <div class="form-group">
            <input type="email" name='email' class="form-control form-control-user"  v-model="user.email" aria-describedby="emailHelp" placeholder="Email Address">
        </div> 
        <input type="hidden" name='password' value="12345" class="form-control form-control-user"  v-model="user.password" aria-describedby="passwordHelp" placeholder="Password">
        <input type="hidden" name='is_logged_in' value="false" class="form-control form-control-user"  v-model="user.is_logged_in" aria-describedby="isLoggedInHelp" placeholder="Is Logged In">

          
        
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
                user:{
                employee_id:"123456",
                first_name:"Vel",
                last_name:"Rosario",
                department:"Trading",
                user_type:"Trader",
                email:"eliza@yahoo.com",
                password:"1234567",
                is_logged_in:"false",
                },
                
            }

        },
        methods: {
            create(){
                var app = this;
                var userInfo = app.user;
                var url = 'http://forex.test/store';
                
                axios.defaults.headers.common = {
				    'X-Requested-With': 'XMLHttpRequest',
    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				};
				axios.post(url, userInfo).then(function (response) {
                    document.getElementById('message').innerHTML = response.data;
                });
               
            }
        },
        mounted() {
               
            console.log('Component mounted.')
        }
    }
</script>
