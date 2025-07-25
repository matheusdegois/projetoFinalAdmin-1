<?php
include("conexao.php");

$usuario_id = $_SESSION['id'] ?? null;
$cargo = null;

if ($usuario_id) {
    $sql = $conn->prepare("SELECT cargo FROM usuarios WHERE id = :id");
    $sql->bindValue(":id", $usuario_id);
    $sql->execute();
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);
    $cargo = $usuario['cargo'] ?? null;
}
?>
<div id="main-wrapper">

	<div class="nav-header">
		<a href="index.php" class="brand-logo">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="42" height="40"
				viewBox="0 0 32 30">
				<image
					xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAeCAYAAABNChwpAAAAAXNSR0IArs4c6QAAAfhJREFUWEfFlz1uAkEMhWf6SIloOAESN8hF2EOkSHqqKEqxfSKUmnrpc4bcAAkukCZSTjDhIYwexrP2IqTQsJq/982zZ7yb0z//8lD9zWZT+uZMJpNBa4YGe6I1oAiMC2CJz+fzJ4iuVqt3FrfGehBVAL2YiEJwPB7fLBaLdjabPTIAA+n5NRAToE8cIiysXehzxIJwAWTnbduOsPh6vb7H/3Q6/XKS8QX9vJkQAE9gcQgvl8tPK/YaZLfGM9p2gi7EiQOWOFveZ7d3nGtOmAA6y5umeei67sMT8foFgkNRBbjWzq2kNAG0/V3XvaWUflJKo5zzHrSUcnILDm3fbrdHHoE4OiAAsP8gnpqmwfNrzvlOANCGZ4xhgGi7DsMZAMiwU1mQs17aJTySlJF2jAFwGEB2xzHkEHB/pB3rXAUAzujjyI5xn+Vk2AEhLqX85pxvJQc47joHIC5Wc85YNaKahNJxsPUbtWdotltgEkrXgcMVmq2CU6t+fe21CnnmABcOr4Z7N57VD8hdQcPdghpxPH3mTfjvAJrykh3zHN59rwO1+q3LqwfE4/vE9yfNWswqnbKoJ45+fneQuNdcdQEuCYecChYfBKBDEYXg4xgRr4aAba69auuzjzlaNALufhdYbkTyICIeckCLeV9JQ++QkAPRHV8y7g+n4fMua7ENfwAAAABJRU5ErkJggg=="
					x="0" y="0" width="32" height="30" />
			</svg>
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="111" height="24"
				viewBox="0 0 111 24" class="brand-title">
				<image
					xlink:href="data:image/png;base64,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"
					x="0" y="0" width="111" height="24" />
			</svg>
		</a>
		<div class="nav-control">
			<div class="hanburger">
				<span class="line">
					<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M10.7468 5.58925C11.0722 5.26381 11.0722 4.73617 10.7468 4.41073C10.4213 4.0853 9.89369 4.0853 9.56826 4.41073L4.56826 9.41073C4.25277 9.72622 4.24174 10.2342 4.54322 10.5631L9.12655 15.5631C9.43754 15.9024 9.96468 15.9253 10.3039 15.6143C10.6432 15.3033 10.6661 14.7762 10.3551 14.4369L6.31096 10.0251L10.7468 5.58925Z"
							fill="#452B90" />
						<path opacity="0.3"
							d="M16.5801 5.58924C16.9056 5.26381 16.9056 4.73617 16.5801 4.41073C16.2547 4.0853 15.727 4.0853 15.4016 4.41073L10.4016 9.41073C10.0861 9.72622 10.0751 10.2342 10.3766 10.5631L14.9599 15.5631C15.2709 15.9024 15.798 15.9253 16.1373 15.6143C16.4766 15.3033 16.4995 14.7762 16.1885 14.4369L12.1443 10.0251L16.5801 5.58924Z"
							fill="#452B90" />
					</svg>
				</span>
			</div>
		</div>
	</div>
	<div class="header">
		<div class="offset-11 text-end btn btn-secondary mt-2">
			<a class="nav-link bell dz-theme-mode " href="javascript:void(0);">
				<svg id="icon-light" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
					width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<rect x="0" y="0" width="24" height="24" />
						<path
							d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
							fill="#000000" fill-rule="nonzero" />
						<path
							d="M19.5,10.5 L21,10.5 C21.8284271,10.5 22.5,11.1715729 22.5,12 C22.5,12.8284271 21.8284271,13.5 21,13.5 L19.5,13.5 C18.6715729,13.5 18,12.8284271 18,12 C18,11.1715729 18.6715729,10.5 19.5,10.5 Z M16.0606602,5.87132034 L17.1213203,4.81066017 C17.7071068,4.22487373 18.6568542,4.22487373 19.2426407,4.81066017 C19.8284271,5.39644661 19.8284271,6.34619408 19.2426407,6.93198052 L18.1819805,7.99264069 C17.5961941,8.57842712 16.6464466,8.57842712 16.0606602,7.99264069 C15.4748737,7.40685425 15.4748737,6.45710678 16.0606602,5.87132034 Z M16.0606602,18.1819805 C15.4748737,17.5961941 15.4748737,16.6464466 16.0606602,16.0606602 C16.6464466,15.4748737 17.5961941,15.4748737 18.1819805,16.0606602 L19.2426407,17.1213203 C19.8284271,17.7071068 19.8284271,18.6568542 19.2426407,19.2426407 C18.6568542,19.8284271 17.7071068,19.8284271 17.1213203,19.2426407 L16.0606602,18.1819805 Z M3,10.5 L4.5,10.5 C5.32842712,10.5 6,11.1715729 6,12 C6,12.8284271 5.32842712,13.5 4.5,13.5 L3,13.5 C2.17157288,13.5 1.5,12.8284271 1.5,12 C1.5,11.1715729 2.17157288,10.5 3,10.5 Z M12,1.5 C12.8284271,1.5 13.5,2.17157288 13.5,3 L13.5,4.5 C13.5,5.32842712 12.8284271,6 12,6 C11.1715729,6 10.5,5.32842712 10.5,4.5 L10.5,3 C10.5,2.17157288 11.1715729,1.5 12,1.5 Z M12,18 C12.8284271,18 13.5,18.6715729 13.5,19.5 L13.5,21 C13.5,21.8284271 12.8284271,22.5 12,22.5 C11.1715729,22.5 10.5,21.8284271 10.5,21 L10.5,19.5 C10.5,18.6715729 11.1715729,18 12,18 Z M4.81066017,4.81066017 C5.39644661,4.22487373 6.34619408,4.22487373 6.93198052,4.81066017 L7.99264069,5.87132034 C8.57842712,6.45710678 8.57842712,7.40685425 7.99264069,7.99264069 C7.40685425,8.57842712 6.45710678,8.57842712 5.87132034,7.99264069 L4.81066017,6.93198052 C4.22487373,6.34619408 4.22487373,5.39644661 4.81066017,4.81066017 Z M4.81066017,19.2426407 C4.22487373,18.6568542 4.22487373,17.7071068 4.81066017,17.1213203 L5.87132034,16.0606602 C6.45710678,15.4748737 7.40685425,15.4748737 7.99264069,16.0606602 C8.57842712,16.6464466 8.57842712,17.5961941 7.99264069,18.1819805 L6.93198052,19.2426407 C6.34619408,19.8284271 5.39644661,19.8284271 4.81066017,19.2426407 Z"
							fill="#000000" fill-rule="nonzero" opacity="0.3" />
					</g>
				</svg>
				<svg id="icon-dark" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
					width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<rect x="0" y="0" width="24" height="24" />
						<path
							d="M12.0700837,4.0003006 C11.3895108,5.17692613 11,6.54297551 11,8 C11,12.3948932 14.5439081,15.9620623 18.9299163,15.9996994 C17.5467214,18.3910707 14.9612535,20 12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 C12.0233848,4 12.0467462,4.00010034 12.0700837,4.0003006 Z"
							fill="#000000" />
					</g>
				</svg>
			</a>
		</div>
	</div>

	<?php if ($cargo == 0): ?>
    <!-- Menu com abas restritas -->
    <div class="deznav">
		<div class="deznav-scroll">
			<ul class="metismenu" id="menu">
				<li>
					<h4 style="color: white;" class="text-center nav-text">SISTEMA DE <br> AGENDAMENTOS</h4>
				</li>
				<li>
					<a href="index.php" aria-expanded="false">
						<span class="nav-text">início</span>
					</a>
				</li>
				<li>
					<a href="sair.php" aria-expanded="false">
						<span class="nav-text">Sair</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<?php endif; ?>
	<?php if ($cargo !== 0): ?>
	<div class="deznav">

		<div class="deznav-scroll">

			<ul class="metismenu" id="menu">
				<li>
					<h4 style="color: white;" class="text-center nav-text">SISTEMA DE <br> AGENDAMENTOS</h4>
				</li>
				<li>
					<a href="index.php" aria-expanded="false">
						<span class="nav-text">início</span>
					</a>
				</li>
				<li>
					<a href="usuarios-pesquisar.php" aria-expanded="false">
						<span class="nav-text">Usuários</span>
					</a>
				</li>
				<li>
					<a href="locais-pesquisar.php" class="" aria-expanded="false">
						<span class="nav-text">Locais</span>
					</a>
				</li>
				<li>
					<a href="agendas-pesquisar.php" class="" aria-expanded="false">
						<span class="nav-text">Agendamentos</span>
					</a>
				</li>
				<li>
					<a href="gerir-site.php" class="" aria-expanded="false">
						<span class="nav-text">Gerir Site</span>
					</a>
				</li>
				<li>
					<a href="sair.php" aria-expanded="false">
						<span class="nav-text">Sair</span>
					</a>
				</li>
			</ul>
		</div>

	</div>
	<?php endif; ?>