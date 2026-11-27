// Block Editor submits legacy meta boxes as FormData and leaves their DOM in place.
(() => {
  let latestSave = 0;
  wp.apiFetch.use(async (options, next) => {
    const action = document.getElementById('hashbox-directory-index-action');
    if (!action || options.url !== window._wpMetaBoxUrl || options.method !== 'POST' ||
        !(options.body instanceof FormData) || !options.body.has(action.name)) {
      return next(options);
    }

    const save = ++latestSave;
    const status = document.getElementById('hashbox-directory-index-status');
    // The outgoing form has its own copy. A later Save must require a new choice.
    action.value = '';
    status.textContent = 'กำลังตรวจสอบผลการบันทึก…';
    const unverified = 'ยังยืนยันสถานะไม่ได้ กรุณาโหลดหน้าจอแก้ไขใหม่';
    let response;
    try {
      response = await next(options);
    } catch (error) {
      if (save === latestSave) status.textContent = unverified;
      throw error;
    }

    // Read the label from the edit screen WordPress returned after this save.
    // Keep the response intact for Gutenberg, even if a plugin changes its markup.
    let confirmed = unverified;
    try {
      const template = document.createElement('template');
      template.innerHTML = await response.clone().text();
      const saved = template.content.querySelector('#hashbox-directory-index-status');
      if (saved) confirmed = saved.textContent;
    } catch {
      // The post may have been saved even if the confirmation could not be read.
    }
    if (save === latestSave) status.textContent = confirmed;
    return response;
  });
})();
