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
                <td>{{ $value->correlativo }}</td>
                <td>{{ $value->nombre }}</td>
                <td>{{ $value->dui }}</td>
                <td>{{ $value->tel }}</td>
            </tr>
        @endforeach
    </table>
</body>