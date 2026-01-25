/**
 * Standalone Toast Manager System
 * Can be used anywhere in the theme for consistent notifications
 */
class ToastManager {
    constructor() {
        this.initialized = false;
        this.init();
    }

    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.createContainer());
        } else {
            this.createContainer();
        }
    }

    createContainer() {
        // Create toast container if it doesn't exist
        if (!document.querySelector('.toast-container')) {
            const container = document.createElement('div');
            container.className = 'toast-container position-fixed top-0 end-0 p-3';
            container.style.zIndex = '9999';
            document.body.appendChild(container);
        }
        this.initialized = true;
    }

    show(type, message, options = {}) {
        // Ensure container is created first
        if (!this.initialized) {
            this.createContainer();
        }

        const defaults = {
            delay: 4000,
            autohide: true,
            position: 'top-right'
        };
        const settings = { ...defaults, ...options };

        const toastId = 'toast-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);

        const toastElement = document.createElement('div');
        toastElement.id = toastId;
        toastElement.className = `toast align-items-center border-0 ${this.getToastClass(type)} text-white`;
        toastElement.setAttribute('role', 'alert');
        toastElement.setAttribute('aria-live', 'assertive');
        toastElement.setAttribute('aria-atomic', 'true');

        const iconClass = this.getIconClass(type);

        toastElement.innerHTML = `
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="${iconClass} me-2"></i>
                    <span>${message}</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" 
                        data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;

        // Add to container
        const container = document.querySelector('.toast-container');
        if (container) {
            container.appendChild(toastElement);

            // Initialize Bootstrap toast if available
            if (typeof bootstrap !== 'undefined' && bootstrap.Toast) {
                const bsToast = new bootstrap.Toast(toastElement, {
                    delay: settings.delay,
                    autohide: settings.autohide
                });
                bsToast.show();
            } else {
                // Fallback: show toast manually and hide after delay
                toastElement.style.display = 'block';
                if (settings.autohide) {
                    setTimeout(() => {
                        toastElement.style.opacity = '0';
                        setTimeout(() => {
                            if (toastElement.parentNode) {
                                toastElement.parentNode.removeChild(toastElement);
                            }
                        }, 300);
                    }, settings.delay);
                }
            }

            // Remove element after hidden
            toastElement.addEventListener('hidden.bs.toast', () => {
                if (toastElement.parentNode) {
                    toastElement.parentNode.removeChild(toastElement);
                }
            });
        } else {
            console.warn('Toast container not found, showing alert instead:', message);
            alert(message);
        }

        return toastId;
    }

    success(message, options = {}) {
        return this.show('success', message, options);
    }

    error(message, options = {}) {
        return this.show('error', message, options);
    }

    warning(message, options = {}) {
        return this.show('warning', message, options);
    }

    info(message, options = {}) {
        return this.show('info', message, options);
    }

    getToastClass(type) {
        const classes = {
            'success': 'bg-success',
            'error': 'bg-danger',
            'warning': 'bg-warning',
            'info': 'bg-info'
        };
        return classes[type] || 'bg-secondary';
    }

    getIconClass(type) {
        const icons = {
            'success': 'fas fa-check-circle',
            'error': 'fas fa-exclamation-triangle',
            'warning': 'fas fa-exclamation-circle',
            'info': 'fas fa-info-circle'
        };
        return icons[type] || 'fas fa-bell';
    }

    // Remove all toasts
    clearAll() {
        const toasts = document.querySelectorAll('.toast');
        toasts.forEach(toast => {
            const bsToast = bootstrap.Toast.getInstance(toast);
            if (bsToast) {
                bsToast.hide();
            }
        });
    }
}

// Wait for DOM to be ready before creating global instance
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeToastManager);
} else {
    initializeToastManager();
}

function initializeToastManager() {
    // Create global instance
    window.ToastManager = new ToastManager();

    // Backward compatibility aliases
    window.showToast = function (type, message, options) {
        return window.ToastManager.show(type, message, options);
    };

    window.showSuccessToast = function (message, options) {
        return window.ToastManager.success(message, options);
    };

    window.showErrorToast = function (message, options) {
        return window.ToastManager.error(message, options);
    };

    window.showWarningToast = function (message, options) {
        return window.ToastManager.warning(message, options);
    };

    window.showInfoToast = function (message, options) {
        return window.ToastManager.info(message, options);
    };
} 