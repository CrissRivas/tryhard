const correo = document.getElementById('correo');
const form = document.getElementById('pagina');

console.log("En el app.js!");

const feeWifiBtn = document.getElementById('liberar');
const redirectBtn = document.getElementById('pagina');
let newemail = '';

form.addEventListener ('submit', e => {
     e.preventDefault();
     db.collection('BD NMP').add({
         email: form.email.value
     })
     form.email.value = '';
 })

 function sendInfo()
{
    if(correo.value == "")
    {
    correo.value = "default@nomail.com"
    }
    db.collection('BD NMP').add({
    email: correo.value,
    opcion
    });
    correo.value = "";
}

feeWifiBtn.addEventListener('click', e => {

    sendInfo();
    // var formData = new FormData(document.getElementById('form1'));
    // formData.append("opc", opcion);
    // $.ajax({
    //     type: "post",
    //     url: "insertadatos.php",
    //     data: formData,
    //     processData: false, //prevents jQuery from converting formData to a string
    //     contentType: false, //prevents jQuery from setting a content-type header
    //     success: function(response) {
    //       console.log(`Almacenado en BD: ${response}`);
    //       redirect();
    //     },
    //     error: function(xml, status, error) {
    //       console.log(`Error al insertar datos ${error}`);
    //     }
    // });
    
    redirect();
});

redirectBtn.addEventListener('click', e => {
    sendInfo();
    location.replace("https://www.montepiedad.com.mx/tuempenogana/?utm_source=pbwifi&utm_medium=off&utm_campaign=tuempenogana&utm_id=vacaciones&utm_term=vacaciones+dinero+rapido&utm_content=nacionalmontedepiedad");
  });

//funcion de redireccion
function redirect()
{
    if(folio!==undefined)
    {
        window.location.href = 'wifi.html?id='+param['id']+"&folio="+folio+"&model="+param['model'];
    }
    else
    {
        console.log("Error, no hay identificador o folio");
    }
}