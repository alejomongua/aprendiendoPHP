import { Controller } from "stimulus"

export default class extends Controller {
  static targets = [
    'image',
    'input',
    'placeholder',
    'submit',
  ]

  render () {
    if (this.inputTarget.files && this.inputTarget.files[0]) {
      var reader = new FileReader();

      reader.onload = e => {
        this.imageTarget
          .setAttribute('src', e.target.result);
        this.imageTarget
          .classList.remove('hidden')
        this.placeholderTarget
          .classList.add('hidden')
        this.submitTarget
          .classList.add('hidden')
      };

      reader.readAsDataURL(this.inputTarget.files[0]);
    }
  }
}