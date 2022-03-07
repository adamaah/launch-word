import Block from './Block'
import SlideManager from '../util/SlideManager'
import gsap from 'gsap'

export default class Slider extends Block {
  onEnterCompleted() {
    super.onEnterCompleted()

    this.createSlider()
    this.init()
  }

  bindMethods() {
    super.bindMethods()

    this.prevSlide = this.prevSlide.bind(this)
    this.nextSlide = this.nextSlide.bind(this)
    this.goTo = this.goTo.bind(this)
  }

  getElems() {
    super.getElems()

    this.$container = this.el.querySelector('.b-s__l')
    this.$wrapper = this.$container.querySelectorAll('.b-s__wi')
    this.$images = this.$container.querySelectorAll('.b-s__i')
    this.$content = this.el.querySelector('.b-s__c')
    this.$items = this.el.querySelectorAll('.b-s__ci')
    this.$titles = this.el.querySelectorAll('.b-s__cti')
    this.$texts = this.el.querySelectorAll('.b-s__ctx')
    this.$links = this.el.querySelectorAll('.b-s__ci .b')
    this.$pagerLeft = this.el.querySelector('.b-s__ap')
    this.$pagerRight = this.el.querySelector('.b-s__an')
    this.slides = []

    for (let i = 0; i < this.$wrapper.length; i++) {
      this.slides[i] = {
        wrapper: this.$wrapper[i],
        item: this.$items[i],
        image: this.$images[i],
        title: this.$titles[i],
        text: this.$texts[i],
        link: this.$links[i],
        height: this.$texts[i].offsetHeight
      }
    }
  }

  events() {
    super.events()

    this.$pagerLeft && this.$pagerLeft.addEventListener('click', this.prevSlide)
    this.$pagerRight && this.$pagerRight.addEventListener('click', this.nextSlide)
  }

  init() {
    this.translateImage = window.innerWidth * 0.9
    this.currentIndex = 0
    this.prevDirection = 0
    this.contentHeight = 0
    this.goTo(0)

    for (let i = 1; i < this.slides.length; i++) {
      if (this.slides[i].height > this.contentHeight) this.contentHeight = this.slides[i].height
    }

    this.contentHeight = this.contentHeight + 106
    this.$content.style.height = this.contentHeight + 'px'

    gsap.set(this.slides[0].wrapper, {
      x: 0,
      y: 0,
      rotate: 45,
      scale: 1.5
    })

    gsap.set(this.slides[0].image, {
      x: 0,
      y: 0,
      rotate: -45,
      scale: 0.69
    })

    gsap.set([this.slides[0].title, this.slides[0].text, this.slides[0].link], {
      x: 0,
      y: 0,
      opacity: 1
    })

    gsap.set(this.slides[0].item, { pointerEvents: 'all' })

    for (let i = 1; i < this.slides.length; i++) {
      gsap.set(this.slides[i].wrapper, {
        x: -window.innerWidth,
        y: -window.innerWidth,
        rotate: 45,
        scale: 1.5
      })

      gsap.set(this.slides[i].image, {
        x: this.translateImage,
        y: 0,
        rotate: -45,
        scale: 0.69
      })

      gsap.set([this.slides[i].title, this.slides[i].text, this.slides[i].link], {
        x: -20,
        y: -20,
        opacity: 0
      })

      gsap.set(this.slides[i].item, { pointerEvents: 'none' })
    }
  }

  createSlider() {
    this.slider = new SlideManager({
      el: this.$container,
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
      if (this.direction > 0) {
        this.nextTl = gsap.timeline()

        this.nextTl
          .addLabel('start', 0)
          .to(this.slides[this.currentIndex].wrapper, {
            x: 0,
            y: 0,
            rotate: 45,
            scale: 1.5,
            duration: 0.7,
            ease: 'power2.out'
          }, 'start')
          .to(this.slides[this.currentIndex].image, {
            x: 0,
            y: 0,
            rotate: -45,
            scale: 0.69,
            duration: 0.7,
            ease: 'power2.out'
          }, 'start')
          .to([this.slides[this.oldIndex].title, this.slides[this.oldIndex].text, this.slides[this.oldIndex].link], {
            x: 20,
            y: 20,
            opacity: 0,
            duration: 0.2,
            stagger: 0.05,
            onComplete: () => {
              gsap.set([this.slides[this.oldIndex].title, this.slides[this.oldIndex].text, this.slides[this.oldIndex].link], {
                x: 20,
                y: 20,
                opacity: 0
              })

              gsap.set(this.slides[this.oldIndex].item, { pointerEvents: 'none' })
            }
          }, '<+=0.2')
          .to([this.slides[this.currentIndex].title, this.slides[this.currentIndex].text, this.slides[this.currentIndex].link], {
            x: 0,
            y: 0,
            opacity: 1,
            duration: 0.2,
            stagger: 0.05,
            onComplete: () => {
              this.prevDirection = this.direction
              gsap.set(this.slides[this.currentIndex].item, { pointerEvents: 'all' })

              resolve()
            }
        })
      } else {
        this.prevTl = gsap.timeline()

        this.prevTl
          .addLabel('start', 0)
          .to(this.slides[this.oldIndex].wrapper, {
            x: -window.innerWidth,
            y: -window.innerWidth,
            rotate: 45,
            scale: 1.5,
            duration: 0.7,
            ease: 'power2.out'
          }, 'start')
          .to(this.slides[this.oldIndex].image, {
            x: this.translateImage,
            y: 0,
            rotate: -45,
            scale: 0.69,
            duration: 0.7,
            ease: 'power2.out'
          }, 'start')
          .to([this.slides[this.oldIndex].title, this.slides[this.oldIndex].text, this.slides[this.oldIndex].link], {
            x: -20,
            y: -20,
            opacity: 0,
            duration: 0.2,
            stagger: 0.05,
            onComplete: () => {
              gsap.set([this.slides[this.oldIndex].title, this.slides[this.oldIndex].text, this.slides[this.oldIndex].link], {
                x: -20,
                y: -20
              })

              gsap.set(this.slides[this.oldIndex].item, { pointerEvents: 'none' })
            }
          }, '<+=0.2')
          .to([this.slides[this.currentIndex].title, this.slides[this.currentIndex].text, this.slides[this.currentIndex].link], {
            x: 0,
            y: 0,
            opacity: 1,
            duration: 0.2,
            stagger: 0.05,
            onComplete: () => {
              this.prevDirection = this.direction
              gsap.set(this.slides[this.currentIndex].item, { pointerEvents: 'all' })

              resolve()
            }
        })
      }
      this.$pagerRight.classList.toggle('d', this.currentIndex + 1 === this.slider.max)
      this.$pagerLeft.classList.toggle('d', this.currentIndex === 0)
    })
  }

  prevSlide() {
    this.slider.prev()
  }

  nextSlide() {
    this.slider.next()
  }

  goTo(i) {
    this.slider.goTo(i)
  }

  resize() {
    super.resize()

    this.init()
  }

  update() {
    super.update()
  }

  destroy() {
    super.destroy()
  }
}
