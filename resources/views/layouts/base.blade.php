<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>{{ config('app.name', 'Laravel' ) }}</title>
	<link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
	<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
	<link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
	<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<!-- Navbar Brand-->
		<a class="navbar-brand ps-3" href="{{ route('home') }}">Inicio</a>
		<!-- Sidebar Toggle-->
		<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
				class="fas fa-bars"></i></button>
		<!-- Navbar Search-->
		<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
			<div class="input-group">
				<input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
					aria-describedby="btnNavbarSearch" />
				<button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
						class="fas fa-search"></i></button>
			</div>
		</form>
		<!-- Navbar-->
		<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
					aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
				<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#!">Perfil</a></li>
					<li>
						<hr class="dropdown-divider" />
					</li>
					<li>
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</li>
				</ul>
			</li>
		</ul>
	</nav>
	<div id="layoutSidenav">
		<div id="layoutSidenav_nav">
			<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
				<div class="sb-sidenav-menu">
					<div class="nav">
						<div class="sb-sidenav-menu-heading">Menú</div>

						<!-- Pieces -->
						<a class="nav-link" href="pieces.php">
							<div class="sb-nav-link-icon"><i class="fas fa-fw fa-wrench"></i></div>
							PIEZAS
						</a>
						<!-- /Pieces -->



						<!-- Statistics -->
						<a class="nav-link" href="pieces_statistics.php">
							<div class="sb-nav-link-icon"><i class="fas fa-fw fa-chart-bar"></i></div>
							ESTADÍSTICAS
						</a>
						<!-- /Statistics -->

						<!-- Inventory -->
						<a class="nav-link" href="inventories.php">
							<div class="sb-nav-link-icon"><i class="fas fa-fw fa-cubes"></i></div>
							INVENTARIOS
						</a>
						<!-- /Inventory -->


						<!-- Histories -->
						<a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
							data-bs-target="#historiesCollapse" aria-expanded="false" aria-controls="historiesCollapse">
							<div class="sb-nav-link-icon"><i class="fas fa-fw fa-table"></i></div>
							HISTORIALES
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>
						<div class="collapse" id="historiesCollapse" aria-labelledby="headingOne"
							data-bs-parent="#sidenavAccordion">
							<nav class="sb-sidenav-menu-nested nav">
								<a class="nav-link" href="pieces_history.php">
									<div class="sb-nav-link-icon"><i class="fas fa-fw fa-wrench"></i></div>
									PIEZAS
								</a>
								<a class="nav-link" href="products_history.php">
									<div class="sb-nav-link-icon"><i class="fas fa-fw fa-cubes"></i></div>
									INVENTARIOS
								</a>
							</nav>
						</div>
						<!-- /Histories -->

						<!-- Settings -->
						<a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#settingsCollapse"
							aria-expanded="false" aria-controls="settingsCollapse">
							<div class="sb-nav-link-icon"><i class="fas fa-fw fa-gears"></i></div>
							CONFIGURACIONES
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>
						<div class="collapse" id="settingsCollapse" aria-labelledby="headingOne"
							data-bs-parent="#sidenavAccordion">
							<nav class="sb-sidenav-menu-nested nav">
								<a class="nav-link" href="categories.php">
									<div class="sb-nav-link-icon"><i class="fas fa-fw fa-tags"></i></div>
									PROYECTO
								</a>
								<a class="nav-link" href="{{ route('customers.index') }}">
									<div class="sb-nav-link-icon"><i class="fas fa-fw fa-users"></i></div>
									CLIENTES
								</a>
								<a class="nav-link" href="employees.php">
									<div class="sb-nav-link-icon"><i class="fas fa-fw fa-users"></i></div>
									ELABORADOR
								</a>
								<a class="nav-link" href="statuses.php">
									<div class="sb-nav-link-icon"><i class="fas fa-fw fa-tags"></i></div>
									ESTATUS
								</a>
								<a class="nav-link" href="users.php">
									<div class="sb-nav-link-icon"><i class="fas fa-fw fa-users"></i></div>
									USUARIOS
								</a>
							</nav>
						</div>
						<!-- /Settings -->
					</div>
				</div>
				<div class="sb-sidenav-footer">
					<div class="small">Logged in as:</div>
					{{ Auth::user()->name }}
				</div>
			</nav>
		</div>
		<div id="layoutSidenav_content">
			<!-- Container -->
			<div class="container-fluid px-3 my-3">
				@yield('content')
			</div>
			<!-- /Container -->

			<footer class="py-3 bg-light mt-auto">
				<div class="container-fluid px-4">
					<div class="text-center small">
						<div class="text-muted">
							{{ "Copyright © " . config('app.name', 'Laravel' ) . " " . date('Y') }}
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
	</script>
	<script src="{{ asset('js/scripts.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
	<script src="assets/demo/chart-area-demo.js"></script>
	<script src="assets/demo/chart-bar-demo.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
		crossorigin="anonymous"></script>
	<script src="js/datatables-simple-demo.js"></script>
</body>

</html>