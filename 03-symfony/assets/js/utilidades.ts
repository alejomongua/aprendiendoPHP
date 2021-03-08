export const crearDiv = (padre: HTMLElement, opciones?: {
    contenido?: string,
    clase?: string,
}): HTMLDivElement => {
    const newDiv = document.createElement('div')
    if (opciones?.clase) {
        newDiv.setAttribute('class', opciones.clase)
    }
    if (opciones?.contenido) {
        newDiv.innerHTML = opciones.contenido
    }
    padre.appendChild(newDiv)
    return newDiv
}