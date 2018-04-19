localStorage.removeItem("AlreadyOpen");


function insertformblock(btn){
    console.log(localStorage.getItem("AlreadyOpen"))
    if ( localStorage.getItem("AlreadyOpen") != 1 ){
        //if ( !jQuery(".call2action-mobile-1 #astrocentro-br-landing-blogform-form--2") ){
        var block = document.getElementById("block-astrocentro-br-app-astrocentro-br-landing-blogform").innerHTML;
        var parent = btn.parentNode;
        //block =
        //"<div id='popup'>" +
        //      "<input type='text' placeholder='Nome'>" +
        //      "<input type='email' placeholder='Email'>" +
        //      "<input type='number' placeholder='Celular'>" +
        //      "<button type='submit'>Confirmar dados</button>" +
        //  "</div>"

	   parent.innerHTML += block;
        localStorage.setItem("AlreadyOpen", 1);
    }
}


function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
}


function remove_box_if_already_registered(){
    var cook = document.cookie;
    var search = getCookie("AlreadyRegistered")
    var body = document.getElementsByClassName("html")[0].innerHTML;
    console.log(body)
    var position = body.indexOf('anjos');
    console.log("anjos: " + position)
    
    if ( position != -1 && search == 1){
        jQuery("#call2action-mobile-1 ").remove();
    }
}

remove_box_if_already_registered();