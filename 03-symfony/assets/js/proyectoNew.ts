// Controlador para la creación de un proyecto

export class SelectorFecha {
    input: HTMLInputElement
    calendario: HTMLDivElement
    currentDate: number
    currentMonth: number
    currentYear: number

    constructor(input: string, calendario: string) {
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

        this.draw()
    }

    draw() {
        const crearDiv = (padre: HTMLElement, opciones?: {
            contenido?: string,
            clase?: string,
        }) => {
            const newDiv = document.createElement('div')
            if (opciones?.clase) {
                newDiv.setAttribute('class', opciones.clase)
            }
            if (opciones?.contenido) {
                newDiv.innerHTML = opciones.contenido
            }
            padre.appendChild(newDiv)
        }

        const currenDateClass = (num: number): string => {
            const calenderFullDate = new Date(
                this.currentYear,
                this.currentMonth,
                num
            ).toDateString();
            const currentFullDate = new Date().toDateString();
            return calenderFullDate === currentFullDate ? 'font-extrabold underline' : '';
        }
        // Al dia de la semana inicial del mes tengo que restarle uno porque empieza en domingo
        const startDay = (new Date(this.currentYear, this.currentMonth, 1).getDay() - 1) % 7
        const daysInMonth = new Date(this.currentYear, this.currentMonth + 1, 0).getDate()
        const monthLabel = <HTMLDivElement>this.calendario.querySelector('.currentMonth')
        const yearLabel = <HTMLDivElement>this.calendario.querySelector('.currentYear')
        const calendarDiv = <HTMLElement>this.calendario.querySelector('.calendar')

        calendarDiv.innerHTML = ''

        if (monthLabel === null || yearLabel === null) {
            return
        }

        monthLabel.innerText = this.currentMonthName()
        yearLabel.innerText = this.currentYear.toString()

        for (let i = 0; i < startDay; i++) {
            crearDiv(calendarDiv)
        }

        for (let i = 1; i <= daysInMonth; i++) {
            let clase = `text-center ${currenDateClass(i)}`

            crearDiv(calendarDiv, {
                contenido: i.toString(),
                clase: clase
            })
        }
    }

    siguienteMes() {
        if (this.currentMonth === 11) {
            this.currentMonth = 0;
            this.currentYear++;
        } else {
            this.currentMonth++;
        }
        this.draw()
    }

    anteriorMes() {
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
