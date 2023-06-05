const toggleSwitch = document.querySelector('.switch input[type="checkbox"]');
    const systemThemeMatch = window.matchMedia('(prefers-color-scheme: dark)');
    let userTheme = localStorage.getItem('theme');

    const themeCheck = () => {
      if (userTheme === 'dark' || (!userTheme && systemThemeMatch.matches)) {
        document.documentElement.setAttribute('data-theme', 'dark');
        toggleSwitch.checked = true;
      }
    }

    function switchTheme(e) {
      if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
        return;
      }
      document.documentElement.removeAttribute('data-theme');
      localStorage.setItem('theme', 'light');
    }

    systemThemeMatch.addEventListener('change', e => {
      const newSystemTheme = e.matches;
      if (userTheme !== null) {
        // L'utilisateur a déjà choisi son thème, donc ne rien faire
        return;
      }
      if (newSystemTheme) {
        document.documentElement.setAttribute('data-theme', 'dark');
        toggleSwitch.checked = true;
      }
      else {
        document.documentElement.removeAttribute('data-theme');
        toggleSwitch.checked = false;
      }
    });

    toggleSwitch.addEventListener('change', switchTheme, false);
    themeCheck();