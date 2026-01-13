<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Stock — {{ $store->name }}</title>
    <style>
        table { width:100%; border-collapse: collapse }
        th, td { border:1px solid #ccc; padding:8px; text-align:center }
        th { background:#f5f5f5 }
        button { padding:6px 10px }
    </style>
</head>
<body>

<h1>🏪 Stock — {{ $store->name }}</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>Console</th>
            <th>Prix de vente</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse($consoles as $console)
            <tr>
                <td>{{ $console->type->name }}</td>
                <td>
                    {{
                        $console->stores
                            ->where('id', $store->id)
                            ->first()
                            ->pivot
                            ->sale_price
                    }} €
                </td>
                <td>
                    <form method="POST" action="{{ route('store.stock.sell', $console) }}" style="display:inline">
                        @csrf
                        <button>🛒 Vendre</button>
                    </form>

                    <form method="POST" action="{{ route('store.stock.defective', $console) }}" style="display:inline">
                        @csrf
                        <button>❌ HS</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Aucune console disponible</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
