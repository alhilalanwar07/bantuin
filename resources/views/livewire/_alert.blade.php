<div>
    @push('script')
    <script>
        document.addEventListener('livewire:init', function() {
            // Modal Control Functions
            Livewire.on('openModal', (modalId) => {
                const modal = new bootstrap.Modal(document.getElementById(modalId));
                modal.show();
            });

            Livewire.on('closeModal', (modalId) => {
                const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
                modal?.hide();
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
                    const modal = bootstrap.Modal.getInstance(document.getElementById(options.modalId));
                    modal?.hide();
                }

                if (options.reload) {
                    setTimeout(() => window.location.reload(), options.timer || 1000);
                }
            });

            // Specific Event Handlers (for backward compatibility)
            Livewire.on('addAlertToast', (event) => {
                Livewire.dispatch('showAlert', {
                    type: 'success',
                    message: 'Data has been successfully added',
                    closeModal: true,
                    modalId: 'addModal'
                });
            });

            Livewire.on('updateAlertToast', (event) => {
                Livewire.dispatch('showAlert', {
                    type: 'success',
                    message: 'Data has been successfully updated',
                    closeModal: true,
                    modalId: 'editModal'
                });
            });

            Livewire.on('deleteAlertToast', (event) => {
                Livewire.dispatch('showAlert', {
                    type: 'success',
                    message: 'Data has been successfully deleted',
                    reload: true,
                    timer: 1000
                });
            });

            Livewire.on('errorAlertToast', (event) => {
                Livewire.dispatch('showAlert', {
                    type: 'error',
                    message: 'An error occurred while processing your request'
                });
            });
        });
    </script>
    @endpush
</div>
