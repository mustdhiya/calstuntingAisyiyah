/**
 * admin-users.js
 * Script untuk manajemen form tambah/edit pengguna di panel admin.
 */

function editUser(user) {
    // Ubah judul form
    document.getElementById('form-title').innerHTML = `
        <span class="material-symbols-rounded text-sm text-slate-600">edit_note</span>
        Edit Pengguna: ${user.name}
    `;

    // Isi field form
    document.getElementById('user-name').value  = user.name;
    document.getElementById('user-email').value = user.email;
    document.getElementById('user-phone').value = user.phone_number || '';
    document.getElementById('user-role').value  = user.role;
    document.getElementById('user-city').value  = user.city || '';
    document.getElementById('user-status').value = user.is_active ? '1' : '0';

    // Ubah action form ke URL update
    const form = document.getElementById('user-form');
    form.action = `/admin/pengguna/${user.id}`;
    document.getElementById('form-method').value = 'PUT';

    // Scroll ke form dengan halus
    document.getElementById('user-form-card').scrollIntoView({ behavior: 'smooth' });
}

function resetForm() {
    // Kembalikan judul ke mode tambah
    document.getElementById('form-title').innerHTML = `
        <span class="material-symbols-rounded text-sm text-slate-600">person_add</span>
        Tambah pengguna baru
    `;

    // Reset seluruh input
    const form = document.getElementById('user-form');
    form.reset();

    // Kembalikan action ke URL store yang tersimpan di atribut data
    form.action = form.getAttribute('data-store-url');
    document.getElementById('form-method').value = 'POST';

    // Scroll ke form dengan halus
    document.getElementById('user-form-card').scrollIntoView({ behavior: 'smooth' });
}
