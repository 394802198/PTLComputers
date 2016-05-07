(function($){

    KindEditor.ready(function(K) {
        window.editor = K.create('#description',{
            langType : 'en',
            resizeType : 0,
            width: '100%',
            height: '300px',
            items : [
                'source', 'preview', 'fontname', 'fontsize',
                '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'removeformat',
                '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist',
                '|', 'link'
            ]
        });
    });

})(jQuery)