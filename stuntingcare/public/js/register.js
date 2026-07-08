/**
 * register.js
 * Script untuk mengelola form registrasi pengguna umum.
 */

document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function () {
            const btn = document.getElementById('registerBtn');
            if (btn) {
                btn.innerHTML = '<span class="loading loading-spinner loading-sm"></span> Memproses...';
                btn.disabled = true;
            }
        });
    }
});

function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId) ?? event.currentTarget;
    if (input) {
        if (input.type === 'password') {
            input.type = 'text';
            if (event.currentTarget) event.currentTarget.textContent = 'visibility';
        } else {
            input.type = 'password';
            if (event.currentTarget) event.currentTarget.textContent = 'visibility_off';
        }
    }
}
