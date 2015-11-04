jQuery(document).ready(function(){

    jQuery("#showimages").click(function(){
        
        console.log(jQuery("#image-fold").css("height"));
        
        if (jQuery("#image-fold").css("height") != "250px"){
            jQuery("#image-fold").css("height", "250px");
        }
        else{
            jQuery("#image-fold").css("height", "100%");
        }
        
    });

});