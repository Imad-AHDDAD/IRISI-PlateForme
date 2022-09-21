window.addEventListener("DOMContentLoaded" , ()=>{

   // verifier le nom
   nom = document.getElementById("nom");
   nom.addEventListener("input" , function(){
      check("nom",3);
   })

   // verifier le prenom
   prenom = document.getElementById("prenom");
   prenom.addEventListener("input" , function(){
      check("prenom",3);
   })

   // verifier le CNE
   cne = document.getElementById("cne");
   cne.addEventListener("input" , function(){
      check("cne",10);
   })

   // verifier l'apogee
   apogee = document.getElementById("apogee");
   apogee.addEventListener("input" , function(){
      check("apogee",7);
   })

   // verifier l'email
   email = document.getElementById("email");
   email.addEventListener("input" , checkEmail);

   // envoyer le formulaire
   send = document.getElementById("envoyer");
   send.addEventListener("click", function(e){
      sendClicked(e);
   } );

})


// la fonction qui verifie le nom , le prenom , le cne et l'apogee

function check(id , nbr){
   elem = document.getElementById(id);
   if(elem.value.length < nbr){
      elem.classList.remove("valid");
      elem.classList.add("invalid");
      document.getElementById("error_"+id).style.display="block";
   }else{
      document.getElementById("error_"+id).style.display="none";
      elem.classList.remove("invalid");
      elem.classList.add("valid");
   }
}


// la fonction qui verifie l'email par une regex

function checkEmail(){
   let validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
   email = document.getElementById("email");
   if(email.value.match(validRegex)){
      document.getElementById("error_email").style.display="none"
      email.classList.remove("invalid");
      email.classList.add("valid");
   }else{
      email.classList.remove("valid");
      email.classList.add("invalid");
      document.getElementById("error_email").style.display="block"
   }
}

// la fonction sendClicked

function sendClicked(e){
   let ind = 0;
   let inputs = document.getElementsByTagName("input");
   let errors = document.getElementsByClassName("error");
   for (let i = 0 ; i<inputs.length ; i++){
      if(inputs[i].classList.contains("valid")){
         ind++;
      }else{
         inputs[i].classList.add("invalid");
         inputs[i].classList.remove("valid");
         errors[i].style.display="block";
      }
   }

   if(ind != 5){
      e.preventDefault();
   }
}