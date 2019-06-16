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

function configSettings(title, URL, desc, keys){
    $.ajax({
            type: 'POST',
            data: 'config_title=' + title + '&config_url=' + URL + '&config_slogan=' + desc + '&config_keys=' + keys,
            url: '/Kernel/Actions/Manage/config_settings.php',

            beforeSend: function()
            {
                $("#config_title").removeClass('is-valid');
                $("#config_title").removeClass('is-invalid');
                $("#config_URL").removeClass('is-valid');
                $("#config_URL").removeClass('is-invalid');
                $("#config_desc").removeClass('is-valid');
                $("#config_desc").removeClass('is-invalid');
                $("#config_keys").removeClass('is-valid');
                $("#config_keys").removeClass('is-invalid');

                $("[name='settings_submit']").html('Cargando...');
                $("[name='settings_submit']").attr('disabled', '');
            },
            success: function(dataSettings)
            {
                if(title != ''){
                   $("#config_title").addClass('is-valid');
                   $(".respuestaTitle").html('T&iacute;tulo actualizado.');
                }
                if(title == ''){
                   $("#config_title").addClass('is-invalid');
                   $(".respuestaTitle").html('T&iacute;tulo no actualizado, no puedes dejar este campo vac&iacute;o.');
                }

                if(URL != ''){
                   $("#config_URL").addClass('is-valid');
                   $(".respuestaURL").html('URL actualizado.');
                }
                if(URL == ''){
                   $("#config_URL").addClass('is-invalid');
                   $(".respuestaURL").html('Url no actualizada, no puedes dejar este campo vac&iacute;o.');
                }

                if(desc != ''){
                   $("#config_desc").addClass('is-valid');
                   $(".respuestaDesc").html('Descripci&oacute;n actualizada.');
                }
                if(desc == ''){
                   $("#config_desc").addClass('is-invalid');
                   $(".respuestaDesc").html('Descripci&oacute;n no actualizada, no puedes dejar este campo vac&iacute;o.');
                }

                if(keys != ''){
                   $("#config_keys").addClass('is-valid');
                   $(".respuestaKeys").html('Palabras Clave actualizadas.');

                }
                if(keys == ''){
                   $("#config_keys").addClass('is-invalid');
                   $(".respuestaKeys").html('Palabras Clave no actualizado, no puedes dejar este campo vac&iacute;o.');
                }

                $("[name='settings_submit']").removeAttr('disabled');
                $("[name='settings_submit']").html('Guardar');
            }
        });
}
function configEmail(){
    var bool = document.getElementById("configEmailChek").checked;
    $.ajax({
            type: 'POST',
            data: 'bool=' + bool,
            url: site_url + '/Kernel/Actions/Manage/config_mailAct.php',

            beforeSend: function(dataLoader)
            {
                $('#configEmailChek').addClass('is-valid');
                $('.respuestaConfigEmailChek').html('Cargando...');
            },
            success: function(dataLoader)
            {
               $('.respuestaConfigEmailChek').html(dataLoader);
                setTimeout(function(){location.reload();}, 1100);
            }
        });
}
function configEmailSend(mail_server, mail_user, mail_pass, mail_encryp, mail_port, mail_corNot){
    $.ajax({
            type: 'POST',
            data: 'mail_server=' + mail_server + '&mail_user=' + mail_user + '&mail_pass=' + mail_pass + '&mail_encryp=' +mail_encryp + '&mail_port=' + mail_port + '&mail_corNot=' + mail_corNot,
            url: site_url + '/Kernel/Actions/Manage/config_mailSend.php',

            beforeSend: function()
            {
                $('#mail_server').removeClass('is-valid');
                $('#mail_server').removeClass('is-invalid');

                $('#mail_user').removeClass('is-valid');
                $('#mail_user').removeClass('is-invalid');

                $('#mail_pass').removeClass('is-valid');
                $('#mail_pass').removeClass('is-invalid');

                $('#mail_encryp').removeClass('is-valid');
                $('#mail_encryp').removeClass('is-invalid');

                $('#mail_port').removeClass('is-valid');
                $('#mail_port').removeClass('is-invalid');

                $('#mail_corNot').removeClass('is-valid');
                $('#mail_corNot').removeClass('is-invalid');

                $('#restConfigEmailSend').html('');
                $('#ConfigEmailSend').attr('disabled','');
                $('#ConfigEmailSend').html('Cargando...');
            },
            success: function(data)
            {
                if(mail_server!=''){
                    $('#mail_server').addClass('is-valid');
                }
                if(mail_server==''){
                    $('#mail_server').addClass('is-invalid');
                }

                if(mail_user!=''){
                    $('#mail_user').addClass('is-valid');
                }
                if(mail_user==''){
                    $('#mail_user').addClass('is-invalid');
                }

                if(mail_pass!=''){
                    $('#mail_pass').addClass('is-valid');
                }
                if(mail_pass==''){
                    $('#mail_pass').addClass('is-invalid');
                }

                if(mail_port!=''){
                    $('#mail_port').addClass('is-valid');
                }
                if(mail_port==''){
                    $('#mail_port').addClass('is-invalid');
                }

                if(mail_corNot!=''){
                    $('#mail_corNot').addClass('is-valid');
                }
                if(mail_corNot==''){
                    $('#mail_corNot').addClass('is-invalid');
                }

                $('#mail_encryp').addClass('is-valid');

                $('#restConfigEmailSend').html(data);
                $('#ConfigEmailSend').removeAttr('disabled')
                $('#ConfigEmailSend').html('Guardar');
            }
        });
}
function configTwitterCard(){
    var bool = document.getElementById("twitterCardChek").checked;
    $.ajax({
            type: 'POST',
            data: 'bool=' + bool,
            url: site_url + '/Kernel/Actions/Manage/config_TwitterCard.php',

            beforeSend: function(dataLoader)
            {
                $('#twitterCardChek').addClass('is-valid');
                $('.respuestaTwitterCard').html('Cargando...');
            },
            success: function(dataLoader)
            {
               $('.respuestaTwitterCard').html(dataLoader);
                setTimeout(function(){location.reload();}, 1100);
            }
        });
}
function configTwitterCardUser(twUser){
    $.ajax({
            type: 'POST',
            data: 'twUser=' + twUser,
            url: '/Kernel/Actions/Manage/config_update_TwitterCardUser.php',

            beforeSend: function()
            {
                $("#config_twUser").removeClass('is-valid');
                $("#config_twUser").removeClass('is-invalid');

                $("[name='TwitterCard_submit']").html('Cargando...');
                $("[name='TwitterCard_submit']").attr('disabled', '');
            },
            success: function(dataDevelop)
            {
                if(twUser != ''){
                    $("#config_twUser").addClass('is-valid');
                    $('.respuestaTwUser').html('Usuario Actualizado.');
                }
                if(twUser == ''){
                    $("#config_twUser").addClass('is-invalid');
                    $('.respuestaTwUser').html('No puede dejar ese campo vacio.');
                }

                $("[name='TwitterCard_submit']").removeAttr('disabled');
                $("[name='TwitterCard_submit']").html('Guardar');
            }
        });
}
function configDevelop(head){
        $.ajax({
            type: 'POST',
            data: 'Develop_head=' + head,
            url: '/Kernel/Actions/Manage/config_develop.php',

            beforeSend: function()
            {
                $("[name='Develop_submit']").html('Cargando...');
                $("[name='Develop_submit']").attr('disabled', '');
            },
            success: function(dataDevelop)
            {
                $("textarea[name='Develop_head']").addClass('is-valid');
                $("#resultDevelop").html(dataDevelop);
                $("[name='Develop_submit']").removeAttr('disabled');
                $("[name='Develop_submit']").html('Guardar');
            }
        });
}
function viewUsersCountry(page){
        var countryUsers = $("#reg_country").val();
        var stateUsers = $("#reg_states").val();
        var rank = $("#reg_rank").val();
        var ruta =  site_url + "Kernel/Actions/Manage/prev_users_all.php";
        $.ajax({
            url: ruta,
            type: "GET",
            data: 'country=' + countryUsers + '&state=' + stateUsers + '&rank=' + rank + '&pagina=' + page,

            beforeSend: function()
            {
                $("#restUsers").html('<div class="row"><div class="col-12 d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div></div>');
            },
            success: function(datos)
            {
                $("#restUsers").html(datos);
            }
        });
}
function viewUsersStates(e){
        var country = $("#reg_country").val();
        var ruta =  site_url + "Kernel/Actions/getStates.php";
        $.ajax({
            url: ruta,
            type: "POST",
            data: 'country=' + country + '&index=' + e,

            beforeSend: function()
            {
                $("#reg_states").html('<option value="nulo">Cargando...</option>');
            },
            success: function(datos)
            {
                $("#reg_states").html(datos);
                viewUsersCountry('1');
            }
        });
}
function editUserManage(id, reg_name, reg_lastname, reg_CI, reg_birthdate, reg_profession, reg_codephone, reg_phone, reg_wtpp, reg_tlg, reg_country, reg_states, reg_city, reg_ideology, reg_social, reg_economic, reg_anotherOrganization, reg_net1, reg_net2, reg_net3, reg_collabNet, reg_collabVoluntary, reg_collabEvents, reg_collabFunds, reg_collabOther)
{
    if( (reg_net1.indexOf("@") > -1) || (reg_net1.indexOf("http") > -1) ){
        $.ajax({
            type: 'POST',
            data: 'id=' + id + '&reg_name=' + reg_name + '&reg_lastname='  + reg_lastname + '&reg_CI=' + reg_CI + '&reg_birthdate=' + reg_birthdate + '&reg_profession=' + reg_profession + '&reg_codephone=' + reg_codephone + '&reg_phone=' + reg_phone + '&reg_wtpp=' + reg_wtpp + '&reg_tlg=' + reg_tlg + '&reg_country=' + reg_country + '&reg_states=' + reg_states + '&reg_city=' + reg_city + '&reg_ideology=' + reg_ideology + '&reg_social=' + reg_social + '&reg_economic=' + reg_economic + '&reg_anotherOrganization=' + reg_anotherOrganization + '&reg_net1=' + reg_net1 + '&reg_net2=' + reg_net2 + '&reg_net3=' + reg_net3 + '&reg_collabNet=' + reg_collabNet + '&reg_collabVoluntary=' + reg_collabVoluntary + '&reg_collabEvents=' + reg_collabEvents + '&reg_collabFunds=' + reg_collabFunds + '&reg_collabOther=' + reg_collabOther,
            url: site_url + '/Kernel/Actions/Manage/editUserProfile.php',

            beforeSend: function()
            {
                $("#upUserManage").attr('Disabled', '');
                $("#upUserManage").html('Cargando...');
                $('#reg_name').removeClass('is-invalid');
                $('#reg_lastname').removeClass('is-invalid');

                $('#reg_CI').removeClass('is-invalid');
                $('#reg_birthdate').removeClass('is-invalid');
                $('#reg_profession').removeClass('is-invalid');
                $('#reg_codephone').removeClass('is-invalid');
                $('#reg_phone').removeClass('is-invalid');
                $('#reg_country').removeClass('is-invalid');
                $('#reg_states').removeClass('is-invalid');
                $('#reg_ideology').removeClass('is-invalid');
                $('#reg_net1').removeClass('is-invalid');
                $('#reg_collabNet').removeClass('is-invalid');
                $('#reg_collabVoluntary').removeClass('is-invalid');
                $('#reg_collabEvents').removeClass('is-invalid');
                $('#reg_collabFunds').removeClass('is-invalid');

            },
            success: function(data)
            {
                if(reg_name == ''){
                    $('#reg_name').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_lastname == ''){
                    $('#reg_lastname').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }

                if(reg_CI == ''){
                    $('#reg_CI').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_birthdate == ''){
                    $('#reg_birthdate').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_birthdate == 'aaaa-mm-dd'){
                    $('#reg_birthdate').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_profession == ''){
                    $('#reg_profession').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_codephone == ''){
                    $('#reg_codephone').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_phone == ''){
                    $('#reg_phone').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_country == ''){
                    $('#reg_country').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_country == 'nulo'){
                    $('#reg_country').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_states == ''){
                    $('#reg_states').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_states == 'nulo'){
                    $('#reg_states').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_ideology == ''){
                    $('#reg_ideology').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_net1 == ''){
                    $('#reg_net1').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_collabNet == ''){
                    $('#reg_collabNet').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_collabVoluntary == ''){
                    $('#reg_collabVoluntary').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_collabEvents == ''){
                    $('#reg_collabEvents').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }
                if(reg_collabFunds == ''){
                    $('#reg_collabFunds').addClass('is-invalid');
                    $("#upUserManage").removeAttr('Disabled');
                    $("#upUserManage").html('Aceptar');
                }

                $('#restEditProfile').html(data);
                $("#upUserManage").removeAttr('Disabled');
                $("#upUserManage").html('Actualizar');
            }
        });
    }else{
        $('#reg_net1').addClass('is-invalid');
        $("#upUserManage").removeAttr('Disabled');
        $("#upUserManage").html('Aceptar');
    }
}
function cogUserManage(id, reg_username, reg_email)
{
    $.ajax({
        type: 'POST',
        data: 'id=' + id + '&reg_email=' + reg_email + '&reg_username='  + reg_username,
        url: site_url + '/Kernel/Actions/Manage/cogUserProfile.php',

        beforeSend: function()
        {
            $("#upCogUserManage").attr('Disabled', '');
            $("#upCogUserManage").html('Cargando...');
            $('#edit_username').removeClass('is-invalid');
            $('#edit_email').removeClass('is-invalid');                
        },
        success: function(data)
        {
            if(reg_username == ''){
                $('#edit_username').addClass('is-invalid');
                $("#upCogUserManage").removeAttr('Disabled');
                $("#upCogUserManage").html('Aceptar');
            }
            if(reg_email == ''){
                $('#edit_email').addClass('is-invalid');
                $("#upCogUserManage").removeAttr('Disabled');
                $("#upCogUserManage").html('Aceptar');
            }

            $('#cong_res').html(data);
            $("#upCogUserManage").removeAttr('Disabled');
            $("#upCogUserManage").html('Actualizar');
        }
    });
}
function rankUserManage(id, reg_rank)
{
    $.ajax({
        type: 'GET',
        data: 'id=' + id + '&reg_rank=' + reg_rank,
        url: site_url + '/Kernel/Actions/Manage/rankUserProfile.php',

        beforeSend: function()
        {
            $('#userRank').removeClass('is-valid');                
        },
        success: function(data)
        {   
            $('#resultRank').html(data);
            $('#userRank').addClass('is-valid');
        }
    });
}
function deleteUserModal(id, user){
    $("#delDataBody").html('Estas seguro que deseas eliminar al usuario: <b>'+ user +'</b>.');
    $("#delDataFooter").html('<button class="btn btn-danger" type="button" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button><button class="btn btn-info" type="button" onclick="deleteUser(\'' + id + '\')" class="close" data-dismiss="modal" aria-label="Close">Aceptar</button>');

}
function deleteUser(i){
    if(i != '')
    {
        $.ajax({
            type: 'GET',
            url: site_url + '/Kernel/Actions/Manage/deleteUser.php?id=' + i,
            success: function()
            {
                $("tr.user" + i).fadeOut('fast');
            }
        });
    }
}
function addCategoryForum(title, desc, enlace){
    $.ajax({
            type: 'POST',
            data: 'title=' + title + '&desc=' + desc + '&url=' + enlace,
            url: '/Kernel/Actions/Manage/config_add_category_forum.php',

            beforeSend: function()
            {
                $("#title").removeClass('is-invalid');
                $("#description").removeClass('is-invalid');
                $("#url").removeClass('is-invalid');

                $("#addCategoryForumSend").html('Cargando...');
                $("#addCategoryForumSend").attr('disabled', '');
            },
            success: function(data)
            {
                if(title==''){
                    $("#title").addClass('is-invalid');
                }
                if(desc==''){
                    $("#description").addClass('is-invalid');
                }
                if(url==''){
                   $("#url").addClass('is-invalid');
                }

                if(data.trim()=='errorURL'){
                    $("#url").addClass('is-invalid');
                }

                if(data.trim()=='Add'){
                    location.reload();
                }else{
                    $("#addCategoryForumSend").removeAttr('disabled');
                    $("#addCategoryForumSend").html('Aceptar');
                }
            }
        });
}
function editCategoryForumModal(i){
    if(i != '')
    {
        $.ajax({
            type: 'GET',
            url: site_url + '/Kernel/Actions/Manage/editModalCategoryForum.php?id=' + i,
            beforeSend: function(){
                $("#delDataBodyEdit").html('<div class="row"><div class="col-12 d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div></div>');
            },
            success: function(data)
            {
                var datEdit= data.split("<!---->");
                $("#delDataBodyEdit").html(datEdit[0]);
                $("#delDataFooterEdit").html(datEdit[1]);
            }
        });
    }
}
function editCategoryForum(id, title, desc, enlace){
    $.ajax({
            type: 'POST',
            data: 'id='+ id + '&title=' + title + '&desc=' + desc + '&url=' + enlace,
            url: '/Kernel/Actions/Manage/config_update_category_forum.php',

            beforeSend: function()
            {
                $("#title_edit").removeClass('is-invalid');
                $("#description_edit").removeClass('is-invalid');
                $("#url_edit").removeClass('is-invalid');

                $("#editCategoryForumSend").html('Cargando...');
                $("#editCategoryForumSend").attr('disabled', '');
            },
            success: function(data)
            {
                if(title==''){
                    $("#title_edit").addClass('is-invalid');
                }
                if(desc==''){
                    $("#description_edit").addClass('is-invalid');
                }
                if(url==''){
                   $("#url_edit").addClass('is-invalid');
                }

                if(data.trim()=='errorURL'){
                    $("#url_edit").addClass('is-invalid');
                }

                if(data.trim()=='up'){
                    location.reload();
                }else{
                    $("#editCategoryForumSend").removeAttr('disabled');
                    $("#editCategoryForumSend").html('Actualizar');
                }
            }
        });
}
function deleteCategoryForumModal(id, title){
    $("#delDataBody").html('Estas seguro que deseas eliminar la Categoría: <b>'+ title +'</b>.');
    $("#delDataFooter").html('<button class="btn btn-danger" type="button" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button><button class="btn btn-info" type="button" onclick="deleteCategoryForum(\'' + id + '\')" class="close" data-dismiss="modal" aria-label="Close">Aceptar</button>');

}
function deleteCategoryForum(i){
    if(i != '')
    {
        $.ajax({
            type: 'GET',
            url: site_url + '/Kernel/Actions/Manage/deleteCategoryForum.php?id=' + i,
            success: function(data)
            {
                $("div.FC" + i).fadeOut('fast');
            }
        });
    }
}
function subirLogo(){

    $("#proLogo").css({"display":"block"});

    var formData = new FormData($("#upImgLogo")[0]);
    var ruta =  site_url + "Kernel/upload/logoUpload.php";

    function setProgressLogo(precisLogo) {
        var progressLogo = $('#progressLogo');

        progressLogo.toggleClass('active', precisLogo < 100);

        progressLogo.css({
            width: precisLogo = precisLogo.toPrecision(3)+'%'
        }).html('<span>'+precisLogo+'</span>');
    }

    $.ajax({
        url: ruta,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        beforeSend: function()
        {
            $("#fileLogo").removeClass('is-valid');
            $("#fileLogo").removeClass('is-invalid');
            $("#imgResultLogo").html('Cargando...');
        },
        success: function(datalogo)
        {

            var imagenContUpdatelogo= datalogo.split(';');
            if(imagenContUpdatelogo[2] == 'valid'){
                $("#fileLogo").addClass('is-valid');
                $("#fileLogo").removeClass('is-invalid');
                $('#logoImg').attr('src', '/images/image/' + imagenContUpdatelogo[1].trim());
               }
            if(imagenContUpdatelogo[2] == 'invalid'){
                $("#fileLogo").addClass('is-invalid');
                $("#fileLogo").removeClass('is-valid');
               }
            $(".respuestalogo").html(imagenContUpdatelogo[0]);
            $("#imgResultLogo").html(imagenContUpdatelogo[1]);
        },

        progress: function(eLogo) {
            if(eLogo.lengthComputable) {
                setProgressLogo(eLogo.loaded / eLogo.total * 100);
            }
            else {
                console.warn('Content Length not reported!');
            }
        }       
    });
}
function deleteImgLogo(){
    $.ajax({
        type: 'GET',
        url: site_url + 'images/image/deletefile-admin.php',
        success: function(dataDelLogo)
        {
            var deletelogo= dataDelLogo.split(';');
            if(deletelogo[1].trim() == 'si'){
                $('#logoImg').attr('src', '/images/image/logo.png');
            }
            $("#datDeleteLogo").html(deletelogo[0].trim());
        }
    });
}
function subirFavicon(){

    $("#proFavicon").css({"display":"block"});

    var formData = new FormData($("#upImgFavicon")[0]);
    var ruta =  site_url + "Kernel/upload/faviconUpload.php";

    function setProgressFavicon(precisFavicon) {
        var progressFavicon = $('#progressFavicon');

        progressFavicon.toggleClass('active', precisFavicon < 100);

        progressFavicon.css({
            width: precisFavicon = precisFavicon.toPrecision(3)+'%'
        }).html('<span>'+precisFavicon+'</span>');
    }

    $.ajax({
        url: ruta,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        beforeSend: function()
        {
            $("#fileFavicon").removeClass('is-valid');
            $("#fileFavicon").removeClass('is-invalid');
            $("#imgResultFavicon").html('Cargando...');
        },
        success: function(dataFavicon)
        {

            var imagenContUpdateFavicon= dataFavicon.split(';');
            if(imagenContUpdateFavicon[2] == 'valid'){
                $("#fileFavicon").addClass('is-valid');
                $("#fileFavicon").removeClass('is-invalid');
                $('#FaviconImg').attr('src', '/images/favicon/' + imagenContUpdateFavicon[1].trim());
               }
            if(imagenContUpdateFavicon[2] == 'invalid'){
                $("#fileFavicon").addClass('is-invalid');
                $("#fileFavicon").removeClass('is-valid');
               }
            $(".respuestaFavicon").html(imagenContUpdateFavicon[0]);
            $("#imgResultFavicon").html(imagenContUpdateFavicon[1]);
        },

        progress: function(eFavicon) {
            if(eFavicon.lengthComputable) {
                setProgressFavicon(eFavicon.loaded / eFavicon.total * 100);
            }
            else {
                console.warn('Content Length not reported!');
            }
        }       
    });
}
function deleteImgFavicon(){
    $.ajax({
        type: 'GET',
        url: site_url + 'images/favicon/deletefile-admin.php',
        success: function(dataDelFavicon)
        {
            var deleteFavicon= dataDelFavicon.split(';');
            if(deleteFavicon[1].trim() == 'si'){
                $('#FaviconImg').attr('src', '/images/favicon/favicon.ico');
            }
            $("#datDeleteFavicon").html(deleteFavicon[0].trim());
        }
    });
}
function subirTwitterCard(){

    $("#proTwitterCard").css({"display":"block"});

    var formData = new FormData($("#upImgTwitterCard")[0]);
    var ruta =  site_url + "Kernel/upload/TwitterCardUpload.php";

    function setProgressTwitterCard(precisTwitterCard) {
        var progressTwitterCard = $('#progressTwitterCard');

        progressTwitterCard.toggleClass('active', precisTwitterCard < 100);

        progressTwitterCard.css({
            width: precisTwitterCard = precisTwitterCard.toPrecision(3)+'%'
        }).html('<span>'+precisTwitterCard+'</span>');
    }

    $.ajax({
        url: ruta,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        beforeSend: function()
        {
            $("#fileTwitterCard").removeClass('is-valid');
            $("#fileTwitterCard").removeClass('is-invalid');
            $("#imgResultTwitterCard").html('Cargando...');
        },
        success: function(dataTwitterCard)
        {

            var imagenContUpdateTwitterCard= dataTwitterCard.split(';');
            if(imagenContUpdateTwitterCard[2] == 'valid'){
                $("#fileTwitterCard").addClass('is-valid');
                $("#fileTwitterCard").removeClass('is-invalid');
                $('#TwitterCardImg').attr('src', '/images/image/seo_twitter/' + imagenContUpdateTwitterCard[1].trim());
               }
            if(imagenContUpdateTwitterCard[2] == 'invalid'){
                $("#fileTwitterCard").addClass('is-invalid');
                $("#fileTwitterCard").removeClass('is-valid');
               }
            $(".respuestaTwitterCard").html(imagenContUpdateTwitterCard[0]);
            $("#imgResultTwitterCard").html(imagenContUpdateTwitterCard[1]);
        },

        progress: function(eTwitterCard) {
            if(eTwitterCard.lengthComputable) {
                setProgressTwitterCard(eTwitterCard.loaded / eTwitterCard.total * 100);
            }
            else {
                console.warn('Content Length not reported!');
            }
        }       
    });
}
function deleteImgTwitterCard(){
    $.ajax({
        type: 'GET',
        url: site_url + 'images/image/seo_twitter/deletefile-admin.php',
        success: function(dataDelTwitterCard)
        {
            var deleteTwitterCard= dataDelTwitterCard.split(';');
            if(deleteTwitterCard[1].trim() == 'si'){
                $('#TwitterCardImg').attr('src', '/images/image/seo_twitter/Twitter.jpg');
            }
            $("#datDeleteTwitterCard").html(deleteTwitterCard[0].trim());
        }
    });
}
function subirOgSeo(){

    $("#proOgSeo").css({"display":"block"});

    var formData = new FormData($("#upImgOgSeo")[0]);
    var ruta =  site_url + "Kernel/upload/OgSeoUpload.php";

    function setProgressOgSeo(precisOgSeo) {
        var progressOgSeo = $('#progressOgSeo');

        progressOgSeo.toggleClass('active', precisOgSeo < 100);

        progressOgSeo.css({
            width: precisOgSeo = precisOgSeo.toPrecision(3)+'%'
        }).html('<span>'+precisOgSeo+'</span>');
    }

    $.ajax({
        url: ruta,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        beforeSend: function()
        {
            $("#fileOgSeo").removeClass('is-valid');
            $("#fileOgSeo").removeClass('is-invalid');
            $("#imgResultOgSeo").html('Cargando...');
        },
        success: function(dataOgSeo)
        {

            var imagenContUpdateOgSeo= dataOgSeo.split(';');
            if(imagenContUpdateOgSeo[2] == 'valid'){
                $("#fileOgSeo").addClass('is-valid');
                $("#fileOgSeo").removeClass('is-invalid');
                $('#OgSeoImg').attr('src', '/images/image/seo_og/' + imagenContUpdateOgSeo[1].trim());
               }
            if(imagenContUpdateOgSeo[2] == 'invalid'){
                $("#fileOgSeo").addClass('is-invalid');
                $("#fileOgSeo").removeClass('is-valid');
               }
            $(".respuestaOgSeo").html(imagenContUpdateOgSeo[0]);
            $("#imgResultOgSeo").html(imagenContUpdateOgSeo[1]);
        },

        progress: function(eOgSeo) {
            if(eOgSeo.lengthComputable) {
                setProgressOgSeo(eOgSeo.loaded / eOgSeo.total * 100);
            }
            else {
                console.warn('Content Length not reported!');
            }
        }       
    });
}
function deleteImgOgSeo(){
    $.ajax({
        type: 'GET',
        url: site_url + 'images/image/seo_og/deletefile-admin.php',
        success: function(dataDelOgSeo)
        {
            var deleteOgSeo= dataDelOgSeo.split(';');
            if(deleteOgSeo[1].trim() == 'si'){
                $('#OgSeoImg').attr('src', '/images/image/seo_og/ImgSeo.jpg');
            }
            $("#datDeleteOgSeo").html(deleteOgSeo[0].trim());
        }
    });
}
