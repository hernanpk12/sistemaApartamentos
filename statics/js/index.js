const detailApartment= (data)=>{
    console.log(data);
    let idApartamento = document.getElementById('id_apartamentpo');
    let cuota = document.getElementById('cuotaInput');
    let personas = document.getElementById('personasInput');
    let facturas = document.getElementById('facturas');
    let estado = document.getElementById('habitado');
    idApartamentpo='';
    cuota.value='';
    personas.value='';
    console.log();
    facturas.innerHTML=''
    data.forEach(element => {
        let pago;
        let mora;
        if(element.pago==1){
            pago=`<span class='text-success font-weight-bold'>SI</span><br>`;
        }else{
            pago=`<span class='text-danger font-weight-bold'>NO</span>`;
        }
        if(element.mora==0){
            mora=`<span class='text-danger font-weight-bold'>3%</span><br>`;
        }else{
            mora=`<span class='text-success font-weight-bold'>NO</span><br>`;
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
    idApartamento.value=data[0].id_apartamento;
    cuota.value=data[0].valor_cuota;
    personas.value=data[0].numero_personas;
    estado.value=data[0].arrendado;
    console.log();
}