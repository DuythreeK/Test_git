<!-- Toast Notification Component -->
<div id="toast-container" class="toast-container" aria-live="polite" aria-atomic="true"></div>

<style>
    /* Toast Container */
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 99999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 380px;
        width: calc(100% - 40px);
        pointer-events: none;
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    /* Toast Card */
    .toast-item {
        pointer-events: auto;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        background: #ffffff;
        color: #1f2937;
        padding: 12px 16px;
        border-radius: 10px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
        transform: translateX(120%);
        opacity: 0;
        transition: transform 0.35s cubic-bezier(0.21, 1.02, 0.73, 1), opacity 0.35s ease;
    }

    .toast-item.toast-show {
        transform: translateX(0);
        opacity: 1;
    }

    .toast-item.toast-hiding {
        transform: translateX(120%);
        opacity: 0;
    }

    /* Toast Accent Variants */
    .toast-item.toast-success {
        border-left: 4px solid #10b981;
    }

    .toast-item.toast-success .toast-icon-bg {
        background-color: #ecfdf5;
        color: #10b981;
    }

    .toast-item.toast-error {
        border-left: 4px solid #ef4444;
    }

    .toast-item.toast-error .toast-icon-bg {
        background-color: #fef2f2;
        color: #ef4444;
    }

    .toast-item.toast-warning {
        border-left: 4px solid #f59e0b;
    }

    .toast-item.toast-warning .toast-icon-bg {
        background-color: #fffbeb;
        color: #f59e0b;
    }

    .toast-item.toast-info {
        border-left: 4px solid #3b82f6;
    }

    .toast-item.toast-info .toast-icon-bg {
        background-color: #eff6ff;
        color: #3b82f6;
    }

    /* Icon Container */
    .toast-icon-bg {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .toast-icon-bg svg {
        width: 18px;
        height: 18px;
    }

    /* Content Area */
    .toast-content {
        flex-grow: 1;
        padding-right: 6px;
    }

    .toast-title {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 2px;
        color: #111827;
        line-height: 1.3;
    }

    .toast-message {
        font-size: 0.85rem;
        color: #4b5563;
        line-height: 1.4;
        word-break: break-word;
    }

    /* Close Button */
    .toast-close {
        background: transparent;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 2px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.15s ease, background-color 0.15s ease;
        flex-shrink: 0;
        margin-left: auto;
    }

    .toast-close:hover {
        color: #374151;
        background-color: #f3f4f6;
    }

    .toast-close svg {
        width: 14px;
        height: 14px;
    }

    /* Progress Bar */
    .toast-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.06);
    }

    .toast-progress-fill {
        height: 100%;
        width: 100%;
    }

    .toast-success .toast-progress-fill {
        background-color: #10b981;
    }

    .toast-error .toast-progress-fill {
        background-color: #ef4444;
    }

    .toast-warning .toast-progress-fill {
        background-color: #f59e0b;
    }

    .toast-info .toast-progress-fill {
        background-color: #3b82f6;
    }
</style>

<script>
    (function() {
        const toastIcons = {
            success: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>`,
            error: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>`,
            warning: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`,
            info: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`
        };

        const defaultTitles = {
            success: 'Success',
            error: 'Error',
            warning: 'Warning',
            info: 'Infor'
        };

        function getContainer() {
            let container = document.getElementById('toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toast-container';
                container.className = 'toast-container';
                document.body.appendChild(container);
            }
            return container;
        }

        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.innerText = text;
            return div.innerHTML;
        }

        window.showToast = function(message, type = 'success', title = null, duration = 4000) {
            const container = getContainer();
            const toastType = toastIcons[type] ? type : 'info';
            const toastTitle = title !== null ? title : defaultTitles[toastType];

            const toast = document.createElement('div');
            toast.className = `toast-item toast-${toastType}`;
            toast.setAttribute('role', 'alert');

            toast.innerHTML = `
            <div class="toast-icon-bg">
                ${toastIcons[toastType]}
            </div>
            <div class="toast-content">
                ${toastTitle ? `<div class="toast-title">${escapeHtml(toastTitle)}</div>` : ''}
                <div class="toast-message">${escapeHtml(message)}</div>
            </div>
            <button type="button" class="toast-close" aria-label="Close">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            ${duration > 0 ? `<div class="toast-progress"><div class="toast-progress-fill"></div></div>` : ''}
        `;

            container.appendChild(toast);

            requestAnimationFrame(() => {
                toast.classList.add('toast-show');
            });

            const closeBtn = toast.querySelector('.toast-close');
            let timer = null;
            let startTime = Date.now();
            let remaining = duration;
            const progressFill = toast.querySelector('.toast-progress-fill');

            function dismiss() {
                if (timer) clearTimeout(timer);
                toast.classList.remove('toast-show');
                toast.classList.add('toast-hiding');
                toast.addEventListener('transitionend', () => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, {
                    once: true
                });
            }

            closeBtn.addEventListener('click', dismiss);

            if (duration > 0 && progressFill) {
                progressFill.style.transition = `width ${duration}ms linear`;
                requestAnimationFrame(() => {
                    progressFill.style.width = '0%';
                });

                timer = setTimeout(dismiss, duration);

                // Pause countdown on hover
                toast.addEventListener('mouseenter', () => {
                    if (timer) clearTimeout(timer);
                    const elapsed = Date.now() - startTime;
                    remaining = Math.max(0, remaining - elapsed);
                    const computedWidth = getComputedStyle(progressFill).width;
                    progressFill.style.transition = 'none';
                    progressFill.style.width = computedWidth;
                });

                toast.addEventListener('mouseleave', () => {
                    if (remaining > 0) {
                        startTime = Date.now();
                        progressFill.style.transition = `width ${remaining}ms linear`;
                        requestAnimationFrame(() => {
                            progressFill.style.width = '0%';
                        });
                        timer = setTimeout(dismiss, remaining);
                    }
                });
            }
        };

        window.toast = {
            show: window.showToast,
            success: (msg, title, duration) => window.showToast(msg, 'success', title, duration),
            error: (msg, title, duration) => window.showToast(msg, 'error', title, duration),
            warning: (msg, title, duration) => window.showToast(msg, 'warning', title, duration),
            info: (msg, title, duration) => window.showToast(msg, 'info', title, duration)
        };

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                window.showToast(@json(session('success')), 'success');
            @endif

            @if (session('error'))
                window.showToast(@json(session('error')), 'error');
            @endif

            @if (session('warning'))
                window.showToast(@json(session('warning')), 'warning');
            @endif

            @if (session('info'))
                window.showToast(@json(session('info')), 'info');
            @endif

            @if (isset($errors) && $errors->any())
                @foreach ($errors->all() as $error)
                    window.showToast(@json($error), 'error', 'Lỗi nhập liệu');
                @endforeach
            @endif
        });
    })();
</script>
