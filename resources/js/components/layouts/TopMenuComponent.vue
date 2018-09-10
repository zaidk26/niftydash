<template>
    <div id="nav-top" >
        <div class="container-fluid">
          <div class="row">
            <div class="col">              
              <i class="fa fa-bars fa-2x pointer d-lg-none" v-on:click="toggleSideBar()"></i> 
            </div>
            <div class="col text-right">
              <i class="fa fa-bell fa-2x pointer"></i> 
              <i class="fa fa-sign-out pointer ml-3 fa-2x" v-on:click="signOut()"></i>
              <i class="fa fa-expand ml-3 fa-2x pointer" v-on:click="toggleFullScreen()"></i> 
            </div>
          </div>
        </div>
      </div>   
</template>

<script>

import { EventBus } from '../../event-bus.js';

export default {  
  
  methods: {

    toggleSideBar(){
      EventBus.$emit('side-menu-toggle','');
    },

    toggleFullScreen() {
      if (
        (document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)
      ) {
        if (document.documentElement.requestFullScreen) {
          document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
          document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
          document.documentElement.webkitRequestFullScreen(
            Element.ALLOW_KEYBOARD_INPUT
          );
        }
      } else {
        if (document.cancelFullScreen) {
          document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen();
        }
      }
    },

    signOut(){
      window.axios.post('/logout')
       .catch((error) => {})
       .then( () => {
           window.location.replace("/login");  
        });
    }
  }
};
</script>

<style lang="scss" scoped>
@import "~@/_variables.scss";

#nav-top{
  height: 60px;
  padding-top: 16px;
  border-bottom: solid 1px #DDD;
}
</style>
