<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Clientes IPTV</title>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; margin: 20px; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { color: #333; border-bottom: 2px solid #007bff; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #007bff; color: white; }
        .status { padding: 5px 10px; border-radius: 4px; font-size: 0.8em; font-weight: bold; }
        .ativo { background: #d4edda; color: #155724; }
        .vencido { background: #f8d7da; color: #721c24; }
        .btn-add { background: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; }
    </style>
</head>
<body>

<div class="container">
    <h2>🚀 Gerenciador de Clientes IPTV</h2>
    <button class="btn-add">+ Novo Cliente</button>

    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Plano</th>
                <th>Vencimento</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>João Silva</td>
                <td>Mensal</td>
                <td>15/02/2026</td>
                <td><span class="status ativo">ATIVO</span></td>
                <td><button>⚙️</button></td>
            </tr>
            <tr>
                <td>Maria Souza</td>
                <td>Trimestral</td>
                <td>20/01/2026</td>
                <td><span class="status vencido">VENCIDO</span></td>
                <td><button>⚙️</button></td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
