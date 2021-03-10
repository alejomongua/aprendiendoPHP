import { crearDiv } from './utilidades'

export default (etiquetasTag: HTMLInputElement, etiquetasSeleccionadas: HTMLDivElement) => {
    const inputEtiqueta = <HTMLInputElement>document.getElementById("etiqueta-nueva")
    const buttonAddEtiqueta = <HTMLButtonElement>document.getElementById("agregar-etiqueta")

    if (!inputEtiqueta || !buttonAddEtiqueta) {
        return
    }


    let valorActual: string[] = []
    try {
        valorActual = JSON.parse(etiquetasTag.value || '[]')
    } catch (c) {
    }

    const dibujarEtiquetas = () => {
        etiquetasSeleccionadas.innerHTML = ''
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


    const agregarEtiqueta = (etiqueta: string) => {
        valorActual.push(etiqueta)

        // Elimine los duplicados
        valorActual = Array.from(new Set(valorActual))

        dibujarEtiquetas()
    }

    buttonAddEtiqueta.addEventListener('click', () => {
        if (!inputEtiqueta.value) {
            return
        }

        agregarEtiqueta(inputEtiqueta.value)
        inputEtiqueta.value = ''
        buttonAddEtiqueta.setAttribute('disabled', 'disabled')
    })

    inputEtiqueta.addEventListener('keydown', () => {
        if (inputEtiqueta.value) {
            buttonAddEtiqueta.removeAttribute('disabled')
        } else {
            buttonAddEtiqueta.setAttribute('disabled', 'disabled')
        }
    })
}