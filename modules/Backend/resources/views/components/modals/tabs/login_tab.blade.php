<p class="mt-2">Connect to your Your Clean Team Account and activate {{ $moduleName }}</p>

<form method="post" action="{{ route('admin.module.login-Your Clean Team') }}" id="form-login-Your Clean Team">
    <input type="hidden" name="module" value="{{ $name }}">

    @csrf

    {{ Field::text(trans('cms::app.email'), 'email', [
        'required' => true,
        'data' => [
            'rule-email' => true,
        ],
    ]) }}

    {{ Field::text(trans('cms::app.password'), 'password', [
        'required' => true,
        'type' => 'password',
    ]) }}

    <button type="submit" class="btn btn-primary">
        Connect to Account
    </button>
</form>
