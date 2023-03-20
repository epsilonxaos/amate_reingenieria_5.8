const axios = require('axios');
import { Orden } from './Orden';
import { DateTime } from 'luxon'

const orden = new Orden(PATH, EVENTOS, CUPONES);
const dt = DateTime.now();


const selectPersonas = document.getElementById('personas');
const wrapperPersonasCustom = document.getElementById('personasCustom');
const inputPrecio = document.getElementById('precio');
const inputPersonasCustom = document.getElementById('personas_custom');

const inputFecha = document.getElementById('fecha');
const inputHorario = document.getElementById('horario');

async function getPreciosEventos (ev) {
    const eventoID = this.value;
    if (!eventoID) return;
    const response = await orden.getPrecios(eventoID);
    const preciosxPersona = response.data
    orden.setListaPrecios(preciosxPersona)

    definirFechasHorario(eventoID)
    
    selectPersonas.innerHTML = '';
    let _HTML = '';

    _.forEach(preciosxPersona, precio => {
        _HTML += '<option value="'+precio.id+'">'+precio.personas+'</option>'
    });

    _HTML += '<option value="custom">Personalizado</option>';

    selectPersonas.innerHTML = _HTML;
    
    wrapperPersonasCustom.classList.add('d-none');
    inputPrecio.classList.add('pointer-events-none');
    inputPrecio.value = '';
    inputPersonasCustom.value = ''

    if(preciosxPersona.length > 0) inputPrecio.value = preciosxPersona[0].precio

    getInfoParaResumen()
}

function definirFechasHorario(eventoID) {
    let instance_fl = inputFecha._flatpickr;
    const evento = orden.getEvento(eventoID);
    inputFecha.classList.remove('fechasPicker24', 'fechasPicker48');
    inputHorario.classList.add('pointer-events-none');
    
    instance_fl.destroy();
    if(evento.tiempo_espera === '24') {
        inputFecha.classList.add('fechasPicker24')
    } else {
        inputFecha.classList.add('fechasPicker48')
    }
    reInitTimes();
    
    instance_fl = inputFecha._flatpickr;
    instance_fl.config.onChange.push(function(selectedDates, dateStr, instance) { getInfoParaResumen() } );

    inputHorario.value = evento.horario
    if(evento.horario_fijo === 0) {
        let time = orden.addHours(new Date(), parseInt(evento.tiempo_espera))
        let _time = new Date(time);
        inputHorario.classList.remove('pointer-events-none');
        inputHorario.value = _time.getHours() + ':00:00'
    }
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function getInfoParaResumen() {
    const eventoID = document.getElementById('evento_id').value;
    const precioID = selectPersonas.value;
    const evento = eventoID ? orden.getEvento(eventoID) : {};
    let objPrecio, personas, precio;
    let instance_fl = inputFecha._flatpickr;

    if(precioID !== 'custom') {
        objPrecio = precioID ? orden.getPrecioPorPersona(precioID) : {};
        precio = objPrecio.precio
        personas = objPrecio.personas
    } else {
        precio = inputPrecio.value
        personas = inputPersonasCustom.value
    }

    console.log(objPrecio)

    let fecha = instance_fl.altInput.value || '--';
    let horario = inputHorario.value || '--';

    document.getElementById('resumen_title').innerText = evento.title;
    document.getElementById('resumen_personas').innerText = personas;
    document.getElementById('resumen_precio').innerText = numberWithCommas(precio);
    document.getElementById('resumen_fecha').innerText = fecha;
    document.getElementById('resumen_horario').innerText = horario;
}

function getPrecioPorPersona(){
    const precioID = this.value;
    
    wrapperPersonasCustom.classList.add('d-none');
    inputPrecio.classList.add('pointer-events-none');
    inputPrecio.value = '';

    if(precioID === 'custom') {
        wrapperPersonasCustom.classList.remove('d-none');
        inputPrecio.classList.remove('pointer-events-none');

        return
    }

    const precio = orden.getPrecioPorPersona(precioID);
    inputPrecio.value = precio.precio;

    getInfoParaResumen()
}


document.getElementById('evento_id').addEventListener('change', getPreciosEventos)
document.getElementById('personas').addEventListener('change', getPrecioPorPersona)
document.getElementById('precio').addEventListener('change', getInfoParaResumen)
document.getElementById('personas_custom').addEventListener('change', getInfoParaResumen)
document.getElementById('horario').addEventListener('change', getInfoParaResumen)