function openFormModal() {
  const formModal = document.getElementById('form-modal');
  const modalTitle = document.getElementById('modal-title');
  const faqForm = document.getElementById('faq-form');
  const formMethod = document.getElementById('form-method');
  const storeUrl = faqForm && faqForm.dataset.storeUrl ? faqForm.dataset.storeUrl : '/admin/crud-faq';

  if (modalTitle) {
    modalTitle.innerHTML = '<span class="material-symbols-rounded text-blue-600">help</span> Tambah FAQ Baru';
  }
  if (faqForm) {
    faqForm.action = storeUrl;
  }
  if (formMethod) {
    formMethod.value = 'POST';
  }

  const questionInput = document.getElementById('question');
  const answerInput = document.getElementById('answer');
  const statusInput = document.getElementById('status');

  if (questionInput) questionInput.value = '';
  if (answerInput) answerInput.value = '';
  if (statusInput) statusInput.value = 'Aktif';

  if (formModal) {
    formModal.showModal();
  }
}

function editFaq(faq) {
  const formModal = document.getElementById('form-modal');
  const modalTitle = document.getElementById('modal-title');
  const faqForm = document.getElementById('faq-form');
  const formMethod = document.getElementById('form-method');

  if (modalTitle) {
    modalTitle.innerHTML = '<span class="material-symbols-rounded text-blue-600">edit_note</span> Edit FAQ';
  }
  if (faqForm) {
    faqForm.action = `/admin/crud-faq/${faq.id}`;
  }
  if (formMethod) {
    formMethod.value = 'PUT';
  }

  const questionInput = document.getElementById('question');
  const answerInput = document.getElementById('answer');
  const statusInput = document.getElementById('status');

  if (questionInput) questionInput.value = faq.question || '';
  if (answerInput) answerInput.value = faq.answer || '';
  if (statusInput) statusInput.value = faq.status || 'Aktif';

  if (formModal) {
    formModal.showModal();
  }
}

function closeFormModal() {
  const formModal = document.getElementById('form-modal');
  if (formModal) {
    formModal.close();
  }
}

function promptDelete(id, question) {
  const deleteModal = document.getElementById('delete-modal');
  const deleteForm = document.getElementById('delete-form');
  const deleteQuestionText = document.getElementById('delete-question-text');

  if (deleteQuestionText) {
    deleteQuestionText.innerText = `"${question}"`;
  }
  if (deleteForm) {
    deleteForm.action = `/admin/crud-faq/${id}`;
  }
  if (deleteModal) {
    deleteModal.showModal();
  }
}

function closeDeleteModal() {
  const deleteModal = document.getElementById('delete-modal');
  if (deleteModal) {
    deleteModal.close();
  }
}
