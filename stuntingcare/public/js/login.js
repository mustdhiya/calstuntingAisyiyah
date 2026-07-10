/**
 * login.js
 * Script untuk mengelola form autentikasi login admin.
 */

document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function () {
            const btn = document.getElementById('loginBtn');
            if (btn) {
                btn.innerHTML = '<span class="loading loading-spinner loading-sm"></span> Memproses...';
                btn.disabled = true;
            }
        });
    }
});

function togglePassword() {
    const input = document.getElementById('password');
    const icon  = document.getElementById('togglePwd');
    if (input && icon) {
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility_off';
        }
    }
}
