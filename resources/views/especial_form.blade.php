<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($especial) ? 'Editar Especial' : 'Agregar Especial' }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 700px;
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
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 16px;
            color: #34495e;
            font-weight: 500;
            margin-bottom: 8px;
        }
        input, textarea, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            background: #f9f9f9;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        input:focus, textarea:focus, select:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
            outline: none;
        }
        textarea {
            height: 120px;
            resize: vertical;
        }
        select {
            appearance: none;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTcgMTBsNS41IDUuNSA1LjUtNS41IiBzdHJva2U9IiM3ZjhjOGQiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+Cjwvc3ZnPgo=');
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 20px;
        }
        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }
        button, .btn-secondary {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        button {
            background-color: #2ecc71;
            color: white;
        }
        button:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
        }
        .btn-secondary {
            background-color: #ecf0f1;
            color: #34495e;
            border: 1px solid #dcdcdc;
        }
        .btn-secondary:hover {
            background-color: #dfe4ea;
            transform: translateY(-2px);
        }
        .alert-danger, .alert-success {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-danger {
            background-color: #fce4e4;
            color: #c0392b;
        }
        .alert-success {
            background-color: #e8f5e9;
            color: #27ae60;
        }
        .photo-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }
        .photo {
            position: relative;
            width: 120px;
        }
        .photo img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .photo button {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            font-size: 12px;
            line-height: 24px;
            transition: background-color 0.3s ease;
        }
        .photo button:hover {
            background: #c0392b;
        }
        .photo-inputs {
            margin-top: 10px;
        }
        .photo-inputs input {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px dashed #dcdcdc;
            background: #fff;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ isset($especial) ? 'Editar Especial' : 'Agregar Especial' }}</h1>

        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ isset($especial) ? route('especiales.update', $especial->id) : route('especiales.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($especial))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $especial->nombre ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" required>{{ old('descripcion', $especial->descripcion ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="categoria">Categoría</label>
                <select name="categoria" id="categoria" required>
                    <option value="">Selecciona una categoría</option>
                    <option value="Textil" {{ old('categoria', $especial->categoria ?? '') == 'Textil' ? 'selected' : '' }}>Textil</option>
                    <option value="Promocional" {{ old('categoria', $especial->categoria ?? '') == 'Promocional' ? 'selected' : '' }}>Promocional</option>
                    <option value="Otros" {{ old('categoria', $especial->categoria ?? '') == 'Otros' ? 'selected' : '' }}>Otros</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" name="tipo" id="tipo" value="{{ old('tipo', $especial->tipo ?? '') }}" required>
            </div>

            @if (isset($especial) && $especial->fotos->isNotEmpty())
                <div class="form-group">
                    <label>Fotos Existentes</label>
                    <div class="photo-grid">
                        @foreach ($especial->fotos as $foto)
                            <div class="photo">
                                <img src="{{ asset('storage/' . $foto->foto_path) }}" alt="Foto">
                                <form action="{{ route('especial-fotos.destroy', $foto->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar esta foto?')">X</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="form-group">
                <label>Fotos Nuevas</label>
                <div id="photo-inputs" class="photo-inputs">
                    <input type="file" name="fotos[]" multiple accept="image/*">
                </div>
                <button type="button" onclick="addPhotoInput()" style="background: #3498db; margin-top: 10px;">Agregar Más Fotos</button>
            </div>

            <div class="form-actions">
                <button type="submit">{{ isset($especial) ? 'Actualizar' : 'Guardar' }}</button>
                <a href="{{ route('especiales.index') }}" class="btn-secondary">Ver Lista</a>
            </div>
        </form>
    </div>

    <script>
        function addPhotoInput() {
            const photoInputs = document.getElementById('photo-inputs');
            const newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'fotos[]';
            newInput.multiple = true;
            newInput.accept = 'image/*';
            newInput.style.marginTop = '10px';
            photoInputs.appendChild(newInput);
        }
    </script>
</body>
</html>