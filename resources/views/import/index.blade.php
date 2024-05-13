
@if (session('error'))
<div class="alert flex flex-row items-center bg-green-200 p-5 rounded border-b-2 border-green-300">
        <div class="alert-description text-sm text-green-600">
            {{session('error')}}
        </div>

</div>
@endif

<form action="{{ route('importar') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv_file" required>
    <button type="submit">Importar</button>
</form>
