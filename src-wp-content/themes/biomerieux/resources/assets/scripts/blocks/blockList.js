import Dropown from './Dropdown'
import ProcessSlider from './ProcessSlider'
import Slider from './Slider'
import SocialMedia from './SocialMedia'
import Video from './Video'
import Breadcrumb from './Breadcrumb'
import Underline from './Underline'
import Cursor from './Cursor'
import Anchor from './Anchor'
import Form from './Form'

const blockList = [
  {
    name: 'social-media',
    Class: SocialMedia
  },
  {
    name: 'b-s',
    Class: Slider
  },
  {
    name: 'b-ps',
    Class: ProcessSlider
  },
  {
    name: 'dropdown',
    Class: Dropown
  },
  {
    name: 'video',
    Class: Video
  },
  {
    name: 'breadcrumb',
    Class: Breadcrumb
  },
  {
    name: 'underline-wrapper',
    Class: Underline
  },
  {
    name: 'c',
    Class: Cursor
  },
  {
    name: 'anchors',
    Class: Anchor
  },
  {
    name: 'gform_wrapper',
    Class: Form
  }
]

export default blockList
