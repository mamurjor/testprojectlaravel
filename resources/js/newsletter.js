(function(){
  const form = document.getElementById('newsletter-form');
  if (!form) return;

  const emailInput = document.getElementById('newsletter-email');
  const submitBtn  = document.getElementById('newsletter-submit');
  const feedbackEl = document.getElementById('newsletter-feedback');
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  function showFeedback(text, ok=true) {
    feedbackEl.style.display = 'block';
    feedbackEl.classList.remove('text-danger','text-success');
    feedbackEl.classList.add(ok ? 'text-success' : 'text-danger');
    feedbackEl.textContent = text;
  }

  async function postJSON(url, data) {
    const res = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token,
        'Accept': 'application/json'
      },
      body: JSON.stringify(data)
    });
    // Laravel ভ্যালিডেশন হলে 422 আসতে পারে
    const isJson = res.headers.get('content-type')?.includes('application/json');
    const body = isJson ? await res.json() : {};
    if (!res.ok) {
      const msg = body?.message || 'Something went wrong';
      throw { status: res.status, body, message: msg };
    }
    return body;
  }

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    feedbackEl.style.display = 'none';

    // HTML5 validation first
    if (!form.checkValidity()) {
      form.classList.add('was-validated');
      return;
    }

    submitBtn.disabled = true;
    submitBtn.textContent = 'Joining...';

    try {
      const data = { email: emailInput.value.trim() };
      const res  = await postJSON('/newsletter/subscribe', data);
      showFeedback(res.message || 'Check your inbox to confirm subscription.', true);
      form.reset();
      form.classList.remove('was-validated');
    } catch (err) {
      if (err.status === 422) {
        // Laravel validation errors
        const firstError = Object.values(err.body.errors || {})[0]?.[0] || 'Invalid email';
        showFeedback(firstError, false);
        emailInput.classList.add('is-invalid');
      } else {
        showFeedback(err.message || 'Failed to subscribe', false);
      }
    } finally {
      submitBtn.disabled = false;
      submitBtn.textContent = 'Join';
    }
  });
})();
