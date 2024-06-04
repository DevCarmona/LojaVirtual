<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">
                <span class="logo-name">QRA-Store</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>

            <li class="dropdown <?php echo $this->router->fetch_class() == 'home' && $this->router->fetch_method() == 'index' ? 'active' : '' ?>">
                <a href="<?php echo base_url('restrita') ?>" class="nav-link"><i data-feather="home"></i><span>Home</span></a>
            </li>

            
            <li class="dropdown <?php echo $this->router->fetch_class() == 'usuarios' && $this->router->fetch_method() == 'index' ? 'active' : '' ?>">
                <a href="<?php echo base_url('restrita/usuarios') ?>" class="nav-link"><i data-feather="users"></i><span>Usuários</span></a>
            </li>

            <li class="dropdown <?php echo $this->router->fetch_class() == 'marcas' && $this->router->fetch_method() == 'index' ? 'active' : '' ?>">
                <a href="<?php echo base_url('restrita/marcas') ?>" class="nav-link"><i data-feather="layers"></i><span>Marcas</span></a>
            </li>

            <li class="dropdown <?php echo $this->router->fetch_class() == 'produtos' && $this->router->fetch_method() == 'index' ? 'active' : '' ?>">
                <a href="<?php echo base_url('restrita/produtos') ?>" class="nav-link"><i data-feather="archive"></i><span>Produtos</span></a>
            </li>
                        
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="package"></i><span>Categorias</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link <?php echo $this->router->fetch_class() == 'master' && $this->router->fetch_method() == 'index' ? 'active' : '' ?>" href="<?php echo base_url('restrita/master')?>">Categoria pai</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li><a class="nav-link <?php echo $this->router->fetch_class() == 'categorias' && $this->router->fetch_method() == 'index' ? 'active' : '' ?>" href="<?php echo base_url('restrita/categorias')?>">Categoria filho</a></li>
                </ul>
            </li>
                        
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="settings"></i><span>Configurações</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link <?php echo $this->router->fetch_class() == 'sistema' && $this->router->fetch_method() == 'index' ? 'active' : '' ?>" href="<?php echo base_url('restrita/sistema')?>">Sistema</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>