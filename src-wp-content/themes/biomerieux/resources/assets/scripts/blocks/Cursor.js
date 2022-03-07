import Block from './Block'

export default class Cursor extends Block {
  onEnterCompleted() {
    super.onEnterCompleted()

    window.scrollTo(0, 0)
    this.init()
  }

  bindMethods() {
    super.bindMethods()

    this.onMouseMove = this.onMouseMove.bind(this)
  }

  init() {
    this.cursorSize = this.cursor.offsetWidth
    this.currentScroll = window.pageYOffset
    this.cursorInitialTop = this.cursor.offsetTop
    this.cursorInitialLeft = this.cursor.offsetLeft
    this.canFollowCursor = true
    this.lastX = 0
    this.lastY = 0
    this.dataMin = parseInt(this.cursor.dataset.min)
    this.dataMax = parseInt(this.cursor.dataset.max)

    this.options = { easing: 0.04 }

    this.currentMousePosition = {
      x: 0,
      y: 0
    }

    this.cursorParams = {
      el: this.cursor,
      x: this.cursorInitialLeft,
      y: this.cursorInitialTop,
      scale: 1,
      zIndex: 5
    }

    this.cursor.style.top = 0
    this.cursor.style.left = 0

    this.windowHeight = window.innerHeight

    setTimeout(() => {
      this.sectionRectangle = this.el.getBoundingClientRect()
      this.sectionTop = this.sectionRectangle.top
      this.sectionLeft = this.sectionRectangle.left
      this.sectionWidth = this.sectionRectangle.width
      this.sectionHeight = this.sectionRectangle.height
    }, 300)
  }

  getElems() {
    super.getElems()

    this.cursor = this.el.querySelector('.c__i')
  }

  events() {
    super.events()

    if (window.innerWidth >= 1200) document.body.addEventListener('mousemove', this.onMouseMove)
  }

  removeEvents() {
    document.body.removeEventListener('mousemove', this.onMouseMove)
  }

  lerp(value1, value2, amount) {
    let amountValue = amount

    amountValue = amountValue < 0 ? 0 : amountValue
    amountValue = amountValue > 1 ? 1 : amountValue

    return (1 - amountValue) * value1 + amountValue * value2
  }

  onMouseMove(e) {
    if (!this.canFollowCursor) return

    this.updateCursorPosition(e.clientX, e.clientY)
  }

  updateCursorPosition(x, y) {
    if (x) this.cursorParams.x = x
    if (y) this.cursorParams.y = y + window.scrollY
  }

  resize() {
    super.resize()

    this.init()
  }

  update() {
    super.update()

    if (!this.lastY) this.lastY = 0

    if (window.innerWidth >= 1200) {
      if (Number(this.cursorParams.y) + this.dataMin >= this.sectionTop && Number(this.cursorParams.y) - this.dataMin <= this.sectionHeight + this.sectionTop && Number(this.cursorParams.x) + this.dataMin >= this.sectionLeft && Number(this.cursorParams.x) - this.dataMin <= this.sectionLeft + this.sectionWidth) {
        let cursorX = Number(this.cursorParams.x - this.cursorSize / 2 - this.sectionLeft)
        let cursorY = Number(this.cursorParams.y - this.cursorSize / 2 - this.sectionTop)

        if (cursorX < -this.dataMin) cursorX = -this.dataMin
        if (cursorY < -this.dataMin) cursorY = -this.dataMin
        if (cursorX > this.el.offsetWidth - this.dataMax) cursorX = this.el.offsetWidth - this.dataMax
        if (cursorY > this.el.offsetHeight - this.dataMax) cursorY = this.el.offsetHeight - this.dataMax

        const translateX = this.lerp(this.lastX, cursorX, this.options.easing)
        const translateY = this.lerp(this.lastY, cursorY, this.options.easing)

        this.cursor.style.transform = 'translate3d(' + translateX + 'px, ' + translateY + 'px, 0) scale(' + this.cursorParams.scale + ')'
        this.lastX = this.lerp(translateX, cursorX, this.options.easing)
        this.lastY = this.lerp(translateY, cursorY, this.options.easing)

        const transformValue = this.cursor.style.transform
        const transform = transformValue.substring(12).split('px')

        this.currentMousePosition.x = Number(transform[0]) + this.cursorSize / 2
        if (transform[1]) this.currentMousePosition.y = Number(transform[1].substring(2)) + this.cursorSize / 2
      }
    }
  }

  destroy() {
    super.destroy()

    this.removeEvents()
  }
}
