export default {
  methods: {
    loadStyleSheets: function(cssGroup) {
      // alert(cssGroup);
      var cssScripts = {
        common: [
          base_url + "/css/bootstrap.min.css",
          "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css",
          "https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        ],
        user: [
          base_url + "/css/style.css",
          base_url + "/css/home.css",
          base_url + "/css/app.css"
        ],
        controller: [
          base_url + "/css/sb-admin-2.min.css",
          base_url + "/css/app.css"
        ],
        user_login: [
          base_url + "/css/style.css",
          base_url + "/css/home.css",
          base_url + "/css/app.css"
        ],
        controller_login: [base_url + "/css/app.css"],
        user_summernote: [
          base_url + "/css/style.css",
          "https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css",
          base_url + "/css/app.css"
        ],
        controller_summernote: [			
          base_url + "/css/sb-admin-2.min.css",
          "https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css",
          base_url + "/css/app.css"
        ]
      };

      var allowedScripts = cssScripts["common"];
      var count = allowedScripts.length;
      for (var i = 0; i < cssScripts[cssGroup].length; i++) {
        allowedScripts[count + i] = cssScripts[cssGroup][i];
      }

      //disabling those styles which are not needed(removing will not work, since browser would keep those in memory)
      for (var i = 0; i < document.styleSheets.length; i++) {
        var styleSheet = document.styleSheets[i];
        var isFound = false;
        for (var j = 0; j < allowedScripts.length; j++) {
          if (allowedScripts[j] == styleSheet.href) {
            isFound = true;
            break;
          }
        }
        if (!isFound) {
          document.styleSheets[i].disabled = true;
        }
      }
      //now have to add those which are yet to be added
      for (var i = 0; i < allowedScripts.length; i++) {
        var isFound = false;
        for (var j = 0; j < document.styleSheets.length; j++) {
          if (allowedScripts[i] == document.styleSheets[j].href) {
            if (document.styleSheets[j].disabled) {
              //if found as disabled
              document.styleSheets[j].disabled = false;
            }
            isFound = true;
            break;
          }
        }
        if (!isFound) {
          var styleElement = document.createElement("link");

          styleElement.setAttribute("type", "text/css");
          styleElement.setAttribute("rel", "stylesheet");
          document.styleSheets[i].disabled = true;
          styleElement.setAttribute("href", allowedScripts[i]);
          document.getElementsByTagName("head")[0].appendChild(styleElement);
        }
      }
    },

    loadJsScripts: function(jsGroup) {
      // alert(jsGroup);

      var jsScripts = {
        common: [
          base_url + "/js/jquery.min.js",
          base_url + "/js/popper.js",
		  base_url + "/js/bootstrap.bundle.min.js",
        ],
        user: [],
        controller: [base_url + "/js/sb-admin-2.min.js"],
        user_login: [],
        controller_login: [],
        user_summernote: [
          base_url + "/js/summernote-bs4.min.js",
          base_url + "/js/summernote-fontawesome.js"
        ],
        controller_summernote: [
          base_url + "/js/sb-admin-2.min.js",
          base_url + "/js/summernote-bs4.min.js",
          base_url + "/js/summernote-fontawesome.js",
        ]
      };
      var allowedScripts = jsScripts["common"];
      var count = allowedScripts.length;
      for (var i = 0; i < jsScripts[jsGroup].length; i++) {
        allowedScripts[count + i] = jsScripts[jsGroup][i];
      }

	  //disabling those scripts which are not needed(removing will not work, since browser would keep those in memory)
      for (var i = 0; i < document.getElementsByTagName("script").length; i++) {
        var existingScripts = document.getElementsByTagName("script")[i];
        console.log("Existing: " + existingScripts.src);
        var isFound = false;
        for (var j = 0; j < allowedScripts.length; j++) {
          if (allowedScripts[j] == existingScripts.src) {
            isFound = true;
            break;
          }
        }
        if (!isFound) {
          document.getElementsByTagName("script")[i].remove();
        }
      }
	  //   now have to add those which are yet to be added
	  
      for (var i = 0; i < allowedScripts.length; i++) {
        var isFound = false;
        for ( var j = 0;j < document.getElementsByTagName("script").length;j++) {
          if ( allowedScripts[i] == document.getElementsByTagName("script")[j].src ) {
            isFound = true;
            break;
          }
        }
        if (!isFound) {			
          var script = document.createElement("script");
          script.type = "text/javascript";
          script.onload = function () {
            $('#summernote_div').summernote({
              height: 300,
              minHeight: null,
              maxHeight: null,
              focus: true
            });              
          };
          script.src = allowedScripts[i];          
          document.getElementsByTagName("script")[0].parentNode.appendChild(script);
        }
      }
    }
  }
};
