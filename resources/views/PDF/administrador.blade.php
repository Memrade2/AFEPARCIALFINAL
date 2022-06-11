<body>
    <table width="100%" border="1px">
        <tr>
            <td>Correlativo</td>
            <td>Nombre</td>
            <td>DUI</td>
            <td>Telefono</td>
        </tr>
        @foreach ($administrador as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->administrator_name }}</td>
                <td>{{ $value->dui }}</td>
                <td>{{ $value->phone }}</td>
            </tr>
        @endforeach
    </table>
</body>