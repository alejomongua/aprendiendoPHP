import { crearDiv } from './utilidades'

export default (etiquetasTag: HTMLInputElement, etiquetasSeleccionadas: HTMLDivElement) => {
    let valorActual: string[] = []
    try {
        valorActual = JSON.parse(etiquetasTag.value || '[]')
    } catch (c) {
    }

    valorActual.forEach((etiqueta: string) => {
        console.log(etiqueta)
        const tagDiv = crearDiv(etiquetasSeleccionadas, {
            clase: "flex m-2 p-2 border bg-green-400 text-gray-900",
        })
        crearDiv(tagDiv, {
            contenido: etiqueta
        })
        const eliminar = crearDiv(tagDiv, {
            contenido: 'X',
            clase: "border mx-2 px-2 eliminar-etiqueta",
        })
        eliminar.dataset.etiqueta = etiqueta
    })
}