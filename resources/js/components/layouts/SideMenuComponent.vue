<template>
  <nav id="sidebar" ref="sidebar" class="d-flex align-items-end flex-column">

      <!-- Sidebar Header -->
      <div class="sidebar-header text-center text-truncate w-100">
          <a href="/password/reset">
          <div class="profile-pic-con">
            <i class="fa fa-user fa-3x text-white mt-3"></i>
            <div class="user-settings-cog">
              <i class="fa fa-gear col-primary"></i>
            </div>
          </div>
          <h3 class="m-0 text-body">{{  username }}</h3>
          </a>
          <small class="text-black-50">{{ system }}</small>
          <hr>
      </div>    

      <div class="w-100 scroll-side-menu">
      <ul class="sidemenu-nav-ul unstyled">

        <li>
            <a href="/" class="text-body"><i class="fa fa-home"></i> Dashboard</a>
        </li>

          <li>
              <a href="#" class="text-body" v-on:click="toggleDropDown('homeSubmenu')">
                  <i class="fa fa-money"></i> Two Level <i class="fa fa-caret-down m-o tiny-text"></i>
              </a>
              <ul class="collapse list-unstyled mt-3" ref="homeSubmenu">
                  <li>
                      <a href="/" class="text-black-50">- Browse</a>
                  </li>
                  <li>
                      <a href="/" class="text-black-50">- Create</a>
                  </li>
                  <li>
                      <a href="/" class="text-black-50">- Report</a>
                  </li>
              </ul>
          </li>
       
          <li>
              <a href="/" class="text-body"><i class="fa fa-users"></i> Users</a>
          </li>

      </ul>
      </div>


    <!-- Sidebar Footer -->
    <div class="sidebar-footer l-height-1 text-center mt-auto w-100">           
        <hr>
        <small>              
          <span class="font-weight-bold">Support</span><br>
          <a href="mailto:zaid26@gmail.com" class="text-black-50">zaid26@gmail.com</a> <br><br>
          <span class="font-weight-bold">Website</span><br>
          <a href="https://niftybit.co.za" class="text-black-50">niftybit.co.za</a> <br><br>
          <span class="font-weight-bold">Copyright</span><br>
          <span class="text-black-50">NiftyBit (2018)</span>
        </small>
    </div>
  </nav>   
</template>

<script>
import { EventBus } from "../../event-bus.js";

export default {

  props: ['system'],

  data(){
    return{
      username: window.App.user.name 
    }
  },
  
  mounted() {
    EventBus.$on("side-menu-toggle", value => {
      this.$refs.sidebar.classList.toggle("active");
    });
  },

  methods: {
    toggleSideBar() {
      EventBus.$emit("side-menu-toggle");
    },

    toggleDropDown(ref){
       this.$refs[ref].classList.toggle("show");
    }
  }
};
</script>

<!-- SCSS -->
<style lang="scss" scoped>
@import "~@/_variables.scss";

#sidebar {
  position: fixed;
  width: 260px;
  min-height: 100vh;
  background: white;
  transition: all 0.3s;
  box-shadow: 5px 10px 5px #eee;
  z-index: 2000;
  

  .sidebar-header {
    padding: 30px;

    .profile-pic-con {
      background: $col-primary;
      height: 80px;
      width: 80px;
      margin: 0 auto 15px auto;
      border-radius: 40px;
      position: relative;

      .user-settings-cog {
        background: white;
        position: absolute;
        height: 26px;
        width: 26px;
        border-radius: 13px;
        bottom: 0;
        right: 5px;
        line-height: 26px;
        box-shadow: 2px 2px 2px #eee;
      }
    }

    hr {
      height: 2px;
      background-color: #f1f2f7;
      border: none;
    }
  }

  .sidebar-footer {
    padding: 30px;

    hr {
      height: 2px;
      background-color: #f1f2f7;
      border: none;
    }
  }

  .scroll-side-menu{
    overflow-y: auto;
  }

  .sidemenu-nav-ul {
    list-style: none;
    padding: 0 30px !important;

    li {
      margin-bottom: 15px;

      ul {
        margin-left: 45px;
      }
    }

    i {
      font-size: 21px;
      margin-right: 15px;
    }

    a:hover {
      text-decoration: none;
    }
  }
}

#sidebar.active {
  margin-left: -260px;
}

@media (max-width: 992px) {
  #sidebar {
    margin-left: -260px;
  }
  #sidebar.active {
    margin-left: 0;
  }
}
</style>
