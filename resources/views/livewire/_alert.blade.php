<div>
    @push('script')
    <script>
        document.addEventListener('livewire:init', function() {
            // Modal Control Functions
            Livewire.on('openModal', (modalId) => {
                const modalElement = document.getElementById(modalId);
                if (modalElement) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }
            });

            Livewire.on('closeModal', (modalId) => {
                const modalElement = document.getElementById(modalId);
                if (modalElement) {
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    modal?.hide();
                }
            });

            // Alert Toast Functions
            Livewire.on('showAlert', (options) => {
                const defaults = {
                    title: options.type === 'error' ? 'Error' : 'Success',
                    text: options.message,
                    icon: options.type || 'success',
                    buttons: {
                        confirm: {
                            text: "Ok",
                            value: true,
                            visible: true,
                            className: options.type === 'error' ? "btn btn-danger" : "btn btn-success",
                            closeModal: true
                        }
                    },
                    timer: options.timer || 2000,
                    timerProgressBar: true
                };

                swal(defaults);

                if (options.closeModal) {
                    const modalElement = document.getElementById(options.modalId);
                    if (modalElement) {
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        modal?.hide();
                    }
                }

                if (options.reload) {
                    setTimeout(() => window.location.reload(), options.timer || 1000);
                }
            });

            // Specific Event Handlers
            Livewire.on('addAlertToast', () => {
                Livewire.dispatch('showAlert', {
                    type: 'success',
                    message: 'Data has been successfully added',
                    closeModal: true,
                    modalId: 'addModal'
                });
            });

            Livewire.on('updateAlertToast', () => {
                Livewire.dispatch('showAlert', {
                    type: 'success',
                    message: 'Data has been successfully updated',
                    closeModal: true,
                    modalId: 'editModal'
                });
            });

            Livewire.on('deleteAlertToast', () => {
                Livewire.dispatch('showAlert', {
                    type: 'success',
                    message: 'Data has been successfully deleted',
                    reload: true,
                    timer: 1000
                });
            });

            Livewire.on('errorAlertToast', () => {
                Livewire.dispatch('showAlert', {
                    type: 'error',
                    message: 'An error occurred while processing your request'
                });
            });
        });
    </script>
    @endpush
</div>
