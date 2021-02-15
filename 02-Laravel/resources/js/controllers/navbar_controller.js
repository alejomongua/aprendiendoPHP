import { Controller } from "stimulus"

export default class extends Controller {
  static targets = [
    'mainMenu',
    'open',
    'close',
    'loginMenu',
  ]

  toggle () {
    this.openTarget.classList.toggle('hidden')
    this.closeTarget.classList.toggle('hidden')
    this.mainMenuTarget.classList.toggle('hidden')
  }

  toggleLoginMenu () {
    this.loginMenuTarget.classList.toggle('hidden')
  }
}