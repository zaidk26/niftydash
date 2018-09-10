<!-- TEMPLATE -->
<template>

                <div class="col-12 mt-5 text-center" style="max-width:600px;">

              
                    <div class="card px-3 px-lg-5 py-5 box-shadow text-left">
                       

                        <form>


                            <div class="form-group required">
                                <label>Name</label>
                                <input type="text" v-model.trim="name" @blur="$v.name.$touch()" v-bind:class="{ 'is-invalid': $v.name.$error }" class="form-control"
                                    placeholder="Name">

                                <div class="invalid-feedback" v-if="!$v.name.required">
                                    Please enter a name or nickname
                                </div>

                            </div>

                            <div class="form-group required">
                                <label>Email address</label>
                                <input type="email" v-model.trim="email" @blur="$v.email.$touch()" v-bind:class="{ 'is-invalid': $v.email.$error }" class="form-control"
                                    placeholder="Email Address">

                                <div class="invalid-feedback" v-if="!$v.email.required">
                                    Please enter email address
                                </div>
                                <div class="invalid-feedback" v-if="!$v.email.email">
                                    invalid email
                                </div>

                            </div>

                            <div class="form-group required">
                                <label>Password</label>
                                <input type="password" v-model.trim="password" @input="$v.password.$touch()" v-bind:class="{ 'is-invalid': $v.password.$error }"
                                    class="form-control" placeholder="Password">
                                <div class="invalid-feedback" v-if="!$v.password.required">
                                    Please enter password
                                </div>
                            </div>


                           
                            <div class="form-group">
                                <div v-if="errors.length > 0">
                                    <span class="text-danger p-2" :key="error" v-for="error in errors">{{ error }} <br/> </span>
                                </div>

                                <transition name="fade">
                                    <button v-if="!submitted" v-on:click.prevent="register" type="submit" class="btn btn-success btn-block btn-lg mt-3">
                                        REGISTER
                                        <i class="fa fa-user"></i>
                                    </button>
                                </transition>

                                <transition name="fade" v-if="submitted">
                                    <div class="loader"></div>
                                </transition>



                            </div>
                           
                        </form>

                    </div>


                </div>



</template>


<!-- SCRIPT -->
<script>
    import {
        required,
        email
    } from 'vuelidate/lib/validators';

    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',               
                failed: false,
                submitted: false,               
                errors: [] 
            }
        },
        validations: {
            name: {
                required
            },
            email: {
                required,
                email
            },
            password: {
                required
            }
        },

      

        methods: {
            register() {
                if (this.$v.$invalid) {
                    this.$v.name.$touch();
                    this.$v.email.$touch();
                    this.$v.password.$touch();
                    return;
                }
                
                this.submitted = true;
                this.errors = [];
                

                axios.post('/users', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                   
                }).then((response) => {
                  Vue.toasted.success('Successfully Registered', {
                        fullWidth: true,
                        fitToScreen: true,
                        position: 'bottom-center',
                        duration: 3000                      
                      });
                   window.location.href ="/users";
                }).catch((error) => {
                    this.failed = true;
                    this.submitted = false;
                    var myObj = error.response.data.errors;                    
                 
                    Object.keys(myObj).forEach((key) => {
                         myObj[key].forEach((value) => {
                            this.errors.push(value);
                        });
                    });                    
                });                
            },
           
        }
    }
</script>


