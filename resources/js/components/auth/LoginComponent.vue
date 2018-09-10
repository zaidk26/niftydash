<!-- TEMPLATE -->
<template>    
  
<div class="col  max-w-600  mx-auto text-center">

    <div class="bg-image-con"></div>

    <div class="card px-3 px-lg-5 py-5 box-shadow">

        <h4 class="m-0">Login Using Email</h4>
        <small class="text-black-50">Please enter your email and password you used when registering</small>

        <form class="mt-5">

          <div class="form-group">
            <input type="email" v-model.trim="email" @blur="$v.email.$touch()" v-bind:class="{ 'is-invalid': $v.email.$error }"
              class="form-control form-control-lg my-0" placeholder="Email Address">

            <div class="invalid-feedback" v-if="!$v.email.required">
              Please enter email address
            </div>
            <div class="invalid-feedback" v-if="!$v.email.email">
              invalid email
            </div>
          </div>

          <div class="form-group">
            <input type="password" v-model.trim="password" @input="$v.password.$touch()" v-bind:class="{ 'is-invalid': $v.password.$error }"
              class="form-control form-control-lg my-0" placeholder="Password">
            <div class="invalid-feedback" v-if="!$v.password.required">
              Please enter password
            </div>
          </div>

          <div class="form-group">

            <div v-if="failed">
              <span class="text-danger p-2">Incorrect Credentials</span>
            </div>

            <transition name="fade">
              <button v-if="!submitted" v-on:click.prevent="login" type="submit" class="btn btn-success btn-block btn-lg">
                Login
                <i class="fa fa-user"></i>
              </button>
            </transition>

            <transition name="fade" v-if="submitted">
              <div class="loading-circle"></div>
            </transition>

          </div>

          <div class="text-center mt-3">
            <a class="text-success font-size-15 text-underline  font-weight-600" href="/password/reset">
              Forgot Your Password?
            </a>
          </div>

        </form>

    </div>
</div>
</template>


<!-- SCRIPT -->
<script>
import { required, email } from "vuelidate/lib/validators";

export default {
  
  data() {
    return {
      email: "",
      password: "",
      failed: false,
      submitted: false
    };
  },
  
  validations: {
    email: {
      required,
      email
    },
    password: {
      required
    }
  },

  methods: {

    login() {
      if (this.$v.$invalid) {
        this.$v.email.$touch();
        return;
      }

      this.submitted = true;

      axios
        .post("/login", {
          email: this.email,
          password: this.password
        })
        .then(response => {
          
          Vue.toasted.success("Successfully Signed In", {
            fullWidth: true,
            fitToScreen: true,
            position: "bottom-center",
            duration: 2000
          });

          window.location.href = response.data.url;
        })
        .catch(error => {
          
          this.failed = true;
          this.submitted = false;
          this.password = "";
          
          Vue.toasted.error("Error. Check your credentials", {
            fullWidth: true,
            fitToScreen: true,
            position: "bottom-center",
            duration: 2000
          });

        });
    }
  }
};
</script>

<style lang="scss" scoped>
  @import "~@/_variables.scss";
  
  .bg-image-con{
    background-image: url('https://source.unsplash.com/random/1920x1080');
    background-size: cover;
    position: fixed;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;
  }
</style>



