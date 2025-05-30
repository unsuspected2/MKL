@extends('layouts.admin.body')

@section('title', 'Dashboard')
    
@section('conteudo')
   
<div class="container-fluid">
  <h4><strong>Olá, Bem-vindo {{ Auth::user()->name }}!</strong></h4>
  <p>A gestão eficiente começa aqui. Controle seus produtos, clientes e fornecedores facilmente!</p>
  <div class="row">
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Total de Clientes</h5>
          <p class="card-text">{{ $data['clientes'] }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Total de Produtos</h5>
          <p class="card-text">{{ $data['produtos'] }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Total de Fornecedores</h5>
          <p class="card-text">{{ $data['fornecedores'] }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <h5 class="text-center">Visão Geral de Dados</h5>
    <canvas id="dashboardChart" width="400" height="200"></canvas>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    const dashboardChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Clientes', 'Produtos', 'Fornecedores'], // Nomes dos grupos
        datasets: [{
          label: 'Quantidade Total',
          data: [{{ $data['clientes'] }}, {{ $data['produtos'] }}, {{ $data['fornecedores'] }}], // Quantidade de cada grupo
          backgroundColor: [
            'rgba(75, 192, 192, 0.2)', // Cor para Clientes
            'rgba(54, 162, 235, 0.2)', // Cor para Produtos
            'rgba(255, 99, 132, 0.2)'  // Cor para Fornecedores
          ],
          borderColor: [
            'rgba(75, 192, 192, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 99, 132, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

<div class="row mt-4">
  <!-- Últimos Clientes -->
  <div class="col-md-4">
      <div class="card shadow-sm">
          <div class="card-body">
              <h5>Últimos Clientes</h5>
              <ul class="list-group">
                  @foreach ($ultimosClientes as $cliente)
                      <li class="list-group-item">{{ $cliente->nome}}</li>
                  @endforeach
              </ul>
          </div>
      </div>
  </div>

  <!-- Últimos Produtos -->
  <div class="col-md-4">
      <div class="card shadow-sm">
          <div class="card-body">
              <h5>Últimos Produtos</h5>
              <ul class="list-group">
                  @foreach ($ultimosProdutos as $produto)
                      <li class="list-group-item">{{ $produto->nome }}</li>
                  @endforeach
              </ul>
          </div>
      </div>
  </div>

  <!-- Últimos Fornecedores -->
  <div class="col-md-4">
      <div class="card shadow-sm">
          <div class="card-body">
              <h5>Últimos Fornecedores</h5>
              <ul class="list-group">
                  @foreach ($ultimosFornecedores as $fornecedor)
                      <li class="list-group-item">{{ $fornecedor->nome }}</li>
                  @endforeach
              </ul>
          </div>
      </div>
  </div>
</div>


<div class="card shadow-sm mt-4">
  <div class="card-body">
      <h5>Distribuição Geral</h5>
      <canvas id="distribuicaoChart"></canvas>
  </div>
</div>

<script>
  const ctx = document.getElementById('distribuicaoChart').getContext('2d');
  const distribuicaoChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
          labels: ['Clientes', 'Produtos', 'Fornecedores'],
          datasets: [{
              label: 'Distribuição',
              data: [{{ $data['clientes'] }}, {{ $data['produtos'] }}, {{ $data['fornecedores'] }}],
              backgroundColor: ['#36a2eb', '#ff6384', '#ffcd56'],
          }]
      },
      options: {
          responsive: true,
          plugins: {
              legend: { position: 'top' },
          }
      }
  });
</script>

  
  
  <div class="py-6 px-6 text-center">
    <p class="mb-0 fs-4">&copy;  MK LDA 2025 <a class="pe-1 text-primary text-decoration-underline">❤️</a></p>
  </div>
</div>

@endsection

