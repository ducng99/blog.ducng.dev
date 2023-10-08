<div class="p-4 nav_dropdown">
    <div class="dropdown_btn">
        <i class="bi bi-moon-stars-fill"></i>
    </div>
    <div class="dropdown_body dropdown_right">
        <div class="dropdown_item">
            <button onclick="setTheme('light');"><i class="bi bi-brightness-high-fill me-2"></i>Light</button>
        </div>
        <div class="dropdown_item">
            <button onclick="setTheme('dark');"><i class="bi bi-moon-stars-fill me-2"></i>Dark</button>
        </div>
        <div class="dropdown_item">
            <button onclick="setTheme('');"><i class="bi bi-circle-half me-2"></i>Auto</button>
        </div>
    </div>
</div>

<script>
    function setTheme(theme) {
        if (theme) {
            localStorage.theme = theme;
        } else {
            localStorage.removeItem('theme');
        }
        window.onThemeChange();
    }
</script>
