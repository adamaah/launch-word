import Block from './Block'

export default class Form extends Block {
  onEnterCompleted() {
    super.onEnterCompleted()

    this.selectChange()
  }

  selectChange() {
    const selectElement = document.querySelectorAll('.gform_body select')

    selectElement.forEach((item) => {
      item.addEventListener('change', (event) => {
        if (event.target.value) item.style.color = 'rgba(53, 53, 53, 1)'
        else item.style.color = 'rgba(53, 53, 53, 0.5)'
      })
    })
  }
}
