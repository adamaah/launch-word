import Block from './Block'

export default class Video extends Block {
  onEnterCompleted() {
    super.onEnterCompleted()

    this.isPlaying = false
    this.player = null

    this.initialize()
  }

  bindMethods() {
    super.bindMethods()

    this.toggleVideo = this.toggleVideo.bind(this)
    this.onPlayerReady = this.onPlayerReady.bind(this)
  }

  getElems() {
    super.getElems()

    this.video = this.el.querySelector('.player')
    this.playButton = this.el.querySelector('.play')
    this.overlay = this.el.querySelector('.video__cover')
    this.playerId = this.video.id
  }

  events() {
    super.events()
    this.overlay && this.overlay.addEventListener('click', this.toggleVideo)
  }

  initialize() {
    this.src = this.video.dataset.src
    this.id = this.video.dataset.id

    this.onYouTubeIframeAPIReady()

    this.iframe = this.el.querySelector('iframe')

    this.observer()
  }

  onYouTubeIframeAPIReady() {
    this.player = new YT.Player(this.playerId, {
      height: '360',
      width: '640',
      playerVars: {
        'controls': 1,
        'hd': 1,
        'autoplay': 0,
        'loop': 0,
        'background': 1,
        'playsinline': 0,
        'mute': 0,
        'autopause': 0,
        'disablekb': 1,
        'modestbranding': 1,
        'showinfo': 0,
        'fs': 1,
        'iv_load_policy': 3,
        'playlist': this.id
      },
      videoId: this.id,
      events: {
        'onReady': this.onPlayerReady,
        'onStateChange': this.onPlayerStateChange.bind(this)
      }
    })
  }

  onPlayerReady() {}

  onPlayerStateChange(e) {
    if (e.data === 1) this.isPlaying = true
    else if (e.data === 2) this.isPlaying = false
  }

  observer() {
    const observer = new IntersectionObserver((entries) => {

      entries.forEach((entry) => {
        if (entry.intersectionRatio > 0 && (this.isPlaying || this.el.classList.contains('is-playing'))) {
          this.player.pauseVideo()
          this.el.classList.remove('is-playing')
          this.isPlaying = false
        }
      });
    }, {threshold: 0.25})

    observer.observe(this.iframe);
  }

  toggleVideo() {
    if (this.isPlaying) this.pause()
    else this.play()
  }

  play() {
    this.isPlaying = true
    this.player.playVideo()
    this.el.classList.add('is-playing')
  }

  pause() {
    this.isPlaying = false
    this.player.pauseVideo()
    this.el.classList.remove('is-playing')
  }
}
