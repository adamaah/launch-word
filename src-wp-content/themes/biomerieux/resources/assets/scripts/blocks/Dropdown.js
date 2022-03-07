import Block from './Block'
import gsap from 'gsap'

export default class Dropown extends Block {
  getElems() {
    this.items = this.el.querySelectorAll('.dropdown__item')
    this.heads = this.el.querySelectorAll('.dropdown__head')
    this.contents = this.el.querySelectorAll('.dropdown__content')
  }

  events() {
    for (let i = 0; i < this.heads.length; i++) {
      this.heads[i].addEventListener('click', this.onHeadClick.bind(this, i))
    }

    this.open(0)
  }

  onHeadClick(index) {
    if (this.isOpen) this.close(index)
    else this.open(index)
  }

  open(index) {
    if (this.isOpen) return

    this.activeIndex = index
    this.items[index].classList.add('active')
    this.contents[index].style.height = 'auto'

    const height = this.contents[index].clientHeight + 'px'

    this.contents[index].style.height = '0px'

    gsap.to(this.contents[index], {
      height,
      duration: 0.4,
      ease: 'expo.out'
    })

    this.isOpen = true
    this.oldIndex = index
  }

  close(index) {
    this.items[this.activeIndex].classList.remove('active')

    gsap.to(this.contents[this.activeIndex], {
      height: 0,
      duration: 0.4,
      ease: 'expo.out',
      onComplete: () => {
        this.isAnimating = false
      }
    })

    this.isOpen = false

    if (index !== this.activeIndex) {
      this.open(index)
    }
  }
}
