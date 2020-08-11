<template>
    <div>
        <div class="row">
            <div class="post-topbar">
              <p class="text-center h4">Account Setting</p>
         </div>  
         <div class="post-bar">
            <form>
                <div class="notbar">
                    <h4>Notification Sound</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium nulla quis erat dapibus, varius hendrerit neque suscipit. Integer in ex euismod, posuere lectus id</p>
                    <div class="toggle-btn">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                    </div>
                </div><!--notbar end-->
                <div class="notbar">
                    <h4>Notification Email</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium nulla quis erat dapibus, varius hendrerit neque suscipit. Integer in ex euismod, posuere lectus id</p>
                    <div class="toggle-btn">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch2">
                            <label class="custom-control-label" for="customSwitch2"></label>
                        </div>
                    </div>
                </div><!--notbar end-->
                <div class="notbar">
                    <h4>Chat Message Sound</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium nulla quis erat dapibus, varius hendrerit neque suscipit. Integer in ex euismod, posuere lectus id</p>
                    <div class="toggle-btn">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch3">
                            <label class="custom-control-label" for="customSwitch3"></label>
                        </div>
                    </div>
                </div><!--notbar end-->
                <div class="save-stngs">
                    <ul>
                        <li><button type="submit">Save Setting</button></li>
                        <li><button type="submit">Restore Setting</button></li>
                    </ul>
                </div><!--save-stngs end-->
             </form>                
        </div> 
        </div>                    
    </div>
</template>

<script>
export default {
    name: 'AccountSetting',
    data() {
     return { 
        name:"",
      };
  },

  methods: {
     
  }
}
</script>