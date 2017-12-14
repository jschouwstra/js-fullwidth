//works
if (typeof jQuery != 'undefined') {
    //jQuery is loaded => print the version
    alert(jQuery.fn.jquery);
    jQuery(document).ready(function () {
            alert("document is ready");
        }
    );
}

// $(document).ready(function(){
//    alert("test");
// });