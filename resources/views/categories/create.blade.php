<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori | KueKampus.id</title>
</head>
<body>

    <h1>Tambah Kategori</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nama Kategori</label><br>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="description">Deskripsi Kategori</label><br>
            <textarea
                id="description"
                name="description"
                rows="4"
                cols="40"
            >{{ old('description') }}</textarea>
        </div>

        <br>

        <button type="submit">Simpan Kategori</button>

        <a href="{{ route('categories.index') }}">Kembali</a>
    </form>

</body>
</html>