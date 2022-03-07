import Highway from '@dogstudio/highway'
import gsap from 'gsap'
import App from '../App';

export default class Fade extends Highway.Transition {
  in({ from, to, done }) {
    from.remove()

    const list = document.body.classList

    list.forEach((item) => {
      if (item.substring(0, 10) === 'formsubmit') document.body.classList.remove(item)
    })

    window.scrollTo(0, 0)

    this.getElems()
    this.startSmoothScrool()
    this.hideLoader(to)
    done()
  }

  out({ from, done }) {
    this.getElems()
    this.stopSmoothScrool()

    setTimeout(() => {
      this.showLoader(from).then(done)
    }, 0);
  }

  hideLoader(to) {
    gsap.set([to, this.elmFooter], { alpha: 0 })

    if (this.elmLoader) this.elmLoader.classList.remove('show')

    gsap.to([to, this.elmFooter], {
      duration: 0.75,
      alpha: 1
    })
  }

  showLoader(from) {
    return new Promise((resolve) => {
      gsap.to([from, this.elmFooter], {
        duration: 0.75,
        alpha: 0,
        onComplete: () => {
          if (this.elmLoader) this.elmLoader.classList.add('show')

          resolve()
        }
      })
    })
  }

  getElems() {
    if (!this.elmLoader) this.elmLoader = document.querySelector('.loader')
    if (!this.elmHeader) this.elmHeader = document.querySelector('.header')
    if (!this.elmFooter) this.elmFooter = document.querySelector('.footer')
  }

  startSmoothScrool() {
    if (!App.smoothScroll) return

    if (App.isMobile) {
      window.scrollTo(0, 0)
      App.smoothScroll.update()
      App.smoothScroll.start()
    } else {
      App.smoothScroll.setScroll(0, 0)
      App.smoothScroll.update()
      App.smoothScroll.scroll.scrollbarThumb.style.height = `${window.innerHeight * window.innerHeight / (App.smoothScroll.scroll.instance.limit + window.innerHeight)}px`
      App.smoothScroll.scroll.scrollBarLimit = window.innerHeight - App.smoothScroll.scroll.scrollbarThumb.getBoundingClientRect().height
      App.smoothScroll.scroll.startScrolling()
      App.smoothScroll.start()
    }
  }

  stopSmoothScrool() {
    if (!App.smoothScroll) return

    if (App.isMobile) App.smoothScroll.stop()
    else {
      App.smoothScroll.scroll.stopScrolling()
      App.smoothScroll.stop()
    }
  }
}
