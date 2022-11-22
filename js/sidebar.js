const sidebar = () => {
  document.querySelector('aside').classList.toggle('close')
  document.querySelector('.footer-sidebar').classList.toggle('close')
  document.querySelector('.menu-sections').classList.toggle('close')
  document.querySelector('.overlay').classList.toggle('close')
  document.querySelector('.icon-sidebar').classList.toggle('fa-xmark')
  document.querySelector('.overlay').classList.remove('none')
}
