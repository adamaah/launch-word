import Block from './Block'

export default class Anchor extends Block {
  onEnterCompleted() {
    this.init()
  }

  getElems() {
    super.getElems()

    this.anchors = this.el.querySelectorAll('.anchor')
  }

  events() {
    super.events()

    for (let i = 0; i < this.anchors.length; i++) this.anchors[i].addEventListener('click', this.onClick.bind(this, i))
  }

  init() {
    window.scrollTo(0, 0)
    this.update()
    this.offset = 0
  }

  update() {
    this.items = []

    for (let i = 0; i < this.anchors.length; i++) {
      const el = document.querySelector(`${this.anchors[i].dataset.href}`)

      if (el) {
        const { top, bottom } = el.getBoundingClientRect()

        this.items[i] = {
          anchor: this.anchors[i],
          el,
          top: top + window.pageYOffset,
          bottom: bottom + window.pageYOffset
        }
      }
    }
  }

  onClick(index) {
    const { top } = this.items[index]

    if (top) {
      window.scrollTo({
        top: top - this.offset,
        behavior: 'smooth'
      })
    }
  }

  resize() {
    super.resize()

    this.init()
  }

  scroll() {
    super.scroll()

    if (!this.items) return

    for (let i = 0; i < this.items.length; i++) {
      const { top, bottom, anchor } = this.items[i]

      if (window.pageYOffset + (this.offset + 10) >= top && window.pageYOffset + this.offset <= bottom) !anchor.classList.contains('disabled') && anchor.classList.add('active')
      else anchor.classList.remove('active')
    }
  }
}
