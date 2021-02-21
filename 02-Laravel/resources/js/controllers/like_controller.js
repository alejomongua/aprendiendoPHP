import { Controller } from "stimulus"

export default class extends Controller {
  static targets = [
    'icon',
    'text',
  ]
  static values = {
    url: String,
  }

  async likeAction () {
    try {
      const response = await fetch(this.urlValue);
      this.iconTarget.classList.toggle('hidden')
      this.textTarget.innerText = this.textTarget.innerText === 'Like' ? 'Unlike' : 'Like'
    } catch (e) {
      console.error(e);
    }
  }
}