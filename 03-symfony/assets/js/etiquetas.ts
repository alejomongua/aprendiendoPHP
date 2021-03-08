export default (etiquetasTag: HTMLInputElement, etiquetasSeleccionadas: HTMLDivElement) => {
    const valorActual: string[] = []
    try {
        const valorActual = JSON.parse(etiquetasTag.value || '[]')
    } catch (c) {
    }

    valorActual.forEach((etiqueta: string) => {
        // Agregar etiquetas a la vista
    })
}