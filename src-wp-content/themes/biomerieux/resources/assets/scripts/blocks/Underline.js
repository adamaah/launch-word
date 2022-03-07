import Block from './Block'
import Splitting from 'splitting'

export default class Underline extends Block {
  onEnterCompleted() {
    super.onEnterCompleted()

    if (this.underlines.length) this.init()
  }

  getElems() {
    super.getElems()

    this.underlines = this.el.querySelectorAll('.underline')
  }

  init() {
    this.splittedUnderlines = []

    for (let i = 0; i < this.underlines.length; i++) {
      /* eslint-disable-next-line */
      this.splittedUnderlines.push(Splitting({ target: this.underlines[i], by: 'lines' })[0].lines)
    }

    for (let i = 0; i < this.splittedUnderlines.length; i++) {
      for (let j = this.splittedUnderlines[i].length - 1; j >= 0; j--) {
        const span = document.createElement('span')

        span.classList.add('u')
        span.dataset.scroll = ''
        span.dataset.scrollOffset = '150'

        for (let k = 0; k < this.splittedUnderlines[i][j].length; k++) span.innerText += k === 0 ? this.splittedUnderlines[i][j][k].innerText : ' ' + this.splittedUnderlines[i][j][k].innerText

        this.underlines[i].insertAdjacentElement('afterend', span)
      }

      this.underlines[i].remove()
    }

    /* eslint-disable-next-line */
    this.splittedText = Splitting({ target: this.el, by: 'lines' })[0]

    // Wrap word into a span, needed because of Splitting.js
    for (let i = 0; i < this.splittedText.words.length; i++) {
      const word = this.splittedText.words[i]

      word.dataset.scroll = ''
      word.dataset.scrollOffset = '150'

      const wrap = document.createElement('span')
      const parent = word.parentElement
      const wordClone = word.cloneNode(true)

      wrap.classList.add('word--wrap')
      wrap.appendChild(wordClone)
      if (parent.childNodes[0].tagName === 'P') parent.childNodes[0].replaceChild(wrap, word)
      else parent.replaceChild(wrap, word)
    }
  }
}
