const pageLoader = document.getElementById('page-loader');

if (pageLoader) {
  const minDisplay = 900;
  const start = Date.now();

  const hideLoader = () => {
    const wait = Math.max(0, minDisplay - (Date.now() - start));

    window.setTimeout(() => {
      pageLoader.classList.add('is-exiting');
      window.setTimeout(() => pageLoader.remove(), 550);
    }, wait);
  };

  if (document.readyState === 'complete') {
    hideLoader();
  } else {
    window.addEventListener('load', hideLoader);
  }
}

const navToggle = document.getElementById('nav-toggle');
const navMobile = document.getElementById('nav-mobile');

if (navToggle && navMobile) {
  navToggle.addEventListener('click', () => {
    const isOpen = navMobile.classList.toggle('hidden') === false;
    navToggle.setAttribute('aria-expanded', String(isOpen));
  });
}

const cookieNotice = document.getElementById('cookie-notice');
const cookieAccept = document.getElementById('cookie-accept');
const cookieStorageKey = 'cinq_cookie_consent';

if (cookieNotice && cookieAccept) {
  try {
    if (! window.localStorage.getItem(cookieStorageKey)) {
      cookieNotice.classList.remove('hidden');
    }
  } catch (error) {
    cookieNotice.classList.remove('hidden');
  }

  cookieAccept.addEventListener('click', () => {
    cookieNotice.classList.add('hidden');

    try {
      window.localStorage.setItem(cookieStorageKey, '1');
    } catch (error) {
      // Storage unavailable (private browsing, etc.) — the notice will simply show again next visit.
    }
  });
}
