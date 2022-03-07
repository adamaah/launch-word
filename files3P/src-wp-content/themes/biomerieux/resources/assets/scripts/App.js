import 'whatwg-fetch'
import 'intersection-observer'

import LazyLoad from 'vanilla-lazyload'
import Highway from '@dogstudio/highway'
import gsap from 'gsap'
import { throttle, debounce } from 'throttle-debounce'
import quicklink from 'quicklink/dist/quicklink.mjs'

// Utils
import Menu from './util/Menu'
import DOMObserver from './util/DOMObserver'
import globalVariables from './util/globalVariables'

// Routes
import Page from './routes/Page'

// Transitions
import Fade from './transitions/Fade'

export default class App {

  /**
  * Loads the page
  * then calls `this.start()` when DOM is ready
  */
  constructor() {
    this.resize = this.resize.bind(this)
    this.scroll = this.scroll.bind(this)
    this.update = this.update.bind(this)

    this.raf = null

    this.resizeDebounced = debounce(100, this.resize)
    this.resizeThrottled = throttle(150, this.resize)
    this.scrollDebounced = debounce(100, this.scroll)
    this.scrollThrottled = throttle(50, this.scroll)

    this.checkMobile()
    this.start()
  }

  /**
  * Inits everything that is app-wide
  * ie: Menu, scroll / resize events...
  *
  * @returns {void}
  */
  start() {
    if (document.querySelector('.m')) {
      this.menu = new Menu()
      globalVariables.menu = this.menu
    }

    this.langswitcher = document.body.querySelector('.l')

    this.lazyLoad = new LazyLoad()

    this.initHighway().then(() => {
      this.events()

      gsap.fromTo(document.querySelector('.app'), { opacity: 0 }, {
        opacity: 1,
        duration: 0.5,
        delay: 1,
        onStart: () => {
          window.scrollTo(0, 0)
          this.raf = requestAnimationFrame(this.update)
        },
        onComplete: () => {
          this.initDOMObserver()
          this.checkAnchor()
        }
      })

      const adminBarLinks = document.body.querySelectorAll('#wpadminbar a')

      App.Highway.detach(adminBarLinks)
    })
  }

  initDOMObserver() {
    this.DOMObserver = new DOMObserver(this.observerCallBack)
  }

  checkMobile() {
    App.isMobile && document.body.classList.remove('isMobile')
    App.isMobile && document.documentElement.classList.remove('isMobile')
    /* eslint-disable */
    App.isMobile = (/Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
    App.isMobile && document.body.classList.add('isMobile')
    App.isMobile && document.documentElement.classList.add('isMobile')
  }

  /**
  * Starts an Highway instance
  * with our Views and Transitions
  *
  * @returns {void}
  */
  initHighway() {
    return new Promise((resolve) => {
      App.Highway = new Highway.Core({
          renderers: {
            page: Page
          },
          transitions: { default: Fade }
      })

      this.setCurrentRenderer()
          .then(resolve)
    })
  }

  setCurrentRenderer() {
    return new Promise((resolve) => {
      App.Highway.properties.renderer.then(() => {
        this.currentRenderer = App.Highway.To ? App.Highway.To : App.Highway.From

        resolve(this.currentRenderer)
      })
    })
  }

  updatePolylangLink(to) {
    const langswitcherWrapper = Array.from(to.page.all).filter((e) => e.classList.contains('l'))

    if (langswitcherWrapper.length) {
      const langswitcher = langswitcherWrapper[0]
      const newlinks = langswitcher.querySelectorAll('a')
      const links = this.langswitcher.querySelectorAll('a')

      for (let i = 0; i < newlinks.length; i++) links[i].href = newlinks[i].href
    }
  }

  resize() {
    this.currentRenderer.resize()
    globalVariables.menu && globalVariables.menu.resize()
  }

  scroll() {
    this.currentRenderer.scroll()
  }

	update() {
		this.currentRenderer.update()
		this.raf = requestAnimationFrame(this.update)
	}

  events() {
    window.addEventListener('resize', this.resizeThrottled)
    window.addEventListener('resize', this.resizeDebounced)
    window.addEventListener('orientationchange', this.resize)
    window.addEventListener('scroll', this.scrollThrottled)
    window.addEventListener('scroll', this.scrollDebounced)

    App.Highway.on('NAVIGATE_IN', () => {
      globalVariables.menu.onPageChange(location)
      this.setCurrentRenderer().then((renderer) => { document.title = renderer.properties.page.title })
    })

    App.Highway.on('NAVIGATE_END', ({ to, location }) => {
      this.updatePolylangLink(to)
      this.checkAnchor(location)
      quicklink({ el: to.view })
      this.lazyLoad.update()
      this.DOMObserver = null
      this.initDOMObserver()

      // Query admin bar links, and new page's admin bar links
      const adminBarLinks = document.body.querySelectorAll('#wpadminbar a')
      const newAdminBarLinks = to.page.body.querySelectorAll('#wpadminbar a')

      // Replace every admin bar link's href value with new value
      for (let i = 0; i < newAdminBarLinks.length; i++) {
        adminBarLinks[i].href = newAdminBarLinks[i].href;
      }

      // Detach admin bar links from Highway transitions
      App.Highway.detach(adminBarLinks);
    })

    window.addEventListener('highwayredirect', (e) => {
      App.Highway.redirect(e.detail.url)
    })
  }

  checkAnchor(location = null) {
    const bodyClassSubmit = Array.from(document.body.classList).find((elt) => elt.includes('formsubmit'))
    let anchor = null

    if (location && location.anchor) anchor = location.anchor
    else if (bodyClassSubmit) {
      const validate = document.querySelector('#gform_confirmation_message_' + bodyClassSubmit.split('-')[1])
      const error = document.querySelector('#gform_wrapper_' + bodyClassSubmit.split('-')[1])

      if (validate) anchor = 'gform_confirmation_message_' + bodyClassSubmit.split('-')[1]
      else if (error) anchor = 'gform_wrapper_' + bodyClassSubmit.split('-')[1]
    } else {
      const idx = window.location.href.indexOf("#")
      if (idx != -1) anchor = window.location.href.substring(idx + 1 )
    }

    if (anchor) {
      const el = document.querySelector('#' + anchor)

      if (el) {
        const elRect = el.getBoundingClientRect()
        window.scrollTo(0, elRect.top)
      }
    }
  }
}
