(function(){
emailjs.init("user_8JJiyNEO907YrsrhqL1Df");
})();
const enviarEmail=()=>{
    let to_name= document.getElementById('name');
    let to_email=document.getElementById('email');
    let message=document.getElementById('message');
    let subject=document.getElementById('subject');
    if(message.value!=''&&subject.value!=''){
        let data = {
            to_name:to_name.value,
            to_email:to_email.value,
            message:message.value,
            subject:subject.value,
        };
        emailjs.send("service_y6pjh9n","template_x6htn7n", data)
        .then(function(response) {
            if(response.text === 'OK'){
                Toast.fire({
                    icon: 'success',
                    title: 'El correo se ha enviado de forma exitosa'
                })
            }
            console.log("SUCCESS. status=%d, text=%s", response.status, response.text);
        }, function(err) {
            Toast.fire({
            icon: 'error',
            title: 'Ocurrió un problema al enviar el correo'
            });
            console.log("FAILED. error=", err);
        });
    }else{
        Toast.fire({
            icon: 'error',
            title: 'Debdes llenar los campos mensaje y asunto'
        });
    }
    message.value=''
    subject.value=''
}
$(function () {
    //Add text editor
    $('#message').summernote()
})

