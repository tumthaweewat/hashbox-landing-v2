(() => {
  const toggle = document.querySelector('.nav__toggle');
  const menu = document.querySelector('.nav__mobile');

  const closeMenu = () => {
    if (!toggle || !menu) return;
    toggle.setAttribute('aria-expanded', 'false');
    menu.hidden = true;
  };

  if (toggle && menu) {
    toggle.addEventListener('click', () => {
      const isOpen = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!isOpen));
      menu.hidden = isOpen;
    });

    menu.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', closeMenu);
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        closeMenu();
        toggle.focus();
      }
    });

    window.addEventListener('resize', () => {
      if (window.innerWidth > 896) closeMenu();
    });
  }

  const form = document.querySelector('[data-demo-form]');
  if (!form) return;

  const name = form.elements.name;
  const email = form.elements.email;
  const consent = form.elements.pdpa;
  const button = form.querySelector('button[type="submit"]');
  const buttonLabel = form.querySelector('[data-button-label]');
  const status = form.querySelector('.form-status');

  const validateField = (field) => {
    const valid = field.checkValidity();
    field.setAttribute('aria-invalid', String(!valid));
    if (!valid) {
      const error = field.closest('.field')?.querySelector('.field__error');
      if (error) field.setAttribute('aria-describedby', error.id);
    } else {
      field.removeAttribute('aria-describedby');
    }
    return valid;
  };

  [name, email].forEach((field) => {
    field.addEventListener('blur', () => validateField(field));
    field.addEventListener('input', () => {
      if (field.getAttribute('aria-invalid') === 'true') validateField(field);
    });
  });

  form.addEventListener('submit', (event) => {
    event.preventDefault();
    const fieldsValid = [name, email].map(validateField).every(Boolean);
    const consentValid = consent.checked;

    if (!fieldsValid || !consentValid) {
      form.dataset.state = 'error';
      status.textContent = consentValid
        ? 'กรุณาตรวจข้อมูลที่ระบุไว้ด้านบน'
        : 'กรุณายินยอมตามนโยบาย PDPA ก่อนส่งแบบฟอร์ม';
      const firstInvalid = form.querySelector('[aria-invalid="true"]') || consent;
      firstInvalid.focus();
      return;
    }

    form.dataset.state = 'loading';
    button.disabled = true;
    buttonLabel.textContent = 'กำลังจำลองการส่ง…';
    status.textContent = '';

    window.setTimeout(() => {
      form.dataset.state = 'success';
      button.disabled = false;
      buttonLabel.textContent = 'ส่งและรับ Audit ฟรี';
      status.textContent = 'ตัวอย่างสถานะสำเร็จ — ไม่มีข้อมูลถูกส่งออกจากหน้านี้';
    }, 650);
  });
})();
