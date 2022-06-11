<body>
    <h1>Reporte del Empleado: {{ $employee->employee_name }}</h1>
    <table width="100%" border="1px">
        <tr>
            <td>Correlativo</td>
            <td>Nombre</td>
            <td>Edad</td>
            <td>Salario</td>
            <td>Direccion</td>
        </tr>
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->employee_name }}</td>
                <td>{{ $employee->age }}</td>
                <td>{{ $employee->base_salary }}</td>
                <td>{{ $employee->address }}</td>
            </tr>
    </table>
</body>