        
    function submitProduct()
    {               
        var formData = new FormData();                                      
        var fileElem = document.getElementById("importupload-products");

        formData.append("ImportUpload[products]", fileElem.files[0]);
        formData.append("_csrf", $("input[name=_csrf]").val());

        var xhr = new XMLHttpRequest();
        xhr.open("post", "/admin/import/upload-products", true);
        xhr.onload = function(resp) {

            var response = JSON.parse(resp.currentTarget.response);                
            var html = '';

            switch(response.status){
                case 1:
                case 2:
                    html = 
                        '<div class="alert alert-danger alert-dismissable">' +
                            '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' +
                            '<h4><i class="icon fa fa-check"></i>Error!</h4>' +
                            response.message +
                        '</div>';
                    $(html).insertAfter($("h1#page-title"));
                    break
                case 3:
                    html =
                        '<div id="product-upload-alert" class="alert alert-warning alert-dismissable">' +
                            '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' +
                            '<h4><i class="icon fa fa-check"></i>Uploaded!</h4>' +
                            response.message +
                        '</div>' +
                        '<div id="product-processing" class="progress progress-striped active">' +
                            '<div class="progress-bar"  role="progressbar" aria-valuenow="percent" aria-valuemin="0" aria-valuemax="100" style="width: 1%">' +
                                '<span class="sr-only">1% Complete</span>' +
                            '</div>' +
                        '</div>';
                    $(html).insertAfter($("h1#page-title"));

                    parseProduct(response.file, 0);

                    break;

                default:
                    html = 
                        '<div class="alert alert-danger alert-dismissable">' +
                            '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' +
                            '<h4><i class="icon fa fa-check"></i>Error!</h4>' +
                            'Something wrong. Please try again later.' +
                        '</div>';
                    $(html).insertAfter($("h1#page-title"));
                    break;   
            }                

        }
        xhr.onerror = function() { 

            var html = 
                '<div class="alert alert-danger alert-dismissable">' +
                    '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' +
                    '<h4><i class="icon fa fa-check"></i>Error!</h4>' +
                    'XHR request return error. Please try again later.' +
                '</div>';                
            $(html).insertAfter($("h1#page-title"));
        }

        if(typeof fileElem.files[0] !== "undefined"){
            xhr.send(formData);
        }
    }
    
    function parseProduct(file, key_start, iter)
    {       
        $.ajax({
            type: "POST",
            url: "/admin/import/import-products",
            cache: false,
            dataType: "json",
            async : true,
            data : { file : file, key_start : key_start },
            success: function(response) {
                
                var html = '';
               
                if(!response.message){                    
                    if(response.next_iter){                        
                        
                        showProgress(response.key_start, response.key_all);
                        parseProduct(file, response.key_start, iter); 
                        
                    } else {                        
                        html =
                            '<div class="alert alert-success alert-dismissable">' +
                                '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' +
                                '<h4><i class="icon fa fa-check"></i>Saved!</h4>' +
                                'Parsing has been completed.' +
                            '</div>';
                        $(html).insertAfter($("h1#page-title"));
                        $("#product-processing").remove();
                        $("#product-upload-alert").remove();
                    }
                    
                } else {
                    html = 
                        '<div class="alert alert-danger alert-dismissable">' +
                            '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' +
                            '<h4><i class="icon fa fa-check"></i>Error!</h4>' +
                            response.message +
                        '</div>';
                    $(html).insertAfter($("h1#page-title"));
                    $("#product-processing").remove();
                    $("#product-upload-alert").remove();
                }              
            },
            error : function(){
                var html = 
                    '<div class="alert alert-danger alert-dismissable">' +
                        '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' +
                        '<h4><i class="icon fa fa-check"></i>Error!</h4>' +
                        'Parsing request return error. Please try again later.' +
                    '</div>';                
                $(html).insertAfter($("h1#page-title"));
                $("#product-processing").remove();
                $("#product-upload-alert").remove();
            }
        });
        
        
    }
    
    function showProgress(now, all)
    {
        var percent = parseFloat(now * 100 / all);
        percent = percent.toFixed(2);
        
        if($("#product-processing").length){          
            $('#product-processing .progress-bar').attr('aria-valuenow', percent);
            $('#product-processing .progress-bar').attr('style', 'width: '+percent+'%');
            $('#product-processing .progress-bar .sr-only').text(percent+'% Complete');        
        } 
    }
    
    
