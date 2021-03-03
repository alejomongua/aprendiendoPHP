import proyectoNew from './proyectoNew'

document.addEventListener('DOMContentLoaded', function () {
    const jsController = document.querySelector('body')?.dataset.javascript

    if (jsController === 'proyectoNew') {
        proyectoNew()
    }
})
