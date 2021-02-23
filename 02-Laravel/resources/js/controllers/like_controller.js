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
      const payload = await response.json()
      this.iconTarget.classList.toggle('hidden')
      if (this.textTarget.innerText === 'Like') {
        this.textTarget.innerText = 'Unlike'
      } else {
        this.textTarget.innerText = 'Like'
      }
      this.conteoTarget.innerText = payload.likes
      this.pluralTarget.innerText = payload.likes === 1 ? 'like' : 'likes'
    } catch (e) {
      console.error(e);
    }
  }
}