  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
      class="bi bi-arrow-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/coffees/lib/wow/wow.min.js"></script>
  <script src="/coffees/lib/easing/easing.min.js"></script>
  <script src="/coffees/lib/waypoints/waypoints.min.js"></script>
  <script src="/coffees/lib/counterup/counterup.min.js"></script>
  <script src="/coffees/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/coffees/js/main.js"></script>


<script>
(function () {
  const SUPPORTED_LANGS = ["th","en","lo","km"];
  const BASE_PATH = "/coffees/";


  // ✅ ตรวจภาษาแหล่งที่มาอัตโนมัติจาก <html lang="...">
  const SOURCE_LANG = (document.documentElement.lang || "th").split("-")[0].toLowerCase();

  let currentLang = SOURCE_LANG;

  function getLangFromPath(path = location.pathname) {
    const escaped = BASE_PATH.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    const rx = new RegExp(`^${escaped}(${SUPPORTED_LANGS.join("|")})(?:/|$)`, "i");
    const m = path.match(rx);
    return m ? m[1].toLowerCase() : SOURCE_LANG;
  }

  // ✅ สร้าง URL ใหม่แบบแทน segment ภาษาเสมอ (ไม่พึ่ง replace แบบง่าย)
function buildUrlWithLang(targetLang) {
  const url = new URL(location.href);
  
  // ตรวจสอบว่า pathname เริ่มด้วย BASE_PATH แล้วหรือไม่
  if (url.pathname.startsWith(BASE_PATH)) {
    // ถ้าเริ่มด้วย BASE_PATH แล้ว ให้แทนที่ segment ภาษาเท่านั้น
    const pathSegments = url.pathname.split('/').filter(segment => segment);
    
    // หาตำแหน่งของ segment ภาษา (ควรจะเป็น segment ที่ 2)
    if (pathSegments.length > 1 && SUPPORTED_LANGS.includes(pathSegments[1].toLowerCase())) {
      // แทนที่ segment ภาษา
      pathSegments[1] = targetLang;
    } else {
      // ถ้าไม่มี segment ภาษา ให้แทรก segment ภาษาเข้าไปหลัง BASE_PATH
      pathSegments.splice(1, 0, targetLang);
    }
    
    url.pathname = '/' + pathSegments.join('/')+'/';
  } else {
    // ถ้า pathname ไม่เริ่มด้วย BASE_PATH ให้เพิ่ม BASE_PATH และภาษา
    url.pathname = BASE_PATH + targetLang + url.pathname;
  }
  
  // ทำให้ pathname สะอาด (ลบ // ซ้ำ)
  url.pathname = url.pathname.replace(/\/{2,}/g, "/");
  return url.href;
}

  // ✅ ตั้ง cookie เดียวให้ชัด ใช้โดเมนแบบมีจุดนำหน้าเสมอ
  function setGoogleTranslateCookie(targetLang) {
    const host = location.hostname.replace(/^www\./, "");
    const del = [
      `googtrans=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/`,
      `googtrans=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/; domain=.${host}`
    ];
    del.forEach(c => document.cookie = c);

    if (targetLang === SOURCE_LANG) {
      document.documentElement.lang = SOURCE_LANG;
      return;
    }
    const val = `/` + SOURCE_LANG + `/` + targetLang;
    document.cookie = `googtrans=${val}; path=/; max-age=31536000; domain=.${host}`;
    document.documentElement.lang = targetLang;
  }

  function initializeGoogleTranslate(targetLang) {
    // หมายเหตุ: pageLanguage ต้องตรงกับภาษาจริงของหน้านี้ → เรา auto ไว้แล้ว
    window.googleTranslateElementInit = function () {
      new google.translate.TranslateElement({
        pageLanguage: SOURCE_LANG,
        includedLanguages: SUPPORTED_LANGS.filter(l => l !== SOURCE_LANG).join(","),
        autoDisplay: false,
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
      }, "google_translate_element");

      if (targetLang !== SOURCE_LANG) {
        // บังคับ select เปลี่ยนหลัง widget โผล่
        setTimeout(() => {
          const sel = document.querySelector(".goog-te-combo");
          if (sel && sel.value !== targetLang) {
            sel.value = targetLang;
            sel.dispatchEvent(new Event("change"));
          }
        }, 600);
      }
    };

    if (!document.querySelector('script[src*="translate.google.com/translate_a/element.js"]')) {
      const s = document.createElement("script");
      // hl = ภาษาของ UI widget เท่านั้น ไม่ใช่ภาษาที่จะแปล
      s.src = `https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=${targetLang}`;
      document.head.appendChild(s);
    }
  }

  function bindLanguageSwitcher() {
    document.addEventListener("click", (e) => {
      const el = e.target.closest('.language-switcher [data-lang]');
      if (!el) return;
      e.preventDefault();

      const targetLang = el.dataset.lang;
      if (!SUPPORTED_LANGS.includes(targetLang)) return;

      setGoogleTranslateCookie(targetLang);

      // โหลดหน้าใหม่ให้ path ถูกต้อง แล้วค่อยให้ GT ทำงานตาม cookie
      location.href = buildUrlWithLang(targetLang);
    });
  }

  document.addEventListener("DOMContentLoaded", () => {
    currentLang = getLangFromPath();
    setGoogleTranslateCookie(currentLang);

    // ถ้าไม่ใช่ภาษาต้นฉบับ → โหลด widget
    if (currentLang !== SOURCE_LANG) {
      initializeGoogleTranslate(currentLang);
    }

    bindLanguageSwitcher();
  });
})();
</script>
