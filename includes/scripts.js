// if last checkbox is checked all other checkbox is unchecked
function onclickCheckBox(){
	document.getElementById("noSpecalise").onclick = function() {
	    if ( this.checked ) {
	    	this.value = 1;
	      var inputs = document.getElementsByTagName("input");
	      var sum=0;
	      var numbers = inputs.length;
	      for (var i = 0; i < numbers; i++) {
	  			if (inputs[i].type == "checkbox") {
	      			inputs[i].checked = false;
	      			sum++;		
	    		}
	    			if(sum==4) break;
		   };
		}
		};
	}

// get all checkbox an add them event to remove last check box if any of them checked
function removeCheckBoxAll(){          
		var inputs = document.getElementsByTagName("input");
   	    var sum=0;
        var numbers = inputs.length;
        for (var i = 0; i < numbers; i++) {
  			if (inputs[i].type == "checkbox") {
      			inputs[i].onclick = function(){
      				document.getElementById("noSpecalise").checked = false;
      			};
      			sum++;		
    		}
    			if(sum==4) break;
		};
			
}
		