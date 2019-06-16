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

$(document).ready(
    function() 
	{
		$("#login").on('click',
			function()
			{
				var email = $("#email").val();
				var password = $("#password").val();
                var rememberMe = document.getElementById("rememberMeChek").checked;
            
					Users.Login(email, password, rememberMe);
			}
		);

		$("#pro_saved").on('click',
			function()
			{
				var reg_name = $("#reg_name").val();
                var reg_lastname = $("#reg_lastname").val();
            
                var reg_CI = $("#reg_CI_type").val().trim() + "-" + $("#reg_CI").val();
                var reg_birthdate = $("#reg_birthdate").val();
                var reg_profession = $("#reg_profession").val();
                var reg_codephone = $("#reg_codephone").val();
                var reg_phone = $("#reg_phone").val();
            
                var reg_wtpp = document.getElementById("reg_wtpp").checked;
                var reg_tlg = document.getElementById("reg_tlg").checked;
            
                var reg_country = $("#reg_country").val();
                var reg_states = $("#reg_states").val();
                var reg_city = $("#reg_city").val();
                var reg_ideology = $("#reg_ideology").val();
                var reg_social = $("#reg_social").val();
                var reg_economic = $("#reg_economic").val();
                var reg_anotherOrganization = $("#reg_anotherOrganization").val();
                var reg_net1 = $("#reg_net1").val();
                var reg_net2 = $("#reg_net2").val();
                var reg_net3 = $("#reg_net3").val();
                var reg_collabNet = $("#reg_collabNet").val();
                var reg_collabVoluntary = $("#reg_collabVoluntary").val();
                var reg_collabEvents = $("#reg_collabEvents").val();
                var reg_collabFunds = $("#reg_collabFunds").val();
                var reg_collabOther = $("#reg_collabOther").val();
                
                Users.editProfile(reg_name, reg_lastname, reg_CI, reg_birthdate, reg_profession, reg_codephone, reg_phone, reg_wtpp, reg_tlg, reg_country, reg_states, reg_city, reg_ideology, reg_social, reg_economic, reg_anotherOrganization, reg_net1, reg_net2, reg_net3, reg_collabNet, reg_collabVoluntary, reg_collabEvents, reg_collabFunds, reg_collabOther);
			}
		);
        
        $("#cong_save").on('click',
			function()
			{
				var email = $("#edit_email").val();
				var password = $("#edit_password").val();
				var repeatpass = $("#edit_repeatpass").val();
				var actualpass = $("#edit_actualpass").val();

				Users.editConfiguration(email, password, repeatpass, actualpass);
			}
		);
		
		$("#register").on('click',
			function()
			{
                var reg_name = $("#reg_name").val();
                var reg_lastname = $("#reg_lastname").val();
				var reg_username = $("#reg_username").val();
                var reg_email = $("#reg_email").val();
				var reg_password = $("#reg_password").val();
            
                var reg_CI = $("#reg_CI_type").val().trim() + "-" + $("#reg_CI").val();
                var reg_birthdate = $("#reg_birthdate").val();
                var reg_profession = $("#reg_profession").val();
                var reg_codephone = $("#reg_codephone").val();
                var reg_phone = $("#reg_phone").val();
            
                var reg_wtpp = document.getElementById("reg_wtpp").checked;
                var reg_tlg = document.getElementById("reg_tlg").checked;
            
                var reg_country = $("#reg_country").val();
                var reg_states = $("#reg_states").val();
                var reg_city = $("#reg_city").val();
                var reg_ideology = $("#reg_ideology").val();
                var reg_social = $("#reg_social").val();
                var reg_economic = $("#reg_economic").val();
                var reg_anotherOrganization = $("#reg_anotherOrganization").val();
                var reg_net1 = $("#reg_net1").val();
                var reg_net2 = $("#reg_net2").val();
                var reg_net3 = $("#reg_net3").val();
                var reg_collabNet = $("#reg_collabNet").val();
                var reg_collabVoluntary = $("#reg_collabVoluntary").val();
                var reg_collabEvents = $("#reg_collabEvents").val();
                var reg_collabFunds = $("#reg_collabFunds").val();
                var reg_collabOther = $("#reg_collabOther").val();
                
                Users.userRegister(reg_name, reg_lastname, reg_username, reg_email, reg_password, reg_CI, reg_birthdate, reg_profession, reg_codephone, reg_phone, reg_wtpp, reg_tlg, reg_country, reg_states, reg_city, reg_ideology, reg_social, reg_economic, reg_anotherOrganization, reg_net1, reg_net2, reg_net3, reg_collabNet, reg_collabVoluntary, reg_collabEvents, reg_collabFunds, reg_collabOther);
			}
		);
	}
);
function forgotPassword(username){
    $.ajax({
            type: 'POST',
            data: 'username=' + username,
            url: '/Kernel/Actions/forgotPassword.php',

            beforeSend: function()
            {	
                $('#RestforgotPass').html('Cargando...');
            },
            success: function(data)
            {
                if(data.trim()!='nullUserEmail'){
                    $('#RestforgotPass').html(data);
                }else{
                    $('#RestforgotPass').html('El usuario o correo electrónico no existe.');
                }

            }
        });
}
function updatePass(pass, repass, id_user){
    $.ajax({
        type: 'POST',
        data: 'pass=' + pass + '&repass=' + repass + '&id_user=' + id_user,
        url: '/Kernel/Actions/updatePass.php',

        beforeSend: function()
        {	
            $("#forgotPass_password").removeClass('is-valid');
            $("#forgotPass_password").removeClass('is-invalid');

            $("#forgotPass_repeatpass").removeClass('is-valid');
            $("#forgotPass_repeatpass").removeClass('is-invalid');

            $("#restUpdatePass").html('Cargando...');

            $("#updatePass").attr('disabled', '');
            $("#updatePass").html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>');
        },
        success: function(data)
        {
            var dat = data.split('<!---->');
            if(pass == repass && pass !='' && repass != '' && pass != undefined && repass != undefined){
                $("#forgotPass_password").addClass('is-valid');
                $("#edit_repeatpass").addClass('is-valid');
            }

            if(pass != repass || repass == '' || pass == ''){
                $("#forgotPass_password").addClass('is-invalid');
                $("#forgotPass_repeatpass").addClass('is-invalid');
            }
            $('#restUpdatePass').html(dat[1]);
            if(dat[0].trim()!='true'){
                $("#updatePass").removeAttr('disabled');
                $("#updatePass").html('Cambiar Contrase&ntilde;a');
            }else{
                $("#updatePass").html('Contrase&ntilde;a Actualizada');
            }

        }
    });
}
function subirProfile(){

    $("#proProfile").css({"display":"block"});

    var formData = new FormData($("#upImgProfile")[0]);
    var ruta =  site_url + "Kernel/upload/ProfileUpload.php";

    function setProgressProfile(precisProfile) {
        var progressProfile = $('#progressProfile');

        progressProfile.toggleClass('active', precisProfile < 100);

        progressProfile.css({
            width: precisProfile = precisProfile.toPrecision(3)+'%'
        }).html('<span>'+precisProfile+'</span>');
    }

    $.ajax({
        url: ruta,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        beforeSend: function()
        {
            $("#fileProfile").removeClass('is-valid');
            $("#fileProfile").removeClass('is-invalid');
            $("#imgResultProfile").html('Cargando...');
        },
        success: function(dataProfile)
        {

            var imagenContUpdateProfile= dataProfile.split(';');
            if(imagenContUpdateProfile[2] == 'valid'){
                $("#fileProfile").addClass('is-valid');
                $("#fileProfile").removeClass('is-invalid');
                $('#ProfileImg').attr('src', '/images/imgperfil/' + imagenContUpdateProfile[1].trim());
               }
            if(imagenContUpdateProfile[2] == 'invalid'){
                $("#fileProfile").addClass('is-invalid');
                $("#fileProfile").removeClass('is-valid');
               }
            $(".respuestaProfile").html(imagenContUpdateProfile[0]);
            $("#imgResultProfile").html(imagenContUpdateProfile[1]);
        },

        progress: function(eProfile) {
            if(eProfile.lengthComputable) {
                setProgressProfile(eProfile.loaded / eProfile.total * 100);
            }
            else {
                console.warn('Content Length not reported!');
            }
        }       
    });
}
function deleteImgProfile(){
    $.ajax({
        type: 'GET',
        url: site_url + 'images/imgperfil/deletefile-user.php',
        success: function(dataDelProfile)
        {
            var deleteProfile= dataDelProfile.split(';');
            if(deleteProfile[1].trim() == 'si'){
                $('#ProfileImg').attr('src', site_url + '/images/imgperfil/avatar.jpg');
            }
            $("#datDeleteProfile").html(deleteProfile[0].trim());
        }
    });
}
function subirCover(){

    $("#proCover").css({"display":"block"});

    var formData = new FormData($("#upImgCover")[0]);
    var ruta =  site_url + "Kernel/upload/CoverUpload.php";

    function setProgressCover(precisCover) {
        var progressCover = $('#progressCover');

        progressCover.toggleClass('active', precisCover < 100);

        progressCover.css({
            width: precisCover = precisCover.toPrecision(3)+'%'
        }).html('<span>'+precisCover+'</span>');
    }

    $.ajax({
        url: ruta,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        beforeSend: function()
        {
            $("#fileCover").removeClass('is-valid');
            $("#fileCover").removeClass('is-invalid');
            $("#imgResultCover").html('Cargando...');
        },
        success: function(dataCover)
        {

            var imagenContUpdateCover= dataCover.split(';');
            if(imagenContUpdateCover[2] == 'valid'){
                $("#fileCover").addClass('is-valid');
                $("#fileCover").removeClass('is-invalid');
                $('#CoverImg').attr('src', '/images/imgcover/' + imagenContUpdateCover[1].trim());
               }
            if(imagenContUpdateCover[2] == 'invalid'){
                $("#fileCover").addClass('is-invalid');
                $("#fileCover").removeClass('is-valid');
               }
            $(".respuestaCover").html(imagenContUpdateCover[0]);
            $("#imgResultCover").html(imagenContUpdateCover[1]);
        },

        progress: function(eCover) {
            if(eCover.lengthComputable) {
                setProgressCover(eCover.loaded / eCover.total * 100);
            }
            else {
                console.warn('Content Length not reported!');
            }
        }       
    });
}
function deleteImgCover(){
    $.ajax({
        type: 'GET',
        url: site_url + 'images/imgcover/deletefile-user.php',
        success: function(dataDelCover)
        {
            var deleteCover= dataDelCover.split(';');
            if(deleteCover[1].trim() == 'si'){
                $('#CoverImg').attr('src', site_url + '/images/imgcover/cover.jpg');
            }
            $("#datDeleteCover").html(deleteCover[0].trim());
        }
    });
}
function viewStates(e){
    var country = $("#reg_country").val();
    var ruta =  site_url + "Kernel/Actions/getStates.php";
    $.ajax({
        url: ruta,
        type: "POST",
        data: 'country=' + country,

        beforeSend: function()
        {
            $("#reg_states").html('<option value="nulo">Cargando...</option>');
        },
        success: function(datos)
        {
            $("#reg_states").html(datos);
            if(e!='undefined' || e!=undefined){
               $("select#reg_states>option[value='"+e+"']").attr('selected', '');
            }
        }
    });
}
function contriesCodePhone(){
    var country = $("#pro_country").val();
    var ruta =  site_url + "Kernel/Actions/getCodePhone.php";
    $.ajax({
        url: ruta,
        type: "POST",
        data: 'country=' + country,

        beforeSend: function()
        {
            $("#pro_codephone").html('<option value="nulo">+(...)</option>');
        },
        success: function(datos)
        {
            $("#pro_codephone").html(datos);
        }
    });
}
function addTopicForum(id_category, title, desc){
    var ruta =  site_url + "Kernel/Actions/Forum/addTopicForum.php";
    $.ajax({
        url: ruta,
        type: "POST",
        data: 'id_category=' + id_category + '&title=' + title + '&description=' + desc,

        beforeSend: function()
        {
            $("#title").removeClass('is-invalid');
            $("#description").removeClass('is-invalid');

            $("#addTopicForumSend").html('Cargando...');
            $("#addTopicForumSend").attr('disabled', '');
        },
        success: function(datos)
        {
            if(title==''){
                $("#title").addClass('is-invalid');
                $("#description").addClass('is-invalid');
            }
            if(datos.trim()=='add'){
                location.reload();
            }else{
                $("#addTopicForumSend").html('Aceptar');
                $("#addTopicForumSend").removeAttr('disabled');
            }
        }
    });
}
function editTopicForumModal(i){
    if(i != '')
    {
        $.ajax({
            type: 'GET',
            url: site_url + 'Kernel/Actions/Forum/prevEditTopicForum.php?id=' + i,
            beforeSend: function(){
                $("#editTopicDataBody").html('<div class="row"><div class="col-12 d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div></div>');
            },
            success: function(data)
            {
                var datEdit= data.split("<!---->");
                $("#editTopicDataBody").html(datEdit[0]);
                $("#editTopicDataFooter").html(datEdit[1]);
            }
        });
    }
}
function editTopicForum(id, title, desc){
    var ruta =  site_url + "Kernel/Actions/Forum/editTopicForum.php";
    $.ajax({
        url: ruta,
        type: "POST",
        data: 'id=' + id + '&title=' + title + '&description=' + desc,

        beforeSend: function()
        {
            $("#title_edit").removeClass('is-invalid');
            $("#description_edit").removeClass('is-invalid');

            $("#editTopicForumSend").html('Cargando...');
            $("#editTopicForumSend").attr('disabled', '');
        },
        success: function(datos)
        {
            if(title==''){
                $("#title_edit").addClass('is-invalid');
                $("#description_edit").addClass('is-invalid');
            }
            if(datos.trim()=='up'){
                location.reload();
            }else{
                $("#editTopicForumSend").html('Actualizar');
                $("#editTopicForumSend").removeAttr('disabled');
            }
        }
    });
}        
function deleteTopicForumModal(id, title){
    $("#delTopicDataBody").html('Estas seguro que deseas eliminar al tema: <b>'+ title +'</b>.');
    $("#delTopicDataFooter").html('<button class="btn btn-danger" type="button" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button><button class="btn btn-info" type="button" onclick="deleteTopicForum(\'' + id + '\')" class="close" data-dismiss="modal" aria-label="Close">Aceptar</button>');

}
function deleteTopicForum(id){
    var ruta =  site_url + "Kernel/Actions/Forum/deleteTopicForum.php";
    $.ajax({
        url: ruta,
        type: "POST",
        data: 'id=' + id,

        success: function(datos)
        {
            $("#topic" + id).fadeOut('fast');
        }
    });
}
function addCommentTopic(id_topic, comment){
    var ruta =  site_url + "Kernel/Actions/Forum/newsComment.php";
    $.ajax({
        url: ruta,
        type: "POST",
        data: 'id_topic=' + id_topic + '&comment=' + comment,

        beforeSend: function()
        {
            $("#commentTopic").removeClass('is-invalid');

            $("#addCommentTopicSend").html('Cargando...');
            $("#addCommentTopicSend").attr('disabled', '');
        },
        success: function(datos)
        {
            if(comment==''){
                $("#commentTopic").addClass('is-invalid');
            }
            if(datos.trim()=='add'){
                location.reload();
            }else{
                $("#addCommentTopicSend").html('Enviar');
                $("#addCommentTopicSend").removeAttr('disabled');
            }
        }
    });
}
function deleteCommentTopic(id){
    var ruta =  site_url + "Kernel/Actions/Forum/deleteComment.php";
    $.ajax({
        url: ruta,
        type: "POST",
        data: 'id=' + id,

        success: function(datos)
        {
            $("#comment" + id).fadeOut('fast');
        }
    });
}