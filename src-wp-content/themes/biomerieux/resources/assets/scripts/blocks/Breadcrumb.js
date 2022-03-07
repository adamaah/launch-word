import Block from './Block'

export default class Breadcrumb extends Block {
  getElems() {
    super.getElems()

    this.$wrapper = this.el.querySelector('#breadcrumbs > span > span')
  }

  events() {
    super.events()

    if (window.innerWidth < 768) this.$wrapper.scrollTo(1000, 0)
  }
}
