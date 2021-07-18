$(document).ready(function() {

    var id_region = $('#txtId_region').val();
    cargar_fb();

    function cargar_fb() {
        funcion = 'cargarFb';
        $.post('Controlador/region_controler.php', { funcion, id_region }, (response) => {
            const obj = JSON.parse(response);
            let template = `<div id="fb-root"></div>
            <br><br>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v10.0" nonce="5vkyCoVX"></script>
            <div class="fb-page" data-href="${obj.facebook}" data-tabs="timeline" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="${obj.facebook}" class="fb-xfbml-parse-ignore"><a href="${obj.facebook}"></a></blockquote>
            </div>`;
            $('#divFb').html(template);
            
        });
    }
});