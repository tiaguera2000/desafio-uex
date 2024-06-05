 class Alerta{

    static alert(message, type){
        
        let tipo = (type == 'error') ? 'Erro' : 'Sucesso';
        $.toast({
            text: message, 
            heading: tipo, 
            icon: type, 
            showHideTransition: 'fade', 
            allowToastClose: true, 
            hideAfter: 10000, 
            stack: 5,
            position: 'top-right', 
            textAlign: 'left',  
            loader: true,  
            loaderBg: '#9EC600',  
            beforeShow: function () {},afterShown: function () {},beforeHide: function () {}, afterHidden: function () {}
        });
    }
}