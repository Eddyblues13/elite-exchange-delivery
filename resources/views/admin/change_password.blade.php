@include('admin.header')

<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            <div class="mt-2 mb-4">
                <h1 class="title1 text-dark">Account Settings</h1>
                <p class="text-muted">Update your admin email address and password.</p>
            </div>

            <div class="row">

                {{-- Update Email --}}
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom d-flex align-items-center" style="gap:10px;">
                            <div style="width:36px;height:36px;border-radius:9px;background:#eff6ff;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-envelope" style="color:#2563eb;font-size:0.9rem;"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 text-dark font-weight-bold">Update Email</h5>
                                <small class="text-muted">Current: <strong>{{ auth('admin')->user()->email }}</strong></small>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="updateEmailForm">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="text-dark font-weight-bold">New Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Enter new email address" required>
                                    <span class="text-danger small" id="email_error"></span>
                                </div>

                                <div class="form-group">
                                    <label class="text-dark font-weight-bold">Current Password <span class="text-muted font-weight-normal">(to confirm)</span></label>
                                    <div class="input-group">
                                        <input type="password" name="current_password" id="email_current_password"
                                            class="form-control" placeholder="Enter your current password" required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="email_current_password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger small" id="email_current_password_error"></span>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block" id="emailSubmitBtn">
                                    <i class="fas fa-save mr-1"></i> Update Email
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Change Password --}}
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom d-flex align-items-center" style="gap:10px;">
                            <div style="width:36px;height:36px;border-radius:9px;background:#faf5ff;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-lock" style="color:#7c3aed;font-size:0.9rem;"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 text-dark font-weight-bold">Change Password</h5>
                                <small class="text-muted">Choose a strong password</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="changePasswordForm">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="text-dark font-weight-bold">Current Password</label>
                                    <div class="input-group">
                                        <input type="password" name="current_password" id="current_password"
                                            class="form-control" placeholder="Enter current password" required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="current_password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger small" id="current_password_error"></span>
                                </div>

                                <div class="form-group">
                                    <label class="text-dark font-weight-bold">New Password</label>
                                    <div class="input-group">
                                        <input type="password" name="new_password" id="new_password"
                                            class="form-control" placeholder="Enter new password" required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="new_password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger small" id="new_password_error"></span>
                                </div>

                                <div class="form-group">
                                    <label class="text-dark font-weight-bold">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                            class="form-control" placeholder="Confirm new password" required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary toggle-pw" data-target="new_password_confirmation">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block" id="passwordSubmitBtn">
                                    <i class="fas fa-key mr-1"></i> Change Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>{{-- /row --}}
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    toastr.options = {
        closeButton: true, progressBar: true,
        positionClass: 'toast-top-right', timeOut: 5000
    };

    const adminId = "{{ auth('admin')->user()->id }}";

    // Toggle password visibility
    $(document).on('click', '.toggle-pw', function () {
        const target = $('#' + $(this).data('target'));
        const isText = target.attr('type') === 'text';
        target.attr('type', isText ? 'password' : 'text');
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });

    // ── Update Email ────────────────────────────────────
    $('#updateEmailForm').on('submit', function (e) {
        e.preventDefault();
        $('#email_error, #email_current_password_error').text('');

        const btn = $('#emailSubmitBtn');
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Updating...');

        $.ajax({
            url: '{{ route('admin.update-email') }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                toastr.success(res.message);
                $('#updateEmailForm')[0].reset();
                // Update the displayed current email
                $('small strong').first().text($('#email').val() || '');
            },
            error: function (xhr) {
                const res = xhr.responseJSON;
                if (xhr.status === 422 && res.errors) {
                    if (res.errors.email)            $('#email_error').text(res.errors.email[0]);
                    if (res.errors.current_password) $('#email_current_password_error').text(res.errors.current_password[0]);
                    toastr.warning(res.message, 'Validation Error');
                } else {
                    toastr.error(res?.message || 'An error occurred.', 'Error');
                }
            },
            complete: function () {
                btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Update Email');
            }
        });
    });

    // ── Change Password ─────────────────────────────────
    $('#changePasswordForm').attr('action', `/admin/${adminId}/change-password`);

    $('#changePasswordForm').on('submit', function (e) {
        e.preventDefault();
        $('#current_password_error, #new_password_error').text('');

        const btn = $('#passwordSubmitBtn');
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Updating...');

        $.ajax({
            url: `/admin/${adminId}/change-password`,
            type: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                toastr.success(res.message);
                $('#changePasswordForm')[0].reset();
            },
            error: function (xhr) {
                const res = xhr.responseJSON;
                if (xhr.status === 422 && res.errors) {
                    if (res.errors.current_password) $('#current_password_error').text(res.errors.current_password[0]);
                    if (res.errors.new_password)     $('#new_password_error').text(res.errors.new_password[0]);
                    toastr.warning(res.message, 'Validation Error');
                } else {
                    toastr.error(res?.message || 'An error occurred.', 'Error');
                }
            },
            complete: function () {
                btn.prop('disabled', false).html('<i class="fas fa-key mr-1"></i> Change Password');
            }
        });
    });
});
</script>

@include('admin.footer')
