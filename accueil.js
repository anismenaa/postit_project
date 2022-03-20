let prenom = document.getElementById("prenom")
let nom = document.getElementById("nom")
let date_naissance = document.getElementById("date_naissance")
let email = document.getElementById("email")
let password = document.getElementById("password")
let confirmation = document.getElementById("confirmation")
let btn = document.getElementById("inscription-btn")
// check if the input is all letters
function allLetter(inputtxt) {
   var letters = /^[A-Za-z]+$/;
   if(inputtxt.match(letters)){
    return true;
   }
   else{
     return false;
    }
  }
  

// enables nom input
prenom.addEventListener('keyup', (event)=>{
   let nom = document.getElementById("nom")
   let error_area = document.getElementById("error_letter1")
   if(event.target.value!=''){
       console.log(event.target.value)
       if(allLetter(event.target.value)){
            nom.disabled = false;
           error_area.innerHTML=""
       }else{
           error_area.innerHTML = "prenom must contain only letters"
           nom.disabled = true;
       }
   }else{
       nom.disabled = true;
   }
})

// enables date_naissance input
nom.addEventListener('keyup', (event)=>{
    let date_naissance = document.getElementById("date_naissance")
    let error_area = document.getElementById("error_letter2")
    if(event.target.value!=''){
        if(allLetter(event.target.value)){
         date_naissance.disabled = false;
         error_area.innerHTML="";
        }else{
            error_area.innerHTML = "nom must contain only letters"
            date_naissance.disabled = true;
        }
    }else{
        date_naissance.disabled = true;
    }
 })

// enables email input 
date_naissance.addEventListener('change', (event)=>{
    let email = document.getElementById("email")
    if(event.target.value!=''){
        email.disabled = false;
    }else{
        email.disabled = true;
    }
 })

 // enables password input
 const validateEmail = (email) => {
    return email.match(
      /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
  };

 email.addEventListener('keyup', (event)=>{
    let password = document.getElementById("password")
    let error_email = document.getElementById("error_email")
    if(event.target.value!=''){
        if(validateEmail(event.target.value)){
            password.disabled = false
            error_email.innerHTML = ""
        }else{
            // we put the error! 
            error_email.innerHTML = "it does not respect the email format"
            password.disabled = true
        }
    }else{
        password.disabled = true
    }
 })

 // enables confirmation input
  password.addEventListener('keyup', (event)=>{
    let confirmation = document.getElementById("confirmation")
    let pass_error = document.getElementById("error_password")
    if(event.target.value!=''){
        let pass = event.target.value
        if(pass.length>=6){
            confirmation.disabled = false
            pass_error.innerHTML = ""
        }else{
            pass_error.innerHTML = "password must contain at least 6 characters"
        }
        
    }else{
        confirmation.disabled = true
    }
 })

 // enables the inscription btn
 confirmation.addEventListener('keyup', (event)=>{
     let btn = document.getElementById("inscription-btn")
     let error_confirmation = document.getElementById("error_confirmation")
     let password = document.getElementById("password")
     if(event.target.value!=''){
         if(event.target.value===password.value){
            error_confirmation.innerHTML = ""
            btn.disabled = false
            confirmation.style.color = "green"
         }else{
             error_confirmation.innerHTML = "confirmation password doesn't match !"
             confirmation.style.color = "red"
             btn.disabled = true
         }
        
    }else{
        btn.disabled = true
        confirmation.style.color = "red"
    }
 })