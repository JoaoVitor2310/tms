@if(session('error_message'))
    <div id="error_message" class="alert alert-danger">
        <i class="bi bi-exclamation-circle-fill"></i> <!-- Ícone de exclamação -->
        {{ session('error_message') }}
    </div>
@endif

@if(session('success_message'))
    <div id="success_message" class="alert alert-success">
        <i class="bi bi-check-circle-fill"></i> <!-- Ícone de check -->
        {{ session('success_message') }}
    </div>
@endif