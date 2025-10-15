// translate.js
document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("translate-btn");
  const label = document.getElementById("translate-label");
  const flag = btn ? btn.querySelector(".flag") : null;
  let isFrench = false;

  function setLanguage(french) {
    document.querySelectorAll("[data-en]").forEach((el) => {
      const en = el.getAttribute("data-en") || "";
      const fr = el.getAttribute("data-fr") || en;
      el.textContent = french ? fr : en;
    });

    // Update form placeholders (if using data-en-placeholder/data-fr-placeholder attributes)
    document.querySelectorAll("[data-en-placeholder]").forEach((el) => {
      const enp = el.getAttribute("data-en-placeholder") || "";
      const frp = el.getAttribute("data-fr-placeholder") || enp;
      el.placeholder = french ? frp : enp;
    });

    // Update button visuals
    if (btn && label && flag) {
      if (french) {
        label.textContent = "English";
        flag.textContent = "🇬🇧";
        isFrench = true;
      } else {
        label.textContent = "Français";
        flag.textContent = "🇫🇷";
        isFrench = false;
      }
    }

    // Dispatch a custom event so any other scripts can react to language change
    document.dispatchEvent(new CustomEvent('languageChanged', { detail: { isFrench: isFrench } }));
  }

  // If button missing, abort gracefully
  if (!btn) {
    console.warn("translate.js: #translate-btn not found.");
    return;
  }

  // Initialize page to English (or you could read from localStorage to persist it)
  setLanguage(false);

  btn.addEventListener("click", () => setLanguage(!isFrench));
});