// Controlador para la creación de un proyecto

export class SelectorFecha {
    input: HTMLInputElement
    calendario: HTMLDivElement
    currentDate: number
    currentMonth: number
    currentYear: number

    constructor(input: string, calendario: string) {
        console.log('instanciando')
        this.input = <HTMLInputElement>document.getElementById(input)
        this.calendario = <HTMLDivElement>document.getElementById(calendario)
        const botonMesAnterior = <HTMLButtonElement>this.calendario.querySelector('.mesAnterior')
        const botonMesSiguiente = <HTMLButtonElement>this.calendario.querySelector('.mesSiguiente')

        if (this.input === null) {
            throw new Error(`No se encuentra el elemento ${input}`)
        }

        if (this.calendario === null) {
            throw new Error(`No se encuentra el elemento ${calendario}`)
        }

        if (botonMesAnterior === null) {
            throw new Error(`No se encuentra el elemento mesAnterior`)
        }

        if (botonMesSiguiente === null) {
            throw new Error(`No se encuentra el elemento mesSiguiente`)
        }

        let selectedDate = new Date()
        if (this.input.value) {
            selectedDate = new Date(this.input.value)
        }
        this.currentDate = selectedDate.getUTCDate()
        this.currentMonth = selectedDate.getMonth()
        this.currentYear = selectedDate.getFullYear()

        botonMesAnterior.onclick = () => this.anteriorMes()
        botonMesSiguiente.onclick = () => this.siguienteMes()
    }

    draw() {
        const startDay = new Date(this.currentYear, this.currentMonth, 1).getDay();
        const monthLabel = <HTMLDivElement>this.calendario.querySelector('.currentMonth')
        const yearLabel = <HTMLDivElement>this.calendario.querySelector('.currentYear')
        if (monthLabel === null || yearLabel === null) {
            return
        }

        monthLabel.innerText = this.currentMonthName()
        yearLabel.innerText = this.currentYear.toString()
    }

    siguienteMes() {
        console.log('siguiente')
        if (this.currentMonth === 11) {
            this.currentMonth = 0;
            this.currentYear++;
        } else {
            this.currentMonth++;
        }
        this.draw()
    }

    anteriorMes() {
        console.log('anterior')
        if (this.currentMonth === 0) {
            this.currentMonth = 11;
            this.currentYear--;
        } else {
            this.currentMonth--;
        }
        this.draw()
    }

    currentMonthName(): string {
        const monthName = new Date(
            this.currentYear,
            this.currentMonth
        ).toLocaleString("default", { month: "long" });

        return monthName.charAt(0).toUpperCase() + monthName.slice(1)
    }
}

export default () => {
    const selectorInicio = new SelectorFecha('proyecto_inicio', 'selectorInicio')
    const selectorFin = new SelectorFecha('proyecto_fin', 'selectorFin')
}
