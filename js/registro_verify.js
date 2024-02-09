const urlParams= new URLSearchParams(window.location.search);
const errorParams=urlParams.get("error");

    
    if (errorParams == 1){
        var form= document.querySelectorAll(".input-form");
        form.forEach(form => form.style.borderBottom = "2px solid #8d0e0e");
        var cp_exist = document.querySelector(".cp_exist");
        document.querySelector(".cp_exist").innerHTML=`<img src='../images/atent.png' width='14px'> <span>Usuário ou email já existentes!</span>`
       
    }

