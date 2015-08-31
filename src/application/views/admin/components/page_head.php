<!DOCTYPE>
<html>
<head>
     <meta charset="utf-8">
    <title><?php echo $meta_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet" media="screen">
    <link href="<?php echo base_url('css/custom.css');?>" rel="stylesheet" media="screen">
    <script src="<?php echo site_url('js/jquery-1.9.1.js'); ?>"></script>
    <script src="<?php echo site_url('js/jquery-ui.js'); ?>"></script>
    <script type="text/javascript">
        // Defining Base URL
        var baseUrl = '<?php echo base_url(); ?>';
        // Current Segment
        var segment = '<?php echo $this->uri->uri_string(); ?>';

        //********************* Sorting ********************

        $(document).on("click", ".change_oder_btn_trig", function () {

            make_sotable();
        });

        $(document).on("click", ".save_oder_btn_trig", function () {
            save_to_database();
        });

        $(document).on("click", ".save_oder_cancel", function () {
            cansel_sort();
        });


        // json object variable
        oderjson = "";

        /*
         // Make table sortable
         // Change button to "save oder"
         //
         // Use
         // jQuery sortable
         // jQuery draggable
         // id = #sortable_table
         */
        function make_sotable (table_id) {
            //alert('1');
            $('.sortable_table').addClass('sortable');
            /*
             // when dragging the <tr> to keep the <tr> width
             */
            var fixHelper = function(e, ui) {
                ui.children().each(function() {
                    $(this).width($(this).width());
                });
                return ui;
            };

            // Init the sortable method
            $(".sortable>table>.sortable_table_body").sortable({
                helper: fixHelper,
                update: function (){
                    /*
                     // to get the current oder
                     */
                    oderjson = "";
                    var order = $('.sortable>table>.sortable_table_body').sortable('toArray');

                    var id = 1;

                    $( ".sortable>table>.sortable_table_body tr" ).each(function() {
                        oderjson += '"'+$( this ).find(".order_num").text()+'":"'+(id++)+'",';
                        // oderjson += '"'+$( this ).find(".order_num").text()+'":"'+ $( this ).attr( "id" )+'",';
                        // "1":"2","2":"1","3":"4","4":"3","5":"6","6":"7"
                    })

                    /*
                     // to remove last on json string" , "
                     */
                    oderjson = oderjson.slice(0,-1);

                    /*
                     // json Object template= [{1:2},{2:1},{3:4},{4:3},{5:6},{6:7}]
                     */
                    oderjson = "{"+oderjson+"}";

                    /*
                     // jto indicate user that oder has to be save
                     */
                    $(".save_oder_btn").addClass('btn-success')

                }

            }).disableSelection();

        }


        /*
         // Sorted list save to database.
         // Change buttons to "Change oder"
         //
         // Use
         // jQuery Ajax
         // jQuery sortable
         // var baseUrl segment -> from header
         */
        function  save_to_database() {

            //alert(oderjson);
            var current_segment = "<?php  echo $this->uri->segment(2); ?>";
            dataStream = ({
                oderjson : oderjson,
                modal : current_segment
            });
            //alert(segment);

            $.ajax({
                type: "POST",
                url: baseUrl+"/admin/"+current_segment+"/save_order/"+ encodeURIComponent(oderjson),
                data: dataStream,
                success: function(response){
                    $("#msage").append().html('<div class="alert alert-success">Order has changed.</div>')
                    $("#msage .alert").delay( 3000 ).slideUp( 300 );
                    //alert('segment:'+segment+' - responce : '+response);
                    //$('.sortable_table').html(response);
                }
            });

            oderjson = "";
            /*
             // to destroy the
             */
            $('.sortable>table>.sortable_table_body').sortable( "destroy" );
            $('.sortable_table').removeClass('sortable');

            /*
             // oder save indication removal
             */
            $(".save_oder_btn").removeClass('btn-success')

        }

        /*
         // reset the oder that changed before save
         */
        function cansel_sort () {
            location.reload();
        }

        //********************* EOF Sorting ********************
        </script>
        <!-- TinyMCE -->
        <script type="text/javascript" src="<?php echo base_url('js/tiny_mce/tiny_mce.js');?>"></script>
        <script type="text/javascript">
            tinyMCE.init({
                // General options
                mode : "textareas",
                theme : "advanced",
                skin : "bootstrap",
                plugins : "table,inlinepopups",

                // Theme options
                // theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,|,table,removeformat,code",
                theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,forecolor,bullist,numlist,|,link,unlink,image,|,code,",
                theme_advanced_buttons2 : "",
                theme_advanced_buttons3 : "",
                theme_advanced_buttons4 : "",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : true,


                // Example content CSS (should be your site CSS)
                content_css : "css/content.css",

                // Drop lists for link/image/media/template dialogs
                template_external_list_url : "lists/template_list.js",
                external_link_list_url : "lists/link_list.js",
                external_image_list_url : "lists/image_list.js",
                media_external_list_url : "lists/media_list.js",



                // Replace values for the template plugin
                template_replace_values : {
                    username : "Some User",
                    staffid : "991234"
                }
            });
        </script>
        <!-- EOF TinyMCE -->
</head>