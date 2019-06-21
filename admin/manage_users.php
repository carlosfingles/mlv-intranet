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

require('../Init.php');

if(!isset($_SESSION['isLogged']) || $user['rank'] < $context['permissions']['admin_users']){
    echo"<script>window.location = '" . $site['url'] . "';</script>";
    exit();
}

$titlePage= 'Usuarios: Registrados';
$descrPage = $titlePage;

include(Templates . 'Head-admin.php');
?>


  <div class="container-fluid content-min-100vh">
        <div class="row">
            <div class="col-12">
                <div class="card my-3">
                    <div class="card-body font-size-14">
                        <center>
                            <h1 class="font-weight-bold h1-1">INTRANET VERSION ALPHA.</h1>
                            <p>Esta pagina esta en evolucion permanente. En caso de problemas, por favor contactanos a: <a href="mailto:it@mlv-intranet.org" class="text-dark">it@mlv-intranet.org</a></p>
                            <p style="font-size: 90%;" class="font-weight-bold">Si eres desarrollador web, colabora para mejorar la pagina!</p>
                        </center>
                    </div>
                </div>
                <div class="card mb-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h4 class="font-weight-bold m-0 p1">Usuarios</h4>
                        </li>
                        
                        <li class="list-group-item">
                            <div class="row mt-3">
                              <div class="col-12">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="input-group">
                                        
                                            <select id="reg_country" onchange="viewUsersStates('true')" class="form-control mb-2 custom-select">
                                            <?php
                                               if($user['rank']!='2'){
                                            ?>
                                                <option value="nulo">Elegir Pais</option>
                                            <?php
                                                    $catCoincide= query ("SELECT * FROM site_users ORDER by id ASC");
                                                    
                                                    $catArray= array("-----");
                                                    
                                                    while($rCat = fetch_assoc($catCoincide))
                                                    {
                                                        
                                                       $catco= $rCat['country'];
                                                        
                                                        if(!array_search($catco, $catArray)){
                                                            $countryDat= query ("SELECT * FROM countries WHERE id ='" . $rCat['country'] . "' ");
                                                            $countries = fetch_assoc($countryDat);
                                                        ?>
                                                            <option value="<?=$countries['id'];?>"><?=$countries['name']?></option>
                                                    <?php
                                                        }
                                                        
                                                        $catArray[]= $rCat['country'];
                                                
                                                    }
                                               }else{
                                                   $countryDat= query ("SELECT * FROM countries WHERE id ='" . $user['country'] . "' ");
                                                    $countries = fetch_assoc($countryDat);
                                            ?>
                                                    <option value="<?=$countries['id'];?>"><?=$countries['name']?></option>
                                            <?php
                                               }
                                            ?>
                                            </select>
                                                
                                            <select id="reg_states" onchange="viewUsersCountry('1')" class="form-control mb-2 custom-select">
                                                <option value="nulo">Elegir Estado/Provincia</option>
                                            </select>
                                            
                                            <select id="reg_rank" onchange="viewUsersCountry('1')" class="form-control mb-2 custom-select">
                                                <option value="nulo">Todos</option>
                                                <option value="0">Postulantes</option>
                                                <option value="1">Miembros</option>
                                                <option value="2">Coordinadores</option>
                                                <option value="3">Administradores</option>
                                            </select>
                                            
                                        </div>
                                        <script>viewUsersCountry('1');viewUsersStates('true');</script>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">   
                                        <div id="restUsers"></div>
                                        <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><span class="fas fa-trash"></span> Eliminar Usuario</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div id="delDataBody" class="modal-body">
                                                  Estas seguro que deseas eliminar el Usuario <b>Usuario</b>
                                              </div>
                                              <div id="delDataFooter" class="modal-footer">
                                                <button class="btn btn-danger" type="button" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                                <button class="btn btn-info" type="button" onclick="deleteUser('num')">Aceptar</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                   </div>
                                </div>

                              </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
include(Templates . 'Footer.php');
?>