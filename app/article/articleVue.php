<?php
    require_once dirname(dirname(dirname(__FILE__))) . '/common/app.php';
    if(!isset($_COOKIE['userId'])){
        header('Location: '.\App::getHome());
        exit();
    }
    $userId = $_COOKIE['userId'];
    $etatCompte = $_COOKIE['etatCompte'];
    $login = $_COOKIE['login'];
    $profil = $_COOKIE['profil'];
    $status = $_COOKIE['status'];
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Gestion des articles
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Article
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-xs-12">
                   
                    <div class="col-lg-1">
                         <button id="MNU_PRODUIT_NEW" data-toggle="dropdown"
                                    class="btn btn-mini btn-primary dropdown-toggle tooltip-info"
                                    data-rel="tooltip" data-placement="top" title="Article" style="
                                    height: 32px;
                                    width: 80px;
                                    margin-top: -1px;
                                    margin-left: 5px;">Nouveau
                            </button>
                    </div>
                </div>
            </div>
<!--            <h4 class="pink">
                <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
                <a href="#modal-table" role="button" class="green" data-toggle="modal"> Liste des articles </a>
            </h4>-->
            <div class="row">
                  <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Liste des articles
                        </h4>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                          <table id="LIST_ARTICLES" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Rubrique
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Libellé
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Actions
                                </th>

                                <!--<th class="hidden-phone" style="border-left: 0px none;border-right: 0px none;">
                                </th>-->
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div>
            <div id="winModalArticle" class="modal fade" tabindex="-1">
            <form id="validation-form" class="form-horizontal" role="form">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Article</h3>
                        </div>

                        <div class="modal-body" style="height: 150px;">
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Rubrique </label>
                                    <div class="col-sm-9">
                                        <select id="CMBRUBRIQUE" name="CMBRUBRIQUE" class="input-large">
                                      <option value="-1" class="rubriques" >Sélectionner...</option>
                                    </select>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Libellé </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="libelle" name="libelle" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button id="SAVE" class="btn btn-small btn-info" >
                                <i class="ace-icon fa fa-save"></i>
                                Enregistrer
                            </button>
                            
                            <button id="CANCEL" class="btn btn-small btn-danger" data-dismiss="modal">
                                <i class="fa fa-times"></i>
                                Annuler
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </form>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
 
</div><!-- /.page-content -->

<script type="text/javascript">
    $(document).ready(function() {
         var oTableArticles = null;
            var nbTotalArticlesChecked=0;
            var checkedArticles = new Array();
            var article=0;
             $("#CMBRUBRIQUE").select2();
            checkedArticlesContains = function(item) {
                for (var i = 0; i < checkedArticles.length; i++) {
                    if (checkedArticles[i] == item)
                        return true;
                }
                return false;
            };
            // Persist checked Message when navigating
            
            loadRubriques = function(){
            $.post("<?php echo App::getBoPath(); ?>/rubrique/RubriqueController.php", {ACTION: "<?php echo App::ACTION_LIST_VALID; ?>"}, function(data) {
                sData=$.parseJSON(data);
                if(sData.rc==-1){
                    $.gritter.add({
                            title: 'Notification',
                            text: sData.error,
                            class_name: 'gritter-error gritter-light'
                        });
                }else{
                    $("#CMBRUBRIQUE").loadJSON('{"rubriques":' + data + '}');
                }
            });
            };
            loadRubriques();
            persistChecked = function() {
                $('input[type="checkbox"]', "#LIST_ARTICLES").each(function() {
                    if (checkedArticlesContains($(this).val())) {
                        $(this).attr('checked', 'checked');
                    } else {
                        $(this).removeAttr('checked');
                    }
                });
            };
             $('table th input:checkbox').on('click', function() {
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox').each(function() {
                    this.checked = that.checked;
                    if (this.checked)
                    {
                        checkedArticlesAdd($(this).val());
                      //  MessageSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                        nbTotalArticlesChecked=checkedArticles.length;
                    }
                    else
                    {
                        checkedArticlesRemove($(this).val());
                   //    MessageUnSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                    }
                    $(this).closest('tr').toggleClass('selected');
                });
            });
            
             $('#LIST_ARTICLES tbody').on('click', 'input[type="checkbox"]', function() {
                context=$(this);
                if ($(this).is(':checked') && $(this).val() != '*') {
                    checkedArticlesAdd($(this).val());
                    MessageSelected();
                } else {
                    checkedArticlesRemove($(this).val());
                    MessageUnSelected();
                }
                ;
                if(!context.is(':checked')){
                    $('table th input:checkbox').removeAttr('checked');
                }else{
                    if(checkedArticles.length==nbTotalArticlesChecked){
                        $('table th input:checkbox').prop('checked', true);
                    }
                }
            });
            
         
           // $('#SAVE').attr("disabled", true);
            MessageSelected = function(click)
            {
                if (checkedArticles.length == 1){
                    $('#SAVE').attr("disabled", false);
                    $('#TAB_MSG_VIEW').show();
		    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }else
                {
                    $('#SAVE').attr("disabled", true);
                    $('#nomArticle').text("");
                    $('#stockProvisoire').val("0.00");
                    $('#stockReel').val("0.00");
                    $('#nombreCarton').val("");
                    $('#nombreParCarton').val("");
                    
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    
                }
                if(checkedArticles.length==nbTotalArticlesChecked){
                    $('table th input:checkbox').prop('checked', true);
                }
            };
            MessageUnSelected = function()
            {
               if (checkedArticles.length === 1){
                   $('#SAVE').attr("disabled", false);
		    $('#TAB_MSG_VIEW').show();
                    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }
                else
                {
                    $('#SAVE').attr("disabled", true);
                    $('#nomArticle').text("");
                    $('#stockProvisoire').val("0.00");
                    $('#stockReel').val("0.00");
                    $('#nombreCarton').val("");
                    $('#nombreParCarton').val("");
                    $('#SAVE').attr("disabled", false);
                    
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    $("#BTN_MSG_GROUP").popover('destroy');
                    $("#BTN_MSG_CONTENT").popover('destroy');
                }
                $('table th input:checkbox').removeAttr('checked');
            };

            // Add checked item to the array
            checkedArticlesAdd = function(item) {
                if (!checkedMessageContains(item)) {
                    checkedArticles.push(item);
                }
            };
            // Remove unchecked items from the array
            checkedArticlesRemove = function(item) {
                var i = 0;
                while (i < checkedArticles.length) {
                    if (checkedArticles[i] == item) {
                        checkedArticles.splice(i, 1);
                    } else {
                        i++;
                    }
                }
            };
            checkedMessageContains = function(item) {
                for (var i = 0; i < checkedArticles.length; i++) {
                    if (checkedArticles[i] == item)
                        return true;
                }
                return false;
            };
            showPopover = function(idButton, colis){
            $("#" + idButton).popover({
                html: true,
                trigger: 'focus',
                placement: 'left',
                title: '<i class="icon-group icon-"></i> Détail colis ',
                content: colis
            }).popover('toggle');
         };
         
         removeArticle=function(articleIds){
                    bootbox.confirm("Voulez vous vraiment supprimer ce article", function(result) {
                        if (result) {
                             var articleIdsChecked = articleIds;
                            $.post("<?php echo App::getBoPath(); ?>/article/ArticleController.php", {articleIds: articleIdsChecked + "", ACTION: "<?php echo App::ACTION_REMOVE; ?>"}, function(data) {
                                if (data.rc == 0){
                                    $.gritter.add({
                                        title: 'Notification',
                                        text: "Article supprimé",
                                        class_name: 'gritter-success gritter-light'
                                    });
                                    $('table th input:checkbox').removeAttr('checked');
                                     checkedArticles=new Array();
                                    loadArticles();
                                }
                                else{
                                    $.gritter.add({
                                        title: 'Notification',
                                        text: data.error,
                                        class_name: 'gritter-warning gritter-light'
                                    });
                                    
                               // $("#NOTIF_ALERT").append("<div class='alert alert-danger'> <button class='close' data-dismiss='alert'> <i class='icon-remove'></i></button><i class='icon-hand-right'></i> <?php// printf($pNotifSupUserAlert); ?> </div>");
                                }
                            }, "json");
                        }
                    });
                }
                
             loadArticles = function() {
                nbTotalArticlesChecked = 0;
                checkedArticles = new Array();
                var url =  '<?php echo App::getBoPath(); ?>/article/ArticleController.php';

                if (oTableArticles != null)
                    oTableArticles.fnDestroy();

                oTableArticles = $('#LIST_ARTICLES').dataTable({
                    "oLanguage": {
                    "sUrl": "<?php echo App::getHome(); ?>/datatable_fr.txt",
                    "oPaginate": {
                        "sNext": "",
                        "sLast": "",
                        "sFirst": null,
                        "sPrevious": null
                      }
                    },
                    "aoColumnDefs": [
                        
                            
                            {
                                "aTargets": [2],
                                "bSortable": false,
                                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                    
                                    $(nTd).css('text-align', 'center');
                                    $(nTd).text('');
                                    $(nTd).addClass('td-actions');
                                    action=$('<div></div>');
                                    action.addClass('pull-right hidden-phone visible-desktop action-buttons');
                                    btnEdit=$('<a class="green" href="#"> '+
                                    '<i class="fa fa-pencil bigger-130"></i>'+
                                    '</a>');
                                    btnEdit.click(function(){
                                         $.post("<?php echo App::getBoPath(); ?>/article/ArticleController.php", {articleId: oData[2], ACTION: "<?php echo App::ACTION_VIEW_DETAILS; ?>"}, function (data) {
                                        data = $.parseJSON(data);
                                        if(data.rc==-1){
                                        $.gritter.add({
                                           title: 'Notification',
                                           text: data.error,
                                           class_name: 'gritter-error gritter-light'
                                       }); 
                                     }else{
                                        console.log(data);
                                        article=oData[2];
//                                        jsonText='{"value":'+data.oId+', "text":"'+nom+'"}';
//                                        jsonText=JSON.parse(jsonText);
//                                        $("#CMBRUBRIQUE").select2("data", jsonText, true);
                                        $('#CMBRUBRIQUE').val(data.idArticle).change();
                                        $('#libelle').val(data.libelle);
                                    }
                                    });
                                       
                                        $('#winModalArticle').modal('show');
                                    });
                                    btnEdit.tooltip({
                                        title: 'Modifier'
                                    });
                                    //if (full[5] !== "Admin"){
                                    btnRemove=$('<a class="red" href="#">'+
                                                '<i class="fa fa-trash bigger-130"></i>'+
                                                '</a>');
                                    //}
                                    btnRemove.click(function(){
                                        removeArticle(oData[2]);
                                    });
                                    btnRemove.tooltip({
                                        title: 'Supprimer'
                                    });
                                    btnEdit.css({'margin-right': '10px', 'cursor':'pointer'});
                                    btnRemove.css({'cursor':'pointer'});
                                    action.append(btnEdit);
                                   // if(oData[4] !=="Admin"){
                                    action.append(btnRemove);
                                  //  }
                                    $(nTd).append(action);
                                }
                            }
                    ],
                    
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
//                        persistChecked();
//                        $(nRow).css('cursor','pointer');
//                        $(nRow).on('click', 'td:not(:first-child)', function(){
//                            checkbox=$(this).parent().find('input:checkbox:first');
//                            if(!checkbox.is(':checked')){
//                                checkbox.prop('checked', true);;
//                                checkedArticlesAdd(aData[0]);
//                                MessageSelected();
//                                
//                            }else{
//                                checkbox.removeAttr('checked');
//                                
//                                checkedArticlesRemove(aData[0]);
//                                MessageUnSelected();
//                            }
//                        });
                    },
                    "fnDrawCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                       
                    },
                    "preDrawCallback": function( settings ) {
                       
                    },
                    "bProcessing": true,
                    "bServerSide": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bInfo": true,
                    "sAjaxSource": url,
                    "sPaginationType": "full_numbers",
                    "fnServerData": function ( sSource, aoData, fnCallback ) {
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST; ?>"});
                        aoData.push({"name": "offset", "value": "1"});
                        aoData.push({"name": "rowCount", "value": "10"});
//                        aoData.push({"name": "profil", "value": $.cookie('profil')});
                        $.ajax( {
                          "dataType" : 'json',
                          "type" : "POST",
                          "url" : sSource,
                          "data" : aoData,
                          "success" : function(json) {
                              if(json.rc==-1){
                                 $.gritter.add({
                                    title: 'Notification',
                                    text: json.error,
                                    class_name: 'gritter-error gritter-light'
                                }); 
                              }else{
                                  $('table th input:checkbox').removeAttr('checked');
                                  fnCallback(json);
                                  nbTotalArticlesChecked=json.iTotalRecords;
                              }
                                
                           }
                        });
                    }
                });
            };
            
            loadArticles();
        $("#MNU_PRODUIT_NEW").click(function()
        {
            $('#CMBRUBRIQUE').val("-1").change();
            $('#libelle').val("");
            $('#winModalArticle').modal('show');
        });
      
   
       
   
         articleProcess = function (article)
        {
            
            var ACTION 
            if(article==0)       
               ACTION = '<?php echo App::ACTION_INSERT; ?>';
           else
              ACTION = '<?php echo App::ACTION_UPDATE; ?>';
            var frmData;
            var rubriqueId = $("#CMBRUBRIQUE").val();
            var libelle = $("#libelle").val();
            var login = "<?php echo $login ?>";
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('articleId', article);
            formData.append('rubriqueId', rubriqueId);
            formData.append('libelle', libelle);
            formData.append('login', login);
            $.ajax({
                url: '<?php echo App::getBoPath(); ?>/article/ArticleController.php',
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'JSON',
                data: formData,
                success: function (data)
                {
                    if (data.rc == 0)
                    {
                        $.gritter.add({
                            title: 'Notification',
                            text: data.action,
                            class_name: 'gritter-success gritter-light'
                        });
                       loadArticles();
                    } 
                    else
                    {
                        $.gritter.add({
                            title: 'Notification',
                            text: data.error,
                            class_name: 'gritter-error gritter-light'
                        });
                        
                    };
                    
                },
                error: function () {
                    alert("failure - controller");
                }
            });

        };


    
        
        
      
       //Validate
       $("#SAVE").bind("click", function () {
        $.validator.addMethod("notEqual", function(value, element, param) {
            return this.optional(element) || value != param;
        });    
       $.validator.addMethod(
                "regexStockProvisoire",
                function(value, element, regexp) {
                    return this.optional(element) || regexp.test(value);
                },
                "Caracteres non autorises"
            );
    
            context=$(this);
       $('#validation-form').validate({
           
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			ignore: "",
			rules: {
                            CMBRUBRIQUE: {
                                    required: true
                            },
                            
                            libelle: {
                                    required: true
                            }
			},
	
			messages: {
				CMBRUBRIQUE: {
					required: "Champ obligatoire."
				},
				libelle: {
					notEqual:"Champ obligatoire."
				}
			
			},
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
	
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
				$(e).remove();
			},
	
			errorPlacement: function (error, element) {
				 error.insertAfter(element);
			},
	
			submitHandler: function (form) {
				 articleProcess(article);
				/// $('#winModalArticle').addClass('hide');
                            $('#winModalArticle').modal('hide');
                            $('#CMBRUBRIQUE').val("-1").change();
                            $('#libelle').val("");
			},
			invalidHandler: function (form) {
			}
		});


       });

       
       
       
    });
</script>
