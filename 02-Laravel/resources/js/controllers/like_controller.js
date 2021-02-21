import { Controller } from "stimulus"

export default class extends Controller {
  static targets = [
    'icon',
    'text',
    'conteo',
    'plural',
  ]
  static values = {
    url: String,
  }

  async likeAction () {
    try {
      const response = await fetch(this.urlValue);
      this.iconTarget.classList.toggle('hidden')
      if (this.textTarget.innerText === 'Like') {
        this.textTarget.innerText = 'Unlike'
        this.conteoTarget.innerText = parseInt(this.conteoTarget.innerText, 10) + 1
      } else {
        this.textTarget.innerText = 'Like'
        this.conteoTarget.innerText = parseInt(this.conteoTarget.innerText, 10) - 1
      }
      this.pluralTarget.innerText = parseInt(this.conteoTarget.innerText, 10) === 1 ? 'like' : 'likes'
    } catch (e) {
      console.error(e);
    }
  }
}