document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function showFlashMessage(message) {
        const flash = document.getElementById('flashMessage');
        const flashText = document.getElementById('flashMessageText');

        flashText.textContent = message;
        flash.style.display = 'block';

        setTimeout(() => {
            flash.style.display = 'none';
        }, 3000);
    }

    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
            const articleId = btn.dataset.articleId;
            const countSpan = btn.querySelector('.like-count');

            try {
                const res = await fetch(`/articles/${articleId}/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                });

                const data = await res.json();

                if (res.status === 401) {
                    showFlashMessage(data.message);
                    return;
                }

                if (!res.ok) throw new Error('Ошибка сервера');

                countSpan.textContent = data.count;

                if (data.liked) {
                    btn.classList.add('liked');
                } else {
                    btn.classList.remove('liked');
                }

            } catch (err) {

            }
        });
    });
});
