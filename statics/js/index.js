const detailApartment= (apartments,billing)=>{
    
    let idApartamento = document.getElementById('id_apartamentpo');
    let cuota = document.getElementById('cuotaInput');
    let personas = document.getElementById('personasInput');
    let facturas = document.getElementById('facturas');
    let estado = document.getElementById('habitado');
    let btnNotificacion=document.getElementById('notificacion');
    idApartamentpo='';
    cuota.value='';
    personas.value='';
    facturas.innerHTML=''
    billing.forEach(element => {
        let pago;
        let mora;
        if(element.pago==1){
            pago=`<span class='text-success font-weight-bold'>SI</span><br>`;
        }else{
            pago=`<span class='text-danger font-weight-bold'>NO</span>`;
        }
        if(element.mora==0){
            mora=`<span class='text-success font-weight-bold'>NO</span><br>`;
        }else{
            mora=`<span class='text-danger font-weight-bold'>3%</span><br>`;
        }
            let template=`            
                <div class="col-sm-12 col-md-6">
                <div class="small-box bg-light">
                <div class="inner">
                    <h4>Factura #${element.id_factura}</h4>
                    <p>
                    Apartamento ${element.numero_apartamento}<br>
                    <br>
                    Pago: ${pago}<br>  
                    Mora: ${mora}
                    Fecha de generación: ${element.fecha_creacion}<br>
                    total: ${element.total}$
                    </p>
                </div>
                <div class="icon">
                    <i class="fas fa-receipt"></i>
                </div>
                <a href="#" class="small-box-footer"  data-toggle="modal" data-target="#modal-detail-apartment">imprimir<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>`;
            facturas.innerHTML+=template
    });
    console.log(apartments);
    console.log(billing);
    idApartamento.value=apartments.id_apartamento;
    cuota.value=apartments.valor_cuota;
    personas.value=apartments.numero_personas;
    estado.value=apartments.arrendado;
    btnNotificacion.onclick=(e)=>{
        let email =document.getElementById('email');
        let name =document.getElementById('name');
        email.value='';
        name.value='';
        email.value=billing[0].email;
        name.value=billing[0].nombre;
    };
}

const detailPropietario=(apartments,propietario)=>{
    let sectionApartments=document.getElementById('apartments');
    let nombre = document.getElementById('nombreEdit');
    let apellidos = document.getElementById('apellidoEdit');
    let tipo_documento = document.getElementById('tipo_identificacionEdit');
    let identificacion = document.getElementById('identificacionEdit');
    let email = document.getElementById('emailEdit');
    let telefono = document.getElementById('telefonoEdit');
    let btnNotificacion=document.getElementById('notificacion');
    nombre.value='';
    apellidos.value='';
    tipo_documento.value='';
    identificacion.value='';
    email.value='';
    telefono.value='';
    //-------------------------
    nombre.value=propietario.nombre;
    apellidos.value=propietario.apellidos;
    tipo_documento.value=propietario.id_tipo_documento;
    identificacion.value=propietario.identificacion;
    email.value=propietario.email;
    telefono.value=propietario.telefono;
    //--------------------------
    sectionApartments.innerHTML=''
    apartments.forEach(element => {
        let estado;
        if(element.arrendado==1){
            estado=`<span class='text-primary font-weight-bold'>Arrendado</span><br>`;
        }else if(element.arrendado==2){
            estado=`<span class='text-primary font-weight-bold'>Dueño</span><br>`;
        }else if(element.arrendado==0){
            estado=`<span class='text-warning font-weight-bold'>Vacio</span><br>`;
        }
            let template=`            
                <div class="col-sm-12 col-md-6">
                    <div class="small-box bg-light">
                        <div class="inner">
                        <h4>Apartamento ${element.numero_apartamento}</h4>
                        <p>
                            ${estado}
                            <br>
                            Habitado: <?php echo($apartment['numero_personas']);?> personas
                            <br>
                            Cuota: <?php echo($apartment['valor_cuota']);?>$
                        </p>
                        </div>
                        <div class="icon">
                        <i class="fas fa-building"></i>
                        </div>
                        <a href="#" class="small-box-footer">mas información<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>`;
            sectionApartments.innerHTML+=template
    });
    btnNotificacion.onclick=(e)=>{
        let emailEnvio =document.getElementById('emailNotificacion');
        let nameEnvio =document.getElementById('name');
        // console.log(emailEnvio);
        // console.log(nameEnvio);
        emailEnvio.value=propietario.email;
        nameEnvio.value=propietario.nombre;
    };
}

const Toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
//,