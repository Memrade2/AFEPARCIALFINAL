<body>
    <h1>Reporte de Administradores</h1>
    <table width="100%" border="1px">
        <tr>
            <td>Correlativo</td>
            <td>Nombre</td>
            <td>DUI</td>
            <td>Telefono</td>
        </tr>
        
            <tr>
                <td>{{ $administrador->id }}</td>
                <td>{{ $administrador->administrator_name }}</td>
                <td>{{ $administrador->dui }}</td>
                <td>{{ $administrador->phone }}</td>
            </tr>
        
    </table>
</body>