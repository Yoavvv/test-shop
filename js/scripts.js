// Script for adding textarea feature
tinymce.init({ selector:'textarea' });

$(document).ready(function() {
   // Script for selecting all checkboxes to be checked  
   $('#selectAllBoxes').click(function(event) {
      
       if(this.checked) {
           
           $('.checkBoxes').each(function() {
               
               this.checked = true;
           });
       
       } else {
           
           $('.checkBoxes').each(function() {
               
               this.checked = false;
           }); 
       }
       
   });    
    
    
// Script for loading screen effect    
var divBox = "<div id='load-screen'><div id='loading'></div></div>";
    
$("body").prepend(divBox);
    
$("#load-screen").delay(700).fadeOut(600, function() {
   
    $(this).remove();
    
});
   
});