@props(['email' => ''])

<div class="fv-row mb-10 fv-plugins-icon-container">
    <!--begin::Label-->
    <label class="form-label fs-6 fw-bolder text-dark">Email</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="off" value="{{ old('email', $email) }}" required autofocus>
    <!--end::Input-->
</div>
