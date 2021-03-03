// Controlador para la creación de un proyecto

export class selectorFecha {
    input: HTMLInputElement
    calendario: HTMLDivElement

    constructor(input: string, calendario: string) {
        this.input = <HTMLInputElement>document.getElementById(input)
        this.calendario = <HTMLDivElement>document.getElementById(calendario)

        if (this.input === null) {
            throw new Error(`No se encuentra el elemento ${input}`)
        }

        if (this.calendario === null) {
            throw new Error(`No se encuentra el elemento ${calendario}`)
        }
    }
}

export default () => {
    console.log('hello from proyectoNew')
}
