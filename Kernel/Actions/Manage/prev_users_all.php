<?php
/**
 * MLV intranet v2.0 - Web oficial del intranet del MLV
 * 
 * @link https://github.com/carlosfingles/mlv-intranet
 * @license GNU GPL V3
 * @author Carlos Zambrano (carlosfingles)
 *         Facebook : http://facebook.com/carlosfingles
 *         Twitter : @carlosfingles
 *         Instagram : @carlosfingles
 */

require('./Class/Class.User.php');

error_reporting(E_ALL ^ E_NOTICE);

$cantidad_resultados_por_pagina = 12;

if (isset($_GET["pagina"])) {

	if (is_string($_GET["pagina"])) {

		 if (is_numeric($_GET["pagina"])) {

			 if ($_GET["pagina"] == 1) {
				 $pagina = $_GET["pagina"];
				 
			 } else {
				 $pagina = $_GET["pagina"];
			};

		 } else {
			 header("Location: " . $context['site']['url'] . '/error');
		 };
	};

} else {
	$pagina = 1;
};

$empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;

if($_GET["country"]=='nulo' && $_GET["state"]=='nulo' && $_GET["rank"]=='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users";
}

if($_GET["country"]!='nulo' && $_GET["state"]=='nulo' && $_GET["rank"]=='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE country='".$_GET["country"]."'";
}

if($_GET["country"]=='nulo' && $_GET["state"]!='nulo' && $_GET["rank"]=='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE state='".$_GET["state"]."'";
}

if($_GET["country"]!='nulo' && $_GET["state"]!='nulo' && $_GET["rank"]=='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE country='".$_GET["country"]."' AND state='".$_GET["state"]."'";
}

if($_GET["country"]=='nulo' && $_GET["state"]=='nulo' && $_GET["rank"]!='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE rank='".$_GET["rank"]."'";
}

if($_GET["country"]!='nulo' && $_GET["state"]=='nulo' && $_GET["rank"]!='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE country='".$_GET["country"]."' AND rank='".$_GET["rank"]."' ";
}

if($_GET["country"]=='nulo' && $_GET["state"]!='nulo' && $_GET["rank"]!='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE state='".$_GET["state"]."' AND rank='".$_GET["rank"]."'";
}

if($_GET["country"]!='nulo' && $_GET["state"]!='nulo' && $_GET["rank"]!='nulo'){
    $obtener_todo_BD = "SELECT * FROM site_users WHERE country='".$_GET["country"]."' AND state='".$_GET["state"]."' AND rank='".$_GET["rank"]."'";
}

$consulta_todo = query($obtener_todo_BD);

$total_registros = num_rows($consulta_todo);

$total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina); 

if($_GET["country"]=='nulo' && $_GET["state"]=='nulo' && $_GET["rank"]=='nulo'){
    $consulta_resultados = query("
SELECT * FROM `site_users` 
ORDER BY `site_users`.`id` DESC 
LIMIT $empezar_desde, $cantidad_resultados_por_pagina");
}

if($_GET["country"]!='nulo' && $_GET["state"]=='nulo' && $_GET["rank"]=='nulo'){
    $consulta_resultados = query("
SELECT * FROM `site_users`  WHERE country='".$_GET["country"]."' 
ORDER BY `site_users`.`id` DESC 
LIMIT $empezar_desde, $cantidad_resultados_por_pagina");
}

if($_GET["country"]=='nulo' && $_GET["state"]!='nulo' && $_GET["rank"]=='nulo'){
    $consulta_resultados = query("
SELECT * FROM `site_users`  WHERE state='".$_GET["state"]."' 
ORDER BY `site_users`.`id` DESC 
LIMIT $empezar_desde, $cantidad_resultados_por_pagina");
}

if($_GET["country"]!='nulo' && $_GET["state"]!='nulo' && $_GET["rank"]=='nulo'){
    $consulta_resultados = query("
SELECT * FROM `site_users`  WHERE country='".$_GET["country"]."' AND state='".$_GET["state"]."' 
ORDER BY `site_users`.`id` DESC 
LIMIT $empezar_desde, $cantidad_resultados_por_pagina");
}

if($_GET["country"]=='nulo' && $_GET["state"]=='nulo' && $_GET["rank"]!='nulo'){
    $consulta_resultados = query("
SELECT * FROM `site_users` WHERE rank='".$_GET["rank"]."'
ORDER BY `site_users`.`id` DESC 
LIMIT $empezar_desde, $cantidad_resultados_por_pagina");
}

if($_GET["country"]!='nulo' && $_GET["state"]=='nulo' && $_GET["rank"]!='nulo'){
    $consulta_resultados = query("
SELECT * FROM `site_users`  WHERE country='".$_GET["country"]."' AND rank='".$_GET["rank"]."' 
ORDER BY `site_users`.`id` DESC 
LIMIT $empezar_desde, $cantidad_resultados_por_pagina");
}

if($_GET["country"]=='nulo' && $_GET["state"]!='nulo' && $_GET["rank"]!='nulo'){
    $consulta_resultados = query("
SELECT * FROM `site_users`  WHERE state='".$_GET["state"]."' AND rank='".$_GET["rank"]."' 
ORDER BY `site_users`.`id` DESC 
LIMIT $empezar_desde, $cantidad_resultados_por_pagina");
}

if($_GET["country"]!='nulo' && $_GET["state"]!='nulo' && $_GET["rank"]!='nulo'){
    $consulta_resultados = query("
SELECT * FROM `site_users`  WHERE country='".$_GET["country"]."' AND state='".$_GET["state"]."' AND rank='".$_GET["rank"]."' 
ORDER BY `site_users`.`id` DESC 
LIMIT $empezar_desde, $cantidad_resultados_por_pagina");
}

if(num_rows($consulta_resultados) !== 0){
    
    echo'<div class="table-responsive">
    <table class="table table-bordered bg-white table-hover">
          <thead class="thead-dark">
            <tr>
                
              <th scope="col">Opciones</th>
              <th scope="col">C.I.</th>
              <th scope="col">Nombres</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Usuario</th>
              <th scope="col">Correo</th>
              <th scope="col">Pa&iacute;s</th>
              <th scope="col">Estado</th>
              <th scope="col">Rango</th>
              <th scope="col">Fecha de Ingreso</th>
            </tr>
          </thead>
          <tbody id="userSearch">';
    
    while($r = fetch_assoc($consulta_resultados)) {
        $rankUser='';
        if($r['rank']==0){
            $rankUser = "Postulante";
        }

        if($r['rank']==1){
            $rankUser = "Miembro";
        }

        if($r['rank']==2){
            $rankUser = "Coordinador";
        }

        if($r['rank']>=3){
            $rankUser = "Administrador";
        }

        $datCountry = query("SELECT * FROM countries WHERE id = '" . $r['country'] . "' LIMIT 1");
        $country = fetch_assoc($datCountry);

        $datState = query("SELECT * FROM states WHERE id='" . $r['state'] . "' LIMIT 1");
        $state = fetch_assoc($datState);
        
        echo '
                <tr class="user' . $r['id'] . '">
                  <td>
                  <div class="dropdown">
                      <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="menuUser' . $r['id'] . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fas fa-cog m-1"></span>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="menuUser' . $r['id'] . '">
                      
                        <a class="dropdown-item" href="' .$site['url'] . 'profile/'. $r['username'] .'" target="_blank"><span class="fas fa-user"></span> Ver Perfil </a>
                        
                        <a class="dropdown-item" href="' . $context['site']['url'] . 'manage/usersedit?q=' . $r['username'] . '"><span class="fas fa-edit"></span> Editar</a>
                        
                        <div class="dropdown-divider"></div>
                        
                        <a class="dropdown-item" href="#deleteUser" data-toggle="modal" data-target="#deleteUserModal" onclick="deleteUserModal(\'' . $r['id'] . '\', \'' . $r['username'] . '\')"><span class="fas fa-trash-alt"></span> Eliminar</a>
                  </div>
                    </div>
                  </td>
                  <td>' . $r['curp'] . '</td>
                  <td>' . $r['name'] . '</td>
                  <td>' . $r['lastname'] . '</td>
                  <td>' . $r['username'] . '</td>
                  <td>' . $r['email'] . '</td>
                  <td>' . $country['name'] . '</td>
                  <td>' . $state['name'] . '</td>
                  <td>' . $rankUser . '</td>
                  <td>' . $r['dateAdmission'] . '</td>
                </tr>';

    }
    echo'</tbody>
        </table>
        </div>';
    
    
}else{
    echo'
    
        <div class="card">
            <div class="card-body">
                <center>
                    <span class="fas fa-info-circle" aria-hidden="true" style="font-size: 800%; margin-top: 2%;"></span>
                     <br>
                    <div style="margin-top: 5%; margin-bottom:2%;">
                        NO HAY USUARIOS.
                    </div>
                </center>
            </div>
        </div>
    
    ';
};
?>
<hr/>
    <nav aria-label="Navegacion">
        <ul class="pagination">
            <?php
                if($_GET["pagina"]==null || $_GET["pagina"]==1){
                    echo'<li class="page-item disabled">
                          <span class="page-link">Anterior</span>
                        </li>';
                }else{
                ?>
                <li class="page-item">
                    <a class="page-link" href='#' onclick="viewUsersCountry('<?=$_GET["pagina"]-1?>')">
                        Anterior
                    </a>
                </li>
            <?php
                }
            if($total_paginas>20){
                $total_paginas=20;
            }
            
            for ($i=1; $i<=$total_paginas; $i++) {
                
                if($_GET["pagina"]==null){
                    $_GET["pagina"]= '1';
                }
                
                if($_GET["pagina"]==$i){
                    
                    echo "<li class='page-item active'><a class='page-link' href='#' onclick=\"viewUsersCountry('".$i."')\">".$i."</a></li>";
                }else{
                    echo "<li class='page-item'><a class='page-link' href='#' onclick=\"viewUsersCountry('".$i."')\">".$i."</a></li>";
                }
            }; 

                if($_GET["pagina"]==null and $i>2){
                    echo'<li class="page-item">
                          <a class="page-link" href="#" onclick="viewUsersCountry(\'2\')">Next</a>
                        </li>';
                }else if($_GET["pagina"]==$i-1){
                    echo'<li class="page-item disabled">
                          <span class="page-link">Siguiente</span>
                        </li>';
                }else if($_GET["pagina"]==null and $i==2){
                    echo'<li class="page-item disabled">
                          <span class="page-link">Siguiente</span>
                        </li>';
                }else{
                ?>
                
                <li class="page-item">
                  <a class="page-link" href='#' onclick="viewUsersCountry('<?=$_GET["pagina"]+1?>')">Next</a>
                </li>
                  
            <?php 
                }


            ?>
        </ul>
    </nav>