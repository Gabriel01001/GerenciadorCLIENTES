<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel IPTV - EMX Systems</title>
    <style>
        :root { --primary: #007bff; --success: #28a745; --danger: #dc3545; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: auto; background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h2 { color: #333; margin-top: 0; display: flex; justify-content: space-between; align-items: center; }
        
        /* Formulário */
        .form-group { display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 10px; margin-bottom: 20px; background: #f8f9fa; padding: 15px; border-radius: 8px; }
        input, select { padding: 10px; border: 1px solid #ddd; border-radius: 5px; outline: none; }
        button.add-btn { background: var(--success); color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold; }

        /* Tabela */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: var(--primary); color: white; text-align: left; padding: 12px; }
        td { padding: 12px; border-bottom: 1px solid #eee; }
        .status-badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
        .status-ativo { background: #d4edda; color: #155724; }
        .status-vencido { background: #f8d7da; color: #721c24; }
        
        .whatsapp-btn { color: #25d366; text-decoration: none; font-size: 1.2em; font-weight: bold; }
        .delete-btn { color: var(--danger); cursor: pointer; border: none; background: none; margin-left: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h2>🚀 IPTV Manager <small style="font-size: 0.5em; color: #666;">v1.0</small></h2>

    <div class="form-group">
        <input type="text" id="nome" placeholder="Nome do Cliente">
        <input type="text" id="whatsapp" placeholder="WhatsApp (Ex: 5511999999999)">
        <input type="date" id="vencimento">
        <button class="add-btn" onclick="adicionarCliente()">Adicionar</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Vencimento</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="tabelaCorpo">
            </tbody>
    </table>
</div>

<script>
    let clientes = JSON.parse(localStorage.getItem('clientes_iptv')) || [];

    function salvarNoStorage() {
        localStorage.setItem('clientes_iptv', JSON.stringify(clientes));
        renderizarTabela();
    }

    function adicionarCliente() {
        const nome = document.getElementById('nome').value;
        const whatsapp = document.getElementById('whatsapp').value;
        const vencimento = document.getElementById('vencimento').value;

        if (!nome || !vencimento) return alert("Preencha Nome e Data!");

        clientes.push({ nome, whatsapp, vencimento, id: Date.now() });
        salvarNoStorage();
        
        // Limpar campos
        document.getElementById('nome').value = '';
        document.getElementById('whatsapp').value = '';
        document.getElementById('vencimento').value = '';
    }

    function excluirCliente(id) {
        clientes = clientes.filter(c => c.id !== id);
        salvarNoStorage();
    }

    function verificarStatus(dataVencimento) {
        const hoje = new Date();
        const venc = new Date(dataVencimento);
        // Ajuste de fuso horário para a data não "voltar" um dia
        venc.setMinutes(venc.getMinutes() + venc.getTimezoneOffset());
        
        return venc >= hoje ? 'ativo' : 'vencido';
    }

    function renderizarTabela() {
        const corpo = document.getElementById('tabelaCorpo');
        corpo.innerHTML = '';

        clientes.forEach(cliente => {
            const status = verificarStatus(cliente.vencimento);
            const dataFormatada = cliente.vencimento.split('-').reverse().join('/');
            
            const msgZap = window.encodeURIComponent(`Olá ${cliente.nome}, sua assinatura IPTV vence dia ${dataFormatada}. Vamos renovar?`);

            corpo.innerHTML += `
                <tr>
                    <td><strong>${cliente.nome}</strong></td>
                    <td>${dataFormatada}</td>
                    <td><span class="status-badge status-${status}">${status}</span></td>
                    <td>
                        <a class="whatsapp-btn" href="https://wa.me/${cliente.whatsapp}?text=${msgZap}" target="_blank">📲</a>
                        <button class="delete-btn" onclick="excluirCliente(${cliente.id})">🗑️</button>
                    </td>
                </tr>
            `;
        });
    }

    // Carregar dados ao abrir
    renderizarTabela();
</script>

</body>
</html>
