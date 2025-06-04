<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-simplebar>
        <div class="mb-4 d-flex align-items-center justify-content-between">
            <a href="/" class="text-nowrap logo-img ms-0 ms-md-1">
                <strong style="font-size:40px; color:#4492ff;"> MK <b style="color:#121111">LDA</b></strong>
            </a>
            <div class="cursor-pointer close-btn d-xl-none d-block sidebartoggler" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pb-2 mb-4">
                <!-- Seção Home -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link primary-hover-bg" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span class="p-2 aside-icon bg-light-primary rounded-3">
                            <i class="ti ti-layout-dashboard fs-7 text-primary"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Dashboard</span>
                    </a>
                </li>

                <!-- Seção Gestão com Dropdown -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
                    <span class="hide-menu">Gestão</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link warning-hover-bg has-arrow" href="javascript:void(0)" aria-expanded="false" data-bs-toggle="collapse" data-bs-target="#gestaoSubmenu" aria-controls="gestaoSubmenu">
                        <span class="p-2 aside-icon bg-light-warning rounded-3">
                            <i class="ti ti-briefcase fs-7 text-warning"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Gestão</span>
                    </a>
                    <ul id="gestaoSubmenu" class="collapse sidebar-submenu">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.clientes') }}">
                                <span class="hide-menu ms-2 ps-1">Clientes</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.produtos') }}">
                                <span class="hide-menu ms-2 ps-1">Produtos</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.fornecedores') }}">
                                <span class="hide-menu ms-2 ps-1">Fornecedores</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.vendas') }}">
                                <span class="hide-menu ms-2 ps-1">Vendas</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.funcionarios') }}">
                                <span class="hide-menu ms-2 ps-1">Funcionários</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.projetos') }}">
                                <span class="hide-menu ms-2 ps-1">Projetos</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.financeiro') }}">
                                <span class="hide-menu ms-2 ps-1">Financeiro</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.contratos') }}">
                                <span class="hide-menu ms-2 ps-1">Contratos</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.ordens-producao') }}">
                                <span class="hide-menu ms-2 ps-1">Ordens de Produção</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.impostos') }}">
                                <span class="hide-menu ms-2 ps-1">Impostos</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.beneficios') }}">
                                <span class="hide-menu ms-2 ps-1">Benefícios</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.withdrawals-loans') }}">
                                <span class="hide-menu ms-2 ps-1">Saques e Empréstimos</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.idh-metricas') }}">
                                <span class="hide-menu ms-2 ps-1">Métricas IDH</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.gestao.atividades') }}">
                                <span class="hide-menu ms-2 ps-1">Atividades</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Seção Relatórios com Dropdown -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
                    <span class="hide-menu">Relatórios</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link success-hover-bg has-arrow" href="javascript:void(0)" aria-expanded="false" data-bs-toggle="collapse" data-bs-target="#relatoriosSubmenu" aria-controls="relatoriosSubmenu">
                        <span class="p-2 aside-icon bg-light-success rounded-3">
                            <i class="ti ti-report fs-7 text-success"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Relatórios</span>
                    </a>
                    <ul id="relatoriosSubmenu" class="collapse sidebar-submenu">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.reports.financial') }}">
                                <span class="hide-menu ms-2 ps-1">Financeiro</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.reports.sales') }}">
                                <span class="hide-menu ms-2 ps-1">Vendas</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Seção Perfil -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
                    <span class="hide-menu">Perfil</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link info-hover-bg" href="{{ route('profile.edit') }}" aria-expanded="false">
                        <span class="p-2 aside-icon bg-light-info rounded-3">
                            <i class="ti ti-user fs-7 text-info"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Editar Perfil</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <div class="sidebar-link mt-4">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">Sair</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
</aside>
