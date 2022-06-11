<body>
    <h1>Reporte de Empleados</h1>
    <table width="100%" border="1px">
        <tr>
            <td>Correlativo</td>
            <td>Nombre</td>
            <td>Edad</td>
            <td>Salario</td>
            <td>Direccion</td>
        </tr>
        @foreach ($employee as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->employee_name }}</td>
                <td>{{ $value->age }}</td>
                <td>{{ $value->base_salary }}</td>
                <td>{{ $value->address }}</td>
            </tr>
        @endforeach
    </table>
</body>