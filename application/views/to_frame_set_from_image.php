<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentallela Alela! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- jVectorMap -->
    <link href="<?php echo base_url(); ?>assets/css/maps/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/build/css/custom.min.css" rel="stylesheet">
    <style>
        #right-col {
            min-height: calc(100% - 52px) !important;
        }
    </style>
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/fileupload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/fileupload/css/jquery.fileupload-ui.css">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/fileupload/css/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/fileupload/css/jquery.fileupload-ui-noscript.css"></noscript>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container" style="height:100vh;">
        <div class="col-md-3 left_col">
            <?php $this->load->view('partial/leftnav') ?>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <?php $this->load->view('partial/topnav') ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" id="right-col">
        <!-- top tiles -->
        <br/>
            <div class="row">
                <div style="margin: 20px;">
                    <div class="x_panel">
                        <div>
                            <dl class="dl-horizontal">
                                <?php
                                    $json = json_decode($toFrameSetJson);
                                    echo "<dt>ID</dt>";
                                    echo "<dd>" . $json->{'ID'} . "</dd>";
                                    echo "<dt>Duration</dt>";
                                    echo "<dd>" . $json->{'Duration'} . "</dd>";
                                    echo "<dt>IsBase</dt>";
                                    echo "<dd>" . $json->{'IsBase'} . "</dd>";
                                    echo "<dt>LogInfo</dt>";
                                    echo "<dd>" . $json->{'LogInfo'} . "</dd>";
                                    echo "<dt>Audio</dt>";
                                    echo "<dd>" . $json->{'Audio'} . "</dd>";
                                    echo "<dt>Number of Frames Generated</dt>";
                                    echo "<dd>" . count((array)($json->{'Frames'})) . "</dd>";
                                ?>
                            </dl>
                            <form id="fileupload" action="<?php echo CLOUD_FRONT ?>" method="POST" enctype="multipart/form-data">
                                <!-- Redirect browsers with JavaScript disabled to the origin page -->
                                <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row fileupload-buttonbar">
                                    <div>
                                        <div id="json-upload">
                                            <div class="form-group">
                                                <label for="key">Json Name</label>
                                                <input type="text" name="key" value="<?php echo TEMP_JSON ?>" class="form-control" id="name" placeholder="File name will get modified.">
                                            </div>
                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn btn-success fileinput-button">
                                                <i class="glyphicon glyphicon-plus"></i>
                                                <span>Add file</span>
                                                <input type="file" name="file">
                                            </span>
                                            <div onclick="enableImageUpload()">
                                                <button type="submit" class="btn btn-primary start">
                                                    <i class="glyphicon glyphicon-upload"></i>
                                                    <span>Start upload</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="image-upload" style="display:none;">
                                            <div class="form-group">
                                                <label for="key">Image Name</label>
                                                <input type="text" name="key" value="<?php echo TEMP_IMAGE ?>" class="form-control" id="name" placeholder="File name will get modified.">
                                            </div>
                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn btn-success fileinput-button">
                                                <i class="glyphicon glyphicon-plus"></i>
                                                <span>Add file</span>
                                                <input type="file" name="file" accept="image/*">
                                            </span>
                                            <div onclick="hideUpload()">
                                                <button type="submit" class="btn btn-primary start" >
                                                    <i class="glyphicon glyphicon-upload"></i>
                                                    <span>Start upload</span>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- The global file processing state -->
                                        <span class="fileupload-process"></span>

                                    </div>
                                    <!-- The global progress state -->
                                    <div class="col-lg-5 fileupload-progress fade">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                        </div>
                                        <!-- The extended global progress state -->
                                        <div class="progress-extended">&nbsp;</div>
                                    </div>
                                </div>
                                <!-- The table listing the files available for upload/download -->
                                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                            </form>
                            <form method="post" action="http://localhost/adminPanel/index.php/toFrameSetFromImage/convertToFrameSetFromImage/">
                                <input type="hidden" name="image" value="abc"></input>
                                <input type="hidden" name="json" value="abc2"></input>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Proceed to Function ToFrameSetFromImage</button>
                                <button type="button" class="btn btn-primary btn-lg btn-block">Cancel</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <?php $this->load->view('partial/footer') ?>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <script>
        function enableImageUpload() {
            $('#image-upload').show();
            $('#fileupload').show();
            $('#json-upload').remove();
        };
        function hideUpload() {
            $('#fileupload').hide();
        };
    </script>
    <script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade uploaded-items">
            <td>
                <span class="preview"></span>
            </td>
            <td>
                <input type="hidden" name="key" value={%= $('#name').val() %} required>
            </td>
            <td>
                <p class="name">{%=file.name%}</p>
                <strong class="error text-danger"></strong>
            </td>
            <td>
                <p class="size">Processing...</p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
            </td>
            <td>
                {% if (!i && !o.options.autoUpload) { %}
                    <button class="btn btn-primary start" disabled>
                        <i class="glyphicon glyphicon-upload"></i>
                        <span>Start</span>
                    </button>
                {% } %}
                {% if (!i) { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
            <td>
                <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                    {% } %}
                </span>
            </td>
            <td>
                <p class="name">
                    {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                    {% } else { %}
                        <span>{%=file.name%}</span>
                    {% } %}
                </p>
                {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                <span class="size">{%=o.formatFileSize(file.size)%}</span>
            </td>
            <td>
                {% if (file.deleteUrl) { %}
                    <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                        <i class="glyphicon glyphicon-trash"></i>
                        <span>Delete</span>
                    </button>
                    <input type="checkbox" name="delete" value="1" class="toggle">
                {% } else { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
    </script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="<?php echo base_url(); ?>assets/vendors/fileupload/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- blueimp Gallery script -->
    <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="<?php echo base_url(); ?>assets/vendors/fileupload/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="<?php echo base_url(); ?>assets/vendors/fileupload/js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="<?php echo base_url(); ?>assets/vendors/fileupload/js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="<?php echo base_url(); ?>assets/vendors/fileupload/js/jquery.fileupload-image.js"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="<?php echo base_url(); ?>assets/vendors/fileupload/js/jquery.fileupload-audio.js"></script>
    <!-- The File Upload video preview plugin -->
    <script src="<?php echo base_url(); ?>assets/vendors/fileupload/js/jquery.fileupload-video.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="<?php echo base_url(); ?>assets/vendors/fileupload/js/jquery.fileupload-validate.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="<?php echo base_url(); ?>assets/vendors/fileupload/js/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    <script src="<?php echo base_url(); ?>assets/vendors/fileupload/js/main.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/build/js/custom.min.js"></script>

  </body>
</html>
