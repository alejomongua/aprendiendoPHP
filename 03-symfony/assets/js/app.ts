import etiquetas from './etiquetas'

document.addEventListener('DOMContentLoaded', function () {
    const etiquetasTag = <HTMLInputElement>document.querySelector('.etiquetas')
    const etiquetasSeleccionadas = <HTMLDivElement>document.querySelector('#etiquetas-seleccionadas')

    if (etiquetasTag && etiquetasSeleccionadas) {
        etiquetas(etiquetasTag, etiquetasSeleccionadas)
    }
})
