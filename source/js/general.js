window.onload=function(){
(function(d){
 var
 ce=function(e,n){var a=document.createEvent("CustomEvent");a.initCustomEvent(n,true,true,e.target);e.target.dispatchEvent(a);a=null;return false},
 nm=true,sp={x:0,y:0},ep={x:0,y:0},
 touch={
  touchstart:function(e){sp={x:e.touches[0].pageX,y:e.touches[0].pageY}},
  touchmove:function(e){nm=false;ep={x:e.touches[0].pageX,y:e.touches[0].pageY}},
  touchend:function(e){if(nm){ce(e,'fc')}else{var x=ep.x-sp.x,xr=Math.abs(x),y=ep.y-sp.y,yr=Math.abs(y);if(Math.max(xr,yr)>20){ce(e,(xr>yr?(x<0?'swl':'swr'):(y<0?'swu':'swd')))}};nm=true},
  touchcancel:function(e){nm=false}
 };
 for(var a in touch){d.addEventListener(a,touch[a],false);}
})(document);
    //EXAMPLE OF USE
    // document.body.addEventListener('fc',h,false);// 0-50ms vs 500ms with normal click
    // document.body.addEventListener('swl',h,false);
    document.getElementById('gesture-hover-menu').addEventListener('swr',sidebar_menu,false);
    document.getElementById('sidebar-menu-content-backdrop').addEventListener('swl',sidebar_menu,false);
    document.getElementsByClassName('sidebar-inner')[0].addEventListener('swl',sidebar_menu,false);
    // document.body.addEventListener('swu',h,false);
    // document.body.addEventListener('swd',h,false);
}
function sidebar_menu(){
  if($("#menu-col").hasClass('menu-fade-in-left') || $("#menu-col").hasClass('menu-visible')){
    document.body.style.overflow = 'initial';
    $("#menu-col").removeClass('menu-fade-in-left');
    $("#menu-col").removeClass('menu-visible');
    $("#sidebar-menu-content-backdrop").hide();
    $("#show-hide-menu i").addClass('fa-bars');
    $("#show-hide-menu i").removeClass('fa-arrow-left');
  }else{
    $("#sidebar-menu-content-backdrop").show();
    $("#menu-col").addClass('menu-fade-in-left');
    $("#menu-col").addClass('menu-visible');
    document.body.style.overflow = 'hidden';
    $("#show-hide-menu i").addClass('fa-arrow-left');
    $("#show-hide-menu i").removeClass('fa-bars');
  }
}
function f_loader_table(){
    loader_table = '<div id="loader-table">'
            +'<div style="display: table; width: 100%; min-height: 100%; text-align: center;">'
                +'<div style="display: table-cell; vertical-align: middle;">'
                    +'<i class="fa fa-spin fa-spinner" style="font-size: 50px"></i>'
                +'</div>'
            +'</div>'
        +'</div>';
    $(loader_table).insertBefore("#section-data-list table.loader-js");
    $('<div id="container-loader-table" style="width: 100%; height: 100%; position: relative;"></div>').insertBefore("#section-data-list table");
    $("#loader-table").appendTo($("#container-loader-table"));
    $("#section-data-list table").appendTo($("#container-loader-table"));
}
$(document).ready(function() {
    $("#sidebar-menu-content-backdrop").click(function(event) {
    $(this).hide();
    $("#show-hide-menu").trigger('click');
    });
    $("#gesture-hover-menu").mouseleave(function(event) {
    sidebar_menu();
    });
    $("#show-hide-menu").click(function(event) {
    sidebar_menu();
    });
    $(".cancel.resetjs").click(function(event) {
        obj = this;
        setTimeout(function() {
            reset_form(obj);
        }, 500);
    });
    $("body").on('click', '.filter-from', function(e) {
        e.preventDefault();
        form = document.createElement("form");
        form.method = "post";
        form.action = $(this).attr("data-target");
        input = document.createElement("input");
        input.name = $(this).attr("data-input-name");
        input.value = $(this).attr("data-filter");
        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    });
    $('body').on('hidden.bs.modal','#modal-js', function (e) {
        $(".modal-backdrop.fade.in").remove();
        $('#modal-js').remove();
    });   
    $("form").submit(function (e) {
        $('button[type=submit]', this).attr('disabled', 'disabled');  //deshabilita todos los button de tipo submit
    }); 
    $("#breadcum form").submit(function(e) {
        e.preventDefault();
        // $('button[type=submit]', this).attr('disabled', false);  //deshabilita todos los button de tipo submit
        warning("Caracteristica en desarrrollo");
    });
    // section_data_list();
    $("body").on('submit', 'form.submitjs', function(e) {
        e.preventDefault();
        $("#loader").show();
        obj = this;
        redirect = $(this).attr("redirect");
        $('button[type=submit]', this).attr('disabled', 'disabled');  //deshabilita todos los button de tipo submit
        $.ajax({
            url: $(obj).attr("action"),
            type: "post",
            dataType: 'json',
            data: $(obj).serialize(),
            success:function(response){
                setTimeout(function() {
                    $("#loader").hide();
                }, 300);
                if(response["estatus"] == 1){
                    completo(response["mensaje"]);
                    setTimeout(function() {
                        if(redirect != null){
                            window.location.href = redirect;
                        }else{
                            location.reload();
                        }
                    }, 1500);
                }else{
                    errores(response["mensaje"]);
                    $("#loader").hide();
                }
            },error:function(){
                errores("<p>Ocurrió un error inesperado</p>");
                $("#loader").hide();
            }
        });
    });
    $("body").on('submit', 'form.multipart-submitjs', function(e) {
        e.preventDefault();
        obj = this;
        var formData = new FormData($(obj)[0]);
        $("#loader").show();
        $('button[type=submit]', this).attr('disabled', 'disabled');  //deshabilita todos los button de tipo submit
        $.ajax({
            url: $(obj).attr("action"),
            type: 'POST',
            dataType: 'json',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(response){
                setTimeout(function() {
                    $("#loader").hide();
                }, 300);
                if(response["estatus"] == 1){
                    completo(response["mensaje"]);
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }else{
                    errores(response["mensaje"]);
                    $("#loader").hide();
                }
            },error:function(){
                errores("<p>Ocurrió un error inesperado</p>");
                $("#loader").hide();
            }
        });
    });
});
function spinner(selector){
    spinner_tag = '<p style="font-size: 40px; text-align: center;"><i class="fa fa-spinner fa-spin"></i></p>';
    selector.html(spinner_tag);
}
/****************************************************/
function errores(res,selector = "",timer = 10000){
    var errors = '';
    if(Array.isArray(res)){
        $.each(res, function(key, value) {
          new PNotify({
            title: 'Error',
            text: value,
            type: 'error',
            styling: 'bootstrap3',
            delay: timer
          });
         }); 
    }else{
        new PNotify({
            title: 'Error',
            text: res,
            type: 'error',
            styling: 'bootstrap3',
            delay: timer
        });
    }
    $('button[type=submit]').attr('disabled', false); //habilita todos los button de tipo submit
    return errors;
}

function completo(res,selector = "",timer = 2000){
    var exito='';
    new PNotify({
            title: 'Completo',
            text: res,
            type: 'success',
            styling: 'bootstrap3',
            delay: timer
          });
    return exito;
}
function warning(res,timer = 2000){
    var exito='';
    new PNotify({
            title: 'Alerta',
            text: res,
            type: 'warning',
            styling: 'bootstrap3',
            delay: timer
          });
    $('button[type=submit]').attr('disabled', false);  //habilita todos los button de tipo submit
    return exito;
}