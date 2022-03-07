import gsap from 'gsap'

export default class Menu {
  constructor() {
    this.menuOpen = false

    this.bindMethods()
    this.getElems()
    this.addEvents()
    this.init()
    this.onPageChange({ href: window.location.href })
  }

  bindMethods() {
    this.toggleBurger = this.toggleBurger.bind(this)
    this.showSubmenu = this.showSubmenu.bind(this)
    this.closeSubmenus = this.closeSubmenus.bind(this)
    this.closeMenus = this.closeMenus.bind(this)
  }

  getElems() {
    this.$header = document.querySelector('.h')
    this.$toggler = this.$header.querySelector('.h__b')
    this.$menu = document.querySelector('.m')
    this.$submenus = this.$menu.querySelectorAll('.m__s')
    this.$links = this.$menu.querySelectorAll('div.m__i')
    this.$menuLinks = this.$menu.querySelectorAll('.m__i')
    this.submenu = []
    this.items = []

    for (let i = 0; i < this.$links.length; i++) {
      this.submenu.push({
        toggler: this.$links[i],
        wrapper: this.$submenus[i],
        height: 0
      })
    }

    for (let i = 0; i < this.$links.length; i++) {
      this.$subLinks = this.$links[i].getElementsByTagName('a')

      for (let j = 0; j < this.$subLinks.length; j++) {
        this.items.push({
          parent: this.$links[i],
          item: this.$subLinks[j]
        })
      }
    }
  }

  addEvents() {
    this.$toggler && this.$toggler.addEventListener('click', this.toggleBurger)

    for (let i = 0; i < this.submenu.length; i++) {
      this.submenu[i].toggler.addEventListener('click', this.showSubmenu)
    }

    for (let i = 0; i < this.submenu.length; i++) {
      this.submenu[i].wrapper.addEventListener('click', (e) => {
        e.stopPropagation()
      })
    }
  }

  init() {
    if (window.innerWidth <= 1024) {
      for (let i = 0; i < this.submenu.length; i++) {
        this.$submenus[i].style.height = 'auto'
        this.submenu[i].height = this.$submenus[i].offsetHeight + 20
        gsap.set(this.submenu[i].wrapper, { height: 0 })
      }
    } else {
      for (let i = 0; i < this.submenu.length; i++) {
        this.$submenus[i].style.height = 'auto'
      }
    }
  }

  showSubmenu(e) {
    const key = this.submenu.find((element) => element.toggler === e.target)

    for (let i = 0; i < this.submenu.length; i++) {
      this.submenu[i].toggler.classList.toggle('a', this.submenu[i].toggler === key.toggler && !this.submenu[i].toggler.classList.contains('a'))
      this.submenu[i].wrapper.classList.toggle('a', this.submenu[i].toggler === key.toggler && !this.submenu[i].wrapper.classList.contains('a'))

      if (window.innerWidth <= 1024) {
        if (this.submenu[i].toggler === key.toggler && this.submenu[i].toggler.classList.contains('a')) {
          gsap.to(this.submenu[i].wrapper, {
            height: this.submenu[i].height,
            duration: 0.5,
            ease: 'power2.out'
          })
        } else {
          gsap.to(this.submenu[i].wrapper, {
            height: 0,
            duration: 0.5,
            ease: 'power2.out'
          })
        }
      }
    }
  }

  closeSubmenus() {
    for (let i = 0; i < this.submenu.length; i++) {
      this.submenu[i].wrapper.classList.remove('a')
    }
  }

  closeMenus() {
    this.$toggler.classList.remove('o')
    this.$menu.classList.remove('a')
  }

  toggleBurger() {
    this.closeSubmenus()
    this.$toggler.classList.toggle('o')
    this.$menu.classList.toggle('a')
  }

  resize() {
    this.closeSubmenus()
    this.closeMenus()
    this.init()
  }

  onPageChange(location) {
    this.closeSubmenus()
    this.closeMenus()

    for (let i = 0; i < this.$menuLinks.length; i++) {
      if (this.$menuLinks[i].href === location.href) this.$menuLinks[i].classList.add('v')
      else this.$menuLinks[i].classList.remove('v')
    }

    for (let i = 0; i < this.items.length; i++) {
      this.items[i].item.classList.toggle('v', this.items[i].item.href === location.href)
      if (this.items[i].item.href === location.href) this.items[i].parent.classList.add('v')
    }
  }
}
