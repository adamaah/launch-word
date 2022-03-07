import Block from './Block'
import SlideManager from '../util/SlideManager'
import gsap from 'gsap'

export default class ProcessSlider extends Block {
  onEnterCompleted() {
    super.onEnterCompleted()

    this.createSlider()
    this.init()
  }

  bindMethods() {
    super.bindMethods()

    this.nextSlide = this.nextSlide.bind(this)
    this.goTo = this.goTo.bind(this)
  }

  getElems() {
    super.getElems()

    this.$container = this.el.querySelectorAll('.row')
    this.$wrapper = this.el.querySelector('.b-ps__w')
    this.$images = this.$wrapper.querySelectorAll('.b-ps__i')
    this.$contents = this.el.querySelectorAll('.b-ps__c')
    this.$numbers = this.el.querySelectorAll('.b-ps__n .current')
    this.$dots = this.el.querySelectorAll('.b-ps__svg')
    this.$pagerRight = this.el.querySelector('.b-ps__ai')
    this.slides = []

    for (let i = 0; i < this.$images.length; i++) {
      this.slides[i] = {
        wrapper: this.$wrapper[i],
        image: this.$images[i],
        content: this.$contents[i],
        number: this.$numbers[i],
        dot: this.$dots[i]
      }
    }
  }

  events() {
    super.events()

    this.$pagerRight && this.$pagerRight.addEventListener('click', this.nextSlide)

    for (let i = 0; i < this.$dots.length; i++) this.slides[i].dot.addEventListener('click', this.goTo.bind(this, i))

    for (let i = 0; i < this.$images.length; i++) this.slides[i].image.addEventListener('click', this.goTo.bind(this, i))
  }

  init() {
    this.imageWidth = window.innerWidth < 768 ? 90 * this.$container[1].offsetWidth / 100 : this.slides[0].image.parentNode.offsetWidth + 4.16667 * this.$container[1].offsetWidth / 100
    this.contentWidth = this.slides[0].content.offsetWidth
    this.numberHeight = this.slides[0].number.offsetHeight
    this.oldIndex = 0
  }

  createSlider() {
    this.slider = new SlideManager({
      el: this.$wrapper,
      callback: (event) => {
        this.oldIndex = event.previous
        this.currentIndex = event.new
        this.direction = event.direction

        this.onSlideChange()
          .then(() => {
            this.slider.done()
          })
      }
    })
  }

  onSlideChange() {
    return new Promise((resolve) => {
      this.slides[this.oldIndex].image.classList.remove('a')
      this.slides[this.currentIndex].image.classList.add('a')

      this.slides[this.oldIndex].dot.classList.remove('a')
      this.slides[this.currentIndex].dot.classList.add('a')

      this.translateImage = window.innerWidth < 1024 ? - this.currentIndex * this.imageWidth - 15 * this.currentIndex : - this.currentIndex * this.imageWidth

      this.moveTl = gsap.timeline()
      this.moveTl.addLabel('start', 0)

      for (let i = 0; i < this.slides.length; i++) {
        this.moveTl
          .to(this.slides[i].content, {
            x: - this.currentIndex * this.contentWidth,
            duration: 0.6,
            ease: 'power3.out'
          }, 'start')
      }

      for (let i = 0; i < this.slides.length; i++) {
        this.moveTl
          .to(this.slides[i].number, {
            y: - this.currentIndex * this.numberHeight,
            duration: 0.6,
            ease: 'power3.out'
          }, 'start')
      }

      this.moveTl
        .to(this.$wrapper, {
          x: - this.currentIndex * this.imageWidth,
          duration: 0.6,
          ease: 'power3.out',
          onComplete: () => {
            resolve()
          }
        }, 'start')

        this.$pagerRight.classList.toggle('r', this.currentIndex && this.currentIndex + 1 === this.slider.max)
    })
  }

  nextSlide() {
    if (this.currentIndex && this.currentIndex + 1 === this.slider.max) this.goTo(0)
    else this.slider.next()
  }

  goTo(i) {
    this.slider.goTo(i)

    if (this.currentIndex && this.currentIndex + 1 !== this.slider.max) this.$pagerRight.classList.remove('r')
  }

  resize() {
    super.resize()

    this.init()
    this.goTo(0)
  }

  update() {
    super.update()
  }
}
