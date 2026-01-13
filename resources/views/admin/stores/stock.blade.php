<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Stock – {{ $store->name }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">

    <h1 class="mb-3">Stock du magasin : {{ $store->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Console</th>
                <th>Valeur réelle</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        @forelse($consoles as $console)
            <tr>
                <td>{{ $console->id }}</td>
                <td>{{ $console->type->name }}</td>
                <td>{{ $console->real_value }} €</td>
                <td class="d-flex gap-2">

                    <form method="POST" action="{{ route('admin.consoles.sell', $console) }}">
                        @csrf
                        <button class="btn btn-success btn-sm">Vendre</button>
                    </form>

                    <form method="POST" action="{{ route('admin.consoles.defective', $console) }}">
                        @csrf
                        <button class="btn btn-danger btn-sm">HS</button>
                    </form>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted">
                    Aucune console disponible
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">
        ← Retour dashboard
    </a>

</div>

</body>
</html>


