import axios from 'axios';

export class Orden {
    constructor(path, eventos, cupones) {
        this.path = path;
        this.eventos = eventos;
        this.cupones = cupones;
        this.listaPrecios = null
    }

    async getPrecios (id) {
        const response  = await axios.get(this.path + 'admin/ventas/' +id + '/precios');
        return response
    }

    setListaPrecios (precios) {
        this.listaPrecios = precios
    }

    getPrecioPorPersona(id) {
        return _.find(this.listaPrecios, precio => precio.id == id);
    }

    getEvento(id) {
        return _.find(this.eventos, evento => evento.id == id)
    }

    addHours(date, hours) {
        date.setTime(date.getTime() + hours * 60 * 60 * 1000);
      
        return date;
    }

    getCupon(id) {
        return _.find(this.cupones, cupon => cupon.id == id)
    }
}
