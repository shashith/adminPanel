"use strict";

var login = function(userName, passWord) {
    $.ajax('http://localhost/adminPanel/index.php/login/authenticate', {
      success: function(data) {
            console.log("success" + data);
      },
      error: function() {
            console.log("failure" + data);
      }
   });
}
