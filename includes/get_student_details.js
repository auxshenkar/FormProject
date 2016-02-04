var hasSpecialist = 0;   // for first run only of the student
var path = "images/uploads/";
var showImageNumber = 1;
var pathFolder = ["profile/","standpicture/","projectpicture/","projectpicture/","projectpicture/"];
var pathEnd = ["profile.jpg","standpicture.jpg","projectpicture1.jpg","projectpicture2.jpg","projectpicture3.jpg"];
var name,id;

function getStudentDetails() {
	var aKeyValue = window.location.search.substring(1).split("&");   // the string after ?  studentId=305016792 
	var studentId = aKeyValue[0].split("=")[1];
	 $.get("getStudentDetails.php?studentId="+studentId, function(data, status){
	            showData(data);
	        });
};

function showData(data){
	oneCheckBoxOn();
	document.getElementById('studentName').value = data.split("+-+")[0];
	name = data.split("+-+")[0];
	document.getElementById('id').value = data.split("+-+")[1];
	id = data.split("+-+")[1];
	document.getElementById('mail').value = data.split("+-+")[2];
 
	 var checkboxes = $("input:checkbox");
 	 var specialist = 0;
 	 for(var i=3;i<8;i++){
 		specialist = data.split("+-+")[i];
 		if (specialist == 1){
 			checkboxes[i-3].checked = true; 
 			hasSpecialist=1;
 		}
 	 }
 	 
	document.getElementById('gitHub').value = data.split("+-+")[8];
	document.getElementById('quote').value = data.split("+-+")[9];
	document.getElementById('linkedin').value = data.split("+-+")[10];
	document.getElementById('url').value = data.split("+-+")[11];
 	// if first time student get in form the send button will not be clicked until he checks 1 specialist
 	if(hasSpecialist == 0){          
 				var submitButt = $("input[type='submit']");
 				submitButt.attr("disabled", !checkboxes.is(":checked"));
 	}
	var allTypeFiles = $("input:file");
	var fileIndex = 12;
	for (var i=1;i<6;i++){
		if(data.split("+-+")[fileIndex++] == "false"){
			document.getElementById('pictureUpload'+i).style.display = "none";
				showPicture(fileIndex-12-1);
				
		}
	}
	if( data.split("+-+")[17]== "false")
 		document.getElementById('cvLabel').style.display = "none";
 	
}
function showPicture(number){
	var image = document.createElement('section');
    image.className = "pictureBox" + showImageNumber++; 
    document.getElementsByTagName('main')[0].appendChild(image);
    //alert(number);
    var a = document.createElement('a');
    var newpath = ""+path+pathFolder[number]+id+pathEnd[number];
  	a.setAttribute("href", newpath);
  	a.setAttribute("data-lightbox","image-1");
  	a.setAttribute("data-title",name);
     image.appendChild(a);
     
     var img = document.createElement('img');
     img.setAttribute("src", newpath);
     img.className = "picture";
     a.appendChild(img);
}
//	<a href="images/hadas.png" data-lightbox="image-1" data-title="My caption">Image #1
	//<img src="images/hadas.png"> /></a>

function oneCheckBoxOn(){      // disable send button if user didnt check any specialist
	var checkboxes = $("input[type='checkbox']"),
    submitButt = $("input[type='submit']");
	checkboxes.click(function() {
    submitButt.attr("disabled", !checkboxes.is(":checked"));  
});
}
