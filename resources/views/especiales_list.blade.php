<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Especiales</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 32px;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
        }
        .success {
            color: #27ae60;
            background: #e8f5e9;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .especiales-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .especial {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .especial:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .especial h3 {
            font-size: 20px;
            color: #34495e;
            margin: 0 0 10px 0;
            font-weight: 500;
        }
        .especial p {
            font-size: 14px;
            color: #7f8c8d;
            margin: 5px 0;
        }
        .especial img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .btn {
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-size: 14px;
            transition: background-color 0.3s ease;
            text-align: center;
        }
        .btn-edit {
            background-color: #3498db;
            flex: 1;
        }
        .btn-edit:hover {
            background-color: #2980b9;
        }
        .btn-delete {
            background-color: #e74c3c;
            flex: 1;
        }
        .btn-delete:hover {
            background-color: #c0392b;
        }
        .btn-add {
            background-color: #2ecc71;
            display: inline-block;
            padding: 12px 20px;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .btn-add:hover {
            background-color: #27ae60;
        }
        .no-items {
            text-align: center;
            color: #7f8c8d;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Especiales</h1>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('especiales.create') }}" class="btn btn-add">Agregar Nuevo Especial</a>

        @if ($especiales->isEmpty())
            <p class="no-items">No hay especiales registrados.</p>
        @else
            <div class="especiales-grid">
                @foreach ($especiales as $especial)
                    <div class="especial">
                        @if ($especial->fotos->isNotEmpty())
                            <img src="{{ asset('storage/' . $especial->fotos->first()->foto_path) }}" alt="{{ $especial->nombre }}">
                        @else
                            <div style="width: 100%; height: 150px; background: #ecf0f1; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #7f8c8d;">Sin foto</div>
                        @endif
                        <h3>{{ $especial->nombre }}</h3>
                        <p>{{ Str::limit($especial->descripcion, 50) }}</p>
                        <p>Categoría: {{ $especial->categoria }}</p>
                        <p>Tipo: {{ $especial->tipo }}</p>
                        <div class="actions">
                            <a href="{{ route('especiales.edit', $especial->id) }}" class="btn btn-edit">Editar</a>
                            <form action="{{ route('especiales.destroy', $especial->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" onclick="return confirm('¿Seguro que deseas eliminar este especial?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>