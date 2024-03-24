
(function($) {
    "use strict";

    // Agregar estado activo a los enlaces de navegación sidbar
    var path = window.location.href; // porque la propiedad 'href' del elemento DOM es la ruta absoluta
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Alternar la navegación lateral
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
        
    });

})(jQuery);

function logout(href){
    // e.preventDefault();
    // alertify.confirm("&#191;Desea cerrar sesion?", function(){ location.href =`${href}Index/Logout`; });	
    location.href =`${href}Index/Logout`; 
}
