// Initial Listener
window.addEventListener('load', function(){

  // Mobile Side Menu 
  const mobileMenu = document.querySelector('.mobile-menu');
  const body = document.querySelector('body')
  const html =  document.querySelector('html')
  if (mobileMenu) {
    const menuItems = mobileMenu.querySelectorAll('.menu-item.menu-item-has-children');

    menuItems.forEach((item) => {
      const button = document.createElement('button');
      button.classList.add('angle-down');
      button.textContent = 'Angle down';
      const submenu = item.querySelector('.sub-menu');
      item.insertBefore(button,submenu)
    });
  }

  const sideMenuOverlay = document.querySelector('#sideMenuOverlay')
  const hamBarEl = document.querySelector('#sideMenuOpener')
  const mobileSideMenuEl = document.querySelector('#mobileSideMenu')
  const mobileSideMenuClose = document.querySelector('#mobileSideMenuClose')

  if(hamBarEl && sideMenuOverlay && mobileSideMenuEl){
    hamBarEl.addEventListener('click',() => {
        hamBarEl.classList.toggle('active')
        sideMenuOverlay.classList.add('active')
        mobileSideMenuEl.classList.add('active')
        body.style.overflow = 'hidden';
        html.style.overflow = 'hidden';
    })
  }

  if(sideMenuOverlay && hamBarEl && mobileSideMenuEl){
    sideMenuOverlay.addEventListener('click', () => {
        sideMenuOverlay.classList.toggle('active')
        hamBarEl.classList.remove('active')
        mobileSideMenuEl.classList.remove('active')
        body.style.overflow = '';
        html.style.overflow = '';
    })
  }
  if(mobileSideMenuClose && sideMenuOverlay && mobileSideMenuEl){
    mobileSideMenuClose.addEventListener('click',() => {
        sideMenuOverlay.classList.remove('active')
        hamBarEl.classList.remove('active')
        mobileSideMenuEl.classList.remove('active')
        body.style.overflow = '';
        html.style.overflow = '';
    })
  }

  const submenuOpener = document.querySelectorAll('.angle-down');

  const handleOpeningSubmenu = (opener) => {
      let totalHeight = 0; // Initialize totalHeight to 0
      const submenu = opener.nextSibling;
      totalHeight = submenu.scrollHeight
      const innerSubMenu = submenu.querySelectorAll('ul');
      innerSubMenu.forEach(menu => {
        totalHeight += menu.scrollHeight;
      })
      if(submenu.style.visibility === "visible"){
        submenu.style.visibility = "hidden";
        submenu.style.maxHeight = "0";
      }else{
        submenu.style.visibility = "visible";
        submenu.style.maxHeight =  totalHeight + "px";
      }
      opener.classList.toggle('active')
      totalHeight = 0;
  }

  if(submenuOpener){
    submenuOpener.forEach(opener => {
        opener.addEventListener('click', () => handleOpeningSubmenu(opener));
    });
  }

  // dynamic menu dropdown
  const subMenus = document.querySelectorAll('.header-nav.nav-menu .sub-menu');      

  if(subMenus.length > 0){
    subMenus.forEach(function (menu) {
        const rect = menu.getBoundingClientRect();
        if (rect.right > window.innerWidth) {
            if (menu.parentElement.parentElement.classList.contains('nav-menu')) {
                menu.style.left = 'auto';
                menu.style.right = '0';
            } else {
                menu.style.left = 'auto';
                menu.style.right = '100%';
            }
        }
    });
  }
})


